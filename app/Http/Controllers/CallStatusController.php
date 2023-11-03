<?php

namespace App\Http\Controllers;
use App\Models\CallStatus;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class CallStatusController extends Controller
{


  public function store(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");

        $datacallstatus=CallStatus::where('call_status_id',$request->id_call_status)->first();
         if(!empty($datacallstatus)){
        $callstatus=CallStatus::find($datacallstatus->call_status_id);
          $callstatus->client_id =$request->client_id ;
          $callstatus->enquiry_id=$request->enquiry_id;
          $callstatus->job_id =$request->job_id;
          $callstatus->candidate_id =$request->candidatecallstatus;
          $callstatus->call_type_id=$request->call_type_id;
          $call_type=DB::table('call_type')->where('call_type_id',$callstatus->call_type_id)->first();
          $callstatus->remark= date('d-m-Y h:i').' :: '.auth()->user()->name.' :: '.$call_type->call_type.' :: '.$request->remark;
          $callstatus->show_remark=$callstatus->remark.' '.$request->show_remark;
          $callstatus->created_by=auth()->user()->id;
          $callstatus->updated_date=strtotime(Date('Y-m-d'));
          $callstatus->save();
        }else{

        $callstatus=new CallStatus();
        $callstatus->client_id =$request->client_id ;
        $callstatus->enquiry_id=$request->enquiry_id;
        $callstatus->job_id =$request->job_id;
        $callstatus->candidate_id =$request->candidatecallstatus;
        $callstatus->call_type_id=$request->call_type_id;
        $call_type=DB::table('call_type')->where('call_type_id',$callstatus->call_type_id)->first();
        $callstatus->remark= date('d-m-Y h:i').' :: '.auth()->user()->name.' :: '.$call_type->call_type.' :: '.$request->remark;
        $callstatus->show_remark=$callstatus->remark;
        $callstatus->created_by=auth()->user()->id;
        $callstatus->created_date=strtotime(Date('Y-m-d'));
        $callstatus->save();
       }


        return redirect()->back()->with('call status update successfully');

    }



        public function getCallStatus(Request $request)
           {
            $call_status = DB::table("call_status")
            ->where("call_status_id",$request->call_status_id)->get();

               //print_r($call_status);
            return response()->json($call_status);

          }



}