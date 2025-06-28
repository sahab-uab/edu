<?php

namespace App\Livewire\App\Users;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class AllTecher extends Component
{
    use WithPagination;
    use WithFileUploads;

    // model handler
    public $model = 'false';
    public function modelhandler()
    {
        $this->model = $this->model == 'true' ? 'false' : 'true';
    }

    // view
    public $viewData = [];
    public function view($id)
    {
        $this->viewData = User::find($id);
        if (!$this->viewData) {
            session()->flash('error', 'কিছু একটা ত্রুটি হয়েছ।');
            return;
        }
        $this->model = 'true';
    }

    // delet
    public function delete($id)
    {
        $student = User::find($id);
        // delete profile
        if (!$student) {
            session()->flash('error', 'ব্যবহারকারী খুঁজে পাওয়া যায়নি।');
            return;
        }
        // delete profile
        if ($student->profile) {
            if ($student->profile && Storage::disk('public')->exists($student->profile)) {
                Storage::disk('public')->delete($student->profile);
            }
        }
        $student->delete();
        session()->flash('success', 'একজন শিক্ষক-কে মুছে ফেলা হয়ছে');
    }

    // chnage status
    public function changestatus($id, $status)
    {
        $data = User::find($id);
        if (!$data) {
            session()->flash('error', 'কিছু একটা সমাস্যা হয়েছে আবার চেস্টা করুন।');
            return;
        }
        $data->status = $status;
        $store = $data->save();
        if (!$store) {
            session()->flash('error', 'কিছু একটা সমাস্যা হয়েছে আবার চেস্টা করুন।');
            return;
        } else {
            session()->flash('success', 'আবস্থা পরিবর্তন সফল হয়েছে।');
        }
    }

    public $search = '';
    public $statusselect = '';
    public $gender = '';
    #[Title('সকল শিক্ষক')]
    public function render()
    {
        $query = User::query();
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%');
            });
        }
        if ($this->statusselect) {
            $query->orWhere('status', $this->statusselect);
        }
        if ($this->gender) {
            $query->orWhere('gender', 'like', '%' . $this->search . '%');
        }
        $data = $query->where('role', 'teacher')->latest()->paginate(10);
        return view('livewire.app.users.all-techer', [
            'data' => $data
        ]);
    }
}
