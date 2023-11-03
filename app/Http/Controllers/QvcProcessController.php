<?php

namespace App\Http\Controllers;

use App\Models\QvcProcess;
use App\Models\JobApplied;
use Illuminate\Http\Request;
use DB;
use Mail;
use App\Models\ApplicationProcess;
use App\Models\CandidateDocument;
use File;
class QvcProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qvcprocesss=QvcProcess::all();
       return view('qvcprocess.index',['qvcprocesss'=>$qvcprocesss]);
    }

    public function qvcPrint(){
        return view('qvcprocess.qvcprint');
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

        return view('qvcprocess.create',compact('result'),$data);
    }


     public function getEnquiryQvc(Request $request)
           {
            $enquirys = DB::table("enquiry")
            ->where("client_id",$request->client_id)
            ->pluck("enquiry_title","enquiry_id");
            return response()->json($enquirys);
          }


        public function getJobQvc(Request $request)
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


     $dataqvcprocess=QvcProcess::where('qvc_id',$request->id_qvc)->first();
         if(!empty($dataqvcprocess)){

        $qvcprocess=QvcProcess::find($dataqvcprocess->qvc_id);
        $qvcprocess->candidate_id =$request->candidateqvc ;
        $qvcprocess->client_id =$request->client_id ;
        $qvcprocess->enquiry_id=$request->enquiry_id;
        $qvcprocess->job_id =$request->job_id;
        $qvcprocess->location_id =$request->location_id;
        $qvcprocess->client_applied_date =strtotime($request->client_applied_date);
        $qvcprocess->appointment_date =strtotime($request->appointment_date);
        //$qvcprocess->medical_fit_date =strtotime($request->medical_fit_date);
       // $qvcprocess->medical_unfit_date =strtotime($request->medical_unfit_date);
        $qvcprocess->created_by=auth()->user()->id;
        //$qvcprocess->remark=$request->remark ;

         $qvcprocess->medical_status=$request->date_medical_fit;



       if($request->date_medical_fit == "medical_fit_date"){
           $qvcprocess->medical_fit_date =strtotime($request->medical_fit_date);
           $qvcprocess->medical_fit_remark =$request->qvc_remark;
        }
       if($request->date_medical_fit == "medical_unfit_date"){
          $qvcprocess->medical_unfit_date =strtotime($request->medical_fit_date);
          $qvcprocess->medical_unfit_remark =$request->qvc_remark;
        }

       if($request->date_medical_fit == "report_pending"){
           $qvcprocess->report_pending =strtotime($request->medical_fit_date);
           $qvcprocess->report_pending_remark =$request->qvc_remark;
        }
       if($request->date_medical_fit == "reschedule"){
          $qvcprocess->reschedule =strtotime($request->medical_fit_date);
          $qvcprocess->reschedule_remark =$request->qvc_remark;
        }
      
    $candidatePath=DB::table('personal')->where('candidate_id',$request->candidateqvc)->select('directory_path')->first();

            if($request->hasfile('attached_document1')){

                    $file_1=  $qvcprocess->attached_document1;
                    $filename_1=public_path("documents/Candidate/".$candidatePath->directory_path."/". $file_1);
                      if(!empty($file_1)){
                           if (File::exists($filename_1)){       
                               unlink($filename_1);
                            }
                       }
                $file=$request->file('attached_document1');
                $extension=$file->getClientOriginalName();
                $filename=$extension;
                $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename);
                $qvcprocess->attached_document1=$filename;
            }

            if($request->hasfile('attached_document2')){

                    $file_2=  $qvcprocess->attached_document2;
                    $filename_2=public_path("documents/Candidate/".$candidatePath->directory_path."/". $file_2);
                      if(!empty($file_2)){
                           if (File::exists($filename_2)){       
                               unlink($filename_2);
                            }
                       }

                    $file=$request->file('attached_document2');
                    $extension=$file->getClientOriginalName();
                    $filename2=$extension;
                    $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename2);
                    $qvcprocess->attached_document2=$filename2;
            }

            if($request->hasfile('attached_document3')){

                    $file_3=  $qvcprocess->attached_document3;
                    $filename_3=public_path("documents/Candidate/".$candidatePath->directory_path."/". $file_3);
                      if(!empty($file_3)){
                           if (File::exists($filename_3)){       
                               unlink($filename_3);
                            }
                       }


                $file=$request->file('attached_document3');
                $extension=$file->getClientOriginalName();
                $filename3=$extension;
                $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename3);
                $qvcprocess->attached_document3=$filename3;
            }

            $qvcprocess->save();

         JobApplied::leftJoin('qvc_process', 'job_applied.candidate_id', '=', 'qvc_process.candidate_id')
          ->where('job_applied.candidate_id',$request->candidateqvc)
          ->where('job_applied.location',$request->location_id)
           ->where('job_applied.job_id',$request->job_id)
          ->where('medical_fit_date', '!=', 0)
          ->update(['current_status' => 'qvc']);



//---------------------------------Send Mail-------------------------------------------------
$candidateEmail=DB::table('personal')
->leftJoin('job_applied', 'job_applied.candidate_id', '=', 'personal.candidate_id')
->where('job_applied.location',$request->location_id)
->where('job_applied.candidate_id',$request->candidateqvc)
->where('current_status', 'qvc')
->first();

if(!empty($candidateEmail->email)){
 $email=$candidateEmail->email;
 Mail::send([], [], function ($message) use ($email) {
 $message->to($email)
  ->setBody('<h1>Hi,QVC Successfully!</h1>', 'text/html'); // for HTML rich messages
 });
}
//----------------------------------Send Mail------------------------------------------------------


//---------ApplicationProcess table status change--------------
            if(!empty($request->client_applied_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidateqvc;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='medical';
            $applicationprocess->application_status='client applied' ;
            $applicationprocess->save();
            }
            if(!empty($request->appointment_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidateqvc;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='medical';
            $applicationprocess->application_status='appoinment date';
            $applicationprocess->save();
            }
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidateqvc;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='medical';
            $applicationprocess->application_status=$request->date_medical_fit;
            $applicationprocess->save();
         
//---------ApplicationProcess table status change--------------

//-----------------Medical Document pass in Candidate Document----------------------------
         $jobapplied=DB::table('job_applied')
         ->where('candidate_id',$request->candidateqvc)
         ->where('location',$request->location_id)
         ->where('current_status','qvc')->first();

           if(isset($jobapplied->current_status)){
            if($jobapplied->current_status == 'qvc'){

              if(!empty($qvcprocess->attached_document1)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidateqvc;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 32;
                $candidatedocument->document_path =  $qvcprocess->attached_document1;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
                if(!empty($qvcprocess->attached_document2)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidateqvc;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 32;
                $candidatedocument->document_path =  $qvcprocess->attached_document2;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                 } 
                if(!empty($qvcprocess->attached_document3)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidateqvc;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 32;
                $candidatedocument->document_path =  $qvcprocess->attached_document3;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
            }
        }
//-----------------Medical Document pass in Candidate Document----------------------------

        return redirect()->back()->with('success','Qvc Process Updated Successfully');

    }else{



        $qvcprocess=new QvcProcess();
        $qvcprocess->candidate_id =$request->candidateqvc ;
        $qvcprocess->client_id =$request->client_id ;
        $qvcprocess->enquiry_id=$request->enquiry_id;
        $qvcprocess->job_id =$request->job_id;
        $qvcprocess->location_id =$request->location_id;
        $qvcprocess->client_applied_date =strtotime($request->client_applied_date);
        $qvcprocess->appointment_date =strtotime($request->appointment_date);
        //$qvcprocess->medical_fit_date =strtotime($request->medical_fit_date);
        //$qvcprocess->medical_unfit_date =strtotime($request->medical_unfit_date);
        $qvcprocess->created_by=auth()->user()->id;

      $qvcprocess->medical_status=$request->date_medical_fit;

         if($request->date_medical_fit == "medical_fit_date"){
           $qvcprocess->medical_fit_date =strtotime($request->medical_fit_date);
           $qvcprocess->medical_fit_remark =$request->qvc_remark;
        }
       if($request->date_medical_fit == "medical_unfit_date"){
          $qvcprocess->medical_unfit_date =strtotime($request->medical_fit_date);
          $qvcprocess->medical_unfit_remark =$request->qvc_remark;
        }

       if($request->date_medical_fit == "report_pending"){
           $qvcprocess->report_pending =strtotime($request->medical_fit_date);
           $qvcprocess->report_pending_remark =$request->qvc_remark;
        }
       if($request->date_medical_fit == "reschedule"){
          $qvcprocess->reschedule =strtotime($request->medical_fit_date);
          $qvcprocess->reschedule_remark =$request->qvc_remark;
        }
        

      
    $candidatePath=DB::table('personal')->where('candidate_id',$request->candidateqvc)->select('directory_path')->first();

            if($request->hasfile('attached_document1')){
            $file=$request->file('attached_document1');
            $extension=$file->getClientOriginalName();
            $filename=$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename);
            $qvcprocess->attached_document1=$filename;
            }else{
            $qvcprocess->attached_document1="";
            }

            if($request->hasfile('attached_document2')){
            $file=$request->file('attached_document2');
            $extension=$file->getClientOriginalName();
            $filename2=$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename2);
            $qvcprocess->attached_document2=$filename2;
            }else{
            $qvcprocess->attached_document2="";
            }

            if($request->hasfile('attached_document3')){
            $file=$request->file('attached_document3');
            $extension=$file->getClientOriginalName();
            $filename3=$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename3);
            $qvcprocess->attached_document3=$filename3;
            }else{
            $qvcprocess->attached_document3="";
             }

            $qvcprocess->save();

         JobApplied::leftJoin('qvc_process', 'job_applied.candidate_id', '=', 'qvc_process.candidate_id')
          ->where('job_applied.candidate_id',$request->candidateqvc)
          ->where('job_applied.location',$request->location_id)
           ->where('job_applied.job_id',$request->job_id)
          ->where('medical_fit_date', '!=', 0)
          ->update(['current_status' => 'qvc']);


//---------------------------------Send Mail-------------------------------------------------
$candidateEmail=DB::table('personal')
->leftJoin('job_applied', 'job_applied.candidate_id', '=', 'personal.candidate_id')
->where('job_applied.location',$request->location_id)
->where('job_applied.candidate_id',$request->candidateqvc)
->where('current_status', 'qvc')
->first();

 if(!empty($candidateEmail->email)){
     $email=$candidateEmail->email;
     Mail::send([], [], function ($message) use ($email) {
     $message->to($email)
     ->setBody('<h1>Hi,QVC Successfully!</h1>', 'text/html'); // for HTML rich messages
    });
  }
//----------------------------------Send Mail------------------------------------------------------


//---------ApplicationProcess table status change--------------
            if(!empty($request->client_applied_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidateqvc;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='medical';
            $applicationprocess->application_status='client applied ' ;
            $applicationprocess->save();
            }
            if(!empty($request->appointment_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidateqvc;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='medical';
            $applicationprocess->application_status='appoinment date';
            $applicationprocess->save();
            }
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidateqvc;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='medical';
            $applicationprocess->application_status=$request->date_medical_fit;
            $applicationprocess->save();
         
//---------ApplicationProcess table status change--------------

//-----------------Medical Document pass in Candidate Document----------------------------
         $jobapplied=DB::table('job_applied')
         ->where('candidate_id',$request->candidateqvc)
         ->where('location',$request->location_id)
         ->where('current_status','qvc')->first();

           if(isset($jobapplied->current_status)){
            if($jobapplied->current_status == 'qvc'){

              if(!empty($qvcprocess->attached_document1)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidateqvc;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 32;
                $candidatedocument->document_path =  $qvcprocess->attached_document1;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
                if(!empty($qvcprocess->attached_document2)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidateqvc;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 32;
                $candidatedocument->document_path =  $qvcprocess->attached_document2;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                 } 
                if(!empty($qvcprocess->attached_document3)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidateqvc;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 32;
                $candidatedocument->document_path =  $qvcprocess->attached_document3;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
            }
        }
//-----------------Medical Document pass in Candidate Document----------------------------

//---------ApplicationProcess table status change Start--------------
        //     $updateDetails = [
        //     'application_activity' => 'qvc',
        //     'application_status' => 'qvc',
        //     'application_process.created_by' => auth()->user()->id,
        //     'created_date' => strtotime(Date('Y-m-d'))
        //     ];


        // $jobapplied=DB::table('application_process')
        // ->leftJoin('qvc_process', 'application_process.candidate_id', '=', 'qvc_process.candidate_id')
        // ->where('application_process.candidate_id',$request->candidateqvc)
        // ->where('application_process.location_id',$request->location_id)
        // ->where('qvc_process.medical_fit_date', '!=', 0)
        // ->update($updateDetails);
//---------ApplicationProcess table status change End--------------







        return redirect()->back()->with('success','Qvc Process Created Successfully');

    }















    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QvcProcess  $qvcProcess
     * @return \Illuminate\Http\Response
     */
    public function show(QvcProcess $qvcProcess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QvcProcess  $qvcProcess
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $qvcprocess= QvcProcess::find($id);
        $data['personal'] = DB::table('personal')->get();
        $data['enquiry'] = DB::table('enquiry')->get();
        $data['client'] = DB::table('client')->get();
        $result  = DB::select(DB::raw("select category_id ,category_name from jobs  LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id  "));
        return view('qvcprocess.edit',compact('qvcprocess','result'),$data);
    }



       public function getQvc(Request $request)
           {
              $qvcprocess = DB::table("qvc_process")
              ->leftJoin('personal','personal.candidate_id','=','qvc_process.candidate_id')
              ->where("qvc_id",$request->qvc_id)->get();

              //print_r($qvcprocess);
            return response()->json($qvcprocess);

          }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QvcProcess  $qvcProcess
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $qvcprocess= QvcProcess::find($id);
        $qvcprocess->candidate_id =$request->candidate_id ;
        $qvcprocess->client_id =$request->client_id ;
        $qvcprocess->enquiry_id=$request->enquiry_id;
        $qvcprocess->job_id =$request->job_id;
        $qvcprocess->client_applied_date =strtotime(date('Y-m-d'));
        $qvcprocess->appointment_date =strtotime(date('Y-m-d'));
        $qvcprocess->medical_fit_date =strtotime(date('Y-m-d'));
        $qvcprocess->medical_unfit_date =strtotime(date('Y-m-d'));
        $qvcprocess->created_by=auth()->user()->id;
        $qvcprocess->remark=$request->remark ;
      

     $candidatePath=DB::table('candidate_documents')->where('candidate_id',$request->candidate_id)->select('folder_path')->first();

            if($request->hasfile('attached_document1')){
            $file=$request->file('attached_document1');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid().'.'.$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename);
            $qvcprocess->attached_document1=$filename;
            }


            if($request->hasfile('attached_document2')){
            $file=$request->file('attached_document2');
            $extension=$file->getClientOriginalExtension();
            $filename2=uniqid().'.'.$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename2);
            $qvcprocess->attached_document2=$filename2;
            }


            if($request->hasfile('attached_document3')){
            $file=$request->file('attached_document3');
            $extension=$file->getClientOriginalExtension();
            $filename3=uniqid().'.'.$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename3);
            $qvcprocess->attached_document3=$filename3;
            }


            $qvcprocess->save();
        return redirect()->route('qvcprocess.index')->with('success','Qvc Process Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QvcProcess  $qvcProcess
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $qvcprocess=DB::table('qvc_process')->where('qvc_id',$id)->delete();
        return redirect()->route('qvcprocess.index')->with('success','Qvc Process Deleted Successfully');

    }
}
