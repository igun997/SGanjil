<?php

namespace App\Http\Controllers;
use App\Model\Permintaan;
use App\Model\PermintaanDetail;
use App\Model\Barang;
use Illuminate\Http\Request;

class TokoControl extends Controller
{
    public function index()
    {
      $data["title"] = "Dashboard Rendal Umum";
      return view("admin_toko.home")->with($data);
    }
    public function permintaan_index()
    {
      $data["title"] = "Permintaan Barang";
      return view("admin_toko.permintaan_index")->with($data);
    }
    public function permintaan_detail($id)
    {
      $cek = \App\Model\PermintaanDetail::where(["kode_permintaan"=>$id]);
      if ($cek->count() < 1) {
        return back();
      }
      $data["data"] = $cek->get();
      $data["permintaan"] = $cek->first();
      $data["title"] = "Detail Permintaan [{$id}]";
      return view("admin_toko.permintaan_detail")->with($data);
    }
    public function permintaan_add()
    {
      $counter = Permintaan::whereDate("tgl",">=",date("d-m-Y"))->count();
      $data["kode_permintaan"] = "P".date("dmy")."-".($counter+1);
      $data["title"] = "Tambah Data Permintaan";
      return view("admin_toko.permintaan_add")->with($data);
    }
    public function permintaan_add_action(Request $req)
    {
      $req->validate([
        "kode_permintaan"=>"required"
      ]);
      $order = Permintaan::create($req->all());
      if ($order) {
        $data["data"] = $order;
        return redirect(route("permintaan_toko.add_continue",$order->kode_permintaan))->with($data);
      }else {
        return back()->withErrors(["msg"=>"Gagal Simpan Data"]);
      }
    }
    public function permintaan_add_continue(Request $req,$id)
    {
      $cek = Permintaan::findOrFail($id);
      $show = Permintaan::where(["kode_permintaan"=>$id]);
      $data["title"] = "Tambah Barang Permintaan [{$id}]";
      $data["data"] = $show->first();
      return view("admin_toko.permintaan_add_continue")->with($data);
    }
    public function permintaan_add_continue_action(Request $req,$id)
    {
      $req->validate([
        "kode_barang"=>"required",
        "kode_permintaan"=>"required",
        "jumlah"=>"required|numeric|min:0",
      ]);
      $stok = Barang::where(["kode_barang"=>$req->kode_barang])->first()->stok_awal;
      if ($stok < $req->jumlah ) {
        return back()->withErrors(["msg"=>"Jumlah melebihi stok barang"]);
      }
      $ins = PermintaanDetail::create($req->all());
      if ($ins) {
      
        return back()->with("msg","Sukses Simpan Data");
      }else {
        return back()->withErrors(["msg"=>"Gagal Simpan Data"]);
      }
    }
    public function permintaan_add_continue_cancel(Request $req,$id)
    {
      $cek = Permintaan::findOrFail($id);
      $delmass = PermintaanDetail::where(["kode_permintaan"=>$id])->delete();
      $cek->delete();
      return redirect(route("permintaan_toko.index"))->with("msg","Pesanan Telah Di Batalkan");
    }
}
