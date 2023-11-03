<?php
use App\Models\Country;
use App\Models\Assessment;
?>

@extends('layouts.admin')

@section('title')
Candidates
@endsection

@section('css')

<style type="text/css">
  #chkPassport, #chkCheckAll
  {
    width: 20px;
    height: 20px;
  }
input#age1 {
   transform: scale(2);
}


/********Fixed Header********/
/*table th {
    position:sticky;
    top:0;
    z-index:1;
    border-top:0;
    background: #ededed;
}*/
/********Fixed Header********/



/*
.circle-icon {
    background: #ffc0c0;
    padding:30px;
    border-radius: 50%;
}*/
.icon-background {
    color: #c0ffc0;
}

.circle-icon {
    background: #ffc0c0;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    text-align: center;
    line-height: 50px;
    vertical-align: middle;
    padding: 10px;
}

@media (min-width:768px) {
    .navbar li>a {
        padding-top:5px;
        padding-bottom:5px;
    }
    .navbar-brand {
        padding:20px;
    }
}


.my-fancy-container {
  border: 1px solid #ccc;
  border-radius: 6px;
  display: inline-block;
  margin: 5px;
  padding: 5px;
  text-align: center;
}

.my-text {
  display: block;
  
}

.my-icon {
    vertical-align: middle;
    font-size: 30px;
  margin: 10px; 
color:blue;
}

.arrow-down {
    width: 20; 
    height: 20; 
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid black;
    margin: 10 auto;
    padding:10;

}

</style>
@endsection

<input type="hidden" name="checkid" id="multipleids">

<?php
$mSTRapplieds='';
$mSTRassessment='';
$mSTRpostassessment='';
$mSTRenrollment='';
$mSTRinterview='';
$mSTRselection='';
$mSTRofferletter='';
$mSTRpremedical='';
$mSTRqvc='';
$mSTRvisa='';
$mSTRdeployment='';


 $mSTRTableHead="<table class='table table-hover' >
                       <thead>
                            <tr>
                                <th><input type='checkbox' id='chkCheckAll'/></th>
                                <th width='5%'>Photo</th>
                                <th width='25%'>Personal </th>
                                <th width='25%'>Professinal </th>
                                <th width='20%'>Qualification</th>
                                <th width='5%'>Current Status</th>
                                <th width='20%'>Action</th>

                            </tr>
                       </thead>";

 

$applied_id='';
foreach($results as $candidate){
 $countryname = Country::where(['country_id'=>$candidate->citizenship])->first();

$candidate_id=$candidate->candidate_id;
$job_id=$_GET['job_id'];
$location_id=$candidate->location;
$applied_id=$candidate->applied_id;


if(!empty($countryname->country_name)){
  $countryName = $countryname->country_name;
}else{
  $countryName= '';
}

   $experience_detail= DB::table('personal')
                       ->leftjoin('experience','experience.candidate_id','=','personal.candidate_id')
                       ->where('personal.candidate_id',$candidate_id)
                       ->first();
   $education_data= DB::table('personal')
                   ->leftjoin('education','education.candidate_id','=','personal.candidate_id')
                   ->where('personal.candidate_id',$candidate_id)
                   ->first();

  $candidate_documents=DB::table('candidate_documents')->leftjoin('document_type','document_type_id','=','candidate_documents.document_title')
                     ->where('candidate_id',$candidate_id)
                     ->where('document_type_name','Color Photo')->first(); 

  if(isset($candidate_documents)){ 
    $src = str_replace(' ', '%20', $image='documents/Candidate/' .$candidate->directory_path.'/'.$candidate_documents->document_path);                                               
  }else{
      $src='img/no-user.jpg';                              
  } 




// ----------Job Applied------------
if($candidate->current_status=='applied' ){ 

   $mSTRapplieds.="<tbody >
                               <tr>
                               

                        <td> 
                           <input type='checkbox' id='chkPassport' name='checkArrays' class='checkBoxClasss' value=".$candidate->candidate_id." >
                        </td>

                              <td><img src=".$src." width='100px;' height='100px;'></td> 

                                <td> 
                                    
                                     <p><a href='personal/$candidate_id/' target='_blank' style='color:black;font-weight:600' class='' title='Candidate Detail'>". $candidate->name.' '.$candidate->middle_name.' '.$candidate->last_name."</a></p>
                                      <h6><b>Experience:<b></h6>
                                      <h6><b>Location:<b> ".$experience_detail->location." </h6>
                                      <h6><b>Age:<b> ".$candidate->age." </h6>

                                </td> 
                                <td>
                                    <p><b> ".$experience_detail->company_name." <b></p>
                                    <h6 style='color:#808080'> ".$experience_detail->designation."  </h6>
                                    <h6 style='color:#808080'> ".$experience_detail->from_date.'-'.$experience_detail->to_date." </h6>
                                </td>


                                <td>
                                   <p><b> ".$education_data->school_university_name." <b></p>
                                   <h6 style='color:#808080'>  ".$education_data->course_name." </h6>
                                   <h6 style='color:#808080'>  ".$education_data->completed_year." </h6>
                                </td>

                                <td>". $candidate->current_status."</td>

                                           <td>
                                        <a href='status-update/$candidate_id/$location_id/$applied_id' onclick=\"return confirm('Are you sure, you want to shortlist the candidate?')\" class='btn btn-warning' style='background-color:#FFA500'>Shortlist</a><br><br>

                                         <a href='deleteApplicants/$candidate_id/$location_id/$applied_id' onclick=\"return confirm('Are you sure, you want to Reject the candidate?')\" class='btn btn-danger'>Reject </a><br><br>

                                        <button type='button' class='btn btn-success' onclick='openCallStatus($candidate_id,$candidate->call_status_id)' data-toggle='modal' data-target='#call'> Call</button>
                                  </td>
                              </tr>
                        </tbody>";


// ----------Assessment(Pre)------------
} if($candidate->current_status=='shortlist'){ 


    $mSTRassessment.="<tbody>
                              <tr>
                                   <td> <input type='checkbox' id='chkPassport' name='checkArrays' class='checkBoxClasss' value=".$candidate->candidate_id." ></td>

                                <td><img src=".$src." width='100px;' height='100px;'></td> 

                                <td> 
                                    
                                     <p><a href='personal/$candidate_id/' target='_blank' style='color:black' class='' title='Candidate Detail'>". $candidate->name.' '.$candidate->middle_name.' '.$candidate->last_name."</a></p>
                                      <h6><b>Experience:<b></h6>
                                      <h6><b>Location:<b> ".$experience_detail->location." </h6>
                                      <h6><b>Age:<b> ".$candidate->age." </h6>

                                </td> 
                                <td>
                                    <p><b> ".$experience_detail->company_name." <b></p>
                                    <h6 style='color:#808080'> ".$experience_detail->designation."  </h6>
                                    <h6 style='color:#808080'> ".$experience_detail->from_date.'-'.$experience_detail->to_date." </h6>
                                </td>


                                <td>
                                   <p><b> ".$education_data->school_university_name." <b></p>
                                   <h6 style='color:#808080'>  ".$education_data->course_name." </h6>
                                   <h6 style='color:#808080'>  ".$education_data->completed_year." </h6>
                                </td>
                                  <td>". $candidate->current_status."</td>
                                
                                          <td>
                                        <button  class='btn btn-sm btn-info'>$candidate->assessmentstatus</button><br><br>

                                        <button type='button' onclick='openAssessment($candidate_id,$candidate->assessment_id)' class='btn btn-warning' data-toggle='modal' data-target='.bd-example-modal-lg'>Assess Now</button><br><br>

                                          <button type='button' class='btn btn-success' onclick='openCallStatus($candidate_id,$candidate->call_status_id)' data-toggle='modal' data-target='#call'> Call</button>
                                     
                                  </td>
                              </tr>
                        </tbody>";

}  

// ----------Enrollment------------
if($candidate->current_status=='selected'){ 

  $mSTRenrollment.="<tbody>
                              <tr>
                              <td> <input type='checkbox' id='chkPassport' name='checkArrays' class='checkBoxClasss' value=".$candidate->candidate_id." ></td>
                                <td><img src=".$src." width='100px;' height='100px;'></td> 

                                <td> 
                                    
                                     <p><a href='personal/$candidate_id/' target='_blank' style='color:black' class='' title='Candidate Detail'>". $candidate->name.' '.$candidate->middle_name.' '.$candidate->last_name."</a></p>
                                      <h6><b>Experience:<b></h6>
                                      <h6><b>Location:<b> ".$experience_detail->location." </h6>
                                      <h6><b>Age:<b> ".$candidate->age." </h6>

                                </td> 
                                <td>
                                    <p><b> ".$experience_detail->company_name." <b></p>
                                    <h6 style='color:#808080'> ".$experience_detail->designation."  </h6>
                                    <h6 style='color:#808080'> ".$experience_detail->from_date.'-'.$experience_detail->to_date." </h6>
                                </td>


                                <td>
                                   <p><b> ".$education_data->school_university_name." <b></p>
                                   <h6 style='color:#808080'>  ".$education_data->course_name." </h6>
                                   <h6 style='color:#808080'>  ".$education_data->completed_year." </h6>
                                </td>
                                  <td>". $candidate->current_status."</td>
                                   <td>
                                        <button  class='btn btn-warning' onclick='openEnroll($candidate_id,$location_id,$candidate->candidate_interview_id)' data-toggle='modal' data-target='#showinterview'> Send Interview Detail</button><br><br>
                                     
                                        <a href='update_status/$candidate_id/$location_id/$applied_id' onclick=\"return confirm('Are you sure, you want to confirm the interview?')\" class='btn btn-warning'>Confirm Interview</a><br><br>

                                         <button type='button' class='btn btn-success' onclick='openCallStatus($candidate_id,$candidate->call_status_id)' data-toggle='modal' data-target='#call'> Call</button>
                                  </td>
                              </tr>
                        </tbody>";

} 

//----------Interview(Post Assessment)-------------------
 if($candidate->current_status=='confirm'){ 

  $mSTRinterview.="<tbody>
                              <tr>
                                <td> <input type='checkbox' id='chkPassport' name='checkArrays' class='checkBoxClasss' value=".$candidate->candidate_id." ></td>
                                <td><img src=".$src." width='100px;' height='100px;'></td> 

                                <td> 
                                    
                                     <p><a href='personal/$candidate_id/' target='_blank' style='color:black' class='' title='Candidate Detail'>". $candidate->name.' '.$candidate->middle_name.' '.$candidate->last_name."</a></p>
                                      <h6><b>Experience:<b></h6>
                                      <h6><b>Location:<b> ".$experience_detail->location." </h6>
                                      <h6><b>Age:<b> ".$candidate->age." </h6>

                                </td> 
                                <td>
                                    <p><b> ".$experience_detail->company_name." <b></p>
                                    <h6 style='color:#808080'> ".$experience_detail->designation."  </h6>
                                    <h6 style='color:#808080'> ".$experience_detail->from_date.'-'.$experience_detail->to_date." </h6>
                                </td>


                                <td>
                                   <p><b> ".$education_data->school_university_name." <b></p>
                                   <h6 style='color:#808080'>  ".$education_data->course_name." </h6>
                                   <h6 style='color:#808080'>  ".$education_data->completed_year." </h6>
                                </td>
                                  <td>". $candidate->current_status."</td>
                                   <td>

                                           <button  class='btn btn-sm btn-info'>$candidate->postassessmentstatus</button><br><br>
                                           
                                           <button type='button' onclick='openPostAssessment($candidate_id,$candidate->post_assessment_id)' class='btn btn-warning' data-toggle='modal' data-target='.bdd-example-modal-lg'>Interview Now</button><br><br>

                                           <button  class='btn btn-warning'> Show Interview</button><br><br>

                                            <button type='button' class='btn btn-success' onclick='openCallStatus($candidate_id,$candidate->call_status_id)' data-toggle='modal' data-target='#call'> Call</button>
                                  </td>
                              </tr>
                        </tbody>";
} 

// ----------Selection------------
 if($candidate->current_status=='selection'){ 

  $mSTRselection.="<tbody>
                              <tr>
                                <td> <input type='checkbox' id='chkPassport' name='checkArrays' class='checkBoxClasss' value=".$candidate->candidate_id." ></td>
                                <td><img src=".$src." width='100px;' height='100px;'></td> 

                                <td> 
                                    
                                     <p><a href='personal/$candidate_id/' target='_blank' style='color:black' class='' title='Candidate Detail'>". $candidate->name.' '.$candidate->middle_name.' '.$candidate->last_name."</a></p>
                                      <h6><b>Experience:<b></h6>
                                      <h6><b>Location:<b> ".$experience_detail->location." </h6>
                                      <h6><b>Age:<b> ".$candidate->age." </h6>

                                </td> 
                                <td>
                                    <p><b> ".$experience_detail->company_name." <b></p>
                                    <h6 style='color:#808080'> ".$experience_detail->designation."  </h6>
                                    <h6 style='color:#808080'> ".$experience_detail->from_date.'-'.$experience_detail->to_date." </h6>
                                </td>


                                <td>
                                   <p><b> ".$education_data->school_university_name." <b></p>
                                   <h6 style='color:#808080'>  ".$education_data->course_name." </h6>
                                   <h6 style='color:#808080'>  ".$education_data->completed_year." </h6>
                                </td>
                                  <td>". $candidate->current_status."</td>
                                  <td>
                                        
                                          <a href='CandOfferLetter?candidate_id=".$candidate->candidate_id."&client_id=".$_GET['client_id']."&enquiry_id=".$_GET['enquiry_id']."&job_id=".$_GET['job_id']."&location_id=".$_GET['location_id']."'
                                             class='btn btn-sm btn-flat   btn-primary' title='Offerletter'><i class='fa fa-envelope'></i> Offer
                                          </a><br><br>


                                          <button type='button' onclick='openOffer($candidate_id,$candidate->offer_letter_id)' 
                                           class='btn btn-sm btn-warning' data-toggle='modal' data-target='#offers'>
                                             Offer Letter
                                          </button><br><br>

                                       
                                          
                                           <button onclick='openOffer($candidate_id,$candidate->offer_letter_id)' class='btn btn-sm btn-warning' data-toggle='modal' data-target='#confirmreject'> Confirm/Reject</button><br><br>


                                         <button type='button' class='btn btn-sm btn-success' onclick='openCallStatus($candidate_id,$candidate->call_status_id)' data-toggle='modal' data-target='#call'> Call</button>
                                  </td>
                              </tr>
                        </tbody>";
} 

// ----------Offers------------

                                              // <div class='btn-group' style='margin-left: 4%' >
                                              //         <button type='button' class='btn btn-warning'>Status</button>
                                              //         <button type='button' class='btn btn-warning dropdown-toggle' data-toggle='dropdown'>
                                              //           <span class='caret'></span>
                                              //           <span class='sr-only'>Toggle Dropdown</span>
                                              //         </button>
                                              //         <ui class='dropdown-menu' role='menu' id='export menu'>
                                              //               <button type='submit' style='margin-left: 10px;' class='btn btn-light' name='exportexcel' value='Select'>Select</button>
                                              //               <button type='submit' style='margin-left: 10px;' class='btn btn-light' name='exportcsv' value='Reject'>Reject</button>
                                              //               <button type='submit' style='margin-left: 10px;' class='btn btn-light' name='exportcsv' value='Hold'>On Hold</button>
                                              //        </ui>
                                              // </div>



 if($candidate->current_status=='offers'){ 

  $mSTRofferletter.="<tbody>
                              <tr>
                                 <td> <input type='checkbox' id='chkPassport' name='checkArrays' class='checkBoxClasss' value=".$candidate->candidate_id." ></td>
                                <td><img src=".$src." width='100px;' height='100px;'></td> 

                                <td> 
                                    
                                     <p><a href='personal/$candidate_id/' target='_blank' style='color:black' class='' title='Candidate Detail'>". $candidate->name.' '.$candidate->middle_name.' '.$candidate->last_name."</a></p>
                                      <h6><b>Experience:<b></h6>
                                      <h6><b>Location:<b> ".$experience_detail->location." </h6>
                                      <h6><b>Age:<b> ".$candidate->age." </h6>

                                </td> 
                                <td>
                                    <p><b> ".$experience_detail->company_name." <b></p>
                                    <h6 style='color:#808080'> ".$experience_detail->designation."  </h6>
                                    <h6 style='color:#808080'> ".$experience_detail->from_date.'-'.$experience_detail->to_date." </h6>
                                </td>


                                <td>
                                   <p><b> ".$education_data->school_university_name." <b></p>
                                   <h6 style='color:#808080'>  ".$education_data->course_name." </h6>
                                   <h6 style='color:#808080'>  ".$education_data->completed_year." </h6>
                                </td>
                                  <td>". $candidate->current_status."</td>
                                  <td>

                                          <button type='button' onclick='openPreMedical($candidate_id,$candidate->premedical_id)'  class='btn btn-sm btn-warning' data-toggle='modal' data-target='#medical'>
                                          Upload Pre-Medical record
                                            </button><br><br>


                                          <button type='button' class='btn btn-sm btn-success' onclick='openCallStatus($candidate_id,$candidate->call_status_id)' data-toggle='modal' data-target='#call'> Call</button>
                                  </td>
                              </tr>
                        </tbody>";
} 

// -------Medical---------------

 if($candidate->current_status=='medical_fit'){ 

  $mSTRpremedical.="<tbody>
                              <tr>
                                 <td> <input type='checkbox' id='chkPassport' name='checkArrays' class='checkBoxClasss' value=".$candidate->candidate_id." ></td>
                                <td><img src=".$src." width='100px;' height='100px;'></td> 

                                <td> 
                                    
                                     <p><a href='personal/$candidate_id/' target='_blank' style='color:black' class='' title='Candidate Detail'>". $candidate->name.' '.$candidate->middle_name.' '.$candidate->last_name."</a></p>
                                      <h6><b>Experience:<b></h6>
                                      <h6><b>Location:<b> ".$experience_detail->location." </h6>
                                      <h6><b>Age:<b> ".$candidate->age." </h6>

                                </td> 
                                <td>
                                    <p><b> ".$experience_detail->company_name." <b></p>
                                    <h6 style='color:#808080'> ".$experience_detail->designation."  </h6>
                                    <h6 style='color:#808080'> ".$experience_detail->from_date.'-'.$experience_detail->to_date." </h6>
                                </td>


                                <td>
                                   <p><b> ".$education_data->school_university_name." <b></p>
                                   <h6 style='color:#808080'>  ".$education_data->course_name." </h6>
                                   <h6 style='color:#808080'>  ".$education_data->completed_year." </h6>
                                </td>
                                  <td>". $candidate->current_status."</td>
                                  <td>
                                           

                                             <button type='button' onclick='openQvcProcess($candidate_id,$candidate->qvc_id)' class='btn btn-warning'      data-toggle='modal' data-target='#qvc'>
                                                Create Qvc
                                             </button><br><br>

                                             <button type='button' class='btn btn-success' onclick='openCallStatus($candidate_id,$candidate->call_status_id)' data-toggle='modal' data-target='#call'> Call</button>
                                  </td>
                              </tr>
                        </tbody>";
} 

// -------QVC---------------
 if($candidate->current_status=='qvc'){ 

  $mSTRqvc.="<tbody>
                              <tr>
                                <td> <input type='checkbox' id='chkPassport' name='checkArrays' class='checkBoxClasss' value=".$candidate->candidate_id." ></td>
                                <td><img src=".$src." width='100px;' height='100px;'></td> 

                                <td> 
                                    
                                     <p><a href='personal/$candidate_id/' target='_blank' style='color:black' class='' title='Candidate Detail'>". $candidate->name.' '.$candidate->middle_name.' '.$candidate->last_name."</a></p>
                                      <h6><b>Experience:<b></h6>
                                      <h6><b>Location:<b> ".$experience_detail->location." </h6>
                                      <h6><b>Age:<b> ".$candidate->age." </h6>

                                </td> 
                                <td>
                                    <p><b> ".$experience_detail->company_name." <b></p>
                                    <h6 style='color:#808080'> ".$experience_detail->designation."  </h6>
                                    <h6 style='color:#808080'> ".$experience_detail->from_date.'-'.$experience_detail->to_date." </h6>
                                </td>


                                <td>
                                   <p><b> ".$education_data->school_university_name." <b></p>
                                   <h6 style='color:#808080'>  ".$education_data->course_name." </h6>
                                   <h6 style='color:#808080'>  ".$education_data->completed_year." </h6>
                                </td>
                                  <td>". $candidate->current_status."</td>
                                  <td>
                                        
                                         <button type='button' onclick='openVisa($candidate_id,$candidate->visa_id)' class='btn btn-warning' data-toggle='modal' data-target='#visa'>
                                           Process  Visa
                                         </button><br><br>

                                          <button type='button' class='btn btn-success' onclick='openCallStatus($candidate_id,$candidate->call_status_id)' data-toggle='modal' data-target='#call'> Call</button>
                                  </td>
                              </tr>
                        </tbody>";
} 


// -------Visa---------------
 if($candidate->current_status=='visa'){ 

  $mSTRvisa.=" <tbody>
                              <tr>
                                 <td> <input type='checkbox' id='chkPassport' name='checkArrays' class='checkBoxClasss' value=".$candidate->candidate_id." ></td>
                                <td><img src=".$src." width='100px;' height='100px;'></td> 

                                <td> 
                                    
                                     <p><a href='personal/$candidate_id/' target='_blank' style='color:black' class='' title='Candidate Detail'>". $candidate->name.' '.$candidate->middle_name.' '.$candidate->last_name."</a></p>
                                      <h6><b>Experience:<b></h6>
                                      <h6><b>Location:<b> ".$experience_detail->location." </h6>
                                      <h6><b>Age:<b> ".$candidate->age." </h6>

                                </td> 
                                <td>
                                    <p><b> ".$experience_detail->company_name." <b></p>
                                    <h6 style='color:#808080'> ".$experience_detail->designation."  </h6>
                                    <h6 style='color:#808080'> ".$experience_detail->from_date.'-'.$experience_detail->to_date." </h6>
                                </td>


                                <td>
                                   <p><b> ".$education_data->school_university_name." <b></p>
                                   <h6 style='color:#808080'>  ".$education_data->course_name." </h6>
                                   <h6 style='color:#808080'>  ".$education_data->completed_year." </h6>
                                </td>
                                  <td>". $candidate->current_status."</td>
                                  <td>

                                  <button onclick='openVisa($candidate_id,$candidate->visa_id)'   class='btn btn-warning' data-toggle='modal' data-target='#evStatus'>Ev Status</button><br><br>
                                        
                                   <button   class='btn btn-warning' onclick='openDeployment($candidate_id,$candidate->deployment_id)'  data-toggle='modal' data-target='#deployment'> Upload Ticket</button><br><br>
                
                                   <button type='button' class='btn btn-success' onclick='openCallStatus($candidate_id,$candidate->call_status_id)' data-toggle='modal' data-target='#call'> Call</button>

                                  </td>
                              </tr>
                        </tbody>";
} 

// -------Deployment---------------
 if($candidate->current_status=='deployment'){ 

  $mSTRdeployment.="<tbody>
                              <tr>
                                 <td> <input type='checkbox' id='chkPassport' name='checkArrays' class='checkBoxClasss' value=".$candidate->candidate_id." ></td>
                                <td><img src=".$src." width='100px;' height='100px;'></td> 

                                <td> 
                                    
                                     <p><a href='personal/$candidate_id/' target='_blank' style='color:black' class='' title='Candidate Detail'>". $candidate->name.' '.$candidate->middle_name.' '.$candidate->last_name."</a></p>
                                      <h6><b>Experience:<b></h6>
                                      <h6><b>Location:<b> ".$experience_detail->location." </h6>
                                      <h6><b>Age:<b> ".$candidate->age." </h6>

                                </td> 
                                <td>
                                    <p><b> ".$experience_detail->company_name." <b></p>
                                    <h6 style='color:#808080'> ".$experience_detail->designation."  </h6>
                                    <h6 style='color:#808080'> ".$experience_detail->from_date.'-'.$experience_detail->to_date." </h6>
                                </td>


                                <td>
                                   <p><b> ".$education_data->school_university_name." <b></p>
                                   <h6 style='color:#808080'>  ".$education_data->course_name." </h6>
                                   <h6 style='color:#808080'>  ".$education_data->completed_year." </h6>
                                </td>
                                  <td>". $candidate->current_status."</td>
                                  <td> <a href='download_zip/$candidate_id/$job_id/$location_id' onclick=\"return confirm('Are you sure, you want to download profile?')\" class='btn btn-warning'> Download Profile</a><br>
                                  </td>
                              </tr>
                        </tbody>";
} 


}


?>
@section('content')


<div class="card">


     <div class="card-header">
        <h3 class="card-title "><i class="fa fa-paw mr-1"></i>Candidates</h3>
     </div>



    <!-- /.card-header -->
<div class="card-body table-responsive ">
          <form name="frmcandidate" action="?q=applied" method="GET">
                <div class="row">
                               <div class="col-lg-3">
                                    <label>Company Name</label>
                                    <select class="form-control select2" name="client_id" id="client_id" required>
                                                  <option value="">-Select-</option>
                                                  @foreach ($client as $data)
                                                  <option value="{{ $data->client_id }}">{{ $data->company_name }}</option>
                                                  @endforeach
                                    </select>  
                               </div>

                               <div class="col-lg-3">
                                    <label>Enquiries</label>
                                    <select name="enquiry_id" id="enquiry_id" class="form-control"></select>
                               </div>

                               <div class="col-lg-3">
                                    <label>Job</label>
                                    <select name="job_id" id="job_id" class="form-control"></select>
                               </div>

                                <div class="col-lg-3">
                                    <label>Location</label>
                                    <select name="location_id" id="location" required class="form-control"></select>
                               </div>

                           <!--        <div class="col-lg-2" >
                                     <label>Candidate Name</label>
                                    <input type="text" name="candidate_name" class="form-control">
                                </div>

                                <div class="col-lg-2">
                                     <label>ISL No</label>
                                      <input type="text" name="applied_id" class="form-control">
                                </div>
 -->
                                <input type="hidden" name="q" value="applied">


                               <div class="col-lg-2" style="margin-top: 5px;"><br>
                                 <button type="submit" class="btn btn-primary">Search</button>
                               </div>
                </div>  
                    
            </form>

<br>


<!------------------------ Modal Call Status Start ------------------------------>

<div class="modal fade" id="call" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Call Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

         <div class="modal-body">
                      <form method="POST" action="{{ route('callstatus.store' ) }}">
                        @csrf
      
                     
<?php
$calltypes = DB::table('call_type')->get();
if(!empty($_GET)){
  $client_id=$_GET['client_id'];
  $enquiry_id=$_GET['enquiry_id'];
  $job_id=$_GET['job_id'];
  $location_id=$_GET['location_id'];
}else{
  $client_id="";
  $enquiry_id="";
  $job_id="";
  $location_id="";
}
?>

                       <input type="hidden" name="client_id" value="{{($client_id)}}">
                       <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}">
                       <input type="hidden" name="job_id" value="{{($job_id)}}">
                       <input type="hidden" name="candidatecallstatus" id="candidatecallstatus" >
                       <input type="hidden" value="call_status_id" name="id_call_status" id="call_status_id" >

                            
                       <label> Call Type  </label>
                         <select class="form-control select2" name="call_type_id" id="call_type_id" required>
                         <option value="">-Select-</option>
                         @foreach ($calltypes as $calltype)
                            <option value="{{ $calltype->call_type_id }}">{{ $calltype->call_type }}</option>
                          @endforeach
                        </select>   
                      <br>

                      <label> Remark  </label>
                      <textarea type="text"  rows="3" cols="33" name="remark"  id="remark" class="form-control" value="{{ old('remark') }}" required >
                      </textarea><br>


                        <label> Show Remark  </label>
                      <textarea type="text"  rows="3" cols="33" name="show_remark"  id="show_remark" class="form-control" value="{{ old('remark') }}" readonly >
                      </textarea><br>



                            <!--    <label> Created Date  </label>
                              <input type="date" name="created_date"  id="created_date" class="form-control" value="{{ old('created_date') }}" required>
                              <br> -->

             

                   <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                  </div>


                         </form>
                </div><!-- modal-body end -->
   
    </div>
  </div>
</div>    
<!-------------------------- Modal Call Status Close ----------------------------->     




   
<!--**************************************** EV STATUS Start ************************************************-->   

<div class="modal fade" id="evstatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">EV Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

         <div class="modal-body">
                  <form method="POST" action="visaprocess/evstatuschange">
                           @csrf
                         <input type="hidden" name="candidate_idforev" id="candidate_idforev" >
                         <input type="hidden" name="job_id" value="{{($job_id)}}" >  
                         <input type="hidden" name="client_id" value="{{($client_id)}}" >  
                         <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}" >  
                         <input type="hidden" name="location_id" value="{{($location_id)}}">  
                        <!-- <input type="hidden" name="applied_id" value="{{($applied_id)}}"> -->
                        <p>Please select status:</p>
                         <input style="height:20px; width:20px; vertical-align: middle;" type="radio" id="" name="ev_status" value="ISSUE">
                         <label for="html">ISSUE</label><br>

                         <input style="height:20px; width:20px; vertical-align: middle;" type="radio" id="" name="ev_status" value="Cancel" >
                         <label for="css">Cancel</label><br>

                           <label>Remark</label>
                           <textarea type="text" name="ev_remark" id="" class="form-control"></textarea>

                   <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                  </div>

                 </form>
         </div><!-- modal-body end -->
   
    </div>
  </div>
</div>    
<!--**************************************** EV STATUS Close ************************************************-->   







<!------------------------ Confirm / Reject Start ------------------------------>

<div class="modal fade" id="confirmreject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

         <div class="modal-body">
                    

                  <form method="POST" action="offerletter/change">
                           @csrf

                         <input type="hidden" name="candidateofferletter" id="candidateoffer" >
                         <input type="hidden" name="job_id" value="{{($job_id)}}" >  
                         <input type="hidden" name="client_id" value="{{($client_id)}}" >  
                         <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}" >  
                         <input type="hidden" name="location_id" value="{{($location_id)}}">  
                         <input type="hidden" name="applied_id" value="{{($applied_id)}}">      

                        <p>Please select status:</p>
                         <input style="height:20px; width:20px; vertical-align: middle;" type="radio" id="" name="status" value="Confirm">
                         <label for="html">Confirm</label><br>

                         <input style="height:20px; width:20px; vertical-align: middle;" type="radio" id="" name="status" value="Reject" checked="checked">
                         <label for="css">Reject</label><br>


                           <label>Remark</label>
                           <textarea type="text" name="confirmation_remark" id="" class="form-control"></textarea>
      
                     



                   <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                  </div>


                 </form>
                </div><!-- modal-body end -->
   
    </div>
  </div>
</div>    
<!-------------------------- Confirm / Reject Close ----------------------------->     


 <!----------------------------- Email Start ---------------------------->

  <div class="modal fade" id="mail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><!-- modal-body start-->
        <form method="POST" action="emailtemplate/email" >
              @csrf
                        <input type="hidden" name="candidateidemail" id="candidate_emailid"><br>
                
                       <label for="Title">Title</label>
                         <select class="form-control select2" name="email_title" id="email_title" required>
                             <option value="">-Select-</option>
                             @foreach ($emailtemplates as $data)
                             <option value="{{ $data->email_template_id }}">{{$data->email_title}}</option>
                             @endforeach
                         </select>  
                         <br>      
              
                             <label for="First Name">Email Template</label>
                            <textarea type="text" name="email_template"  id="email_template" class="form-control @error('email_template') is-invalid @enderror" value="{{ old('email_template') }}" required ></textarea>
                            @error('email_template')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
               

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Mail</button>
                </div>
    

      </form>
  </div> <!-- modal-body end-->
</div>
</div>
</div>

 <!----------------------------- Email End ---------------------------->

  <!----------------------------- SMS End ---------------------------->


<div class="modal fade" id="sms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">SMS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><!-- modal-body start-->
        <form method="POST" action="smstemplate/SendSMS" >
              @csrf
                   
                <input type="hidden" name="candidateidsms" id="candidate_smsid"><br>
                         
                            <label for="Title">Title</label>
                            <select class="form-control select2" name="sms_title" id="sms_title" required>
                                    <option value="">-Select-</option>
                                    @foreach ($smstemplates as $data)
                                    <option value="{{ $data->sms_template_id }}">{{$data->sms_title}}</option>
                                    @endforeach
                            </select>
                                     
                             <br>

                           <label for="First Name">Sms Template</label>
                           <textarea type="text" name="sms_template"  id="sms_template" class="form-control @error('sms_template') is-invalid @enderror" value="{{ old('sms_template') }}" required ></textarea>
                            @error('sms_template')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                     
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                 </div>
    

      </form>
   </div> <!-- modal-body end-->
</div>
</div>
</div>

  <!----------------------------- SMS  End ---------------------------->














<?php if(isset($_GET["job_id"])){ ?>

<div align="right">
    <a href='' class='btn btn-flat btn-success' title='Export' id='SelectedRecord'> 
        <i class='fa fa-file-excel-o' style='font-size:20px'></i>
        Export
    </a>

  <button  class='btn btn-flat btn-success' id="CandidateEmail" data-toggle='modal' data-target='#mail'> 
     <i class='fa fa-paper-plane' style='font-size:20px'></i> Send Mail</button>&nbsp;

    <button  class='btn btn-flat btn-success' id="CandidateSms" data-toggle='modal' data-target='#sms'>   <i class='fa fa-sms' style='font-size:20px'></i> Send Sms</button>&nbsp;
    
</div> <br>
<!-- style="overflow:scroll; height:320px;" -->
<div class="row" >
       
   <div class="col-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="Applied" data-toggle="pill" href="#custom-tabs-three-applied" role="tab" aria-controls="Applied" aria-selected="true">Applied</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="Assessments" data-toggle="pill" href="#custom-tabs-three-assessments" role="tab" aria-controls="Assessments" aria-selected="false">Assessments</a>
                  </li>

               <!--      <li class="nav-item">
                    <a class="nav-link" id="PostAssessments" data-toggle="pill" href="#custom-tabs-three-postassessments" role="tab" aria-controls="PostAssessments" aria-selected="false"> Post Assessments</a>
                  </li> -->

                  <li class="nav-item">
                    <a class="nav-link" id="Enrollment" data-toggle="pill" href="#custom-tabs-three-enrollment" role="tab" aria-controls="Enrollment" aria-selected="false">Enrollment</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-interview" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Interview</a>
                  </li>
                 <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-selection" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Selection</a>
                  </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-offerletter" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Offers</a>
                  </li>
               <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-premedical" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Medical</a>
                  </li>
               <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-qvc" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">VC</a>
                  </li>
               <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-visa" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Visa</a>
                  </li>
              <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-deployment" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Deployment</a>
                  </li>
 
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">

    <div class="tab-pane fade show active" id="custom-tabs-three-applied" role="tabpanel" aria-labelledby="Applied">
                          <?php echo $mSTRTableHead.$mSTRapplieds; ?></table>
    </div>
    <div class="tab-pane fade" id="custom-tabs-three-assessments" role="tabpanel" aria-labelledby="Assessments">
                   <?php  echo $mSTRTableHead.$mSTRassessment; ?></table>
    </div>

    <div class="tab-pane fade" id="custom-tabs-three-postassessments" role="tabpanel" aria-labelledby=" Post Assessments">
                   <?php  echo $mSTRTableHead.$mSTRpostassessment;     ?></table>
    </div>

    <div class="tab-pane fade" id="custom-tabs-three-enrollment" role="tabpanel" aria-labelledby="Enrollment">
                    <?php echo $mSTRTableHead.$mSTRenrollment; ?></table>
    </div>
    <div class="tab-pane fade" id="custom-tabs-three-interview" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                  <?php echo $mSTRTableHead.$mSTRinterview; ?></table>  
    </div>
    <div class="tab-pane fade" id="custom-tabs-three-selection" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                   <?php echo $mSTRTableHead.$mSTRselection; ?></table>    
                  </div>
    <div class="tab-pane fade" id="custom-tabs-three-offerletter" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                  <?php echo $mSTRTableHead.$mSTRofferletter; ?></table>    
    </div>
    <div class="tab-pane fade" id="custom-tabs-three-premedical" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                    <?php echo $mSTRTableHead.$mSTRpremedical; ?></table>      
    </div>
    <div class="tab-pane fade" id="custom-tabs-three-qvc" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                    <?php echo $mSTRTableHead.$mSTRqvc; ?></table>       
    </div>
    <div class="tab-pane fade" id="custom-tabs-three-visa" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                  <?php echo $mSTRTableHead.$mSTRvisa; ?></table>       
    </div>
    <div class="tab-pane fade" id="custom-tabs-three-deployment" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                 <?php echo $mSTRTableHead.$mSTRdeployment; ?></table>       
    </div>
   
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
<?php } ?>
    </div>
    <!-- /.card-body -->
  </div>








<!------------------------ Modal Deployment Start ------------------------------>

<div class="modal fade" id="deployment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Deployment </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

         <div class="modal-body">
                      <form method="POST" action="{{route('deployment.store')}}" enctype="multipart/form-data">
                        @csrf
    

                       <input type="hidden" name="client_id" value="{{($client_id)}}">
                       <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}">
                       <input type="hidden" name="job_id" value="{{($job_id)}}">
                        <input type="hidden" name="location_id" value="{{($location_id)}}">
                       <input type="hidden" name="candidatedeployment" id="candidatedeployment" >
                       <input type="hidden" value="deployment_id" name="id_deployment" id="deployment_id" >
                        <input type="hidden" name="applied_id" value="{{($applied_id)}}">

                 
 <div class="row">

               <div class="col-lg-4">
                    <label>Ticket No</label>
                    <input type="text"  name="ticket_no"  id="ticket_no" class="form-control @error('ticket_no') is-invalid @enderror" value="{{ old('ticket_no')  }}" required>
                    @error('ticket_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror    
                 </div> 


                 <div class="col-lg-4">
                    <label> PNR No</label>
                    <input type="text"  name="pnr_no"  id="pnr_no" class="form-control @error('pnr_no') is-invalid @enderror" value="{{ old('pnr_no')  }}" required >
                    @error('pnr_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>
                          
        
                 <div class="col-lg-4">
                    <label>Flight No</label>
                    <input type="text"  name="flight_no"  id="flight_no" class="form-control @error('flight_no') is-invalid @enderror" value="{{ old('flight_no')  }}" required>
                    @error('flight_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div> 
   </div><br>



     <div class="row">

            


                <div class="col-lg-6">
                <label> Departure Date</label>
                <input type="date"  name="departure_date"  id="departure_date" class="form-control @error('departure_date') is-invalid @enderror" value="{{ old('departure_date')  }}" required >
                @error('departure_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="col-lg-6">
                <label> Departure Time</label>
                <input type="time"  name="departure_time"  id="departure" class="form-control @error('departure') is-invalid @enderror" value="{{ old('departure')  }}" required >
                @error('departure')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

   </div><br>


<div class="row">
            
             

                <div class="col-lg-6">
                <label> Arrival Date</label>
                <input type="date"  name="arrival_date"  id="arrival_date" class="form-control @error('arrival_date') is-invalid @enderror" value="{{ old('arrival_date')  }}" required >
                @error('arrival_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>    

                   <div class="col-lg-6">
                <label> Arrival Time</label>
                <input type="time"  name="arrival_time"  id="arrival" class="form-control @error('arrival') is-invalid @enderror" value="{{ old('arrival')  }}" required >
                @error('arrival')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>    

 </div><br>



<div class="row">


                <div class="col-lg-4">
                <label>Flight Date</label>
                <input type="date"  name="flight_date"  id="flight_date" class="form-control @error('flight_date') is-invalid @enderror" value="{{ old('flight_date')  }}" >
                @error('flight_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>
           
                <div class="col-lg-4">
                <label> Duration</label>
                <input type="text"  name="duration"  id="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration')  }}" required >
                @error('duration')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label>Destination / Sector</label>
                <input type="text"  name="destination"  id="destination" class="form-control @error('destination') is-invalid @enderror" value="{{ old('destination')  }}" required>
                @error('destination')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

           
</div><br>


    <div class="row">

                         <div class="col-lg-4">  
                           <label> PCR Test </label>
                           <select class="form-control" name="pcr_test" id="pcr_test">
                                <option value="">-Select-</option>
                                <option value="positive">Positive</option>
                                <option value="negative">Negative </option>
                           </select>
                      </div>



                      <div class="col-lg-4">
                               <label> Date </label>
                                <input type="date" name="positive_date"  id="positive_date" class="form-control @error('positive_date') is-invalid @enderror" value="{{ old('positive_date')  }}"  >
                                @error('positive_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               <br>
                      </div>



                      <div class="col-lg-4">
                               <label> Time </label>
                                <input type="time" name="positive_time"  id="positive_time" class="form-control @error('positive_time') is-invalid @enderror" value="{{ old('positive_time')  }}"  >
                                @error('positive_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               <br>
                      </div>
        
    </div>

            

<div class="row">
                <div class="col-lg-4">
                <label> (PCR Test) </label>
                <input type="file" name="attached_document1"  id="  attached_document1" class=" @error('  attached_document1') is-invalid @enderror" value="{{ old('attached_document1')  }}"  onchange="URLdeployment1(this);">
                @error('attached_document1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
              

                 <div class="col-lg-4">
                <label> (Flight Ticket) </label>
                <input type="file" name="attached_document2"  id="attached_document2" class=" @error('  attached_document2') is-invalid @enderror" value="{{ old('attached_document2')  }}"  onchange="URLdeployment2(this);">
                @error('attached_document2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                   <div class="col-lg-4">
                <label> (QR Code)</label>
                <input type="file" name="attached_document3"  id="attached_document3" class=" @error('  attached_document3') is-invalid @enderror" value="{{ old('attached_document3')  }}" onchange="URLdeployment3(this);" >
                @error('attached_document3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

</div><br>

  <div class="row">
              <div class="col-lg-4">
                <embed id="attached_document1_depmnt" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100"></embed>
              </div>
             <div class="col-lg-4">
                <embed id="attached_document2_depmnt" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100"></embed>
             </div>
              <div class="col-lg-4">
                  <embed id="attached_document3_depmnt" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100"></embed>
              </div>
    </div>



             

                   <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                  </div>


                 </form>
                </div><!-- modal-body end -->
   
    </div>
  </div>
</div>    
<!-------------------------- Deployment Close ----------------------------->     








<!-------------------------- Modal INTERVIEW FORM -------------------------------------->

<div class="modal fade" id="showinterview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Send Interview Detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

         <div class="modal-body">
                      <form method="POST" action="{{ route('candidateinterview.store' ) }}">
                        @csrf

                                <input type="hidden" name="client_id" value="{{($client_id)}}">
                                <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}">
                                <input type="hidden" name="job_id" value="{{($job_id)}}">
                                <input type="hidden" name="location_id" value="{{($location_id)}}">
                                <input type="hidden" name="id_candidateenrollment" id="candidateenrollment" >
                                <input type="hidden" value="{{$applied_id}}" name="applied_id" id="applied_id" >
                                <input type="hidden" name="candidate_interview_id" id="candidate_interview_id" >
                             

        <div class="row">
                <div class="col-lg-4">
                <label> Date </label>
                <input type="date" name="interview_date"  id="interview_date" class="form-control @error('interview_date') is-invalid @enderror" value="{{ old('interview_date')  }}" required >
                @error('interview_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label>  Start Time  </label>
                <input type="time" name="start_time"  id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time')  }}"  required >
                @error('start_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br>
                </div>

                <div class="col-lg-4">
                <label> End Time</label>
                <input type="time"  name="end_time"  id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time') }}" required >
                @error('end_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
     </div> 


     <div class="row">
                <div class="col-lg-12">
                <label>  Venue </label>
                <input type="text" name="interview_venu"  id="interview_venu" class="form-control @error('interview_venu') is-invalid @enderror" value="{{ old('interview_venu')  }}"  required >
                @error('interview_venu')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
     </div><br>

     <div class="row">

                <div class="col-lg-3">
                <label>City </label>
                <input type="text"  name="interview_city"  id="interview_city" class="form-control @error('interview_city') is-invalid @enderror" value="{{ old('interview_city') }}" required >
                @error('interview_city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-3">
                <label>  State</label>
                <input type="text"  name="interview_state"  id="interview_state" class="form-control @error('interview_state') is-invalid @enderror" value="{{ old('interview_state')  }}" required >
                @error('interview_state')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
    
                 <div class="col-lg-3">
                <label> Country</label>
                <input type="text"  name="interview_country"  id="interview_country"   class="form-control @error('interview_country') is-invalid @enderror" value="{{ old('interview_country')  }}" required >
                @error('interview_country')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-3">
                <label> Zipcode </label>
                <input type="text"  name="interview_zipcode"  id="interview_zipcode"  class="form-control @error('interview_zipcode') is-invalid @enderror" value="{{ old(' interview_zipcode') }}" required >
                @error('interview_zipcode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

       </div><br>


     <div class="row">

               <div class="col-lg-4">
                <label> Name </label>
                <input type="text"  name="interviewer_name"  id="interviewer_name"  class="form-control @error('interviewer_name') is-invalid @enderror" value="{{ old('interviewer_name')  }}" required >
                @error('interviewer_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

                <div class="col-lg-4">
                <label>  Mobileno </label>
                <input type="number"  name="interviewer_mobileno"  id="interviewer_mobileno" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;"   class="form-control @error('interviewer_mobileno') is-invalid @enderror" value="{{ old('interviewer_mobileno')  }}" required >
                @error('interviewer_mobileno')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>    

                <div class="col-lg-4">
                <label>  Email </label>
                <input type="email"  name="interviewer_email"  id="interviewer_email"   class="form-control @error('interviewer_email') is-invalid @enderror" value="{{ old('interviewer_email')  }}" required >
                @error('interviewer_email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>    
    </div><br>

             

                   <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save Changes</button>
                  </div>


                </form>
                </div><!-- modal-body end -->
   
    </div>
  </div>
</div>    

<!--------------------------------- Modal INTERVIEW FORM  End----------------------------------->



<!-----------------------------  Assessment Modal Start-------------------------------->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myLargeModalLabel1">Pre Assessment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


<?php

?>

    <div class="modal-body">

            <form class="form-horizontal" method="POST" action="{{ route('assessment.store') }}">
                    @csrf
            
          
         
                               <input type="hidden" name="client_id" value="{{($client_id)}}">
                               <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}">
                               <input type="hidden" name="job_id" value="{{($job_id)}}">
                               <input type="hidden" name="location_id" value="{{($location_id)}}">
                               <input type="hidden" name="candidateidassessment" id="candidateidassessment" >
                               <input type="hidden" value="Pre" name="assessment_type" id="assessment_type" >
                               <input type="hidden" value="assessment_id" name="id_assessment" id="assessment_id" >
                               <input type="hidden" value="{{$applied_id}}" name="applied_id" id="applied_id" >

<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%" >

<thead>
    <tr>
          <th width="30%">Rating</th>
          <th width="7%">1</th>
          <th width="7%">2</th>
          <th width="7%">3</th>
          <th width="7%">4</th>
          <th width="7%">5</th>
          <th width="40">Remarks</th>
    </tr>
</thead>


     <tbody>
   <tr>
      <td>Personality Apperance/Attitude:</td>
      <td><!-- INEFFECTIVE -->
        <input type="radio"   name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror"  
        value="INEFFECTIVE">

     </td>

      <td> <!-- NEEDSIMPROVMENT  -->
        <input type="radio"   name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" value="NEEDSIMPROVMENT">
         </td>

      <td> <!--  GOOD -->
        <input type="radio"   name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror"  value="GOOD">    
     </td>


      <td> <!--  VERYGOOD -->
        <input type="radio"   name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" value="VERYGOOD">   
      </td>

      <td><!-- EXCELLENT -->
        <input type="radio"  name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" value="EXCELLENT">    
         </td>
      <td>
        <input type="text"  name="personality_remark"  id="personality_remark"   class="form-control @error('personality_remark') is-invalid @enderror" value="" >
     </td>
   </tr>

 <tr>
    <td>Knowladge & Technical Skills:</td>
    <td>
        <input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" 
        value="INEFFECTIVE"  >
    </td>
    <td>
        <input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" 
        value="NEEDSIMPROVMENT"   >
    </td>
    <td>
    <input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" 
    value="GOOD" >
   </td>
    <td>
        <input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" value="VERYGOOD"   >
    </td>
    <td>
        <input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror"
        value="EXCELLENT" >
    </td>
    <td>
        <input type="text"  name="knowledge_remark"  id="knowledge_remark" class="form-control @error('knowledge_remark') is-invalid @enderror" value="" >
    </td>
 </tr>
    
  <tr>
     <td>Initiative & Leadership:</td>
    <td><input type="radio"  name="ledership"  id="ledership"  class="form-control @error('Ledership') is-invalid @enderror"   
        value="INEFFECTIVE" >
    </td>
    <td>
        <input type="radio"  name="ledership"  id="ledership"  class="form-control @error('Ledership') is-invalid @enderror" 
        value="NEEDSIMPROVMENT" >
    </td>
    <td>
     <input type="radio"  name="ledership"  id="ledership"  class="form-control @error('Ledership') is-invalid @enderror" 
     value="GOOD"  >
   </td>
    <td>
    <input type="radio"  name="ledership"  id="ledership"  class="form-control @error('Ledership') is-invalid @enderror" 
    value="VERYGOOD" >
    </td>
    <td>
        <input type="radio"  name="ledership"  id="ledership"  class="form-control @error('Ledership') is-invalid @enderror"  
        value="EXCELLENT"   >
    </td>
    <td>
        <input type="text"  name="leadership_remark"  id="leadership_remark" class="form-control @error('leadership_remark') is-invalid @enderror" value="" >
    </td>
  </tr>
    
 <tr>
    <td>English Communication</td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror"   value="INEFFECTIVE" >
    </td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror"   value="NEEDSIMPROVMENT"  >
    </td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror"   value="GOOD" >
    </td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror"   value="VERYGOOD"  >
    </td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror"    value="EXCELLENT"   >
    </td>
    <td><input type="text"  name="communication_remark"  id="communication_remark" class="form-control @error('communication_remark') is-invalid @enderror" value="" ></td>
</tr>

  <tr>
    <td>Others (Please Spacify)</td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="INEFFECTIVE"  >
    </td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment" class="form-control @error('other_assessment') is-invalid @enderror" value="NEEDSIMPROVMENT"   >
    </td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror"value="GOOD" >
    </td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="VERYGOOD" >
    </td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="EXCELLENT"   >
    </td>
    <td><input type="text"  name="other_assessment_remark" id="other_assessment_remark"   class="form-control @error('other_assessment_remark') is-invalid @enderror" value="" ></td>
 </tr>

</tbody>
</table>




<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">
<thead><tr><th colspan="7">Education</th></tr></thead>
<tbody>
<tr><td>DEGREE OBTAINED</td> <td colspan="6">
   <!--  <input type="text"  name="degree_optain"  id="degree_optain"   class="form-control @error('degree_optain') is-invalid @enderror" 
    value="" > -->

      <select class="form-control valdation_select" name="degree_optain" id="degree_optain" >
                    <option value=''> -Grade- </option>  
                    <option value='Grade6' > Grade 6</option>  
                    <option value='Grade10'> Grade 10 </option>   
                    <option value='Pluse2'> Pluse 2 </option>   
            
      </select>     


</td></tr>
 <tr><td>PROFESSTIONAL LICENSE NO.</td><td colspan="6">
    <input type="text"  name="professional_licence_no"  id="professional_licence_no"  class="form-control @error('professional_licence_no') is-invalid @enderror" value="" >
</td></tr>
  <tr><td>TECHNICAL QUALIFICATION</td><td colspan="6">
   <!--  <input type="text"  name="technical_qualification"  id="technical_qualification"  class="form-control @error('technical_qualification') is-invalid @enderror" value="" > -->

       <select class="form-control valdation_select" name="technical_qualification" id="technical_qualification" >
                    <option value=''> -Education- </option>  
                    <option value='Degree' > Degree </option>  
                    <option value='Diploma'> Diploma  </option>   
                    <option value='ITI'> ITI </option>  
                    <option value='IIT'> IIT </option>   
                    <option value='Btech'> Btech </option>   
                    <option value='Vocational'> Vocational </option>   
            
      </select>   


</td></tr>
  <tr><td>KEY SKILLS</td><td colspan="6">
    <input type="text"  name="key_skill"  id="key_skill"  class="form-control @error('key_skill') is-invalid @enderror" value="" ></td></tr>
  <tr><td>TRADE TEST</td><td colspan="6">
    <input type="text"  name="trade_test"  id="trade_test"  class="form-control @error('trade_test') is-invalid @enderror" value=""  >
</td></tr>
</tbody>
</table>



<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">
<thead><tr>
  <th>Language used</th> 
  <th>English</th>
  <th>Hindi</th>
 {{--  <th>  
     <select class="form-control select2" name="language" id="language" >
            <option value="">-Select-</option>
            @foreach($language as $data)
            <option value="{{ $data->language_name }}">{{ $data->language_name }}
            </option>
            @endforeach
     </select>  
  </th> --}}
  <th  colspan="7">Others</th></tr></thead>
<tbody>
<tr><td>RATINFG</td> <td><select class="form-control valdation_select" name="languge_used" id="languge_used"  >
    <option value=''> -Select- </option>  
     <option value='Good' > Good </option>   
     <option value='Bad' > Bad </option>   
     <option value='Verygood' > Very good </option>   
     <option value='Excellent'  > Excellent </option>   
                        
</select></td>
                    <td>
          <select class="form-control valdation_select" name="languge_used1" id="languge_used1" >
                       <option value=''> -Select- </option>   
                       <option value='Good' > Good </option>   
                       <option value='Bad' > Bad </option>   
                       <option value='Verygood' > Very good </option>   
                       <option value='Excellent'  > Excellent </option>   
         </select>
        </td><td colspan="4"><input type="text"  name="languge_used2"  id="languge_used2"  class="form-control @error('languge_used') is-invalid @enderror" value="" ></td></tr>
</tbody>
</table>




<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">
<thead><tr><th colspan="7">Work Experience</th> </tr>
<tr><th></th> <th colspan="3">POSITION HELD</th><th colspan="3">TOTAL YEARS/MONTHS</th></tr></thead>
<tbody>
<tr><td>LOCAL</td> <td colspan="3">
    <input type="text"  name="local_work_experience"  id="local_work_experience"  class="form-control @error('local_work_experience') is-invalid @enderror" value="" >
</td>
  <td colspan="3">
    <input type="text"  name="local_experience_year"  id="local_experience_year"  class="form-control @error('local_experience_year') is-invalid @enderror" value="" >
</td></tr>

<tr><td>OVERSEAS</td> 
  <td colspan="3">
    <input type="text"  name="overseas_expereicne"  id="overseas_expereicne"  class="form-control @error('overseas_expereicne') is-invalid @enderror" value="" >
</td>
  <td colspan="3">
    <input type="text"  name="overseaase_year"  id="overseaase_year"  class="form-control @error('overseaase_year') is-invalid @enderror" value="" >
</td></tr>
</tbody>
</table>



<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">
<thead><tr><th colspan="7">
Overall Assessment</th></tr></thead>
<tbody>
<tr> <td><center><label for="age1">Selected</label><br><input type="radio" id="age1" name="overall_assessment"
 value="selected"  >
  <td><center><label for="age1">Reserved</label><br><input type="radio" id="age1" name="overall_assessment" 
    value="reserved"  ></center>
  </td>
  <td> <center><label for="age1">Rejected</label><br><input type="radio" id="age1" name="overall_assessment"
   value="rejected"  ></center>
 </td>
  <td><center> <label for="age1">Others</label><br><input type="radio" id="age1" name="overall_assessment" 
    value="others"  ></center>
 </td>
  <td><center> <label for="age1">Standby</label><br><input type="radio" id="age1" name="overall_assessment" 
    value="standby"  ></center>
 </td>
  <td colspan="3">
     <label for="age1">Overall Rating%</label><br><input type="text" id="overall_rating" name="overall_rating" class="form-control" value="" >
 </td></tr>
</tbody>
</table>



<table id="dynamicAddRemove" class="" width="100%">
<thead>
  <tr><th>Remarks</th></tr>
</thead>
<tbody>
  <tr><td><textarea type="text"  name="remark"  id="remarkd"  class="form-control @error('remark') is-invalid @enderror" value="" >
      
  </textarea></td></tr>
</tbody>
</table>


                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
    

      </form>
    </div><!-- modal-body end -->

                           

    </div>
  </div>
</div>
<!--------------------------  Assessment Modal End------------------->


<!-- ----------------------Enrollment Model Start----------------------->

{{--<div class="modal fade" id="enrollment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Enrollment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('enrollment.store') }}" >
              @csrf
      
                               <input type="hidden" name="client_id" value="{{($client_id)}}">
                               <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}">
                               <input type="hidden" name="job_id" value="{{($job_id)}}">
                               <input type="hidden" name="candidateenrollment" id="candidateenrollment" >

             
              <div class="row">
                  <label> Interview</label>
                  <select class="form-control select2" name="interview_id" id="interview_id" required>
                                <option value="">-select-</option>
                                @foreach ($interview as $data)
                                <option value="{{ $data->interview_id }}">{{ $data->interview_venu }}</option>
                                @endforeach
                  </select>  
              </div><br>

                <div class="row">
                    <label>Branch </label>
                    <select class="form-control select2" name="branch_id" id="branch_id" required>
                                  <option value="">-select-</option>
                                  @foreach ($branch as $data)
                                  <option value="{{ $data->branch_id }}">{{ $data->branch_name }}</option>
                                  @endforeach
                         </select>  
                </div> <br>  


                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                 </div>
    
   

      </form>
  </div> <!-- model body end -->

               

    </div>
  </div>
</div>--}}
<!--------------------------Enrollment Model Start------------------------------>


<!-- --------------------------Interview Modal End --------------------------------->

<div class="modal fade bdd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelpost" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabelpost">Interview Assessment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body">
     <form method="POST" action="{{ route('postassessment.store' ) }}">
              @csrf
      
                               <input type="hidden" name="client_id" value="{{($client_id)}}">
                               <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}">
                               <input type="hidden" name="job_id" value="{{($job_id)}}">
                               <input type="hidden" name="location_id" value="{{($location_id)}}">
                               <input type="hidden" name="candidatepostassessment" id="candidatepostassessment" >
                               <input type="hidden" value="Post" name="assessment_type" id="assessment_type" >
                               <input type="hidden" value="post_assessment_id" name="id_postassessment" id="post_assessment_id" >
                               <input type="hidden" value="{{$applied_id}}" name="applied_id" id="applied_id" >




<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%" >

<thead>
    <tr>
          <th width="30%">Rating</th>
          <th width="7%">1</th>
          <th width="7%">2</th>
          <th width="7%">3</th>
          <th width="7%">4</th>
          <th width="7%">5</th>
          <th width="40">Remarks</th>
 </tr>
</thead>
         



<tbody>
<tr>
    <td>Personality Apperance/Attitude:</td>
    <td>
        <input type="radio"   name="post_personality_appearence"  id="post_personality_appearence"   class="form-control @error('post_personality_appearence') is-invalid @enderror" value="INEFFECTIVE" >
    </td>
    <td>
        <input type="radio"   name="post_personality_appearence"  id="post_personality_appearence"   class="form-control @error('post_personality_appearence') is-invalid @enderror" value="NEEDSIMPROVMENT" >
    </td>
    <td>
        <input type="radio"   name="post_personality_appearence"  id="post_personality_appearence"   class="form-control @error('post_personality_appearence') is-invalid @enderror" value="GOOD" >
    </td>
    <td>
        <input type="radio"   name="post_personality_appearence"  id="post_personality_appearence"   class="form-control @error('post_personality_appearence') is-invalid @enderror" value="VERYGOOD" >
    </td>
    <td>
        <input type="radio"  name="post_personality_appearence"  id="post_personality_appearence"   class="form-control @error('post_personality_appearence') is-invalid @enderror" value="EXCELLENT" >
    </td>

    <td>
        <input type="text"  name="post_personality_remark"  id="post_personality_remark"   class="form-control @error('personality_remark') is-invalid @enderror" value="{{ old('personality_remark')  }}" >
    </td>
</tr>

<tr>
      <td>Knowladge & Technical Skills:</td>
      <td>
        <input type="radio"  name="post_knowledge"  id="post_knowledge"   class="form-control @error('post_knowledge') is-invalid @enderror" value="INEFFECTIVE" >
     </td>
     <td>
        <input type="radio"  name="post_knowledge"  id="post_knowledge"   class="form-control @error('post_knowledge') is-invalid @enderror" value="NEEDSIMPROVMENT" >
     </td>
     <td>
        <input type="radio"  name="post_knowledge"  id="post_knowledge"   class="form-control @error('post_knowledge') is-invalid @enderror" value="GOOD" >
     </td>
     <td>
        <input type="radio"  name="post_knowledge"  id="post_knowledge"   class="form-control @error('post_knowledge') is-invalid @enderror" value="VERYGOOD" >
     </td>
    <td>
        <input type="radio"  name="post_knowledge"  id="post_knowledge"   class="form-control @error('post_knowledge') is-invalid @enderror" value="EXCELLENT" >
    </td>
  
    <td>
        <input type="text"  name="post_knowledge_remark"  id="post_knowledge_remark" class="form-control @error('knowledge_remark') is-invalid @enderror" value="{{ old('knowledge_remark')  }}" >
    </td>
</tr>
    
<tr>
      <td>Initiative & Leadership:</td>
         <td>
            <input type="radio"  name="post_ledership"  id="post_ledership"  class="form-control @error('Ledership') is-invalid @enderror" value="INEFFECTIVE" >
         </td>
     <td>
        <input type="radio"  name="post_ledership"  id="post_ledership"  class="form-control @error('Ledership') is-invalid @enderror" value="NEEDSIMPROVMENT" >
     </td>
     <td>
        <input type="radio"  name="post_ledership"  id="post_ledership"  class="form-control @error('Ledership') is-invalid @enderror" value="GOOD" >
     </td>
     <td>
        <input type="radio"  name="post_ledership"  id="post_ledership"  class="form-control @error('Ledership') is-invalid @enderror" value="VERYGOOD" >
     </td>
     <td>
        <input type="radio"  name="post_ledership"  id="post_ledership"  class="form-control @error('Ledership') is-invalid @enderror" value="EXCELLENT" >
     </td>

     <td>
        <input type="text"  name="post_leadership_remark"  id="post_leadership_remark" class="form-control @error('leadership_remark') is-invalid @enderror" value="{{ old('leadership_remark')  }}" >
     </td>
</tr>
    
<tr>
      <td>English Communication</td>
    
        <td>
            <input type="radio"  name="post_communication"  id="post_communication"  class="form-control @error('communication') is-invalid @enderror" value="INEFFECTIVE" >
        </td>
       <td>
        <input type="radio"  name="post_communication"  id="post_communication"  class="form-control @error('communication') is-invalid @enderror" value="NEEDSIMPROVMENT" >
      </td>
      <td>
        <input type="radio"  name="post_communication"  id="post_communication"  class="form-control @error('communication') is-invalid @enderror" value="GOOD" >
      </td>
      <td>
        <input type="radio"  name="post_communication"  id="post_communication"  class="form-control @error('communication') is-invalid @enderror" value="VERYGOOD" >
      </td>
      <td>
        <input type="radio"  name="post_communication"  id="post_communication"  class="form-control @error('communication') is-invalid @enderror" value="EXCELLENT" >
     </td>

     <td>
        <input type="text"  name="post_communication_remark"  id="post_communication_remark" class="form-control @error('communication_remark') is-invalid @enderror" value="{{ old('communication_remark')  }}" >
     </td>
 </tr>

<tr>
      <td>Others (Please Spacify)</td>
      
         <td>
            <input type="radio"  name="post_other_assessment"  id="post_other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="INEFFECTIVE" >
        </td>
        <td>
        <input type="radio"  name="post_other_assessment"  id="post_other_assessment" class="form-control @error('other_assessment') is-invalid @enderror" value="NEEDSIMPROVMENT" >
       </td>
       <td>
        <input type="radio"  name="post_other_assessment"  id="post_other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="GOOD" >
       </td>
       <td>
        <input type="radio"  name="post_other_assessment"  id="post_other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="VERYGOOD" >
       </td>
       <td>
         <input type="radio"  name="post_other_assessment"  id="post_other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="EXCELLENT" >
       </td>

    <td>
        <input type="text"  name="post_other_assessment_remark" id="post_other_assessment_remark"   class="form-control @error('other_assessment_remark') is-invalid @enderror" value="{{ old('other_assessment_remark')  }}" >
    </td>

</tr>
</tbody>
</table>



<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">

<thead>
    <tr>
        <th colspan="7">Education</th>
    </tr>
</thead>

<tbody>
<tr>
    <td>DEGREE OBTAINED</td> 
    <td colspan="6">
     <!--    <input type="text"  name="post_degree_optain"  id="post_degree_optain"   class="form-control @error('degree_optain') is-invalid @enderror" value="{{ old('degree_optain')  }}" > -->

        <select class="form-control valdation_select" name="post_degree_optain" id="post_degree_optain">
                    <option value=''> -Grade- </option>  
                    <option value='Grade6' > Grade 6</option>  
                    <option value='Grade10'> Grade 10 </option>   
                    <option value='Pluse2'> Pluse 2 </option>   
            
      </select>   


    </td>
</tr>

 <tr>
    <td>PROFESSTIONAL LICENSE NO.</td>
    <td colspan="6">
      <input type="text"  name="post_professional_licence_no"  id="post_professional_licence_no"  class="form-control @error('professional_licence_no') is-invalid @enderror" value="{{ old(' professional_licence_no') }}" >
    </td>
</tr>

  <tr>
    <td>TECHNICAL QUALIFICATION</td>
    <td colspan="6">
     <!--  <input type="text"  name="post_technical_qualification"  id="post_technical_qualification"  class="form-control @error('technical_qualification') is-invalid @enderror" value="{{ old(' technical_qualification') }}" >
 -->


     <select class="form-control valdation_select" name="post_technical_qualification" id="post_technical_qualification">
                    <option value=''> -Education- </option>  
                    <option value='Degree' > Degree </option>  
                    <option value='Diploma'> Diploma  </option>   
                    <option value='ITI'> ITI </option>  
                    <option value='IIT'> IIT </option>   
                    <option value='Btech'> Btech </option>   
                    <option value='Vocational'> Vocational </option>   
            
      </select>   



    </td>
 </tr>

  <tr>
    <td>KEY SKILLS</td>
    <td colspan="6"><input type="text"  name="post_key_skill"  id="post_key_skill"  class="form-control @error('key_skill') is-invalid @enderror" value="{{ old(' key_skill') }}" >
    </td>
 </tr>

  <tr>
    <td>TRADE TEST</td><td colspan="6"><input type="text"  name="post_trade_test"  id="post_trade_test"  class="form-control @error('trade_test') is-invalid @enderror" value="{{ old('trade_test')  }}"  >
    </td>
 </tr>
</tbody>
</table>



<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">
<thead><tr><th>Language used</th> <th>English</th><th>Hindi</th><th  colspan="4">Others</th></tr></thead>
<tbody>
<tr>
    <td>RATINFG</td>
     <td>
        <select class="form-control valdation_select" name="post_languge_used" id="post_languge_used">
                       <option value=''> -Select- </option>  
                       <option value='Good' > Good </option>   
                       <option value='Bad' > Bad </option>   
                       <option value='Verygood' > Very good </option>   
                       <option value='Excellent'  > Excellent </option>   
        </select>
     </td>
    <td>
         <select class="form-control valdation_select" name="post_languge_used1"  id="post_languge_used1">
                       <option value=''> -Select- </option>  
                       <option value='Good' > Good </option>   
                       <option value='Bad' > Bad </option>   
                       <option value='Verygood' > Very good </option>   
                       <option value='Excellent'  > Excellent </option>   
        </select>
        </td>
        <td colspan="4"><input type="text"  name="post_languge_used2"  id="post_languge_used2"  class="form-control @error('languge_used') is-invalid @enderror" value="{{ old(' languge_used') }}" >
        </td>
</tr>
</tbody>
</table>



<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">
<thead><tr><th colspan="7">Work Experience</th> </tr>
<tr><th></th> <th colspan="3">POSITION HELD</th><th colspan="3">TOTAL YEARS/MONTHS</th></tr></thead>
<tbody>
<tr>
    <td>LOCAL</td> 
    <td colspan="3">
        <input type="text"  name="post_local_work_experience"  id="post_local_work_experience"  class="form-control @error('local_work_experience') is-invalid @enderror" value="{{ old(' local_work_experience') }}" >
    </td>
    <td colspan="3">
        <input type="text"  name="post_local_experience_year"  id="post_local_experience_year"  class="form-control @error('local_experience_year') is-invalid @enderror" value="{{ old(' local_experience_year') }}" >
    </td>
</tr>

<tr>
    <td>OVERSEAS</td> 
  <td colspan="3">
    <input type="text"  name="post_overseas_expereicne"  id="post_overseas_expereicne"  class="form-control @error('overseas_expereicne') is-invalid @enderror" value="{{ old(' overseas_expereicne') }}" >
  </td>
  <td colspan="3">
    <input type="text"  name="post_overseaase_year"  id="post_overseaase_year"  class="form-control @error('overseaase_year') is-invalid @enderror" value="{{ old(' overseaase_year') }}" >
  </td>
</tr>
</tbody>
</table>



<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">
<thead>
    <tr>
        <th colspan="7">Overall Assessment </th>
   </tr>
</thead>
<tbody>

<tr> 
    <td>
        <center><label for="age1">Selected</label><br><input type="radio" id="age1" name="post_overall_assessment"  id="post_overall_assessment" value="selected">
        </center>
    </td>
  <td>
     <center><label for="age1">Reserved</label><br><input type="radio" id="age1" name="post_overall_assessment" id="post_overall_assessment" value="reserved">
     </center>
  </td>
  <td>
    <center><label for="age1">Rejected</label><br><input type="radio" id="age1" name="post_overall_assessment" id="post_overall_assessment" value="rejected"> 
    </center>
  </td>
  <td> 
    <center> <label for="age1">Others</label><br><input type="radio" id="age1" name="post_overall_assessment" id="post_overall_assessment" value="others"> 
    </center>
 </td>
  <td> 
    <center> <label for="age1">Standby</label><br><input type="radio" id="age1" name="post_overall_assessment" id="post_overall_assessment" value="Standby"> 
    </center>
 </td>
  <td colspan="3">
     <label for="age1">Overall Rating%</label>
     <input type="text"  name="post_overall_rating" id="post_overall_rating" class="form-control" value="">
 </td>
</tr>
</tbody>
</table>



<table id="dynamicAddRemove" width="100%">
<thead><tr><th>Remarks</th></tr></thead>
<tbody>
  <tr>
    <td>
    <textarea type="text"  name="post_remark"  id="post_remark"  class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark') }}" ></textarea>
    </td>
 </tr>
</tbody>
</table>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>


      </form>
    </div><!-- modal-body end -->

                
    </div>
  </div>
</div>
<!---------------------------- Interview Modal End------------------------- -->




<!--------------------------Selection Model Start------------------------------>

<div class="modal fade" id="selection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Selection</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('selection.store') }}"  enctype="multipart/form-data">
              @csrf
    
                               <input type="hidden" name="client_id" value="{{($client_id)}}">
                               <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}">
                               <input type="hidden" name="job_id" value="{{($job_id)}}">
                               <input type="hidden" name="candidateselection" id="candidateselection" >
       

              <div class="row">
                <label> Attached Document 1 </label>
                <input type="file" name="attached_document1"  id="attached_document1" class="form-control @error('  attached_document1') is-invalid @enderror" value="{{ old('attached_document1')  }}"   required >
                @error('attached_document1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div></br>

               <div class="row">
                <label> Attached Document 2 </label>
                <input type="file" name="attached_document2"  id="attached_document2" class="form-control @error('  attached_document2') is-invalid @enderror" value="{{ old('attached_document2')  }}"   required >
                @error('attached_document2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div><br>

                 <div class="row">
                <label> Attached Document 3 </label>
                <input type="file" name="attached_document3"  id="attached_document3" class="form-control @error('  attached_document3') is-invalid @enderror" value="{{ old('attached_document3')  }}"   required >
                @error('attached_document3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div></br>


                  <div class="row">
                <label>Remark </label>
                <textarea type="text" name="remark"  id="remark" class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark') }}" required ></textarea>
                @error('remark')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div></br>

                 <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>

     
      </form>
     </div><!-- modal body end-->
               
    </div>
  </div>
</div>

<!--------------------------Selection Model End------------------------------>







<!--------------------------Offers Form Start------------------------------>
<div class="modal fade" id="offers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Offer Letter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('offerletter.store')}}"  enctype="multipart/form-data">
              @csrf

                   <input type="hidden" name="client_id" value="{{($client_id)}}">
                   <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}">
                   <input type="hidden" name="job_id" value="{{($job_id)}}">
                   <input type="hidden" name="location_id" value="{{($location_id)}}">
                   <input type="hidden" name="candidateofferletter" id="candidateofferletter" ><br>           
                   <input type="hidden" value="offer_letter_id" name="id_offerletter" id="offer_letter_id" >
                   <input type="hidden" value="{{$applied_id}}" name="applied_id" id="applied_id" >



<?php

//echo $personalvalue='<p id="txt"></p>';
$template=DB::table('template')->where('title','offerletter')->first();

$data=DB::table('job_applied')
->leftjoin('jobs','jobs.job_id','=','job_applied.job_id')
->leftjoin('enquiry','enquiry.enquiry_id','=','job_applied.enquiry_id')
->leftjoin('personal','personal.candidate_id','=','job_applied.candidate_id')
->leftjoin('passport','passport.candidate_id','=','personal.candidate_id')

->where('jobs.enquiry_id',$enquiry_id)
->where('jobs.job_id',$job_id)
->where('personal.candidate_id',39)
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


             <div class="row">
                        <div class="col-lg-4">
                                <label>Issue Date </label>
                                <input type="date" name="issue_date"  id="issue_dateoffer" class="form-control @error('issue_date') is-invalid @enderror" value="{{ old('issue_date') }}"  >
                                @error('issue_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                        </div>
                          <div class="col-lg-4">
                                <label>Signed Date </label>
                                <input type="date" name="signed_date"  id="signed_dateoffer" class="form-control @error('signed_date') is-invalid @enderror" value="{{ old('signed_date')  }}" >
                                @error('signed_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                 
                        </div>
                          <div class="col-lg-4">
                               <label>Refuse Date </label>
                                <input type="date" name="refuse_date"  id="refuse_dateoffer" class="form-control @error('refuse_date') is-invalid @enderror" value="{{ old('refuse_date') }}" >
                                @error('refuse_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              
                        </div>
                         
                </div><br>
               
                  <div class="row">
                            <div class="col-lg-4">
                             <label> Attached Document 1 </label>
                                <input type="file" name="attached_document1"  id="attached_document1" class="form-control @error('attached_document1') is-invalid @enderror" value="{{ old('attached_document1')  }}" >
                                @error('attached_document1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-4"> 
                            <label> Attached Document 2 </label>
                            <input type="file" name="attached_document2"  id="attached_document2" class="form-control  @error('attached_document2') is-invalid @enderror" value="{{ old('attached_document2')  }}" >
                            @error('attached_document2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                                
                            <div class="col-lg-4"> 
                                <label> Attached Document 3 </label>
                                <input type="file" name="attached_document3"  id="attached_document3" class="form-control  @error('attached_document3') is-invalid @enderror" value="{{ old('attached_document3')  }}" >
                                @error('attached_document3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                  </div><br>
           

                <label>Remark </label>
                <textarea type="text" name="remark"  id="offer_remark" class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark') }}" required ></textarea>
                @error('remark')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br>


                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                  </div>
    
          

 </form>
   </div><!-- modal body end -->

   
    </div>
  </div>
</div>
<!--------------------------Offers  From End------------------------------>






































<!-- ----------------------Pre Medical Model Start----------------------->

<div class="modal fade" id="medical" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Pre Medical</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form method="POST" action="{{ route('premedical.store') }}"  enctype="multipart/form-data">
              @csrf
                   <input type="hidden" name="client_id" value="{{($client_id)}}">
                   <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}">
                   <input type="hidden" name="job_id" value="{{($job_id)}}">
                   <input type="hidden" name="location_id" value="{{($location_id)}}">
                   <input type="hidden" name="candidatepremedical" id="candidatepremedical" ><br>
                   <input type="hidden" value="premedical_id" name="id_premedical" id="premedical_id" >
                   <input type="hidden" name="applied_id" value="{{($applied_id)}}">

    
          <div class="row">

                      <div class="col-lg-4">
                        
                             <label>Medical Examination Center</label>
                              <select class="form-control select2" name="medical_examination_center_id" 
                              id="medical_examination_center_id" required>
                                <option value="">-Select-</option>
                                @foreach($medical_examination_center as $data)
                                <option value="{{ $data->medical_examination_center_id }}">{{ $data->medical_examination_center_name }}
                                </option>
                                @endforeach
                              </select>  
                       </div>



                     <div class="col-lg-4">  
                           <label> Fit/Unfit </label>
                           <select class="form-control" name="datefit" id="dateFit" required>
                                <option value="">-Select-</option>
                                <option value="fit_date">Fit </option>
                                <option value="unfit_date">Unfit </option>
                                <option value="pending">Pending</option>
                           </select>
                      </div>



                      <div class="col-lg-4">
                               <label> Date </label>
                                <input type="date" name="fit_date"  id="fit_date" class="form-control @error('fit_date') is-invalid @enderror" value="{{ old('fit_date')  }}"  required>
                                @error('fit_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               <br>
                      </div>
                     <!--  <div class="col-lg-6">
                                <label>Unfit Date </label>
                                <input type="date" name="unfit_date"  id="unfit_date" class="form-control @error('    unfit_date') is-invalid @enderror" value="{{ old(' unfit_date') }}">
                                @error('unfit_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                  <br>
                      </div> -->
                      
            </div>
                
            
       <div class="row">
                <div class="col-lg-4">
                       <label> Attached Document 1 </label>
                        <input type="file" name="attached_document1"  id="attached_document1" class="form-control @error('  attached_document1') is-invalid @enderror" value="{{old('attached_document1')}}"  onchange="readURLs(this);">
                        @error('attached_document1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                 </div>

                 <div class="col-lg-4">
                        <label> Attached Document 2 </label>
                        <input type="file" name="attached_document2"  id="attached_document2" class="form-control @error('  attached_document2') is-invalid @enderror" value="{{ old('attached_document2')}}" onchange="readURL(this);" >
                        @error('attached_document2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                 </div>

                  <div class="col-lg-4">
                        <label> Attached Document 3 </label>
                        <input type="file" name="attached_document3"  id="attached_document3" class="form-control @error('  attached_document3') is-invalid @enderror" value="{{ old('attached_document3') }}" onchange="URLreads(this);">
                        @error('attached_document3')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
</div><br>


   <div class="row">
              <div class="col-lg-4">
                <embed id="imges" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100"></embed>
              </div>
             <div class="col-lg-4">
                <embed id="attached_document2_premedical" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100"></embed>
             </div>
              <div class="col-lg-4">
                  <embed id="attached_document3_premedical" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100"></embed>
              </div>
    </div>

             
               

            

                   <label>Remark </label>
                <textarea type="text" name="premedical_remark"  id="remark_premedical" class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark') }}" required ></textarea>
                @error('remark')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                  <br>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>

        </form>
      </div><!-- modal-body end-->

  
       
      
    </div>
  </div>
</div>
<!-- ----------------------Pre Medical Model End----------------------->



<!-- --------------------------------QVC Modal Start-------------------------- -->
<div class="modal fade" id="qvc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Vc Process</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

   <div class="modal-body"><!-- modal-body start-->
      <form method="POST" action="{{ route('qvcprocess.store') }}"  enctype="multipart/form-data">
              @csrf

                   <input type="hidden" name="client_id" value="{{($client_id)}}">
                   <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}">
                   <input type="hidden" name="job_id" value="{{($job_id)}}">
                   <input type="hidden" name="location_id" value="{{($location_id)}}">
                   <input type="hidden" name="candidateqvc" id="candidateqvc" ><br>
                   <input type="hidden" value="qvc_id" name="id_qvc" id="qvc_id" >
                   <input type="hidden" name="applied_id" value="{{($applied_id)}}">
      
                    <div class="row">
                             <div class="col-lg-6">
                                    <label>Client Applied Date </label>
                                    <input type="date" name="client_applied_date"  id="client_applied_date" class="form-control @error('client_applied_date') is-invalid @enderror" value="{{ old('client_applied_date')  }}"   required>
                                    @error('client_applied_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <br>
                              </div>

                              <div class="col-lg-6">
                                    <label>Appointment Date</label>
                                    <input type="date" name="appointment_date"  id="appointment_date" class="form-control @error('    appointment_date') is-invalid @enderror" value="{{ old(' appointment_date') }}" required>
                                    @error('appointment_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <br>
                               </div>
                    </div>


                     <div class="row">



                                     <div class="col-lg-6">  
                                           <label> Fit/Unfit </label>
                                           <select class="form-control" name="date_medical_fit" id="date_medical" required>
                                                <option value="">-Select-</option>
                                                <option value="medical_fit_date">Fit </option>
                                                <option value="medical_unfit_date">Unfit </option>
                                                <option value="report_pending"> Report Pending in VC </option>
                                                <option value="reschedule">Reschedule </option>

                                           </select>
                                      </div>


                                     <div class="col-lg-6">
                                          <label> Date </label>
                                          <input type="date" name="medical_fit_date"  id="medical_fit_date" class="form-control @error('medical_fit_date') is-invalid @enderror" value="{{ old('medical_fit_date')  }}" required   >
                                          @error('medical_fit_date')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                          <br>         
                                    </div>

                               <!--    <div class="col-lg-6">
                                          <label>Medical Unfit Date </label>
                                          <input type="date" name="medical_unfit_date"  id="medical_unfit_date" class="form-control @error('     medical_unfit_date') is-invalid @enderror" value="{{ old('medical_unfit_date') }}" >
                                          @error('medical_unfit_date')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                          <br>
                                  </div> -->
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                              <label>Remark </label>
                <textarea type="text" name="qvc_remark"  id="qvc_remark" class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark') }}" required ></textarea>
                @error('remark')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br>  
                            
                        </div>
                    </div>

    
     <div class="row">
                <div class="col-lg-4"> 
                       <label> Attached Document 1 </label>
                       <input type="file" name="attached_document1"  id="attached_document1" class="form-control @error('attached_document1') is-invalid @enderror" value="{{ old('attached_document1')  }}" onchange="URLqvc1(this);">
                       @error('attached_document1')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                         </span>
                       @enderror
                 </div>

                  <div class="col-lg-4">
                        <label> Attached Document 2 </label>
                        <input type="file" name="attached_document2"  id="attached_document2" class="form-control @error('attached_document2') is-invalid @enderror" value="{{ old('attached_document2')  }}" onchange="URLqvc2(this);">
                        @error('attached_document2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                 </div>

                 <div class="col-lg-4">   
                         <label> Attached Document 3 </label>
                        <input type="file" name="attached_document3"  id="attached_document3" class="form-control @error('attached_document3') is-invalid @enderror" value="{{ old('attached_document3')  }}" onchange="URLqvc3(this);" >
                        @error('attached_document3')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                 </div>
                  
</div><br>
              
         <div class="row">
              <div class="col-lg-4">
                <embed id="attached_document1_qvc" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100"></embed>
              </div>
             <div class="col-lg-4">
                <embed id="attached_document2_qvc" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100"></embed>
             </div>
              <div class="col-lg-4">
                  <embed id="attached_document3_qvc" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100"></embed>
              </div>
      </div>

              


                   <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

          </form>
       </div><!-- modal-body end -->

                 
    </div>
  </div>
</div>
<!------------------------- QVC Modal End ------------------------->



<!------------------Visa Process Modal Start-------------------------->
<div class="modal fade" id="visa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLongTitle">Visa Process</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>

   <div class="modal-body"><!-- modal-body start-->
     <form method="POST" action="{{ route('visaprocess.store') }}"  enctype="multipart/form-data">
           @csrf

                   <input type="hidden" name="client_id" value="{{($client_id)}}">
                   <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}">
                   <input type="hidden" name="job_id" value="{{($job_id)}}">
                   <input type="hidden" name="location_id" value="{{($location_id)}}">
                   <input type="hidden" name="candidatevisa" id="candidatevisa" ><br>
                   <input type="hidden" value="visa_id" name="id_visa" id="visa_id" >
                   <input type="hidden" name="applied_id" value="{{($applied_id)}}">


             <div class="row">
                     <div class="col-lg-6">
                        <label>Issue Date </label>
                        <input type="date" name="issue_date"  id="issue_date" class="form-control @error('issue_date') is-invalid @enderror" value="{{ old('issue_date') }}" >
                        @error('issue_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                     </div>
                     <div class="col-lg-6">
                          <label>Expiry Date </label>
                          <input type="date" name="expiry_date"  id="expiry_date" class="form-control @error('expiry_date') is-invalid @enderror" value="{{ old('expiry_date')  }}"   >
                          @error('expiry_date')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                          <br>
                    </div>
              </div>


                <div class="row">
                     <div class="col-lg-4">
                          <label>Ev No </label>
                          <input type="text" name="ev_no"  id="ev_no" class="form-control @error('ev_no') is-invalid @enderror" value="{{ old('ev_no') }}" required="" required >
                          @error('ev_no')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                           <br>
                     </div>
                     <div class="col-lg-4">
                          <label>Vp No</label>
                          <input type="text" name="sim_no"  id="sim_no" class="form-control @error('sim_no') is-invalid @enderror" value="{{ old('sim_no')  }}"  required=""  >
                          @error('sim_no')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                           <br>
                    </div>
                    <div class="col-lg-4">
                            <label>Visa Profession </label>
                            <input type="text" name="vissa_profession"  id="vissa_profession" class="form-control @error('vissa_profession') is-invalid @enderror" value="{{ old('vissa_profession') }}" required=""  required>
                            @error('vissa_profession')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                    </div>
               </div>


             
             

    <div class="row">
                    <div class="col-lg-4">
                           <label> Attached Document 1 </label>
                            <input type="file" name="attached_document1"  id="attached_document1" class="form-control @error('  attached_document1') is-invalid @enderror" value="{{ old('attached_document1')  }}" onchange="URLvisa1(this);">
                            @error('attached_document1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                     <div class="col-lg-4">
                           <label> Attached Document 2 </label>
                            <input type="file" name="attached_document2"  id="attached_document2" class="form-control @error('form-control  attached_document2') is-invalid @enderror" value="{{ old('attached_document2')  }}" onchange="URLvisa2(this);">
                            @error('attached_document2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                     </div>
                      <div class="col-lg-4">
                                <label> Attached Document 3 </label>
                                <input type="file" name="attached_document3"  id="attached_document3" class="form-control @error('  attached_document3') is-invalid @enderror" value="{{ old('attached_document3')  }}" onchange="URLvisa3(this);">
                                @error('attached_document3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>
    </div><br>
              
         <div class="row">
              <div class="col-lg-4">
                <embed id="attached_document1_visa" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100"></embed>
              </div>
              <div class="col-lg-4">
                <embed id="attached_document2_visa" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100"></embed>
              </div>
              <div class="col-lg-4">
                  <embed id="attached_document3_visa" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100"></embed>
              </div>
         </div>
             
             
             
              
                 <label>Remark </label>
                 <textarea type="text" name="remark"  id="visa_remark" class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark') }}" required ></textarea>
                 @error('remark')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                 @enderror
                 <br>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>

 
               
    </form>
</div><!-- modal-body end-->

                

    </div>
  </div>
</div>
<!------------------------ Visa Process Modal End ------------------------->











@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}" defer> </script>

<script type="text/javascript">
$(document).ready(function(){
    var table = $('#example').DataTable({
       orderCellsTop: true,
       fixedHeader: true 
    });

    //Creamos una fila en el head de la tabla y lo clonamos para cada columna
    $('#example thead tr').clone(true).appendTo( '#example thead' );

    $('#example thead tr:eq(1) th').each( function (i) {
        var title = $(this).text(); //es el nombre de la columna
          if (title != 'Action') {
        $(this).html( '<input type="text" placeholder="'+title+'" class="form-control" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        });
    }
    } );   


  $('#client_id').select2();
  $('#enquiry_id').select2();
  $('#job_id').select2();
  $('#location').select2();


$('#email_title').select2({
              dropdownParent: $('#mail')
    });

 $('#sms_title').select2({
              dropdownParent: $('#sms')
    });
 

 
     $('#client_id').change(function(){
  var clientID = $(this).val();  
  if(clientID){
    $.ajax({
      type:"GET",
      url:"{{url('getEnquiry')}}?client_id="+clientID,
      success:function(res){  
      if(res){
        $("#enquiry_id").empty();
        $("#enquiry_id").append('<option>Select Enquiry</option>');
        $.each(res,function(key,value){
          $("#enquiry_id").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#enquiry_id").empty();
      }
      }
    });
  }else{
    $("#enquiry_id").empty();
    $("#job_id").empty();
   
  }   
  });




     $('#enquiry_id').change(function(){
  var enquiryID = $(this).val();  
  if(enquiryID){
    $.ajax({
      type:"GET",
      url:"{{url('getJob')}}?enquiry_id="+enquiryID,
      success:function(res){  
      if(res){
        $("#job_id").empty();
        $("#job_id").append('<option>Select Job</option>');
        $.each(res,function(key,value){
          $("#job_id").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#job_id").empty();
      }
      }
    });
  }else{
    $("#job_id").empty();
   
  }   
  });

   $('#job_id').change(function(){
  var enquiryID = $(this).val();  
  if(enquiryID){
    $.ajax({
      type:"GET",
      url:"{{url('getLocation')}}?job_id="+enquiryID,
      success:function(res){  
      if(res){
        $("#location").empty();
        $("#location").append('<option>Select Location</option>');
        $.each(res,function(key,value){
          $("#location").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#location").empty();
      }
      }
    });
  }else{
    $("#location").empty();
  }   
  });

  // ---------------for email template-------------------------------------

     $('#email_title').change(function(){
  var clientID = $(this).val();
    
  if(clientID){
    $.ajax({
      type:"GET",
      url:"{{url('getmailtemplate')}}?email_title="+clientID,
      success:function(res){  
           
       if(res){
       
        $("#email_template").empty();
        $("#email_template").append('<option>Select Enquiry</option>');

  $.each(res,function(key,value){

          $("#email_template").append(value.email_template);
        });
      }else{
        $("#email_template").empty();
      }
      }
    });
  }else{
    $("#email_template").empty();
  
  }   
  });

   // -------------for email template-------------------------------------

  //----------------- for SMS template---------------------------------

     $('#sms_title').change(function(){
  var clientID = $(this).val();
    
  if(clientID){
    $.ajax({
      type:"GET",
      url:"{{url('getsmstemplate')}}?sms_title="+clientID,
      success:function(res){  
           
       if(res){
                      
        $("#sms_template").empty();
        $("#sms_template").append('<option>Select Enquiry</option>');

  $.each(res,function(key,value){
            $("#sms_template").append(value.sms_template);
        });
      }else{
        $("#sms_template").empty();
      }
      }
    });
  }else{
    $("#sms_template").empty();
  
  }   
  });

 //--------------- for SMS template----------------------------------------



});

function openPopup(id,assessment_id="")
{
  //document.getElementById("candidatecallstatus").value=id;
  //document.getElementById("candidateenrollment").value=id;
  document.getElementById("candidateselection").value=id;
  //document.getElementById("candidateofferletter").value=id;
 // document.getElementById("candidatepremedical").value=id;
  //document.getElementById("candidateqvc").value=id;
  //document.getElementById("candidatevisa").value=id;

// var assess = document.getElementById("candidateidassessment").value;
// document.getElementById("assess_id").innerHTML = assess;

}



// --------------------Assessment Start----------------------------
function openAssessment(id,assessment_id="")
{
  document.getElementById("candidateidassessment").value=id;
  
  if(candidateidassessment){
    $.ajax({
      type:"GET",
      url:"{{url('getAssessment')}}?assessment_id="+assessment_id,
      success:function(res){  


        //alert(res[0].personality_appearence);
        

$("input[name=personality_appearence][value=" + res[0].personality_appearence + "]").attr('checked', 'checked');
$("input[name=knowledge][value=" + res[0].knowledge + "]").attr('checked', 'checked');
$("input[name=ledership][value=" + res[0].ledership + "]").attr('checked', 'checked');
$("input[name=communication][value=" + res[0].communication + "]").attr('checked', 'checked');
$("input[name=other_assessment][value=" + res[0].other_assessment + "]").attr('checked', 'checked');
$("input[name=overall_assessment][value=" + res[0].overall_assessment + "]").attr('checked', 'checked');


        $("#assessment_id").val(res[0].assessment_id);
          $("#personality_remark").val(res[0].personality_remark);
        $("#knowledge_remark").val(res[0].knowledge_remark);
        $("#leadership_remark").val(res[0].leadership_remark);
        $("#communication_remark").val(res[0].communication_remark);
        $("#other_assessment_remark").val(res[0].other_assessment_remark);

       
        $("#degree_optain").val(res[0].degree_optain).attr('selected','selected');
        $("#professional_licence_no").val(res[0].professional_licence_no);
        $("#technical_qualification").val(res[0].technical_qualification).attr('selected','selected');
        $("#key_skill").val(res[0].key_skill);
        $("#trade_test").val(res[0].trade_test);

        $("#local_work_experience").val(res[0].local_work_experience);
        $("#local_experience_year").val(res[0].local_experience_year);
        $("#overseas_expereicne").val(res[0].overseas_expereicne);
        $("#overseaase_year").val(res[0].overseaase_year);


        $("#languge_used").val(res[0].languge_used).attr('selected','selected');

        $("#languge_used1").val(res[0].languge_used1).attr('selected','selected');


       // $("#languge_used1 option[value='Good']")[0].selected = true;
       // $("#languge_used1 option[value='Verygood']")[0].selected = true;
       // $("#languge_used1 option[value='Excellent']")[0].selected = true;

        $("#languge_used2").val(res[0].languge_used2);
        $("#overall_assessment").val(res[0].overall_assessment);
        $("#overall_rating").val(res[0].overall_rating);
        $("#remarkd").val(res[0].remark);    

      }
    });

  }

}
// ------------------------Assessment End----------------------------



// --------------------POST Assessment Start----------------------------
function openPostAssessment(id,post_assessment_id="")
{
  document.getElementById("candidatepostassessment").value=id;
  
  if(candidatepostassessment){
    $.ajax({
      type:"GET",
      url:"{{url('getPostAssessment')}}?post_assessment_id="+post_assessment_id,
      success:function(res){  


$("input[name=post_personality_appearence][value=" + res[0].personality_appearence + "]").attr('checked', 'checked');
$("input[name=post_knowledge][value=" + res[0].knowledge + "]").attr('checked', 'checked');
$("input[name=post_ledership][value=" + res[0].ledership + "]").attr('checked', 'checked');
$("input[name=post_communication][value=" + res[0].communication + "]").attr('checked', 'checked');
$("input[name=post_other_assessment][value=" + res[0].other_assessment + "]").attr('checked', 'checked');
$("input[name=post_overall_assessment][value=" + res[0].overall_assessment + "]").attr('checked', 'checked');

        $("#post_assessment_id").val(res[0].post_assessment_id);
        $("#post_personality_remark").val(res[0].personality_remark);
        $("#post_knowledge_remark").val(res[0].knowledge_remark);
        $("#post_leadership_remark").val(res[0].leadership_remark);
        $("#post_communication_remark").val(res[0].communication_remark);
        $("#post_other_assessment_remark").val(res[0].other_assessment_remark);

        $("#post_degree_optain").val(res[0].degree_optain).attr('selected','selected');
        $("#post_professional_licence_no").val(res[0].professional_licence_no);
        $("#post_technical_qualification").val(res[0].technical_qualification).attr('selected','selected');

        $("#post_key_skill").val(res[0].key_skill);
        $("#post_trade_test").val(res[0].trade_test);

        $("#post_languge_used").val(res[0].languge_used).attr('selected','selected');
        $("#post_languge_used1").val(res[0].languge_used1).attr('selected','selected');

        


        $("#post_languge_used2").val(res[0].languge_used2);

        $("#post_local_work_experience").val(res[0].local_work_experience);
        $("#post_local_experience_year").val(res[0].local_experience_year);
        $("#post_overseas_expereicne").val(res[0].overseas_expereicne);
        $("#post_overseaase_year").val(res[0].overseaase_year);

        $("#post_overall_rating").val(res[0].overall_rating);
        $("#post_remark").val(res[0].remark);    


      }
    });

  }

}
// ------------------------POST Assessment End----------------------------



// --------------------Show Interview Detail Start----------------------------
function openEnroll(id,location_id="",candidate_interview_id="")
{
     document.getElementById("candidateenrollment").value=id;
  // document.getElementById("location_id").value=id;
  
  if(candidateenrollment){

    $.ajax({
      type:"GET",
      url:"{{url('getInterview')}}?location_id="+location_id+"&candidate_interview_id="+candidate_interview_id,
      success:function(res){  

          //alert(res[0].candidate_interview_id);
    
        //$("#interview_venu").val(res[0].interview_venu);
        var interviewdate = res[0].interview_date;
        var condate = new Date(interviewdate * 1000).toJSON().slice(0, 10);
        $('#interview_date').val(condate);
        

         var strttime = res[0].start_time;
         var newtime = new Date(strttime * 1000).toISOString().substr(11, 8);
         $('#start_time').val(newtime);

         var endtime = res[0].end_time;
         var endtimes = new Date(endtime * 1000).toISOString().substr(11, 8);
         $('#end_time').val(endtimes);




        $("#candidate_interview_id").val(res[0].candidate_interview_id);
        $("#interview_venu").val(res[0].interview_venu);
        $("#interview_city").val(res[0].interview_city);
        $("#interview_state").val(res[0].interview_state);
        $("#interview_country").val(res[0].interview_country);
        $("#interview_zipcode").val(res[0].interview_zipcode);
        $("#interviewer_name").val(res[0].interviewer_name);
        $("#interviewer_email").val(res[0].interviewer_email);
        $("#interviewer_mobileno").val(res[0].interviewer_mobileno);
       

      }
    });

  }

}
// ------------------------Show Interview Detail End----------------------------

  

  
// --------------------Send Offer Letter Start----------------------------
function openOffer(id,offer_letter_id="")
{
      document.getElementById("candidateofferletter").value=id;
      document.getElementById("candidateoffer").value=id;

     // var personalid = document.getElementById("candidateofferletter").value;
     // document.getElementById("txt").innerHTML=personalid;
    
  
  if(candidateofferletter){

    $.ajax({
      type:"GET",
      url:"{{url('getOfferLetter')}}?offer_letter_id="+offer_letter_id,
      success:function(res){  
    
        $("#offer_letter_id").val(res[0].offer_letter_id);
        $("#offer_remark").val(res[0].remark);

        if(res[0].issue_date!='0'){
        var numbs = res[0].issue_date;
        var ymdates = new Date(numbs * 1000).toJSON().slice(0, 10);
        $('#issue_dateoffer').val(ymdates);
        }  
         
        if(res[0].signed_date!='0'){
        var numb = res[0].signed_date;
        var ymdate = new Date(numb * 1000).toJSON().slice(0, 10);
        $('#signed_dateoffer').val(ymdate);
        }

        if(res[0].refuse_date!='0'){
        var numm = res[0].refuse_date;
        var ymmd = new Date(numm * 1000).toJSON().slice(0, 10);
        $('#refuse_dateoffer').val(ymmd);
        }



      }
    });

  }

}
// ------------------------Send Offer Letter End----------------------------


  
// --------------------Pre Medical Start----------------------------
function openPreMedical(id, premedical_id="")
{
     document.getElementById("candidatepremedical").value=id;
  
  if(candidatepremedical){

    $.ajax({
      type:"GET",
      url:"{{url('getPreMedical')}}?premedical_id="+ premedical_id,
      success:function(res){  
    
        $("#premedical_id").val(res[0].premedical_id);
      
        $("#medical_examination_center_id").val(res[0].medical_examination_center_id);

        // $("#dateFit option[value='unfit_date']")[0].selected = true;
        //     var number = res[0].unfit_date;
        //     var ymdpre = new Date(number * 1000).toJSON().slice(0, 10);
        //     $('#fit_date').val(ymdpre);


 $("#dateFit").val(res[0].medicalstatus);

if(res[0].medicalstatus=="pending"){
          var Pdate = res[0].pending;
          var Dpending = new Date(Pdate * 1000).toJSON().slice(0, 10);
          $('#fit_date').val(Dpending);
       $("#remark_premedical").val(res[0].pending_remark );
}
else if(res[0].medicalstatus=="unfit_date"){
            var unfitD = res[0].unfit_date;
            var yodpre = new Date(unfitD * 1000).toJSON().slice(0, 10);
            $('#fit_date').val(yodpre);
         $("#remark_premedical").val(res[0].unfit_remark);
}


         var SITEURL = '{{URL::to('')}}';
         $('#imges').attr('src',SITEURL+'/documents/Candidate/'+res[0].directory_path+'/'+res[0].attached_document1);
         $('#attached_document2_premedical').attr('src',SITEURL+'/documents/Candidate/'+res[0].directory_path+'/'+res[0].attached_document2);
         $('#attached_document3_premedical').attr('src',SITEURL+'/documents/Candidate/'+res[0].directory_path+'/'+res[0].attached_document3);

         // $("#remark_premedical").val(res[0].remark);


      }
    });

  }

}

function readURLs(input, id) {
id = id || '#imges';
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$(id).attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
$('#imges').removeClass('hidden');
$('#start').hide();
}
}

function readURL(input, id) {
id = id || '#attached_document2_premedical';
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$(id).attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
$('#attached_document2_premedical').removeClass('hidden');
$('#start').hide();
}
}


function URLreads(input, id) {
id = id || '#attached_document3_premedical';
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$(id).attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
$('#attached_document3_premedical').removeClass('hidden');
$('#start').hide();
}
}
// ------------------------Pre Medical End----------------------------


  
// --------------------QVC Process Start----------------------------
function openQvcProcess(id,qvc_id="")
{
     document.getElementById("candidateqvc").value=id;
  
  if(candidateqvc){

    $.ajax({
      type:"GET",
      url:"{{url('getQvc')}}?qvc_id="+qvc_id,
      success:function(res){  

        $("#qvc_id").val(res[0].qvc_id);
        $("#qvc_remark").val(res[0].remark);

         if(res[0].client_applied_date !='0'){
         var noa = res[0].client_applied_date;
         var ymdq = new Date(noa * 1000).toJSON().slice(0, 10);
         $('#client_applied_date').val(ymdq);
         }

         if(res[0].appointment_date !='0'){
         var nob = res[0].appointment_date;
         var ymdw = new Date(nob * 1000).toJSON().slice(0, 10);
         $('#appointment_date').val(ymdw);
         }
      

 $("#date_medical").val(res[0].medical_status);


if(res[0].medical_status=="medical_unfit_date"){
          var noc = res[0].medical_unfit_date;
          var ymdr = new Date(noc * 1000).toJSON().slice(0, 10);
          $('#medical_fit_date').val(ymdr);

         $("#qvc_remark").val(res[0].medical_unfit_remark );
}
else if(res[0].medical_status=="report_pending"){
          var noc = res[0].report_pending;
          var ymdr = new Date(noc * 1000).toJSON().slice(0, 10);
          $('#medical_fit_date').val(ymdr);

         $("#qvc_remark").val(res[0].report_pending_remark);
}
else if(res[0].medical_status=="reschedule"){
          var noc = res[0].reschedule;
          var ymdr = new Date(noc * 1000).toJSON().slice(0, 10);
          $('#medical_fit_date').val(ymdr);

         $("#qvc_remark").val(res[0].reschedule_remark);
}


  var SITEURL = '{{URL::to('')}}';
         $('#attached_document1_qvc').attr('src',SITEURL+'/documents/Candidate/'+res[0].directory_path+'/'+res[0].attached_document1);
         $('#attached_document2_qvc').attr('src',SITEURL+'/documents/Candidate/'+res[0].directory_path+'/'+res[0].attached_document2);
         $('#attached_document3_qvc').attr('src',SITEURL+'/documents/Candidate/'+res[0].directory_path+'/'+res[0].attached_document3);
      
      


      }
    });

  }

}



function URLqvc1(input, id) {
id = id || '#attached_document1_qvc';
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$(id).attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
$('#attached_document1_qvc').removeClass('hidden');
$('#start').hide();
}
}

function URLqvc2(input, id) {
id = id || '#attached_document2_qvc';
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$(id).attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
$('#attached_document2_qvc').removeClass('hidden');
$('#start').hide();
}
}


function URLqvc3(input, id) {
id = id || '#attached_document3_qvc';
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$(id).attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
$('#attached_document3_qvc').removeClass('hidden');
$('#start').hide();
}
}
// ------------------------QVC Process End----------------------------


// --------------------Visa Start----------------------------
function openVisa(id,visa_id="")
{
     document.getElementById("candidatevisa").value=id;
     document.getElementById("candidate_idforev").value=id;

  if(candidatevisa){

    $.ajax({
      type:"GET",
      url:"{{url('getVisa')}}?visa_id="+visa_id,
      success:function(res){  

        $("#visa_id").val(res[0].visa_id);
        $("#visa_remark").val(res[0].remark);
        $("#vissa_profession").val(res[0].vissa_profession);
        $("#ev_no").val(res[0].ev_no);
        $("#sim_no").val(res[0].sim_no);

        if(res[0].issue_date !='0'){
        var number = res[0].issue_date;
        var ymds = new Date(number * 1000).toJSON().slice(0, 10);
        $('#issue_date').val(ymds);
        }

        if(res[0].expiry_date !='0'){
        var num = res[0].expiry_date;
        var ymd = new Date(num * 1000).toJSON().slice(0, 10);
        $('#expiry_date').val(ymd);
        }

          var SITEURL = '{{URL::to('')}}';
         $('#attached_document1_visa').attr('src',SITEURL+'/documents/Candidate/'+res[0].directory_path+'/'+res[0].attached_document1);
         $('#attached_document2_visa').attr('src',SITEURL+'/documents/Candidate/'+res[0].directory_path+'/'+res[0].attached_document2);
         $('#attached_document3_visa').attr('src',SITEURL+'/documents/Candidate/'+res[0].directory_path+'/'+res[0].attached_document3);
      
      

       }
    });

  }

}

function URLvisa1(input, id) {
id = id || '#attached_document1_visa';
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$(id).attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
$('#attached_document1_visa').removeClass('hidden');
$('#start').hide();
}
}

function URLvisa2(input, id) {
id = id || '#attached_document2_visa';
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$(id).attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
$('#attached_document2_visa').removeClass('hidden');
$('#start').hide();
}
}


function URLvisa3(input, id) {
id = id || '#attached_document3_visa';
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$(id).attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
$('#attached_document3_visa').removeClass('hidden');
$('#start').hide();
}
}
// ------------------------Visa End----------------------------

// --------------------Deployment Start----------------------------
function openDeployment(id,deployment_id="")
{
     document.getElementById("candidatedeployment").value=id;
  
  if(candidatedeployment){

    $.ajax({
      type:"GET",
      url:"{{url('getDeployment')}}?deployment_id="+deployment_id,
      success:function(res){  
        
        $("#deployment_id").val(res[0].deployment_id);

        $("#ticket_no").val(res[0].ticket_no);
        $("#pnr_no").val(res[0].pnr_no);
        $("#flight_no").val(res[0].flight_no);

        if(res[0].departure !='0'){
        var dep_date = res[0].departure;
        var conv = new Date(dep_date * 1000).toJSON().slice(0, 10);
        $('#departure_date').val(conv);
        }

         if(res[0].arrival !='0'){
         var arri_date = res[0].arrival;
         var change = new Date(arri_date * 1000).toJSON().slice(0, 10);
         $('#arrival_date').val(change);
         }

         // $("#departure_time").val(res[0]. departure_time);
         // $("#arrival_time").val(res[0].arrival_time);


         var departuretime = res[0].departure_time;
         var deptime = new Date(departuretime * 1000).toISOString().substr(11, 8);
         $('#departure').val(deptime);

         var atime = res[0].arrival_time;
         var arrtime = new Date(atime * 1000).toISOString().substr(11, 8);
         $('#arrival').val(arrtime);



        $("#duration").val(res[0].duration);
        $("#destination").val(res[0].destination);
    
      
       

  $("#pcr_test").val(res[0].pcr_test);


if(res[0].pcr_test=="positive"){
          var postive = res[0].positive_date;
        var datechange = new Date(postive * 1000).toJSON().slice(0, 10);
        $('#positive_date').val(datechange);

        
}
else if(res[0].pcr_test=="negative"){
          var negative = res[0].negative_date;
        var dateformat = new Date(negative * 1000).toJSON().slice(0, 10);
        $('#positive_date').val(dateformat);

       
}


 var SITEURL = '{{URL::to('')}}';
    $('#attached_document1_depmnt').attr('src',SITEURL+'/documents/Candidate/'+res[0].directory_path+'/'+res[0].attached_document1);
    $('#attached_document2_depmnt').attr('src',SITEURL+'/documents/Candidate/'+res[0].directory_path+'/'+res[0].attached_document2);
    $('#attached_document3_depmnt').attr('src',SITEURL+'/documents/Candidate/'+res[0].directory_path+'/'+res[0].attached_document3);
      

     



      }
    });

  }

}


function URLdeployment1(input, id) {
id = id || '#attached_document1_depmnt';
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$(id).attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
$('#attached_document1_depmnt').removeClass('hidden');
$('#start').hide();
}
}

function URLdeployment2(input, id) {
id = id || '#attached_document2_depmnt';
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$(id).attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
$('#attached_document2_depmnt').removeClass('hidden');
$('#start').hide();
}
}


function URLdeployment3(input, id) {
id = id || '#attached_document3_depmnt';
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$(id).attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
$('#attached_document3_depmnt').removeClass('hidden');
$('#start').hide();
}
}
// ------------------------Deployment End----------------------------



// --------------------Call Status Start----------------------------
function openCallStatus(id,call_status_id="")
{
     document.getElementById("candidatecallstatus").value=id;
  
  if(candidatecallstatus){

    $.ajax({
      type:"GET",
      url:"{{url('getCallStatus')}}?call_status_id="+call_status_id,
      success:function(res){  
        
        $("#call_status_id").val(res[0].call_status_id);
        $("#call_type_id").val(res[0].call_type_id);
       // $("#remark").val(res[0].remark);
        $("#show_remark").val(res[0].show_remark);


      }
    });

  }

}
// ------------------------Call Status End----------------------------















  $(function(e){
$('th input[type="checkbox"]').change(function() {
    if ($(this).prop('checked')) {
       
        $(this).closest('table').find('input[type="checkbox"]').prop('checked', true);
    } else {
       
        $(this).closest('table').find('input[type="checkbox"]').prop('checked', false);

    }
});




      $("#SelectedRecord").click(function(e){
          e.preventDefault();
          var allids =[];


          $("input:checkbox[name=checkArrays]:checked").each(function(){
             //alert($(this).val());
            allids.push($(this).val());
             })

  if(allids.length <=0)
            {
                alert("Please select atleast one record to export.");
            }  else {
                   var check = confirm("Are you sure, you want to export the selected records?");
                if(check == true){



            var join_selected_values=allids.join(",");
           //document.getElementById("multipleids").value = join_selected_values;


             $.ajax({
                     type:"GET",
                     url:'//45.79.124.136/Goresource/GO/public/Personalexport',
                     data: 'id='+join_selected_values,
                     success: function (data) {
                     window.location="{{url('Personalexport')}}?id="+join_selected_values;
                    }
                });


}
}
         

        })
   }); 


//----------------------------------Send Mail Start--------------------------------------


   $(function(e){
        $("#chkCheckAll").click(function(){
          $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        })

        $("#CandidateEmail").on('click',function(e){
          e.preventDefault();
          
          var allids =[];

    
          $("input:checkbox[name=checkArrays]:checked").each(function(){
           // alert($(this).val());
            allids.push($(this).val());
           })


          if(allids.length <=0)
            {
                alert("Please select atleast one record to send mail.");
                return false;
            } 
          else {

            var join_selected_values=allids.join(",");
             //alert(join_selected_values);
            document.getElementById("candidate_emailid").value = join_selected_values;

             }

          

        })
       });

//----------------------------------Send Mail End--------------------------------------


//----------------------------------Send Sms Start--------------------------------------
$(function(e){
        $("#chkCheckAll").click(function(){
          $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        })

        $("#CandidateSms").on('click',function(e){
          e.preventDefault();
          
          var allids =[];

    
          $("input:checkbox[name=checkArrays]:checked").each(function(){
           // alert($(this).val());
            allids.push($(this).val());
           })


          if(allids.length <=0)
            {
                alert("Please select atleast one record to send sms.");
                return false;
            } 
          else {

            var join_selected_values=allids.join(",");
             //alert(join_selected_values);
            document.getElementById("candidate_smsid").value = join_selected_values;

                }

        })
});

//----------------------------------Send Sms End--------------------------------------
</script> 
@stop
