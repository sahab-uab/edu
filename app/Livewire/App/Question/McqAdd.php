<?php

namespace App\Livewire\App\Question;

use App\Models\Allsubject;
use App\Models\GroupeClass;
use App\Models\Lession;
use App\Models\QuestionType;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
class McqAdd extends Component
{
    use WithFileUploads;

    public $class_id = '';
    public $subject_id = '';
    public $lession_id = '';
    public $question_lavel = '';
    public $question_type_id = '';
    public $questiontitle = '';
    public $videoLink = '';
    public $image = '';


    #[Title('MCQ প্রশ্ন')]
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
        // question type
        $question_type = [];
        if ($this->class_id) {
            $question_type = QuestionType::pluck('name', 'id')->toArray();
        }
        return view('livewire.app.question.mcq-add', [
            'classes' => $classes,
            'subjects' => $subjects,
            'lession' => $lession,
            'question_type' => $question_type
        ]);
    }
}
