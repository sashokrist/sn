<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function questionnarie()
    {
        return $this->belongsTo(Question::class);
    }

    public function response()
    {
        return $this->hasMany(SurveyResponse::class);
    }

}
