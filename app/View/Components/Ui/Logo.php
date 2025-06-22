<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Logo extends Component
{
    public $class;
    public $path;
    public $variant;
    public function __construct($class = '', $variant = 'light')
    {
        $this->class = $class;
        $this->variant = $variant;
        $this->path = get_media($this->variant == 'dark' ? 'logo-dark.svg' : 'logo.svg');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.logo');
    }
}
