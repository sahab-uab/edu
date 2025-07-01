<?php

namespace App\Livewire\App\Profile;

use App\Models\GroupeClass;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
class ProfileInfo extends Component
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


    public $oldImage = '';

    public $image;
    public $phone = '';
    public $gender = '';
    public $date_of_brith = '';
    public $petitions = '';
    public $bio = '';
    public $address = '';
    public $blood_group = '';
    public $techer_by_institute_name = '';
    public $department = '';
    public $groupclass = '';
    public $name = '';
    public function mount()
    {
        $user = User::find(Auth::user()->id);
        if ($user) {
            $this->name = $user->name;
            $this->oldImage = $user->profile;
            $this->phone = $user->phone;
            $this->gender = $user->gender;
            $this->blood_group = $user->blod_group;
            $this->date_of_brith = $user->blod_group;
            $this->petitions = $user->petitions;
            $this->bio = $user->bio;
            $this->address = $user->address;
            $this->techer_by_institute_name = $user->techer_by_institute_name;
            $this->department = $user->department;
            $this->groupclass = $user->group_class;
        }
        $this->classList = GroupeClass::pluck('name', 'id')->toArray();
    }

    public function update()
    {
        $this->validate([
            'name' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'phone' => 'nullable|string',
            'gender' => 'nullable|string',
            'date_of_brith' => 'nullable|date',
            'petitions' => 'nullable|string',
            'bio' => 'nullable|string',
            'address' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'techer_by_institute_name' => 'nullable|string',
            'department' => 'nullable|string',
            'groupclass' => 'nullable|string',
        ], [
            'name.string' => 'নাম লেখা হতে হবে।',
            'image.image' => 'ছবিটি অবশ্যই একটি ইমেজ ফাইল হতে হবে।',
            'image.max' => 'ছবির আকার সর্বোচ্চ ২ এমবি হতে পারবে।',
            'phone.string' => 'ফোন নম্বরটি সঠিকভাবে লিখুন।',
            'gender.string' => 'লিঙ্গটি সঠিকভাবে নির্বাচন করুন।',
            'date_of_brith.date' => 'জন্ম তারিখটি সঠিকভাবে দিন।',
            'petitions.string' => 'আবেদনের তথ্যটি সঠিকভাবে লিখুন।',
            'bio.string' => 'জীবনবৃত্তান্তটি সঠিকভাবে লিখুন।',
            'address.string' => 'ঠিকানাটি সঠিকভাবে লিখুন।',
            'blood_group.string' => 'রক্তের গ্রুপটি সঠিকভাবে নির্বাচন করুন।',
            'techer_by_institute_name.string' => 'প্রতিষ্ঠানের নামটি সঠিকভাবে লিখুন।',
            'department.string' => 'বিভাগটি সঠিকভাবে লিখুন।',
            'groupclass.string' => 'শ্রেণীটি সঠিকভাবে নির্বাচন করুন।',
        ]);

        $user = User::find(Auth::user()->id);
        if ($this->image) {
            if ($this->oldImage && Storage::disk('public')->exists($this->oldImage)) {
                Storage::disk('public')->delete($this->oldImage);
            }
            $uniqueName = uniqid() . '.' . $this->image->getClientOriginalExtension();
            $path = $this->image->storeAs('media', $uniqueName, 'public');
            $user->profile = $path;
        }
        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->gender = $this->gender;
        if ($this->blood_group) {
            $user->blod_group = $this->blood_group;
        }
        if ($this->date_of_brith) {
            $user->date_of_birth = $this->date_of_brith;
        }
        $user->petitions = $this->petitions;
        $user->bio = $this->bio;
        $user->address = $this->address;
        $user->techer_by_institute_name = $this->techer_by_institute_name;
        $user->department = $this->department;
        $user->group_class = $this->groupclass;
        $user->save();
        session()->flash('success', 'প্রোফাইল সফলভাবে আপডেট হয়েছে।');
    }

    #[Title('প্রোফাইল')]
    public function render()
    {
        return view('livewire.app.profile.profile-info');
    }
}
