<?php

namespace App\Model\scmsp\backend\permission;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','user_type'];
}
