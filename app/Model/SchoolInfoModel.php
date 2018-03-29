<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/3/29
 * Time: 15:08
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class SchoolInfoModel extends Model
{
    protected $table = 's_school_info';
    protected $primaryKey = "school_id";

    public $timestamps = false;
}