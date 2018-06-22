<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/6/22
 * Time: 9:56
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class WeiciModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 's_weici';

    public $timestamps = false;
}