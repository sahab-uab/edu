<?php

namespace App\Livewire\App;

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
        $this->reset(['editId', 'name', 'email', 'password', 'status', 'address', 'phone', 'f_gender', 'bloodgroup', 'date_of_birth', 'bio']);
    }

    // student add data
    public $editId = '';
    public $name = '';
    public $email = '';
    public $password = '';
    public $status = '';

    public $address = '';
    public $phone = '';
    public $f_gender = '';
    public $bloodgroup = '';
    public $date_of_birth = '';
    public $bio = '';

    public $profile;
    public $profileOld = null;
    public function studentAdd()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email' . ($this->editId ? '' : '|unique:users,email'),
            'password' => ($this->editId ? '' : 'required') . '|min:8',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
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
        if ($this->password) {
            $student->password = bcrypt($this->password);
        }
        $student->role = 'student';
        $student->address = $this->address;
        $student->phone = $this->phone;
        $student->gender = $this->f_gender;
        $student->blod_group = $this->bloodgroup;
        $student->date_of_birth = $this->date_of_birth;
        $student->bio = $this->bio;
        $student->status = $this->status;
        if ($this->profile) {
            if ($this->profileOld && Storage::disk('public')->exists($this->profileOld)) {
                Storage::disk('public')->delete($this->profileOld);
            }
            $uniqueName = uniqid() . '.' . $this->profile->getClientOriginalExtension();
            $path = $this->profile->storeAs('media', $uniqueName, 'public');
            $student->profile = $path;
        }
        $save = $student->save();

        if ($save) {
            session()->flash('success', $this->editId ? 'ছাত্র/ছত্রী পরিবর্তন করা হয়ছে' : 'নতুন একটি ছাত্র/ছাত্রী তৈরী করা হয়ছে');
            $this->editId = $student->id;
            $this->model = 'false';
            $this->reset(['name', 'email', 'password', 'editId']);
        } else {
            session()->flash('error', 'ছাত্র/ছত্রী সংরক্ষণে ত্রুটি ঘটেছে।');
        }
    }

    // handle edit
    public function edit($id)
    {
        $student = User::find($id);
        $this->editId = $id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->status = $student->status;

        $this->address = $student->address;
        $this->phone = $student->phone;
        $this->f_gender = $student->gender;
        $this->bloodgroup = $student->blod_group;
        $this->date_of_birth = $student->date_of_birth;
        $this->bio = $student->bio;
        $this->profileOld = $student->profile;
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
