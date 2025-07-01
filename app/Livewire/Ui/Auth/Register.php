<?php

namespace App\Livewire\Ui\Auth;

use App\Models\GoogleAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public $googleLoginStatus = 'on';
    public function mount()
    {
        $googleSetting = GoogleAuth::first();
        if ($googleSetting && isset($googleSetting->client_id, $googleSetting->client_secrate, $googleSetting->status)) {
            if ($googleSetting->status === 'active') {
                $this->googleLoginStatus = 'on';
            } else {
                $this->googleLoginStatus = 'off';
            }
        } else {
            $this->googleLoginStatus = 'off';
        }
    }

    public $name = '';
    public $email = '';
    public $password = '';
    public function registetion()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ], [
            'name.required' => 'অনুগ্রহ করে আপনার নাম প্রদান করুন।',
            'email.required' => 'অনুগ্রহ করে আপনার ইমেইল ঠিকানা প্রদান করুন।',
            'email.email' => 'সঠিক ইমেইল ঠিকানা দিতে অনুগ্রহ করুন।',
            'email.unique' => ' এই ইমেইলটি ইতিমধ্যেই ব্যবহৃত হচ্ছে।',
            'password.required' => 'অনুগ্রহ করে পাসওয়ার্ড দিন।',
            'password.min' => 'অনুগ্রহ করে পাসওয়ার্ড সর্বনিম্ন ৮ সংখ্যার দিন',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
        Auth::login($user);
        session()->flash('success', 'আপনি সফলভাবে নিবন্ধন ও লগইন করেছিলেন!');
        $this->redirectRoute('ux.dashboard', navigate: true);
    }

    #[Title('রেজিস্ট্রেশন করুন')]
    public function render()
    {
        return view('livewire.ui.auth.register');
    }
}
