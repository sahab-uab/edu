<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Allsubject extends Model
{
    public function groupeClasses(): BelongsTo
    {
        return $this->belongsTo(GroupeClass::class, 'class_id');
    }

    public function lession(): HasMany
    {
        return $this->hasMany(Lession::class, 'id');
    }
}
