<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/3/28
 * Time: 15:31
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * 静态页面调节路由
 * Class PageController
 * @package App\Http\Controllers
 */
class PageController extends Controller
{
    /**
     * 静态页面主要方法
     * @param Request $request
     * @param $pageName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page(Request $request, $pageName = null)
    {
        if (is_null($pageName)) {
            return view('function_list');
        } else {
            return view('function.'.$pageName);
        }
    }

    public function login()
    {
        if(Session::has('user_id'))
            return response()->redirectTo('functions');
        return view('login');
    }

    public function changeInfo()
    {
        return view('change_info', [
           'menu' => 'change_info'
        ]);
    }


    public function character_testing()//专业兴趣测评界面
    {
        $name = urlencode(iconv("utf-8","gbk//IGNORE",session('name')));
        $data=['name'=>$name,'classify'=>session('classify'),'id'=>date('YmdHis').session('user_id')];
        return view('function.character_testing')->with('data',$data);
    }

    public function change_info()
    {
        return view('change_info');
    }

    public function info()
    {
        return view('user_center');
    }

}