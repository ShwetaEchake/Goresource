<?php

namespace App\Http\Controllers;

use App\Models\JobApplied;
use App\Models\ApplicationProcess;
use Illuminate\Http\Request;
use DB;
use Excel;
use Mail;
class JobAppliedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $jobapplieds=JobApplied::get();
       return view('jobapplied.index',['jobapplieds'=>$jobapplieds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $data['personal'] = DB::table('personal')->get();
        $data['client'] = DB::table('client')->get();
        $data['branch'] = DB::table('branch')->get();
        return view('jobapplied.create',$data);
    }


       public function getEnquiryJobapplied(Request $request)
           {
            $enquirys = DB::table("enquiry")
            ->where("client_id",$request->client_id)
            ->pluck("enquiry_title","enquiry_id");
            return response()->json($enquirys);
          }


        public function getJobJobapplied(Request $request)
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
         $jobapplied=new JobApplied();
         $jobapplied->candidate_id =$request->candidate_id ;
         $jobapplied->client_id =$request->client_id ;
         $jobapplied->enquiry_id=$request->enquiry_id;
         $jobapplied->job_id =$request->job_id;
         $jobapplied->branch_id =$request->branch_id;
         $jobapplied->choice1 =$request->choice1;
         $jobapplied->choice2 =$request->choice2;
         $jobapplied->country_preference=$request->country_preference;
         $jobapplied->salary_expectation=$request->salary_expectation;
         $jobapplied->created_by = auth()->user()->id;
         $jobapplied->date_applied =strtotime($request->date_applied);
         $jobapplied->current_status='applied';
         $jobapplied->save();
        return redirect()->route('jobapplied.index')->with('success','Job Applied Created Successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobApplied  $jobApplied
     * @return \Illuminate\Http\Response
     */
    public function show(JobApplied $jobApplied)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobApplied  $jobApplied
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobapplied=JobApplied::find($id);
        $data['personal'] = DB::table('personal')->get();
        $data['enquiry'] = DB::table('enquiry')->get();
        $data['client'] = DB::table('client')->get();
        $data['branch'] = DB::table('branch')->get();
        
        return view('jobapplied.edit',compact('jobapplied'),$data);
    }

   public function export(Request $request) 
    {


    $ids=explode(",", $_GET['ids']);

         
return Excel::download(new JobApplied($ids),'jobapplied.xlsx');
    }








  public  function status_update(Request $request)
{
   
    $id = $request->id;
    $location_id = $request->location_id;
    $applied_id=$request->applied_id;

//--------jobapplied table status change-----------
     DB::table('job_applied')
      ->where('candidate_id',$id)
      ->where('location',$location_id)
       ->where('applied_id',$applied_id)
      ->where('current_status','applied')->update(['current_status' => 'shortlist']);
//--------jobapplied table status change-----------



//---------ApplicationProcess table status change--------------
    $jobapplied=DB::table('job_applied')
     ->where('candidate_id',$id)
     ->where('location',$location_id)
     ->where('applied_id',$applied_id)
     ->where('current_status','shortlist')->first();

    if($jobapplied->current_status == 'shortlist'){
    $applicationprocess= new ApplicationProcess();
    $applicationprocess->candidate_id=$id;
    $applicationprocess->client_id=$jobapplied->client_id;
    $applicationprocess->enquiry_id=$jobapplied->enquiry_id;
    $applicationprocess->job_id=$jobapplied->job_id;
    $applicationprocess->location_id=$jobapplied->location;
    $applicationprocess->created_by=auth()->user()->id;
    $applicationprocess->created_date=strtotime(Date('Y-m-d'));
    $applicationprocess->application_activity='applied';
    $applicationprocess->application_status='shortlist';
    $applicationprocess->save();
}
//---------ApplicationProcess table status change--------------



//Send Mail
$candidateDetail=DB::table('personal')
->leftjoin('job_applied','job_applied.candidate_id','=','personal.candidate_id')
->where('job_applied.candidate_id',$id)
->where('location',$location_id)->first();

 $email=$candidateDetail->email;
      
   Mail::send([], [], function ($message) use ($email,$candidateDetail) {
     $message->to($email)
            ->subject('Invitation to interview')
            ->setBody('<h1>'.$candidateDetail->name.', Shortlist Successfully!</h1>', 'text/html'); // for HTML rich messages
});
//Send Mail




    return redirect()->back()->with('msg', 'Status ');
}






















    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobApplied  $jobApplied
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $jobapplied=JobApplied::find($id);
         $jobapplied->candidate_id =$request->candidate_id ;
         $jobapplied->client_id =$request->client_id ;
         $jobapplied->enquiry_id=$request->enquiry_id;
         $jobapplied->job_id =$request->job_id;
         $jobapplied->branch_id =$request->branch_id;
         $jobapplied->choice1 =$request->choice1;
         $jobapplied->choice2 =$request->choice2;
         $jobapplied->country_preference=$request->country_preference;
         $jobapplied->salary_expectation=$request->salary_expectation;
         $jobapplied->created_by =auth()->user()->id;
         $jobapplied->date_applied =strtotime($request->date_applied);
         $jobapplied->save();
        return redirect()->route('jobapplied.index')->with('success','Job Applied Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobApplied  $jobApplied
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $jobapplied=DB::table('job_applied')->where('applied_id',$id)->delete();
               return redirect()->route('jobapplied.index')->with('success','Job Applied Deleted Successfully');
    }


  public  function deleteApplicants(Request $request)
  {
     $id = $request->id;
     $location_id = $request->location_id;
     $applied_id = $request->applied_id;
     
     $jobappliedDelete=DB::table('job_applied')
     ->where('candidate_id',$id)
     ->where('location',$location_id)
     ->delete();

    return redirect()->back()->with('success','Applicant Rejected');

  }


}