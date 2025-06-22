<?php

namespace App\Livewire\Ui;

use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    // all form mdeo question add system
    public $demoquestions = [
        [
            'title' => 'বাংলাদেশের রাজধানী কোনটি?',
            'question' => [
                'ক. চট্টগ্রাম',
                'খ. ঢাকা',
                'গ. খুলনা',
                'ঘ. রাজশাহী'
            ]
        ],
        [
            'title' => 'সূর্য কেন আলো দেয়?',
            'question' => [
                'ক. তাপ বিকিরণ',
                'খ. পরমাণু বিক্রিয়া',
                'গ. নিউক্লিয়ার ফিউশন',
                'ঘ. বৈদ্যুতিক তরঙ্গ'
            ]
        ],
        [
            'title' => 'মোবেল পুরস্কার কবে থেকে প্রদান করা শুরু হয়?',
            'question' => [
                'ক. ১৮৯৫',
                'খ. ১৯০১',
                'গ. ১৯১০',
                'ঘ. ১৯২৫'
            ]
        ],
        [
            'title' => 'বাংলা ভাষার প্রথম গ্রন্থ কোনটি?',
            'question' => [
                'ক. মেঘনাদ বধ কাব্য',
                'খ. চর্বাপদ',
                'গ. গীতাঞ্জলি',
                'ঘ. সোনার তরী'
            ]
        ],
    ];
    public $paperquestion = [
        [
            'index' => 0,
            'title' => 'বাংলাদেশের রাজধানী কোনটি?',
            'question' => [
                'ক. চট্টগ্রাম',
                'খ. ঢাকা',
                'গ. খুলনা',
                'ঘ. রাজশাহী'
            ]
        ],
    ];
    public $totalQuestion = 1;
    public function addquestion($id)
    {
        $exists = collect($this->paperquestion)->contains('index', $id);

        if (!$exists) {
            $questionToAdd = $this->demoquestions[$id];
            $questionToAdd['index'] = $id;
            $this->paperquestion[] = $questionToAdd;
            $this->totalQuestion ++;
        }
    }
    public function removequestion($id)
    {
        $this->paperquestion = collect($this->paperquestion)
            ->reject(function ($item) use ($id) {
                return $item['index'] == $id;
            })
            ->values()
            ->toArray();
            $this->totalQuestion --;
    }

    public $videoModel = 'false';
    public function videoModelControll()
    {
        $this->videoModel = $this->videoModel == 'false' ? 'true' : 'false';
    }

    #[Title('Home')]
    public function render()
    {
        return view('livewire.ui.home');
    }
}
