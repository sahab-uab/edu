<?php

namespace App\Livewire\App\Setting;

use App\Models\SettinQuestion;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class QuestionSetting extends Component
{
    public function loadData()
    {
        $data = SettinQuestion::first();
        if ($data) {
            $this->mcq_price = $data->mcq_price;
            $this->cq_price = $data->cq_price;
            $this->sq_price = $data->sq_price;
        }
    }
    public function mount()
    {
        $this->loadData();
    }

    // mcq
    public $mcq_price = '';
    public function mcqUpdate()
    {
        if ($this->mcq_price < 0) {
            $this->addError('mcq_price', 'মূল্য অবশ্যই ০ বা তার বেশি হতে হবে।');
            return;
        }
        $q = SettinQuestion::first() ?? new SettinQuestion();
        $q->mcq_price = $this->mcq_price;
        $store =  $q->save();
        if (!$store) {
            session()->flash('error', 'কিছু একটা সমাস্যা হয়েছে আবার চেষ্টা করুন।');
            return;
        }
        session()->flash('success', 'MCQ এর দাম সফল-ভাবে পরিবর্তন হয়েছে।');
        $this->loadData();
    }

    // cq
    public $cq_price = '';
    public function cqUpdate()
    {
        if ($this->cq_price < 0) {
            $this->addError('cq_price', 'মূল্য অবশ্যই ০ বা তার বেশি হতে হবে।');
            return;
        }
        $q = SettinQuestion::first() ?? new SettinQuestion();
        $q->cq_price = $this->cq_price;
        $store =  $q->save();
        if (!$store) {
            session()->flash('error', 'কিছু একটা সমাস্যা হয়েছে আবার চেষ্টা করুন।');
            return;
        }
        session()->flash('success', 'CQ এর দাম সফল-ভাবে পরিবর্তন হয়েছে।');
        $this->loadData();
    }

    // cq
    public $sq_price = '';
    public function sqUpdate()
    {
        if ($this->sq_price < 0) {
            $this->addError('sq_price', 'মূল্য অবশ্যই ০ বা তার বেশি হতে হবে।');
            return;
        }
        $q = SettinQuestion::first() ?? new SettinQuestion();
        $q->sq_price = $this->sq_price;
        $store =  $q->save();
        if (!$store) {
            session()->flash('error', 'কিছু একটা সমাস্যা হয়েছে আবার চেষ্টা করুন।');
            return;
        }
        session()->flash('success', 'SQ এর দাম সফল-ভাবে পরিবর্তন হয়েছে।');
        $this->loadData();
    }

    #[Title('প্রশ্নর সেটিংস')]
    public function render()
    {
        return view('livewire.app.setting.question-setting');
    }
}
