<?php

namespace App\View\Components\Parts\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Faqs extends Component
{
    public $faqQuestions;
    public function __construct()
    {
        $this->faqQuestions = [
            [
                'icon' => 'ri-user-smile-line',
                'question' => 'আপনার সার্ভিস কেমন?',
                'answer' => 'আমাদের সার্ভিস দ্রুত, নির্ভরযোগ্য এবং গ্রাহকসেবা খুবই উন্নত।'
            ],
            [
                'icon' => 'ri-emotion-sad-line',
                'question' => 'কীভাবে অর্ডার করতে পারি?',
                'answer' => 'ওয়েবসাইটে লগইন করে প্রোডাক্ট সিলেক্ট করুন, কার্টে যোগ করুন এবং পেমেন্ট সম্পন্ন করুন।'
            ],
            [
                'icon' => 'ri-robot-2-line',
                'question' => 'পেমেন্ট মেথড গুলো কী কী?',
                'answer' => 'আমরা বিভিন্ন পেমেন্ট গেটওয়ে সমর্থন করি যেমন বিকাশ, নগদ, রকেট এবং ক্রেডিট/ডেবিট কার্ড।'
            ],
            [
                'icon' => 'ri-ghost-line',
                'question' => 'অর্ডার কতো দিনের মধ্যে পাবো?',
                'answer' => 'অর্ডার প্লেস করার ৩ থেকে ৫ কার্যদিবসের মধ্যে পণ্য পৌঁছে দেওয়া হয়।'
            ],
            [
                'icon' => 'ri-star-smile-line',
                'question' => 'রিটার্ন নীতি কী?',
                'answer' => 'পণ্য প্রাপ্তির ৭ দিনের মধ্যে যেকোনো কারণেই রিটার্ন করা যাবে যদি পণ্য অক্ষত থাকে।'
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.parts.ui.faqs');
    }
}
