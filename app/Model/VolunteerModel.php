<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/4/3
 * Time: 15:04
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class VolunteerModel extends Model
{
    protected $primaryKey = 'volunteer_id';
    protected $table = 's_volunteer_table';
    public $timestamps = true;
}