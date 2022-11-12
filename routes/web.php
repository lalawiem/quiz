<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\MainController;
use  App\Http\Controllers\Admin\QuizController;
use  App\Http\Controllers\Admin\QuestionController;

 
Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'auth'], function (){
    Route::get('panel',[MainController::class, 'dashboard'])->name('dashboard');
    Route::get('quiz/{slug}',[MainController::class, 'quiz_detail'])->name('quiz_detail');
    
});
    


    Route::group(['middleware' => ['auth', 'isAdmin'],'prefix'=>'admin'], function () {
        Route::resource('quizzes',QuizController::class);
        Route::resource('quiz/{quiz_id}/questions',QuestionController::class);
        Route::get('quizzes{id}',[QuizController::class, 'destroy'])->whereNumber('$id')->name('quizzes.destroy');
        Route::get('quiz/{quiz_id}/questions{id}',[QuestionController::class, 'destroy'])->whereNumber('$id')->name('questions.destroy');



});         