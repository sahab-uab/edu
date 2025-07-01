<?php

namespace App\View\Components\Ui;

use App\Models\SiteSetting;
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
        $siteSetting = SiteSetting::first();
        $this->class = $class;
        $this->variant = $variant;
        if ($siteSetting) {
            if ($this->variant == 'dark') {
                $this->path = $siteSetting->logo_dark ?  asset('storage/' . $siteSetting->logo_dark) : get_media();
            }
            if ($this->variant == 'light') {
                $this->path = $siteSetting->logo ?  asset('storage/' . $siteSetting->logo) : get_media();
            }
        } else {
            $this->path = get_media();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.logo');
    }
}
