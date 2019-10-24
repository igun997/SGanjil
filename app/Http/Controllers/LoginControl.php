<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Pengguna;
class LoginControl extends Controller
{
    public function index()
    {
      return view("app.login");
    }
    public function login(Request $req)
    {
      $data = $req->all();
      unset($data["_token"]);
      $cek = Pengguna::where($data);
      if ($cek->count() > 0) {
        $sesi = ["id_pengguna"=>$cek->first()->id_pengguna,"username"=>$cek->first()->nama_pengguna,"level"=>$cek->first()->level];
        session($sesi);
        if ($sesi["level"] == "admin_toko") {
          $redir = url("rendalumum");
        }elseif ($sesi["level"] == "admin_gudang") {
          $redir = url("rendalmaterial");
        }elseif ($sesi["level"] == "kepala_gudang") {
          $redir = url("manajer");
        }elseif ($sesi["level"] == "keuangan") {
          $redir = url("juniormanajergudang");
        }
        return redirect($redir);
      }else {
        return back()->withErrors(["msg"=>"Username & Password Salah"]);
      }
    }
}
