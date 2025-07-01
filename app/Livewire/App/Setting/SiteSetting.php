<?php

namespace App\Livewire\App\Setting;

use App\Models\SiteSetting as ModelsSiteSetting;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('components.layouts.admin')]
class SiteSetting extends Component
{
    use WithFileUploads;

    // social icons
    public $socialIcons = [
        'ri-facebook-fill' => 'Facebook',
        'ri-twitter-x-line' => 'Twitter/X',
        'ri-instagram-line' => 'Instagram',
        'ri-linkedin-fill' => 'LinkedIn',
        'ri-github-line' => 'GitHub',
        'ri-youtube-fill' => 'YouTube',
        'ri-pinterest-fill' => 'Pinterest',
        'ri-dribbble-line' => 'Dribbble',
        'ri-behance-line' => 'Behance',
        'ri-reddit-line' => 'Reddit',
        'ri-tiktok-fill' => 'TikTok',
        'ri-telegram-line' => 'Telegram',
        'ri-whatsapp-line' => 'WhatsApp',
        'ri-discord-line' => 'Discord',
        'ri-snapchat-line' => 'Snapchat',
        'ri-skype-line' => 'Skype',
        'ri-slack-line' => 'Slack',
        'ri-medium-line' => 'Medium',
        'ri-vimeo-fill' => 'Vimeo',
        'ri-stack-overflow-line' => 'Stack Overflow',
        'ri-spotify-fill' => 'Spotify',
        'ri-twitch-fill' => 'Twitch',
        'ri-apple-fill' => 'Apple',
        'ri-android-fill' => 'Android',
        'ri-wechat-fill' => 'WeChat',
        'ri-qq-line' => 'QQ',
        'ri-messenger-line' => 'Messenger',
        'ri-mail-line' => 'Email',
    ];

    // load data
    public $oldLogo = '';
    public $oldFavicon = '';
    public $siteMode = false;
    public $socialLinksList = null;
    public function loadData()
    {
        $data = ModelsSiteSetting::first();
        if ($data) {
            // site details
            $this->site_name = $data->site_name;
            $this->site_title = $data->site_title;
            $this->oldLogo = $data->logo;
            $this->oldFavicon = $data->favicon;

            // contact
            $this->emial = $data->contact_email;
            $this->phone_1 = $data->contact_phone;
            $this->phone_2 = $data->contact_phone_2;
            $this->address = $data->address;
            $this->map = $data->map_embed_url;
            $this->socialLinksList = json_decode($data->social_links, true);

            // seo
            $this->meta_title = $data->meta_title;
            $this->meta_description = $data->meta_description;
            $this->meta_keywords = $data->meta_keywords;

            // site mode
            $this->siteMode = $data->maintenance_mode;
        }
    }
    public function mount()
    {
        $this->loadData();
    }

    // site data
    public $logo;
    public $favicon;
    public $site_name = '';
    public $site_title = '';
    public function siteDataUpdate()
    {
        $this->validate([
            'site_name' => ['nullable', 'min:1'],
            'site_title' => ['nullable', 'min:1'],
            'logo' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg,webp'],
            'favicon' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg,ico,webp'],
        ], [
            'site_name.min' => 'সাইটের নাম অবশ্যই অন্তত ১ অক্ষরের হতে হবে।',
            'site_title.min' => 'সাইটের টাইটেল অবশ্যই অন্তত ১ অক্ষরের হতে হবে।',
            'logo.mimes' => 'লোগো লাইট অবশ্যই jpeg, png, jpg, gif, svg, অথবা webp ফরম্যাটে হতে হবে।',
            'favicon.mimes' => 'ফ্যাভিকন অবশ্যই jpeg, png, jpg, gif, svg, ico, অথবা webp ফরম্যাটে হতে হবে।',
        ]);

        $q = ModelsSiteSetting::first() ?? new ModelsSiteSetting();
        $q->site_name = $this->site_name;
        $q->site_title = $this->site_title;
        if ($this->logo) {
            if ($this->oldLogo && Storage::disk('public')->exists($this->oldLogo)) {
                Storage::disk('public')->delete($this->oldLogo);
            }
            $uniqueName = uniqid() . '.' . $this->logo->getClientOriginalExtension();
            $path = $this->logo->storeAs('media', $uniqueName, 'public');
            $q->logo = $path;
        }
        if ($this->favicon) {
            if ($this->oldFavicon && Storage::disk('public')->exists($this->oldFavicon)) {
                Storage::disk('public')->delete($this->oldFavicon);
            }
            $uniqueName = uniqid() . '.' . $this->favicon->getClientOriginalExtension();
            $path = $this->favicon->storeAs('media', $uniqueName, 'public');
            $q->favicon = $path;
        }
        $store = $q->save();
        if (!$store) {
            session()->flash('error', 'কিছু একটা সমাস্যা হয়েছে আবার চেষ্টা করুন।');
            return;
        }
        $this->reset(['site_name', 'site_title', 'logo', 'favicon']);
        session()->flash('success', 'সফল ভাবে সাইট-এর তথ্য পরিবর্তন করা হয়ছে।');
        $this->loadData();
    }

    // contact info
    public $emial = '';
    public $phone_1 = '';
    public $phone_2 = '';
    public $address = '';
    public $map = '';
    public function contactUpdate()
    {
        $this->validate([
            'emial' => ['nullable', 'email'],
            'phone_1' => ['nullable', 'string'],
            'phone_2' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'map' => ['nullable', 'string'],
        ], [
            'emial.email' => 'ইমেইলটি সঠিক ফরম্যাটে হতে হবে।',
            'phone_1.string' => 'ফোন নম্বর ১ অবশ্যই সঠিক ফরম্যাটে হতে হবে।',
            'phone_2.string' => 'ফোন নম্বর ২ অবশ্যই সঠিক ফরম্যাটে হতে হবে।',
            'address.string' => 'ঠিকানাটি অবশ্যই সঠিক ফরম্যাটে হতে হবে।',
            'map.string' => 'ম্যাপ লিংকটি অবশ্যই সঠিক ফরম্যাটে হতে হবে।',
        ]);

        $q = ModelsSiteSetting::first() ?? new ModelsSiteSetting();
        $q->contact_email = $this->emial;
        $q->contact_phone = $this->phone_1;
        $q->contact_phone_2 = $this->phone_2;
        $q->address = $this->address;
        $q->map_embed_url = $this->map;
        $store = $q->save();

        if (!$store) {
            session()->flash('error', 'কিছু একটা সমাস্যা হয়েছে আবার চেষ্টা করুন।');
            return;
        }
        session()->flash('success', 'যোগাযোগ তথ্য সফল ভাবে পরিবর্তন হয়েছে।');
        $this->loadData();
    }

    // seo
    public $meta_title = '';
    public $meta_description = '';
    public $meta_keywords = '';

    public function seoUpdate()
    {
        $this->validate([
            'meta_title' => ['nullable'],
            'meta_description' => ['nullable'],
            'meta_keywords' => ['nullable'],
        ], [
            'meta_title.nullable' => 'মেটা টাইটেল ফাঁকা থাকতে পারে।',
            'meta_description.nullable' => 'মেটা ডিসক্রিপশন ফাঁকা থাকতে পারে।',
            'meta_keywords.nullable' => 'মেটা কীওয়ার্ড ফাঁকা থাকতে পারে।',
        ]);

        $q = ModelsSiteSetting::first() ?? new ModelsSiteSetting();
        $q->meta_title = $this->meta_title;
        $q->meta_description = $this->meta_description;
        $q->meta_keywords = $this->meta_keywords;
        $store = $q->save();

        if (!$store) {
            session()->flash('error', 'কিছু একটা সমাস্যা হয়েছে আবার চেষ্টা করুন।');
            return;
        }
        session()->flash('success', 'SEO তথ্য সফলভাবে সংরক্ষণ করা হয়েছে।');
        $this->loadData();
    }

    // site  mode
    public function changestatus($status)
    {
        $q = ModelsSiteSetting::first() ?? new ModelsSiteSetting();
        $q->maintenance_mode = $status;
        $q->save();
        $this->loadData();
    }

    // social links
    public $social_icon = '';
    public $social_link = '';
    public function socialLinkUpdate()
    {
        $this->validate([
            'social_icon' => ['required', 'string'],
            'social_link' => ['required', 'url'],
        ], [
            'social_icon.required' => 'সোশ্যাল আইকন অবশ্যই নির্বাচন করতে হবে।',
            'social_icon.string' => 'সোশ্যাল আইকন অবশ্যই সঠিক ফরম্যাটে হতে হবে।',
            'social_link.required' => 'সোশ্যাল লিংক অবশ্যই প্রদান করতে হবে।',
            'social_link.url' => 'সোশ্যাল লিংক অবশ্যই একটি বৈধ URL হতে হবে।',
        ]);

        $socialLinks = is_array($this->socialLinksList) ? $this->socialLinksList : [];
        $socialLinks[$this->social_icon] = $this->social_link;

        $q = ModelsSiteSetting::first() ?? new ModelsSiteSetting();
        $q->social_links = json_encode($socialLinks, JSON_UNESCAPED_UNICODE);
        $store = $q->save();

        if (!$store) {
            session()->flash('error', 'কিছু একটা সমাস্যা হয়েছে আবার চেষ্টা করুন।');
            return;
        }
        session()->flash('success', 'সোশ্যাল লিংক সফলভাবে সংরক্ষণ করা হয়েছে।');
        $this->reset(['social_icon', 'social_link']);
        $this->loadData();
    }

    // edit
    public function editSocialLink($icon)
    {
        $socialLinks = is_array($this->socialLinksList) ? $this->socialLinksList : [];
        if (isset($socialLinks[$icon])) {
            $this->social_icon = $icon;
            $this->social_link = $socialLinks[$icon];
        }
    }
    
    // delte
    public function deleteSocialLink($icon)
    {
        $socialLinks = is_array($this->socialLinksList) ? $this->socialLinksList : [];
        if (isset($socialLinks[$icon])) {
            unset($socialLinks[$icon]);
            $q = ModelsSiteSetting::first() ?? new ModelsSiteSetting();
            $q->social_links = json_encode($socialLinks, JSON_UNESCAPED_UNICODE);
            $store = $q->save();

            if (!$store) {
                session()->flash('error', 'কিছু একটা সমাস্যা হয়েছে আবার চেষ্টা করুন।');
                return;
            }
            session()->flash('success', 'সোশ্যাল লিংক সফলভাবে মুছে ফেলা হয়েছে।');
            $this->loadData();
        }
    }

    // tab switch
    public $tabActive = 'site';
    public function tabSwithc($tab){
        $this->tabActive = $tab;
    }

    #[Title('সাইট সেটিংস')]
    public function render()
    {
        return view('livewire.app.setting.site-setting');
    }
}
