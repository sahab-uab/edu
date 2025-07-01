<?php

namespace App\Livewire\App\Question;

use App\Models\Allsubject;
use App\Models\CqQuestion;
use App\Models\GroupeClass;
use App\Models\Lession;
use App\Models\QuestionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
class AddQuestions extends Component
{
    use WithFileUploads;

    public $class_id = '';
    public $subject_id = '';
    public $lession_id = '';
    public $question_type_id = '';

    public $image_align = 'left';
    public $image;
    public $oldImage = null;
    public $videoLink = '';

    public $questiontitle = '';
    public $q_1 = '';
    public $q_1_ans = '';
    public $q_2 = '';
    public $q_2_ans = '';
    public $q_3 = '';
    public $q_3_ans = '';
    public $q_4 = '';
    public $q_4_ans = '';

    #[Url(as: 'id')]
    public $editId = null;
    public function mount()
    {
        if ($this->editId) {
            $data = CqQuestion::find($this->editId);
            if ($data) {
                $this->class_id = $data->class_id;
                $this->subject_id = $data->subject_id;
                $this->lession_id = $data->lession_id;
                $this->question_type_id = $data->type_id;
                $this->image_align = $data->image_align;
                $this->questiontitle = $data->questiontitle;
                $this->q_1 = $data->q_1;
                $this->q_1_ans = $data->q_1_ans;
                $this->q_2 = $data->q_2;
                $this->q_2_ans = $data->q_2_ans;
                $this->q_3 = $data->q_3;
                $this->q_3_ans = $data->q_3_ans;
                $this->q_4 = $data->q_4;
                $this->q_4_ans = $data->q_4_ans;
                $this->oldImage = $data->image;
                $this->videoLink = $data->videoLink;
            } else {
                session()->flash('error', 'কিছু একটা সমাস্যা হয়েছে আবার চেস্টা করুন।');
                $this->redirectRoute('ux.allcqquestions', navigate: true);
            }
        }
    }

    // add / update question 
    public function store()
    {
        $this->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
            'lession_id' => 'required',
            'question_type_id' => 'required',

            'videoLink' => 'nullable|url',
            'image' => 'nullable|image|max:1024', // 1MB max

            'questiontitle' => 'required',
            'q_1' => 'required',
            'q_1_ans' => 'nullable|min:3',
            'q_2' => 'required',
            'q_2_ans' => 'nullable|min:3',
            'q_3' => 'required',
            'q_3_ans' => 'nullable|min:3',
            'q_4' => 'required',
            'q_4_ans' => 'nullable|min:3',
        ], [
            'class_id.required' => 'ক্লাস নির্বাচন করুন।',
            'subject_id.required' => 'বিষয় নির্বাচন করুন।',
            'lession_id.required' => 'পাঠ নির্বাচন করুন।',
            'question_type_id.required' => 'প্রশ্নের ধরন নির্বাচন করুন।',
            'videoLink.url' => 'ভিডিও লিঙ্কটি একটি বৈধ URL হতে হবে।',
            'image.image' => 'আপলোড করা ফাইলটি একটি বৈধ ছবি হতে হবে।',
            'image.max' => 'ছবির আকার 1MB এর বেশি হতে পারবে না।',
            'questiontitle.required' => 'প্রশ্নের শিরোনাম অবশ্যই পূরণ করতে হবে।',
            'q_1.required' => 'প্রশ্ন ১ এর বিষয়বস্তু অবশ্যই পূরণ করতে হবে।',
            'q_1_ans.min' => 'প্রশ্ন ১ এর উত্তরটি কমপক্ষে ৩ অক্ষর হতে হবে।',
            'q_2.required' => 'প্রশ্ন ২ এর বিষয়বস্তু অবশ্যই পূরণ করতে হবে।',
            'q_2_ans.min' => 'প্রশ্ন ২ এর উত্তরটি কমপক্ষে ৩ অক্ষর হতে হবে।',
            'q_3.required' => 'প্রশ্ন ৩ এর বিষয়বস্তু অবশ্যই পূরণ করতে হবে।',
            'q_3_ans.min' => 'প্রশ্ন ৩ এর উত্তরটি কমপক্ষে ৩ অক্ষর হতে হবে।',
            'q_4.required' => 'প্রশ্ন ৪ এর বিষয়বস্তু অবশ্যই পূরণ করতে হবে।',
            'q_4_ans.min' => 'প্রশ্ন ৪ এর উত্তরটি কমপক্ষে ৩ অক্ষর হতে হবে।',
        ]);

        $q = $this->editId ? CqQuestion::find($this->editId) : new CqQuestion();
        $q->class_id = $this->class_id;
        $q->type_id     = $this->question_type_id;
        $q->subject_id = $this->subject_id;
        $q->lession_id = $this->lession_id;
        $q->questiontitle = $this->questiontitle;
        $q->q_1 = $this->q_1;
        $q->q_1_ans = $this->q_1_ans;
        $q->q_2 = $this->q_2;
        $q->q_2_ans = $this->q_2_ans;
        $q->q_3 = $this->q_3;
        $q->q_3_ans = $this->q_3_ans;
        $q->q_4 = $this->q_4;
        $q->q_4_ans = $this->q_4_ans;
        $q->image_align = $this->image_align;
        if ($this->image) {
            if ($this->oldImage && Storage::disk('public')->exists($this->oldImage)) {
                Storage::disk('public')->delete($this->oldImage);
            }
            $uniqueName = uniqid() . '.' . $this->image->getClientOriginalExtension();
            $path = $this->image->storeAs('media', $uniqueName, 'public');

            $q->image = $path;
        }
        $q->videoLink = $this->videoLink;
        $q->created_by = Auth::id();
        if ($this->editId) {
            $q->updated_by = Auth::id();
        }
        $save = $q->save();

        if ($save) {
            session()->flash('success', $this->editId ? 'প্রশ্ন আপডেট হয়েছে।' : 'প্রশ্ন সফলভাবে সংরক্ষণ করা হয়েছে।');
            if (Auth::user()->role == 'admin') {
                $this->redirectRoute('ux.allcqquestions', navigate: true);
            } else {
                $this->redirectRoute('ux.writer.allcqquestions', navigate: true);
            }
        } else {
            session()->flash('error', 'প্রশ্ন সংরক্ষণে ত্রুটি ঘটেছে।');
        }
    }

    // set image alignment
    public function setImageAlign($align)
    {
        $this->image_align = $align;
    }

    // reset form fields
    public function resetForm()
    {
        $this->reset([
            'class_id',
            'subject_id',
            'lession_id',
            'image',
            'oldImage',
            'videoLink',
            'questiontitle',
            'q_1',
            'q_1_ans',
            'q_2',
            'q_2_ans',
            'q_3',
            'q_3_ans',
            'q_4',
            'q_4_ans',
            'editId',
        ]);
    }

    #[Title('CQ প্রশ্ন তৈরি করুন')]
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
        return view('livewire.app.question.add-questions', [
            'classes' => $classes,
            'subjects' => $subjects,
            'lession' => $lession,
            'question_type' => $question_type,
        ]);
    }
}
