<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/4/27
 * Time: 18:18
 */
namespace App\Model;

use \Illuminate\Database\Eloquent\Model;

class CooperationMajorModel extends Model
{
    protected $table = 's_cooperation_school';
    protected $primaryKey = 'id';
    public $timestamps = false;
}