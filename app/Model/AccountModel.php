<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/3/28
 * Time: 15:09
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model
{
    protected $primaryKey = 'user_id';
    protected $table = 's_account';

    public $timestamps = false;
}