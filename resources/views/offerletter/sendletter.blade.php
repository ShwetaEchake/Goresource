

<?php

//echo $personalvalue='<p id="txt"></p>';
$template=DB::table('template')->where('title','offerletter')->first();

$data=DB::table('job_applied')
->leftjoin('jobs','jobs.job_id','=','job_applied.job_id')
->leftjoin('enquiry','enquiry.enquiry_id','=','job_applied.enquiry_id')
->leftjoin('personal','personal.candidate_id','=','job_applied.candidate_id')
->leftjoin('passport','passport.candidate_id','=','personal.candidate_id')

// ->where('jobs.enquiry_id',$enquiry_id)
->where('jobs.job_id',3)
->where('personal.candidate_id',1)
->first();

//print_r($data->name);
// echo $template->template;

if(!empty($data)){
   $string = [ "[[Candidate_name]]","[[Candidate_lastname]]" ,"[[Password_no]]","[[Basic_sallary]]",
               "[[Colla_allownces]]","[[Food_allownce]]","[[Accomodation_allownce]]","[[Transportation_allownce]]",
               "[[Contract_period]]","[[Duty_hours]]","[[Medical_status]]"

             ];

   $replace =[ $data->name,$data->last_name,$data->passport_no,$data->basic_salary,
               $data->cola_allownces,$data->food_allownce,
               $data->accomodation_allownce,$data->transportation_allownce,
               $data->contract_period,$data->duty_hours,$data->medical_status,
   ];

   echo str_replace($string, $replace, $template->template);
 }
?>

