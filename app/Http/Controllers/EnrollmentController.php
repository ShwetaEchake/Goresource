<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use DB;
use Mail;
use App\Models\ApplicationProcess;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrollments=Enrollment::all();
        return view('enrollment.index',['enrollments'=>$enrollments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['assessment'] = DB::table('assessment')->get();
        $data['personal'] = DB::table('personal')->get();
        $data['interview'] = DB::table('interview')->get();
        $data['branch'] = DB::table('branch')->get();
        return view('enrollment.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         date_default_timezone_set("Asia/kolkata");

        $enrollment = new Enrollment();
        $enrollment->assessment_id =$request->assessment_id;
        $enrollment->candidate_id =$request->candidate_id;
        $enrollment->interview_id=$request->interview_id;
        $enrollment->branch_id=$request->branch_id;
        $enrollment->created_by=auth()->user()->id;
        $enrollment->enrollment_date=strtotime(Date('Y-m-d'));
        $enrollment->save();

        return redirect()->route('enrollment.index')
                        ->with('success','Enrollment Created Successfully');
    }



  public  function update_status(Request $request)
{
    $id = $request->id;
    $location_id = $request->location_id;
    $applied_id=$request->applied_id;

   //---------jobapplied table status change--------------
     DB::table('job_applied')
     ->where('candidate_id',$id)
     ->where('location',$location_id)
     ->where('applied_id',$applied_id)
     ->where('current_status','selected')
     ->update(['current_status' => 'confirm']);
         

//-------------------------------Send Mail-----------------------------------------------
$candidateEmail=DB::table('personal')
->leftjoin('job_applied','job_applied.candidate_id','=','personal.candidate_id')
->where('job_applied.candidate_id',$id)
->where('job_applied.location',$location_id)->first();

      $email=$candidateEmail->email;
      Mail::send([], [], function ($message) use ($email) {
      $message->to($email)
      ->setBody('<h1>Hi,Confirm Successfully!</h1>', 'text/html'); // for HTML rich messages
});
//-----------------------------Send Mail----------------------------------------------------

//---------ApplicationProcess table status change--------------
        $jobapplied=DB::table('job_applied')
         ->where('candidate_id',$id)
         ->where('location',$request->location_id)
         ->where('current_status','confirm')->first();
         
         if(isset($jobapplied->current_status)){
           if($jobapplied->current_status == 'confirm'){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$id;
            $applicationprocess->client_id=$jobapplied->client_id;
            $applicationprocess->enquiry_id=$jobapplied->enquiry_id;
            $applicationprocess->job_id=$jobapplied->job_id;
            $applicationprocess->location_id=$jobapplied->location;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='enrollment';
            $applicationprocess->application_status='confirm';
            $applicationprocess->save();
           }
         }
//---------ApplicationProcess table status change--------------




 //---------ApplicationProcess table status change--------------
        //     $updateDetails = [
        //     'application_activity' => 'interview',
        //     'application_status' => 'confirm',
        //     'created_by' => auth()->user()->id,
        //     'created_date' => strtotime(Date('Y-m-d'))
        //     ];
        // $jobapplied=DB::table('application_process')
        // ->where('candidate_id',$id)
        // ->update($updateDetails);

       return redirect()->back()->with('msg', 'Status ');
}



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Enrollment $enrollment)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $enrollment= Enrollment::find($id);
        $data['assessment'] = DB::table('assessment')->get();
        $data['personal'] = DB::table('personal')->get();
        $data['interview'] = DB::table('interview')->get();
        $data['branch'] = DB::table('branch')->get();
      
        return view('enrollment.edit',compact('enrollment'),$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        $enrollment =Enrollment::find($enrollment->enrollment_id);
        $enrollment->assessment_id =$request->assessment_id;
        $enrollment->candidate_id =$request->candidate_id;
        $enrollment->interview_id=$request->interview_id;
        $enrollment->branch_id=$request->branch_id;
        $enrollment->created_by=auth()->user()->id;
        $enrollment->enrollment_date=strtotime(Date('Y-m-d'));
        $enrollment->save();

        return redirect()->route('enrollment.index')
                        ->with('success','Enrollment Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enrollment = DB::table('enrollment')->where('enrollment_id',$id)->delete();
           return redirect()->route('enrollment.index')
                        ->with('success','Enrollment Deleted Successfully');
    }
}
