<?php

namespace App\Http\Controllers;

use App\Models\OfferLetter;
use App\Models\JobApplied;
use Illuminate\Http\Request;
use DB;
use Mail;
use PDF;
use App\Models\CandidateDocument;
use App\Models\ApplicationProcess;

class OfferLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offerletters=OfferLetter::all();
        return view('offerletter.index',['offerletters'=>$offerletters]);
    }


      public function ShowOfferletter()
    {
        return view('offerletter.show');
    }



        public function offerformPrint(){
        //$pdf = PDF::loadView('offerletter.offerformpdf');
       // return $pdf->download('offerletter.pdf');
         return view('offerletter.offerformprint');
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
       return view('offerletter.create',$data,compact('result'));
    }




  public function change(Request $request){

         if($request->status == 'Confirm'){
            $updateDetails = [
            'confirmation_remark' => $request->confirmation_remark,
            'confirmation_date' => strtotime(Date('Y-m-d'))         
            ];
          }               

         if($request->status == 'Reject'){
             $updateDetails = [
            'rejection_remark' => $request->confirmation_remark,
            'rejection_date' => strtotime(Date('Y-m-d'))
            ];
          }

            $offerLetter=DB::table('offer_letter')
            ->where('candidate_id',$request->candidateofferletter)
            ->where('location_id',$request->location_id)
            ->update($updateDetails);


         JobApplied::leftJoin('offer_letter', 'job_applied.candidate_id', '=', 'offer_letter.candidate_id')
         ->where('job_applied.candidate_id',$request->candidateofferletter)
         ->where('job_applied.location',$request->location_id)
          ->where('job_applied.job_id',$request->job_id)
         ->where('confirmation_date', '!=', 0)
         ->update(['current_status' => 'offers']);


//---------------------------------Send Mail-------------------------------------------------
$candidateEmail=DB::table('personal')
->leftJoin('job_applied', 'job_applied.candidate_id', '=', 'personal.candidate_id')
->where('job_applied.location',$request->location_id)
->where('job_applied.candidate_id',$request->candidateofferletter)
->where('current_status', 'offers')
->first();

if(!empty($candidateEmail->email)){
     $email=$candidateEmail->email;
     Mail::send([], [], function ($message) use ($email) {
     $message->to($email)->setBody('<h1>Hi,offers Successfully!</h1>', 'text/html'); // for HTML rich messages
     });
}
//----------------------------------Send Mail------------------------------------------------------



//---------ApplicationProcess table status change--------------
        // $jobapplied=DB::table('job_applied')
        //  ->where('candidate_id',$request->candidateofferletter)
        //  ->where('location',$request->location_id)
        //  ->where('current_status','offers')->first();

         // if(isset($jobapplied->current_status)){
         //    if($jobapplied->current_status == 'offers'){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidateofferletter;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='selection';
            $applicationprocess->application_status=$request->status;
            $applicationprocess->save();
         //   }
         // }
//---------ApplicationProcess table status change--------------


//-----------------Offer Document pass in Candidate Document----------------------------
$offerletter=OfferLetter::where('candidate_id',$request->candidateofferletter)->where('location_id',$request->location_id)->first();

         $jobapplied=DB::table('job_applied')
         ->where('candidate_id',$request->candidateofferletter)
         ->where('location',$request->location_id)
         ->where('current_status','offers')->first();

           if(isset($jobapplied->current_status)){
            if($jobapplied->current_status == 'offers'){

              if(!empty($offerletter->attached_document1)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidateofferletter ;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 30;
                $candidatedocument->document_path =  $offerletter->attached_document1;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
                if(!empty($offerletter->attached_document2)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidateofferletter ;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 30;
                $candidatedocument->document_path =  $offerletter->attached_document2;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                 } 
                if(!empty($offerletter->attached_document3)){
                $candidatedocument= new candidatedocument();
                $candidatedocument->candidate_id =$request->candidateofferletter ;
                $candidatedocument->client_id =$jobapplied->client_id;
                $candidatedocument->job_id =$request->job_id;
                $candidatedocument->location_id =$request->location_id;
                $candidatedocument->document_title = 30;
                $candidatedocument->document_path =  $offerletter->attached_document3;
                $candidatedocument->date_submited=strtotime(Date('Y-m-d'));
                $candidatedocument->save();
                }
            }
        }
   
//---------ApplicationProcess table status change Start--------------
       //      $updateDetails = [
       //      'application_activity' => 'offers',
       //      'application_status' => 'offers',
       //      'application_process.created_by' => auth()->user()->id,
       //      'created_date' => strtotime(Date('Y-m-d'))
       //      ];
       // $jobapplied=DB::table('application_process')
       //  ->leftJoin('offer_letter', 'application_process.candidate_id', '=', 'offer_letter.candidate_id')
       //  ->where('application_process.candidate_id',$request->candidateofferletter)
       //  ->where('application_process.location_id',$request->location_id)
       //  ->where('offer_letter.confirmation_date', '!=', 0)
       //  ->update($updateDetails);
//---------ApplicationProcess table status change End--------------


                 return redirect()->back()->with('success','Status Change Successfully');

    }

 









    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     public function getEnquiryOffer(Request $request)
           {
            $enquirys = DB::table("enquiry")
            ->where("client_id",$request->client_id)
            ->pluck("enquiry_title","enquiry_id");
            return response()->json($enquirys);
          }


        public function getJobOffer(Request $request)
         {
         $jobs = DB::table("jobs")
         ->join('categories', 'jobs.job_main_category_id', '=', 'categories.category_id')
         ->where("enquiry_id",$request->enquiry_id)
         ->pluck("categories.category_name","job_id");
         return response()->json($jobs);
         }




    public function store(Request $request)
    {

      // $todayDate = date('Y-m-d');
      // $request->validate([
      //   'issue_date' => 'date_format:Y-m-d|after_or_equal:'.$todayDate
      //  ]);

     $dataofferletter=OfferLetter::where('offer_letter_id',$request->id_offerletter)->first();
         if(!empty($dataofferletter)){
     $offerletter=OfferLetter::find($dataofferletter->offer_letter_id);

        $offerletter->candidate_id =$request->candidateofferletter ;
        $offerletter->client_id =$request->client_id ;
        $offerletter->enquiry_id=$request->enquiry_id;
        $offerletter->job_id =$request->job_id;
        $offerletter->location_id =$request->location_id;
        $offerletter->issue_date =strtotime($request->issue_date);
        $offerletter->signed_date =strtotime($request->signed_date);
        $offerletter->refuse_date =strtotime($request->refuse_date);
        $offerletter->created_by=auth()->user()->id;
        $offerletter->remark=$request->remark ;
      
    $candidatePath=DB::table('personal')->where('candidate_id',$request->candidateofferletter)->select('directory_path')->first();

            if($request->hasfile('attached_document1')){
            $file=$request->file('attached_document1');
            $extension=$file->getClientOriginalName();
            $filename=$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename);
            $offerletter->attached_document1=$filename;
            }else{
            $offerletter->attached_document1="";
            }

            if($request->hasfile('attached_document2')){
            $file=$request->file('attached_document2');
            $extension=$file->getClientOriginalName();
            $filename2=$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/" , $filename2);
            $offerletter->attached_document2=$filename2;
            }else{
            $offerletter->attached_document2="";
            }

            if($request->hasfile('attached_document3')){
            $file=$request->file('attached_document3');
            $extension=$file->getClientOriginalName();
            $filename3=$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/" , $filename3);
            $offerletter->attached_document3=$filename3;
            }else{
            $offerletter->attached_document3="";
            }

              $offerletter->save();

//---------ApplicationProcess table status change--------------
            if(!empty($request->issue_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidateofferletter;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='selection';
            $applicationprocess->application_status='issue_date' ;
            $applicationprocess->save();
            }
            if(!empty($request->signed_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidateofferletter;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='selection';
            $applicationprocess->application_status='signed_date';
            $applicationprocess->save();
            }
            if(!empty($request->refuse_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidateofferletter;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='selection';
            $applicationprocess->application_status='refuse_date';
            $applicationprocess->save();
            }
//---------ApplicationProcess table status change--------------

    return redirect()->back()->with('success','Offer Letter Updated Successfully');


    }else{

        $offerletter=new Offerletter();
        $offerletter->candidate_id =$request->candidateofferletter ;
        $offerletter->client_id =$request->client_id ;
        $offerletter->enquiry_id=$request->enquiry_id;
        $offerletter->job_id =$request->job_id;
         $offerletter->location_id =$request->location_id;
        $offerletter->issue_date =strtotime($request->issue_date);
        $offerletter->signed_date =strtotime($request->signed_date);
        $offerletter->refuse_date =strtotime($request->refuse_date);
        $offerletter->created_by=auth()->user()->id;
        $offerletter->remark=$request->remark ;
      
    $candidatePath=DB::table('personal')->where('candidate_id',$request->candidateofferletter)->select('directory_path')->first();

            if($request->hasfile('attached_document1')){
            $file=$request->file('attached_document1');
            $extension=$file->getClientOriginalName();
            $filename=$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/", $filename);
            $offerletter->attached_document1=$filename;
            }else{
            $offerletter->attached_document1="";
            }

            if($request->hasfile('attached_document2')){
            $file=$request->file('attached_document2');
            $extension=$file->getClientOriginalName();
            $filename2=$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/" , $filename2);
            $offerletter->attached_document2=$filename2;
            }else{
            $offerletter->attached_document2="";
            }

            if($request->hasfile('attached_document3')){
            $file=$request->file('attached_document3');
            $extension=$file->getClientOriginalName();
            $filename3=$extension;
            $file->move("documents/Candidate/".$candidatePath->directory_path."/" , $filename3);
            $offerletter->attached_document3=$filename3;
            }else{
            $offerletter->attached_document3="";
            }

              $offerletter->save();


//---------ApplicationProcess table status change--------------
            if(!empty($request->issue_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidateofferletter;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='selection';
            $applicationprocess->application_status='issue_date' ;
            $applicationprocess->save();
            }
            if(!empty($request->signed_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidateofferletter;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='selection';
            $applicationprocess->application_status='signed_date';
            $applicationprocess->save();
            }
            if(!empty($request->refuse_date)){
            $applicationprocess= new ApplicationProcess();
            $applicationprocess->candidate_id=$request->candidateofferletter;
            $applicationprocess->client_id=$request->client_id;
            $applicationprocess->enquiry_id=$request->enquiry_id;
            $applicationprocess->job_id=$request->job_id;
            $applicationprocess->location_id=$request->location_id;
            $applicationprocess->created_by=auth()->user()->id;
            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
            $applicationprocess->application_activity='selection';
            $applicationprocess->application_status='refuse_date';
            $applicationprocess->save();
            }
//---------ApplicationProcess table status change--------------
//------------------Send mail-----------------
$candidateEmail=DB::table('personal')
    ->leftJoin('job_applied','job_applied.candidate_id','personal.candidate_id')
    ->where('personal.candidate_id',$request->candidateofferletter)
    ->where('job_applied.location',$request->location_id)->first();

 // $email=$candidateEmail->email;


        $data["email"] = $candidateEmail->email;
        $data["title"] = "Job Offer Letter";
        //$data["body"] = "This is Demo";
  
        $pdf = PDF::loadView('offerletter.sendletter', $data);
        Mail::send('offerletter.sendletter', $data, function($message)use($data, $pdf) {
             $message->to($data["email"])
            ->subject($data["title"])
            ->attachData($pdf->output(), "text.pdf");
        });
  
        // dd('Mail sent successfully');
//------------------Send mail-----------------

        return redirect()->back()->with('success','offerletter Created Successfully');


    }




    }

public function sendOfferletter(Request $request){

 $candidateEmail=DB::table('personal')
    ->leftJoin('job_applied','job_applied.candidate_id','personal.candidate_id')
    ->where('personal.candidate_id',$request->candidate_id)
    ->where('enquiry_id',$request->enquiry_id)
    ->where('client_id',$request->client_id)
    ->where('job_id',$request->job_id)
    ->where('location',$request->location_id)
    ->first();

 // $email=$candidateEmail->email;


        $data["email"] = $candidateEmail->email;
        $data["title"] = "Job Offer Letter";
        //$data["body"] = "This is Demo";
  
        $pdf = PDF::loadView('offerletter.sendletter', $data);
  
        Mail::send('offerletter.sendletter', $data, function($message)use($data, $pdf) {
            $message->to($data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "text.pdf");
        });
  
      return redirect()->back()->with('success','Mail sent successfully');
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OfferLetter  $offerLetter
     * @return \Illuminate\Http\Response
     */
    public function show(OfferLetter $offerLetter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OfferLetter  $offerLetter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offerletter=OfferLetter::find($id);
        $data['personal'] = DB::table('personal')->get();
        $data['enquiry'] = DB::table('enquiry')->get();
        $data['client'] = DB::table('client')->get();
        $result  = DB::select(DB::raw("select category_id ,category_name from jobs  LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id  "));
        return view('offerletter.edit',compact('offerletter','result'),$data);
    }


       public function getOfferLetter(Request $request)
           {
              $offerletter = DB::table("offer_letter")
              ->where("offer_letter_id",$request->offer_letter_id)->get();

              //print_r($offerletter);
            return response()->json($offerletter);

          }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OfferLetter  $offerLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OfferLetter $offerLetter,$id)
    {
        $offerletter= Offerletter::find($id);
        $offerletter->candidate_id =$request->candidate_id ;
        $offerletter->client_id =$request->client_id ;
        $offerletter->enquiry_id=$request->enquiry_id;
        $offerletter->job_id =$request->job_id;
        $offerletter->issue_date =strtotime(date('Y-m-d'));
        $offerletter->signed_date =strtotime(date('Y-m-d'));
        $offerletter->refuse_date =strtotime(date('Y-m-d'));
        $offerletter->created_by=auth()->user()->id;
        $offerletter->remark=$request->remark ;
      
    $candidatePath=DB::table('candidate_documents')->where('candidate_id',$request->candidate_id)->select('folder_path')->first();

            if($request->hasfile('attached_document1')){
            $file=$request->file('attached_document1');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename);
            $offerletter->attached_document1=$filename;
            }

            if($request->hasfile('attached_document2')){
            $file=$request->file('attached_document2');
            $extension=$file->getClientOriginalExtension();
            $filename2=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename2);
            $offerletter->attached_document2=$filename2;
            }
   
            if($request->hasfile('attached_document3')){
            $file=$request->file('attached_document3');
            $extension=$file->getClientOriginalExtension();
            $filename3=uniqid() .'.' .$extension;
            $file->move("documents/Candidate/".$candidatePath->folder_path."/", $filename3);
            $offerletter->attached_document3=$filename3;
            }

         $offerletter->save();
        return redirect()->route('offerletter.index')->with('success','Offer Letter Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OfferLetter  $offerLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $offerletter=DB::table('offer_letter')->where('offer_letter_id',$id)->delete();
               return redirect()->route('offerletter.index')->with('success','Offer Letter Deleted Successfully');

    }
}
