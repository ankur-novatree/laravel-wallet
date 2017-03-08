<?php

namespace Novatree\Wallet\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Redirect;
class WalletMiddleware
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
        $admin_value = Session::get('admin_login');
        if($admin_value == TRUE) {
            return $next($request);
        }
        else {
            return redirect('admin/login')->with('error','Invalid Login');
        }

    }
}
