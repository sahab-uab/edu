<?php

use App\Livewire\App\Question\AddQuestions;
use App\Livewire\App\AllClasses;
use App\Livewire\App\AllLession;
use App\Livewire\App\Question\AllQuestions;
use App\Livewire\App\AllSubjectes;
use App\Livewire\App\Customize\MenuBuilder;
use App\Livewire\App\Dashboard;
use App\Livewire\App\Question\AddSqQuestion;
use App\Livewire\App\Question\AllCqQuestion;
use App\Livewire\App\Question\AllSqQuestion;
use App\Livewire\App\Question\McqAdd;
use App\Livewire\App\Question\QuestionType;
use App\Livewire\App\Setting\Smtp;
use App\Livewire\App\Users\AddUsers;
use App\Livewire\App\Users\AllAdmin;
use App\Livewire\App\Users\AllStudent;
use App\Livewire\App\Users\AllTecher;
use App\Livewire\App\Users\AllWriter;
use App\Livewire\Ui\Auth\Google;
use App\Livewire\Ui\Auth\Login;
use App\Livewire\Ui\Auth\Logout;
use App\Livewire\Ui\Auth\Register;
use App\Livewire\Ui\Auth\Rolechoice;
use App\Livewire\Ui\Home;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Route;

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
});

// role select
Route::middleware(['authCheck'])->group(function () {
    Route::get('/choicerole', Rolechoice::class)->name('ui.setrole');
});

// logoout
Route::get('/logout', Logout::class)->name('logout');

// app
Route::prefix('/app')->middleware(['authCheck', 'checkrole'])->group(function () {
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

        // single
        Route::get('/all-classes', AllClasses::class)->name('ux.allclasses');
        Route::get('/all-subject', AllSubjectes::class)->name('ux.allsubject');
        Route::get('/all-lession', AllLession::class)->name('ux.alllession');
    });
});
