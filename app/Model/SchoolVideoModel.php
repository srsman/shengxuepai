<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/5/19
 * Time: 14:04
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class SchoolVideoModel extends Model
{
    protected $primaryKey = "id";
    protected $table = "s_video";

    public $timestamps = false;
}