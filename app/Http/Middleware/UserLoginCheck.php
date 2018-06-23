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
        if (Session::has('user_id')) {
            $timeLimit = "20".Session::get('time_limit');

            $year = date('Y');
            $time = mktime(0,0,0,9,1, $year);  //今年的9月1号00:00:00

            if($timeLimit < $year || ($timeLimit == $year && time() > $time))
                return redirect('/buy');
            else
                return $next($request);
        } else
            return redirect('/login');
    }
}