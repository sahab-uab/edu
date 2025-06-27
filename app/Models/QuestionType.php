<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    public function mcqQuestions()
    {
        return $this->hasMany(McqQuestion::class, 'type_id');
    }
}
