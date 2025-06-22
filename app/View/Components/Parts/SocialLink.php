<?php

namespace App\View\Components\Parts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SocialLink extends Component
{
    public $socialLink;
    public function __construct()
    {
        $this->socialLink = [
            ['ri-facebook-line' => '/'],
            ['ri-instagram-line' => '/'],
            ['ri-twitter-line' => '/'],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.parts.social-link');
    }
}
