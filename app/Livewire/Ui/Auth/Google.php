<?php

namespace App\Livewire\Ui\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Livewire\Component;

class Google extends Component
{
    public function mount()
    {
        $google_user = Socialite::driver('google')->user();
        $user = User::updateOrCreate([
            'google_id' => $google_user->id,
        ], [
            'name' => $google_user->name,
            'email' => $google_user->email,
            'google_token' => $google_user->token,
            'google_refresh_token' => $google_user->refreshToken,
            'password'=>'12345678'
        ]);
        Auth::login($user);
        $this->redirectRoute('ux.dashboard');
    }

    public function render()
    {
        return abort('404');
    }
}
