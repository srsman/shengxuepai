<?php
/**
 * Created by PhpStorm.
 * User: 南宫悟
 * Date: 2018/4/10
 * Time: 16:30
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class MajorCategoryModel extends Model
{
    protected $table = 's_major_category';

    protected $primaryKey = 'id';

    public $timestamps = false;
}