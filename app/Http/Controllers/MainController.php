<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Result;


class MainController extends Controller
{
    public function dashboard(){
         $quizzes = Quiz::where('status','publish')->where(function($query){
            $query->whereNull('finished_at')->orWhere('finished_at','>',now());
         })->withCount('questions')->paginate(5);
        $results = auth()->user()->results;
        return view('dashboard' ,compact('quizzes','results'));   
    }

    public function about(){
       return view('about');  
   }


    
    public function quiz($slug){
        $quiz = Quiz::whereSlug($slug)->with('questions.my_answer','my_result')->first() ?? abort(404, 'Quiz bulunamadı');
        if($quiz->my_result){
            return view('quiz_result', compact('quiz'));
        }

        return view('quiz',compact('quiz'));
    }

    public function quiz_detail($slug){
        $quiz = Quiz::whereSlug($slug)->with('my_result','topTen.user')->withCount('questions')->first() ?? abort(404, 'Quiz bulunamadı');
        return view('quiz_detail', compact('quiz'));
    }

    public function result(Request $request, $slug){
        $quiz = Quiz::with('questions')->whereSlug($slug)->first() ?? abort(404, 'Quiz bulunamadı');
        $correct = 0;

        if($quiz->my_result){
            abort(404,"Bu Quiz'e daha önce katıldınız.");
            // return redirect()->route('dashboard')->with
        }


        foreach($quiz->questions as $question){
           Answer::create([
            'user_id'=>auth()->user()->id,
            'question_id'=>$question->id,
            'answer'=>$request->post($question->id),
        ]);


         
        if($question->correct_answer===$request->post($question->id)){
            $correct+=1;

        }
        }

        $point = round((100 / count($quiz->questions) ) * $correct);
        $wrong = count($quiz->questions)-$correct;

        Result::create([
            'user_id'=>auth()->user()->id,
            'quiz_id'=>$quiz->id,
            'point'=>$point,
            'correct'=>$correct,
            'wrong'=>$wrong,
           
        ]);
        return redirect()->route('quiz_detail', $quiz->slug)->withSuccess("Başarıyla Quiz'i Bitirdin Puanın : ".$point);
    }

    public function quizshow(Quiz $quiz)
    {
        $question = $quiz->$question();
        return view('admin.quiz.quizshow', compact('question','quiz'));
    }

}