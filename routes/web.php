<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\MainController;
use  App\Http\Controllers\DuyuruController;
use  App\Http\Controllers\Admin\QuizController;
use  App\Http\Controllers\Admin\QuestionController;
use RealRashid\SweetAlert\Facades\Alert;


 


Route::group(['middleware'=>'auth'], function (){
    Route::get('/',[MainController::class, 'dashboard'])->name('dashboard');
    Route::get('quiz/detay/{slug}',[MainController::class, 'quiz_detail'])->name('quiz_detail');
    Route::get('quiz/{slug}',[MainController::class, 'quiz'])->name('quiz.join');
    Route::post('quiz/{slug}/result',[MainController::class, 'result'])->name('quiz.result');
    Route::resource('/duyurular',DuyuruController::class);

    
});
    


    Route::group(['middleware' => ['auth', 'isAdmin'],'prefix'=>'admin'], function () {
        Route::resource('/quizzes',QuizController::class);
        Route::resource('/questions',QuestionController::class);
        Route::get('quiz/{id}/questions',[QuizController::class, 'soruGor'])->name('quizzes.soruGor');



});         