<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/5/10
 * Time: 11:13
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class ChinaModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 's_chinamates700';

    public $timestamps = false;
}