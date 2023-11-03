<?php

namespace App\Http\Controllers;

use App\Models\Advertisment;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use DB;
use PDF;
class AdvertismentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

         public function add()
    {

        // $pdf = PDF::loadView('advertisment.add');
        // return $pdf->download('advertisment.pdf');
         return view('advertisment.add');
    }



    public function index()
    {

        if(auth()->user()->user_type=='Executive'){
            $enquiries=DB::table('enquiry')
        ->leftjoin('jobs','jobs.enquiry_id','=','enquiry.enquiry_id')
        ->leftjoin('assign_enquiry_branch','assign_enquiry_branch.enquiry_id','=','enquiry.enquiry_id')
        ->leftJoin('executive', 'assign_enquiry_branch.branch_id', '=', 'executive.branch_name')
        ->where('executive.user_id', '=', auth()->user()->id)->get();
        }
        else{
        // $enquiries=DB::table('enquiry')
        // ->leftjoin('jobs','jobs.enquiry_id','=','enquiry.enquiry_id')
        // ->leftjoin('assign_enquiry_branch','assign_enquiry_branch.enquiry_id','=','enquiry.enquiry_id')->get();

            $enquiries=DB::table('enquiry')->get();
       }
         $advertisments=Advertisment::all();
        return view('advertisment.index',['enquiries'=>$enquiries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['enquiry'] = DB::table('enquiry')->get();
        $data['jobs'] = DB::table('jobs')->get();
        $data['client'] = DB::table('client')->get();
        $data['branch'] = DB::table('branch')->get();

        return view('advertisment.create',$data);
    }


     public function getEnquiryAdd(Request $request)
           {
            $enquirys = DB::table("enquiry")
            ->where("client_id",$request->client_id)
            ->pluck("enquiry_title","enquiry_id");
            return response()->json($enquirys);
          }


        public function getJobAdd(Request $request)
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
        $advertisment=new Advertisment();
        // $advertisment->job_id =$request->job_id ;
        $advertisment->enquiry_id=$request->enquiry_id;
        $advertisment->client_id=$request->client_id;
        $advertisment->job_id =$request->job_id;
        // $advertisment->branch_id =$request->branch_id;
        $advertisment->adv_date =strtotime($request->adv_date);
        $advertisment->adv_publish_date=strtotime($request->adv_publish_date);
        $advertisment->adv_cost=$request->adv_cost;
        $advertisment->dtp_cost=$request->dtp_cost;
        $advertisment->adv_check_recipt=$request->adv_check_recipt;

$result1=DB::table('client')->where('client_id',$request->client_id)->select('folder_path')->first();
$result2=DB::table('enquiry')->where('enquiry_id',$request->enquiry_id)->select('folder_path')->first();


            if($request->hasfile('adv_cost_check_attachment')){
            $file=$request->file('adv_cost_check_attachment');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
            $file->move("documents/".$result1->folder_path."/".$result2->folder_path, $filename);
            $advertisment->adv_cost_check_attachment=$filename;
            }else{
            $advertisment->adv_cost_check_attachment="";
            }


            if($request->hasfile('dtp_cost_check_attachment')){
            $file=$request->file('dtp_cost_check_attachment');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
            $file->move("documents/".$result1->folder_path."/".$result2->folder_path, $filename);
            $advertisment->dtp_cost_check_attachment=$filename;
            }else{
            $advertisment->dtp_cost_check_attachment="";
            }

            if($request->hasfile('adv_media1')){
            $file=$request->file('adv_media1');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
            $file->move("documents/".$result1->folder_path."/".$result2->folder_path, $filename);
            $advertisment->adv_media1=$filename;
            }else{
            $advertisment->adv_media1="";
                }

            if($request->hasfile('adv_media2')){
            $file=$request->file('adv_media2');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
            $file->move("documents/".$result1->folder_path."/".$result2->folder_path, $filename);
            $advertisment->adv_media2=$filename;
            }else{
            $advertisment->adv_media2="";
            }

            if($request->hasfile('adv_media3')){
            $file=$request->file('adv_media3');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
            $file->move("documents/".$result1->folder_path."/".$result2->folder_path, $filename);
            $advertisment->adv_media3=$filename;
            }else{
            $advertisment->adv_media3="";
             }
      
    
   
        $advertisment->save();

        return redirect()->route('advertisment.index')
                        ->with('success','Advertisment Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertisment  $advertisment
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisment $advertisment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertisment  $advertisment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $advertisment= Advertisment::find($id);
        $data['enquiry'] = DB::table('enquiry')->get();
        $data['jobs'] = DB::table('jobs')->get();
        $data['client'] = DB::table('client')->get();
        $data['branch'] = DB::table('branch')->get();
        return view('advertisment.edit',compact('advertisment'),$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertisment  $advertisment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $advertisment= Advertisment::find($id);
        $advertisment->job_id =$request->job_id ;
        $advertisment->enquiry_id=$request->enquiry_id;
        $advertisment->client_id=$request->client_id;
        $advertisment->job_id =$request->job_id;
        $advertisment->branch_id =$request->branch_id;
        $advertisment->adv_date =strtotime($request->adv_date);
        $advertisment->adv_publish_date=strtotime($request->adv_publish_date);
        $advertisment->adv_cost=$request->adv_cost;
        $advertisment->dtp_cost=$request->dtp_cost;
        $advertisment->adv_check_recipt=$request->adv_check_recipt;

$result1=DB::table('client')->where('client_id',$request->client_id)->select('folder_path')->first();
$result2=DB::table('enquiry')->where('enquiry_id',$request->enquiry_id)->select('folder_path')->first();


            if($request->hasfile('adv_cost_check_attachment')){
            $file=$request->file('adv_cost_check_attachment');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
            $file->move("documents/".$result1->folder_path."/".$result2->folder_path, $filename);
            $advertisment->adv_cost_check_attachment=$filename;
            }

            if($request->hasfile('dtp_cost_check_attachment')){
            $file=$request->file('dtp_cost_check_attachment');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
            $file->move("documents/".$result1->folder_path."/".$result2->folder_path, $filename);
            $advertisment->dtp_cost_check_attachment=$filename;
            }

            if($request->hasfile('adv_media1')){
            $file=$request->file('adv_media1');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
            $file->move("documents/".$result1->folder_path."/".$result2->folder_path, $filename);
            $advertisment->adv_media1=$filename;
            }

            if($request->hasfile('adv_media2')){
            $file=$request->file('adv_media2');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
            $file->move("documents/".$result1->folder_path."/".$result2->folder_path, $filename);
            $advertisment->adv_media2=$filename;
            }

            if($request->hasfile('adv_media3')){
            $file=$request->file('adv_media3');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
            $file->move("documents/".$result1->folder_path."/".$result2->folder_path, $filename);
            $advertisment->adv_media3=$filename;
            }
      
    
   
        $advertisment->save();

        return redirect()->route('advertisment.index')
                        ->with('success','Advertisment Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertisment  $advertisment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $advertisment = DB::table('advertisment')->where('adv_id',$id)->delete();
            return redirect()->route('advertisment.index')
                        ->with('success','Advertisment Deleted Successfully');
    }
}
