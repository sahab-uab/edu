<?php

namespace App\Livewire\Ui\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Rolechoice extends Component
{
    public $role = '';
    public $password = '';
    public function setrole($role)
    {
        $this->role = $role;
    }

    public function updaterole()
    {
        if (!empty($this->role)) {
            $user = User::find(Auth::user()->id);
            $user->role = $this->role;
            if (!empty($this->password)) {
                $user->password = bcrypt($this->password);
            }
            $user->save();
            session()->flash('success', 'আপনি সফলভাবে নিবন্ধন ও লগইন করেছিলেন!');
            $this->redirectRoute('ux.dashboard', navigate: true);
        } else {
            session()->flash('error', 'অনুগ্রহ করে একটি ভুমিকা বাছায় করুন!');
            return;
        }
    }

    #[Title('ভূমিকা নির্বাচন')]
    public function render()
    {
        return view('livewire.ui.auth.rolechoice');
    }
}
