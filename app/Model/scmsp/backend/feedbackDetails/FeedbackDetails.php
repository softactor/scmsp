<?php

namespace App\Model\scmsp\backend\feedbackDetails;

use Illuminate\Database\Eloquent\Model;

class FeedbackDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'complain_feedbacks';
    protected $fillable = ['complain_id','eng_feedback','customer_feedback','user_id'];
}
