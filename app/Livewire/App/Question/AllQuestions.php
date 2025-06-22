<?php

namespace App\Livewire\App\Question;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class AllQuestions extends Component
{

    #[Title('সকল প্রশ্ন')]
    public function render()
    {
        return view('livewire.app.question.all-questions');
    }
}
