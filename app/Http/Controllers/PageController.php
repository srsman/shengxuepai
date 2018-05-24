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

    public function gaokaoVolunteerFill()
    {
        return view('function.gaokao_volunteer_fill');
    }

    public function test_plug()
    {
        return view('function.test_plug');
    }

    public function major()
    {
        return view('function.major_view');
    }

    public function school()
    {
        return view('function.school_view');
    }

    public function zz()//自主招生页面
    {
        return view('function.zs');
    }

    public function cooperation()//中外合作办学界面
    {
        return view('function.cooperation');
    }

    public function character_test()//专业兴趣测评介绍界面
    {
        return view('function.character_test');
    }

    public function character_testing()//专业兴趣测评介绍界面
    {
        $name = urlencode(iconv("utf-8","gbk//IGNORE",session('name')));
        $data=['name'=>$name,'classify'=>session('classify'),'id'=>date('YmdHis').session('user_id')];
        return view('function.character_testing')->with('data',$data);
    }

    public function score_report()//我的成绩分析界面
    {
        return view('function.score_report');
    }

    public function rank()//中国大学排行榜界面
    {
        return view('function.university_rank');
    }

    public function monority()//中国大学排行榜界面
    {
        return view('function.minority');
    }

    public function class_select()//界面
    {
        return view('function.class_select');
    }

    public function buy()//界面
    {
        return view('function.buy');
    }
}