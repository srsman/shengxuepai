<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/4/3
 * Time: 16:37
 */

namespace App\Model;

use \Illuminate\Database\Eloquent\Model;

class MinorityModel extends Model
{
    protected $table = 's_yuke';
    protected $primaryKey = 'id';
    public $timestamps = false;
}