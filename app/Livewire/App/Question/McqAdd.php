<?php

namespace App\Livewire\App\Question;

use App\Models\Allsubject;
use App\Models\GroupeClass;
use App\Models\Lession;
use App\Models\McqQuestion;
use App\Models\QuestionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
class McqAdd extends Component
{
    use WithFileUploads;

    #[Url(as: 'id')]
    public $editId = null;
    public function mount()
    {
        if ($this->editId) {
            $data = McqQuestion::find($this->editId);
            if ($data) {
                $this->class_id = $data->class_id;
                $this->subject_id = $data->subject_id;
                $this->lession_id = $data->lession_id;
                $this->question_lavel = $data->lavel;
                $this->question_type_id = $data->type_id;
                $this->videoLink = $data->video_link;
                $this->image_align = $data->image_positon ?? 'left';
                $this->oldImage = $data->image_link;

                $this->questiontitle = $data->title;
                $this->answer = $data->right;
                $this->option_a = json_decode($data->normal_questions, true)['option_a'] ?? '';
                $this->option_b = json_decode($data->normal_questions, true)['option_b'] ?? '';
                $this->option_c = json_decode($data->normal_questions, true)['option_c'] ?? '';
                $this->option_d = json_decode($data->normal_questions, true)['option_d'] ?? '';

                if ($data->advance_questions || $data->question_lavel == 'difficult') {
                    $this->showMore = 'true';
                    $this->m_option_a = json_decode($data->advance_questions, true)['option_a'] ?? '';
                    $this->m_option_b = json_decode($data->advance_questions, true)['option_b'] ?? '';
                    $this->m_option_c = json_decode($data->advance_questions, true)['option_c'] ?? '';
                    $this->m_option_d = json_decode($data->advance_questions, true)['option_d'] ?? '';
                } else {
                    $this->showMore = 'false';
                }
            }
        }
    }

    public $showMore = 'false';

    public $class_id = '';
    public $subject_id = '';
    public $lession_id = '';
    public $question_lavel = 'genarel';
    public $question_type_id = '';
    public $videoLink = '';
    public $image = null;
    public $oldImage = null;
    public $image_align = 'left';

    // question options
    public $answer = null;
    public $questiontitle = '';

    public $option_a  = '';
    public $option_b  = '';
    public $option_c  = '';
    public $option_d  = '';

    public $m_option_a  = '';
    public $m_option_b  = '';
    public $m_option_c  = '';
    public $m_option_d  = '';

    // store
    public function store()
    {
        $this->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
            'lession_id' => 'required',
            'question_lavel' => 'required',
            'question_type_id' => 'required',
            'videoLink' => 'nullable|url',
            'image' => 'nullable|image|max:1024', // 1MB max
            'questiontitle' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'answer' => 'required',
            'm_option_a' => $this->showMore == 'true' ? 'required' : '',
            'm_option_b' => $this->showMore == 'true' ? 'required' : '',
            'm_option_c' => $this->showMore == 'true' ? 'required' : '',
            'm_option_d' => $this->showMore == 'true' ? 'required' : '',
        ], [
            'class_id.required' => 'ক্লাস নির্বাচন করুন।',
            'subject_id.required' => 'বিষয় নির্বাচন করুন।',
            'lession_id.required' => 'পাঠ নির্বাচন করুন।',
            'question_lavel.required' => 'প্রশ্নের স্তর নির্বাচন করুন।',
            'question_type_id.required' => 'প্রশ্নের ধরন নির্বাচন করুন।',
            'videoLink.url' => 'ভিডিও লিঙ্কটি একটি বৈধ URL হতে হবে।',
            'answer.required' => 'উত্তর নির্বাচন করুন।',
            'image.image' => 'ছবিটি একটি বৈধ ইমেজ ফাইল হতে হবে।',
            'image.max' => 'ছবির আকার 1MB এর বেশি হতে পারবে না।',
            'videoLink.url' => 'ভিডিও লিঙ্কটি একটি বৈধ URL হতে হবে।',
            'questiontitle.required' => 'প্রশ্নের শিরোনাম অবশ্যই পূরণ করতে হবে।',
            'option_a.required' => 'অপশন `ক` অবশ্যই পূরণ করতে হবে।',
            'option_b.required' => 'অপশন `খ` অবশ্যই পূরণ করতে হবে।',
            'option_c.required' => 'অপশন `গ` অবশ্যই পূরণ করতে হবে।',
            'option_d.required' => 'অপশন `ঘ` অবশ্যই পূরণ করতে হবে।',
            'm_option_a.required' => 'অপশন `ক` অবশ্যই পূরণ করতে হবে।',
            'm_option_b.required' => 'অপশন `খ` অবশ্যই পূরণ করতে হবে।',
            'm_option_c.required' => 'অপশন `গ` অবশ্যই পূরণ করতে হবে।',
            'm_option_d.required' => 'অপশন `ঘ` অবশ্যই পূরণ করতে হবে।',
        ]);

        $q = $this->editId ? McqQuestion::find($this->editId) : new McqQuestion();
        $q->class_id = $this->class_id;
        $q->subject_id = $this->subject_id;
        $q->lession_id = $this->lession_id;
        $q->type_id = $this->question_type_id;
        $q->lavel = $this->question_lavel;
        $q->video_link = $this->videoLink;
        if ($this->image) {
            if ($this->oldImage && Storage::disk('public')->exists($this->oldImage)) {
                Storage::disk('public')->delete($this->oldImage);
            }
            $uniqueName = uniqid() . '.' . $this->image->getClientOriginalExtension();
            $path = $this->image->storeAs('media', $uniqueName, 'public');

            $q->image_link = $path;
        }
        $q->image_positon = $this->image_align;
        $q->title = $this->questiontitle;
        $q->normal_questions = json_encode([
            'option_a' => $this->option_a,
            'option_b' => $this->option_b,
            'option_c' => $this->option_c,
            'option_d' => $this->option_d,
        ]);
        if ($this->showMore == 'true') {
            $q->advance_questions = json_encode([
                'option_a' => $this->m_option_a,
                'option_b' => $this->m_option_b,
                'option_c' => $this->m_option_c,
                'option_d' => $this->m_option_d,
            ]);
        } else {
            $q->advance_questions = null;
        }
        $q->right = $this->answer;
        $q->created_by = Auth::id();
        $save = $q->save();

        if ($save) {
            session()->flash('success', $this->editId ? 'MCQ প্রশ্ন সফলভাবে আপডেট করা হয়েছে।' : 'MCQ প্রশ্ন সফলভাবে সংরক্ষণ করা হয়েছে।');
            if (Auth::user()->role == 'admin') {
                $this->redirectRoute('ux.allquestions', navigate: true);
            } else {
                $this->redirectRoute('ux.writer.allquestions', navigate: true);
            }
        } else {
            session()->flash('error', 'MCQ প্রশ্ন সংরক্ষণে ত্রুটি ঘটেছে।');
        }
    }

    // reset form
    public function resetForm()
    {
        $this->reset([
            'class_id',
            'subject_id',
            'lession_id',
            'question_lavel',
            'question_type_id',
            'videoLink',
            'image',
            'image_align',
            'answer',
            'questiontitle',
            'option_a',
            'option_b',
            'option_c',
            'option_d',
            'm_option_a',
            'm_option_b',
            'm_option_c',
            'm_option_d',
            'showMore',
        ]);
    }

    // show more question options
    public function showmorequestion()
    {
        if ($this->question_lavel == 'difficult') {
            $this->showMore = 'true';
            $this->reset(['answer']);
        } else {
            $this->showMore = 'false';
            $this->reset(['answer']);
        }
    }

    // set image alignment
    public function setImageAlign($align)
    {
        $this->image_align = $align;
    }

    #[Title('MCQ প্রশ্ন তৈরি করুন')]
    public function render()
    {
        // classes
        $classes = GroupeClass::pluck('name', 'id')->toArray();
        // subject
        $subjects = [];
        if ($this->class_id) {
            $subjects = Allsubject::where('class_id', $this->class_id)->pluck('name', 'id')->toArray();
        } else {
            $subjects = Allsubject::pluck('name', 'id')->toArray();
        }
        // lession
        $lession = [];
        if ($this->class_id) {
            $lession = Lession::where('class_id', $this->class_id)->pluck('name', 'id')->toArray();
        } else {
            $lession = Lession::pluck('name', 'id')->toArray();
        }
        // question type
        $question_type = [];
        if ($this->class_id) {
            $question_type = QuestionType::pluck('name', 'id')->toArray();
        }
        return view('livewire.app.question.mcq-add', [
            'classes' => $classes,
            'subjects' => $subjects,
            'lession' => $lession,
            'question_type' => $question_type
        ]);
    }
}
