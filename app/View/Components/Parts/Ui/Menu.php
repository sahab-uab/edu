<?php

namespace App\View\Components\Parts\Ui;

use App\Models\Menu as ModelsMenu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    public $menu = [];
    public function __construct()
    {
        $menuList = ModelsMenu::with('children')->whereNull('parent_id')->orderBy('order')->get();
        $this->menu = [];
        foreach ($menuList as $item) {
            if ($item->children->isNotEmpty()) {
            $children = [];
            foreach ($item->children as $child) {
                $children[$child->title] = [
                'url' => $child->url ?? '#',
                'target' => $child->target ?? '_self',
                ];
            }
            $this->menu[$item->title] = [
                'children' => $children,
                'url' => $item->url ?? '#',
                'target' => $item->target ?? '_self',
            ];
            } else {
            $this->menu[$item->title] = [
                'url' => $item->url ?? '#',
                'target' => $item->target ?? '_self',
            ];
            }
        }
        // dd($this->menu);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.parts.ui.menu');
    }
}
