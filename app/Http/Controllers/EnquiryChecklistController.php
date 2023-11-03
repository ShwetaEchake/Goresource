<?php

namespace App\Http\Controllers;

use App\Models\EnquiryChecklist;
use Illuminate\Http\Request;
use DB;
class EnquiryChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquirychecklists=EnquiryChecklist::get();
          $data['enquiry'] = DB::table('enquiry')->get();
        return view('enquirychecklist.index',['enquirychecklists'=>$enquirychecklists],$data);
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
        $enquirychecklist=new EnquiryChecklist();
        $enquirychecklist->enquiry=$request->enquiry;
        $enquirychecklist->status=$request->status;
        $enquirychecklist->created_by=auth()->user()->id;
        $enquirychecklist->created_date=strtotime(Date('Y-m-d'));
        $enquirychecklist->updated_date=strtotime(Date('Y-m-d'));
        $enquirychecklist->save();
        return redirect()->route('enquirychecklist.index')->with('success', 'Enquiry Checklist Created Successfully');
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnquiryChecklist  $enquiryChecklist
     * @return \Illuminate\Http\Response
     */
    public function show(EnquiryChecklist $enquiryChecklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EnquiryChecklist  $enquiryChecklist
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $enquiryChecklist=EnquiryChecklist::find($id);
        $enquirychecklists=EnquiryChecklist::all();
        // $enquiry=Enquiry::all();
        $data['enquiry'] = DB::table('enquiry')->get();

    return view('enquirychecklist.index', compact('enquiryChecklist','enquirychecklists'),$data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnquiryChecklist  $enquiryChecklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $enquiryChecklist=EnquiryChecklist::find($id);
        $enquiryChecklist->enquiry=$request->enquiry;
        $enquiryChecklist->status=$request->status;
        $enquiryChecklist->created_by=auth()->user()->id;
        $enquiryChecklist->created_date=strtotime(Date('Y-m-d'));
        $enquiryChecklist->updated_date=strtotime(Date('Y-m-d'));
        $enquiryChecklist->save();
        return redirect()->route('enquirychecklist.index')->with('success', 'Enquiry Checklist Updated Successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnquiryChecklist  $enquiryChecklist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $enquirychecklist = DB::table('enquiry_checklist')->where('checklist_id',$id)->delete();
        return redirect()->route('enquirychecklist.index')
                        ->with('success','Enquiry Checklist deleted successfully');
    }
}
