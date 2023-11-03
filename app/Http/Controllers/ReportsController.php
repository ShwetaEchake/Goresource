<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use Illuminate\Http\Request;
use DB;


class ReportsController extends Controller
{


     public function getEnquiryReports(Request $request)
           {
            $enquirys = DB::table("enquiry")
            ->where("client_id",$request->client_id)
            ->pluck("enquiry_title","enquiry_id");
            return response()->json($enquirys);
          }


        public function getJobReports(Request $request)
         {
         $jobs = DB::table("jobs")
         ->join('categories', 'jobs.job_main_category_id', '=', 'categories.category_id')
         ->where("enquiry_id",$request->enquiry_id)
         ->pluck("categories.category_name","job_id");
         return response()->json($jobs);
         }


 public function soa(){

 $client=DB::table('client')->get();

if(!empty($_GET['job_id'])){
     $job_id=$_GET['job_id'];
     $data=implode("','",$job_id);

    if($data!=0){
      $comma_separated = "'".$data."'";
    }else{
          $comma_separated = 0;
    }
//print($data);
}else{
    $job_id='';
    $data ='';
    $comma_separated='';
}

    if(!empty($_GET['enquiry_id'])){
         $enquiry_id=$_GET['enquiry_id'];
    }else{
          $enquiry_id='';
    }

if(!empty($comma_separated)){
  $jobs  = DB::select(DB::raw("SELECT categories.category_name,jobs.* ,count(issue_date) as issueDate,SUM(ev_status = 'Cancel') as evstatusCancel ,jobs.job_id from jobs
    LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id
    LEFT JOIN visa_process ON visa_process.job_id = jobs.job_id 
    WHERE jobs.job_id IN(".($comma_separated).") GROUP BY jobs.job_id "));

    $Departuredata  = DB::select(DB::raw("SELECT departure,job_id,count(*) as departureCount from deployment_process 
    WHERE job_id IN(".($comma_separated).")
     group by departure,job_id "));

}else{
    $jobs  = DB::select(DB::raw("SELECT categories.category_name,jobs.* ,count(issue_date) as issueDate,SUM(ev_status = 'Cancel') as evstatusCancel ,jobs.job_id from jobs
    LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id
    LEFT JOIN visa_process ON visa_process.job_id = jobs.job_id 
     WHERE jobs.enquiry_id ='".$enquiry_id."' GROUP BY jobs.job_id  "));

      $Departuredata  = DB::select(DB::raw("SELECT departure,job_id,count(*) as departureCount from deployment_process 
     group by departure,job_id "));

}


$jobArray=[];
$DepartureArray=[];
$DepartureArrays=[];
foreach($jobs as $jdata){
          $jobArray[$jdata->job_id]= $jdata->category_name."@@".$jdata->basic_salary."##".$jdata->cola_allownces."$$".$jdata->food_allownce."%%".$jdata->accomodation_allownce."&&".$jdata->transportation_allownce."**".$jdata->overtime_allownce."++".$jdata->mobile."~~".$jdata->gross_salary."==".$jdata->issueDate."--".$jdata->evstatusCancel."__".$jdata->job_id;
}

  foreach($Departuredata as $Dvalue){
          $DepartureArray[$Dvalue->departure] = $Dvalue->departure;
          $DepartureArrays[$Dvalue->job_id][$Dvalue->departure]= $Dvalue->departureCount;

  }





 	return view('reports.soa',compact('client','jobArray','DepartureArray','DepartureArrays'));
 }



 public function isl(){

$client=DB::table('client')->get();


    if(!empty($_GET['enquiry_id'])){
         $enquiry_id=$_GET['enquiry_id'];
         $job_id=$_GET['job_id'];
         $location_id=$_GET['location_id'];
    }else{
          $enquiry_id='';
          $job_id='';
          $location_id='';
    }


$results  = DB::select(DB::raw("SELECT * FROM job_applied
LEFT JOIN personal ON personal.candidate_id = job_applied.candidate_id
LEFT JOIN passport ON passport.candidate_id = job_applied.candidate_id
LEFT JOIN branch ON branch.branch_id = personal.branch_id
LEFT JOIN jobs ON jobs.job_id = job_applied.job_id
LEFT JOIN categories ON jobs.job_main_category_id =categories.category_id
WHERE job_applied.enquiry_id ='".$enquiry_id."' AND job_applied.job_id ='".$job_id."' AND  job_applied.location ='".$location_id."'
 "));

 	return view('reports.isl',compact('results','client'));
 }
















  public function salary(){
    
$client=DB::table('client')->get();



if(!empty($_GET['enquiry_id'])){
     $enquiry_id=$_GET['enquiry_id'];
     $data=implode("','",$enquiry_id);

    if($data!=0){
      $multipledata = "'".$data."'";
    }else{
          $multipledata = 0;
    }
//print($data);
}else{
    $enquiry_id='';
    $data ='';
    $multipledata='';
}

    if(!empty($_GET['client_id'])){
         $client_id=$_GET['client_id'];

    }else{
          $client_id='';
    }

$clientlocation=DB::select(DB::raw("SELECT * from client_location WHERE client_id='".$client_id."' "));
$DetailArray=[];

if(!empty($multipledata)){
  $salaryDetail  = DB::select(DB::raw("SELECT basic_salary,cola_allownces,food_allownce,transportation_allownce,accomodation_allownce,overtime_allownce,fuel,mobile,gross_salary,company_name,enquiry_title,category_name,location_id,required_position,jobs.job_id FROM client
LEFT JOIN enquiry ON enquiry.client_id = client.client_id
LEFT JOIN jobs ON jobs.enquiry_id = enquiry.enquiry_id
LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id
LEFT JOIN project_location ON project_location.job_id = jobs.job_id
    WHERE enquiry.enquiry_id IN(".($multipledata).") "));

}else{
    $salaryDetail  = DB::select(DB::raw("SELECT basic_salary,cola_allownces,food_allownce,transportation_allownce,accomodation_allownce,overtime_allownce,fuel,mobile,gross_salary,company_name,enquiry_title,category_name,location_id,required_position,jobs.job_id FROM client
LEFT JOIN enquiry ON enquiry.client_id = client.client_id
LEFT JOIN jobs ON jobs.enquiry_id = enquiry.enquiry_id
LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id
LEFT JOIN project_location ON project_location.job_id = jobs.job_id
WHERE client.client_id='".$client_id."'
 "));

}



foreach($salaryDetail as $Detail){
     // $DetailArray[$Detail->enquiry_title][$Detail->category_name][]=$Detail->location_id.'+++'.$Detail->required_position;
      $DetailArray[$Detail->enquiry_title][$Detail->category_name."@@".$Detail->basic_salary."##".$Detail->cola_allownces."$$".$Detail->food_allownce."%%".$Detail->accomodation_allownce."&&".$Detail->transportation_allownce."**".$Detail->overtime_allownce."++".$Detail->fuel."==".$Detail->mobile."~~".$Detail->gross_salary."__".$Detail->job_id][] =[$Detail->location_id]=$Detail->required_position;
}
// echo "<pre>";
// print_r($DetailArray);
// echo "</pre>";
// exit();


/*$branchNames=DB::select(DB::raw("SELECT branch_name, count(*) as branchCount,job_id  FROM `job_applied`
left join branch ON branch.branch_id =  job_applied.branch_id
left join personal ON branch.branch_id =  personal.branch_id
WHERE type='Candidate'  group by branch.branch_id,job_id
order by CHAR_LENGTH(branch_name) ASC, `branch_name` asc
"));
*/

$branchNames=DB::select(DB::raw("SELECT job_id,branch_name,COUNT(*) as branchCount FROM `job_applied` 
left join branch ON branch.branch_id=job_applied.branch_id
WHERE client_id='".$client_id."' GROUP BY job_id,job_applied.branch_id,branch.branch_name order by CHAR_LENGTH(branch_name) ASC, `branch_name` asc"));

$BranchArray=[];
$BranchArrays=[];
foreach($branchNames as $Names){
      $BranchArray[$Names->branch_name]=$Names->branchCount;
      $BranchArrays[$Names->job_id][$Names->branch_name]=$Names->branchCount;

}
 /*echo "<pre>";
 print_r($BranchArrays);
 echo "</pre>";

exit();
*/

    return view('reports.salary',compact('client','clientlocation','DetailArray','BranchArray','BranchArrays'));
 }


}
