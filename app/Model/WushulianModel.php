<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/5/10
 * Time: 18:30
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class WushulianModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 's_wushulian400';

    public $timestamps = false;
}