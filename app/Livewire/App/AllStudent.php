<?php

namespace App\Livewire\App;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class AllStudent extends Component
{
    use WithPagination;

    // model handler
    public $model = 'false';
    public function modelhandler()
    {
        $this->model = $this->model == 'true' ? 'false' : 'true';
    }

    // student add data
    public $editId = '';
    public $name = '';
    public $email = '';
    public $password = '';
    public $status = '';
    public function studentAdd()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email' . ($this->editId ? '' : '|unique:users,email'),
            'password' => ($this->editId ? '' : 'required') . '|min:8'
        ], [
            'name.required' => 'অনুগ্রহ করে আপনার নাম প্রদান করুন।',
            'email.required' => 'অনুগ্রহ করে আপনার ইমেইল ঠিকানা প্রদান করুন।',
            'email.email' => 'সঠিক ইমেইল ঠিকানা দিতে অনুগ্রহ করুন।',
            'email.unique' => ' এই ইমেইলটি একটি একাউন্ট পাওয়া গেছে।',
            'password.required' => 'অনুগ্রহ করে পাসওয়ার্ড দিন।',
            'password.min' => 'অনুগ্রহ করে পাসওয়ার্ড সর্বনিম্ন ৮ সংখ্যার দিন',
        ]);

        $student = $this->editId ? User::find($this->editId) : new User();
        $student->name = $this->name;
        $student->email = $this->email;
        $student->password = $this->password;
        $student->role = 'student';
        if ($this->status) {
            $student->status = $this->status;
        }
        $student->save();
        session()->flash('success', $this->editId ? 'ছাত্র/ছত্রী পরিবর্তন করা হয়ছে' : 'নতুন একটি ছাত্র/ছাত্রী তৈরী করা হয়ছে');
        $this->editId = $student->id;
        $this->model = 'false';
        $this->reset(['name', 'email', 'password', 'editId']);
    }

    // handle edit
    public function edit($id)
    {
        $this->editId = $id;
        $student = User::find($id);
        $this->name = $student->name;
        $this->email = $student->email;
        $this->status = $student->status;
        $this->model = 'true';
    }

    // delet
    public function delete($id)
    {
        $student = User::find($id);
        // delete profile
        if ($student->profile || !empty($student->profile)) {
            $profilePath = public_path('media/' . $student->profile);
            if (file_exists($profilePath)) {
                @unlink($profilePath);
            }
        }
        $student->delete();
        session()->flash('success', 'একজন ছাত্র/ছাত্রীকে মুছে ফেলা হয়ছে');
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
        return view('livewire.app.all-student', [
            'data' => $data
        ]);
    }
}
