<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $type;
    public $hint;
    public $target;
    public $size;
    public $textarea;
    public $id;
    public function __construct($label='', $type = 'text', $hint='', $target='', $size='', $textarea='false', $id='')
    {
        $this->label = $label;
        $this->type = $type;
        $this->hint = $hint;
        $this->target = $target;
        $this->size = $size;
        $this->textarea = $textarea;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.input');
    }
}
