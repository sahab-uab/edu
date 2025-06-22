<?php

namespace App\Livewire\App;

use App\Models\GroupeClass;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class AllClasses extends Component
{
    use WithPagination;

    public $model = 'false';
    public $editId = '';
    public function modelhandler()
    {
        $this->model = $this->model == 'true' ? 'false' : 'true';
    }

    // add / update class
    public $name = '';
    public function classAdd()
    {
        $this->validate([
            'name' => 'required|unique:groupe_classes,name'
        ], [
            'name.required' => 'অনুগ্রহ করে ক্লাস নাম প্রদান করুন।',
            'name.unique' => 'অনুগ্রহ করে ভিন্ন ক্লাস নাম প্রদান করুন। এই নামে একটি ক্লাস রয়েছে',
        ]);

        $clas = $this->editId ? GroupeClass::find($this->editId) : new GroupeClass();
        $clas->name = $this->name;
        $clas->save();

        session()->flash('success', $this->editId ? 'ক্লাস পরিবর্তন সফল হয়েছে।' : 'নতুন ক্লাস যুক্ত হয়েছে।');
        $this->reset(['name', 'editId']);
        $this->model = 'false';
    }

    // edit
    public function edit($id)
    {
        $cls = GroupeClass::find($id);
        $this->name = $cls->name;
        $this->editId = $cls->id;
        $this->model = 'true';
    }

    // delete
    public function delete($id)
    {
        $cls = GroupeClass::find($id);
        $cls->delete();
        session()->flash('success', 'একটি ক্লাস মুছে ফেলা হয়ছে।');
    }

    public $search = '';
    #[Title('সকল ক্লাসসমুহ')]
    public function render()
    {
        $query = GroupeClass::query();
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        $data = $query->withCount(['lession', 'subject'])->latest()->paginate(10);
        return view('livewire.app.all-classes', [
            'data' => $data
        ]);
    }
}
