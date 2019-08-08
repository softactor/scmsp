<?php

namespace App\Model\scmsp\backend\complainType;

use Illuminate\Database\Eloquent\Model;

class ComplainType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','dept_id','div_id','category_id','user_id'];
}
