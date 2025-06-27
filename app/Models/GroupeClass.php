<?php

namespace App\Models;

use App\Livewire\App\AllSubject;
use App\Models\Allsubject as ModelsAllsubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupeClass extends Model
{
    public function subject(): HasMany
    {
        return $this->hasMany(ModelsAllsubject::class, 'class_id');
    }

    public function lession(): HasMany
    {
        return $this->hasMany(Lession::class, 'class_id');
    }
    public function mcqQuestion(): HasMany
    {
        return $this->hasMany(McqQuestion::class, 'class_id');
    }
}
