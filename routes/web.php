<?php

use App\Livewire\App\Question\AddQuestions;
use App\Livewire\App\AllClasses;
use App\Livewire\App\AllLession;
use App\Livewire\App\Question\AllQuestions;
use App\Livewire\App\AllSubjectes;
use App\Livewire\App\Customize\MenuBuilder;
use App\Livewire\App\Dashboard;
use App\Livewire\App\Profile\ProfileInfo;
use App\Livewire\App\Profile\Security;
use App\Livewire\App\Question\AddSqQuestion;
use App\Livewire\App\Question\AllCqQuestion;
use App\Livewire\App\Question\AllSqQuestion;
use App\Livewire\App\Question\McqAdd;
use App\Livewire\App\Question\QuestionType;
use App\Livewire\App\Setting\Auth;
use App\Livewire\App\Setting\SiteSetting;
use App\Livewire\App\Setting\Smtp;
use App\Livewire\App\Users\AddUsers;
use App\Livewire\App\Users\AllAdmin;
use App\Livewire\App\Users\AllStudent;
use App\Livewire\App\Users\AllTecher;
use App\Livewire\App\Users\AllWriter;
use App\Livewire\Ui\Auth\Forget;
use App\Livewire\Ui\Auth\Google;
use App\Livewire\Ui\Auth\Login;
use App\Livewire\Ui\Auth\Logout;
use App\Livewire\Ui\Auth\Register;
use App\Livewire\Ui\Auth\ResetPass;
use App\Livewire\Ui\Auth\Rolechoice;
use App\Livewire\Ui\Home;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Route;

Route::middleware('maintenance')->group(function () {
    // ui
    Route::get('/', Home::class)->name('ui.home');

    // social auth
    Route::get('/auth/redirect', function () {
        return Socialite::driver('google')->redirect();
    })->name('google.redirect');
    Route::get('/auth/google/callback', Google::class);

    // site auth
    Route::middleware(['guestCheck'])->group(function () {
        Route::get('/login', Login::class)->name('ui.login');
        Route::get('/signup', Register::class)->name('ui.signup');
        Route::get('/forgat-password', Forget::class)->name('ui.forgate');
        Route::get('/reset-password/{token}', ResetPass::class)->name('ui.password.reset');
    });

    // role select
    Route::middleware(['authCheck'])->group(function () {
        Route::get('/choicerole', Rolechoice::class)->name('ui.setrole');
    });
});

// app
Route::prefix('/app')->middleware(['authCheck', 'checkrole', 'userStatus'])->group(function () {
    Route::get('/', Dashboard::class)->name('ux.dashboard');
    // for admin
    Route::middleware('roleBase:admin')->group(function () {
        // users
        Route::get('/add-users', AddUsers::class)->name('ux.add.users');
        Route::get('/all-student', AllStudent::class)->name('ux.allstudent');
        Route::get('/all-teacher', AllTecher::class)->name('ux.allteacher');
        Route::get('/all-admin', AllAdmin::class)->name('ux.alladmin');
        Route::get('/all-writer', AllWriter::class)->name('ux.allwriter');

        // for questions
        Route::get('/question-type', QuestionType::class)->name('ux.questions.type');
        Route::get('/all-questions', AllQuestions::class)->name('ux.allquestions');
        Route::get('/add-mcq-questions', McqAdd::class)->name('ux.addquestions.mcq');
        Route::get('/all-cq-questions', AllCqQuestion::class)->name('ux.allcqquestions');
        Route::get('/add-questions', AddQuestions::class)->name('ux.addquestions');
        Route::get('/all-sq-questions', AllSqQuestion::class)->name('ux.allquestions.sq');
        Route::get('/add-sq-questions', AddSqQuestion::class)->name('ux.addquestions.sq');

        // customize
        Route::get('/all-menu', MenuBuilder::class)->name('ux.allmenu');

        // settings
        Route::get('/smtp', Smtp::class)->name('ux.smtp');
        Route::get('/auth-setting', Auth::class)->name('ux.auth.setting');
        Route::get('/site-setting', SiteSetting::class)->name('ux.site.setting');

        // single
        Route::get('/all-classes', AllClasses::class)->name('ux.allclasses');
        Route::get('/all-subject', AllSubjectes::class)->name('ux.allsubject');
        Route::get('/all-lession', AllLession::class)->name('ux.alllession');
    });

    // for writer
    Route::middleware('roleBase:writer')->prefix('/writer')->group(function () {
        // for questions
        Route::get('/question-type', QuestionType::class)->name('ux.writer.questions.type');
        Route::get('/all-questions', AllQuestions::class)->name('ux.writer.allquestions');
        Route::get('/add-mcq-questions', McqAdd::class)->name('ux.writer.addquestions.mcq');
        Route::get('/all-cq-questions', AllCqQuestion::class)->name('ux.writer.allcqquestions');
        Route::get('/add-questions', AddQuestions::class)->name('ux.writer.addquestions');
        Route::get('/all-sq-questions', AllSqQuestion::class)->name('ux.writer.allquestions.sq');
        Route::get('/add-sq-questions', AddSqQuestion::class)->name('ux.writer.addquestions.sq');
    });

    // profile
    Route::get('/profile', ProfileInfo::class)->name('ux.profile.info');
    Route::get('/security', Security::class)->name('ux.profile.security');
});

// logoout
Route::get('/logout', Logout::class)->name('logout');

// maintenance
Route::get('/maintenance', function () {
    return view('errors.maintenance');
})->name('ui.maintenance');

// user block
Route::get('/userblock', function () {
    return view('errors.userblcok');
})->middleware('authCheck')->name('ui.blockuser');
