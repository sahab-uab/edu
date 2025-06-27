<?php

namespace App\Livewire\App\Question;

use App\Models\Allsubject;
use App\Models\GroupeClass;
use App\Models\Lession;
use App\Models\QuestionType;
use App\Models\SqQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
class AddSqQuestion extends Component
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
        ]);

        $q = $this->editId ? SqQuestion::find($this->editId) : new SqQuestion();
        $q->class_id = $this->class_id;
        $q->type_id     = $this->question_type_id;
        $q->subject_id = $this->subject_id;
        $q->lession_id = $this->lession_id;
        $q->questiontitle = $this->questiontitle;
        $q->q_1 = $this->q_1;
        $q->q_1_ans = $this->q_1_ans;
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
        $save = $q->save();

        if ($save) {
            session()->flash('success', $this->editId ? 'প্রশ্ন আপডেট হয়েছে।' : 'প্রশ্ন সফলভাবে সংরক্ষণ করা হয়েছে।');
            $this->redirectRoute('ux.addquestions.sq', navigate: true);
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
        $this->reset(['class_id', 'subject_id', 'lession_id', 'question_type_id', 'image', 'videoLink', 'questiontitle', 'q_1', 'q_1_ans']);
    }

    #[Url(as: 'id')]
    public $editId = null;
    public function mount()
    {
        if ($this->editId) {
            $data = SqQuestion::find($this->editId);
            if ($data) {
                $this->class_id = $data->class_id;
                $this->subject_id = $data->subject_id;
                $this->lession_id = $data->lession_id;
                $this->question_type_id = $data->type_id;
                $this->image_align = $data->image_align;
                $this->questiontitle = $data->questiontitle;
                $this->q_1 = $data->q_1;
                $this->q_1_ans = $data->q_1_ans;
                $this->oldImage = $data->image;
                $this->videoLink = $data->videoLink;
            } else {
                session()->flash('error', 'কিছু একটা সমাস্যা হয়েছে আবার চেস্টা করুন।');
                $this->redirectRoute('ux.addquestions.sq', navigate: true);
            }
        }
    }

    #[Title('SQ প্রশ্ন তৈরি করুন')]
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
        return view('livewire.app.question.add-sq-question', [
            'classes' => $classes,
            'subjects' => $subjects,
            'lession' => $lession,
            'question_type' => $question_type,
        ]);
    }
}
