<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/3/29
 * Time: 15:06
 */

namespace App\Http\Controllers;
use App\Model\SchoolInfoModel;
use Illuminate\Http\Request;

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
    }

    /**
     * 获取指定文、理科，和批次的学校列表及其基本信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSchoolList(Request $request)
    {
//        $this->validate($request, [
  //          'classify' => 'required|integer',
    //        'batch' => 'required|integer',
      //  ]);
        $res = SchoolInfoModel::select('school_id', 'name', 'city', 'province', 'rank','score_arg', 'position_arg', 'num_arg','page', 'gz')
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