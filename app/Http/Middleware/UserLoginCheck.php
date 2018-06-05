<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/5/25
 * Time: 21:05
 */

namespace App\Http\Middleware;


use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Session;

class UserLoginCheck
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if(Session::has('user_id'))
            return $next($request);
        else
            return redirect('/login');
    }
}