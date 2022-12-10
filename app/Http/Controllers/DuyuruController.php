<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Duyuru;
use App\Models\Question;
use App\Http\Requests\DuyuruCreateRequest;

class DuyuruController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function index()
    {
        $duyurular = Duyuru::all();
        return view('duyurular',compact('duyurular'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('duyuru_create');

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DuyuruCreateRequest $request)
    {
        $user_id = auth()->user()->id;
        Duyuru::create([
            'title' => $request->title,
            'description' => $request->description,
            'finished_at' => $request->finished_at,
            'user_id' => $user_id,
        ]);
        
        return redirect()->route('duyurular.index')->withSuccess('Duyuru Başarıyla Oluşturuldu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $duyuru = Duyuru::find($id) ?? abort(404,'Quiz Bulunamadı') ; 
        return view('duyuru_edit', compact('duyuru'));
      

    }

    /**
     * Update the specified resource in storage. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     */
    public function update(DuyuruUpdateRequest $request,$id)
    {
        
        $duyuru = Duyuru::find($id) ?? abort(404,'Quiz Bulunamadı') ; 
        duyuru::find($id)->update($request->except(['_method','_token']));

        return redirect()->route('duyurular.index')->withsuccess('Quiz Güncelleme İşlemi Başarıyla Gerçekleştirildi. ');

   
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Duyuru $duyuru)
    {
        $duyuru->delete();    
        return redirect()->route('duyurular.index')->withSuccess('Duyuru Silme İşlemi Başarıyla Gerçekleştirildi.');
        
    }

}