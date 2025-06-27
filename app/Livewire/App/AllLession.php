<?php

namespace App\Livewire\App;

use App\Models\Allsubject;
use App\Models\GroupeClass;
use App\Models\Lession;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class AllLession extends Component
{
    use WithPagination;

    // add or update
    public $class_id = '';
    public $subject_id = '';
    public $name = '';
    public $editId = '';
    public function addLession()
    {
        $this->validate([
            'name' => 'required',
            'class_id' => 'required|numeric',
            'subject_id' => 'required|numeric',
        ], [
            'name.required' => 'অনুগ্রহ করে আপনার নাম প্রদান করুন।',
            'class_id.required' => 'অনুগ্রহ করে ক্লাস বাছায় করুন।',
            'class_id.numeric' => 'কিছু একটা সমাস্যা হয়ছে আবার চেস্টা করুন।',
            'subject_id.required' => 'অনুগ্রহ করে বিষয় বাছায় করুন।',
            'subject_id.numeric' => 'কিছু একটা সমাস্যা হয়ছে আবার চেস্টা করুন।'
        ]);

        $les = $this->editId ? Lession::find($this->editId) : new Lession();
        $les->class_id = $this->class_id;
        $les->subject_id = $this->subject_id;
        $les->name = $this->name;
        $save = $les->save();

        if ($save) {
            session()->flash('success', $this->editId ? 'অধ্যায় পরিবর্তন সফয় হয়েছে।' : 'নতুন অধ্যায় তৈরী করা সফল হয়ছে।');
            $this->reset(['subject_id', 'class_id', 'name', 'editId']);
        } else {
            session()->flash('error', 'অধ্যায় সংরক্ষণে ত্রুটি ঘটেছে।');
        }
    }

    // clear fild
    public function clearfild()
    {
        $this->reset(['name', 'class_id', 'editId', 'subject_id']);
    }

    // edit
    public function edit($id)
    {
        $les = Lession::find($id);
        $this->class_id = $les->class_id;
        $this->subject_id = $les->subject_id;
        $this->name = $les->name;
        $this->editId = $les->id;
    }

    // delte
    public function delete($id)
    {
        Lession::find($id)->delete();

        session()->flash('success', 'একটি অধ্যায় মুছে ফেলা হয়ছে।');
    }

    public $search = '';
    public $classes = '';
    #[Title('সকল অধ্যায়')]
    public function render()
    {
        $query = Lession::query();
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        if ($this->classes) {
            $query->where('class_id', $this->classes);
        }
        $data = $query->latest()->with(['subjects', 'groupeClasses'])->paginate(10);

        // class
        $class = GroupeClass::pluck('name', 'id')->toArray();
        // subject
        $allsubject = [];
        if ($this->class_id) {
            $allsubject = Allsubject::where('class_id', $this->class_id)->pluck('name', 'id')->toArray();
        } else {
            $allsubject = Allsubject::pluck('name', 'id')->toArray();
        }
        return view('livewire.app.all-lession', [
            'data' => $data,
            'class' => $class,
            'allsubject' => $allsubject
        ]);
    }
}
