<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/4/3
 * Time: 9:27
 */

namespace App\Http\Controllers;

use App\Model\CooperationMajorModel;
use App\Model\CooperationModel;
use Illuminate\Http\Request;
/**
 * 自主招生
 */
class CooperationController extends Controller
{
    /***
     * 获取中外合作办学院校
     */
    public function get_school(){
        $data = CooperationModel::select('*')->get();
        return response()->json([
            'status'=>true,
            'data'=>$data
        ]);
    }

    /***
     * 获取中外合作院校专业信息
     */
    public function get_Major(Request $request){
        $this->validate($request, [
//            'name' => 'required|string',
//            'classify' => 'required|int',
//            'batch' => 'required|int'
            'id' => 'required|int'
        ]);
        $data = CooperationMajorModel::select('*')
            ->where([['school_id',$request->id]])
            ->get();
        return response()->json([
            'status'=>true,
            'data'=>$data
        ]);
    }
}