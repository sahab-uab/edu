<?php

namespace App\Livewire\App;

use App\Models\Allsubject as ModelsAllsubject;
use App\Models\GroupeClass;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class AllSubjectes extends Component
{
    use WithPagination;

    // add or update
    public $editId = '';
    public $name = '';
    public $class_id = '';
    public function addSubject()
    {
        $this->validate([
            'name' => 'required',
            'class_id' => 'required|numeric'
        ], [
            'name.required' => 'অনুগ্রহ করে আপনার নাম প্রদান করুন।',
            'class_id.required' => 'অনুগ্রহ করে ক্লাস বাছায় করুন।',
            'class_id.numeric' => 'কিছু একটা সমাস্যা হয়ছে আবার চেস্টা করুন',
        ]);

        $sub = $this->editId ? ModelsAllsubject::find($this->editId) : new ModelsAllsubject();
        $sub->class_id = $this->class_id;
        $sub->name = $this->name;
        $save = $sub->save();

        if ($save) {
            session()->flash('success', $this->editId ? 'বিষয় পরিবর্তন সফল হয়েছে।' : 'নতুন বিষয় যুক্ত হয়েছে।');
            $this->reset(['name', 'class_id', 'editId']);
        } else {
            session()->flash('error', 'বিষয় সংরক্ষণে ত্রুটি ঘটেছে।');
        }
    }

    // fild clear
    public function clearfild()
    {
        $this->reset(['name', 'class_id', 'editId']);
    }

    // edit
    public function edit($id){
        $sub = ModelsAllsubject::find($id);
        $this->name = $sub->name;
        $this->class_id = $sub->class_id;
        $this->editId = $sub->id;
    }

    // delete
    public function delete($id){
        ModelsAllsubject::find($id)->delete();

        session()->flash('success', 'একটি বিষয় মুছে ফেলা হয়ছে।');
    }

    public $search = '';
    public $classes = '';
    #[Title('সকল বিষয়')]
    public function render()
    {
        // subject data
        $query = ModelsAllsubject::query();
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        if ($this->classes) {
            $query->where('class_id', $this->classes);
        }
        $data = $query->with('groupeClasses')->latest()->paginate(10);

        // class data
        $class = GroupeClass::pluck('name', 'id')->toArray();
        return view('livewire.app.all-subject', [
            'class' => $class,
            'data' => $data
        ]);
    }
}
