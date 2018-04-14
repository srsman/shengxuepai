<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/4/14
 * Time: 9:21
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * 学校基础数据，不包括分数信息
 * Class SchoolBasicModel
 * @package App\Model
 */
class SchoolBasicModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 's_school_basic';

    public $timestamps = false;
}