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
    public function show(){
        return view('zs.zs');
    }

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
        $res = ZsModel::select('province','name','year_2017','year_2016','teacher')->get();
        $data=[];
        foreach ($res as $row){
            $tmp=[];
            $tmp['province']=$row->province;
            $tmp['school_name']=$row->name;
            $arr_2017=json_decode($row->year_2017,true);
            $arr_2016=json_decode($row->year_2016,true);
            $arr_teacher=json_decode($row->teacher,true);
            $tmp['infos']=[
                '2017'=>[
                    $arr_2017['number_2017'],
                    $arr_2017['pass1_2017'],
                    $arr_2017['passlv1_2017'],
                    $arr_2017['plan_2017'],
                    $arr_2017['pass2_2017'],
                    $arr_2017['passlv2_2017'],
                ],
                '2016'=>[
                    $arr_2016['number_2016'],
                    $arr_2016['pass1_2016'],
                    $arr_2016['passlv1_2016'],
                    $arr_2016['plan_2016'],
                    $arr_2016['pass2_2016'],
                    $arr_2016['passlv2_2016'],
                ],
                'teacher'=>[
                    $arr_teacher['local_lv'],
                    $arr_teacher['sichuan_first_number'],
                    $arr_teacher['sichuan_next_number'],
                ]
            ];
            $data[]=$tmp;
        }
        return response()->json([
            'status'=>true,
            'data'=>$data
        ]);
    }
}