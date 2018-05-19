<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/5/19
 * Time: 13:52
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class TeacherLevelModel extends Model
{
    protected $primaryKey = "id";
    protected $table = "s_teacher_s";

    public $timestamps = false;
}