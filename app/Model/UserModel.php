<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/3/28
 * Time: 14:59
 */

namespace App\Model;

use \Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 's_info';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
}