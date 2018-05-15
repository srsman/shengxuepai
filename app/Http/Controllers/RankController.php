<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/5/10
 * Time: 10:49
 */

namespace App\Http\Controllers;


use App\Model\HuadongModel;
use App\Model\SoftModel;
use App\Model\ChinaModel;
use App\Model\ChinamatesModel;
use App\Model\ChinamatesofModel;
use App\Model\WushulianfModel;
use App\Model\WushulianooModel;
use App\Model\WushulianModel;
use Illuminate\Http\Request;

class RankController extends Controller
{
    public function get_school(Request $request){
        if($request->id == 0){
            $school = ChinaModel::select('rank','school_name','score','belong','star_rank','school_rank','province','public')->get();
        }elseif ($request->id == 1){
            $school = WushulianModel::select('rank','school_name','score','rencai','yanjiu','benke','kexue','ziran','shehui','province','province_rank','leixing','ck_leixing1','ck_leixing2')->get();
        }elseif ($request->id == 2){
            $school = SoftModel::select('rank','school_name','province','score','zb_score')->get();
        }elseif ($request->id == 3){
            $school = ChinamatesModel::select('rank','school_name','province','score','leixing','star_ranking','cengci')->get();
        }elseif ($request->id == 4){
            $school = WushulianfModel::select('rank','school_name','province','score','rc_score','kx_score','province_rank','lx','lx1','lx2')->get();
        }elseif ($request->id == 5){
            $school =ChinamatesofModel::select('rank','school_name','province','score','lx','star_rank','cengci','xingzhi')->get();
        }elseif ($request->id == 6){
            $school = WushulianooModel::select('rank','school_name','province','score','rc_score','kx_score','province_rank','lx','lx1','lx2')->get();
        }elseif ($request->id == 7){
            $school = HuadongModel::select('rank','name','number','junyi','fenbu','class_number')->get();
        }
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