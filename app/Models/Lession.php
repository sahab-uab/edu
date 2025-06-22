<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lession extends Model
{
    public function groupeClasses(): BelongsTo
    {
        return $this->belongsTo(GroupeClass::class, 'class_id');
    }

    public function subjects(): BelongsTo
    {
        return $this->belongsTo(Allsubject::class, 'subject_id');
    }
}
