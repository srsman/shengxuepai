<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/4/14
 * Time: 9:20
 */

namespace App\Http\Controllers;


use App\Model\SchoolBasicModel;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function test()
    {
        /*$res = SchoolBasicModel::select('ranking_1', 'id')->where('ranking_1', '')->get();
        foreach ($res as $row) {
            SchoolBasicModel::where('id', $row->id)
                ->update([
                    'ranking_1' => null
                ]);
        }*/
       /* $res = SchoolBasicModel::select('id', 'c_xk_1_1', 'c_xk_1_2', 'c_xk_1', 'c_xk_b_1', 'c_xk_b_2', 'c_xk_s_1', 'c_xk_s_2')->get();
        foreach ($res as $row) {

            $tmp = [
              $row->c_xk_1_1,
              $row->c_xk_1_2,
              $row->c_xk_1,
              $row->c_xk_b_1,
              $row->c_xk_b_2,
              $row->c_xk_s_1,
              $row->c_xk_s_2,
            ];

            SchoolBasicModel::where('id', $row->id)
                ->update(['c_xk_args' => json_encode($tmp)]);
        }*/
     /*  $res = SchoolBasicModel::select('id', 'c_best', 'c_211', 'c_985', 'zy_1','zy_2','zy_3','zy_4','zy_5')->get();
       foreach ($res as $row) {
           $tmp = 0;
           if ($row->c_best == '一流大学')
              $tmp |= 1 << 8;
           if ($row->c_best == '一流学科')
               $tmp |= 1 << 7;
           if($row->c_985 == '985')
               $tmp |= 1 << 6;
           if ($row->c_211 == '211')
               $tmp |= 1 << 5;
           if($row->zy_1 == '是')
               $tmp |= 1 << 4;
           if($row->zy_2 == '是')
               $tmp |= 1 << 3;
           if($row->zy_3 == '是')
               $tmp |= 1 << 2;
           if($row->zy_4 == '是')
               $tmp |= 1 << 1;
           if($row->zy_5 == '是')
               $tmp |= 1 << 0;

           SchoolBasicModel::where('id', $row->id)->
               update(['attr_num' => $tmp]);
       }
        echo "ok";*/
    }

    public function getSchool(Request $request)
    {
        $res = SchoolBasicModel::select('name', 'city', 'province', 'ranking_1', 'ranking_3', 'level', 'public', 'attr_num')
            ->get();
        return response()->json([
           'status' => true,
           'data' => $res,
        ]);
    }
}