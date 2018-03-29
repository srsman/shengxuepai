<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/3/28
 * Time: 15:31
 */

namespace App\Http\Controllers;
/**
 * 静态页面调节路由
 * Class PageController
 * @package App\Http\Controllers
 */
class PageController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function functions()
    {
        return view('function_list', [
            'menu' => 'function_list',
        ]);
    }

    public function changeInfo()
    {
        return view('change_info', [
           'menu' => 'change_info'
        ]);
    }
}