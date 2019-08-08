<?php

namespace App\Model\scmsp\backend\complainDetails;

use Illuminate\Database\Eloquent\Model;

class ComplainDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id','complain_type_id','complainer','complain_details','issued_date','user_id','complain_status'];
}
