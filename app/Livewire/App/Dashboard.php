<?php

namespace App\Livewire\App;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Dashboard extends Component
{

    #[Title('ড্যাশবোর্ড')]
    public function render()
    {
        return view('livewire.app.dashboard');
    }
}
