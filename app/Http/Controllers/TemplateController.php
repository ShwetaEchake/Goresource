<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use DB;

class TemplateController extends Controller
{
   

    public function index()
    {
    $templates= Template::all();
    $data['countri'] = DB::table('country')->get();
    return view('templatemaster.index',['templates'=>$templates], compact('data'));
}

 public function create()
    {
        
    }

     public function store(Request $request)
    {
        $templates= new Template();

          $templates->title=$request->title;
          $templates->shortcode=$request->shortcode;
          $templates->country=$request->country;
          $templates->template=$request->template;
          $templates->status=$request->status;
          
          
         $templates->save(); 
         return redirect()->route('templatemaster.index')->with('success','Template Created Successfully');
    }

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
        $template=Template::find($id);
    
        $templates=Template::all();
        $data['countri'] = DB::table('country')->get();

        return view('templatemaster.index',['template'=>$template],compact('templates', 'data'));
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
        $template=Template::find($id);
        $template->title=$request->title;
          $template->shortcode=$request->shortcode;
          $template->country=$request->country;
          $template->template=$request->template;
          $template->status=$request->status;
          $template->save(); 

        return redirect()->route('templatemaster.index')->with('success',' Template Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = DB::table('template')->where('template_id',$id)->delete();
        return redirect()->route('templatemaster.index')
                        ->with('success','Template Deleted Successfully');
    }
    
}
