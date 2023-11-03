<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
?>

@extends('layouts.admin')

@section('title')
INTERVIEW STATUS LIST
@endsection

@section('css')
<style type="text/css">
	table, th, td {
  border: 1px solid black;
}
</style>
@endsection




@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title "><i class="fa fa-file mr-1"></i>INTERVIEW STATUS LIST</h3>
   
       
          <br><hr>
      	           <form name="" action="" method="GET">
                        <div class="row">
	                           <div class="col-lg-3">
	                            <label>Company Name</label>
	                            <select class="form-control select2" name="client_id" id="client_id" required>
	                              <option value="0">-Select-</option>
	                                  @foreach ($client as $data)
	                                  <option value="{{ $data->client_id }}">{{ $data->company_name }}</option>
	                                  @endforeach
	                            </select>  
	                           </div>

                            <div class="col-lg-3">
                                <label>Enquiries</label>
                                <select name="enquiry_id" id="enquiry_id" class="form-control" required></select>
                            </div>

                            <div class="col-lg-3">
                                <label>Job</label>
                                <select name="job_id" id="job_id" class="form-control" required></select>
                            </div>

                              <div class="col-lg-3">
                                <label>Location</label>
                                <select name="location_id"  id="location_id" class="form-control" required ></select>
                            </div>

                           <div class="col-lg-2" style="margin-top: 5px;"><br>
                             <button type="submit" class="btn btn-secondary">Search</button>
                           </div>
                      </div> <br>
                </form>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
  <table class="table table-hover table-striped" border="1" style="border-collapse: collapse;"  id="example">
        
            <thead>


<?php if(isset($_GET["location_id"])){ ?>


 <div class="card-tools" align="right" style="margin-bottom: 10px;">
     <button onclick="ExportToExcel('xlsx')" class="btn btn-flat btn-success"> <i class="fa fa-file-excel-o"></i> Export to excel</button>
 </div>


<tr style="height: 16px">
	   <td class="s0" colspan="62" rowspan="2">
		   <img src="{{asset('img/GoLogo.png')}}" height="60px;" style="margin-right: 200px;"> 
         <span style="margin-left: 200px;">INTERVIEW STATUS LIST  2020 - 2021 / LFS.DQ</span>
        <img src="{{asset('img/LincLogo.png')}}" align="right">
     </td>
</tr>

	<tr style="height: 93px"></tr>







<tr style="height: 35px">
   <!--  <td class="s3" rowspan="3" bgcolor="#c0c0c0">ID</td> -->
	<td class="s3" rowspan="3" bgcolor="#c0c0c0"  align='center' style="padding-top:60px;">ISL</td>
	<td class="s4" rowspan="3" bgcolor="#c0c0c0" align='center' style="padding-top:60px;">GO ID</td>
	<td class="s4" rowspan="3" bgcolor="#c0c0c0" align='center' style="padding-top:60px;">REF</td>
	<td class="s5" rowspan="3" bgcolor="#c0c0c0" align='center' style="padding-top:60px;">NAME OF CANDIDATE</td>
	<td class="s5" rowspan="3" bgcolor="#c0c0c0" align='center' style="padding-top:60px;">PASSPORT NUMBER</td>
	<td class="s6" rowspan="3" bgcolor="#c0c0c0" align='center' style="padding-top:60px;">POSITION APPLIED</td>
	<td class="s7" colspan="5" bgcolor="f9ff04" align='center' style="padding-top:60px;">INTERVIEW - REMARKS</td>
	<td class="s7" colspan="2" rowspan="3"  bgcolor="f9ff04" align='center' style="padding-top:60px;">PRE-MEDICAL</td>
	<td class="s7" colspan="4"  bgcolor="f9ff04" align='center' style="padding-top:60px;">QVC PROCEDURE</td>
	<td class="s7" colspan="4"  bgcolor="f9ff04" align='center' style="padding-top:60px;">MOI / QATAR</td>
	<td class="s7" colspan="2"  rowspan="3"  bgcolor="f9ff04" align='center' style="padding-top:60px;">DEPLOYMENT </td>
	<td class="s8" colspan="17" bgcolor="20fdff" align='center' style="padding-top:60px;">EMPLOYMENT OFFER PACKAGE IN (QR)</td>
	<td class="s9"  rowspan="3" bgcolor="00b050" align='center' style="padding-top:60px;">LFS REMARKS</td>
	<td class="s10" rowspan="3" bgcolor="45b0f0" align='center' style="padding-top:60px;">GO REMARKS   </td>

</tr>


<tr style="height: 35px">
	<td class="s12" colspan="2" rowspan="2" bgcolor="f9ff04" align='center'>SELECTION STATUS</td>
	<td class="s7"  colspan="3" rowspan="2" bgcolor="f9ff04" align='center'>OFFER LETTER</td>
	<td class="s13" colspan="2" rowspan="2" bgcolor="f9ff04" align='center'>QVC DATE&#39;S</td>
	<td class="s7"  colspan="2" rowspan="2" bgcolor="f9ff04" align='center'>MEDICAL RESULT</td>
	<td class="s7"  colspan="4" rowspan="2" bgcolor="f9ff04" align='center'>VISA STATUS</td>
	<td class="s14" rowspan="2" bgcolor="ffe598" align='center'>PROJECT </td>
	<td class="s14" rowspan="2" bgcolor="ffe598" align='center'>GRADE</td>
	<td class="s15" rowspan="2" bgcolor="ffe598" align='center' >POSITION OFFERED</td>
	<td class="s15" rowspan="2" bgcolor="ffe598" align='center'>BASIC </td>
	<td class="s16" rowspan="2" bgcolor="ffe598" align='center'>COLA</td>
	<td class="s16" colspan="2" rowspan="2"  bgcolor="ffe598" align='center'>FOOD</td>
	<td class="s16" colspan="2" rowspan="2"  bgcolor="ffe598" align='center'>ACCOMMODATION</td>
	<td class="s16" colspan="2" rowspan="2"  bgcolor="ffe598" align='center'>TRANSPORT</td>
	<td class="s16" colspan="3" rowspan="2"  bgcolor="ffe598" align='center'>OT</td>
	<td class="s16" colspan="2" rowspan="2"  bgcolor="ffe598" align='center'>OTHER BENEFITS</td>
	<td class="s17" rowspan="2" rowspan="2"  bgcolor="ffe598" align='center'>GROSS TOTAL</td>
</tr>

<tr></tr>

<tr style="height: 35px">
	<td class="freezebar-cell" bgcolor="c0c0c0"></td>
	<td class="freezebar-cell" bgcolor="c0c0c0"></td>
	<td class="freezebar-cell" bgcolor="c0c0c0"></td>
	<td class="freezebar-cell" bgcolor="c0c0c0"></td>
	<td class="freezebar-cell" bgcolor="c0c0c0"></td>
	<td class="freezebar-cell" bgcolor="c0c0c0"></td>

	<td class="s18" bgcolor="92d050" align='center'>SELECTED</td>
	<td class="s19" bgcolor="f7bf04" align='center'>STANDBY</td>
<!-- <td class="s18" align='center'>RESERVED</td>
	<td class="s18" align='center'>OTHER</td>
	<td class="s18" align='center'>REJECTED</td> -->
	<td class="s20" bgcolor="92d050" align='center'>ISSUED</td>
	<td class="s21" bgcolor="f7bf04" align='center'>SIGNED</td>
	<td class="s22" bgcolor="red" align='center'>REFUSED</td>
	<td class="s23" bgcolor="f9ff04" align='center'>FIT</td>
	<td class="s22" bgcolor="red" align='center'>UNFIT</td>
	<td class="s23" bgcolor="f9ff04" align='center' nowrap="">CLIENT APPLIED</td>
	<td class="s23" bgcolor="f9ff04" align='center' nowrap="">APPOINTMENT <br>DATE</td>
	<td class="s23" bgcolor="f9ff04" align='center'>FIT</td>
	<td class="s22" bgcolor="red" align='center'>UNFIT</td>
	<td class="s24" bgcolor="00b0f0" align='center' nowrap="">VISA PROFESSION</td>
	<td class="s23" bgcolor="f9ff04" align='center'>EV NO.</td>
	<td class="s18" bgcolor="92d050" align='center' nowrap="">ISSUED DATE</td>
	<td class="s22" bgcolor="red" align='center'>EXPIRY DATE</td>
	<td class="s18" bgcolor="92d050" align='center'>FLIGHT DATE</td>
	<td class="s25" bgcolor="92d050" align='center' nowrap="">FLIGHT DETAIL</td>

	<td class="s11"></td>
	<td class="s11"></td>
	<td class="s11"></td>
	<td class="s11"></td>
	<td class="s11"></td>

	<td class="s15" align='center'>PROVIDED</td>
	<td class="s15" align='center'>ALLOWANCE</td>
	<td class="s15" align='center'>PROVIDED</td>
	<td class="s15" align='center'>ALLOWANCE</td>
	<td class="s15" align='center'>PROVIDED</td>
	<td class="s15" align='center'>ALLOWANCE</td>
	<td class="s15" align='center'>YES</td>
	<td class="s15" align='center'>INCLUDED</td>
	<td class="s15" align='center'>FIXED</td>
	<td class="s15" align='center'>FUEL</td>
	<td class="s15" align='center'>MOBILE</td>
	<td class="s26"></td>
	<td class="s27"></td>
	<td class="s11"></td>
</tr>

<?php
if(isset($_GET['job_id'])){
$enquiry_id=$_GET['enquiry_id'];
$job_id=$_GET['job_id'];
$location_id=$_GET['location_id'];
}else{
$enquiry_id='';
$job_id='';
$location_id='';
}

$applicationData  = DB::select(DB::raw("SELECT candidate_id,MAX(from_unixtime(created_date,'%d-%m-%Y')) as created_dates,application_activity,application_status FROM application_process WHERE job_id='".$job_id."' AND location_id='".$location_id."' and enquiry_id='".$enquiry_id."'  GROUP BY application_activity,application_status,candidate_id"));

$candidateStatusArray=array();



foreach ($applicationData as $applicationValue) {
$candidateStatusArray[$applicationValue->candidate_id][$applicationValue->application_activity][$applicationValue->application_status]=$applicationValue->created_dates;

}

// echo "<pre>";

// print_r($candidateStatusArray);

// //echo "</pre>";
 //  if(isset($candidateStatusArray[78]["interview"])){
 //       echo $candidateStatusArray[78]["interview"]["selected"] ;
 // } 
 // exit();


?>











            </thead>
            <tbody>
@foreach($results as $index => $personal)



     <tr style="height: 18px">
	  <!--   <td>{{++$index}}</td> -->

		<td class="s28" align='center'>{{$personal->candidate_id}}</td>
		<td class="s29" align='center'>{{$personal->branch_name}}</td>
		<td class="s30" align='center'>{{$personal->reffer_by}}</td>
		<td class="s31" align='center'>{{$personal->name}}</td>
		<td class="s30" align='center'>{{$personal->passport_no}}</td>
		<td class="s32" align='center' nowrap="">{{$personal->category_name}}</td>
		<td class="s29" nowrap="" align='center'>
		         <?php  if(isset($candidateStatusArray[$personal->candidate_id]["interview"]["selected"])){
                    echo  $candidateStatusArray[$personal->candidate_id]["interview"]["selected"] ;
						 }?>
		</td>
		<td class="s33" nowrap="" align='center'>
			     <?php  if(isset($candidateStatusArray[$personal->candidate_id]['interview']["Standby"])){
			           	echo     $candidateStatusArray[$personal->candidate_id]["interview"]["Standby"];
			       }?>
		</td>
		<td class="s33" nowrap="" align='center'>
		       	<?php if(isset($candidateStatusArray[$personal->candidate_id]['selection']["issue_date"])){
						          echo $candidateStatusArray[$personal->candidate_id]["selection"]["issue_date"];
						 }?>
		</td>
		<td class="s29" nowrap="" align='center'>
		        <?php if(isset($candidateStatusArray[$personal->candidate_id]['selection']["signed_date"])){ 
				              echo $candidateStatusArray[$personal->candidate_id]["selection"]["signed_date"];
				     }?>
		</td>
		<td class="s34" nowrap="" align='center'>
		        <?php if(isset($candidateStatusArray[$personal->candidate_id]['selection']["refuse_date"])){ 
				              echo $candidateStatusArray[$personal->candidate_id]["selection"]["refuse_date"];
				      }?>
		</td>
		<td class="s29" nowrap="" align='center'>
			 <?php  if(isset($candidateStatusArray[$personal->candidate_id]["offers"]["fit_date"])){
                  echo $candidateStatusArray[$personal->candidate_id]["offers"]["fit_date"] ;
        }?>
		</td>
		<td class="s34" nowrap="" align='center'>
			<?php if(isset($candidateStatusArray[$personal->candidate_id]['offers']["unfit_date"])){
			          echo $candidateStatusArray[$personal->candidate_id]["offers"]["unfit_date"];
			 }?>
		</td>
		<td class="s34" nowrap="" align='center'>
			<?php 
			if(isset($candidateStatusArray[$personal->candidate_id]['medical']["client applied"])){ 
				  echo $candidateStatusArray[$personal->candidate_id]["medical"]["client applied"];
			}?>
		</td>
		<td class="s29" nowrap="" align='center'>
			<?php 
			if(isset($candidateStatusArray[$personal->candidate_id]['medical']["appoinment date"])){
			   echo  $candidateStatusArray[$personal->candidate_id]["medical"]["appoinment date"];
			  }?>
		</td>
		<td class="s31" nowrap="" align='center'>
			<?php
			 if(isset($candidateStatusArray[$personal->candidate_id]['medical']["medical_fit_date"])){
			    echo $candidateStatusArray[$personal->candidate_id]["medical"]["medical_fit_date"];
			   }?>
		</td>
		<td class="s31" nowrap="" align='center'>
		<?php if(isset($candidateStatusArray[$personal->candidate_id]['medical']["medical_unfit_date"]))	{
		       echo    $candidateStatusArray[$personal->candidate_id]["medical"]["medical_unfit_date"];
		  }?>
		</td>
		<td class="s30" nowrap="" align='center'>
			<?php if(isset($candidateStatusArray[$personal->candidate_id]['vc']["issue_date"])){
			       echo    $candidateStatusArray[$personal->candidate_id]["vc"]["issue_date"]; 
			  }?>
		</td>
		<td class="s30" nowrap="" align='center'>
			<?php if(isset($candidateStatusArray[$personal->candidate_id]['vc']["expiry_date"])){
			         echo  $candidateStatusArray[$personal->candidate_id]["vc"]["expiry_date"]; 
			  }?>
		</td>
		<td class="s30" nowrap="" align='center'>
			 <?php if(isset($candidateStatusArray[$personal->candidate_id]['vc']["vissa_profession"])){ 
				       echo   $candidateStatusArray[$personal->candidate_id]["vc"]["vissa_profession"]; 
				}?>
		</td>
		<td class="s32" nowrap="" align='center'>
			<?php if(isset($candidateStatusArray[$personal->candidate_id]['vc']["ev_no"])){
			        echo   $candidateStatusArray[$personal->candidate_id]["vc"]["ev_no"]; 
			    }?>
		</td>
		<td class="s31" nowrap="" align='center'>
		<?php if(isset($candidateStatusArray[$personal->candidate_id]['visa']["flight date"])){
		          echo $candidateStatusArray[$personal->candidate_id]["visa"]["flight date"]; 
		 }?>
		</td>
		<td class="s34" align='center'></td>
		<td class="s29" align='center'>NN</td>
		<td class="s29" align='center'></td>
		<td class="s30" align='center'>CLEANER</td>
		<td class="s29" align='center' nowrap>{{$personal->basic_salary}}</td>
		<td class="s29" align='center'>0</td>
		<td class="s29" align='center' nowrap>{{$personal->food_allownce}}</td>
		<td class="s29" align='center'>NO F</td>
		<td class="s29" align='center' nowrap>{{$personal->accomodation_allownce}}</td>
		<td class="s29" align='center'>NO Acc</td>
		<td class="s29" align='center' nowrap>{{$personal->transportation_allownce}}</td>
		<td class="s29" align='center'>NO Tra</td>
		<td class="s29" align='center' nowrap>{{$personal->overtime_allownce}}</td>
		<td class="s29" align='center'>NO</td>
		<td class="s29" align='center'>NO</td>
		<td class="s29" align='center' nowrap>{{$personal->fuel}}</td>
		<td class="s29" align='center' nowrap>{{$personal->mobile}}</td>
		<td class="s33" align='center' nowrap>{{$personal->gross_salary}}</td>
		<td class="s34" align='center'></td>
		<td class="s35" align='center' nowrap>PENDING IN QVC</td>
    </tr>	   

@endforeach
            </tbody>
            <?php } ?>

        </table>
    </div>
    <!-- /.card-body -->
  </div>

@endsection

@section('js')
 <script src="{{asset('plugins/select2/js/select2.full.min.js')}}" defer> </script>
 <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js" defer></script>

<script type="text/javascript">


$(document).ready(function(){
    
    $('#client_id').select2();
    $('#enquiry_id').select2();
    $('#job_id').select2();
    $('#location_id').select2();
    


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
        $("#location_id").empty();
        $("#location_id").append('<option>Select Location</option>');
        $.each(res,function(key,value){
          $("#location_id").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#location_id").empty();
      }
      }
    });
  }else{
    $("#location_id").empty();
  }   
  });




});


// -----------------export/download the HTML table to Excel---------------

        // function ExportToExcel(type, fn, dl) {
        //     var elt = document.getElementById('example');
        //     var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        //     return dl ?
        //         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        //         XLSX.writeFile(wb, fn || ('InterviewStatus.' + (type || 'xlsx')));
        // }

// -----------------export/download the HTML table to Excel---------------

</script>

<script type="text/javascript">
    
        function ExportToExcel() {

            var date = new Date();
            var formattedDate = date.toLocaleDateString('en-GB', {
              day: 'numeric', month: 'short', year: 'numeric'
            }).replace(/ /g, '-');
             var element = document.createElement('a');
             var fileName = formattedDate + "_" + "ISL";

             var htmltable= document.getElementById('example');

             var html = htmltable.outerHTML;
             element.setAttribute('href', 'data:application/vnd.ms-excel,' + encodeURIComponent(html));
             element.setAttribute('download', fileName);     
             element.click();

           
              //  newWindow=window.open(myWindow, 'filename.txt');
        }
     
</script>

@stop
