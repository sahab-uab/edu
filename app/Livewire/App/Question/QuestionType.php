<?php

namespace App\Livewire\App\Question;

use App\Models\QuestionType as ModelsQuestionType;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class QuestionType extends Component
{

    // add ot edit
    public $editId = '';
    public $name = '';
    public function store()
    {
        $this->validate([
            'name' => 'required|unique:question_types,name'
        ], [
            'name.required' => 'অনুগ্রহ করে ধরন এর নাম প্রদান করুন।',
            'name.unique' => 'এই ধরনটি একটি পাওয়া গেছে ভিন্ন নাম প্রদান করুন।',
        ]);

        $type = $this->editId ? ModelsQuestionType::find($this->editId) : new ModelsQuestionType();
        $type->name = $this->name;
        $save = $type->save();

        if ($save) {
            session()->flash('success', $this->editId ? 'নতুন ধরন যুক্ত হয়েছে' : 'ধরন পরিবর্তন সফল হয়েছে');
            $this->reset(['editId', 'name']);
        } else {
            session()->flash('error', 'ধরন সংরক্ষণে ত্রুটি ঘটেছে।');
        }
    }

    // clear fild
    public function clearfild()
    {
        $this->reset(['name', 'search']);
    }

    // edit
    public function edit($id)
    {
        $data = ModelsQuestionType::find($id);
        $this->editId = $data->id;
        $this->name = $data->name;
    }

    // delete
    public function delete($id)
    {
        ModelsQuestionType::find($id)->delete();

        session()->flash('success', 'একটি ধরন মুছে ফেলা হয়ছে');
    }

    public $search = '';
    #[Title('প্রশ্নের ধরন')]
    public function render()
    {
        $query = ModelsQuestionType::query();
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        $data = $query->latest()->paginate(10);
        return view('livewire.app.question.question-type', [
            'data' => $data
        ]);
    }
}
