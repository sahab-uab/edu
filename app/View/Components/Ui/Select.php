<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $target;
    public $size;
    public $label;
    public $dataoption;
    public function __construct($label = '', $target = '', $size = '', $dataoption = [])
    {
        $this->label = $label;
        $this->target = $target;
        $this->size = $size;
        $this->dataoption = $dataoption;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.select');
    }
}
