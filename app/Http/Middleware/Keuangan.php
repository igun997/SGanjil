<?php

namespace App\Http\Middleware;

use Closure;

class Keuangan
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
      if (session()->get("level") == "keuangan") {
        return $next($request);
      }
      return redirect("login")->withErrors(["msg"=>"Hak Akses Terbatas"]);
    }
}
