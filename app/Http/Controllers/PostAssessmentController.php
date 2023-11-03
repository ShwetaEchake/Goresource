<?php

namespace App\Http\Controllers;

use App\Models\PostAssessment;
use App\Models\JobApplied;
use Illuminate\Http\Request;
use DB;
use Mail;
use PDF;
use App\Models\ApplicationProcess;
use App\Models\CandidateDocument;

class PostAssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postassessments=PostAssessment::all();
        return view('postassessment.index',['postassessments'=>$postassessments]);
    }


        public function postassessmentPrint(){
            //$pdf = PDF::loadView('postassessment.postassmntpdf');
           // return $pdf->download('postassessment.pdf');
            return view('postassessment.postassmntprint');
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
        $data['branch'] = DB::table('branch')->get();
        $data['personal'] = DB::table('personal')->get();
        $result  = DB::select(DB::raw("select category_id ,category_name from jobs  LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id  "));


        return view('postassessment.create',$data,compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


         $datapostassessment=PostAssessment::where('post_assessment_id',$request->id_postassessment)->first();
         if(!empty($datapostassessment)){

        $postassessment=PostAssessment::find($datapostassessment->post_assessment_id);
        $postassessment->assessment_type=$request->assessment_type;
        $postassessment->candidate_id=$request->candidatepostassessment;
        $postassessment->enquiry_id=$request->enquiry_id;
        $postassessment->job_id =$request->job_id;
        $postassessment->location_id =$request->location_id;
        $postassessment->assessment_by=auth()->user()->id;
        $postassessment->personality_appearence=$request->post_personality_appearence;
        $postassessment->personality_remark=$request->post_personality_remark;
        $postassessment->knowledge=$request->post_knowledge;
        $postassessment->knowledge_remark=$request->post_knowledge_remark;
        $postassessment->ledership=$request->post_ledership;
        $postassessment->leadership_remark=$request->post_leadership_remark;
        $postassessment->communication=$request->post_communication;
        $postassessment->communication_remark=$request->post_communication_remark;
        $postassessment->other_assessment=$request->post_other_assessment;
        $postassessment->other_assessment_remark=$request->post_other_assessment_remark;
        $postassessment->degree_optain=$request->post_degree_optain;
        $postassessment->professional_licence_no=$request->post_professional_licence_no;
        $postassessment->technical_qualification=$request->post_technical_qualification;
        $postassessment->key_skill=$request->post_key_skill;
        $postassessment->trade_test=$request->post_trade_test;
        $postassessment->languge_used=$request->post_languge_used;
        $postassessment->languge_used1=$request->post_languge_used1;
        $postassessment->languge_used2=$request->post_languge_used2;
        $postassessment->local_work_experience=$request->post_local_work_experience;
        $postassessment->local_experience_year=$request->post_local_experience_year;
        $postassessment->overseas_expereicne=$request->post_overseas_expereicne;
        $postassessment->overseaase_year=$request->post_overseaase_year;
        $postassessment->overall_assessment=$request->post_overall_assessment;
        $postassessment->overall_rating=$request->post_overall_rating;
        $postassessment->remark=$request->post_remark;
        $postassessment->save();

          JobApplied::leftJoin('post_assessment', 'job_applied.candidate_id', '=', 'post_assessment.candidate_id')
             ->where('job_applied.candidate_id',$request->candidatepostassessment)
             ->where('job_applied.location',$request->location_id)
              ->where('job_applied.job_id',$request->job_id)
             ->where('overall_assessment','selected')
             ->update(['current_status' => 'selection']);



  //--------------------------------Send Mail----------------------------------------------
            $candidateEmail=DB::table('personal')
            ->leftJoin('post_assessment', 'personal.candidate_id', '=', 'personal.candidate_id')
            ->where('overall_assessment','selected')
            ->where('post_assessment.candidate_id',$request->candidatepostassessment)
            ->first();

              if(!empty($candidateEmail->email)){
                 $email=$candidateEmail->email;
                 Mail::send([], [], function ($message) use ($email) {
                 $message->to($email)
                ->setBody('<h1>Selection Successfully!</h1>', 'text/html'); // for HTML rich messages
                 });
              }
//-------------------------------------Send Mail-------------------------------------------


//---------ApplicationProcess table status change--------------
     //    $application_process=DB::table('application_process')
     //     ->where('candidate_id',$request->candidatepostassessment)
     //     ->where('location_id',$request->location_id)
     //     ->where('application_status',$request->overall_assessment)
     //     ->first();
     
     //  if(!empty($application_process)){
       
     //          $dateupdate=DB::table('application_process')
     //         ->where('candidate_id',$request->candidatepostassessment)
     //         ->where('location_id',$request->location_id)
     //         ->update(['created_date' => strtotime(Date('Y-m-d'))]);
          
     // }else{
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidatepostassessment;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='interview';
            $applicationprocess->application_status= $request->post_overall_assessment;
            $applicationprocess->save();
     // }
//---------ApplicationProcess table status change--------------





 $jobapplied=DB::table('job_applied')->where('candidate_id',$request->candidatepostassessment)->where('location',$request->location_id)
         ->where('current_status','selection')->first();
//-----------POST ASSESSMENT PDF--------------------
if(isset($jobapplied->current_status)){
 if($jobapplied->current_status == 'selection'){
    $post_assmnt_id=$postassessment->post_assessment_id;
    $locationID=$postassessment->location_id;
    $jobID=$postassessment->job_id;
    $candidatefolderpath=DB::table('personal')->where('candidate_id',$postassessment->candidate_id)->first();
    $pdf = PDF::loadView('postassessment.postassmntpdf',compact('post_assmnt_id','locationID','jobID'));
    $path = public_path('documents/Candidate/'.$candidatefolderpath->directory_path);
    $fileName =  'PostAssessment'.$post_assmnt_id. '.' . 'pdf' ;
    $pdf->save($path . '/' . $fileName);

    $candidatedocuments=new CandidateDocument();
    $candidatedocuments->candidate_id=$request->candidatepostassessment;
    $candidatedocuments->client_id=$jobapplied->client_id;
    $candidatedocuments->job_id=$jobapplied->job_id;
    $candidatedocuments->location_id=$jobapplied->location;
    $candidatedocuments->document_title=36;
    $candidatedocuments->document_path= $fileName;
    $candidatedocuments->date_submited =strtotime(Date('Y-m-d'));
    $candidatedocuments->save();
  } 
}
//-----------POST ASSESSMENT PDF-------------------------


        }else{

        $postassessment=new PostAssessment();
        $postassessment->assessment_type=$request->assessment_type;
        $postassessment->candidate_id=$request->candidatepostassessment;
        $postassessment->enquiry_id=$request->enquiry_id;
        $postassessment->job_id =$request->job_id;
        $postassessment->location_id =$request->location_id;
        $postassessment->assessment_by=auth()->user()->id;
        $postassessment->personality_appearence=$request->post_personality_appearence;
        $postassessment->personality_remark=$request->post_personality_remark;
        $postassessment->knowledge=$request->post_knowledge;
        $postassessment->knowledge_remark=$request->post_knowledge_remark;
        $postassessment->ledership=$request->post_ledership;
        $postassessment->leadership_remark=$request->post_leadership_remark;
        $postassessment->communication=$request->post_communication;
        $postassessment->communication_remark=$request->post_communication_remark;
        $postassessment->other_assessment=$request->post_other_assessment;
        $postassessment->other_assessment_remark=$request->post_other_assessment_remark;
        $postassessment->degree_optain=$request->post_degree_optain;
        $postassessment->professional_licence_no=$request->post_professional_licence_no;
        $postassessment->technical_qualification=$request->post_technical_qualification;
        $postassessment->key_skill=$request->post_key_skill;
        $postassessment->trade_test=$request->post_trade_test;
        $postassessment->languge_used=$request->post_languge_used;
        $postassessment->languge_used1=$request->post_languge_used1;
        $postassessment->languge_used2=$request->post_languge_used2;
        $postassessment->local_work_experience=$request->post_local_work_experience;
        $postassessment->local_experience_year=$request->post_local_experience_year;
        $postassessment->overseas_expereicne=$request->post_overseas_expereicne;
        $postassessment->overseaase_year=$request->post_overseaase_year;
        $postassessment->overall_assessment=$request->post_overall_assessment;
        $postassessment->overall_rating=$request->post_overall_rating;
        $postassessment->remark=$request->post_remark;
        $postassessment->save();

         JobApplied::leftJoin('post_assessment', 'job_applied.candidate_id', '=', 'post_assessment.candidate_id')
           ->where('job_applied.candidate_id',$request->candidatepostassessment)
           ->where('job_applied.location',$request->location_id)
            ->where('job_applied.job_id',$request->job_id)
           ->where('overall_assessment','selected')
           ->update(['current_status' => 'selection']);

//--------------------------------Send Mail----------------------------------------------
            $candidateEmail=DB::table('personal')
            ->leftJoin('post_assessment', 'personal.candidate_id', '=', 'personal.candidate_id')
            ->where('overall_assessment','selected')
            ->where('post_assessment.candidate_id',$request->candidatepostassessment)
            ->first();

             if(!empty($candidateEmail->email)){
                 $email=$candidateEmail->email;
                 Mail::send([], [], function ($message) use ($email) {
                 $message->to($email)
                ->setBody('<h1>Selection Successfully!</h1>', 'text/html'); // for HTML rich messages
                });
              }
//-------------------------------------Send Mail-------------------------------------------



//---------ApplicationProcess table status change--------------
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidatepostassessment;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='interview';
            $applicationprocess->application_status= $request->post_overall_assessment;
            $applicationprocess->save();
//---------ApplicationProcess table status change--------------




$jobapplied=DB::table('job_applied')->where('candidate_id',$request->candidatepostassessment)->where('location',$request->location_id)
         ->where('current_status','selection')->first();
//-----------POST ASSESSMENT PDF--------------------
if(isset($jobapplied->current_status)){
 if($jobapplied->current_status == 'selection'){
    $post_assmnt_id=$postassessment->post_assessment_id;
    $locationID=$postassessment->location_id;
    $jobID=$postassessment->job_id;
    $candidatefolderpath=DB::table('personal')->where('candidate_id',$postassessment->candidate_id)->first();
    $pdf = PDF::loadView('postassessment.postassmntpdf',compact('post_assmnt_id','locationID','jobID'));
    $path = public_path('documents/Candidate/'.$candidatefolderpath->directory_path);
    $fileName =  'PostAssessment'.$post_assmnt_id. '.' . 'pdf' ;
    $pdf->save($path . '/' . $fileName);

    $candidatedocuments=new CandidateDocument();
    $candidatedocuments->candidate_id=$request->candidatepostassessment;
    $candidatedocuments->client_id=$jobapplied->client_id;
    $candidatedocuments->job_id=$jobapplied->job_id;
    $candidatedocuments->location_id=$jobapplied->location;
    $candidatedocuments->document_title=36;
    $candidatedocuments->document_path= $fileName;
    $candidatedocuments->date_submited =strtotime(Date('Y-m-d'));
    $candidatedocuments->save();
  } 
}
//-----------POST ASSESSMENT PDF-------------------------


//---------ApplicationProcess table status change Start--------------
        //     $updateDetails = [
        //     'application_activity' => 'selection',
        //     'application_status' => 'selection',
        //     'created_by' => auth()->user()->id,
        //     'created_date' => strtotime(Date('Y-m-d'))
        //     ];
        // $jobapplied=DB::table('application_process')
        // ->leftJoin('post_assessment', 'application_process.candidate_id', '=', 'post_assessment.candidate_id')
        // ->where('application_process.candidate_id',$request->candidatepostassessment)
        // ->where('application_process.location_id',$request->location_id)
        // ->where('post_assessment.overall_assessment','selected')
        // ->update($updateDetails);
//---------ApplicationProcess table status change End--------------



       }

                 return redirect()->back()->with('success','Post Assessment Successfull');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function show()
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
        $postassessment= PostAssessment::find($id);
        $data['enquiry'] = DB::table('enquiry')->get();
     
        $data['branch'] = DB::table('branch')->get();
        $data['personal'] = DB::table('personal')->get();

          $result  = DB::select(DB::raw("select category_id ,category_name from jobs  LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id  "));
        return view('postassessment.edit',compact('postassessment','result'),$data);
    }





        public function getPostAssessment(Request $request)
           {
              $postassessment = DB::table("post_assessment")
              ->where("post_assessment_id",$request->post_assessment_id)->get();

              //print_r($postassessment);
            return response()->json($postassessment);

          }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $postassessment =PostAssessment::find($id);
        $postassessment->assessment_type=$request->assessment_type;
        $postassessment->candidate_id=$request->candidate_id;
        $postassessment->enquiry_id=$request->enquiry_id;
        $postassessment->job_id =$request->job_id;
        $postassessment->assessment_by=auth()->user()->id;
        $postassessment->branch_id =$request->branch_id;
        $postassessment->personality_appearence=$request->personality_appearence;
        $postassessment->personality_remark=$request->personality_remark;
        $postassessment->knowledge=$request->knowledge;
        $postassessment->knowledge_remark=$request->knowledge_remark;
        $postassessment->ledership=$request->ledership;
        $postassessment->leadership_remark=$request->leadership_remark;
        $postassessment->communication=$request->communication;
        $postassessment->communication_remark=$request->communication_remark;
        $postassessment->other_assessment=$request->other_assessment;
        $postassessment->other_assessment_remark=$request->other_assessment_remark;
        $postassessment->degree_optain=$request->degree_optain;
        $postassessment->professional_licence_no=$request->professional_licence_no;
        $postassessment->technical_qualification=$request->technical_qualification;
        $postassessment->key_skill=$request->key_skill;
        $postassessment->trade_test=$request->trade_test;
        $postassessment->languge_used=$request->languge_used;
        $postassessment->local_work_experience=$request->local_work_experience;
        $postassessment->local_experience_year=$request->local_experience_year;
        $postassessment->overseas_expereicne=$request->overseas_expereicne;
        $postassessment->overseaase_year=$request->overseaase_year;
        $postassessment->overall_assessment=$request->overall_assessment;
        $postassessment->overall_rating=$request->overall_rating;
        $postassessment->remark=$request->remark;
        $postassessment->save();

        return redirect()->route('postassessment.index')
                        ->with('success','Post Assessment Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

     $postassessment = DB::table('post_assessment')->where('post_assessment_id',$id)->delete();
     return redirect()->route('postassessment.index')
                        ->with('success',' Post Assessment Deleted Successfully');

    }
}
