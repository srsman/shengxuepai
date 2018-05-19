<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/5/4
 * Time: 17:38
 * 我的成绩分析
 */

namespace App\Http\Controllers;

use App\Model\AnalysisModel;
use Illuminate\Support\Facades\DB;

class AnalysisController extends Controller
{
    public function get_level(){
        session('classify')=='文科'? $class=1:$class=2;
        $rank=session('rank');
        $year=array(2014,2015);
        $analysis = array();
        foreach ($year as $item){
            $score=DB::select("select score from s_examinee_select where cur_year=? and wenli=? ORDER BY abs(".$rank."-score_rank) limit 1",[$item,$class]);
            $score_num = DB::select("select score,sum(people_count) as number from s_examinee_select where cur_year = ".$item." and wenli =".$class." AND score<".($score[0]->score+30)." and score >".($score[0]->score-30)." group by score order by score");
            $school_num = DB::select("SELECT sum(people_count) as number,sch_name FROM `s_examinee_select` where `wenli` = ".$class." and cur_year = ".$item." and sch_name !='-' and score =".$score[0]->score."  group by sch_name order by number desc limit 10");
            $major_num = DB::select("SELECT sum(people_count) as number,major_name FROM `s_examinee_select` where `wenli` = ".$class." and cur_year = ".$item." and major_name !='-' and score =".$score[0]->score."  group by major_name order by number desc limit 10");
            $analysis[$item]['score']=$score_num;
            $analysis[$item]['school']=$school_num;
            $analysis[$item]['major']=$major_num;
            $analysis[$item]['lever']=$score[0]->score;
        }
        return response()->json([
            'status' => true,
            'data' => $analysis,
        ]);
    }
}