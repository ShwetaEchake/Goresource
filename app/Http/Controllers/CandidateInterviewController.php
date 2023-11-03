<?php

namespace App\Http\Controllers;

use App\Models\CandidateInterview;
use Illuminate\Http\Request;
use DB;
use Mail;
class CandidateInterviewController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

             $candidateinterview=CandidateInterview::where('candidate_interview_id',$request->candidate_interview_id)->first();
                if(!empty($candidateinterview)){

                //$candidateinterview=CandidateInterview::find($candidateinterviewData->candidate_id);
                $candidateinterview->client_id =$request->client_id ;
                $candidateinterview->enquiry_id=$request->enquiry_id;
                $candidateinterview->job_id =$request->job_id;
                $candidateinterview->location_id =$request->location_id;
                $candidateinterview->candidate_id =$request->id_candidateenrollment;
                $candidateinterview->interview_date=strtotime($request->interview_date);
                $candidateinterview->start_time =strtotime($request->start_time);
                $candidateinterview->end_time=strtotime($request->end_time);
                $candidateinterview->interview_venu=$request->interview_venu;
                $candidateinterview->interview_city=$request->interview_city;
                $candidateinterview->interview_state=$request->interview_state;
                $candidateinterview->interview_country=$request->interview_country;
                $candidateinterview->interview_zipcode=$request->interview_zipcode;
                $candidateinterview->interviewer_name=$request->interviewer_name;
                $candidateinterview->interviewer_mobileno=$request->interviewer_mobileno;
                $candidateinterview->interviewer_email=$request->interviewer_email;
                $candidateinterview->created_by=auth()->user()->id;
                $candidateinterview->created_date=strtotime(Date('Y-m-d'));
                $candidateinterview->send_date=strtotime(Date('Y-m-d'));
                $candidateinterview->save();
               
               }else{

                $candidateinterview=new CandidateInterview();
                $candidateinterview->client_id =$request->client_id ;
                $candidateinterview->enquiry_id=$request->enquiry_id;
                $candidateinterview->job_id =$request->job_id;
                $candidateinterview->location_id =$request->location_id;
                $candidateinterview->candidate_id =$request->id_candidateenrollment;
                $candidateinterview->interview_date=strtotime($request->interview_date);
                $candidateinterview->start_time =strtotime($request->start_time);
                $candidateinterview->end_time=strtotime($request->end_time);
                $candidateinterview->interview_venu=$request->interview_venu;
                $candidateinterview->interview_city=$request->interview_city;
                $candidateinterview->interview_state=$request->interview_state;
                $candidateinterview->interview_country=$request->interview_country;
                $candidateinterview->interview_zipcode=$request->interview_zipcode;
                $candidateinterview->interviewer_name=$request->interviewer_name;
                $candidateinterview->interviewer_mobileno=$request->interviewer_mobileno;
                $candidateinterview->interviewer_email=$request->interviewer_email;
                $candidateinterview->created_by=auth()->user()->id;
                $candidateinterview->created_date=strtotime(Date('Y-m-d'));
                $candidateinterview->send_date=strtotime(Date('Y-m-d'));
                $candidateinterview->save();
          }




 $candidateDetail=DB::table('personal')
    ->leftJoin('job_applied','job_applied.candidate_id','personal.candidate_id')
    ->leftJoin('interview','job_applied.job_id','interview.job_id')
    ->leftJoin('client','client.client_id','job_applied.client_id')
    ->leftJoin('jobs','jobs.job_id','job_applied.job_id')
    ->leftJoin('categories','categories.category_id','jobs.job_main_category_id')


    ->where('personal.candidate_id',$request->id_candidateenrollment)
    ->where('job_applied.client_id',$request->client_id)
    ->where('job_applied.enquiry_id',$request->enquiry_id)
    ->where('job_applied.job_id',$request->job_id)->first();




        $data["email"] = $candidateDetail->email;
        $data["company_name"] = $candidateDetail->company_name;
        $data["name"] = $candidateDetail->name;
        $data["category_name"] = $candidateDetail->category_name;
        // $data["body"] = "This is Demo";
        $data["interview_date"] = $candidateDetail->interview_date;
        $data["start_time"] = $candidateDetail->start_time;
        $data["end_time"] = $candidateDetail->end_time;

        $data["interview_venu"] = $candidateDetail->interview_venu;
        $data["interview_city"] = $candidateDetail->interview_city;
        $data["interview_state"] = $candidateDetail->interview_state;
        $data["interview_zipcode"] = $candidateDetail->interview_zipcode;
        $data["interviewer_name"] = $candidateDetail->interviewer_name;
        $data["interviewer_mobileno"] = $candidateDetail->interviewer_mobileno;
        $data["interviewer_email"] = $candidateDetail->interviewer_email;
   
  
     
  
        Mail::send('interview.interviewdetail', $data, function($message)use($data) {
            $message->to($data["email"]);
            
        });
  
        // dd('Mail sent successfully');





        return redirect()->back()
                        ->with('success','Candidate Interview Created Successfully');
    }



       public function getCandidateInterview(Request $request)
           {
            $CandidateInterview = DB::table("candidate_interview")
            ->where("candidate_interview_id",$request->candidate_interview_id)->get();

        //print_r($assessment);
            return response()->json($CandidateInterview);

          }





    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CandidateInterview  $candidateInterview
     * @return \Illuminate\Http\Response
     */
    public function show(CandidateInterview $candidateInterview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CandidateInterview  $candidateInterview
     * @return \Illuminate\Http\Response
     */
    public function edit(CandidateInterview $candidateInterview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CandidateInterview  $candidateInterview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CandidateInterview $candidateInterview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CandidateInterview  $candidateInterview
     * @return \Illuminate\Http\Response
     */
    public function destroy(CandidateInterview $candidateInterview)
    {
        //
    }
}
