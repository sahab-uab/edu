<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CqQuestion extends Model
{
    public function groupeClass()
    {
        return $this->belongsTo(GroupeClass::class, 'class_id');
    }
    public function subject()
    {
        return $this->belongsTo(Allsubject::class, 'subject_id');
    }
    public function lession()
    {
        return $this->belongsTo(Lession::class, 'lession_id');
    }
    public function type()
    {
        return $this->belongsTo(QuestionType::class, 'type_id');
    }
    public function created_who()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updated_who()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
