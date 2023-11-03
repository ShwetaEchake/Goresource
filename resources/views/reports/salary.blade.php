<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
?>

@extends('layouts.admin')

@section('title')
Salary
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
        <h3 class="card-title "><i class="fa fa-file mr-1"></i>Salary</h3>

           <!--  <div class="card-tools">
                <a href="" class="btn btn-flat btn-success"><i class="fa fa-file-excel-o"></i> Export</a>
            </div> -->
     
        

<br><hr>


         <form name="" action="" method="GET">

                 <div class="row">
                           <div class="col-lg-4">
                                <label>Company Name</label>
                                <select class="form-control select2" name="client_id" id="client_id" required>
                                  <option value="0">-Select-</option>
	                                  @foreach ($client as $data)
	                                  <option value="{{ $data->client_id }}">{{ $data->company_name }}</option>
	                                  @endforeach
                                </select>  
                           </div>

                            <div class="col-lg-4">
                                    <label>Enquiries</label>
                                    <select name="enquiry_id[]" id="enquiry_id" class="form-control" multiple="true"></select>
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


<?php if(isset($_GET["client_id"])){ ?>

         <div class="card-tools" align="right" style="margin-bottom: 10px;">
             <button onclick="ExportToExcel('xlsx')" class="btn btn-flat btn-success"> <i class="fa fa-file-excel-o"></i> Export to excel</button>
         </div>

	<tr style="height: 70px">
		<td class="s0" colspan="36" rowspan="2" >
          <img src="{{asset('img/GoLogo.png')}}" height="60px;" style="margin-right: 500px;"> 
        <span  style="color: #00b0f0;"> ( FM 001, FM 003, FM 009, NN, CARGO, UTILITIES)</span> <span style="font-size:15pt;font-family:Calibri,Arial; color: #00b0f0;">DOHA - QATAR 2021</span>
        <img src="{{asset('img/LincLogo.png')}}" height="60px;" style="margin-left: 800px;">

		</td>
	</tr>


    <tr style="height: 48px"></tr>










	<tr style="height: 39px">
		<!-- <th id="1387964235R3" style="height: 39px;" class="row-headers-background">
			<div class="row-header-wrapper" style="line-height: 39px">4</div>
		</th> -->
		<td class="s2" rowspan="3" bgcolor="#c0c0c0" style="font-weight: bold; padding-top:100px;">SN</td>
		<td class="s2" rowspan="3" bgcolor="#c0c0c0" style="font-weight: bold; padding-top:100px;">SUB SN </td>
		<td class="s2" rowspan="3" bgcolor="#c0c0c0" style="font-weight: bold; padding-top:100px;">TRADE / CATEGORIES<span style="font-size:12pt;font-family:Calibri,Arial;font-weight:bold;color:#ff0000;">*</span></td>
		<td class="s4" colspan="{{count($clientlocation)}}" rowspan="2" bgcolor="#45b0f0" style="font-weight: bold; padding-top:100px;">PROJECT LOCATION</td>
		<td class="s5" rowspan="3" bgcolor="f9ff04" style="font-weight: bold; padding-top:100px;">TOTAL REQUIRED</td>
		<td class="s4" colspan="{{count($BranchArray)}}" bgcolor="#45b0f0" style="font-weight: bold; padding-top:100px;" nowrap>INTERVIEW FORECAST LOCATION</td>
		<td class="s6" rowspan="3" bgcolor="#f7bf04" style="font-weight: bold; padding-top:100px;">BALANCE REQUIRED</td>
		<td class="s4" colspan="12"></td>
		<td class="s5" rowspan="3" bgcolor="f9ff04" style="font-weight: bold; padding-top:100px;"> TOTAL</td>
	</tr>



	<tr style="height: 39px">
	<!-- 	<th id="1387964235R4" style="height: 39px;" class="row-headers-background">
			<div class="row-header-wrapper" style="line-height: 39px">5</div>
		</th> -->

		@foreach($BranchArray as $branch)
		<td class="s2" bgcolor="#c0c0c0" style="font-weight: bold;"></td>
		@endforeach
		<!-- <td class="s7" colspan="3" style="font-weight: bold;">INDIA</td>
		<td class="s7" style="font-weight: bold;">PH</td>
		<td class="s7" style="font-weight: bold;">NP</td>
		<td class="s7" style="font-weight: bold;">TH</td>
		<td class="s7" style="font-weight: bold;">SL</td>
		<td class="s7" style="font-weight: bold;">BG</td>
		<td class="s7" style="font-weight: bold;">CAN</td>
		<td class="s7" style="font-weight: bold;">UK</td>
		<td class="s7" style="font-weight: bold;">OTHERS</td> -->
		<td class="s5" rowspan="2" bgcolor="f9ff04" style="font-weight: bold;">BASIC</td>
		<td class="s5" rowspan="2" bgcolor="f9ff04" style="font-weight: bold;">COLA</td>
		<td class="s7" colspan="2" style="font-weight: bold;"> FOOD</td>
		<td class="s7" colspan="2" style="font-weight: bold;">ACCOMMODATION</td>
		<td class="s7" colspan="2" style="font-weight: bold;">TRANSPORTATION</td>
		<td class="s7" colspan="2" style="font-weight: bold;">OT</td>
		<td class="s7" colspan="2" style="font-weight: bold;">OTHER BENEFITS </td>
	</tr>

	<tr style="height: 39px">
		<!-- <th id="1387964235R5" style="height: 39px;" class="row-headers-background">
			<div class="row-header-wrapper" style="line-height: 39px">6</div>
		</th> -->
		@foreach($clientlocation as $location)
		 <td class="s2" bgcolor="#c0c0c0" style="font-weight: bold;" nowrap="">
            {{$location->client_location_code}}
	     </td>
	    @endforeach

		<!-- <td class="s2">FM003</td>
		<td class="s2">FM009</td>
		<td class="s2">NN</td>
		<td class="s2">C</td>
		<td class="s2">U</td>
		<td class="s2">OTHERS</td> -->
		   <?php $countBranch='';?>
		@foreach($BranchArray as  $keyB => $branch)
		<?php  $countBranch .= '<td class="s13">'.$branch.'</td>'?>
		<td class="s2" bgcolor="#c0c0c0" style="font-weight: bold;">{{$keyB}}</td>
		@endforeach
		<!-- <td class="s2" bgcolor="#c0c0c0" style="font-weight: bold;">GO-01</td>
		<td class="s2" bgcolor="#c0c0c0" style="font-weight: bold;">GO-02</td>
		<td class="s2" bgcolor="#c0c0c0" style="font-weight: bold;">GO-07</td>
		<td class="s2" bgcolor="#c0c0c0" style="font-weight: bold;">GO-08</td>
		<td class="s2" bgcolor="#c0c0c0" style="font-weight: bold;">GO-15</td>
		<td class="s2" bgcolor="#c0c0c0" style="font-weight: bold;">GO-23</td>
		<td class="s2" bgcolor="#c0c0c0" style="font-weight: bold;">GO-25</td>
		<td class="s2" bgcolor="#c0c0c0" style="font-weight: bold;">GO-</td>
		<td class="s2" bgcolor="#c0c0c0" style="font-weight: bold;"> GO-</td>
		<td class="s2" bgcolor="#c0c0c0" style="font-weight: bold;">GO-</td>
		<td class="s2" bgcolor="#c0c0c0" style="font-weight: bold;">GO-00</td> -->
		<td class="s8" bgcolor="92d050"  style="font-weight: bold;">PROVIDED</td>
		<td class="s6" bgcolor="#f7bf04" style="font-weight: bold;">ALLOWANCE</td>
		<td class="s8" bgcolor="92d050"  style="font-weight: bold;">PROVIDED</td>
		<td class="s6" bgcolor="#f7bf04" style="font-weight: bold;">ALLOWANCE</td>
		<td class="s8" bgcolor="92d050"  style="font-weight: bold;">PROVIDED</td>
		<td class="s6" bgcolor="#f7bf04" style="font-weight: bold;">ALLOWANCE</td>
		<td class="s8" bgcolor="92d050"  style="font-weight: bold;">PROVIDED</td>
		<td class="s6" bgcolor="#f7bf04" style="font-weight: bold;" nowrap="">FIXED OT</td>
		<td class="s8" bgcolor="92d050"  style="font-weight: bold;">FUEL</td>
		<td class="s6" bgcolor="#f7bf04" style="font-weight: bold;">MOBILE</td>
	</tr>

	<!-- <tr>
		<th style="height:3px;" class="freezebar-cell freezebar-horizontal-handle"></th><td class="freezebar-cell"></td><td class="freezebar-cell"></td>
		<td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td><td class="freezebar-cell"></td>
	</tr> -->

	
		<!-- <th id="1387964235R6" style="height: 95px;" class="row-headers-background">
			<div class="row-header-wrapper" style="line-height: 95px">7</div>
		</th> -->

	   <tr style="height: 95px">
	   	<?php 
	   	 if(!empty($_GET['client_id'])){
	   	    $comp=DB::table('client')->where('client_id',$_GET['client_id'])->first();
	   	    $clientids= $comp->company_name;
	   	 }else{
	   	 	$clientids='';
	   	 }?>
		<td class="s9" colspan="36"  bgcolor="#23b050" style="font-size: 150%;"><b>{{$clientids}} <b></td>
	   </tr>


@foreach($DetailArray as $Enqname => $JobArray)

     <tr style="height: 53px">
		<td class="s10">1</td>
		<td class="s11" colspan="2" bgcolor="#c0c0c0" style="font-weight: bold;">{{$Enqname}}</td>
		<td class="s12" colspan="33"></td>
	</tr>


<?php 	
$allKeys=array_keys($JobArray); 
$allValues=array_values($JobArray); 
$combin=array_combine($allKeys,$allValues);


$i=1;
foreach($combin as $categname => $locationname){
?>

           <?php 
              $delimiters = ['@@', '##', '$$','}}}','%%','&&','**','++','--','==','~~','__'];

              $newStr = str_replace($delimiters, $delimiters[0], $categname); // 'foo. bar. baz.'

              $jobDetail = explode($delimiters[0], $newStr);
           ?>




	<tr style="height: 53px">	
		<td class="s10"></td>
		<td class="s12"><?php echo  $i++; ?></td>
		<td class="s12" bgcolor="#f7bf04" nowrap="">{{$jobDetail[0] }}</td>
		<?php $keys = array_keys($locationname);
		         $locationSum=0;
		     for($j = 0; $j < count($locationname); $j++){  
                 $locationSum=$locationSum+$locationname[$keys[$j]] ;
		     	?>
		<td class="s12" rowspan="count($locationname)" >{{  $locationname[$keys[$j]] }}</td>
		<?php  } ?>

		<td class="s10" nowrap> 
			<?php  echo $locationSum; ?>
		</td>

		<?php  

		       $countBranchs=0;
		  foreach($BranchArray as $branchkey => $branchValue){ 
		    ?>

		 <td class="s12" rowspan="count($BranchArray)"  >
		   <?php   
		         if(!empty($BranchArrays[$jobDetail[10]][$branchkey])){ // echo $branchkey; // echo "<br>";
 			         
 			         $countBranch= $BranchArrays[$jobDetail[10]][$branchkey];
                        		   
 			          
				 }else { 
				    $countBranch = 0;
	             } 
	             $countBranchs = $countBranchs + $countBranch;
	              echo $countBranch ?>
		</td>
		<?php } ?>
        
		<!-- <td class="s13"></td>
		<td class="s13"></td>
		<td class="s13"></td>
		<td class="s13"></td>
		<td class="s12">1</td>
		<td class="s12"></td>
		<td class="s12"></td>
		<td class="s12"></td>
		<td class="s12"></td>
		<td class="s12"></td>
		<td class="s12"></td>
		<td></td>
		<td></td> -->

		<td class="s12" nowrap=""><?php echo  $locationSum-$countBranchs; ?></td>
		<td class="s12" nowrap="">{{$jobDetail[1]}}</td>
		<td class="s14" nowrap="">{{$jobDetail[2]}}</td>
		<td class="s15" nowrap="">{{$jobDetail[3]}}</td>
		<td class="s15" nowrap="">N0</td>
		<td class="s14" nowrap=""> {{$jobDetail[4]}} </td>
		<td class="s15" nowrap="">N</td>
		<td class="s15" nowrap="">{{$jobDetail[5]}}</td>
		<td class="s15" nowrap=""></td>
		<td class="s15" nowrap="">{{$jobDetail[6]}}</td>
		<td class="s15" nowrap=""></td>
		<td class="s15" nowrap="">{{$jobDetail[7]}}</td>
		<td class="s14" nowrap="">{{$jobDetail[8]}}</td>
		<td class="s14" nowrap=""> {{$jobDetail[9]}} </td>
	</tr>

<?php }?>
@endforeach

            </thead>
            <tbody>
                 
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
    $('#branch_id').select2();



/***********************  Enquiries  ************************************/
     $('#client_id').change(function(){
  var clientID = $(this).val();  
  if(clientID){
    $.ajax({
      type:"GET",
      url:"{{url('getEnquiryReports')}}?client_id="+clientID,
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
/***********************  Enquiries  ************************************/

});


// -----------------export/download the HTML table to Excel---------------

        // function ExportToExcel(type, fn, dl) {
        //     var elt = document.getElementById('example');
        //     var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        //     return dl ?
        //         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        //         XLSX.writeFile(wb, fn || ('Salary.' + (type || 'xlsx')));
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
             var fileName = formattedDate + "_" + "Salary";

             var htmltable= document.getElementById('example');

             var html = htmltable.outerHTML;
             element.setAttribute('href', 'data:application/vnd.ms-excel,' + encodeURIComponent(html));
             element.setAttribute('download', fileName);     
             element.click();

           
              //  newWindow=window.open(myWindow, 'filename.txt');
        }
     
</script>
@stop
