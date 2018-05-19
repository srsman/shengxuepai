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
        if(!is_null($report)){
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
}