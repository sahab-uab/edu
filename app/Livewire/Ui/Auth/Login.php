<?php

namespace App\Livewire\Ui\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public function login()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8'
        ], [
            'email.required' => 'অনুগ্রহ করে আপনার ইমেইল ঠিকানা প্রদান করুন।',
            'email.email' => 'সঠিক ইমেইল ঠিকানা দিতে অনুগ্রহ করুন।',
            'email.exists' => ' এই ইমেইলটি পাওয়া যায়নি। অনুগ্রহ করে আবার চেষ্টা করুন।',
            'password.required' => 'অনুগ্রহ করে পাসওয়ার্ড দিন।',
            'password.min' => 'অনুগ্রহ করে পাসওয়ার্ড সর্বনিম্ন ৮ সংখ্যার দিন',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->flash('success', 'আপনি সফলভাবে নিবন্ধন ও লগইন করেছিলেন!');
            $this->redirectRoute('ux.dashboard', navigate:true);
        } else {
            session()->flash('error', 'ইমেইল বা পাসওয়ার্ড ভুল হয়েছে');
        }
    }


    #[Title('লগিন করুন')]
    public function render()
    {
        return view('livewire.ui.auth.login');
    }
}
