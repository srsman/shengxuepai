<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/3/28
 * Time: 15:09
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class AnalysisModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 's_examinee_select';

    public $timestamps = false;
}