<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/4/3
 * Time: 9:27
 */

namespace App\Http\Controllers;

use App\Model\Class_selectModel;
use Illuminate\Http\Request;
/**
 * 自主招生
 */
class Class_selectController extends Controller
{
    public function get_school(Request $request){
        $school = Class_selectModel::select('school_name','classify','batch','province','zx_line_2015','zx_line_2016','zx_line_2017','zx_rank_2015','zx_rank_2016','zx_rank_2017','zx_plan_2015','zx_plan_2016','zx_plan_2017','normal_line_2015','normal_line_2016','normal_line_2017')->get();
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