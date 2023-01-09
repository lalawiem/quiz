<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Http\Requests\QuizCreateRequest;
use App\Http\Requests\QuizUpdateRequest; 
 
class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $quizzes = Quiz::withCount('questions');

        if(request()->get('title')){
            $quizzes = $quizzes->where('title', 'LIKE', "%".request()->get('title')."%");
        }  
        if(request()->get('status')){
            $quizzes = $quizzes->where('status', request()->get('status'));

        }
        $quizzes = $quizzes->paginate(5);
        return view('admin.quiz.list',compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create()
    {
        return view('admin.quiz.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizCreateRequest $request)
    {
        Quiz::create($request->post());
        return redirect()->route('quizzes.index')->withSuccess('Sınav başarıyla oluşturuldu.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questions = Quiz::find($id)->questions;
        $quiz = Quiz::with('topTen.user','results.user')->withCount('questions')->find($id) ?? abort(404, 'Sınav bulunamadı.');
        return view('admin.quiz.show',compact(['quiz','questions']));

    }
    public function soruGor($id)
    {
        $questions = Quiz::find($id)->questions;
        $quizzes = Quiz::all();
        return view('admin.quiz.questions',compact(['questions','quizzes']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::withCount('questions')->find($id) ?? abort(404,'Sınav Bulunamadı.') ; 
        return view('admin.quiz.edit', compact('quiz'));

    }

    /**
     * Update the specified resource in storage. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     */
    public function update(QuizUpdateRequest $request,$id)
    {
   
        $quiz = Quiz::find($id) ?? abort(404,'Sınav Bulunamadı') ; 
        Quiz::find($id)->update($request->except(['_method','_token']));

        return redirect()->route('quizzes.index')->withsuccess('Sınav başarıyla güncellendi.');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();    
        return redirect()->route('quizzes.index')->withSuccess('Sınav başarıyla silindi.');
    }

    public function quizAc(Request $request){
        Quiz::find($request->id)->update([
            'status'=>'publish'
        ]);
        return redirect()->route('quizzes.index')->withSuccess('Quiz Durumu Aktif Olarak Değiştirildi.');
    }
    public function quizKapa(Request $request){
        Quiz::find($request->id)->update([
            'status'=>'passive'
        ]);
        return redirect()->route('quizzes.index')->withSuccess('Quiz Durumu Pasif Olarak Değiştirildi.');
    }

    


 


   

 
}