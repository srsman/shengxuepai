<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/5/19
 * Time: 11:43
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

/**
 * 学校专业的级别
 * Class SchoolMajorLevel
 * @package App\Model
 */
class SchoolMajorLevel extends Model
{
    protected $primaryKey = 'id';
    protected $table = "s_school_major_s";

    public $timestamps = false;
}