<?php

namespace App\Livewire\Ui\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function mount(){
        Auth::logout();
        $this->redirectRoute('ui.login');
    }

    public function render()
    {
        return abort('404');
    }
}
