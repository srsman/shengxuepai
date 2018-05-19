<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/4/3
 * Time: 9:27
 */

namespace App\Http\Controllers;

use App\Model\ZsModel;
/**
 * 自主招生
 */
class ZsController extends Controller
{
    public function zz(){
        $res = ZsModel::select('id','new_number', 'new_first_pass', 'new_pass_lv','new_plan_zs','new_next_pass', 'new_next_pass_lv', 'old_number','old_first_pass','old_pass_lv','old_plan_zs','old_next_pass','old_next_pass_lv','local_lv','sichuan_first_number','sichuan_next_number')->get();
        foreach ($res as $row) {
            $arg1 = json_encode([
                'number_2017' => $row->new_number,
                'pass1_2017' => $row->new_first_pass,
                'passlv1_2017' => (($row->new_pass_lv)*100).'%',
                'plan_2017' => $row->new_plan_zs,
                'pass2_2017' => $row->new_next_pass,
                'passlv2_2017' => (($row->new_next_pass_lv)*100).'%'
            ]);
            $arg2 = json_encode([
                'number_2016' => $row->old_number,
                'pass1_2016' => $row->old_first_pass,
                'passlv1_2016' => (($row->old_pass_lv)*100).'%',
                'plan_2016' => $row->old_plan_zs,
                'pass2_2016' => $row->old_next_pass,
                'passlv2_2016' => (($row->old_next_pass_lv)*100).'%'
            ]);
            $arg3 = json_encode([
                'local_lv' => (($row->local_lv)*100).'%',
                'sichuan_first_number' => $row->sichuan_first_number,
                'sichuan_next_number' => $row->sichuan_next_number
            ]);
            ZsModel::where('id', $row->id)
                ->update([
                    'year_2017' => $arg1,
                    'year_2016' => $arg2,
                    'teacher' => $arg3
                ]);
        }
        echo "ok";
    }

    public function get_school(){
        $data = ZsModel::select('province','name','new_number','new_first_pass','new_pass_lv','new_plan_zs','new_next_pass','new_next_pass_lv','old_number','old_first_pass','old_pass_lv','old_plan_zs','old_next_pass','old_next_pass_lv','local_lv','sichuan_first_number','sichuan_next_number')->get();
        return response()->json([
            'status'=>true,
            'data'=>$data
        ]);
    }
}