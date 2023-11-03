<?php

namespace App\Http\Controllers;

use App\Models\Selection;
use Illuminate\Http\Request;
use DB;
class SelectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $selections=Selection::all();
        return view('selection.index',['selections'=>$selections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['personal'] = DB::table('personal')->get();
        $data['enquiry'] = DB::table('enquiry')->get();
        $data['client'] = DB::table('client')->get();
        $result  = DB::select(DB::raw("select category_id ,category_name from jobs  LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id  "));

        return view('selection.create',$data,compact('result')); 
    }


     public function getEnquirySelection(Request $request)
           {
            $enquirys = DB::table("enquiry")
            ->where("client_id",$request->client_id)
            ->pluck("enquiry_title","enquiry_id");
            return response()->json($enquirys);
          }


        public function getJobSelection(Request $request)
         {
         $jobs = DB::table("jobs")
         ->join('categories', 'jobs.job_main_category_id', '=', 'categories.category_id')
         ->where("enquiry_id",$request->enquiry_id)
         ->pluck("categories.category_name","job_id");
         return response()->json($jobs);
         }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $selection=new Selection();
        $selection->candidate_id =$request->candidateselection ;
        $selection->client_id =$request->client_id ;
        $selection->enquiry_id=$request->enquiry_id;
        $selection->job_id =$request->job_id;
        $selection->created_by=auth()->user()->id;
        $selection->remark=$request->remark ;
      

     $candidatePath=DB::table('candidate_documents')->where('candidate_id',$request->candidateselection)->select('folder_path')->first();

            if($request->hasfile('attached_document1')){
            $file=$request->file('attached_document1');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename);
            $selection->attached_document1=$filename;
            }else{
            $selection->attached_document1="";
            }

            if($request->hasfile('attached_document2')){
            $file=$request->file('attached_document2');
            $extension=$file->getClientOriginalExtension();
            $filename2=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename2);
            $selection->attached_document2=$filename2;
            }else{
            $selection->attached_document2="";
            }

            if($request->hasfile('attached_document3')){
            $file=$request->file('attached_document3');
            $extension=$file->getClientOriginalExtension();
            $filename3=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename3);
            $selection->attached_document3=$filename3;
            }else{
            $selection->attached_document3="";
             }




  $selection->save();
        return redirect()->route('selection.index')->with('success','Selection Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Selection  $selection
     * @return \Illuminate\Http\Response
     */
    public function show(Selection $selection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Selection  $selection
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $selection= Selection::find($id);
        $data['personal'] = DB::table('personal')->get();
        $data['enquiry'] = DB::table('enquiry')->get();
        $data['client'] = DB::table('client')->get();
        $result  = DB::select(DB::raw("select category_id ,category_name from jobs  LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id  "));
      
        return view('selection.edit',compact('selection','result'),$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Selection  $selection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Selection $selection)
    {
       $selection=Selection::find($selection->selection_id);
        $selection->candidate_id =$request->candidate_id ;
        $selection->client_id =$request->client_id ;
        $selection->enquiry_id=$request->enquiry_id;
        $selection->job_id =$request->job_id;
        $selection->created_by=auth()->user()->id;
        $selection->remark=$request->remark ;
      

      $candidatePath=DB::table('candidate_documents')->where('candidate_id',$request->candidate_id)->select('folder_path')->first();

            if($request->hasfile('attached_document1')){
            $file=$request->file('attached_document1');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename);
            $selection->attached_document1=$filename;
            }

            if($request->hasfile('attached_document2')){
            $file=$request->file('attached_document2');
            $extension=$file->getClientOriginalExtension();
            $filename2=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename2);
            $selection->attached_document2=$filename2;
            }

            if($request->hasfile('attached_document3')){
            $file=$request->file('attached_document3');
            $extension=$file->getClientOriginalExtension();
            $filename3=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename3);
            $selection->attached_document3=$filename3;
            }

        $selection->save();
        return redirect()->route('selection.index')->with('success','Selection Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Selection  $selection
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $selection=DB::table('selection')->where('selection_id',$id)->delete();
       return redirect()->route('selection.index')
                        ->with('success','Location Deleted Successfully');
    }
}
