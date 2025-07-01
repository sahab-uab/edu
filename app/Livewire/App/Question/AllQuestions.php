<?php

namespace App\Livewire\App\Question;

use App\Models\Allsubject;
use App\Models\GroupeClass;
use App\Models\Lession;
use App\Models\McqQuestion;
use App\Models\QuestionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class AllQuestions extends Component
{
    use WithPagination;

    public $search = '';
    public $class_id = '';
    public $subject_id = '';
    public $lession_id = '';
    public $type_id = '';
    public $model = 'false';

    public $normal_question = null;
    public $advance_question = null;
    public $answer = null;
    public $title = null;
    public $editId = '';
    public $image = '';
    public $image_align = '';
    public $video = '';


    // status change
    public function changestatus($id, $status)
    {
        $mcq = McqQuestion::find($id);
        $mcq->status = $status;
        $mcq->save();

        session()->flash('success', 'প্রশ্নের অবস্থা পরিবর্তন করা হয়েছে।');
    }

    // delete
    public function delete($id)
    {
        $mcq = McqQuestion::find($id);
        if ($mcq) {
            if ($mcq->image_link && Storage::disk('public')->exists($mcq->image_link)) {
                Storage::disk('public')->delete($mcq->image_link);
            }
            $mcq->delete = 'deleted';
            $mcq->save();
            session()->flash('success', 'প্রশ্নটি সফলভাবে মুছে ফেলা হয়েছে।');
        } else {
            session()->flash('error', 'প্রশ্নটি পাওয়া যায়নি।');
        }
    }

    // view
    public function view($id)
    {
        $data = McqQuestion::find($id);
        if (!$data) {
            session()->flash('error', 'প্রশ্নটি পাওয়া যায়নি।');
        }
        $this->title = $data->title;
        $this->normal_question = json_decode($data->normal_questions);
        $this->advance_question = json_decode($data->advance_questions);
        $this->answer = $data->right;
        $this->editId = $data->id;
        $this->image = $data->image_link;
        $this->image_align = $data->image_positon;
        $this->video = $data->video_link;
        $this->model = 'true';
    }

    // model handler
    public function modelHandler()
    {
        $this->model = $this->model == 'true' ? 'false' : 'true';
    }

    #[Title('সকল প্রশ্ন')]
    public function render()
    {
        $query = McqQuestion::query();
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('status', 'like', '%' . $this->search . '%');
        }
        if ($this->class_id) {
            $query->where('class_id', $this->class_id);
        }
        if ($this->subject_id) {
            $query->where('subject_id', $this->subject_id);
        }
        if ($this->lession_id) {
            $query->where('lession_id', $this->lession_id);
        }
        if ($this->type_id) {
            $query->where('type_id', $this->type_id);
        }
        if (Auth::user()->role != 'admin') {
            $query->where('created_by', Auth::user()->id);
        }
        $data = $query->where('delete', 'no')->with(['groupeClass', 'subject', 'lession', 'type', 'created_who', 'updated_who'])->latest()->paginate(10);
        // other
        $all_class = GroupeClass::pluck('name', 'id')->toArray();
        $all_subject = Allsubject::pluck('name', 'id')->toArray();
        $all_lession = Lession::pluck('name', 'id')->toArray();
        $question_type = QuestionType::pluck('name', 'id')->toArray();
        return view('livewire.app.question.all-questions', [
            'data' => $data,
            'class' => $all_class,
            'subject' => $all_subject,
            'lession' => $all_lession,
            'question_type' => $question_type
        ]);
    }
}
