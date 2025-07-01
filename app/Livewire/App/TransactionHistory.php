<?php

namespace App\Livewire\App;

use App\Models\Transaction;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class TransactionHistory extends Component
{
    public function delete($id){
        $del = Transaction::find($id);
        if (!$del) {
            session()->flash('error', 'কিছু একটা সমাস্যা হয়ছে আবার চেষ্টা করুন।');
            return;
        }
        $del->delete();
        session()->flash('success', 'সফল্ভাবে একটা লেনদেন কে মুছেফেলা হয়ছে।');
    }

    public $search = '';
    #[Title('লেনদেন তালিকা')]
    public function render()
    {
        $query = Transaction::query();
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('amount', 'like', '%' . $this->search . '%')
                    ->orWhere('payment_gatway', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%')
                    ->orWhere('payment_type', 'like', '%' . $this->search . '%');
            });
        }
        $data = $query->with('user')->latest()->paginate(10);
        return view('livewire.app.transaction-history', [
            'data' => $data
        ]);
    }
}
