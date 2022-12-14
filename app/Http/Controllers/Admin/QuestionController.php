<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use Illuminate\Support\Str;

 

class QuestionController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
 
     
    public function index()
    {
        $questions = Question::all();
        $quizzes = Quiz::all();

        return view('admin.quiz.questions',compact(['questions','quizzes']));
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create()

    {
        $quizzes = Quiz::all();
        return view('admin.question.create',compact('quizzes'));

    }

    /**
     * Store a newly created resource in storage.
     *  
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request)
    {
        
        if($request->hasFile('image')){
            $fileName = Str::slug($request->question).'.'.$request->image->extension();
            $fileNameWithUpload = 'uploads/'.$fileName; 
            $request->image->move(public_path('uploads'),$fileName);
            $request->merge([
                'image'=>$fileNameWithUpload
            ]);
        }
        Question::create($request->post());
        return redirect()->route('questions.index')->withSuccess('Soru başarıyla oluşturuldu.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function edit(Question $question)
    {
        return view('admin.question.edit',compact('question'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, Question $question)
    {
        if($request->hasFile('image')){
            $fileName = Str::slug($request->question).'.'.$request->image->extension();
            $fileNameWithUpload = 'uploads/'.$fileName; 
            $request->image->move(public_path('uploads'),$fileName);
            $request->merge([
                'image'=>$fileNameWithUpload
            ]);
        }
       
        return redirect()->route('questions.index')->withSuccess('Soru başarıyla güncellendi.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
       $question->delete();
        return redirect()->route('questions.index')->withSuccess('Soru başarıyla silindi.');
    }

    public function show() 
    {
        $question = Question::all();
        $quiz=Quiz::all();
        return view('admin.quiz.show',compact(['question','quiz']));
    }
    
}