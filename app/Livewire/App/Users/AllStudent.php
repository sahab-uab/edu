<?php

namespace App\Livewire\App\Users;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class AllStudent extends Component
{
    use WithPagination;
    use WithFileUploads;

    // model handler
    public $model = 'false';
    public function modelhandler()
    {
        $this->model = $this->model == 'true' ? 'false' : 'true';
    }
    public $Moneymodel = 'false';
    public function Moneymodelhandler()
    {
        $this->Moneymodel = $this->Moneymodel == 'true' ? 'false' : 'true';
    }

    // view
    public $viewData = [];
    public function view($id)
    {
        $this->viewData = User::find($id);
        if (!$this->viewData) {
            session()->flash('error', 'কিছু একটা ত্রুটি হয়েছে।');
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
        session()->flash('success', 'একজন ছাত্র/ছাত্রীকে মুছে ফেলা হয়ছে');
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

    // money add model
    public $moneyModeldata = null;
    public $deposit_amount = 0;
    public function moneyAddModel($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->moneyModeldata = $user;
            $this->Moneymodel = 'true';
        } else {
            session()->flash('error', 'কিছু একটা সমাস্যা হয়ছে আবার চেষ্টা করুন।');
            return;
        }
    }
    public function depositNow()
    {
        if (empty($this->deposit_amount)) {
            $this->addError('deposit_amount', 'টাকার পরিমাণ অবশ্যই দিতে হবে।');
            return;
        }
        if (!is_numeric($this->deposit_amount) || $this->deposit_amount <= 0) {
            $this->addError('deposit_amount', 'টাকার পরিমাণ সঠিকভাবে দিন (শুধুমাত্র ধনাত্মক সংখ্যা)।');
            return;
        }

        $newBalance = (float) $this->moneyModeldata->amount + (float) $this->deposit_amount;
        $q = User::find($this->moneyModeldata->id);
        if (!$q) {
            $this->addError('deposit_amount', 'কিছু একটা সমাস্যা হয়ছে আবার চেষ্টা করুন।');
            return;
        }
        $q->amount = $newBalance;
        $store = $q->save();
        if (!$store) {
            $this->addError('deposit_amount', 'কিছু একটা সমাস্যা হয়ছে আবার চেষ্টা করুন।');
            return;
        } else {
            $recod = new Transaction();
            $recod->user_id = $this->moneyModeldata->id;
            $recod->amount = $this->deposit_amount;
            $recod->payment_gatway = 'Admin';
            $recod->status = 'success';
            $recod->payment_type = 'add';
            $recod->save();
            session()->flash('success', 'সফল ভাবে শিক্ষক/শিক্ষিকার জন্য ডিপোজিট হয়ছে।');
            $this->reset(['moneyModeldata', 'deposit_amount']);
            $this->Moneymodel = 'false';
        }
    }

    public $search = '';
    public $statusselect = '';
    public $gender = '';
    #[Title('সকল ছাত্র/ছত্রী')]
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
        $data = $query->where('role', 'student')->latest()->paginate(10);
        return view('livewire.app.users.all-student', [
            'data' => $data
        ]);
    }
}
