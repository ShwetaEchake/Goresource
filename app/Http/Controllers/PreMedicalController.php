<?php

namespace App\Http\Controllers;

use App\Models\PreMedical;
use App\Models\JobApplied;
use Illuminate\Http\Request;
use DB;
use Mail;
use PDF;
use App\Models\ApplicationProcess;
use App\Models\CandidateDocument;
use File;
class PreMedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $premedicals=PreMedical::all();
       return view('premedical.index',['premedicals'=>$premedicals]);
    }


      public function premedicalPrint(){
       // $pdf = PDF::loadView('premedical.premedicalpdf');
       // return $pdf->download('premedical.pdf');
        return view('premedical.premedicalprint');
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

        return view('premedical.create',compact('result'),$data);
    }


      public function getEnquiryPre(Request $request)
           {
            $enquirys = DB::table("enquiry")
            ->where("client_id",$request->client_id)
            ->pluck("enquiry_title","enquiry_id");
            return response()->json($enquirys);
          }


        public function getJobPre(Request $request)
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


     $datapremedical=PreMedical::where('premedical_id',$request->id_premedical)->first();
         if(!empty($datapremedical)){
     $premedical=PreMedical::find($datapremedical->premedical_id);

        $premedical->candidate_id =$request->candidatepremedical ;
        $premedical->client_id =$request->client_id ;
        $premedical->enquiry_id=$request->enquiry_id;
        $premedical->job_id =$request->job_id;
        $premedical->location_id =$request->location_id;

        $premedical->medicalstatus=$request->datefit;


        if($request->datefit == "fit_date"){
           $premedical->fit_date =strtotime($request->fit_date);
           $premedical->fit_remark =$request->premedical_remark;

        }
         if($request->datefit == "unfit_date"){
          $premedical->unfit_date =strtotime($request->fit_date);
          $premedical->unfit_remark =$request->premedical_remark;
        }

         if($request->datefit == "pending"){
          $premedical->pending =strtotime($request->fit_date);
          $premedical->pending_remark =$request->premedical_remark;
        }
        

        $premedical->medical_examination_center_id=$request->medical_examination_center_id;
        $premedical->created_by=auth()->user()->id;
        //$premedical->remark=$request->remark;
      
    $candidatePath=DB::table('personal')->where('candidate_id',$request->candidatepremedical)->select('directory_path')->first();

            if($request->hasfile('attached_document1')){

                    $file_1=  $premedical->attached_document1;
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
                    $premedical->attached_document1=$filename;
            }

            if($request->hasfile('attached_document2')){

                    $file_2=  $premedical->attached_document2;
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
                $premedical->attached_document2=$filename2;
            }

            if($request->hasfile('attached_document3')){

                    $file_3=  $premedical->attached_document3;
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
                $premedical->attached_document3=$filename3;
            }

             $premedical->save();

        JobApplied::leftJoin('pre_medical', 'job_applied.candidate_id', '=', 'pre_medical.candidate_id')
         ->where('job_applied.candidate_id',$request->candidatepremedical)
         ->where('job_applied.location',$request->location_id)
          ->where('job_applied.job_id',$request->job_id)
         ->where('fit_date', '!=', 0)
         ->update(['current_status' => 'medical_fit']);



//---------------------------------Send Mail-------------------------------------------------
    $candidateEmail=DB::table('personal')
    ->leftJoin('job_applied', 'job_applied.candidate_id', '=', 'personal.candidate_id')
    ->where('job_applied.location',$request->location_id)
    ->where('job_applied.candidate_id',$request->candidatepremedical)
    ->where('current_status', 'medical_fit')
    ->first();

       if(!empty($candidateEmail->email)){
         $email=$candidateEmail->email;
         Mail::send([], [], function ($message) use ($email) {
         $message->to($email)->setBody('<h1>Hi,Pre Medical Successfully!</h1>', 'text/html'); // for HTML rich messages
         });
       }
//----------------------------------Send Mail------------------------------------------------------


 //---------ApplicationProcess table status change--------------
        // $jobapplied=DB::table('job_applied')
        //  ->where('candidate_id',$request->candidatepremedical)
        //  ->where('location',$request->location_id)
        //  ->where('current_status','medical_fit')->first();

        //  if(isset($jobapplied->current_status)){
        //     if($jobapplied->current_status == 'medical_fit'){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidatepremedical;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='offers';
            $applicationprocess->application_status=$request->datefit;
            $applicationprocess->save();
         //   }
         // }
//---------ApplicationProcess table status change--------------

//-----------------Medical Document pass in Candidate Document----------------------------
         $jobapplied=DB::table('job_applied')
         ->where('candidate_id',$request->candidatepremedical)
         ->where('location',$request->location_id)
         ->where('current_status','medical_fit')->first();

           if(isset($jobapplied->current_status)){
            if($jobapplied->current_status == 'medical_fit'){

              if(!empty($premedical->attached_document1)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatepremedical;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 31;
                $candidatedocument->document_path =  $premedical->attached_document1;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
                if(!empty($premedical->attached_document2)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatepremedical;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 31;
                $candidatedocument->document_path =  $premedical->attached_document2;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                 } 
                if(!empty($premedical->attached_document3)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatepremedical;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 31;
                $candidatedocument->document_path =  $premedical->attached_document3;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
            }
        }
//-----------------Medical Document pass in Candidate Document----------------------------

        return redirect()->back()->with('success','Pre Medical Updated Successfully');


         }else{

        $premedical=new PreMedical();
        $premedical->candidate_id =$request->candidatepremedical ;
        $premedical->client_id =$request->client_id ;
        $premedical->enquiry_id=$request->enquiry_id;
        $premedical->job_id =$request->job_id;
        $premedical->location_id =$request->location_id;
       // $premedical->fit_date =strtotime($request->fit_date);
       // $premedical->unfit_date =strtotime($request->unfit_date);
        $premedical->medicalstatus=$request->datefit;

        if($request->datefit == "fit_date"){
           $premedical->fit_date =strtotime($request->fit_date);
           $premedical->fit_remark =$request->premedical_remark;
        }
         if($request->datefit == "unfit_date"){
          $premedical->unfit_date =strtotime($request->fit_date);
          $premedical->unfit_remark =$request->premedical_remark;
        }
         if($request->datefit == "pending"){
          $premedical->pending =strtotime($request->fit_date);
          $premedical->pending_remark =$request->premedical_remark;
        }

        $premedical->medical_examination_center_id=$request->medical_examination_center_id;

        $premedical->created_by=auth()->user()->id;
       // $premedical->remark=$request->remark ;
      
    $candidatePath=DB::table('personal')->where('candidate_id',$request->candidatepremedical)->select('directory_path')->first();

            if($request->hasfile('attached_document1')){
            $file=$request->file('attached_document1');
            $extension=$file->getClientOriginalName();
            $filename=$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename);
            $premedical->attached_document1=$filename;
            }else{
            $premedical->attached_document1="";
            }

            if($request->hasfile('attached_document2')){
            $file=$request->file('attached_document2');
            $extension=$file->getClientOriginalName();
            $filename2=$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename2);
            $premedical->attached_document2=$filename2;
            }else{
            $premedical->attached_document2="";
            }

            if($request->hasfile('attached_document3')){
            $file=$request->file('attached_document3');
            $extension=$file->getClientOriginalName();
            $filename3=$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename3);
            $premedical->attached_document3=$filename3;
            }else{
            $premedical->attached_document3="";
            }

             $premedical->save();


        JobApplied::leftJoin('pre_medical', 'job_applied.candidate_id', '=', 'pre_medical.candidate_id')
         ->where('job_applied.candidate_id',$request->candidatepremedical)
         ->where('job_applied.location',$request->location_id)
          ->where('job_applied.job_id',$request->job_id)
         ->where('fit_date', '!=', 0)
         ->update(['current_status' => 'medical_fit']);



//---------------------------------Send Mail-------------------------------------------------
    $candidateEmail=DB::table('personal')
    ->leftJoin('job_applied', 'job_applied.candidate_id', '=', 'personal.candidate_id')
    ->where('job_applied.location',$request->location_id)
    ->where('job_applied.candidate_id',$request->candidatepremedical)
    ->where('current_status', 'medical_fit')
    ->first();

    if(!empty($candidateEmail->email)){
       $email=$candidateEmail->email;
       Mail::send([], [], function ($message) use ($email) {
       $message->to($email)->setBody('<h1>Hi,Pre Medical Successfully!</h1>', 'text/html'); // for HTML rich messages
      });
    }
//----------------------------------Send Mail------------------------------------------------------


 //---------ApplicationProcess table status change--------------
        // $jobapplied=DB::table('job_applied')
        //  ->where('candidate_id',$request->candidatepremedical)
        //  ->where('location',$request->location_id)
        //  ->where('current_status','medical_fit')->first();

        //  if(isset($jobapplied->current_status)){
        //     if($jobapplied->current_status == 'medical_fit'){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidatepremedical;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='offers';
            $applicationprocess->application_status=$request->datefit;
            $applicationprocess->save();
         //   }
         // }
//---------ApplicationProcess table status change--------------


//-----------------Medical Document pass in Candidate Document----------------------------
         $jobapplied=DB::table('job_applied')
         ->where('candidate_id',$request->candidatepremedical)
         ->where('location',$request->location_id)
         ->where('current_status','medical_fit')->first();

           if(isset($jobapplied->current_status)){
            if($jobapplied->current_status == 'medical_fit'){

              if(!empty($premedical->attached_document1)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatepremedical;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 31;
                $candidatedocument->document_path =  $premedical->attached_document1;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
                if(!empty($premedical->attached_document2)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatepremedical;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 31;
                $candidatedocument->document_path =  $premedical->attached_document2;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                 } 
                if(!empty($premedical->attached_document3)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatepremedical;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 31;
                $candidatedocument->document_path =  $premedical->attached_document3;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
            }
        }
//-----------------Medical Document pass in Candidate Document----------------------------


//  //---------ApplicationProcess table status change Start--------------
//             $updateDetails = [
//             'application_activity' => 'medical',
//             'application_status' => 'medical_fit',
//             'application_process.created_by' => auth()->user()->id,
//             'created_date' => strtotime(Date('Y-m-d'))
//             ];


//         $jobapplied=DB::table('application_process')
//          ->leftJoin('pre_medical', 'application_process.candidate_id', '=', 'pre_medical.candidate_id')
//          ->where('application_process.candidate_id',$request->candidatepremedical)
//          ->where('application_process.location_id',$request->location_id)
//          ->where('pre_medical.fit_date', '!=', 0)
//         ->update($updateDetails);
// //---------ApplicationProcess table status change End--------------




        
             return redirect()->back()->with('success','Pre Medical Created Successfully');

         }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PreMedical  $preMedical
     * @return \Illuminate\Http\Response
     */
    public function show(PreMedical $preMedical)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PreMedical  $preMedical
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $premedical=Premedical::find($id);
        $data['personal'] = DB::table('personal')->get();
        $data['enquiry'] = DB::table('enquiry')->get();
        $data['client'] = DB::table('client')->get();
        $result  = DB::select(DB::raw("select category_id ,category_name from jobs  LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id  "));
        return view('premedical.edit',compact('premedical','result'),$data);
    }



       public function getPreMedical(Request $request)
           {
              $premedical = DB::table("pre_medical")
              ->leftJoin('personal','personal.candidate_id','=','pre_medical.candidate_id')
              ->where("premedical_id",$request->premedical_id)->get();

              //print_r($premedical);
            return response()->json($premedical);

          }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PreMedical  $preMedical
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PreMedical $preMedical,$id)
    {
        $premedical= PreMedical::find($id);

        $premedical->candidate_id =$request->candidate_id;
        $premedical->client_id =$request->client_id;
        $premedical->enquiry_id=$request->enquiry_id;
        $premedical->job_id =$request->job_id;
        $premedical->fit_date =strtotime(date('Y-m-d'));
        $premedical->unfit_date =strtotime(date('Y-m-d'));
        $premedical->created_by=auth()->user()->id;
        $premedical->remark=$request->remark ;
      
    $candidatePath=DB::table('candidate_documents')->where('candidate_id',$request->candidate_id)->select('folder_path')->first();

            if($request->hasfile('attached_document1')){
            $file=$request->file('attached_document1');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
             $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename);
            $premedical->attached_document1=$filename;
             }

            if($request->hasfile('attached_document2')){
            $file=$request->file('attached_document2');
            $extension=$file->getClientOriginalExtension();
            $filename2=uniqid() .'.' .$extension;
             $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename2);
            $premedical->attached_document2=$filename2;
            }

            if($request->hasfile('attached_document3')){
            $file=$request->file('attached_document3');
            $extension=$file->getClientOriginalExtension();
            $filename3=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename3);
            $premedical->attached_document3=$filename3;
            }

               $premedical->save();
               return redirect()->route('premedical.index')->with('success','Pre Medical Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PreMedical  $preMedical
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $premedical=DB::table('pre_medical')->where('premedical_id',$id)->delete();
        return redirect()->route('premedical.index')->with('success','Pre Medical Deleted Successfully');

    }
}
