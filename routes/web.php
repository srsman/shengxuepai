<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PageController@login');
Route::get('login', 'PageController@login');
Route::post('user/login', 'UserController@login');
Route::post('user/register', 'UserController@register');
Route::post('user/send', 'UserController@sms');
Route::post('user/check', 'UserController@check');
Route::post('user/forget', 'UserController@forget');
Route::post('user/modify', 'UserController@modify');

Route::group(['middleware' => 'userLoginCheck'], function() {

    Route::get('logout', 'UserController@logout');


    Route::get('school/detail', 'SchoolController@detail');
    Route::get('fill/get_major','FillController@getSchoolMajor');
    Route::get('user/info', 'UserController@userInfo');
    Route::get('user/secret', 'UserController@secret');
    Route::post('user/rank', 'UserController@rank');  //高考位次查询
    Route::post('user/update', 'UserController@update'); //更新用户信息


    ///////////静态页面 请求路由如下：
    Route::get('/functions','PageController@functions');        //列表
    Route::get('functions/gaokao_volunteer_fill','PageController@page');  //高考志愿填报
    Route::get('functions/school_view','PageController@page');           //目标院校展示
    Route::get('functions/major_view','PageController@page');            //目标专业展示
    Route::get('functions/compare','PageController@page');          //目标专业展示
    Route::get('functions/order', 'PageController@page');           //一对一专家预约
    Route::get('functions/cooperation','PageController@page');      //中外合作办学展示
    Route::get('functions/character_test','PageController@page');   //专业兴趣测评介绍界面

    Route::get('functions/character_testing','CharacterController@get_report');          //专业兴趣测评界面
    Route::get('functions/score_report','PageController@page');        //我的成绩分析界面
    Route::get('functions/university_rank','PageController@page');             //中国大学排行榜界面
    Route::get('functions/minority','PageController@page');         //少数民族预科
    Route::get('functions/class_select','PageController@page');     //国家专项界面
    Route::get('functions/zs','PageController@page');               //自主招生展示
    Route::get('functions/buy','PageController@page');              //购买界面
    Route::get('functions/my_volunteer','PageController@page');     //我的志愿表
    Route::get('change_info', 'PageController@change_info');


    Route::any('fill/get_school', 'FillController@getSchoolList');
    Route::any('/cooperation/get_school','CooperationController@get_school');//中外合作办学展示
//Route::any('zs/zz','ZsController@zz');//自招数据处理
    Route::any('zs/get_school','ZsController@get_school');//自主招生院校数据查询
    Route::any('school/get','SchoolController@getSchool');//目标院校查询
    Route::any('major/get','MajorController@getMajors');//目标专业查询
    Route::any('cooperation/get_major','CooperationController@get_Major');//中外合作办学查询
    Route::any('character/get_report','CharacterController@get_report');//专业兴趣测评查询
    Route::any('/character/get_message','CharacterController@get_message');//专业兴趣测评模板渲染
    Route::any('Analysis/get_lever','AnalysisController@get_level');//我的成绩分析查询
    Route::any('rank/get_school','RankController@get_school');//院校排名查询
    Route::any('minority/get','MinorityController@get_school');//少数民族预科
    Route::any('class_select/get','Class_selectController@get_school');//国家专项
    Route::any('buy/get_order','BuyController@get_order');//获取订单号
    Route::any('buy/pay','BuyController@pay');//购买过程处理
    Route::any('login/tz','NotifyController@alipay');//支付宝回掉跳转
    Route::any('buy/state_change','BuyController@state_change');//微信支付ajax轮询查订单状态
    Route::any('mobie/state_change','BuyController@state_change');//支付宝移动支付回调页面
    Route::any('alipay/change','BuyController@state_change');//支付宝移动支付异步回调
});
