<?php

namespace App\Livewire\App\Question;

use App\Models\Allsubject;
use App\Models\CqQuestion;
use App\Models\GroupeClass;
use App\Models\Lession;
use App\Models\QuestionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class AllCqQuestion extends Component
{
    use WithPagination;

    public $search = '';
    public $class_id = '';
    public $subject_id = '';
    public $lession_id = '';
    public $type_id = '';
    public $model = 'false';
    public $editId = 'false';

    // view
    public $viewData = [];

    // delete
    public function delete($id)
    {
        $mcq = CqQuestion::find($id);
        if ($mcq) {
            if ($mcq->image && Storage::disk('public')->exists($mcq->image)) {
                Storage::disk('public')->delete($mcq->image);
            }
            $mcq->delete = 'deleted';
            $mcq->save();
            session()->flash('success', 'প্রশ্নটি সফলভাবে মুছে ফেলা হয়েছে।');
        } else {
            session()->flash('error', 'প্রশ্নটি পাওয়া যায়নি।');
        }
    }

    // model handler
    public function modelHandler()
    {
        $this->model = $this->model == 'true' ? 'false' : 'true';
    }

    // view
    public function view($id)
    {
        $data = CqQuestion::find($id);
        if (!$data) {
            session()->flash('error', 'প্রশ্নটি পাওয়া যায়নি।');
        }
        $this->editId = $id;
        $this->viewData = $data;
        $this->model = 'true';
    }

    // status change
    public function changestatus($id, $status)
    {
        $mcq = CqQuestion::find($id);
        $mcq->status = $status;
        $mcq->save();

        session()->flash('success', 'প্রশ্নের অবস্থা পরিবর্তন করা হয়েছে।');
    }

    #[Title('সকল CQ প্রশ্ন')]
    public function render()
    {
        $query = CqQuestion::query();
        if ($this->search) {
            $query->where('questiontitle', 'like', '%' . $this->search . '%')
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

        return view('livewire.app.question.all-cq-question', [
            'data' => $data,
            'class' => $all_class,
            'subject' => $all_subject,
            'lession' => $all_lession,
            'question_type' => $question_type
        ]);
    }
}
