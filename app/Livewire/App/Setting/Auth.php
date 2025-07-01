<?php

namespace App\Livewire\App\Setting;

use App\Models\GoogleAuth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Auth extends Component
{
    public $server_base_url;
    public $redirect_url;

    public $clint_id = '';
    public $clint_secrate = '';
    public $status = '';

    public function loadData()
    {
        // data
        $data = GoogleAuth::first();
        if ($data) {
            $this->clint_id = $data->client_id;
            $this->clint_secrate = $data->client_secrate;
            $this->clint_secrate = $data->client_secrate;
            $this->status = $data->status;
        }
    }

    public function mount()
    {
        $this->server_base_url = config('app.url') ?? url('/');
        $this->redirect_url = $this->server_base_url . '/auth/google/callback';
        $this->loadData();
    }

    public function update()
    {
        $this->validate([
            'clint_id' => 'required',
            'clint_secrate' => 'required'
        ], [
            'clint_id' => 'ক্লাইন্ট আইডি প্রদান করুন।',
            'clint_secrate' => 'ক্লায়েন্ট সিক্রেট প্রদান করুন।'
        ]);

        $q = GoogleAuth::first() ?? new GoogleAuth();
        $q->client_id = $this->clint_id;
        $q->client_secrate = $this->clint_secrate;
        $store = $q->save();
        if (!$store) {
            session()->flash('error', 'কিছু একটা সমাস্যা হয়ছে আবার চেষ্টা করুন।');
            return;
        }
        session()->flash('success', 'সফল ভাবে সেভ করা হয়ছে।');
        $this->loadData();
    }

    public function changestatus($status){
        $q = GoogleAuth::first();
        if (!$q) {
            session()->flash('error', 'আগে সকল তথ্য পূরন করুন।');
            return;
        }
        $q->status = $status;
        $q->save();
        $this->loadData();
        session()->flash('success', 'সফল ভাবে অবস্থার পরিবর্তন করা করা হয়ছে।');
    }

    #[Title('অথেনটিকেট')]
    public function render()
    {
        return view('livewire.app.setting.auth');
    }
}
