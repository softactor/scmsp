<?php

namespace App\Model\scmsp\backend\division;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dept_id','name','user_id'];
}
