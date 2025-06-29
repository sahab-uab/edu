<?php

namespace App\Livewire\App\Setting;

use App\Mail\Mailer;
use App\Models\MailSetting;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Smtp extends Component
{
    public $mailer = '';
    public $host = '';
    public $port = '';
    public $username = '';
    public $password = '';
    public $encryption = '';
    public $from_address = '';
    public $from_name = '';

    public $redyfortest = 'false';

    public function mount()
    {
        $data = MailSetting::first();
        if ($data) {
            $this->mailer =       $data->mail_mailer;
            $this->host =         $data->mail_host;
            $this->port =         $data->mail_port;
            $this->username =     $data->mail_username;
            $this->password =     $data->mail_password;
            $this->encryption =   $data->mail_encryption;
            $this->from_address = $data->mail_from_address;
            $this->from_name =    $data->mail_from_name;
            $this->redyfortest  = 'true';
        }
    }

    // update
    protected $rules = [
        'mailer' => 'required',
        'host' => 'required',
        'port' => 'required|numeric',
        'username' => 'required',
        'password' => 'required',
        'encryption' => 'required',
        'from_address' => 'required|email',
        'from_name' => 'required',
    ];
    protected $messages = [
        'mailer.required' => 'মেইলার অবশ্যই দিতে হবে।',
        'host.required' => 'হোস্ট অবশ্যই দিতে হবে।',
        'port.required' => 'পোর্ট অবশ্যই দিতে হবে।',
        'port.numeric' => 'পোর্ট অবশ্যই একটি সংখ্যা হতে হবে।',
        'username.required' => 'ইউজারনেম অবশ্যই দিতে হবে।',
        'password.required' => 'পাসওয়ার্ড অবশ্যই দিতে হবে।',
        'encryption.required' => 'এনক্রিপশন অবশ্যই দিতে হবে।',
        'from_address.required' => 'প্রেরকের ইমেইল অবশ্যই দিতে হবে।',
        'from_address.email' => 'প্রেরকের ইমেইল সঠিক ফরম্যাটে হতে হবে।',
        'from_name.required' => 'প্রেরকের নাম অবশ্যই দিতে হবে।',
    ];

    public function store()
    {
        $this->validate();
        $smtp = MailSetting::first() ?? new MailSetting();
        $smtp->mail_mailer = $this->mailer;
        $smtp->mail_host = $this->host;
        $smtp->mail_port = $this->port;
        $smtp->mail_username = $this->username;
        $smtp->mail_password = $this->password;
        $smtp->mail_encryption = $this->encryption;
        $smtp->mail_from_address = $this->from_address;
        $smtp->mail_from_name = $this->from_name;
        $store = $smtp->save();

        if (!$store) {
            session()->flash('error', 'কিছু একটা সমাস্যা হয়েছে আবার চেস্টা করুন।');
            return;
        } else {
            session()->flash('success', 'সেটিংস পরিবর্তন সফল হয়েছে।');
            $this->redyfortest = 'true';
        }
    }

    // send text email
    public $test_email  = '';
    public function testemail()
    {
        $this->validate([
            'test_email' => 'required|email'
        ], [
            'test_email.required' => 'ইমেইল প্রদান করুন',
            'test_email.mail' => 'সঠিক ইমেইল প্রদান করুন'
        ]);

        try {
            Mail::to($this->test_email)->send(new Mailer('পরিক্ষামূলক ইমেইল', 'mail.test', []));
            session()->flash('success', 'পরীক্ষামূলক ইমেইল সফলভাবে পাঠানো হয়েছে।');
            $this->reset(['test_email']);
        } catch (\Exception $e) {
            session()->flash('error', 'ইমেইল পাঠাতে ব্যর্থ হয়েছে: ' . $e->getMessage());
        }
    }

    #[Title('ইমেইল[SMTP] সেটিংস')]
    public function render()
    {
        return view('livewire.app.setting.smtp');
    }
}
