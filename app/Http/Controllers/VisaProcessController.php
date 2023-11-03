<?php

namespace App\Http\Controllers;
use App\Models\JobApplied;
use App\Models\VisaProcess;
use Illuminate\Http\Request;
use DB;
use Mail;
use App\Models\ApplicationProcess;
use App\Models\CandidateDocument;
use File;
class VisaProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visaprocesss=VisaProcess::all();
        return view('visaprocess.index',['visaprocesss'=>$visaprocesss]);
    }


      public function visaPrint()
    {
        return view('visaprocess.visaprint');
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
       return view('visaprocess.create',$data,compact('result'));
    }


        public function getEnquiryVisa(Request $request)
           {
            $enquirys = DB::table("enquiry")
            ->where("client_id",$request->client_id)
            ->pluck("enquiry_title","enquiry_id");
            return response()->json($enquirys);
          }


        public function getJobVisa(Request $request)
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


      public function evstatuschange(Request $request){

         if($request->ev_status == 'ISSUE'){
            $updatestatus = [
            'ev_status'=>'ISSUE',
            'ev_remark' => $request->ev_remark,
            'ev_date' => strtotime(Date('Y-m-d'))         
            ];
          }               

         if($request->ev_status == 'Cancel'){
             $updatestatus = [
            'ev_status'=>'Cancel',
            'ev_remark' => $request->ev_remark,
            'ev_date' => strtotime(Date('Y-m-d'))
            ];
          }

            $evStatus=DB::table('visa_process')
            ->where('candidate_id',$request->candidate_idforev)
            ->where('location_id',$request->location_id)
            ->update($updatestatus);


                       return redirect()->back()->with('success',' Ev Status Change Successfully');

      }





    public function store(Request $request)
    {

    //     $todayDate = date('Y-m-d');
    //   $request->validate([
    //     'issue_date' => 'date_format:Y-m-d|after_or_equal:'.$todayDate

    // ]);


     $datavisaprocess=VisaProcess::where('visa_id',$request->id_visa)->first();
         if(!empty($datavisaprocess)){
     $visaprocess=VisaProcess::find($datavisaprocess->visa_id);

        $visaprocess->candidate_id =$request->candidatevisa ;
        $visaprocess->client_id =$request->client_id ;
        $visaprocess->enquiry_id=$request->enquiry_id;
        $visaprocess->job_id =$request->job_id;
        $visaprocess->location_id =$request->location_id;
        $visaprocess->created_by=auth()->user()->id;
        $visaprocess->remark=$request->remark;
        $visaprocess->vissa_profession=$request->vissa_profession ;
        $visaprocess->ev_no =$request->ev_no;
        $visaprocess->sim_no=$request->sim_no;
        $visaprocess->issue_date =strtotime($request->issue_date);
        $visaprocess->expiry_date =strtotime($request->expiry_date);
  
 $candidatePath=DB::table('personal')->where('candidate_id',$request->candidatevisa)->select('directory_path')->first();

            if($request->hasfile('attached_document1')){

                    $file_1=  $visaprocess->attached_document1;
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
                $visaprocess->attached_document1=$filename;
            }

            if($request->hasfile('attached_document2')){
                    $file_2=  $visaprocess->attached_document2;
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
                $visaprocess->attached_document2=$filename2;
            }

            if($request->hasfile('attached_document3')){
                    $file_3=  $visaprocess->attached_document3;
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
                $visaprocess->attached_document3=$filename3;
            }

        $visaprocess->save();


        JobApplied::leftJoin('visa_process', 'job_applied.candidate_id', '=', 'visa_process.candidate_id')
          ->where('job_applied.candidate_id',$request->candidatevisa)
          ->where('job_applied.location',$request->location_id)
           ->where('job_applied.job_id',$request->job_id)
          ->where('issue_date', '!=', 0)
          ->update(['current_status' => 'visa']);

//---------------------------------Send Mail-------------------------------------------------
$candidateEmail=DB::table('personal')
->leftJoin('job_applied', 'job_applied.candidate_id', '=', 'personal.candidate_id')
->where('job_applied.location',$request->location_id)
->where('job_applied.candidate_id',$request->candidatevisa)
->where('current_status', 'visa')
->first();
      if(!empty($candidateEmail->email)){
         $email=$candidateEmail->email;
         Mail::send([], [], function ($message) use ($email) {
         $message->to($email) ->setBody('<h1>Hi,Visa Successfully!</h1>', 'text/html'); // for HTML rich messages
         });
      }
//----------------------------------Send Mail------------------------------------------------------




//---------ApplicationProcess table status change--------------
            if(!empty($request->issue_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidatevisa;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='vc';
            $applicationprocess->application_status='issue_date' ;
            $applicationprocess->save();
            }
            if(!empty($request->expiry_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidatevisa;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='vc';
            $applicationprocess->application_status='expiry_date';
            $applicationprocess->save();
            }
            if(!empty($request->vissa_profession)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidatevisa;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='vc';
            $applicationprocess->application_status='vissa_profession';
            $applicationprocess->save();
            }  
            if(!empty($request->ev_no)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidatevisa;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='vc';
            $applicationprocess->application_status='ev_no';
            $applicationprocess->save();
            }
          
//---------ApplicationProcess table status change--------------


//-----------------Medical Document pass in Candidate Document----------------------------
         $jobapplied=DB::table('job_applied')
         ->where('candidate_id',$request->candidatevisa)
         ->where('location',$request->location_id)
         ->where('current_status','visa')->first();

           if(isset($jobapplied->current_status)){
            if($jobapplied->current_status == 'visa'){

              if(!empty($visaprocess->attached_document1)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatevisa;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 33;
                $candidatedocument->document_path =  $visaprocess->attached_document1;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
                if(!empty($visaprocess->attached_document2)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatevisa;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 33;
                $candidatedocument->document_path =  $visaprocess->attached_document2;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                 } 
                if(!empty($visaprocess->attached_document3)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatevisa;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 33;
                $candidatedocument->document_path =  $visaprocess->attached_document3;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
            }
        }
//-----------------Medical Document pass in Candidate Document----------------------------




        return redirect()->back()->with('success','Visa Updated Successfully');
    }else{

        $visaprocess=new VisaProcess();
        $visaprocess->candidate_id =$request->candidatevisa ;
        $visaprocess->client_id =$request->client_id ;
        $visaprocess->enquiry_id=$request->enquiry_id;
        $visaprocess->job_id =$request->job_id;
        $visaprocess->location_id =$request->location_id;
        $visaprocess->created_by=auth()->user()->id;
        $visaprocess->remark=$request->remark;
        $visaprocess->vissa_profession=$request->vissa_profession ;
        $visaprocess->ev_no =$request->ev_no;
        $visaprocess->sim_no=$request->sim_no;
        $visaprocess->issue_date =strtotime($request->issue_date);
        $visaprocess->expiry_date =strtotime($request->expiry_date);
  
 $candidatePath=DB::table('personal')->where('candidate_id',$request->candidatevisa)->select('directory_path')->first();

            if($request->hasfile('attached_document1')){
            $file=$request->file('attached_document1');
            $extension=$file->getClientOriginalName();
            $filename=$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename);
            $visaprocess->attached_document1=$filename;
            }else{
            $visaprocess->attached_document1="";
            }

            if($request->hasfile('attached_document2')){
            $file=$request->file('attached_document2');
            $extension=$file->getClientOriginalName();
            $filename2=$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename2);
            $visaprocess->attached_document2=$filename2;
            }else{
            $visaprocess->attached_document2="";
            }

            if($request->hasfile('attached_document3')){
            $file=$request->file('attached_document3');
            $extension=$file->getClientOriginalName();
            $filename3=$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename3);
            $visaprocess->attached_document3=$filename3;
            }else{
            $visaprocess->attached_document3="";
             }

        $visaprocess->save();


        JobApplied::leftJoin('visa_process', 'job_applied.candidate_id', '=', 'visa_process.candidate_id')
          ->where('job_applied.candidate_id',$request->candidatevisa)
          ->where('job_applied.location',$request->location_id)
           ->where('job_applied.job_id',$request->job_id)
          ->where('issue_date', '!=', 0)
         ->update(['current_status' => 'visa']);


//---------------------------------Send Mail-------------------------------------------------
$candidateEmail=DB::table('personal')
->leftJoin('job_applied', 'job_applied.candidate_id', '=', 'personal.candidate_id')
->where('job_applied.location',$request->location_id)
->where('job_applied.candidate_id',$request->candidatevisa)
->where('current_status', 'visa')
->first();

 if(!empty($candidateEmail->email)){
     $email=$candidateEmail->email;
     Mail::send([], [], function ($message) use ($email) {
     $message->to($email)
     ->setBody('<h1>Hi,Visa Successfully!</h1>', 'text/html'); // for HTML rich messages
     });
 }
//----------------------------------Send Mail------------------------------------------------------


//---------ApplicationProcess table status change--------------
            if(!empty($request->issue_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidatevisa;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='vc';
            $applicationprocess->application_status='issue_date' ;
            $applicationprocess->save();
            }
            if(!empty($request->expiry_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidatevisa;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='vc';
            $applicationprocess->application_status='expiry_date';
            $applicationprocess->save();
            }
            if(!empty($request->vissa_profession)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidatevisa;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='vc';
            $applicationprocess->application_status='vissa_profession';
            $applicationprocess->save();
            }  
            if(!empty($request->ev_no)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidatevisa;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='vc';
            $applicationprocess->application_status='ev_no';
            $applicationprocess->save();
            }
          
//---------ApplicationProcess table status change--------------
//-----------------Medical Document pass in Candidate Document----------------------------
         $jobapplied=DB::table('job_applied')
         ->where('candidate_id',$request->candidatevisa)
         ->where('location',$request->location_id)
         ->where('current_status','visa')->first();

           if(isset($jobapplied->current_status)){
            if($jobapplied->current_status == 'visa'){

              if(!empty($visaprocess->attached_document1)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatevisa;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 33;
                $candidatedocument->document_path =  $visaprocess->attached_document1;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
                if(!empty($visaprocess->attached_document2)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatevisa;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 33;
                $candidatedocument->document_path =  $visaprocess->attached_document2;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                 } 
                if(!empty($visaprocess->attached_document3)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatevisa;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 33;
                $candidatedocument->document_path =  $visaprocess->attached_document3;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
            }
        }
//-----------------Medical Document pass in Candidate Document----------------------------
//---------ApplicationProcess table status change Start--------------
        //     $updateDetails = [
        //     'application_activity' => 'visa',
        //     'application_status' => 'visa',
        //     'application_process.created_by' => auth()->user()->id,
        //     'created_date' => strtotime(Date('Y-m-d'))
        //     ];


        // $jobapplied=DB::table('application_process')
        //  ->leftJoin('visa_process', 'application_process.candidate_id', '=', 'visa_process.candidate_id')
        //  ->where('application_process.candidate_id',$request->candidatevisa)
        //   ->where('application_process.location_id',$request->location_id)
        //  ->where('visa_process.issue_date', '!=', 0)
        //  ->update($updateDetails);
//---------ApplicationProcess table status change End--------------


        return redirect()->back()->with('success','Visa Process Created Successfully');

    }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisaProcess  $visaProcess
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisaProcess  $visaProcess
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visaprocess=VisaProcess::find($id);
        $data['personal'] = DB::table('personal')->get();
        $data['enquiry'] = DB::table('enquiry')->get();
        $data['client'] = DB::table('client')->get();
        $result  = DB::select(DB::raw("select category_id ,category_name from jobs  LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id  "));
        return view('visaprocess.edit',compact('visaprocess','result'),$data);
    }


      public function getVisa(Request $request)
           {
              $visaprocess = DB::table("visa_process")
              ->leftJoin('personal','personal.candidate_id','=','visa_process.candidate_id')
              ->where("visa_id",$request->visa_id)->get();

            //print_r($visaprocess);
            return response()->json($visaprocess);

          }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisaProcess  $visaProcess
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $visaprocess= VisaProcess::find($id);
        $visaprocess->candidate_id =$request->candidate_id ;
        $visaprocess->client_id =$request->client_id ;
        $visaprocess->enquiry_id=$request->enquiry_id;
        $visaprocess->job_id =$request->job_id;
        $visaprocess->created_by=auth()->user()->id;
        $visaprocess->remark=$request->remark;
        $visaprocess->vissa_profession=$request->vissa_profession ;
        $visaprocess->ev_no =$request->ev_no;
        $visaprocess->sim_no=$request->sim_no;
        $visaprocess->issue_date =strtotime(date('Y-m-d'));
        $visaprocess->expiry_date =strtotime(date('Y-m-d'));
  

 $candidatePath=DB::table('candidate_documents')->where('candidate_id',$request->candidate_id)->select('folder_path')->first();

            if($request->hasfile('attached_document1')){
            $file=$request->file('attached_document1');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename);
            $visaprocess->attached_document1=$filename;
            }

            if($request->hasfile('attached_document2')){
            $file=$request->file('attached_document2');
            $extension=$file->getClientOriginalExtension();
            $filename2=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename2);
            $visaprocess->attached_document2=$filename2;
            }

            if($request->hasfile('attached_document3')){
            $file=$request->file('attached_document3');
            $extension=$file->getClientOriginalExtension();
            $filename3=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename3);
            $visaprocess->attached_document3=$filename3;
            }

        $visaprocess->save();
        return redirect()->route('visaprocess.index')->with('success','Visa Process Updated Successfully');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisaProcess  $visaProcess
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $visaprocess=DB::table('visa_process')->where('visa_id',$id)->delete();
               return redirect()->route('visaprocess.index')->with('success','Visa Process Deleted Successfully');

    }
}
