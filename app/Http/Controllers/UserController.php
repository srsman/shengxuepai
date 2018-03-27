<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/3/27
 * Time: 10:57
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        return response()->json([
           'status' => false,
           'info' => '数据库尚未准备好'
        ]);
    }
}