<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/4/29
 * Time: 14:12
 */

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Model\AccountModel;

class characterController extends Controller
{
    public function character_testing(){

    }

    public function get_report(){
        $report = AccountModel::select('report_id','liangbiao')->where('user_id',session('user_id'))->first();
        if($report->report_id != ''){
            return response()->json([
                'status'=>true,
                'data'=>$report
            ]);
        }else{
            return response()->json([
                'status'=>false
            ]);
        }
    }

    //未来移动端可能用到的渲染专业兴趣测评界面的接口
//    public function get_message(){
//        $name = urlencode(iconv("utf-8","gbk//IGNORE",session('name')));
//        $data=['name'=>$name,'classify'=>session('classify'),'id'=>date('YmdHis').session('user_id')];
////        $data=['name'=>$name,'classify'=>session('classify'),'id'=>session('user_id')];
//        return response()->json([
//            'status'=>true,
//            'data'=>$data
//        ]);
//    }
}