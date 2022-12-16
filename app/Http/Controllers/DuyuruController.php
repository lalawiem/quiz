<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Duyuru;
use App\Http\Requests\DuyuruCreateRequest;
use App\Http\Requests\DuyuruUpdateRequest;



class DuyuruController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function index()
    {
        $duyurular = Duyuru::orderBy('created_at', 'desc')->get();
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
        
        return redirect()->route('duyurular.index')->withSuccess('Duyuru başarıyla oluşturuldu.');
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
        $duyuru = Duyuru::find($id) ?? abort(404,'Duyuru bulunamadı') ; 
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
        
        $duyuru = Duyuru::find($id) ?? abort(404,'Duyuru Bulunamadı') ; 
        duyuru::find($id)->update($request->except(['_method','_token']));

        return redirect()->route('duyurular.index')->withsuccess('Duyuru güncelleme işlemi başarıyla Ggrçekleştirildi. ');

   
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Duyuru::find($id)->delete();

        return redirect()->route('duyurular.index')->withSuccess('Duyuru silme işlemi başarıyla gerçekleştirildi.');
        
    }

}