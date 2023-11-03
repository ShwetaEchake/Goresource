<?php

namespace App\Http\Controllers;

use App\Models\Deployment;
use App\Models\JobApplied;
use Illuminate\Http\Request;
use DB;
use File;
use ZipArchive;
use Mail;
use App\Models\ApplicationProcess;
use App\Models\CandidateDocument;

class DeploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

      public function deploymentPrint()
    {
        return view('deployment.deploymentprint');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


      public function download_zip(Request $request)
    {

          $id=$request->id;
          $job_id=$request->job_id;
          $location_id=$request->location_id;
          
        //$folder_name=DB::table('candidate_documents')->where('candidate_id',$id)->first();
        $candidate=DB::table('personal')->where('candidate_id',$id)->first();
        $locationid= '0'.','.$location_id;
        $specific  = DB::select(DB::raw("select * from `candidate_documents` where `candidate_id` = '".$id."' and `location_id` in (".$locationid." )"));


$zip_file = 'documents/Candidate/'.$candidate->directory_path.'.zip';
// Initializing PHP class
$zip = new \ZipArchive();
$zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

foreach($specific as $image){
  $img_file = $candidate->directory_path."/". $image->document_path;
  $zip->addFile(public_path('documents/Candidate/'.$img_file), $img_file);

}
$zip->close();

return response()->download($zip_file);









        // $zip = new ZipArchive;
   
        // //$fileName = $candidate_name->name.'.zip';
        //         if(!empty($folder_name->folder_path)){
        //               $fileName = 'documents/Candidate/'.$folder_name->folder_path.$candidate_name->name.'.zip';

   
        //                     if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        //                     {
        //                         $files = File::files(public_path('documents/Candidate/'.$folder_name->folder_path));
                       
        //                         foreach ($files as $key => $value) {
        //                             $relativeNameInZipFile = basename($value);
        //                             $zip->addFile($value, $relativeNameInZipFile);
        //                         }
                                 
        //                         $zip->close();
        //                     }
    
        //                  return response()->download(public_path($fileName));
        //         }else{
        //             return back()->with('error',"Folder Not Found");


        //         }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

          $datadeployment=Deployment::where('deployment_id',$request->id_deployment)->first();
    

         if(!empty($datadeployment)){


          $deployment=Deployment::find($datadeployment->deployment_id);
          $deployment->candidate_id=$request->candidatedeployment;
          $deployment->client_id=$request->client_id;
          $deployment->enquiry_id=$request->enquiry_id;
          $deployment->job_id=$request->job_id;
          $deployment->location_id=$request->location_id;
          $deployment->created_by=auth()->user()->id;
          $deployment->flight_date=strtotime($request->flight_date);
          $deployment->flight_no=$request->flight_no;
          $deployment->destination=$request->destination;

          $deployment->departure=strtotime($request->departure_date);
          $deployment->departure_time=strtotime($request->departure_time);
          $deployment->arrival=strtotime($request->arrival_date);
          $deployment->arrival_time=strtotime($request->arrival_time);

          $deployment->duration=$request->duration;
          $deployment->pnr_no=$request->pnr_no;
          $deployment->ticket_no=$request->ticket_no;



          $deployment->pcr_test=$request->pcr_test;

        if($request->pcr_test == "positive"){
           $deployment->positive_date =strtotime($request->positive_date);
           $deployment->positive_time =strtotime($request->positive_time);
        }
        if($request->pcr_test == "negative"){
          $deployment->negative_date =strtotime($request->positive_date);
          $deployment->negative_time =strtotime($request->positive_time);
        }

           $candidatePath=DB::table('personal')->where('candidate_id',$request->candidatedeployment)->select('directory_path')->first();

            if($request->hasfile('attached_document1')){

                $file_1=  $deployment->attached_document1;
                $filename_1=public_path("documents/Candidate/".$candidatePath->directory_path."/". $file_1);
                  if(!empty($file_1)){
                       if (File::exists($filename_1)){       
                           unlink($filename_1);
                        }
                   }

                $file=$request->file('attached_document1');
                $extension=$file->getClientOriginalExtension();
                $filename=uniqid() .'.' .$extension;
                $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename);
                $deployment->attached_document1=$filename;
            }

            if($request->hasfile('attached_document2')){

                 $file_2=  $deployment->attached_document2;
                 $filename_2=public_path("documents/Candidate/".$candidatePath->directory_path."/". $file_2);
                  if(!empty($file_2)){
                       if (File::exists($filename_2)){       
                           unlink($filename_2);
                        }
                   }

                $file=$request->file('attached_document2');
                $extension=$file->getClientOriginalExtension();
                $filename2=uniqid() .'.' .$extension;
                $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename2);
                $deployment->attached_document2=$filename2;
            }

            if($request->hasfile('attached_document3')){

                 $file_3=  $deployment->attached_document3;
                 $filename_3=public_path("documents/Candidate/".$candidatePath->directory_path."/". $file_3);
                  if(!empty($file_3)){
                       if (File::exists($filename_3)){       
                           unlink($filename_3);
                        }
                   }

                $file=$request->file('attached_document3');
                $extension=$file->getClientOriginalExtension();
                $filename3=uniqid() .'.' .$extension;
                $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename3);
                $deployment->attached_document3=$filename3;
            }

           $deployment->save();


                JobApplied::leftJoin('deployment_process', 'job_applied.candidate_id', '=', 'deployment_process.candidate_id')
                  ->where('job_applied.candidate_id',$request->candidatedeployment)
                  ->where('job_applied.location',$request->location_id)
                   ->where('job_applied.job_id',$request->job_id)
                  ->where('flight_date', '!=', 0)
                  ->update(['current_status' => 'deployment']);

//---------------------------------Send Mail-------------------------------------------------
$candidateEmail=DB::table('personal')
->leftJoin('job_applied', 'job_applied.candidate_id', '=', 'personal.candidate_id')
->where('job_applied.location',$request->location_id)
->where('job_applied.candidate_id',$request->candidatedeployment)
->where('current_status', 'deployment')
->first();

    if(!empty($candidateEmail->email)){
       $email=$candidateEmail->email;
       Mail::send([], [], function ($message) use ($email) {
       $message->to($email)->setBody('<h1>Hi,Deployment Successfully!</h1>', 'text/html'); // for HTML rich messages
       });
     }
//----------------------------------Send Mail------------------------------------------------------


//---------ApplicationProcess table status change--------------
        // $jobapplied=DB::table('job_applied')
        //  ->where('candidate_id',$request->candidatedeployment)
        //  ->where('location',$request->location_id)
        //  ->where('current_status','deployment')->first();

         // if(isset($jobapplied->current_status)){
         //    if($jobapplied->current_status == 'deployment'){
            if(!empty($request->flight_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidatedeployment;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='visa';
            $applicationprocess->application_status='flight date';
            $applicationprocess->save();
            }
         //   }
         // }
//---------ApplicationProcess table status change--------------

//-----------------Medical Document pass in Candidate Document----------------------------
         $jobapplied=DB::table('job_applied')
         ->where('candidate_id',$request->candidatedeployment)
         ->where('location',$request->location_id)
         ->where('current_status','deployment')->first();

           if(isset($jobapplied->current_status)){
            if($jobapplied->current_status == 'deployment'){

              if(!empty($deployment->attached_document1)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatedeployment;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 34;
                $candidatedocument->document_path =  $deployment->attached_document1;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
                if(!empty($deployment->attached_document2)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatedeployment;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 34;
                $candidatedocument->document_path =  $deployment->attached_document2;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                 } 
                if(!empty($deployment->attached_document3)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatedeployment;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 34;
                $candidatedocument->document_path =  $deployment->attached_document3;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
            }
        }
//-----------------Medical Document pass in Candidate Document----------------------------




           return redirect()->back()->with('sucess','Deployment Updated Successfully');

          }else{

          $deployment= new Deployment();
          $deployment->candidate_id=$request->candidatedeployment;
          $deployment->client_id=$request->client_id;
          $deployment->enquiry_id=$request->enquiry_id;
          $deployment->job_id=$request->job_id;
           $deployment->location_id=$request->location_id;
          $deployment->created_by=auth()->user()->id;
          $deployment->flight_date=strtotime($request->flight_date);
          $deployment->flight_no=$request->flight_no;
          $deployment->destination=$request->destination;
          // $deployment->departure=$request->departure;
          // $deployment->arrival=$request->arrival;

          $deployment->departure=strtotime($request->departure_date);
          $deployment->departure_time=strtotime($request->departure_time);
          $deployment->arrival=strtotime($request->arrival_date);
          $deployment->arrival_time=strtotime($request->arrival_time);

          $deployment->duration=$request->duration;
          $deployment->pnr_no=$request->pnr_no;
          $deployment->ticket_no=$request->ticket_no;

          $deployment->pcr_test=$request->pcr_test;

        if($request->pcr_test == "positive"){
           $deployment->positive_date =strtotime($request->positive_date);
           $deployment->positive_time =strtotime($request->positive_time);
        }
        if($request->pcr_test == "negative"){
          $deployment->negative_date =strtotime($request->positive_date);
          $deployment->negative_time =strtotime($request->positive_time);
        }

          $candidatePath=DB::table('personal')->where('candidate_id',$request->candidatedeployment)->select('directory_path')->first();

            if($request->hasfile('attached_document1')){
            $file=$request->file('attached_document1');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename);
            $deployment->attached_document1=$filename;
            }else{
            $deployment->attached_document1="";
            }

            if($request->hasfile('attached_document2')){
            $file=$request->file('attached_document2');
            $extension=$file->getClientOriginalExtension();
            $filename2=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename2);
            $deployment->attached_document2=$filename2;
            }else{
            $deployment->attached_document2="";
            }

            if($request->hasfile('attached_document3')){
            $file=$request->file('attached_document3');
            $extension=$file->getClientOriginalExtension();
            $filename3=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename3);
            $deployment->attached_document3=$filename3;
            }else{
            $deployment->attached_document3="";
             }

           $deployment->save();

              JobApplied::leftJoin('deployment_process', 'job_applied.candidate_id', '=', 'deployment_process.candidate_id')
                ->where('job_applied.candidate_id',$request->candidatedeployment)
                ->where('job_applied.location',$request->location_id)
                 ->where('job_applied.job_id',$request->job_id)
                ->where('flight_date', '!=', 0)
                ->update(['current_status' => 'deployment']);

//---------------------------------Send Mail-------------------------------------------------
$candidateEmail=DB::table('personal')
->leftJoin('job_applied', 'job_applied.candidate_id', '=', 'personal.candidate_id')
->where('job_applied.location',$request->location_id)
->where('job_applied.candidate_id',$request->candidatedeployment)
->where('current_status', 'deployment')
->first();

     if(!empty($candidateEmail->email)){
        $email=$candidateEmail->email;
        Mail::send([], [], function ($message) use ($email) {
        $message->to($email)->setBody('<h1>Hi,Deployment Successfully!</h1>', 'text/html'); // for HTML rich messages
        });
      }
//----------------------------------Send Mail------------------------------------------------------


//---------ApplicationProcess table status change--------------
            if(!empty($request->flight_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidatedeployment;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='visa';
            $applicationprocess->application_status='flight date';
            $applicationprocess->save();
            }
//---------ApplicationProcess table status change--------------

//-----------------Medical Document pass in Candidate Document----------------------------
         $jobapplied=DB::table('job_applied')
         ->where('candidate_id',$request->candidatedeployment)
         ->where('location',$request->location_id)
         ->where('current_status','deployment')->first();

           if(isset($jobapplied->current_status)){
            if($jobapplied->current_status == 'deployment'){

              if(!empty($deployment->attached_document1)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatedeployment;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 34;
                $candidatedocument->document_path =  $deployment->attached_document1;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
                if(!empty($deployment->attached_document2)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatedeployment;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 34;
                $candidatedocument->document_path =  $deployment->attached_document2;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                 } 
                if(!empty($deployment->attached_document3)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidatedeployment;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 34;
                $candidatedocument->document_path =  $deployment->attached_document3;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
            }
        }
//-----------------Medical Document pass in Candidate Document----------------------------
//---------ApplicationProcess table status change Start--------------
        //     $updateDetails = [
        //     'application_activity' => 'deployment',
        //     'application_status' => 'deployment',
        //     'application_process.created_by' => auth()->user()->id,
        //     'created_date' => strtotime(Date('Y-m-d'))
        //     ];


        // $jobapplied=DB::table('application_process')
        // ->leftJoin('deployment_process', 'application_process.candidate_id', '=', 'deployment_process.candidate_id')
        // ->where('application_process.candidate_id',$request->candidatedeployment)
        // ->where('application_process.location_id',$request->location_id)
        // ->where('deployment_process.flight_date', '!=', 0)
        // ->update($updateDetails);
//---------ApplicationProcess table status change End--------------



           return redirect()->back()->with('sucess','Deployment Created Successfully');
          }



          
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deployment  $deployment
     * @return \Illuminate\Http\Response
     */
    public function show(Deployment $deployment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deployment  $deployment
     * @return \Illuminate\Http\Response
     */
    public function edit(Deployment $deployment)
    {
        //
    }


     public function getDeployment(Request $request)
           {
              $deploymentprocess = DB::table("deployment_process")
              ->leftJoin('personal','personal.candidate_id','=','deployment_process.candidate_id')
              ->where("deployment_id",$request->deployment_id)->get();

            //print_r($deploymentprocess);
            return response()->json($deploymentprocess);

          }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deployment  $deployment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deployment $deployment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deployment  $deployment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deployment $deployment)
    {
        //
    }
}
