<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/5/10
 * Time: 18:30
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class HuadongModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 's_huadong';

    public $timestamps = false;
}