<?php

namespace App\Model\scmsp\backend\feedbackDetails;

use Illuminate\Database\Eloquent\Model;

class ComplainFeedbacks extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['complain_id','eng_feedback','customer_feedback','user_id'];
}
