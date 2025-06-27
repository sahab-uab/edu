<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class Button extends Component
{
    public string $text;
    public string $type;
    public string $variant;
    public ?string $href;
    public ?string $iconclass;
    public ?string $class;
    public $size;
    public $target;
    public $iconposition;
    public $route;

    public function __construct($text = 'বাটন', $type = 'button', $variant = 'primary', $href = null, $iconclass = null, $class = '', $size = 'base', $target = '', $iconposition='right', $route = null)
    {
        $this->text = $text;
        $this->type = $type;
        $this->variant = $variant;
        $this->href = $href;
        $this->iconclass = $iconclass;
        $this->class = $class;
        $this->size = $size;
        $this->target = $target;
        $this->iconposition = $iconposition;
        $this->route = $route;
    }

    public function render()
    {
        return view('components.ui.button');
    }
}
