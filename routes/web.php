<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect("login");
});
Route::get('/logout', function () {
    session()->flush();
    return redirect("login");
});

Route::get('/login',"LoginControl@index");
Route::post('/login',"LoginControl@login")->name("login");
Route::group(['middleware' => ['toko']], function () {
  Route::get('/rendalumum',"TokoControl@index")->name("home_toko");
  Route::get('/rendalumum/permintaan',"TokoControl@permintaan_index")->name("permintaan_toko.index");
  Route::get('/rendalumum/permintaan/add',"TokoControl@permintaan_add")->name("permintaan_toko.add");
  Route::post('/rendalumum/permintaan/add',"TokoControl@permintaan_add_action")->name("permintaan_toko.add_action");
  Route::get('/rendalumum/permintaan/step/{id}',"TokoControl@permintaan_add_continue")->name("permintaan_toko.add_continue");
  Route::post('/rendalumum/permintaan/step/{id}',"TokoControl@permintaan_add_continue_action")->name("permintaan_toko.add_continue_action");
  Route::get('/rendalumum/permintaan/step/{id}/cancel',"TokoControl@permintaan_add_continue_cancel")->name("permintaan_toko.add_continue_cancel");
  Route::get('/rendalumum/permintaan/detail/{id}',"TokoControl@permintaan_detail")->name("permintaan_toko.detail");

});
Route::group(['middleware' => ['gudang']], function () {
  Route::get('/rendalmaterial/laporan',"GudangControl@laporan_index")->name("laporan_gudang.index");
  Route::post('/rendalmaterial/laporan',"GudangControl@laporan_aksi")->name("laporan_gudang.index.aksi");
  //Lapoan
  Route::get('/rendalmaterial',"GudangControl@index")->name("home_gudang");

  //Kategori
  Route::get('/rendalmaterial/kategori',"GudangControl@kategori_index")->name("kategori.index");
  Route::get('/rendalmaterial/kategori/add',"GudangControl@kategori_add")->name("kategori.add");
  Route::post('/rendalmaterial/kategori/add',"GudangControl@kategori_add_action")->name("kategori.add_action");
  Route::get('/rendalmaterial/kategori/update/{id}',"GudangControl@kategori_update")->name("kategori.update");
  Route::post('/rendalmaterial/kategori/update/{id}',"GudangControl@kategori_update_action")->name("kategori.update_action");
  Route::get('/rendalmaterial/kategori/delete/{id}',"GudangControl@kategori_delete")->name("kategori.delete");
  //Warna
  Route::get('/rendalmaterial/warna',"GudangControl@warna_index")->name("warna.index");
  Route::get('/rendalmaterial/warna/add',"GudangControl@warna_add")->name("warna.add");
  Route::post('/rendalmaterial/warna/add',"GudangControl@warna_add_action")->name("warna.add_action");
  Route::get('/rendalmaterial/warna/update/{id}',"GudangControl@warna_update")->name("warna.update");
  Route::post('/rendalmaterial/warna/update/{id}',"GudangControl@warna_update_action")->name("warna.update_action");
  Route::get('/rendalmaterial/warna/delete/{id}',"GudangControl@warna_delete")->name("warna.delete");
  //Barang
  Route::get('/rendalmaterial/barang',"GudangControl@barang_index")->name("barang.index");
  Route::get('/rendalmaterial/barang/add',"GudangControl@barang_add")->name("barang.add");
  Route::post('/rendalmaterial/barang/add',"GudangControl@barang_add_action")->name("barang.add_action");
  Route::get('/rendalmaterial/barang/update/{id}',"GudangControl@barang_update")->name("barang.update");
  Route::post('/rendalmaterial/barang/update/{id}',"GudangControl@barang_update_action")->name("barang.update_action");
  Route::get('/rendalmaterial/barang/delete/{id}',"GudangControl@barang_delete")->name("barang.delete");
  //Permintaan
  Route::get('/rendalmaterial/permintaan',"GudangControl@permintaan_index")->name("permintaan.index");
  Route::get('/rendalmaterial/permintaan/update/{id}/{status}',"GudangControl@permintaan_update_action")->name("permintaan.update_action");
  Route::get('/rendalmaterial/permintaan/delete/{id}',"GudangControl@permintaan_delete")->name("permintaan.delete");
  Route::get('/rendalmaterial/permintaan/detail/{id}',"GudangControl@permintaan_detail")->name("permintaan.detail");
  //PO
  Route::get('/rendalmaterial/po',"GudangControl@po_index")->name("po.index");
  Route::get('/rendalmaterial/po/add',"GudangControl@po_add")->name("po.add");
  Route::get('/rendalmaterial/po/hapus/{id}',"GudangControl@po_hapus")->name("po.hapus");
  Route::post('/rendalmaterial/po/add',"GudangControl@po_add_action")->name("po.add_action");
  Route::post('/rendalmaterial/po/terima/{id}',"GudangControl@po_terima")->name("po.terima");
  Route::post('/rendalmaterial/po/retur/{id}',"GudangControl@po_retur")->name("po.retur");
  Route::get('/rendalmaterial/po/step/{id}',"GudangControl@po_add_continue")->name("po.add_continue");
  Route::post('/rendalmaterial/po/step/{id}',"GudangControl@po_add_continue_action")->name("po.add_continue_action");
  Route::get('/rendalmaterial/po/step/{id}/cancel',"GudangControl@po_add_continue_cancel")->name("po.add_continue_cancel");
  Route::get('/rendalmaterial/po/detail/{id}',"GudangControl@po_detail")->name("po.detail");
  //Retur
  Route::get('/rendalmaterial/retur',"GudangControl@retur_index")->name("retur.index");
  Route::get('/rendalmaterial/retur/add',"GudangControl@retur_add")->name("retur.add");
  Route::post('/rendalmaterial/retur/add',"GudangControl@retur_add_action")->name("retur.add_action");
  Route::get('/rendalmaterial/retur/update/{id}',"GudangControl@retur_update")->name("retur.update");
  Route::get('/rendalmaterial/retur/update/{id}/{status}',"GudangControl@retur_update_action")->name("retur.update_action");
  Route::get('/rendalmaterial/retur/delete/{id}',"GudangControl@retur_delete")->name("retur.delete");
  Route::get('/rendalmaterial/retur/detail/{id}',"GudangControl@retur_detail")->name("retur.detail");
  Route::get('/rendalmaterial/retur/step/{id}',"GudangControl@retur_step")->name("retur.step");
  Route::post('/rendalmaterial/retur/step/{id}',"GudangControl@retur_step_action")->name("retur.step_action");
  Route::get('/rendalmaterial/retur/step/{id}/cancel',"GudangControl@retur_step_cancel")->name("retur.step_cancel");
  //Suplier
  Route::get('/rendalmaterial/suplier',"GudangControl@suplier_index")->name("suplier.index");
  Route::get('/rendalmaterial/suplier/add',"GudangControl@suplier_add")->name("suplier.add");
  Route::post('/rendalmaterial/suplier/add',"GudangControl@suplier_add_action")->name("suplier.add_action");
  Route::get('/rendalmaterial/suplier/update/{id}',"GudangControl@suplier_update")->name("suplier.update");
  Route::post('/rendalmaterial/suplier/update/{id}',"GudangControl@suplier_update_action")->name("suplier.update_action");
  Route::get('/rendalmaterial/suplier/delete/{id}',"GudangControl@suplier_delete")->name("suplier.delete");
  //Laporan




});
Route::group(['middleware' => ['kepala']], function () {
  Route::get('/manajer',"KepalaControl@index")->name("kepala_home");
  Route::get('/manajer/po',"KepalaControl@po_index")->name("po_kepala.index");
  Route::get('/manajer/po/detail/{id}',"KepalaControl@po_detail")->name("po_kepala.detail");
  Route::get('/manajer/po/detail/{id}/{status}',"KepalaControl@po_update_action")->name("po_kepala.update");
  //Kategori
  Route::get('/manajer/kategori',"KepalaControl@kategori_index")->name("kepala.kategori.index");
  Route::get('/manajer/kategori/add',"KepalaControl@kategori_add")->name("kepala.kategori.add");
  Route::post('/manajer/kategori/add',"KepalaControl@kategori_add_action")->name("kepala.kategori.add_action");
  Route::get('/manajer/kategori/update/{id}',"KepalaControl@kategori_update")->name("kepala.kategori.update");
  Route::post('/manajer/kategori/update/{id}',"KepalaControl@kategori_update_action")->name("kepala.kategori.update_action");
  Route::get('/manajer/kategori/delete/{id}',"KepalaControl@kategori_delete")->name("kepala.kategori.delete");
  //Warna
  Route::get('/manajer/warna',"KepalaControl@warna_index")->name("kepala.warna.index");
  Route::get('/manajer/warna/add',"KepalaControl@warna_add")->name("kepala.warna.add");
  Route::post('/manajer/warna/add',"KepalaControl@warna_add_action")->name("kepala.warna.add_action");
  Route::get('/manajer/warna/update/{id}',"KepalaControl@warna_update")->name("kepala.warna.update");
  Route::post('/manajer/warna/update/{id}',"KepalaControl@warna_update_action")->name("kepala.warna.update_action");
  Route::get('/manajer/warna/delete/{id}',"KepalaControl@warna_delete")->name("kepala.warna.delete");
  //Barang
  Route::get('/manajer/barang',"KepalaControl@barang_index")->name("kepala.barang.index");
  Route::get('/manajer/barang/add',"KepalaControl@barang_add")->name("kepala.barang.add");
  Route::post('/manajer/barang/add',"KepalaControl@barang_add_action")->name("kepala.barang.add_action");
  Route::get('/manajer/barang/update/{id}',"KepalaControl@barang_update")->name("kepala.barang.update");
  Route::post('/manajer/barang/update/{id}',"KepalaControl@barang_update_action")->name("kepala.barang.update_action");
  Route::get('/manajer/barang/delete/{id}',"KepalaControl@barang_delete")->name("kepala.barang.delete");
});
Route::group(['middleware' => ['keuangan']], function () {
  Route::get('/juniormanajergudang',"KeuanganControl@index")->name("keuangan");
  Route::get('/juniormanajergudang/validasi',"KeuanganControl@validasi")->name("validasi.index");
  Route::get('/juniormanajergudang/validasi_perubahan/{kode}/{status}',"KeuanganControl@validasi_perubahan")->name("keuangan.validasi.perubahan");
  Route::get('/juniormanajergudang/validasi/po/{id}',"KeuanganControl@validasi_po")->name("validasi.po.detail");
  Route::get('/juniormanajergudang/validasi/po/{id}/terima',"KeuanganControl@validasi_po_terima")->name("validasi.po.terima");
  Route::get('/juniormanajergudang/validasi/po/{id}/tolak',"KeuanganControl@validasi_po_tolak")->name("validasi.po.tolak");
  Route::get('/juniormanajergudang/validasi/retur/{id}',"KeuanganControl@validasi_retur")->name("validasi.retur.detail");
  Route::get('/juniormanajergudang/validasi/retur/{id}/tolak',"KeuanganControl@validasi_po_tolak")->name("validasi.retur.tolak");
  Route::get('/juniormanajergudang/validasi/retur/{id}/terima',"KeuanganControl@validasi_retur_terima")->name("validasi.retur.terima");
});
