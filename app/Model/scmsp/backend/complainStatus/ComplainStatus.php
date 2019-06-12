<?php

namespace App\Model\scmsp\backend\complainStatus;

use Illuminate\Database\Eloquent\Model;

class ComplainStatus extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','user_id'];
}
