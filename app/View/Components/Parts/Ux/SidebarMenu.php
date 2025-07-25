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
                'icon' => 'ri-copper-diamond-line',
                'url' => route('ux.alltransaction'),
                'current' => ['ux.alltransaction'],
                'text' => 'সকল লেনদেন'
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
                'current' => ['ux.allstudent', 'ux.allteacher', 'ux.add.users', 'ux.alladmin', 'ux.allwriter'],
                'sub' => [
                    [
                        'url' => route('ux.alladmin'),
                        'text' => 'সকল এডমিন',
                        'current' => 'ux.alladmin'
                    ],
                    [
                        'url' => route('ux.allwriter'),
                        'text' => 'সকল এডিটর',
                        'current' => 'ux.allwriter'
                    ],
                    [
                        'url' => route('ux.allstudent'),
                        'text' => 'সকল ছাত্র/ছাত্রী',
                        'current' => 'ux.allstudent'
                    ],
                    [
                        'url' => route('ux.allteacher'),
                        'text' => 'সকল শিক্ষক',
                        'current' => 'ux.allteacher'
                    ],
                    [
                        'url' => route('ux.add.users'),
                        'text' => 'ইউজার তৈরি করুন',
                        'current' => 'ux.add.users'
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
                'current' => ['ux.allquestions', 'ux.addquestions', 'ux.questions.type', 'ux.addquestions.mcq', 'ux.allcqquestions', 'ux.addquestions.sq', 'ux.allquestions.sq'],
                'sub' => [
                    [
                        'url' => route('ux.allquestions'),
                        'text' => 'সকল প্রশ্ন',
                        'current' => 'ux.allquestions'
                    ],
                    [
                        'url' => route('ux.addquestions.mcq'),
                        'text' => 'MCQ প্রশ্ন তৈরি',
                        'current' => 'ux.addquestions.mcq'
                    ],
                    [
                        'url' => route('ux.addquestions'),
                        'text' => 'CQ প্রশ্ন তৈরি',
                        'current' => 'ux.addquestions'
                    ],
                    [
                        'url' => route('ux.addquestions.sq'),
                        'text' => 'SQ প্রশ্ন তৈরি',
                        'current' => 'ux.addquestions.sq'
                    ],
                    [
                        'url' => route('ux.questions.type'),
                        'text' => 'প্রশ্ন ধরন',
                        'current' => 'ux.questions.type'
                    ],
                ]
            ],
            [
                'icon' => 'ri-palette-line',
                'url' => '',
                'text' => 'কাস্টমাইজ',
                'current' => ['ux.allmenu'],
                'sub' => [
                    [
                        'url' => route('ux.allmenu'),
                        'text' => 'সকল মেনু',
                        'current' => 'ux.allmenu'
                    ],
                ]
            ],
            [
                'icon' => 'ri-delete-bin-4-line',
                'url' => '',
                'text' => 'রিসাইকেল বাক্স',
                'current' => ['ux.del.cqquestion', 'ux.del.sqquestion', 'ux.del.macquestion'],
                'sub' => [
                    [
                        'url' => route('ux.del.cqquestion'),
                        'text' => 'সকল CQ প্রশ্ন',
                        'current' => 'ux.del.cqquestion'
                    ],
                    [
                        'url' => route('ux.del.sqquestion'),
                        'text' => 'সকল SQ প্রশ্ন',
                        'current' => 'ux.del.sqquestion'
                    ],
                    [
                        'url' => route('ux.del.macquestion'),
                        'text' => 'সকল MCQ প্রশ্ন',
                        'current' => 'ux.del.macquestion'
                    ],
                ]
            ],
            [
                'icon' => 'ri-settings-2-line',
                'url' => '',
                'text' => 'সেটিংস',
                'current' => ['ux.smtp', 'ux.auth.setting', 'ux.site.setting', 'ux.question.setting'],
                'sub' => [
                    [
                        'url' => route('ux.site.setting'),
                        'text' => 'সাইট সেটিংস',
                        'current' => 'ux.site.setting'
                    ],
                    [
                        'url' => route('ux.smtp'),
                        'text' => 'ইমেইল',
                        'current' => 'ux.smtp'
                    ],
                    [
                        'url' => route('ux.auth.setting'),
                        'text' => 'অথেনটিকেট',
                        'current' => 'ux.auth.setting'
                    ],
                    [
                        'url' => route('ux.question.setting'),
                        'text' => 'প্রশ্ন',
                        'current' => 'ux.question.setting'
                    ],
                ]
            ]
        ];

        // for teacher menu
        $teacherMenu = [
            [
                'icon' => 'ri-dashboard-line',
                'url' => route('ux.dashboard'),
                'current' => ['ux.dashboard'],
                'text' => 'ড্যাশবোর্ড'
            ],
        ];

        // writer
        $writerMenu = [
            [
                'icon' => 'ri-dashboard-line',
                'url' => route('ux.dashboard'),
                'current' => ['ux.dashboard'],
                'text' => 'ড্যাশবোর্ড'
            ],
            [
                'icon' => 'ri-question-line',
                'url' => route('ux.writer.allquestions'),
                'text' => 'সকল প্রশ্ন',
                'current' => 'ux.writer.allquestions'
            ],
            [
                'icon' => 'ri-question-line',
                'url' => route('ux.writer.addquestions.mcq'),
                'text' => 'MCQ প্রশ্ন তৈরি',
                'current' => 'ux.writer.addquestions.mcq'
            ],
            [
                'icon' => 'ri-question-line',
                'url' => route('ux.writer.addquestions'),
                'text' => 'CQ প্রশ্ন তৈরি',
                'current' => 'ux.writer.addquestions'
            ],
            [
                'icon' => 'ri-question-line',
                'url' => route('ux.writer.addquestions.sq'),
                'text' => 'SQ প্রশ্ন তৈরি',
                'current' => 'ux.writer.addquestions.sq'
            ],
            [
                'icon' => 'ri-stack-line',
                'url' => route('ux.writer.allclasses'),
                'current' => ['ux.writer.allclasses'],
                'text' => 'সকল ক্লাস'
            ],
            [
                'icon' => 'ri-stack-line',
                'url' => route('ux.writer.questions.type'),
                'text' => 'প্রশ্ন ধরন',
                'current' => 'ux.writer.questions.type'
            ],
            [
                'icon' => 'ri-book-line',
                'url' => '',
                'text' => 'বিষয় বস্তু',
                'current' => ['ux.writer.allsubject', 'ux.writer.alllession'],
                'sub' => [
                    [
                        'url' => route('ux.writer.allsubject'),
                        'text' => 'সকল বিষয়',
                        'current' => 'ux.writer.allsubject'
                    ],
                    [
                        'url' => route('ux.writer.alllession'),
                        'text' => 'সকল অধ্যায়',
                        'current' => 'ux.writer.alllession'
                    ],
                ]
            ],
        ];

        if (Auth::user()->role == 'admin') {
            $this->menulist = $adminMenu;
        }
        if (Auth::user()->role == 'teacher') {
            $this->menulist = $teacherMenu;
        }
        if (Auth::user()->role == 'writer') {
            $this->menulist = $writerMenu;
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
