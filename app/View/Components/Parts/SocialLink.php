<?php

namespace App\View\Components\Parts;

use App\Models\SiteSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SocialLink extends Component
{
    public $socialLink;
    public function __construct()
    {
        $siteSetting = SiteSetting::first();
        if ($siteSetting && $siteSetting->social_links) {
            $this->socialLink = json_decode($siteSetting->social_links, true);
        } else {
            $this->socialLink = [];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.parts.social-link');
    }
}
