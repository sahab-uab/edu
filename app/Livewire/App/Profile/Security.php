<?php

namespace App\Livewire\App\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Security extends Component
{
    // update password
    public $password = '';
    public $password_confirmation = '';
    public function passwordUpdate()
    {
        $this->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'password.required' => 'নতুন পাসওয়ার্ড আবশ্যক।',
            'password.min' => 'পাসওয়ার্ড কমপক্ষে ৮ অক্ষরের হতে হবে।',
            'password.confirmed' => 'পাসওয়ার্ড নিশ্চিতকরণ মিলছে না।',
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($this->password);
        $user->save();
        session()->flash('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন হয়েছে।');
        $this->reset(['password', 'password_confirmation']);
    }

    // upadte email
    public $new_email = '';
    public $current_password = '';

    public function emailUpdate()
    {
        $this->validate([
            'new_email' => ['required', 'email', 'unique:users,email'],
            'current_password' => ['required'],
        ], [
            'new_email.required' => 'নতুন ইমেইল আবশ্যক।',
            'new_email.email' => 'সঠিক ইমেইল ঠিকানা দিন।',
            'new_email.unique' => 'এই ইমেইল ইতিমধ্যে ব্যবহৃত হয়েছে।',
            'current_password.required' => 'বর্তমান পাসওয়ার্ড আবশ্যক।',
        ]);

        if (!Hash::check($this->current_password, Auth::user()->password)) {
            $this->addError('current_password', 'বর্তমান পাসওয়ার্ড সঠিক নয়।');
            return;
        }

        $user = User::find(Auth::user()->id);
        $user->email = $this->new_email;
        $user->save();

        session()->flash('success', 'ইমেইল সফলভাবে পরিবর্তন হয়েছে।');
        $this->reset(['new_email', 'current_password']);
    }

    #[Title('নিরাপত্তা')]
    public function render()
    {
        return view('livewire.app.profile.security');
    }
}
