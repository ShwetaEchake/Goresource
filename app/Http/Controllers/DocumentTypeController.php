<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\Request;
use DB;
class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documenttypes=DocumentType::paginate(10);
      
        return view('documenttype.index',['documenttypes'=>$documenttypes]);
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
          $documenttype= new DocumentType();
          $documenttype->document_type_name=$request->document_type_name;
    
          $documenttype->save(); 

        return redirect()->route('documenttype.index')->with('success','Document Type Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $documenttype=DocumentType::find($id);
        $documenttypes=DocumentType::paginate(10);
      
        return view('documenttype.index',compact('documenttype','documenttypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $documenttype=  DocumentType::find($id);
          $documenttype->document_type_name=$request->document_type_name;
          $documenttype->save(); 

        return redirect()->route('documenttype.index')->with('success','Document Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $documenttype = DB::table('document_type')->where('document_type_id',$id)->delete();
        return redirect()->route('documenttype.index')
                        ->with('success','Document Type Deleted Successfully');
    }
}
