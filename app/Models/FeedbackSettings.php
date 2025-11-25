<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackSettings extends Model
{
    protected $table = 'lk_feedback_settings';

    protected $fillable = [
        'clientId',
        'title',
        'description',
        'countEvaluations',
        'imageSrc',
        'goodReviewSrc',
    ];
}
