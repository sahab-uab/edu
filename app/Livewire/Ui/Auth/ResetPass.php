<?php

namespace App\Livewire\Ui\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class ResetPass extends Component
{
    #[Url(as: 'email')]
    public $email;
    #[Url(as: 'token')]
    public $token;
    public $password = '';
    public $password_confirmation = '';

    public function resetpassword()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8',
        ], [
            'email.required' => 'ইমেইল প্রদান করুন।',
            'email.email' => 'সঠিক ইমেইল ঠিকানা দিন।',
            'email.exists' => 'এই ইমেইল দিয়ে কোন একাউন্ট খুঁজে পাওয়া যায়নি।',
            'token.required' => 'টোকেন প্রাপ্ত হয়নি।',
            'password.required' => 'পাসওয়ার্ড প্রদান করুন।',
            'password.min' => 'পাসওয়ার্ড কমপক্ষে ৮ অক্ষরের হতে হবে।',
            'password_confirmation.required_with' => 'অনুগ্রহ করে পুনরায় পাসওয়ার্ড লিখুন।',
            'password_confirmation.same' => 'পাসওয়ার্ড মিলছে না আবার দিন।',
            'password_confirmation.min' => 'পুনরায় পাসওয়ার্ড কমপক্ষে ৮ অক্ষরের হতে হবে।',
        ]);

        $status = Password::reset(
            [
                'email' => $this->email,
                'token' => $this->token,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন হয়েছে। এখন লগইন করুন।');
            return redirect()->route('ui.login');
        } else {
            session()->flash('error', __($status));
        }
    }

    #[Title('পাসওয়ার্ড পরিবর্তন')]
    public function render()
    {
        return view('livewire.ui.auth.reset-pass');
    }
}
