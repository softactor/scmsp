<?php

namespace App\Model\scmsp\backend\complainTypeCategory;

use Illuminate\Database\Eloquent\Model;

class ComplainTypeCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','user_id'];
}
