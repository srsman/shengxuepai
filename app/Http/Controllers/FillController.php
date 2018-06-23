<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/3/29
 * Time: 15:06
 */

namespace App\Http\Controllers;
use App\Model\MajorInfoModel;
use App\Model\SchoolInfoModel;
use App\Model\ScoreBasicModel;
use App\Model\UserModel;
use App\Model\VolunteerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * 志愿填报控制器
 * Class FillController
 * @package App\Http\Controllers
 */
class FillController extends Controller
{
    public function test()
    {
        /*        $res = SchoolInfoModel::select('school_id', 'min_score', 'min_score_1','min_score_2','min_score_3', 'wc_1', 'wc_2', 'wc_3', 'l_1', 'l_2', 'l_3', 'l_4')->get();
                foreach ($res as $row) {
                    $arg1 = json_encode([
                        'score' => $row->min_score,
                        '2017' => $row->min_score_1,
                        '2016' => $row->min_score_2,
                        '2015' => $row->min_score_3
                    ]);
                    $arg2 = json_encode([
                        '2017' => $row->wc_1,
                        '2016' => $row->wc_2,
                        '2015' => $row->wc_3,
                    ]);
                    $arg3 = json_encode([
                        '2017' => $row->l_1,
                        '2016' => $row->l_2,
                        '2015' => $row->l_3,
                        '2018' => $row->l_4,
                    ]);
                    SchoolInfoModel::where('school_id', $row->school_id)
                        ->update([
                            'score_arg' => $arg1,
                            'position_arg' => $arg2,
                            'num_arg' => $arg3
                        ]);
                }*/
        /*        $res = SchoolInfoModel::select('school_id', 'batch')->get();
                foreach ($res as $row) {
                    SchoolInfoModel::where('school_id', $row->school_id)
                        ->update([
                           'batch' => $row->batch == '提前批' ? 0 : ($row->batch == '本一批' ? 1 : 2)
                        ]);
                }*/
        /*$res = VolunteerModel::get()->toArray();
        foreach ($res as $row) {
            $arg = [
                'o' => $row['dx_tp_1']
            ];
            for($i = 1; $i <= 6; $i++) {
                $arg[] = [
                    's'.$i => $row["school_{$i}"],
                    "m{$i}_1" => $row["major_{$i}_1"],
                    "m{$i}_2" => $row["major_{$i}_2"],
                    "m{$i}_3" => $row["major_{$i}_3"],
                    "m{$i}_4" => $row["major_{$i}_4"],
                    "m{$i}_5" => $row["major_{$i}_5"],
                    "m{$i}_6" => $row["major_{$i}_6"],
                    'o' => $row['zy_tp_1'],
                ];
            }
            $code = VolunteerModel::where('volunteer_id', $row['volunteer_id'])
                ->update(['volunteer_arg' => json_encode($arg)]);
            if($code != 1)
            {
                echo "false";
                break;
            }
        }*/
    }

    /**
     * 获取指定文、理科，和批次的学校列表及其基本信息
     * classify => [1 > 文科，2 > 理科]
     * batch => [0 > 提前批, 1 > 本一批, 2 > 本二批
     * simple 提供简要信息
     * 这个接口只在每次页面进入时调用一次，将来可采用缓存
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSchoolList(Request $request)
    {
        $this->validate($request, [
            'classify' => 'required|integer',
            'batch' => 'required|integer',
        ]);

        if ($request->get('simple')) {
            $res = SchoolInfoModel::select('school_id', 'name', 'city', 'province', 'score_arg')
                ->where([
                    ['classify', $request->get('classify')],
                    ['batch', $request->get('batch')],
                ])->get();

            $data = [];
            foreach ($res as $row) {
                $tmp = [];
                $tmp['school_id'] = $row->school_id;
                $tmp['name'] = $row->name;
                $tmp['address'] = $row->province .'-'.$row->city;
                $s_array = json_decode($row->score_arg, true);

                $tmp['infos'] = [
                    $s_array['2017'],
                    $s_array['2016'],
                    $s_array['2015']
                ];

                $data[] = $tmp;
            }

            return response()->json([
                'status' => true,
                'data' => $data
            ]);

        } else {
            $res = SchoolInfoModel::select('school_id', 'name', 'city', 'province', 'rank', 'score_arg', 'position_arg', 'num_arg', 'page', 'gz')
                ->where([
                    ['classify', $request->get('classify')],
                    ['batch', $request->get('batch')],
                ])->get();

            $data = [];
            foreach ($res as $row) {
                $tmp = [];
                $tmp['school_id'] = $row->school_id;
                $tmp['name'] = $row->name;
                $tmp['address'] = $row->province .'-'.$row->city;
                $tmp['rank'] = $row->rank;
                $s_array = json_decode($row->score_arg, true);
                $p_array = json_decode($row->position_arg, true);
                $n_array = json_decode($row->num_arg, true);

                $tmp['infos'] = [
                    '2017' => [
                        $s_array['2017'],$p_array['2017'],$n_array['2017']
                    ],
                    '2016' => [
                        $s_array['2016'],$p_array['2016'],$n_array['2016']
                    ],
                    '2015' => [
                        $s_array['2015'],$p_array['2015'],$n_array['2015']
                    ],
                    '2018' => [
                        $n_array['2018'], $row->page
                    ]
                ];

                $data[] = $tmp;
            }

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        }
    }

    /**
     * 获取指定学校、指定文理科，批次的专业列表及其信息
     * name 学校名称 url_encode后的内容
     * classify 同上
     * batch 同上
     * 目前该接口在每次点击选择学校时都会被调用，每个学校专业并不多，不会特别影响，
     * 未来可考虑一次性载入15条数据的方式。
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSchoolMajor(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|string',
            'classify' => 'required|int',
            'batch' => 'required|int'
        ]);

        $res = MajorInfoModel::select('year', 'major_name', 'min_score', 'differ', 'number')
            ->where([
                ['school_name', $request->name],
                ['classify', $request->classify],
                ['batch', $request->batch],
            ])->get();
        $res = $res->toArray();
        return response()->json([
           'status' => true,
           'data' => $res,
        ]);
    }

    /**
     * 保存志愿表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function insertVolunteer(Request $request)
    {
        $this->validate($request, [
                'table_name' => 'required|string',
                'batch' => 'required|int',
                'type' => 'required|int',
            ]);
        $uid = Session::get('user_id');
        $name = $request->get('table_name');
        $batch = $request->get('batch');
        $type = $request->get('type');
        $classify = Session::get('classify') == "文科" ? 1 : 2;
        $volunteer_arg = $request->get('info');

        $pid = VolunteerModel::insertGetId([
           'user_id' => $uid,
           'table_name' => $name,
           'batch' => $batch,
            'type' => $type,
            'classify' => $classify,
            'volunteer_arg' => $volunteer_arg,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return response()->json([
           'status' => $pid > 0 ? true : false
        ]);

    }

    /**
     * 志愿选择方法，根据指定分数选择合理的批次，并安排下一个页面的数据来源
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function volunteerSelect(Request $request)
    {
        $scores = ScoreBasicModel::select('score', 'name', 'type', 'batch')
            ->where([
                ['year', '2017'],
                ['type', Session::get('classify') == '文科' ? 1 : 2]
            ])->get();
        $score = UserModel::select('score_arg')->where('user_id', Session::get('user_id'))->first();

        $score = json_decode($score->score_arg, true);

        if (isset($score['score'])) {

            $flagName = $scores[0]->name;

            foreach ($scores as $row) {
                if ($score['score'] <= $row->score) {
                    $flagName = $row->name;
                }
            }

            return view('function.volunteer_select', [
                'scores' => $scores,
                'flag' => $flagName,
            ]);
        } else {   //没有填写分数
            return view('info', [
                'info' => '您还有填写高考成绩，3s后将会自动跳转到个人信息页面。<br/>如果没有跳转，<a href="'.URL('user/info').'">请点击这里</a>',
                'url' => URL('user/info')
            ]);   //填写高考信息
        }
    }

    public function volunteerAdd(Request $request, $type, $batch)
    {
        if ($type == 'gaokao')
            $t = 1;
        else
            $t = 2;
        if ($batch == 0)
            $name = "本科提前批";
        else if ($batch == 1)
            $name = "本科第一批";
        else if ($batch == 2)
            $name = "本科第二批";
        else
            $name = "专科第一批";

        return view('function.volunteer_fill', [
            'type' => $t,
            'batch' => (int)$batch,
            'batchName' => $name,
            'nums' => "一二三四五六"

        ]);
    }

}