<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Client;
use Illuminate\Http\Request;
use DB;
use PDF;
class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Client = Client::where('user_id',auth()->user()->id)->first();
        if(auth()->user()->user_type == "Client"){

           $interviews=Interview::where('client_id',$Client->client_id)->get();

          }else{
             $interviews=Interview::all();
          }
       return view('interview.index',['interviews'=>$interviews]);
    }



      public function viewinterviewPrint(){
        //$pdf = PDF::loadView('interview.viewinterviewpdf');
       // return $pdf->download('InterviewDetail.pdf');
         return view('interview.viewinterviewprint');
        }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $Client = Client::where('user_id',auth()->user()->id)->first();

         if(auth()->user()->user_type == "Client"){
             $data['client'] = DB::table('client')->where('client_id',$Client->client_id)->get();
             $data['enquiry'] = DB::table('enquiry')->get();
             $result  = DB::select(DB::raw("select category_id ,category_name from jobs  LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id  "));
             $data['country'] = DB::table('country')->get();

            return view('interview.create',$data,compact('result'));

         }else{
             $data['client'] = DB::table('client')->get();
             $data['enquiry'] = DB::table('enquiry')->get();
             $result  = DB::select(DB::raw("select category_id ,category_name from jobs  LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id  "));
             $data['country'] = DB::table('country')->get();

           return view('interview.create',$data,compact('result'));
         }

    }


    public function getEnquirydata(Request $request)
           {
            $enquirys = DB::table("enquiry")
            ->where("client_id",$request->client_id)
            ->pluck("enquiry_title","enquiry_id");
              return response()->json($enquirys);
       }


        public function getJobdata(Request $request)
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
       $todayDate = date('Y-m-d');
        $todayTime = date('H:i');

       $request->validate([
      //  'interview_date' => 'date_format:Y-m-d|after_or_equal:'.$todayDate,
        //'start_time' => 'date_format:Y-m-d|after_or_equal:'.$todayTime,
      //  'end_time' => 'date_format:Y-m-d|after_or_equal:start_time'


    ]);
        date_default_timezone_set("Asia/kolkata");
        $interview=new Interview();
        $interview->client_id =$request->client_id ;
        $interview->enquiry_id=$request->enquiry_id;
        $interview->job_id =$request->job_id;
        $interview->interview_date=strtotime($request->interview_date);
        $interview->start_time =strtotime(Date('H:i:s'));
        $interview->end_time=strtotime(Date('H:i:s'));
        $interview->interview_venu=$request->interview_venu;
        $interview->interview_city=$request->interview_city;
        $interview->interview_state=$request->interview_state;
        $interview->interview_country=$request->interview_country;
        $interview->interview_zipcode=$request->interview_zipcode;
        $interview->interviewer_name=$request->interviewer_name;
        $interview->interviewer_mobileno=$request->countrycodes."-".$request->interviewer_mobileno;
        $interview->interviewer_email=$request->interviewer_email;
         $interview->interview_detail=$request->interview_detail;
         $interview->video_call=$request->video_call;
        $interview->created_by=auth()->user()->id;
        $interview->created_date=strtotime(Date('Y-m-d'));
        $interview->save();

        return redirect()->route('interview.index')
                        ->with('success','Interview Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function show(Interview $interview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $interview= Interview::find($id);

         $Client = Client::where('user_id',auth()->user()->id)->first();
         if(auth()->user()->user_type == "Client"){
          $data['client'] = DB::table('client')->where('client_id',$Client->client_id)->get();
          $data['country'] = DB::table('country')->get();

         return view('interview.edit',compact('interview'),$data);
        
         }else{
          $data['client'] = DB::table('client')->get();
          $data['country'] = DB::table('country')->get();

         return view('interview.edit',compact('interview'),$data);

         }





         //$data['enquiry'] = DB::table('enquiry')->get();
        //$result  = DB::select(DB::raw("select job_id, category_id ,category_name from jobs  LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id  "));

    }



       public function getInterview(Request $request)
           {

                    $interviews = DB::table("candidate_interview")
                   ->where("candidate_interview_id",$request->candidate_interview_id)
                   ->first();

                     if(empty($interviews)){
                       $interview = DB::table("interview")
                       ->where("location_id",$request->location_id)->get();

                    }else{

                           $interview = DB::table("candidate_interview")
                           ->where("candidate_interview_id",$request->candidate_interview_id)
                           ->get();
                    }
                    return response()->json($interview);

          }






    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interview $interview)
    {

        $todayDate = date('Y-m-d');
        //$todayTime = date('H:i');

       $request->validate([
        //'interview_date' => 'date_format:Y-m-d|after_or_equal:'.$todayDate,

        //'start_time' => 'date_format:Y-m-d|after_or_equal:'.$todayTime,
        //'end_time' => 'date_format:Y-m-d|after_or_equal:start_time'


    ]);
        $interview =Interview::find($interview->interview_id);
        $interview->client_id =$request->client_id ;
        $interview->enquiry_id=$request->enquiry_id;
        $interview->job_id =$request->job_id;
        $interview->interview_date=strtotime($request->interview_date);
        $interview->start_time =strtotime(Date('H:i:s'));
        $interview->end_time=strtotime(Date('H:i:s'));
        $interview->interview_venu=$request->interview_venu;
        $interview->interview_city=$request->interview_city;
        $interview->interview_state=$request->interview_state;
        $interview->interview_country=$request->interview_country;
        $interview->interview_zipcode=$request->interview_zipcode;
        $interview->interviewer_name=$request->interviewer_name;
        $interview->interviewer_mobileno=$request->countrycodes."-".$request->interviewer_mobileno;
        $interview->interviewer_email=$request->interviewer_email;
         $interview->interview_detail=$request->interview_detail;
         $interview->video_call=$request->video_call;
        $interview->created_by=auth()->user()->id;
        $interview->created_date=strtotime(Date('Y-m-d'));
        $interview->save();

        return redirect()->route('interview.index')
                        ->with('success','Interview Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $interview = DB::table('interview')->where('interview_id',$id)->delete();
         return redirect()->route('interview.index')
                        ->with('success','Interview Deleted Successfully');

    }
}
