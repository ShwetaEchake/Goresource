<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Personal;
use App\Models\JobApplied;
use App\Models\ApplicationProcess;
use Illuminate\Http\Request;
use DB;
use Mail;
use PDF;
use File;
use App\Models\CandidateDocument;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assessments=Assessment::all();
        return view('assessment.index',['assessments'=>$assessments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


        public function assessmentPrint(){
        // $pdf = PDF::loadView('assessment.assmntpdf');
        // return $pdf->download('assessment.pdf');
         return view('assessment.assmntprint');
        }



    public function create($id)
    {
        
        $personal = Personal::find($id);
        $data['personal'] = DB::table('personal')->where('candidate_id',$personal->candidate_id)->get();
        $data['enquiry'] = DB::table('enquiry')->where('enquiry_id',$personal->enquiry_id)->get();
        $data['jobs'] = DB::table('jobs')->get();
        $data['branch'] = DB::table('branch')->get();
        $data['passport'] = DB::table('passport')->where('candidate_id',$personal->candidate_id)->get();
        $data['assessment'] = DB::table('assessment')->get();
        $result  = DB::select(DB::raw("select category_id ,category_name from jobs  LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id  "));





        return view('assessment.create',$data,compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dataassessment=Assessment::where('assessment_id',$request->id_assessment)->first();
         if(!empty($dataassessment)){
        $assessment=Assessment::find($dataassessment->assessment_id);
        $assessment->assessment_type=$request->assessment_type;
        $assessment->candidate_id=$request->candidateidassessment;
        $assessment->enquiry_id=$request->enquiry_id;
        $assessment->job_id =$request->job_id;
         $assessment->location_id =$request->location_id;
        $assessment->assessment_by=auth()->user()->id;
        $assessment->branch_id =$request->branch_id;
        $assessment->personality_appearence=$request->personality_appearence;
        $assessment->personality_remark=$request->personality_remark;
        $assessment->knowledge=$request->knowledge;
        $assessment->knowledge_remark=$request->knowledge_remark;
        $assessment->ledership=$request->ledership;
        $assessment->leadership_remark=$request->leadership_remark;
        $assessment->communication=$request->communication;
        $assessment->communication_remark=$request->communication_remark;
        $assessment->other_assessment=$request->other_assessment;
        $assessment->other_assessment_remark=$request->other_assessment_remark;
        $assessment->degree_optain=$request->degree_optain;
        $assessment->professional_licence_no=$request->professional_licence_no;
        $assessment->technical_qualification=$request->technical_qualification;
        $assessment->key_skill=$request->key_skill;
        $assessment->trade_test=$request->trade_test;
        $assessment->languge_used=$request->languge_used;
        $assessment->languge_used1=$request->languge_used1;
        $assessment->languge_used2=$request->languge_used2;
        $assessment->local_work_experience=$request->local_work_experience;
        $assessment->local_experience_year=$request->local_experience_year;
        $assessment->overseas_expereicne=$request->overseas_expereicne;
        $assessment->overseaase_year=$request->overseaase_year;
        $assessment->overall_assessment=$request->overall_assessment;
        $assessment->overall_rating=$request->overall_rating;
        $assessment->remark=$request->remark;
        $assessment->save();

//--------JobApplied table status change----------------------------------------
         JobApplied::leftJoin('assessment', 'job_applied.candidate_id', '=', 'assessment.candidate_id')
         ->where('job_applied.candidate_id',$request->candidateidassessment)
         ->where('job_applied.location',$request->location_id)
         ->where('job_applied.job_id',$request->job_id)
         ->where('overall_assessment','selected')
         ->update(['current_status' => 'selected']);
//--------JobApplied table status change--------------------------------------------

//--------------------------------Send Mail----------------------------------------------
        $candidateEmail=DB::table('personal')
        ->leftJoin('assessment', 'personal.candidate_id', '=', 'personal.candidate_id')
        ->where('overall_assessment','selected')
        ->where('assessment.candidate_id',$request->candidateidassessment)
        ->first();
        if(!empty($candidateEmail->email)){
                     $email=$candidateEmail->email;
                     Mail::send([], [], function ($message) use ($email) {
                     $message->to($email)
                    ->setBody('<h1>Selected Successfully!</h1>', 'text/html'); // for HTML rich messages
                });
        }
//-------------------------------------Send Mail-------------------------------------------

//---------ApplicationProcess table status change--------------
        // $application_process=DB::table('application_process')
        //  ->where('candidate_id',$request->candidateidassessment)
        //  ->where('location_id',$request->location_id)
        //  ->where('application_status',$request->overall_assessment)
        //  ->first();
        
     //  if(!empty($application_process)){
       
     //          $dateupdate=DB::table('application_process')
     //         ->where('candidate_id',$request->candidateidassessment)
     //         ->where('location_id',$request->location_id)
     //         ->update(['created_date' => strtotime(Date('Y-m-d'))]);
          
     // }else{
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidateidassessment;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='assessment';
            $applicationprocess->application_status= $request->overall_assessment;
            $applicationprocess->save();
     // }
//---------ApplicationProcess table status change--------------



 $jobapplied=DB::table('job_applied')->where('candidate_id',$request->candidateidassessment)->where('location',$request->location_id)
         ->where('current_status','selected')->first();
//---- Generate PDF
if(isset($jobapplied->current_status)){
 if($jobapplied->current_status == 'selected'){
    $assmnt_id=$assessment->assessment_id;
    $locationID=$assessment->location_id;
    $jobID=$assessment->job_id;
    $candidatefolderpath=DB::table('personal')->where('candidate_id',$assessment->candidate_id)->first();
    $pdf = PDF::loadView('assessment.assmntpdf',compact('assmnt_id','locationID','jobID'));
    $path = public_path('documents/Candidate/'.$candidatefolderpath->directory_path);
    $fileName =  'Assessment'.$assmnt_id. '.' . 'pdf' ;
    $pdf->save($path . '/' . $fileName);

    $candidatedocuments=new CandidateDocument();
    $candidatedocuments->candidate_id=$request->candidateidassessment;
    $candidatedocuments->client_id=$jobapplied->client_id;
    $candidatedocuments->job_id=$jobapplied->job_id;
    $candidatedocuments->location_id=$jobapplied->location;
    $candidatedocuments->document_title=35;
    $candidatedocuments->document_path= $fileName;
    $candidatedocuments->date_submited =strtotime(Date('Y-m-d'));
    $candidatedocuments->save();
    } 
 } 



         }else{

        $assessment=new Assessment();
        $assessment->assessment_type=$request->assessment_type;
        $assessment->candidate_id=$request->candidateidassessment;
        $assessment->enquiry_id=$request->enquiry_id;
        $assessment->job_id =$request->job_id;
        $assessment->location_id =$request->location_id;
        $assessment->assessment_by=auth()->user()->id;
        $assessment->branch_id =$request->branch_id;
        $assessment->personality_appearence=$request->personality_appearence;
        $assessment->personality_remark=$request->personality_remark;
        $assessment->knowledge=$request->knowledge;
        $assessment->knowledge_remark=$request->knowledge_remark;
        $assessment->ledership=$request->ledership;
        $assessment->leadership_remark=$request->leadership_remark;
        $assessment->communication=$request->communication;
        $assessment->communication_remark=$request->communication_remark;
        $assessment->other_assessment=$request->other_assessment;
        $assessment->other_assessment_remark=$request->other_assessment_remark;
        $assessment->degree_optain=$request->degree_optain;
        $assessment->professional_licence_no=$request->professional_licence_no;
        $assessment->technical_qualification=$request->technical_qualification;
        $assessment->key_skill=$request->key_skill;
        $assessment->trade_test=$request->trade_test;
        $assessment->languge_used=$request->languge_used;
        $assessment->languge_used1=$request->languge_used1;
        $assessment->languge_used2=$request->languge_used2;
        $assessment->local_work_experience=$request->local_work_experience;
        $assessment->local_experience_year=$request->local_experience_year;
        $assessment->overseas_expereicne=$request->overseas_expereicne;
        $assessment->overseaase_year=$request->overseaase_year;
        $assessment->overall_assessment=$request->overall_assessment;
        $assessment->overall_rating=$request->overall_rating;
        $assessment->remark=$request->remark;
        $assessment->save();

//--------JobApplied table status change----------------------------------------
        JobApplied::leftJoin('assessment', 'job_applied.candidate_id', '=', 'assessment.candidate_id')
         ->where('job_applied.candidate_id',$request->candidateidassessment)
         ->where('job_applied.location',$request->location_id)
         ->where('job_applied.job_id',$request->job_id)
         ->where('overall_assessment','selected')
         ->update(['current_status' => 'selected']);
//--------JobApplied table status change----------------------------------------



//--------------------------------Send Mail----------------------------------------------
            $candidateEmail=DB::table('personal')
            ->leftJoin('assessment', 'personal.candidate_id', '=', 'personal.candidate_id')
            ->where('overall_assessment','selected')
            ->where('assessment.candidate_id',$request->candidateidassessment)
            ->first();

            if(!empty($candidateEmail->email)){
                 $email=$candidateEmail->email;
                 Mail::send([], [], function ($message) use ($email) {
                 $message->to($email)
                ->setBody('<h1>Selected Successfully!</h1>', 'text/html'); // for HTML rich messages
                });
            }
//-------------------------------------Send Mail-------------------------------------------

//---------ApplicationProcess table status change--------------
      
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidateidassessment;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='assessment';
            $applicationprocess->application_status= $request->overall_assessment;
            $applicationprocess->save();
  
//---------ApplicationProcess table status change--------------



$jobapplied=DB::table('job_applied')->where('candidate_id',$request->candidateidassessment)->where('location',$request->location_id)
         ->where('current_status','selected')->first();
//---- Generate PDF
if(isset($jobapplied->current_status)){
 if($jobapplied->current_status == 'selected'){
    $assmnt_id=$assessment->assessment_id;
    $locationID=$assessment->location_id;
    $jobID=$assessment->job_id;
    $candidatefolderpath=DB::table('personal')->where('candidate_id',$assessment->candidate_id)->first();
    $pdf = PDF::loadView('assessment.assmntpdf',compact('assmnt_id','locationID','jobID'));
    $path = public_path('documents/Candidate/'.$candidatefolderpath->directory_path);
    $fileName =  'Assessment'.$assmnt_id. '.' . 'pdf' ;
    $pdf->save($path . '/' . $fileName);

    $candidatedocuments=new CandidateDocument();
    $candidatedocuments->candidate_id=$request->candidateidassessment;
    $candidatedocuments->client_id=$jobapplied->client_id;
    $candidatedocuments->job_id=$jobapplied->job_id;
    $candidatedocuments->location_id=$jobapplied->location;
    $candidatedocuments->document_title=35;
    $candidatedocuments->document_path= $fileName;
    $candidatedocuments->date_submited =strtotime(Date('Y-m-d'));
    $candidatedocuments->save();
  } 
 } 








//---------ApplicationProcess table status change Start--------------
        //     $updateDetails = [
        //     'application_activity' => 'enrollment',
        //     'application_status' => 'selected',
        //     'created_by' => auth()->user()->id,
        //     'created_date' => strtotime(Date('Y-m-d'))
        //     ];


        // $jobapplied=DB::table('application_process')
        // ->leftJoin('assessment', 'application_process.candidate_id', '=', 'assessment.candidate_id')
        // ->where('application_process.candidate_id',$request->candidateidassessment)
        // ->where('application_process.location_id',$request->location_id)
        // ->where('assessment.overall_assessment','selected')
        // ->update($updateDetails);
//---------ApplicationProcess table status change End--------------

          }

         return redirect()->back()->with('success','Assessment Successfull');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function show(Assessment $assessment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assessment= Assessment::find($id);
        $data['enquiry'] = DB::table('enquiry')->get();
     
        $data['branch'] = DB::table('branch')->get();
        $data['personal'] = DB::table('personal')->get();

          $result  = DB::select(DB::raw("select category_id ,category_name from jobs  LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id  "));
        return view('assessment.edit',compact('assessment','result'),$data);
    }


        public function getAssessment(Request $request)
           {
            $assessment = DB::table("assessment")
            ->where("assessment_id",$request->assessment_id)->get();

		//print_r($assessment);
            return response()->json($assessment);

          }


        

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assessment $assessment)
    {
        
        $assessment =Assessment::find($assessment->assessment_id);
        $assessment->assessment_type=$request->assessment_type;
        $assessment->candidate_id=$request->candidate_id;
        $assessment->enquiry_id=$request->enquiry_id;
        $assessment->job_id =$request->job_id;
        $assessment->assessment_by=auth()->user()->id;
        $assessment->branch_id =$request->branch_id;
        $assessment->personality_appearence=$request->personality_appearence;
        $assessment->personality_remark=$request->personality_remark;
        $assessment->knowledge=$request->knowledge;
        $assessment->knowledge_remark=$request->knowledge_remark;
        $assessment->ledership=$request->ledership;
        $assessment->leadership_remark=$request->leadership_remark;
        $assessment->communication=$request->communication;
        $assessment->communication_remark=$request->communication_remark;
        $assessment->other_assessment=$request->other_assessment;
        $assessment->other_assessment_remark=$request->other_assessment_remark;
        $assessment->degree_optain=$request->degree_optain;
        $assessment->professional_licence_no=$request->professional_licence_no;
        $assessment->technical_qualification=$request->technical_qualification;
        $assessment->key_skill=$request->key_skill;
        $assessment->trade_test=$request->trade_test;
        $assessment->languge_used=$request->languge_used;
        $assessment->languge_used1=$request->languge_used1;
        $assessment->languge_used2=$request->languge_used2;
        $assessment->local_work_experience=$request->local_work_experience;
        $assessment->local_experience_year=$request->local_experience_year;
        $assessment->overseas_expereicne=$request->overseas_expereicne;
        $assessment->overseaase_year=$request->overseaase_year;
        $assessment->overall_assessment=$request->overall_assessment;
        $assessment->overall_rating=$request->overall_rating;
        $assessment->remark=$request->remark;
        $assessment->save();

        return redirect()->route('assessment.index')
                        ->with('success','Assessment Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

     $assessment = DB::table('assessment')->where('assessment_id',$id)->delete();
     return redirect()->route('assessment.index')
                        ->with('success','Assessment Deleted Successfully');

    }
}
