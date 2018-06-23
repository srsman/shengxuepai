<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/6/22
 * Time: 15:43
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class ScoreBasicModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 's_score_basic';

    public $timestamps = false;
}