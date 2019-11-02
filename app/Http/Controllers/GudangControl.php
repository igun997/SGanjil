<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Kategori;
use App\Model\Warna;
use App\Model\Suplier;
use App\Model\Barang;
use App\Model\Permintaan;
use App\Model\PermintaanDetail;
use App\Model\PoDetail;
use App\Model\PoTerima;
use App\Model\HistoryHarga;
use App\Model\Po;
use App\Model\Retur;
use App\Model\ReturDetail;
use PDF;
class GudangControl extends Controller
{
    public function index()
    {
      $data["title"] = "Dashboard Rendal Material";
      return view("admin_gudang.home")->with($data);
    }
    //Kategori
    public function kategori_index()
    {
      $data["title"] = "Data Kategori";
      $data["kategori"] = Kategori::all();
      return view("admin_gudang.kategori_index")->with($data);
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
        return view("admin_gudang.kategori_update")->with($data);
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
      return view("admin_gudang.warna_index")->with($data);
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
        return view("admin_gudang.warna_update")->with($data);
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
    //Suplier
    public function suplier_index()
    {
      $data["title"] = "Data Suplier";
      $data["suplier"] = Suplier::all();
      return view("admin_gudang.suplier_index")->with($data);
    }
    public function suplier_add_action(Request $req)
    {
      $this->validate($req,[
        "nama_suplier"=>"required",
        "alamat"=>"required",
      ]);
      $ins = Suplier::create($req->all());
      if ($ins) {
        return back()->with("msg","Data Sukses Di Simpan");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
    }
    public function suplier_update(Request $req,$id)
    {
      $cek = Suplier::where(["id_suplier"=>$id]);
      if ($cek->count() > 0) {
        $data["title"] = "Update Suplier";
        $data["data"] = $cek->first();
        return view("admin_gudang.suplier_update")->with($data);
      }else {
        return back()->withErrors(["msg"=>"Data Tidak Ditemukan"]);
      }
    }
    public function suplier_update_action(Request $req,$id)
    {
      $this->validate($req,[
        "nama_suplier"=>"required",
        "alamat"=>"required",
      ]);
      $data = $req->all();
      unset($data["_token"]);
      $cek = Suplier::where(["id_suplier"=>$id])->update($data);
      if ($cek) {
        return back()->with("msg","Data Sukses Di Update");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Update"]);
      }
    }
    public function suplier_delete($id)
    {
      $cek = Suplier::findOrFail($id);
      if ($cek->delete()) {
        return back()->with("msg","Data Sukses di Hapus");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal di Hapus"]);
      }
    }

    //Barang
    public function barang_index()
    {
      $data["title"] = "Data Barang";
      $data["barang"] = Barang::all();
      return view("admin_gudang.barang_index")->with($data);
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
        return view("admin_gudang.barang_update")->with($data);
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
    public function permintaan_index()
    {
      $data["title"] = "Data Permintaan";
      $data["permintaan"] = Permintaan::orderBy("tgl","desc")->get();
      return view("admin_gudang.permintaan_index")->with($data);
    }
    public function permintaan_update_action(Request $req,$id,$status)
    {
      $cek = Permintaan::where(["kode_permintaan"=>$id])->update(["verifikasi"=>$status]);
      if ($cek) {
        $x = PermintaanDetail::where(["kode_permintaan"=>$id])->get();
        foreach ($x as $key => $value) {
          $ck = Barang::where(["kode_barang"=>$value->kode_barang]);
          $stok = $ck->first()->stok_awal;
          $ck->update(["stok_awal"=>($stok-$value->jumlah)]);
        }
        return back()->with("msg","Data Sukses Di Update");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Update"]);
      }
    }
    public function permintaan_delete($id)
    {
      $cek = Permintaan::findOrFail($id);
      if ($cek->delete()) {
        return back()->with("msg","Data Sukses di Hapus");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal di Hapus"]);
      }
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
      return view("admin_gudang.permintaan_detail")->with($data);
    }
    public function po_index()
    {
      $data["title"] = "PO Barang";
      $data["po"] = Po::orderBy("tgl_po","desc")->get();
      return view("admin_gudang.po_index")->with($data);
    }
    public function po_hapus($id)
    {
      $del = Po::findOrFail($id)->delete();
      if ($del) {
        return back()->with("msg","Data Berhasi Di Hapus");
      }else {
        return back();
      }
    }
    public function po_terima(Request $req, $id)
    {
      $req->validate([
        "id_po_detail"=>"required",
        "total_terima"=>"required|numeric",
      ]);
      $cek = PoDetail::where(["no_po"=>$id,"id_po_detail"=>$req->id_po_detail]);
      $terima = $cek->first()->total_terima;
      $pesan = $cek->first()->total_pesan;
      if (($terima+$req->total_terima) > $pesan) {
        return  back()->withErrors(["msg"=>"Total Terima Melebihi Total Pesan"]);
      }else {
        $up = $cek->update(["total_terima"=>($terima+$req->total_terima)]);
        if ($up) {
          $ck = Barang::where(["kode_barang"=>$cek->first()->barang->kode_barang]);
          $stok = $ck->first()->stok_awal;
          $ck->update(["stok_awal"=>$stok+($terima+$req->total_terima)]);
          PoTerima::create(["no_po"=>$id,"id_po_detail"=>$req->id_po_detail,"total_terima"=>$req->total_terima]);
          return back()->with("msg","Sukses Simpan Data");
        }else {
          return back()->withErrors(["msg"=>"Gagal Simpan Data"]);
        }
      }
    }
    public function po_retur(Request $req, $id)
    {
      $req->validate([
        "kode_barang"=>"required",
        "total_retur"=>"required|numeric|min:1",
      ]);
      $cek = Retur::where(["no_po"=>$id]);
      if ($cek->count() > 0) {
        $no_retur = $cek->first()->no_retur;
        $create = ReturDetail::create(["no_retur"=>$no_retur,"kode_barang"=>$req->kode_barang,"total_retur"=>$req->total_retur]);
        if ($create) {
          return back()->with(['msg'=>"Sukses Tambah Barang Retur"]);
        }else {
          return back()->withErrors(['msg'=>"Gagal Tambah Barang Retur"]);
        }
      }else {
        $no_retur = "R".date("dmy")."-".(Retur::whereDate("tanggal_retur",">=",date("Y-m-d"))->count() + 1);
        $no_po = $id;
        $x = Retur::create(["no_po"=>$no_po,"no_retur"=>$no_retur]);
        if ($x) {
          $create = ReturDetail::create(["no_retur"=>$no_retur,"kode_barang"=>$req->kode_barang,"total_retur"=>$req->total_retur]);
          if ($create) {
            return back()->with(['msg'=>"Sukses Tambah Barang Retur"]);
          }else {
            return back()->withErrors(['msg'=>"Gagal Tambah Barang Retur"]);
          }
        }else {
          return back()->withErrors(['msg'=>"Gagal Tambah Retur Barang"]);
        }
      }
    }
    public function po_detail($id)
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
      $diterima = PoTerima::where(["no_po"=>$id])->get();
      $data["data"] = $cek->get();
      $data["data_diterima"] = $diterima;
      $data["data_retur"] = (Retur::where(["no_po"=>$id])->count() > 0)?Retur::where(["no_po"=>$id])->first():[];
      $data["po"] = $cek->first();
      $data["title"] = "Detail PO [{$id}]";
      return view("admin_gudang.po_detail")->with($data);
    }
    public function po_add()
    {
      $counter = Po::whereDate("tgl_po",'>=',date("Y-m-d"))->count();
      // echo $counter;
      $data["no_po"] = "PO".date("dmy")."-".($counter+1);
      $data["title"] = "Tambah Data Po";
      return view("admin_gudang.po_add")->with($data);
    }
    public function po_add_action(Request $req)
    {
      $req->validate([
        "no_po"=>"required",
        "id_suplier"=>"required",
      ]);
      $order = Po::create($req->all());
      if ($order) {
        $data["data"] = $order;
        return redirect(route("po.add_continue",$order->no_po))->with($data);
      }else {
        return back()->withErrors(["msg"=>"Gagal Simpan Data"]);
      }
    }
    public function po_add_continue(Request $req,$id)
    {
      $cek = Po::findOrFail($id);
      $show = Po::where(["no_po"=>$id]);
      $data["title"] = "Tambah Barang PO [{$id}]";
      $data["data"] = $show->first();

      return view("admin_gudang.po_add_continue")->with($data);
    }
    public function po_add_continue_action(Request $req,$id)
    {
      $req->validate([
        "kode_barang"=>"required",
        "no_po"=>"required",
        "total_pesan"=>"required|numeric|min:0",
      ]);
      $data = $req->all();
      $cek = PoDetail::where(["no_po"=>$req->input("no_po"),"kode_barang"=>$req->input("kode_barang")]);
      if ($cek->count() > 0) {
        return back()->withErrors(["msg"=>"Barang Sudah Di Masukan Sebelumnya"]);
      }
      if ($req->has("bukti")) {
         $image = $req->file('bukti');
         $name = time().'.'.$image->getClientOriginalExtension();
         if (!in_array($image->getClientOriginalExtension(),["pdf","jpg","jpeg","png"])) {
           return back()->withErrors(["msg"=>"File yang diperbolehkan adalah (jpg,png,pdf)"]);
         }
         $destinationPath = public_path('/upload');
         $save = $image->move($destinationPath, $name);
         if (!$save) {
           return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
         }
         $data["bukti"] = $name;
         $data["persetujuan_harga"] = 0;
       }
      $ins = PoDetail::create($data);
      if ($ins) {
        return back()->with("msg","Sukses Simpan Data");
      }else {
        return back()->withErrors(["msg"=>"Gagal Simpan Data"]);
      }
    }
    public function po_add_continue_cancel(Request $req,$id)
    {
      $cek = Po::findOrFail($id);
      $delmass = PoDetail::where(["no_po"=>$id])->delete();
      $cek->delete();
      return redirect(route("po.index"))->with("msg","Pesanan Telah Di Batalkan");
    }
    public function retur_index()
    {
      $data["title"] = "Data Retur";
      $data["retur"] = Retur::all();
      return view("admin_gudang.retur_index")->with($data);
    }
    public function retur_detail($id)
    {
      $cek = \App\Model\ReturDetail::where(["no_retur"=>$id]);
      // echo $cek->count();
      if ($cek->count() < 1) {
        return back();
      }
      $data["data"] = $cek->get();
      $data["retur"] = $cek->first();
      $data["title"] = "Detail Retur [{$id}]";
      return view("admin_gudang.retur_detail")->with($data);
    }

    public function retur_update_action(Request $req,$id,$status)
    {
      $find = Retur::findOrFail($id);
      $x = $find->update(["status"=>$status]);
      if ($x) {
        $set = ReturDetail::where(["no_retur"=>$id])->get();
        foreach ($set as $key => $value) {
          $smp = Barang::where(["kode_barang"=>$value->kode_barang]);
          $stok = $smp->first()->stok_awal;
          $smp->update(["stok_awal"=>($stok-$value->total_retur)]);
        }
        return back()->with("msg","Data Berhasil Di Update");
      }else {
        return back()->withError("msg","Data Gagal Di Update");
      }
    }
    public function retur_add()
    {
      $data["title"] = "Tambah Pengajuan Retur";
      $data["po"] = Po::where(["status"=>"selesai","validasi"=>"disetujui"])->get();
      // echo Po::where(["status"=>"selesai"])->count();
      $data["no_retur"] = "R".date("dmy")."-".(Retur::whereDate("tanggal_retur",">=",date("Y-m-d"))->count() + 1);
      return view("admin_gudang.retur_add")->with($data);
    }
    public function retur_add_action(Request $req)
    {
      $req->validate([
        "no_retur"=>"required|unique:retur,no_retur",
        "no_po"=>"required"
      ]);
      $save = Retur::create($req->all());
      if ($save) {
        return redirect(route("retur.step",$req->no_retur));
      }else {
        return back()->withErrors(["msg"=>"Gagal Meyimpan Data"]);
      }
    }
    public function retur_step($id)
    {
      $cek = Retur::where(["no_retur"=>$id]);
      $poItem = PoDetail::where(["no_po"=>$cek->first()->no_po])->get();
      $data["poItem"] = $poItem;
      $data["title"] = "Retur Barang PO [{$id}]";
      $data["no_retur"] = $id;
      return view("admin_gudang.retur_step")->with($data);
    }
    public function retur_step_action(Request $req,$id)
    {
      $req->validate([
        "no_retur"=>"required",
        "kode_barang"=>"required",
        "total_retur"=>"required|numeric",
      ]);
      $cek = Retur::where(["no_retur"=>$req->no_retur])->first()->no_po;
      $set = PoDetail::where(["no_po"=>$cek,"kode_barang"=>$req->kode_barang])->first()->total_terima;
      if ($req->total_retur > $set) {
        return back()->withErrors(["msg"=>"Total retur melebihi total terima"]);
      }
      $ins = ReturDetail::create($req->all());
      if ($ins) {
        return back()->with("msg","Sukses Simpan Data");
      }else {
        return back()->withErrors(["msg"=>"Gagal Simpan Data"]);
      }
    }
    public function retur_step_cancel (Request $req,$id){
      $cek = Retur::findOrFail($id);
      $delmass = Retur::where(["no_retur"=>$id])->delete();
      $cek->delete();
      return redirect(route("retur.index"))->with("msg","Pesanan Telah Di Batalkan");
    }
    public function laporan_index()
    {
      $data["title"] = "Laporan";
      return view("admin_gudang.laporan")->with($data);
    }
    public function laporan_aksi(Request $req)
    {
      $req->validate([
        "mulai"=>"required",
        "sampai"=>"required",
        "kategori"=>"required",
      ]);
      if ($req->kategori == "barangmasuk") {
        // whereBetween
        $data["mulai"] = $req->mulai;
        $data["sampai"] = $req->sampai;
        $data["list"] = Barang::whereBetween("tgl_buat",[$data["mulai"],$data["sampai"]])->get();
        $pdf = PDF::loadView('pdf.barangmasuk', $data)->setPaper('a4', 'landscape');
        return $pdf->download('barangmasuk_'.time().'.pdf');
      }elseif ($req->kategori == "permintaanbarang") {
        $data["mulai"] = $req->mulai;
        $data["sampai"] = $req->sampai;
        $data["list"] = PermintaanDetail::whereBetween("tgl_buat",[$data["mulai"],$data["sampai"]])->get();
        $pdf = PDF::loadView('pdf.permintaanbarang', $data)->setPaper('a4', 'landscape');
        return $pdf->download('permintaanbarang_'.time().'.pdf');
      }elseif ($req->kategori == "returbarang") {
        $data["mulai"] = $req->mulai;
        $data["sampai"] = $req->sampai;
        $data["list"] = ReturDetail::whereBetween("tgl_buat",[$data["mulai"],$data["sampai"]])->get();
        $pdf = PDF::loadView('pdf.returbarang', $data)->setPaper('a4', 'landscape');
        return $pdf->download('returbarang_'.time().'.pdf');
      }elseif ($req->kategori == "rekap") {
        $pdf = PDF::loadView('pdf.rekap', $data)->setPaper('a4', 'landscape');
        return $pdf->download('rekap_'.time().'.pdf');
      }

    }
}
