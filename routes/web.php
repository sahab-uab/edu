<?php

use App\Livewire\App\Question\AddQuestions;
use App\Livewire\App\AddStudent;
use App\Livewire\App\AllClasses;
use App\Livewire\App\AllLession;
use App\Livewire\App\Question\AllQuestions;
use App\Livewire\App\AllStudent;
use App\Livewire\App\AllSubject;
use App\Livewire\App\AllSubjectes;
use App\Livewire\App\AllUser;
use App\Livewire\App\Dashboard;
use App\Livewire\App\Question\McqAdd;
use App\Livewire\App\Question\QuestionType;
use App\Livewire\Ui\Auth\Google;
use App\Livewire\Ui\Auth\Login;
use App\Livewire\Ui\Auth\Logout;
use App\Livewire\Ui\Auth\Register;
use App\Livewire\Ui\Auth\Rolechoice;
use App\Livewire\Ui\Home;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Route;

// basic
Route::get('/', Home::class)->name('ui.home');

// auth
Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google.redirect');
Route::middleware(['guestCheck'])->group(function () {
    Route::get('/login', Login::class)->name('ui.login');
    Route::get('/signup', Register::class)->name('ui.signup');
});
Route::get('/auth/google/callback', Google::class);
Route::get('/choicerole', Rolechoice::class)->middleware('authCheck')->name('ui.setrole');

// app
Route::prefix('/app')->middleware(['authCheck', 'checkrole'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('ux.dashboard');
    // for admin
    Route::middleware('roleBase:admin')->group(function(){
        Route::get('/all-student', AllStudent::class)->name('ux.allstudent');
        Route::get('/all-classes', AllClasses::class)->name('ux.allclasses');
        Route::get('/all-subject', AllSubjectes::class)->name('ux.allsubject');
        Route::get('/all-lession', AllLession::class)->name('ux.alllession');
        // for questions
        Route::get('/all-questions', AllQuestions::class)->name('ux.allquestions');
        Route::get('/question-type', QuestionType::class)->name('ux.questions.type');
        Route::get('/add-questions', AddQuestions::class)->name('ux.addquestions');
        Route::get('/add-mcq-questions', McqAdd::class)->name('ux.addquestions.mcq');
    });

    Route::get('/logout', Logout::class)->name('logout');
});
