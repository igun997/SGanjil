<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Po;
use App\Model\PoDetail;
use App\Model\PoTerima;
use App\Model\Kategori;
use App\Model\Warna;
use App\Model\Suplier;
use App\Model\Barang;
use App\Model\Permintaan;
use App\Model\PermintaanDetail;
use App\Model\HistoryHarga;
use App\Model\Retur;
use App\Model\ReturDetail;
class KepalaControl extends Controller
{
    public function index()
    {
      $data["title"] = "Dashboard Manajer";
      return view("kepala_gudang.home")->with($data);
    }
    //Barang
    public function barang_index()
    {
      $data["title"] = "Data Barang";
      $data["barang"] = Barang::all();
      return view("kepala_gudang.barang_index")->with($data);
    }
    public function barang_add_action(Request $req)
    {
      $this->validate($req,[
        "kode_barang"=>"required|unique:barang,kode_barang",
        "nama_barang"=>"required",
        "warna"=>"required",
        "kategori"=>"required",
        "harga_satuan"=>"required|numeric|min:0|not_in:-1",
        "stok_awal"=>"required|numeric|min:0|not_in:-1",
      ]);
      $ins = Barang::create($req->all());
      if ($ins) {
        return back()->with("msg","Data Sukses Di Simpan");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
    }
    public function barang_update(Request $req,$id)
    {

      $cek = Barang::where(["kode_barang"=>$id]);
      if ($cek->count() > 0) {
        $data["title"] = "Update Barang";
        $data["data"] = $cek->first();
        return view("kepala_gudang.barang_update")->with($data);
      }else {
        return back()->withErrors(["msg"=>"Data Tidak Ditemukan"]);
      }
    }
    public function barang_update_action(Request $req,$id)
    {
      $this->validate($req,[
        "nama_barang"=>"required",
        "warna"=>"required",
        "kategori"=>"required",
        "harga_satuan"=>"required",
        "stok_awal"=>"required",
      ]);
      $data = $req->all();
      unset($data["_token"]);
      $cek = Barang::where(["kode_barang"=>$id])->update($data);
      if ($cek) {
        return back()->with("msg","Data Sukses Di Update");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Update"]);
      }
    }
    public function barang_delete($id)
    {
      $cek = Barang::findOrFail($id);
      if ($cek->delete()) {
        return back()->with("msg","Data Sukses di Hapus");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal di Hapus"]);
      }
    }
    public function kategori_index()
    {
      $data["title"] = "Data Kategori";
      $data["kategori"] = Kategori::all();
      return view("kepala_gudang.kategori_index")->with($data);
    }
    public function kategori_add_action(Request $req)
    {
      $this->validate($req,[
        "kategori"=>"required"
      ]);
      $ins = Kategori::create($req->all());
      if ($ins) {
        return back()->with("msg","Data Sukses Di Simpan");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
    }
    public function kategori_update(Request $req,$id)
    {
      $cek = Kategori::where(["id_kategori"=>$id]);
      if ($cek->count() > 0) {
        $data["title"] = "Update Kategori";
        $data["data"] = $cek->first();
        return view("kepala_gudang.kategori_update")->with($data);
      }else {
        return back()->withErrors(["msg"=>"Data Tidak Ditemukan"]);
      }
    }
    public function kategori_update_action(Request $req,$id)
    {
      $cek = Kategori::where(["id_kategori"=>$id])->update(["kategori"=>$req->kategori,"ket"=>$req->ket]);
      if ($cek) {
        return back()->with("msg","Data Sukses Di Update");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Update"]);
      }
    }
    public function kategori_delete($id)
    {
      $cek = Kategori::findOrFail($id);
      if ($cek->delete()) {
        return back()->with("msg","Data Sukses di Hapus");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal di Hapus"]);
      }
    }
    //Warna
    public function warna_index()
    {
      $data["title"] = "Data Warna";
      $data["warna"] = Warna::all();
      return view("kepala_gudang.warna_index")->with($data);
    }
    public function warna_add_action(Request $req)
    {
      $this->validate($req,[
        "warna"=>"required"
      ]);
      $ins = Warna::create($req->all());
      if ($ins) {
        return back()->with("msg","Data Sukses Di Simpan");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
    }
    public function warna_update(Request $req,$id)
    {
      $cek = Warna::where(["id_warna"=>$id]);
      if ($cek->count() > 0) {
        $data["title"] = "Update Warna";
        $data["data"] = $cek->first();
        return view("kepala_gudang.warna_update")->with($data);
      }else {
        return back()->withErrors(["msg"=>"Data Tidak Ditemukan"]);
      }
    }
    public function warna_update_action(Request $req,$id)
    {
      $cek = Warna::where(["id_warna"=>$id])->update(["warna"=>$req->warna]);
      if ($cek) {
        return back()->with("msg","Data Sukses Di Update");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Update"]);
      }
    }
    public function warna_delete($id)
    {
      $cek = Warna::findOrFail($id);
      if ($cek->delete()) {
        return back()->with("msg","Data Sukses di Hapus");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal di Hapus"]);
      }
    }

    public function po_index()
    {
      $data["title"] = "Data PO";
      $data["po"] = Po::where(["status_keuangan"=>"confirmed"])->get();
      return view("kepala_gudang.po_index")->with($data);
    }
    public function po_detail($id)
    {
      $cek = \App\Model\PoDetail::where(["no_po"=>$id]);
      // echo $cek->count();
      if ($cek->count() < 1) {
        return back();
      }
      $data["data"] = $cek->get();
      $data["po"] = $cek->first();
      $data["title"] = "Detail Validasi PO [{$id}]";
      return view("kepala_gudang.po_detail")->with($data);
    }
    public function po_update_action(Request $req,$id,$status)
    {
      if ($status == "ditolak") {
        $cek = Po::where(["no_po"=>$id])->update(["validasi"=>$status,"ket"=>$req->ket,"status"=>"selesai"]);
      }else {
        $cek = Po::where(["no_po"=>$id])->update(["validasi"=>$status]);
      }
      if ($cek) {
        return back()->with("msg","Data Sukses Di Update");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Update"]);
      }
    }
}
