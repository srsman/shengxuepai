<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/5/10
 * Time: 10:49
 */

namespace App\Http\Controllers;


use App\Model\MinorityModel;
use Illuminate\Http\Request;

class MinorityController extends Controller
{
    public function get_school(Request $request){
        $school = MinorityModel::select('school_name','classify','batch','province','yuke_score_2015','yuke_score_2016','yuke_score_2017','yuke_rank_2015','yuke_rank_2016','yuke_rank_2017','plan_2015','plan_2016','plan_2017','no_yuke_2015','no_yuke_2016','no_yuke_2017')->get();
        if(!is_null($school)){
            return response()->json([
                'status'=>true,
                'data'=>$school
            ]);
        }else{
            return response()->json([
                'status'=>false
            ]);
        }
    }
}