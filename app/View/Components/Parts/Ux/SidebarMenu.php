<?php

namespace App\View\Components\Parts\Ux;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class SidebarMenu extends Component
{
    public $menulist = [];
    public function __construct()
    {
        // admin menu
        $adminMenu = [
            [
                'icon' => 'ri-dashboard-line',
                'url' => route('ux.dashboard'),
                'current' => ['ux.dashboard'],
                'text' => 'ড্যাশবোর্ড'
            ],
            [
                'icon' => 'ri-stack-line',
                'url' => route('ux.allclasses'),
                'current' => ['ux.allclasses'],
                'text' => 'সকল ক্লাস'
            ],
            [
                'icon' => 'ri-user-line',
                'url' => '',
                'text' => 'সকল ইউজার',
                'current' => ['ux.allstudent', 'ux.addstudent'],
                'sub' => [
                    [
                        'url' => route('ux.allstudent'),
                        'text' => 'সকল ছাত্র/ছাত্রী',
                        'current' => 'ux.allstudent'
                    ],
                ]
            ],
            [
                'icon' => 'ri-book-line',
                'url' => '',
                'text' => 'বিষয় বস্তু',
                'current' => ['ux.allsubject', 'ux.alllession'],
                'sub' => [
                    [
                        'url' => route('ux.allsubject'),
                        'text' => 'সকল বিষয়',
                        'current' => 'ux.allsubject'
                    ],
                    [
                        'url' => route('ux.alllession'),
                        'text' => 'সকল অধ্যায়',
                        'current' => 'ux.alllession'
                    ],
                ]
            ],
            [
                'icon' => 'ri-question-line',
                'url' => '',
                'text' => 'সকল প্রশ্ন',
                'current' => ['ux.allquestions', 'ux.addquestions', 'ux.questions.type', 'ux.addquestions.mcq'],
                'sub' => [
                    [
                        'url' => route('ux.allquestions'),
                        'text' => 'সকল প্রশ্ন',
                        'current' => 'ux.allquestions'
                    ],
                    [
                        'url' => route('ux.questions.type'),
                        'text' => 'প্রশ্ন ধরন',
                        'current' => 'ux.questions.type'
                    ],
                    [
                        'url' => route('ux.addquestions.mcq'),
                        'text' => 'MCQ প্রশ্ন',
                        'current' => 'ux.addquestions.mcq'
                    ],
                    [
                        'url' => route('ux.addquestions'),
                        'text' => 'নতুন প্রশ্ন',
                        'current' => 'ux.addquestions'
                    ],
                ]
            ]
        ];

        // for teacher menu
        $teacherMenu = [
            [
                'icon' => 'ri-dashboard-line',
                'url' => '',
                'text' => 'ড্যাশবোর্ড'
            ],
        ];

        if (Auth::user()->role == 'admin') {
            $this->menulist = $adminMenu;
        }
        if (Auth::user()->role == 'teacher') {
            $this->menulist = $teacherMenu;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.parts.ux.sidebar-menu');
    }
}
