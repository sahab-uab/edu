<?php

namespace App\View\Components\Parts\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    public $menu = [];
    public function __construct()
    {
        $this->menu = [
            'হোম' => route('ux.dashboard'),
            '১-১৩ ক্লাস' => '/',
            'আরো দেখুন' => [
                'যোগাযোগ' => '/',
                'আমাদর সম্পর্কে' => '/'
            ],
            'দেখুন' => [
                'যোগাযোগ' => '/',
                'আমাদর সম্পর্কে' => '/'
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.parts.ui.menu');
    }
}
