<?php

namespace App\Http\Controllers;
use App\Models\Language;
use Illuminate\Http\Request;
use DB;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $languages = Language::all();
 

        return view('language.index',['languages'=>$languages]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $languages= new Language();
          $languages->language_name=$request->language_name;
          $languages->language_code=$request->language_code;
          
         $languages->save(); 
         return redirect()->route('language.index')->with('success','Document Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language=Language::find($id);
    
        $languages=Language::all();

        return view('language.index',['language'=>$language],compact('languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $language=Language::find($id);
          $language->language_name=$request->language_name;
          $language->language_code=$request->language_code;


          $language->save(); 

        return redirect()->route('language.index')->with('success',' Language Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language = DB::table('language')->where('language_id',$id)->delete();
        return redirect()->route('language.index')
                        ->with('success','Language Deleted Successfully');
    }
}
