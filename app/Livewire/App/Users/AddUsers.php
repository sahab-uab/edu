<?php

namespace App\Livewire\App\Users;

use App\Models\GroupeClass;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
class AddUsers extends Component
{
    use WithFileUploads;

    // options
    public $genderOptions = [
        'male' => 'পূরুষ',
        'female' => 'মহিলা',
        'other' => 'অন্যান্য'
    ];
    public $bloodGroupOptions = [
        'A+' => 'A+',
        'A-' => 'A-',
        'B+' => 'B+',
        'B-' => 'B-',
        'AB+' => 'AB+',
        'AB-' => 'AB-',
        'O+' => 'O+',
        'O-' => 'O-'
    ];
    public $classList = [];

    // required
    public $userrole = '';
    public $name = '';
    public $email = '';
    public $password = '';
    public $oldPassword = '';
    // optionals
    public $image;
    public $oldImage = null;
    public $phone = '';
    public $gender = '';
    public $blood_group = '';
    public $petitions = '';
    public $date_of_brith = '';
    public $bio = '';
    public $address = '';
    public $techer_by_institute_name = '';
    public $groupclass = '';
    public $department = '';

    #[Url(as: 'id')]
    public $editId = '';
    #[Url(as: 'ref')]
    public $refUrl = '';

    // Livewire lifecycle hook to initialize data
    public function mount()
    {
        $this->classList = GroupeClass::pluck('name', 'name')->toArray();
        if ($this->editId) {
            $data = User::find($this->editId);
            if (!$data) {
                session()->flash('error', 'কিছু একটা ত্রুটি রয়েছে।');
                $this->redirectRoute($this->refUrl, navigate: true);
                return;
            }
            $this->name = $data->name;
            $this->email = $data->email;
            $this->oldPassword = $data->password;
            $this->userrole = $data->role;
            $this->oldImage = $data->profile;
            $this->address = $data->address;
            $this->phone = $data->phone;
            $this->gender = $data->gender;
            $this->blood_group = $data->blod_group;
            $this->date_of_brith = $data->date_of_birth;
            $this->bio = $data->bio;
            $this->petitions = $data->petitions;
            $this->groupclass = $data->group_class;
            $this->department = $data->department;
            $this->techer_by_institute_name = $data->techer_by_institute_name;
        }
    }

    // create / update
    public function store()
    {
        $this->validate([
            'userrole' => 'required|in:admin,teacher,student,writer,support',
            'name' => 'required|string',
            'email' => 'required|email|' . $this->editId ? '' : 'unique:users,email',
            'password' => $this->editId ? 'nullable' : 'required' . '|min:6',
            'image' => 'nullable|image|max:2000',
            'gender' => 'nullable|in:male,female,other',
            'blood_group' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'petitions' => 'nullable|string',
            'date_of_brith' => 'nullable|date',
            'bio' => 'nullable|string',
            'address' => 'nullable|string',
            'techer_by_institute_name' => 'nullable|string',
            'groupclass' => 'nullable|string',
            'department' => 'nullable|string',
        ], [
            'userrole.required' => 'রোল নির্বাচন করুন।',
            'userrole.in' => 'রোল অবশ্যই [এডমিন, শিক্ষক, ছাত্র/ছাত্রী, ইডিটর, সাপোর্ট] হতে হবে।',
            'name.required' => 'নাম লিখুন।',
            'email.required' => 'ইমেইল লিখুন।',
            'email.email' => 'সঠিক ইমেইল লিখুন।',
            'email.unique' => 'এই ইমেইল দিয়ে একজন ইউজার রয়েছে।',
            'password.required' => 'পাসওয়ার্ড লিখুন।',
            'password.min' => 'পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে।',
            'userrole.required' => 'রোল নির্বাচন করুন।',
            'userrole.in' => 'রোল অবশ্যই [এডমিন, শিক্ষক, ছাত্র/ছাত্রী, ইডিটর, সাপোর্ট] হতে হবে।',
            'name.required' => 'নাম লিখুন।',
            'email.required' => 'ইমেইল লিখুন।',
            'email.email' => 'সঠিক ইমেইল লিখুন।',
            'email.unique' => 'এই ইমেইল দিয়ে একজন ইউজার রয়েছে।',
            'password.required' => 'পাসওয়ার্ড লিখুন।',
            'password.min' => 'পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে।',
            'image.image' => 'ছবিটি অবশ্যই ইমেজ ফাইল হতে হবে।',
            'image.max' => 'ছবির আকার সর্বোচ্চ ২ এমবি হতে পারবে।',
            'gender.in' => 'লিঙ্গ অবশ্যই পুরুষ, মহিলা অথবা অন্যান্য হতে হবে।',
            'blood_group.in' => 'রক্তের গ্রুপ সঠিকভাবে নির্বাচন করুন।',
            'date_of_brith.date' => 'জন্ম তারিখ সঠিকভাবে দিন।',
        ]);

        $q = $this->editId ? User::find($this->editId) : new User();
        $q->name = $this->name;
        $q->email = $this->email;
        $q->password = $this->editId ? $this->oldPassword : bcrypt($this->password);

        if ($this->image) {
            if ($this->oldImage && Storage::disk('public')->exists($this->oldImage)) {
                Storage::disk('public')->delete($this->oldImage);
            }
            $uniqueName = uniqid() . '.' . $this->image->getClientOriginalExtension();
            $path = $this->image->storeAs('media', $uniqueName, 'public');
            $q->profile = $path;
        }
        $q->address = $this->address;
        $q->phone = $this->phone;
        $q->gender = $this->gender;
        $q->blod_group = $this->blood_group;
        $q->date_of_birth = $this->date_of_brith;
        $q->bio = $this->bio;
        $q->petitions = $this->petitions;
        $q->group_class = $this->groupclass;
        $q->department = $this->department;
        $q->techer_by_institute_name = $this->techer_by_institute_name;
        $q->role = $this->userrole;
        $store = $q->save();
        if ($store) {
            session()->flash('success', $this->editId ? 'সফল ভাবে পরিবর্তন হয়েছে।' : 'সফল ভাবে তৈরি হয়েছে।');
            if ($this->userrole == 'student') {
                $this->redirectRoute('ux.allstudent', navigate: true);
            } else if ($this->userrole == 'teacher') {
                $this->redirectRoute('ux.allteacher', navigate: true);
            } else if ($this->userrole == 'admin') {
                $this->redirectRoute('ux.alladmin', navigate: true);
            } else {
                $this->redirectRoute('ux.add.users', navigate: true);
            }
        }
    }

    // set role
    public function setrole($role)
    {
        $this->userrole = $role;
    }

    // clear form
    public function clearform()
    {
        $this->reset(['userrole', 'name', 'email', 'password']);
    }

    #[Title('ইউজার তৈরি করুন')]
    public function render()
    {
        return view('livewire.app.users.add-users');
    }
}
