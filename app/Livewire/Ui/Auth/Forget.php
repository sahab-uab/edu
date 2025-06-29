<?php

namespace App\Livewire\Ui\Auth;

use App\Mail\Mailer;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Forget extends Component
{
    public $email = '';
    public function forget()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'আপনার ইমেইল প্রদান করুন।',
            'email.email' => 'সঠিক ইমেইল ঠিকানা প্রদান করুন।',
            'email.exists' => 'এই ইমেইল দিয়ে কোন একাউন্ট নেই।'
        ]);

        try {
            $user = User::where('email', $this->email)->first();
            $token = Password::createToken($user);
            $reset_link = url(route('ui.password.reset', ['token' => $token, 'email' => $this->email], false));

            Mail::to($this->email)->send(new Mailer('পাসওয়ার্ড পুনরুদ্ধার', 'mail.forget', [
                'reset_link' => $reset_link
            ]));
            session()->flash('success', 'পাসওয়ার্ড রিসেট লিঙ্ক আপনার ইমেইলে পাঠানো হয়েছে।');
            $this->reset(['email']);
        } catch (\Exception $e) {
            session()->flash('error', 'ইমেইল পাঠাতে ব্যর্থ হয়েছে: ' . $e->getMessage());
        }
    }

    #[Title('পাসওয়ার্ড পুনরুদ্ধার')]
    public function render()
    {
        return view('livewire.ui.auth.forget');
    }
}
