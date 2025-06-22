<?php

namespace App\Livewire\App\Question;

use App\Models\Allsubject;
use App\Models\GroupeClass;
use App\Models\Lession;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class AddQuestions extends Component
{
    public $question_type = '';
    public $class_id = '';
    public $subject_id = '';
    public $lession_id = '';
    
     public $latexInput = '';

    #[Title('নতুন প্রশ্ন')]
    public function render()
    {
        // classes
        $classes = GroupeClass::pluck('name', 'id')->toArray();
        // subject
        $subjects = [];
        if ($this->class_id) {
            $subjects = Allsubject::where('class_id', $this->class_id)->pluck('name', 'id')->toArray();
        } else {
            $subjects = Allsubject::pluck('name', 'id')->toArray();
        }
        // lession
        $lession = [];
        if ($this->class_id) {
            $lession = Lession::where('class_id', $this->class_id)->pluck('name', 'id')->toArray();
        } else {
            $lession = Lession::pluck('name', 'id')->toArray();
        }
        return view('livewire.app.question.add-questions', [
            'classes' => $classes,
            'subjects' => $subjects,
            'lession' => $lession,
        ]);
    }
}
