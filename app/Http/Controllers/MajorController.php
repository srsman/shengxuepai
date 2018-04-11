<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/4/10
 * Time: 16:32
 */

namespace App\Http\Controllers;
use App\Model\MajorCategoryModel;
use Illuminate\Http\Request;

/**
 * 目标专业相关控制器
 * Class MajorController
 * @package App\Http\Controllers
 */
class MajorController extends Controller
{

    /**
     * 获取专业信息，不合成数据，直接发送前端，前端合成
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMajors(Request $request)
    {
        $res = MajorCategoryModel::select('id', 'pid', 'bz', 'name', 'code', 'url_1', 'url_2')
            ->orderBy('pid')->get();

        return response()->json([
           'status' => true,
           'data' => $res->toArray()
        ]);
    }
}