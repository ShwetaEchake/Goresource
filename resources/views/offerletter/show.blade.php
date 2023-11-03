@extends('layouts.admin')

@section('title')@endsection

@section('css')
<style type="text/css">

 @media print {
  #hide-print{
    display: none;
   }
  }
</style>
@endsection




@section('content')

<?php

//echo $personalvalue='<p id="txt"></p>';
$template=DB::table('template')->where('title','offerletter')->first();

$data=DB::table('job_applied')
->leftjoin('jobs','jobs.job_id','=','job_applied.job_id')
->leftjoin('categories','categories.category_id','=','jobs.job_main_category_id')
->leftjoin('enquiry','enquiry.enquiry_id','=','job_applied.enquiry_id')
->leftjoin('client','client.client_id','=','job_applied.client_id')
->leftjoin('client_location','client_location.client_id','=','client.client_id')
->leftjoin('personal','personal.candidate_id','=','job_applied.candidate_id')
->leftjoin('passport','passport.candidate_id','=','personal.candidate_id')

->where('job_applied.enquiry_id',$_GET['enquiry_id'])
->where('job_applied.job_id',$_GET['job_id'])
->where('job_applied.location',$_GET['location_id'])
->where('personal.candidate_id',$_GET['candidate_id'])
->first();

//print_r($data->name);
// echo $template->template;

if(!empty($data)){
   $string = [ 
   	           "[[Candidate_name]]","[[Candidate_lastname]]" ,"[[Password_no]]","[[Basic_sallary]]",
               "[[Colla_allownces]]","[[Food_allownce]]","[[Accomodation_allownce]]","[[Transportation_allownce]]",
               "[[Contract_period]]","[[Duty_hours]]","[[Medical_status]]","[[Position_title]]","[[Location]]","[[Salary]]",
               "[[ClientFolderPath]]","[[ComapnyLogo]]"
             ];

   $replace =[ 
   	           $data->name,$data->last_name,$data->passport_no,$data->basic_salary,
               $data->cola_allownces,$data->food_allownce,
               $data->accomodation_allownce,$data->transportation_allownce,
               $data->contract_period,$data->duty_hours,$data->medical_status,
               $data->category_name,$data->client_location_code,$data->basic_salary,
               $data->folder_path,$data->client_logo
             ];

   // echo str_replace($string, $replace, $template->template);
 }
?>

<div class="container">  
    <div class="card ">
    	<!-- <form method="POST" action="offerletter/sendOfferletter"  enctype="multipart/form-data"> -->
    		@csrf


<input type="hidden" name="candidate_id" value="{{ $_GET['candidate_id']}}">
<input type="hidden" name="client_id" value="{{ $_GET['client_id']}}">
<input type="hidden" name="enquiry_id" value="{{ $_GET['enquiry_id']}}">
<input type="hidden" name="job_id" value="{{ $_GET['job_id']}}">
<input type="hidden" name="location_id" value="{{ $_GET['location_id']}}">
    		
	        <div class="card-body" id="printMe">
	           <button class="btn btn-sm btn-flat btn-warning" id="hide-print" style="margin-left:90%;"onclick="printReport('printMe')">  <i class="fa fa-print" aria-hidden="true"></i> Print
               </button>
	             <?php echo str_replace($string, $replace, $template->template);?>
	        </div>
            <!-- <button type="submit" class="btn btn-primary" style="margin-left: 90%;margin-bottom: 5%;">Send</button> -->
        <!-- </form> -->
    </div> 
</div>
	@endsection


@section('js')
<script type="text/javascript">
  
    function printReport(divName){
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;

    }
  </script>
@endsection
