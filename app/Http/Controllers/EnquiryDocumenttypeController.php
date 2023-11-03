<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnquiryDocumenttype;
use DB;

class EnquiryDocumenttypeController extends Controller
{
	public function index()
    {
    $enquirydocumenttypes= EnquiryDocumenttype::paginate(10);
    return view('enquirydocumenttype.index',['enquirydocumenttypes'=>$enquirydocumenttypes]);
}

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
        $enquirydocumenttypes= new EnquiryDocumenttype();
          $enquirydocumenttypes->enquiry_documenttype_name=$request->enquiry_documenttype_name;
          
          
         $enquirydocumenttypes->save(); 
         return redirect()->route('enquirydocumenttype.index')->with('success','Enquiry Document Created Successfully');
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
        $enquirydocumenttype=EnquiryDocumenttype::find($id);
    
        $enquirydocumenttypes=EnquiryDocumenttype::paginate(10);

        return view('enquirydocumenttype.index',['enquirydocumenttype'=>$enquirydocumenttype],compact('enquirydocumenttypes'));
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
        $enquirydocumenttype=EnquiryDocumenttype::find($id);
          $enquirydocumenttype->enquiry_documenttype_name=$request->enquiry_documenttype_name;
         

          $enquirydocumenttype->save(); 

        return redirect()->route('enquirydocumenttype.index')->with('success',' Enquiry Document Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enquirydocumenttype = DB::table('enquiry_documenttype')->where('enquiry_documenttype_id',$id)->delete();
        return redirect()->route('enquirydocumenttype.index')
                        ->with('success','Enquiry Document Type Deleted Successfully');
    }
}
