<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/3/27
 * Time: 10:57
 */

namespace App\Http\Controllers;


use App\Model\AccountModel;
use App\Model\UserModel;
use App\Model\WeiciModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Libs\dysms_php\api_demo\SmsDemo;

class UserController extends Controller
{
    /**
     * 用户登录
     * gscsdlz
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        $account = AccountModel::select('user_id', 'pass', 'user_type', 'order_id', 'time_limit')
            ->where('user', $username)
            ->orWhere('phone', $username)->first();
        if (!is_null($account)) {
            if (md5($password) == $account->pass) {

                $user = UserModel::select('name', 'sex', 'classify', 'school', 'rank_arg', 'year')
                    ->where('user_id', $account->user_id)->first();

                Session::put('user_id', $account->user_id);
                Session::put('username', $account->username);
                Session::put('user_type', $account->user_type);
                Session::put('order_id', $account->order_id);
                Session::put('time_limit', $account->time_limit == 0 ? '99' : $account->time_limit);

                if (!is_null($user)) { //激活用户

                    Session::put('name', $user->name);
                    Session::put('sex', $user->sex == 1 ? '男' : '女');
                    Session::put('school', $user->school);
                    Session::put('year', $user->year);
                    Session::put('classify', $user->classify == 1 ? '文科' : '理科');
                    $rank = json_decode($user->rank_arg, true);
                    if(isset($rank['rank']))
                        $rank = $rank['rank'];
                    else
                        $rank = '未知';
                    Session::put('rank',$rank);
                }
                return response()->json([
                    'status' => true
                ]);
            }
        }
        return response()->json([
            'status' => false,
            'info' => '用户名或密码错误'
        ]);

    }

    public function test()
    {
        $res = UserModel::select('user_id', 'score', 'score_1','score_2','score_3', 'ranking', 'ranking_1')->get();
        foreach ($res as $row) {
            $arg1 = json_encode([
                'score' => $row->score,
                'score_1' => $row->score_1,
                'score_2' => $row->score_2,
                'score_3' => $row->Score_3
            ]);
            $arg2 = json_encode([
               'rank' => $row->ranking,
               'rank_1' => $row->ranking_1
            ]);
            UserModel::where('user_id', $row->user_id)
                ->update([
                    'score_arg' => $arg1,
                    'rank_arg' => $arg2,
                ]);
        }
        echo "ok";
    }

    public function register(Request $request){
        $cellphone = $request->get('cellphone');
        $code = $request->get('code');
        $password = $request->get('password');
        $password2 = $request->get('password2');
        if($cellphone==''){
            return response()->json([
                'status' => false,
            ]);
        }else{
            $user=AccountModel::select('user_id')->where('phone',$cellphone)->get();
            if(!$user->isEmpty()){
                return response()->json([
                    'status' => false,
                    'info' => '账号已存在',
                ]);
            }
            elseif(time()-Session::get('code_time')>300){
                Session::forget('code');
                Session::forget('code_time');
                return response()->json([
                    'status' => false,
                    'info' => '验证码过期，请重新获取',
                ]);
            }elseif ($code!=Session::get('code')){
                return response()->json([
                    'status' => false,
                    'info' => '验证码错误！',
                ]);
            }elseif($password==''||$password2==''||$password!=$password2){
                return response()->json([
                    'status' => false,
                ]);
            }else{
                $user = AccountModel::insertGetId(['user'=>$cellphone,'pass'=>md5($password),'phone'=>$cellphone]);
                if($user)
                {
                    return response()->json([
                        'status' => true,
                        'info' => '注册成功！',
                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'info' => '注册失败！',
                    ]);
                }
            }
        }
    }

    public function check(){
        $phone=\request('phone');
        $user=AccountModel::select('user_id')->where('phone',$phone)->get();
        if(!$user->isEmpty()){
            echo 'yes';
        }else{
            echo 'no';
        }
    }

    public function forget(){
        $phone = \request('phone');
        $code = \request('code');
        if($code==session('code')&&$phone==session('phone')&&time()-session('code_time')<=300){
            return response()->json(['status' => true]);
        }elseif($code!=session('code')||$phone!=session('phone')||time()-session('code_time')>300){
            return response()->json([
                'status' => false,
                'info' => '验证码错误！',
            ]);
        }
    }

    public function modify(){
        $phone = \request('phone');
        $code = \request('code');
        $password1=\request('password1');
        $password2=\request('password2');
        if($phone==''||$code==''||$password1==''||$password2==''||$password1!=$password2){
            return response()->json(['status' => false]);
        }elseif($code!=session('code')||$phone!=session('phone')||time()-session('code_time')>300){
            return response()->json([
                'status' => false,
                'info' => '验证码错误！',
            ]);
        }elseif($code==session('code')&&$phone==session('phone')&&time()-session('code_time')<=300&&$password1==$password2){
            $num = AccountModel::where('phone',$phone)->update(['pass'=>md5($password1)]);
            if($num){
                return response()->json([
                    'status' => true,
                    'info' => '密码修改成功！',
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'info' => '密码修改失败！',
                ]);
            }
        }
    }

    public function sms(){
        $phone=\request('phone');
        Session::put('phone',$phone);
        $message=new SmsDemo(env('ACCESS_KEY_ID'), env('ACCESS_KEY_SECRET'));
        $response = $message->sendSms(
            "升学派", // 短信签名
            "SMS_106550081", // 短信模板编号
            "$phone", // 短信接收者
            Array(  // 短信模板中字段的值
//                "code"=>$this->Create_code(),
                "code"=>$this->Create_code(),
                "product"=>"dsd"
            ),
            "123"
        );
        $response = $message->queryDetails(
            "$phone",  // phoneNumbers 电话号码
            date('Ymd'), // sendDate 发送时间
            10, // pageSize 分页大小
            1 // currentPage 当前页码
        // "abcd" // bizId 短信发送流水号，选填
        );
        $response = (array)$response;
        if($response['Code'] == 'OK')
        {
            echo 'ok';
        }else
        {
            echo 'fail';
        }
    }

    public function Create_code(){
        $code=rand(100000,999999);
        Session::put('code',$code);
        Session::put('code_time',time());
        return $code;
    }

    /**
     * 加载用户信息
     * gscsdlz
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userInfo(Request $request)
    {
        $data = UserModel::select('province', 'city', 'region', 'school', 'grade', 'class', 'name', 'sex', 'classify', 'year', 'score_arg', 'rank_arg')
            ->where('user_id', Session::get('user_id'))
            ->first();

        $data->score = json_decode($data->score_arg, true);
        $data->rank = json_decode($data->rank_arg, true);

        return view('user_center', [
            'user' => $data,
        ]);
    }

    /**
     * 根据指定文理科和分数返回位次
     * gscsdlz
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rank(Request $request)
    {
        $score = $request->get('score');
        $type = $request->get('type');

        $rank = WeiciModel::select('count')->where([
            ['score', $score],
            ['type', $type],
        ])->first();

        if(is_null($rank)) {
            return response()->json([
                'status' => false,
            ]);
        }

        return response()->json([
            'status' => true,
            'rank' => $rank->count
        ]);
    }

    /**
     * 更新用户信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {

        $grade = $request->get('grade');
        $sex = $request->get('sex');
        $classify = $request->get('type');
        $year= $request->get('year');

        //表单简要校验
        if (!preg_match('[1|2|3]', $grade)
            || !preg_match('[1|2]', $sex)
            || !preg_match('[1|2]', $classify)
            || !preg_match('/^20\d\d$/', $year)
        ) {
            return response()->json([
                'status' => false
            ]);
        }
        $args = UserModel::select('score_arg', 'rank_arg')->where('user_id', Session::get('user_id'))->first();
        $scores = json_decode($args->score_arg, true);
        $ranks = json_decode($args->rank_arg, true);

        $score = $request->get('score');
        if($score >= 0 && $score <= 750) {
            $scores['score'] = $score;
            $ranks['rank'] = $request->get('rank');

            $scores = json_encode($scores);
            $ranks = json_encode($ranks);

        } else {
            return response()->json([
               'status' => false
            ]);
        }

        UserModel::where('user_id', Session::get('user_id'))
            ->update([
               'province' => $request->get('province'),
                'city' => $request->get('city'),
                'region' => $request->get('country'),
                'school' => $request->get('school'),
                'grade'=> $grade,
                'class'=> $request->get('classes'),
                'name'=> $request->get('name'),
                'sex'=> $sex,
                'classify'=> $classify,
                'year'=> $year,
                'score_arg' => $scores,
                'rank_arg' => $ranks
            ]);


        //刷新Session
        Session::put('name', $request->get('name'));
        Session::put('sex', $sex == 1 ? '男' : '女');
        Session::put('school', $request->get('school'));
        Session::put('year', $year);
        Session::put('classify', $classify == 1 ? '文科' : '理科');
        Session::put('rank',$request->get('rank'));

        return response()->json([
            'status' => true
        ]);
    }

    public function secret(Request $request)
    {
        return view('secret_center');
    }

    public function logout(Request $request)
    {
        Session::flush();
        return response()->redirectTo('/login');
    }
}