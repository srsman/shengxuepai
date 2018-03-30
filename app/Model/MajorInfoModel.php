<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/3/30
 * Time: 16:39
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class MajorInfoModel extends Model
{
    protected $table = 's_major_basic';
    protected $primaryKey = 'major_id';

    public $timestamps = false;

}