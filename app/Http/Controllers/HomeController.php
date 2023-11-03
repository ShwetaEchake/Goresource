<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
         public function index(Request $request)
         {  



if(isset($_GET['job_id'])){
    $job_id=$_GET['job_id'];
    $location_id=$_GET['location_id'];
}else{
    $job_id='';
    $location_id='';
}



       
        if(auth()->user()->user_type == "Client"){

                $data['client']=DB::table('client')->where('user_id',auth()->user()->id)->get();

        }

        else{

             $data['client']=DB::table('client')->get();

        }





  $results  = DB::select(DB::raw("SELECT *,assessment.overall_assessment as assessmentstatus,post_assessment.overall_assessment as postassessmentstatus,

    job_applied.current_status,personal.candidate_id,job_applied.job_id,job_applied.location,
    job_applied.applied_id,assessment.assessment_id,candidate_interview.candidate_interview_id,selection.selection_id,offer_letter.offer_letter_id,pre_medical.premedical_id,qvc_process.qvc_id,visa_process.visa_id,call_status.call_status_id
FROM personal

LEFT JOIN job_applied ON job_applied.candidate_id = personal.candidate_id

LEFT JOIN assessment ON assessment.job_id = job_applied.job_id AND assessment.location_id = job_applied.location AND  assessment.candidate_id = job_applied.candidate_id
LEFT JOIN post_assessment ON post_assessment.job_id = job_applied.job_id  AND  post_assessment.location_id = job_applied.location AND post_assessment.candidate_id = job_applied.candidate_id
LEFT JOIN candidate_interview ON candidate_interview.job_id = job_applied.job_id AND candidate_interview.location_id = job_applied.location AND candidate_interview.candidate_id = personal.candidate_id
LEFT JOIN selection ON selection.candidate_id = personal.candidate_id
LEFT JOIN offer_letter ON offer_letter.job_id = job_applied.job_id AND offer_letter.location_id = job_applied.location AND offer_letter.candidate_id = job_applied.candidate_id
LEFT JOIN pre_medical ON  pre_medical.job_id = job_applied.job_id AND pre_medical.location_id = job_applied.location AND pre_medical.candidate_id = job_applied.candidate_id
LEFT JOIN qvc_process ON qvc_process.job_id = job_applied.job_id AND qvc_process.location_id = job_applied.location AND qvc_process.candidate_id = job_applied.candidate_id
LEFT JOIN visa_process ON visa_process.job_id = job_applied.job_id AND visa_process.location_id = job_applied.location AND visa_process.candidate_id = job_applied.candidate_id
LEFT JOIN deployment_process ON deployment_process.job_id = job_applied.job_id AND  deployment_process.location_id = job_applied.location AND deployment_process.candidate_id = job_applied.candidate_id

LEFT JOIN call_status ON call_status.candidate_id = personal.candidate_id
WHERE job_applied.job_id ='".$job_id."' AND job_applied.location ='".$location_id."' "));



  
        $data['assessment']=DB::table('assessment')->get();
        $data['personal']=DB::table('personal')->get();
        $data['interview']=DB::table('interview')->get();
        $data['branch']=DB::table('branch')->get();
       
        $data['enquiry']=DB::table('enquiry')->get();
        $data['job']=DB::table('jobs')->get();

        $category  = DB::select(DB::raw("select DISTINCT category_name, category_id  from jobs  LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id  "));

         $data['medical_examination_center']=DB::table('medical_examination_center')->get();
         $data['language']=DB::table('language')->get();
         $data['emailtemplates']=DB::table('email_templates')->get();
         $data['smstemplates']=DB::table('sms_templates')->get();



      //return view('home',compact('category'),compact('category'),$data,$mSTRapplied, compact('mSTRassessment'),$mSTRassessment);

  return view('home',compact('results','category'),$data);

/*
if (isset($_REQUEST["q"])) {

	  return view('home',compact('results','category','mSTRapplied'),$data);
    }else{
        return view('home',compact('category','mArrayEnrollment'),$data);
    }
*/
	

}//index function


  public function getEnquiry(Request $request)
           {

         if(auth()->user()->user_type == "Executive"){
             $enquirys = DB::table("enquiry")
            ->leftJoin('assign_enquiry_branch', 'enquiry.enquiry_id', '=', 'assign_enquiry_branch.enquiry_id')
            ->leftJoin('executive', 'assign_enquiry_branch.branch_id', '=', 'executive.branch_name')
            ->where("client_id",$request->client_id)
            ->where('executive.user_id', '=', auth()->user()->id)
            ->pluck("enquiry_title","enquiry.enquiry_id");

        }else{
            $enquirys = DB::table("enquiry")
            ->where("client_id",$request->client_id)
            ->pluck("enquiry_title","enquiry_id");
            }

              return response()->json($enquirys);

       }


        public function getJob(Request $request)
         {
         $jobs = DB::table("jobs")
         ->join('categories', 'jobs.job_main_category_id', '=', 'categories.category_id')
         ->where("enquiry_id",$request->enquiry_id)
         ->pluck("categories.category_name","job_id");
         return response()->json($jobs);
         }






}


