<?php

namespace App\Http\Middleware;

use Closure;

class Gudang
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
      if (session()->get("level") == "admin_gudang") {
        return $next($request);
      }
      // var_dump(session()->get("level"));
      // exit();
      return redirect("login")->withErrors(["msg"=>"Hak Akses Terbatas"]);
  }
}
