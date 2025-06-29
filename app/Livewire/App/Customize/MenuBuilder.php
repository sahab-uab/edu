<?php

namespace App\Livewire\App\Customize;

use App\Models\Menu;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class MenuBuilder extends Component
{

    public $menus;
    public function mount()
    {
        $this->loadMenus();
    }

    // after short load menu
    public function loadMenus()
    {
        $this->menus = Menu::with('children')->whereNull('parent_id')->orderBy('order')->get();
    }

    // short
    #[On('itemMoved')]
    public function itemMoved($itemId, $parentId, $order)
    {
        Menu::where('id', $itemId)->update([
            'parent_id' => $parentId,
        ]);

        foreach ($order as $item) {
            Menu::where('id', $item['id'])->update(['order' => $item['position']]);
        }

        $this->loadMenus();
    }

    // create or update
    public $menu_name = '';
    public $menu_link = '';
    public $menu_target = '_self';
    public $editId = '';
    public function store()
    {
        $this->validate([
            'menu_name' => 'required|min:1',
            'menu_link' => 'required|url',
            'menu_target'=>'required'
        ], [
            'menu_name.required' => 'মেনুর নাম প্রদান করুন।',
            'menu_target.required' => 'মেনুর পেজ প্রদান করুন।',
            'menu_name.min' => 'মেনুর নাম সর্বনিম্ন ১ সংখ্যার হতে হবে।',
            'menu_link' => 'মেনুর ্লিংক প্রদান করুন।',
            'menu_link.url' => 'এখানে সঠিক লিংক প্রদান করুন।'
        ]);

        $q = $this->editId ? Menu::find($this->editId) : new Menu();
        $q->title = $this->menu_name;
        $q->url = $this->menu_link;
        $q->target = $this->menu_target;
        $store = $q->save();
        if ($store) {
            session()->flash('success', 'নতুন মেনু তৈরি সফল হয়েছে।');
            $this->loadMenus();
            $this->reset(['menu_name', 'menu_link', 'editId', 'menu_target']);
        } else {
           session()->flash('error', $this->editId ? 'মেনু পরিবর্তন সফল হয়েছে।' : 'কিছু একটা সমাস্যা হয়েছে আবার চেস্টা করুন।');
           return;
        }
        
    }

    // delete
    public function delete($id){
        $delItem = Menu::find($id);
        if(!$delItem){
            session()->flash('error','কিছু একটা সমাস্যা হয়েছে আবার চেষ্টা করুন।');
            return;
        }
        $delItem->delete();
        session()->flash('success','একটি মেনু মুছে ফেলা হয়ছে।');
        $this->loadMenus();
    }

    // edit
    public function edit($id){
        $editItem = Menu::find($id);
        if(!$editItem){
            session()->flash('error','কিছু একটা সমাস্যা হয়েছে আবার চেষ্টা করুন।');
            return;
        }
        $this->menu_name = $editItem->title;
        $this->menu_link = $editItem->url;
        $this->menu_target = $editItem->target;
        $this->editId = $editItem->id;
    }

    #[Title('মেনু তৈরি করুন')]
    public function render()
    {
        return view('livewire.app.customize.menu-builder');
    }
}
