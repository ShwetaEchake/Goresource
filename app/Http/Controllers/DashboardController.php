<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $events=[];    
         $interviews=DB::table('interview')->get();
        foreach ($interviews as $value) {
               $events[] = [
                    'title' => $value->interview_venu,
                    'start' => date('Y-m-d',$value->interview_date),
                    'url'   => url('/')."/interview/".$value->interview_id."/edit",
                ];
        }

$data = DB::table('job_applied')->select('enquiry_title','job_applied.enquiry_id')    
->leftjoin('enquiry','enquiry.enquiry_id','job_applied.enquiry_id')
->distinct()->take(10)->get();


        $enQIdArray[]="";
        $appliedCount="";
        $shortlistCount="";
        $selectedCount="";
        $confirmCount="";
        $selectionCount="";
        $offersCount="";
        $medicalfitCount="";
        $qvcCount="";
        $visaCount="";
        $deploymentCount="";



$enqData = DB::select(DB::raw("SELECT COUNT(*) AS totalapplicant,job_applied.enquiry_id,enquiry.enquiry_title,current_status FROM `job_applied`
        LEFT JOIN enquiry ON job_applied.enquiry_id=enquiry.enquiry_id
        WHERE 1 GROUP BY job_applied.enquiry_id,job_applied.current_status,enquiry.enquiry_title ORDER BY job_applied.enquiry_id"));


    foreach($enqData as $mKEY => $enqDatas){

             
             $mEnqCountArray[$enqDatas->enquiry_title][$enqDatas->current_status]=$enqDatas->totalapplicant;
        }

        foreach($data as $key => $v){
                    
                    $enQIdArray[$v->enquiry_title]=$v->enquiry_title;
                   
                  
                    if(!empty($mEnqCountArray[$v->enquiry_title]["applied"])){
                         $appliedCount .= $mEnqCountArray[$v->enquiry_title]["applied"].',';
                    }else{
                        $appliedCount .= "0".',';
                    }

                    if(!empty($mEnqCountArray[$v->enquiry_title]["shortlist"])){
                         $shortlistCount .= $mEnqCountArray[$v->enquiry_title]["shortlist"].',';
                    }else{
                        $shortlistCount .= "0".',';
                    }
                
                    if(!empty($mEnqCountArray[$v->enquiry_title]["selected"])){
                         $selectedCount .= $mEnqCountArray[$v->enquiry_title]["selected"].',';
                    }else{
                        $selectedCount .="0".',';
                    }


             

                    if(!empty($mEnqCountArray[$v->enquiry_title]["confirm"])){
                         $confirmCount .= $mEnqCountArray[$v->enquiry_title]["confirm"].',';
                    }else{
                        $confirmCount .="0".',';
                    }

                    if(!empty($mEnqCountArray[$v->enquiry_title]["selection"])){
                         $selectionCount .= $mEnqCountArray[$v->enquiry_title]["selection"].',';
                    }else{
                        $selectionCount .= "0".',';
                    }

                    if(!empty($mEnqCountArray[$v->enquiry_title]["offers"])){
                         $offersCount .= $mEnqCountArray[$v->enquiry_title]["offers"].',';
                    }else{
                        $offersCount .= "0".',';
                    }

                    if(!empty($mEnqCountArray[$v->enquiry_title]["medicalfit"])){
                         $medicalfitCount .= $mEnqCountArray[$v->enquiry_title]["medicalfit"].',';
                    }else{
                        $medicalfitCount .= "0".',';
                    }

                    if(!empty($mEnqCountArray[$v->enquiry_title]["qvc"])){
                         $qvcCount .= $mEnqCountArray[$v->enquiry_title]["qvc"].',';
                    }else{
                        $qvcCount .= "0".',';
                    }

                    if(!empty($mEnqCountArray[$v->enquiry_title]["visa"])){
                         $visaCount .= $mEnqCountArray[$v->enquiry_title]["visa"].',';
                    }else{
                        $visaCount .= "0".',';
                    }

                    if(!empty($mEnqCountArray[$v->enquiry_title]["deployment"])){
                         $deploymentCount .= $mEnqCountArray[$v->enquiry_title]["deployment"].',';
                    }else{
                        $deploymentCount .= "0".',';
                    }



        }
 
      


        return view('dashboard',compact('interviews','events','data','enQIdArray','appliedCount','shortlistCount','selectedCount','confirmCount','selectionCount','offersCount','medicalfitCount','qvcCount','visaCount','deploymentCount'));
    }


     public function systemCalendar()
    {
        $interviews=DB::table('interview')->get();

        foreach ($interviews as $value) {

               $events[] = [
                    'title' => $value->interview_venu,
                    'start' => date('Y-m-d',$value->interview_date),
                    'url'   => "http://45.79.124.136/Goresource/GO/public/interview/".$value->interview_id."/edit",
                ];

                // print_r($events);
                // exit();
        }

         // print_r($value->interview_venu);
         //        exit();

        return view('calendar',compact('interviews','events'));
    }



    // public function InvoiceData()
    // {
     // $myinvoice=DB::table('job_applied')
     // ->leftjoin('categories','categories.category_id','=','job_applied.job_id')
     // ->where('current_status','deployment')
     // ->groupBy('job_id')
     // ->get();

    // $invoices=DB::select(DB::raw("SELECT gross_salary ,category_id ,category_name,count(candidate_id) as candidateQuantity
    //             FROM job_applied
    //             LEFT JOIN jobs ON jobs.job_id = job_applied.job_id
    //             LEFT JOIN categories ON categories.category_id = job_applied.job_id
    //             WHERE current_status='deployment'
    //             group by(job_applied.job_id)"));

    //  return view('invoice',compact('invoices'));
    // }


}
