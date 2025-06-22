<?php

namespace App\View\Components\Parts\Ux;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public $title;
    public function __construct($title='পেজ টাইটেল')
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.parts.ux.header');
    }
}
