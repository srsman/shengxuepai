<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/5/10
 * Time: 11:13
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class SoftModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 's_soft';

    public $timestamps = false;
}