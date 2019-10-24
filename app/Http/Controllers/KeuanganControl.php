<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Model\Retur;
use \App\Model\ReturDetail;
use \App\Model\Po;
use \App\Model\PoDetail;
use \App\Model\Barang;
use \App\Model\HistoryHarga;
class KeuanganControl extends Controller
{
    public function index()
    {
      $data["title"] = "Dashboard Junior Manajer Gudang";
      return view("keuangan.home")->with($data);
    }
    public function validasi_perubahan(Request $req,$kode,$status)
    {
      $data = [];
      $last_harga = Barang::where(["kode_barang"=>$kode])->first()->harga_satuan;
      if ($status == 1) {
        $data["kode_barang"] = $kode;
        $data["harga"] = $last_harga;
        $data["bukti"] = $req->input("bukti");
        $ins = HistoryHarga::create($data);
        if ($ins) {
          $po = $req->input("po");
          $up = PoDetail::where(["no_po"=>$po,"kode_barang"=>$kode])->update(["persetujuan_harga"=>1]);
          Barang::where(["kode_barang"=>$kode])->update(["harga_satuan"=>$req->input("harga")]);
          return back()->with(["msg"=>"Data Berhasil Di Simpan"]);
        }else {
          return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
        }
      }else {
        $po = $req->input("po");
        $up = PoDetail::where(["no_po"=>$po,"kode_barang"=>$kode])->update(["persetujuan_harga"=>2]);
        if ($up) {
          return back()->with(["msg"=>"Data Berhasil Di Simpan"]);
        }else {
          return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
        }
      }
    }

    public function validasi()
    {
      $data["po"] = Po::all();
      $data["retur"] = Retur::all();
      $data["title"] = "Validasi PO  & Retur";
      return view("keuangan.validasi")->with($data);
    }
    public function validasi_po($id)
    {
      $cek = \App\Model\PoDetail::where(["no_po"=>$id]);
      // echo $cek->count();
      if ($cek->count() < 1) {
        return back();
      }
      $i = 0;
      foreach ($cek->get() as $key => $value) {
        if ($value->total_terima != $value->total_pesan) {
          $i = 1;
          break;
        }
      }
      if ($i == 0) {
        Po::find($id)->update(["status"=>"selesai"]);
      }
      $data["data"] = $cek->get();
      $total = 0;
      foreach ($cek->get() as $key => $value) {
        $total = $total + ($value->total_pesan * $value->barang->harga_satuan);
      }
      $data["total"] = $total;
      $data["po"] = $cek->first();
      $data["title"] = "Detail Persetujuan PO [{$id}]";
      return view("keuangan.po_detail")->with($data);
    }
    public function validasi_po_terima(Request $req,$id)
    {
      $up = Po::findOrFail($id)->update(["status_keuangan"=>"confirmed"]);
      if ($up) {
        return back()->with(["msg"=>"Sukses Update Status"]);
      }else {
        return back()->withErrors(["msg"=>"Gagal Update Status"]);
      }
    }
    public function validasi_po_tolak(Request $req,$id)
    {
      $up = Po::findOrFail($id)->update(["status_keuangan"=>"unconfirm","validasi"=>"ditolak","status"=>"selesai","ket"=>$req->alasan]);
      if ($up) {
        return back()->with(["msg"=>"Sukses Update Status"]);
      }else {
        return back()->withErrors(["msg"=>"Gagal Update Status"]);
      }
    }
    public function validasi_retur_terima($id)
    {
      $up = Retur::findOrFail($id)->update(["status_keuangan"=>"confirmed"]);
      if ($up) {
        return back()->with(["msg"=>"Sukses Update Status"]);
      }else {
        return back()->withErrors(["msg"=>"Gagal Update Status"]);
      }
    }
    public function validasi_retur($id)
    {
      $cek = \App\Model\ReturDetail::where(["no_retur"=>$id]);
      // echo $cek->count();
      if ($cek->count() < 1) {
        return back();
      }
      $data["data"] = $cek->get();
      $total_biaya = 0;
      foreach ($cek->get() as $key => $value) {
        $total_biaya = $total_biaya + ($value->total_retur*$value->barang->harga_satuan);
      }
      $data["total_biaya"] = $total_biaya;
      $data["retur"] = $cek->first();
      $data["title"] = "Detail Persetujuan Retur [{$id}]";
      return view("keuangan.retur_detail")->with($data);
    }
}
