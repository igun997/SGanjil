<?php

namespace App\Http\Middleware;

use Closure;

class Kepala
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
      if (session()->get("level") == "kepala_gudang") {
        return $next($request);
      }
      return redirect("login")->withErrors(["msg"=>"Hak Akses Terbatas"]);
  }
}
