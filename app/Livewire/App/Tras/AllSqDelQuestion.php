<?php

namespace App\Livewire\App\Tras;

use App\Models\SqQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class AllSqDelQuestion extends Component
{
    use WithPagination;

    public $search = '';
    public $model = 'false';
    public $viewData = [];

    // delete
    public function delete($id)
    {
        $mcq = SqQuestion::find($id);
        if ($mcq) {
            if ($mcq->image_link && Storage::disk('public')->exists($mcq->image_link)) {
                Storage::disk('public')->delete($mcq->image_link);
            }
            $mcq->delete();
            session()->flash('success', 'প্রশ্নটি সফলভাবে মুছে ফেলা হয়েছে।');
        } else {
            session()->flash('error', 'প্রশ্নটি পাওয়া যায়নি।');
        }
    }

    // restore
    public function restore($id){
        $mcq = SqQuestion::find($id);
        if ($mcq) {
            $mcq->delete = 'no';
            $mcq->save();
            session()->flash('success', 'প্রশ্নটি সফলভাবে ফিরে আনা হয়েছে।');
        } else {
            session()->flash('error', 'প্রশ্নটি পাওয়া যায়নি।');
        }
    }

    // view
    public function view($id)
    {
        $data = SqQuestion::find($id);
        if (!$data) {
            session()->flash('error', 'প্রশ্নটি পাওয়া যায়নি।');
        }
        $this->viewData = $data;
        $this->model = 'true';
    }

    // model handler
    public function modelHandler()
    {
        $this->model = $this->model == 'true' ? 'false' : 'true';
    }

    #[Title('সকল SQ প্রশ্ন')]
    public function render()
    {
        $query = SqQuestion::query();
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('status', 'like', '%' . $this->search . '%');
        }
        $data = $query->where('delete', 'deleted')->with(['groupeClass', 'subject', 'lession', 'type', 'created_who', 'updated_who'])->latest()->paginate(10);
        return view('livewire.app.tras.all-sq-del-question',[
            'data' => $data,
        ]);
    }
}
