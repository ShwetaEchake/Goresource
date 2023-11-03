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
    width: 16px;
    height: 16px;
  }
input#age1 {
   transform: scale(2);
}

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
                                <th>Name</th> 
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Citizenship</th> 
                                <th>Merital Status</th>
                                <th>Religion</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                       </thead>";

 


foreach($results as $candidate){
 $countryname = Country::where(['country_id'=>$candidate->citizenship])->first();

$candidate_id=$candidate->candidate_id;


// ----------Job Applied------------

if($candidate->current_status=='applied' ){ 

   $mSTRapplieds.="<tbody >
                               <tr>
                                <td><input type='checkbox' id='chkPassport' name='checkArrya[{{$candidate->candidate_id}}]' class='checkBoxClass' value=''/></td>
                                  <td>". $candidate->name."</td> 
                                  <td>". $candidate->age."</td>
                                  <td>". $candidate->gender."</td>
                                  <td>". $countryname->country_name."</td> 
                                  <td>". $candidate->merital_status."</td>
                                  <td>". $candidate->religion."</td>
                                  <td>". $candidate->current_status."</td>

				                           <td>
                                        <a href='status-update/$candidate_id' onclick=\"return confirm(' Are you sure you want to Shortlist Candidate?')\" class='btn btn-success'>Select</a><br><br>

                                        <a href='#' class='btn btn-danger'>Reject </a><br><br>

                                        <button  class='btn btn-primary'  onclick='openPopup($candidate_id)' data-toggle='modal' data-target='#call'> Call</button>
                                  </td>
                              </tr>
                        </tbody>";


// ----------Assessment------------

} if($candidate->current_status=='shortlist'){ 


	$mSTRassessment.="<tbody>
                              <tr>
                                 <td><input type='checkbox' id='chkPassport' name='checkArrya[{{$candidate->candidate_id}}]' class='checkBoxClass' value=''/></td>
                                  <td>". $candidate->name."</td> 
                                  <td>". $candidate->age."</td>
                                  <td>". $candidate->gender."</td>
                                  <td>". $countryname->country_name."</td> 
                                  <td>". $candidate->merital_status."</td>
                                  <td>". $candidate->religion."</td>
                                  <td>". $candidate->current_status."</td>
                                
				                          <td>
                                        <button  class='btn btn-sm btn-info'>$candidate->assessmentstatus</button><br><br>

                                        <button type='button' onclick='openPopup($candidate_id)' class='btn btn-warning' data-toggle='modal' data-target='.bd-example-modal-lg'>Assess Now</button><br><br>

                                        <button  class='btn btn-warning'  onclick='openPopup($candidate_id)'  data-toggle='modal' data-target='#call'> Call</button><br><br>
                                     
                                  </td>
                              </tr>
                        </tbody>";

}  
// if($candidate->current_status=='selected'){ 

//   $mSTRpostassessment.="<tbody>
//                               <tr>
//                                  <td><input type='checkbox' id='chkPassport' name='checkArrya[{{$candidate->candidate_id}}]' class='checkBoxClass' value=''/></td>
//                                   <td>". $candidate->name."</td> 
//                                   <td>". $candidate->age."</td>
//                                   <td>". $candidate->gender."</td>
//                                   <td>". $countryname->country_name."</td> 
//                                   <td>". $candidate->merital_status."</td>
//                                   <td>". $candidate->religion."</td>
//                               </tr>
//                         </tbody>";

// } 


// ----------Enrollment------------

if($candidate->current_status=='selected'){ 

  $mSTRenrollment.="<tbody>
                              <tr>
                               <td><input type='checkbox' id='chkPassport' name='checkArrya[{{$candidate->candidate_id}}]' class='checkBoxClass' value=''/></td>
                                  <td>". $candidate->name."</td> 
                                  <td>". $candidate->age."</td>
                                  <td>". $candidate->gender."</td>
                                  <td>". $countryname->country_name."</td> 
                                  <td>". $candidate->merital_status."</td>
                                  <td>". $candidate->religion."</td>
                                  <td>". $candidate->current_status."</td>
                                   <td>
                                        <button  class='btn btn-warning' data-toggle='modal' data-target='#showinterview'> Send Interview Detail</button><br><br>
                                     
                                        <a href='update_status/$candidate_id' onclick=\"return confirm(' Are you sure you want to Confirm Interview?')\" class='btn btn-warning'>Confirm Interview</a><br><br>

                                        <button  class='btn btn-warning'  onclick='openPopup($candidate_id)' data-toggle='modal' data-target='#call'> Call</button>
                                  </td>
                              </tr>
                        </tbody>";

} 
//----------Interview-------------------

 if($candidate->current_status=='confirm'){ 

  $mSTRinterview.="<tbody>
                              <tr>
                                 <td><input type='checkbox' id='chkPassport' name='checkArrya[{{$candidate->candidate_id}}]' class='checkBoxClass' value=''/></td>
                                  <td>". $candidate->name."</td> 
                                  <td>". $candidate->age."</td>
                                  <td>". $candidate->gender."</td>
                                  <td>". $countryname->country_name."</td> 
                                  <td>". $candidate->merital_status."</td>
                                  <td>". $candidate->religion."</td>
                                  <td>". $candidate->current_status."</td>
                                   <td>

                                           <button  class='btn btn-sm btn-info'>$candidate->postassessmentstatus</button><br><br>
                                           
                                           <button type='button' onclick='openPopup($candidate_id)' class='btn btn-warning' data-toggle='modal' data-target='.bdd-example-modal-lg'>Interview Now</button><br><br>

                                           <button  class='btn btn-warning'> Show Interview</button>

                                           <button  class='btn btn-warning'  onclick='openPopup($candidate_id)' data-toggle='modal' data-target='#call'> Call</button>
                                  </td>
                              </tr>
                        </tbody>";
} 
// ----------Selection------------

 if($candidate->current_status=='selection'){ 

  $mSTRselection.="<tbody>
                              <tr>
                                 <td><input type='checkbox' id='chkPassport' name='checkArrya[{{$candidate->candidate_id}}]' class='checkBoxClass' value=''/></td>
                                  <td>". $candidate->name."</td> 
                                  <td>". $candidate->age."</td>
                                  <td>". $candidate->gender."</td>
                                  <td>". $countryname->country_name."</td> 
                                  <td>". $candidate->merital_status."</td>
                                  <td>". $candidate->religion."</td>
                                  <td>". $candidate->current_status."</td>
                                  <td>
                                        

                                          <button type='button' onclick='openPopup($candidate_id)' class='btn btn-warning' data-toggle='modal' data-target='#offers'>
                                            Send Offer Letter
                                          </button><br><br>


                                       <button  class='btn btn-warning'  onclick='openPopup($candidate_id)' data-toggle='modal' data-target='#call'> Call</button>
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
                                 <td><input type='checkbox' id='chkPassport' name='checkArrya[{{$candidate->candidate_id}}]' class='checkBoxClass' value=''/></td>
                                  <td>". $candidate->name."</td> 
                                  <td>". $candidate->age."</td>
                                  <td>". $candidate->gender."</td>
                                  <td>". $countryname->country_name."</td> 
                                  <td>". $candidate->merital_status."</td>
                                  <td>". $candidate->religion."</td>
                                  <td>". $candidate->current_status."</td>
                                  <td>

                                          <button type='button' onclick='openPopup($candidate_id)' class='btn btn-warning' data-toggle='modal' data-target='#medical'>
                                          Upload Pre Medical record
                                            </button><br><br>


                                         <button  class='btn btn-warning'  onclick='openPopup($candidate_id)' data-toggle='modal' data-target='#call'> Call</button>
                                  </td>
                              </tr>
                        </tbody>";
} 
// -------Medical---------------


 if($candidate->current_status=='medical_fit'){ 

  $mSTRpremedical.="<tbody>
                              <tr>
                                  <td><input type='checkbox' id='chkPassport' name='checkArrya[{{$candidate->candidate_id}}]' class='checkBoxClass' value=''/></td>
                                  <td>". $candidate->name."</td> 
                                  <td>". $candidate->age."</td>
                                  <td>". $candidate->gender."</td>
                                  <td>". $countryname->country_name."</td> 
                                  <td>". $candidate->merital_status."</td>
                                  <td>". $candidate->religion."</td>
                                  <td>". $candidate->current_status."</td>
                                  <td>
                                           

                                             <button type='button' onclick='openPopup($candidate_id)' class='btn btn-warning'      data-toggle='modal' data-target='#qvc'>
                                                Create Qvc
                                             </button>

                                             <button  class='btn btn-warning'  onclick='openPopup($candidate_id)' data-toggle='modal' data-target='#call'> Call</button>
                                  </td>
                              </tr>
                        </tbody>";
} 
// -------QVC---------------

 if($candidate->current_status=='qvc'){ 

  $mSTRqvc.="<tbody>
                              <tr>
                                 <td><input type='checkbox' id='chkPassport' name='checkArrya[{{$candidate->candidate_id}}]' class='checkBoxClass' value=''/></td>
                                  <td>". $candidate->name."</td> 
                                  <td>". $candidate->age."</td>
                                  <td>". $candidate->gender."</td>
                                  <td>". $countryname->country_name."</td> 
                                  <td>". $candidate->merital_status."</td>
                                  <td>". $candidate->religion."</td>
                                  <td>". $candidate->current_status."</td>
                                  <td>
                                        
                                         <button type='button' onclick='openPopup($candidate_id)' class='btn btn-warning' data-toggle='modal' data-target='#visa'>
                                           Process  Visa
                                         </button>

                                        <button  class='btn btn-warning'  onclick='openPopup($candidate_id)' data-toggle='modal' data-target='#call'> Call</button>
                                  </td>
                              </tr>
                        </tbody>";
} 

// -------Visa---------------

 if($candidate->current_status=='visa'){ 

  $mSTRvisa.=" <tbody>
                              <tr>
                                 <td><input type='checkbox' id='chkPassport' name='checkArrya[{{$candidate->candidate_id}}]' class='checkBoxClass' value=''/></td>
                                  <td>". $candidate->name."</td> 
                                  <td>". $candidate->age."</td>
                                  <td>". $candidate->gender."</td>
                                  <td>". $countryname->country_name."</td> 
                                  <td>". $candidate->merital_status."</td>
                                  <td>". $candidate->religion."</td>
                                  <td>". $candidate->current_status."</td>
                                  <td>
                                        
                                      <a href='#' class='btn btn-warning'>Upload Visa</a><br><br>
                                      <a href='#' class='btn btn-warning'>Upload Tickets</a><br><br>
                                      <a href='#' class='btn btn-warning'>Upload Approval Letter</a><br><br>
                                      <a href='#' class='btn btn-warning'>Upload AOU</a><br><br>
                                      <button  class='btn btn-warning'  onclick='openPopup($candidate_id)' data-toggle='modal' data-target='#call'> Call</button>
                                  </td>
                              </tr>
                        </tbody>";
} 
// -------Deployment---------------

 if($candidate->current_status=='deployment'){ 

  $mSTRdeployment.="<tbody>
                              <tr>
                                 <td><input type='checkbox' id='chkPassport' name='checkArrya[{{$candidate->candidate_id}}]' class='checkBoxClass' value=''/></td>
                                  <td>". $candidate->name."</td> 
                                  <td>". $candidate->age."</td>
                                  <td>". $candidate->gender."</td>
                                  <td>". $countryname->country_name."</td> 
                                  <td>". $candidate->merital_status."</td>
                                  <td>". $candidate->religion."</td>
                                  <td>". $candidate->current_status."</td>
                                  <td><a href='#' class='btn btn-warning'>Download Profile</a><br>
                                  </td>
                              </tr>
                        </tbody>";
} 


}


?>
@section('content')

 {{-- <a href='{{url("/status-update",1)}}' class='btn btn-success'>Active</a>--}}

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

                                <input type="hidden" name="q" value="applied">


                               <div class="col-lg-3" style="margin-top: 5px;"><br>
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
}else{
  $client_id="";
  $enquiry_id="";
  $job_id="";
}
?>
 

                               <input type="hidden" name="client_id" value="{{($client_id)}}">
                               <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}">
                               <input type="hidden" name="job_id" value="{{($job_id)}}">
                               <input type="hidden" name="candidatecallstatus" id="candidatecallstatus" >

                            
                               <label> Call Type  </label>
                                <select class="form-control select2" name="call_type_id" id="call_type_id" required>
                                <option value="">-Select-</option>
                                @foreach ($calltypes as $calltype)
                                    <option value="{{ $calltype->call_type_id }}">{{ $calltype->call_type }}</option>
                                 @endforeach
                              </select>   
                              <br>

                              <label> Remark  </label>
                              <input type="text" name="remark"  id="remark" class="form-control" value="{{ old('remark') }}" required >
                              <br>

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






<div class="row">
       
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
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-qvc" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">QVC</a>
                  </li>
               <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-visa" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Visa</a>
                  </li>
              <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-deployment" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Deploymnt</a>
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

    </div>
    <!-- /.card-body -->
  </div>








<!-------------------------- Modal INTERVIEW FORM -------------------------------------->
<div class="modal fade" id="showinterview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Interview Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
         <form method="POST" action="{{ route('interview.store' ) }}">
              @csrf

       <div class="row">
                <div class="col-lg-6">
                <label> Date </label>
                <input type="date" name="interview_date"  id="interview_date" class="form-control @error('interview_date') is-invalid @enderror" value="{{ old('interview_date')  }}" required >
                @error('interview_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-6">
                <label>  Start Time  </label>
                <input type="time" name="start_time"  id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time')  }}"  required >
                @error('start_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br>
                </div>

                <div class="col-lg-6">
                <label> End Time</label>
                <input type="time"  name="end_time"  id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time') }}" required >
                @error('end_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
     </div> <br>


     <div class="row">
                <div class="col-lg-4">
                <label>  Venu </label>
                <input type="text" name="interview_venu"  id="interview_venu" class="form-control @error('interview_venu') is-invalid @enderror" value="{{ old('interview_venu')  }}"  required >
                @error('interview_venu')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label>City </label>
                <input type="text"  name="interview_city"  id="interview_city" class="form-control @error('interview_city') is-invalid @enderror" value="{{ old('interview_city') }}" required >
                @error('interview_city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label>  State</label>
                <input type="text"  name="interview_state"  id="interview_state" class="form-control @error('interview_state') is-invalid @enderror" value="{{ old('interview_state')  }}" required >
                @error('interview_state')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
    </div><br>



        <div class="row">
                 <div class="col-lg-4">
                <label> Country</label>
                <input type="text"  name="interview_country"  id="interview_country"   class="form-control @error('interview_country') is-invalid @enderror" value="{{ old('interview_country')  }}" required >
                @error('interview_country')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label> Zipcode </label>
                <input type="text"  name="interview_zipcode"  id="interview_zipcode"  class="form-control @error('interview_zipcode') is-invalid @enderror" value="{{ old(' interview_zipcode') }}" required >
                @error('interview_zipcode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                 <div class="col-lg-4">
                <label> Name </label>
                <input type="text"  name="interviewer_name"  id="interviewer_name"  class="form-control @error('interviewer_name') is-invalid @enderror" value="{{ old('interviewer_name')  }}" required >
                @error('interviewer_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>
       </div><br>


     <div class="row">
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
        <button type="button" class="btn btn-primary">Save changes</button>
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


    <div class="modal-body">
   <!--   <form method="POST" action="{{ route('assessment.store' ) }}">
              @csrf -->
<?php

$result = '<p id="assess_id"></p>';       
$assessment=Assessment::where('assessment_id',$result)->first();

?>
           @if(isset($result))

            <form class="form-horizontal" method="POST" action="{{ route('assessment.update',$result) }}">
                    @csrf
                    @method('PUT')
               
        
           @else
           <form class="form-horizontal" method="POST" action="{{ route('assessment.store') }}">
                    @csrf
               
           @endif


         
                               <input type="hidden" name="client_id" value="{{($client_id)}}">
                               <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}">
                               <input type="hidden" name="job_id" value="{{($job_id)}}">
                               <input type="hidden" name="candidateidassessment" id="candidateidassessment" >
                               <input type="hidden" value="Pre" name="assessment_type" id="assessment_type" >

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

    <?php if (isset($assessment->personality_appearence) && $ $assessment->personality_appearence=="INEFFECTIVE") echo "checked";?>
    value="INEFFECTIVE">INEFFECTIVE

     </td>

      <td> <!-- NEEDSIMPROVMENT  -->
        <input type="radio"   name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" 
         value="NEEDSIMPROVMENT" {{ $assessment->personality_appearence == 'NEEDSIMPROVMENT' ? 'checked' : '' }} >
     </td>

      <td> <!--  GOOD -->
        <input type="radio"   name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror"  
        value="GOOD"  {{ $assessment->personality_appearence == 'GOOD' ? 'checked' : '' }} >
     </td>

      <td> <!--  VERYGOOD -->
        <input type="radio"   name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" 
        value="VERYGOOD" {{ $assessment->personality_appearence == 'VERYGOOD' ? 'checked' : '' }} >
     </td>

      <td><!-- EXCELLENT -->
        <input type="radio"  name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" 
        value="EXCELLENT" {{ $assessment->personality_appearence == 'EXCELLENT' ? 'checked' : '' }} >
      </td>
      <td>
        <input type="text"  name="personality_remark"  id="personality_remark"   class="form-control @error('personality_remark') is-invalid @enderror" value="{{$assessment->personality_remark  }}" >
     </td>
   </tr>

 <tr>
    <td>Knowladge & Technical Skills:</td>
    <td>
        <input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" 
        value="INEFFECTIVE" {{ $assessment->knowledge == 'INEFFECTIVE' ? 'checked' : '' }} >
    </td>
    <td>
        <input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" 
        value="NEEDSIMPROVMENT"  {{ $assessment->knowledge == 'NEEDSIMPROVMENT' ? 'checked' : '' }} >
    </td>
    <td>
    <input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" 
    value="GOOD" {{ $assessment->knowledge == 'GOOD' ? 'checked' : '' }} >
   </td>
    <td>
        <input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" value="VERYGOOD"   {{ $assessment->knowledge == 'VERYGOOD' ? 'checked' : '' }} >
    </td>
    <td>
        <input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror"
        value="EXCELLENT"  {{ $assessment->knowledge == 'EXCELLENT' ? 'checked' : '' }} >
    </td>
    <td>
        <input type="text"  name="knowledge_remark"  id="knowledge_remark" class="form-control @error('knowledge_remark') is-invalid @enderror" value="{{$assessment->knowledge_remark  }}" >
    </td>
 </tr>
    
  <tr>
     <td>Initiative & Leadership:</td>
    <td><input type="radio"  name="ledership"  id="Ledership"  class="form-control @error('Ledership') is-invalid @enderror"   
        value="INEFFECTIVE" {{ $assessment->ledership == 'INEFFECTIVE' ? 'checked' : '' }} >
    </td>
    <td>
        <input type="radio"  name="ledership"  id="Ledership"  class="form-control @error('Ledership') is-invalid @enderror" 
        value="NEEDSIMPROVMENT"  {{ $assessment->ledership == 'NEEDSIMPROVMENT' ? 'checked' : '' }} >
    </td>
    <td>
     <input type="radio"  name="ledership"  id="Ledership"  class="form-control @error('Ledership') is-invalid @enderror" 
     value="GOOD" {{ $assessment->ledership == 'GOOD' ? 'checked' : '' }} >
   </td>
    <td>
    <input type="radio"  name="ledership"  id="Ledership"  class="form-control @error('Ledership') is-invalid @enderror" 
    value="GOOD" {{ $assessment->ledership == 'VERYGOOD' ? 'checked' : '' }} >
    </td>
    <td>
        <input type="radio"  name="ledership"  id="Ledership"  class="form-control @error('Ledership') is-invalid @enderror"  
        value="EXCELLENT"  {{ $assessment->ledership == 'EXCELLENT' ? 'checked' : '' }} >
    </td>
    <td>
        <input type="text"  name="leadership_remark"  id="leadership_remark" class="form-control @error('leadership_remark') is-invalid @enderror" value="{{ $assessment->leadership_remark  }}" >
    </td>
  </tr>
    
 <tr>
    <td>English Communication</td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror"   value="INEFFECTIVE" {{ $assessment->communication == 'INEFFECTIVE' ? 'checked' : '' }} >
    </td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror"   value="NEEDSIMPROVMENT"  {{ $assessment->communication == 'NEEDSIMPROVMENT' ? 'checked' : '' }} >
    </td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror"   value="GOOD" {{ $assessment->communication == 'GOOD' ? 'checked' : '' }} >
    </td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror"   value="GOOD" {{ $assessment->communication == 'VERYGOOD' ? 'checked' : '' }} >
    </td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror"    value="EXCELLENT"  {{ $assessment->communication == 'EXCELLENT' ? 'checked' : '' }} >
    </td>
    <td><input type="text"  name="communication_remark"  id="communication_remark" class="form-control @error('communication_remark') is-invalid @enderror" value="{{ $assessment->communication_remark }}" ></td>
</tr>

  <tr>
    <td>Others (Please Spacify)</td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="INEFFECTIVE" {{ $assessment->other_assessment == 'INEFFECTIVE' ? 'checked' : '' }} >
    </td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment" class="form-control @error('other_assessment') is-invalid @enderror" value="NEEDSIMPROVMENT"  {{ $assessment->other_assessment == 'NEEDSIMPROVMENT' ? 'checked' : '' }} >
    </td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror"value="GOOD" {{ $assessment->other_assessment == 'GOOD' ? 'checked' : '' }} >
    </td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="GOOD" {{ $assessment->other_assessment == 'VERYGOOD' ? 'checked' : '' }} >
    </td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="EXCELLENT"  {{ $assessment->other_assessment == 'EXCELLENT' ? 'checked' : '' }} >
    </td>
    <td><input type="text"  name="other_assessment_remark" id="other_assessment_remark"   class="form-control @error('other_assessment_remark') is-invalid @enderror" value="{{ $assessment->other_assessment_remark  }}" ></td>
 </tr>

</tbody>
</table>




<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">
<thead><tr><th colspan="7">Education</th></tr></thead>
<tbody>
<tr><td>DEGREE OBTAINED</td> <td colspan="6">
    <input type="text"  name="degree_optain"  id="degree_optain"   class="form-control @error('degree_optain') is-invalid @enderror" 
    value="{{ $assessment->degree_optain  }}" >
</td></tr>
 <tr><td>PROFFETIONAL LICENSE NO.</td><td colspan="6">
    <input type="text"  name="professional_licence_no"  id="professional_licence_no"  class="form-control @error('professional_licence_no') is-invalid @enderror" value="{{ $assessment->professional_licence_no }}" >
</td></tr>
  <tr><td>TECHNICAL QUALIFICATION</td><td colspan="6">
    <input type="text"  name="technical_qualification"  id="technical_qualification"  class="form-control @error('technical_qualification') is-invalid @enderror" value="{{ $assessment->technical_qualification }}" >
</td></tr>
  <tr><td>KEY SKILLS</td><td colspan="6">
    <input type="text"  name="key_skill"  id="key_skill"  class="form-control @error('key_skill') is-invalid @enderror" value="{{ $assessment->key_skill }}" ></td></tr>
  <tr><td>TRADE TEST</td><td colspan="6">
    <input type="text"  name="trade_test"  id="trade_test"  class="form-control @error('trade_test') is-invalid @enderror" value="{{ $assessment->trade_test }}" required >
</td></tr>
</tbody>
</table>



<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">
<thead><tr><th>LANGVAGE USED</th> <th>English</th><th>Hindi</th><th  colspan="7">Others</th></tr></thead>
<tbody>
<tr><td>RATINFG</td> <td><select class="form-control valdation_select" name="languge_used[]">
    <option value=''> -Select- </option>  
     <option value='G'  <?=isset($assessment->languge_used) && $assessment->languge_used == 'G' ? '  selected':""?> > GOOD </option>   
     <option value='VG'  <?=isset($assessment->languge_used) && $assessment->languge_used == 'VG' ? '  selected':""?> > Very GOOD </option>   
     <option value='EX'  <?=isset($assessment->languge_used) && $assessment->languge_used == 'EX' ? '  selected':""?> > Excellent </option>   
                        
</select></td>
                    <td>
          <select class="form-control valdation_select" name="languge_used1[]">
                        <option value=''> -Select- </option>  
                        <option value='G' <?=isset($assessment->languge_used1) && $assessment->languge_used1 == 'G' ? '  selected':""?> >  Good </option>  
                        <option  <?=isset($assessment->languge_used1) && $assessment->languge_used1 == 'VG' ? '  selected':""?> > Very Good</option>   
                        <option  <?=isset($assessment->languge_used1) && $assessment->languge_used1 == 'EX' ? '  selected':""?> > Excellent</option>  
         </select>
        </td><td colspan="4"><input type="text"  name="languge_used2"  id="languge_used2"  class="form-control @error('languge_used') is-invalid @enderror" value="{{ $assessment->languge_used2 }}" ></td></tr>
</tbody>
</table>




<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">
<thead><tr><th colspan="7">WORK EXPERIANCE</th> </tr>
<tr><th></th> <th colspan="3">POSITION HELD</th><th colspan="3">TOTAL YEARS/MONTHS</th></tr></thead>
<tbody>
<tr><td>LOCAL</td> <td colspan="3">
    <input type="text"  name="local_work_experience"  id="local_work_experience"  class="form-control @error('local_work_experience') is-invalid @enderror" value="{{ $assessment->local_work_experience }}" >
</td>
  <td colspan="3">
    <input type="text"  name="local_experience_year"  id="local_experience_year"  class="form-control @error('local_experience_year') is-invalid @enderror" value="{{ $assessment-> local_experience_year }}" >
</td></tr>

<tr><td>OVERSEAS</td> 
  <td colspan="3">
    <input type="text"  name="overseas_expereicne"  id="overseas_expereicne"  class="form-control @error('overseas_expereicne') is-invalid @enderror" value="{{ $assessment->overseas_expereicne }}" >
</td>
  <td colspan="3">
    <input type="text"  name="overseaase_year"  id="overseaase_year"  class="form-control @error('overseaase_year') is-invalid @enderror" value="{{ $assessment->overseaase_year }}" >
</td></tr>
</tbody>
</table>



<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">
<thead><tr><th colspan="7">
OVERALL ASSESSMENT</th></tr></thead>
<tbody>
<tr> <td><center><label for="age1">Selected</label><br><input type="radio" id="age1" name="overall_assessment"
 value="selected" {{ $assessment->overall_assessment == 'selected' ? 'checked' : '' }} >
  <td><center><label for="age1">Reserved</label><br><input type="radio" id="age1" name="overall_assessment" 
    value="reserved" {{ $assessment->overall_assessment == 'reserved' ? 'checked' : '' }} ></center>
  </td>
  <td> <center><label for="age1">Rejected</label><br><input type="radio" id="age1" name="overall_assessment"
   value="rejected" {{ $assessment->overall_assessment == 'rejected' ? 'checked' : '' }} ></center>
 </td>
  <td><center> <label for="age1">Others</label><br><input type="radio" id="age1" name="overall_assessment" 
    value="others" {{ $assessment->overall_assessment == 'others' ? 'checked' : '' }} ></center>
 </td>
  <td colspan="3">
     <label for="age1">Overall Rating%</label><br><input type="number" id="age2" name="overall_rating" class="form-control" value="{{$assessment->overall_rating}}">
 </td></tr>
</tbody>
</table>



<table id="dynamicAddRemove" class="" width="100%">
<thead>
  <tr><th>Remarks</th></tr>
</thead>
<tbody>
  <tr><td><textarea type="text"  name="remark"  id="remark"  class="form-control @error('remark') is-invalid @enderror" value="" >{{ $assessment->remark }}</textarea></td></tr>
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

<div class="modal fade" id="enrollment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
</div>
<!--------------------------Enrollment Model Start------------------------------>


<!-- --------------------------Interview Modal End --------------------------------->

<div class="modal fade bdd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelpost" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabelpost">Post Assessment</h5>
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
                               <input type="hidden" name="candidatepostassessment" id="candidatepostassessment" >
                               <input type="hidden" value="Post" name="assessment_type" id="assessment_type" >

<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%" >

<thead><tr>
        <th width="30%">Rating</th>
          <th width="7%">1</th>
          <th width="7%">2</th>
          <th width="7%">3</th>
          <th width="7%">4</th>
          <th width="7%">5</th>
          <th width="40">Remarks</th>
        </tr></thead>
          <tbody>
            <tr>
    <td>Personality Apperance/Attitude:</td>
    <td><input type="radio"   name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" value="INEFFECTIVE" ></td>
    <td><input type="radio"   name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" value="NEEDSIMPROVMENT" ></td>
    <td><input type="radio"   name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" value="GOOD" ></td>
    <td><input type="radio"   name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" value="VERYGOOD" ></td>
    <td><input type="radio"  name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" value="EXCELLENT" ></td>

    <td><input type="text"  name="personality_remark"  id="personality_remark"   class="form-control @error('personality_remark') is-invalid @enderror" value="{{ old('personality_remark')  }}" ></td>
     </tr>
     <tr>
      <td>Knowladge & Technical Skills:</td>
      <td><input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" value="INEFFECTIVE" ></td>
    <td><input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" value="NEEDSIMPROVMENT" ></td>
    <td><input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" value="GOOD" ></td>
    <td><input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" value="VERYGOOD" ></td>
    <td><input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" value="EXCELLENT" ></td>
  
    <td><input type="text"  name="knowledge_remark"  id="knowledge_remark" class="form-control @error('knowledge_remark') is-invalid @enderror" value="{{ old('knowledge_remark')  }}" ></td>
     </tr>
    
      <tr>
      <td>Initiative & Leadership:</td>
         <td><input type="radio"  name="ledership"  id="Ledership"  class="form-control @error('Ledership') is-invalid @enderror" value="INEFFECTIVE" ></td>
    <td><input type="radio"  name="ledership"  id="Ledership"  class="form-control @error('Ledership') is-invalid @enderror" value="NEEDSIMPROVMENT" ></td>
    <td><input type="radio"  name="ledership"  id="Ledership"  class="form-control @error('Ledership') is-invalid @enderror" value="GOOD" ></td>
    <td><input type="radio"  name="ledership"  id="Ledership"  class="form-control @error('Ledership') is-invalid @enderror" value="VERYGOOD" ></td>
    <td><input type="radio"  name="ledership"  id="Ledership"  class="form-control @error('Ledership') is-invalid @enderror" value="EXCELLENT" ></td>

    <td><input type="text"  name="leadership_remark"  id="leadership_remark" class="form-control @error('leadership_remark') is-invalid @enderror" value="{{ old('leadership_remark')  }}" ></td>
     </tr>
    
      <tr>
      <td>English Communication</td>
    
        <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror" value="INEFFECTIVE" ></td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror" value="NEEDSIMPROVMENT" ></td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror" value="GOOD" ></td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror" value="VERYGOOD" ></td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror" value="EXCELLENT" ></td>

    <td><input type="text"  name="communication_remark"  id="communication_remark" class="form-control @error('communication_remark') is-invalid @enderror" value="{{ old('communication_remark')  }}" ></td>
     </tr>
     <tr>
      <td>Others (Please Spacify)</td>
      
         <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="INEFFECTIVE" ></td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment" class="form-control @error('other_assessment') is-invalid @enderror" value="NEEDSIMPROVMENT" ></td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="GOOD" ></td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="VERYGOOD" ></td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="EXCELLENT" ></td>


    <td><input type="text"  name="other_assessment_remark" id="other_assessment_remark"   class="form-control @error('other_assessment_remark') is-invalid @enderror" value="{{ old('other_assessment_remark')  }}" ></td>
     </tr>
</tbody>
</table>

<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">

<thead><tr><th colspan="7">Education</th></tr></thead>
<tbody>
<tr><td>DEGREE OBTAINED</td> <td colspan="6"><input type="text"  name="degree_optain"  id="degree_optain"   class="form-control @error('degree_optain') is-invalid @enderror" value="{{ old('degree_optain')  }}" ></td></tr>
 <tr><td>PROFFETIONAL LICENSE NO.</td><td colspan="6"><input type="text"  name="professional_licence_no"  id="professional_licence_no"  class="form-control @error('professional_licence_no') is-invalid @enderror" value="{{ old(' professional_licence_no') }}" ></td></tr>
  <tr><td>TECHNICAL QUALIFICATION</td><td colspan="6"><input type="text"  name="technical_qualification"  id="technical_qualification"  class="form-control @error('technical_qualification') is-invalid @enderror" value="{{ old(' technical_qualification') }}" ></td></tr>

  <tr><td>KEY SKILLS</td><td colspan="6"><input type="text"  name="key_skill"  id="key_skill"  class="form-control @error('key_skill') is-invalid @enderror" value="{{ old(' key_skill') }}" ></td></tr>
  <tr><td>TRADE TEST</td><td colspan="6"><input type="text"  name="trade_test"  id="trade_test"  class="form-control @error('trade_test') is-invalid @enderror" value="{{ old('trade_test')  }}" required ></td></tr>

</tbody>

</table>

<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">


<thead><tr><th>LANGVAGE USED</th> <th>English</th><th>Hindi</th><th  colspan="4">Others</th></tr></thead>
<tbody>
<tr><td>RATINFG</td> <td><select class="form-control valdation_select" name="languge_used[]">
                        <option value=''> -Select- </option>  
                        <option value='G' > Good </option>  
                        <option value='VG'> Very Good</option>   
                        <option value='EX' > Excellent </option>  
        </select></td>
        <td>
          <select class="form-control valdation_select" name="languge_used[]">
                        <option value=''> -Select- </option>  
                        <option value='G' > Good </option>  
                        <option value='VG'> Very Good</option>   
                        <option value='EX' > Excellent </option>  
        </select>
        </td><td colspan="4"><input type="text"  name="languge_used"  id="languge_used"  class="form-control @error('languge_used') is-invalid @enderror" value="{{ old(' languge_used') }}" ></td></tr>

</tbody>

</table>

<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">
<thead><tr><th colspan="7">WORK EXPERIANCE</th> </tr>
<tr><th></th> <th colspan="3">POSITION HELD</th><th colspan="3">TOTAL YEARS/MONTHS</th></tr></thead>
<tbody>
<tr><td>LOCAL</td> <td colspan="3"><input type="text"  name="local_work_experience"  id="local_work_experience"  class="form-control @error('local_work_experience') is-invalid @enderror" value="{{ old(' local_work_experience') }}" ></td>
  <td colspan="3"><input type="text"  name="local_experience_year"  id="local_experience_year"  class="form-control @error('local_experience_year') is-invalid @enderror" value="{{ old(' local_experience_year') }}" ></td></tr>

<tr><td>OVERSEAS</td> 
  <td colspan="3"><input type="text"  name="overseas_expereicne"  id="overseas_expereicne"  class="form-control @error('overseas_expereicne') is-invalid @enderror" value="{{ old(' overseas_expereicne') }}" ></td>
  <td colspan="3"><input type="text"  name="overseaase_year"  id="overseaase_year"  class="form-control @error('overseaase_year') is-invalid @enderror" value="{{ old(' overseaase_year') }}" ></td></tr>

</tbody>
</table>

<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">
<thead><tr><th colspan="7">
OVERALL ASSESSMENT</th></tr></thead>
<tbody>
<tr> <td><center><label for="age1">Selected</label><br><input type="radio" id="age1" name="overall_assessment" value="selected">
  </center></td>
  <td><center><label for="age1">Reserved</label><br><input type="radio" id="age1" name="overall_assessment" value="reserved"> </center>
  </td>
  <td><center><label for="age1">Rejected</label><br><input type="radio" id="age1" name="overall_assessment" value="rejected"> </center>
  </td>
  <td> <center> <label for="age1">Others</label><br><input type="radio" id="age1" name="overall_assessment" value="others"> </center>
 </td>
  <td colspan="3">
     <label for="age1">Overall Rating%</label><input type="number" id="age2" name="overall_rating" class="form-control" value="">
 </td></tr>

</tbody>
</table>

<table id="dynamicAddRemove" width="100%">
<thead><tr><th>Remarks</th></tr></thead>
<tbody>
  <tr><td ><textarea type="text"  name="remark"  id="remark"  class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark') }}" ></textarea></td></tr>
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


<!--------------------------Offer Letter Model End------------------------------>
<div class="modal fade" id="offers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Offer Letter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('offerletter.store') }}"  enctype="multipart/form-data">
              @csrf

                   <input type="hidden" name="client_id" value="{{($client_id)}}">
                   <input type="hidden" name="enquiry_id" value="{{($enquiry_id)}}">
                   <input type="hidden" name="job_id" value="{{($job_id)}}">
                   <input type="hidden" name="candidateofferletter" id="candidateofferletter" ><br>
           
       
                       <div class="row">
                        <div class="col-lg-6">
                                <label>Issue Date </label>
                                <input type="date" name="issue_date"  id="issue_date" class="form-control @error('issue_date') is-invalid @enderror" value="{{ old('issue_date') }}" required >
                                @error('issue_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                  <br>
                        </div>
                          <div class="col-lg-6">
                                <label>Signed Date </label>
                                <input type="date" name="signed_date"  id="signed_date" class="form-control @error('signed_date') is-invalid @enderror" value="{{ old('signed_date')  }}"   required >
                                @error('signed_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                  <br>
                        </div>
                          <div class="col-lg-6">
                               <label>Refuse Date </label>
                                <input type="date" name="refuse_date"  id="refuse_date" class="form-control @error('refuse_date') is-invalid @enderror" value="{{ old('refuse_date') }}" required >
                                @error('refuse_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                  <br>
                        </div>
                         
                       </div>
               
           
                <label> Attached Document 1 </label>
                <input type="file" name="attached_document1"  id="  attached_document1" class="form-control @error('  attached_document1') is-invalid @enderror" value="{{ old('attached_document1')  }}"   required >
                @error('attached_document1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                  <br>
            
                <label> Attached Document 2 </label>
                <input type="file" name="attached_document2"  id="attached_document2" class="form-control @error('  attached_document2') is-invalid @enderror" value="{{ old('attached_document2')  }}"   required >
                @error('attached_document2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                  <br>
             
                <label> Attached Document 3 </label>
                <input type="file" name="attached_document3"  id="attached_document3" class="form-control @error('  attached_document3') is-invalid @enderror" value="{{ old('attached_document3')  }}"   required >
                @error('attached_document3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                  <br>

                <label>Remark </label>
                <textarea type="text" name="remark"  id="remark" class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark') }}" required ></textarea>
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
   </div><!-- modal body end -->

   
    </div>
  </div>
</div>
<!--------------------------Offer Letter Model End------------------------------>


<!-- ----------------------Pre Medical Model Start----------------------->

<div class="modal fade" id="medical" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
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
                   <input type="hidden" name="candidatepremedical" id="candidatepremedical" ><br>
    
                    <div class="row">
                      <div class="col-lg-6">
                               <label>Fit Date </label>
                                <input type="date" name="fit_date"  id="fit_date" class="form-control @error('fit_date') is-invalid @enderror" value="{{ old('fit_date')  }}"   required >
                                @error('fit_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               <br>
                      </div>
                      <div class="col-lg-6">
                                <label>Unfit Date </label>
                                <input type="date" name="unfit_date"  id=" unfit_date" class="form-control @error('    unfit_date') is-invalid @enderror" value="{{ old(' unfit_date') }}" required >
                                @error('unfit_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                  <br>
                      </div>
                      
                    </div>
                
            
             
                <label> Attached Document 1 </label>
                <input type="file" name="attached_document1"  id="  attached_document1" class="form-control @error('  attached_document1') is-invalid @enderror" value="{{ old('attached_document1')  }}"   required >
                @error('attached_document1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                  <br>

               
                <label> Attached Document 2 </label>
                <input type="file" name="attached_document2"  id="attached_document2" class="form-control @error('  attached_document2') is-invalid @enderror" value="{{ old('attached_document2')  }}"   required >
                @error('attached_document2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                  <br>
              
                <label> Attached Document 3 </label>
                <input type="file" name="attached_document3"  id="attached_document3" class="form-control @error('  attached_document3') is-invalid @enderror" value="{{ old('attached_document3')  }}"   required >
                @error('attached_document3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                  <br>

                   <label>Remark </label>
                <textarea type="text" name="remark"  id="remark" class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark') }}" required ></textarea>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Qvc Process</h5>
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
                   <input type="hidden" name="candidateqvc" id="candidateqvc" ><br>
      
                    <div class="row">
                             <div class="col-lg-6">
                                    <label>Client Applied Date </label>
                                    <input type="date" name="client_applied_date"  id="client_applied_date" class="form-control @error('client_applied_date') is-invalid @enderror" value="{{ old('client_applied_date')  }}"   required >
                                    @error('client_applied_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <br>
                              </div>

                              <div class="col-lg-6">
                                    <label>Appointment Date</label>
                                    <input type="date" name="appointment_date"  id=" appointment_date" class="form-control @error('    appointment_date') is-invalid @enderror" value="{{ old(' appointment_date') }}" required >
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
                                          <label>Medical Fit Date </label>
                                          <input type="date" name="medical_fit_date"  id="medical_fit_date" class="form-control @error('medical_fit_date') is-invalid @enderror" value="{{ old('medical_fit_date')  }}"   required >
                                          @error('medical_fit_date')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                          <br>         
                                    </div>

                                  <div class="col-lg-6">
                                          <label>Medical Unfit Date </label>
                                          <input type="date" name="medical_unfit_date"  id="medical_unfit_date" class="form-control @error('     medical_unfit_date') is-invalid @enderror" value="{{ old('medical_unfit_date') }}" required >
                                          @error('medical_unfit_date')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                          <br>
                                  </div>
                    </div>

    
              
              
                <label> Attached Document 1 </label>
                <input type="file" name="attached_document1"  id="  attached_document1" class="form-control @error('  attached_document1') is-invalid @enderror" value="{{ old('attached_document1')  }}"   required >
                @error('attached_document1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br>
           
                <label> Attached Document 2 </label>
                <input type="file" name="attached_document2"  id="attached_document2" class="form-control @error('  attached_document2') is-invalid @enderror" value="{{ old('attached_document2')  }}"   required >
                @error('attached_document2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br>
           
                <label> Attached Document 3 </label>
                <input type="file" name="attached_document3"  id="attached_document3" class="form-control @error('  attached_document3') is-invalid @enderror" value="{{ old('attached_document3')  }}"   required >
                @error('attached_document3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br>
                <label>Remark </label>
                <textarea type="text" name="remark"  id="remark" class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark') }}" required ></textarea>
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
       </div><!-- modal-body end -->

                 
    </div>
  </div>
</div>
<!------------------------- QVC Modal End ------------------------->



<!------------------Visa Process Modal Start-------------------------->
<div class="modal fade" id="visa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
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
                   <input type="hidden" name="candidatevisa" id="candidatevisa" ><br>

             <div class="row">
                     <div class="col-lg-6">
                        <label>Issue Date </label>
                        <input type="date" name="issue_date"  id="issue_date" class="form-control @error('issue_date') is-invalid @enderror" value="{{ old('issue_date') }}" required >
                        @error('issue_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                     </div>
                     <div class="col-lg-6">
                          <label>Expiry Date </label>
                          <input type="date" name="expiry_date"  id="expiry_date" class="form-control @error('expiry_date') is-invalid @enderror" value="{{ old('expiry_date')  }}"   required >
                          @error('expiry_date')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                          <br>
                    </div>
              </div>


                <div class="row">
                     <div class="col-lg-6">
                          <label>Ev No </label>
                          <input type="number" name="ev_no"  id="ev_no" class="form-control @error('ev_no') is-invalid @enderror" value="{{ old('ev_no') }}" required >
                          @error('ev_no')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                           <br>
                     </div>
                     <div class="col-lg-6">
                          <label>Sim No</label>
                          <input type="number" name="sim_no"  id="sim_no" class="form-control @error('sim_no') is-invalid @enderror" value="{{ old('sim_no')  }}"   required >
                          @error('sim_no')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                           <br>
                    </div>
               </div>


             
                <label>Vissa Profession </label>
                <input type="text" name="vissa_profession"  id="vissa_profession" class="form-control @error('vissa_profession') is-invalid @enderror" value="{{ old('vissa_profession') }}" required >
                @error('vissa_profession')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br>
              
                <label> Attached Document 1 </label>
                <input type="file" name="attached_document1"  id="attached_document1" class="form-control @error('  attached_document1') is-invalid @enderror" value="{{ old('attached_document1')  }}" >
                @error('attached_document1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br>
                <label> Attached Document 2 </label>
                <input type="file" name="attached_document2"  id="attached_document2" class="form-control @error('form-control  attached_document2') is-invalid @enderror" value="{{ old('attached_document2')  }}" >
                @error('attached_document2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br>
                <label> Attached Document 3 </label>
                <input type="file" name="attached_document3"  id="attached_document3" class="form-control @error('  attached_document3') is-invalid @enderror" value="{{ old('attached_document3')  }}" >
                @error('attached_document3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br>
                 <label>Remark </label>
                 <textarea type="text" name="remark"  id="remark" class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark') }}" required ></textarea>
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
        $("#job_id").append('<option>Select Enquiry</option>');
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


});

function openPopup(id)
{

  document.getElementById("candidatecallstatus").value=id;
  document.getElementById("candidateidassessment").value=id;
  document.getElementById("candidateenrollment").value=id;
  // interview
  document.getElementById("candidatepostassessment").value=id;
  document.getElementById("candidateselection").value=id;
  document.getElementById("candidateofferletter").value=id;
  document.getElementById("candidatepremedical").value=id;
  document.getElementById("candidateqvc").value=id;
  document.getElementById("candidatevisa").value=id;


 var assess = document.getElementById("candidateidassessment").value;
 document.getElementById("assess_id").innerHTML = assess;

}






  $(function(e){
        $("#chkCheckAll").click(function(){
          $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        })

        $(".btn btn-primary").on('click',function(e){
          e.preventDefault();
          
          var allids =[];


          $("input:checkbox[name=ids]:checked").each(function(){
            // alert($(this).val());
            allids.push($(this).val());
            // alert(allids.push($(this).val()));
           })

        })
   }); 



</script> 
@stop
