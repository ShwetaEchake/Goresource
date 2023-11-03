<?php

namespace App\Http\Controllers;
use DB;
//use App\Models\Enquiry;

?>

@extends('layouts.admin')

@section('title')
Summary of Arrival
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
       
       <h3 class="card-title" style=""><i class="fa fa-file"></i>  SUMMARY OF ARRIVAL</h3>
      

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
                                    <select name="enquiry_id" id="enquiry_id" class="form-control"></select>
                               </div>

                               <div class="col-lg-3">
                                    <label>Job</label>
                                    <select name="job_id[]" style="height:70px;" id="job_id" class="form-control" multiple="true"></select>
                               </div>


                               <div class="col-lg-2" style="margin-top: 5px;"><br>
                                 <button type="submit" class="btn btn-secondary">Search</button>
                               </div>
 </div>  <br>
         </form>


   

    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
  
              <table class="table table-hover table-striped" border="1" style="border-collapse: collapse;"  id="tbl_exporttable_to_xls">

            <thead>

<?php if(isset($_GET["enquiry_id"])){ ?>

 <div class="card-tools" align="right" style="margin-bottom: 10px;">
     <button onclick="ExportToExcel('xlsx')" class="btn btn-flat btn-success"> <i class="fa fa-file-excel-o"></i> Export to excel</button>
 </div>


<tr style="height: 88px">
   <!--  <th id="413323679R0" style="height: 88px;" class="row-headers-background">
        <div class="row-header-wrapper" style="line-height: 88px">1</div>
    </th> -->

    <td class="s0" colspan="28">
        <img src="{{asset('img/GOLOGOtm-2020.png')}}" height="60px;" style="margin-right: 200px;"> 
        PROJECT REF: LFS.DQ LOCATON: GO15 - SUMMARY OF ARRIVAL
        <img src="{{asset('img/linc.png')}}" height="60px;" style="margin-left: 100px;"></td>
</tr>

<!-- <tr style="height: 31px">
    <th id="413323679R1" style="height: 31px;" class="row-headers-background">
        <div class="row-header-wrapper" style="line-height: 31px">2</div>
    </th>
    <td class="s1">A</td>
    <td class="s1">B</td>
    <td class="s1" colspan="9">C</td>
    <td class="s1" colspan="2">D</td>
    <td class="s1" colspan="14">E</td>
    <td class="s1">F</td>
</tr> -->




 

<tr style="height: 24px">
     <td class="s2" rowspan="2" style="padding-top:60px;">S.NO.</td>
     <td class="s2" rowspan="2" style="padding-top:60px;">CATEGORY</td>
	 <td class="s3" colspan="9" style="padding-top:60px;">SALARY STRUCTURE</td>
	 <td class="s4" colspan="2" style="padding-top:60px;">TOTAL EV&#39;S</td>
	 <td class="s2" colspan="{{count($DepartureArray)}}" style="padding-top:60px;">DATE WISE DEPARTURE&#39;S 2021</td>
	 
	 <td style="padding-top:60px;">REMARKS</td>
</tr>


<tr style="height: 25px">

	<td class="s3">BASIC</td>
	<td class="s3">COLA</td>
	<td class="s3">F </td>
	<td class="s3">A</td>
	<td class="s3">T</td>
	<td class="s3">OT</td>
	<td class="s3">FOT</td>
	<td class="s3">MOB</td>
	<td class="s5">TOTAL</td>
	<td class="s6" bgcolor="1fb714">ISSUED</td>
	<td class="s7" bgcolor="red">CANCEL</td>
	<!-- <td class="s8" nowrap="">10-Jan</td>
	<td class="s8" nowrap="">11-Jan</td>
	<td class="s8" nowrap="">17-Jan</td> -->
      
       @foreach($DepartureArray as $datenew)
         <td class="s8" nowrap="">{{ date('d-m-Y',$datenew)}}</td>
       @endforeach
     <td></td>
	 <!--<td class="s9"></td>
	<td class="s9"></td>
	<td class="s9"></td>
	<td class="s9"></td>
	<td class="s9"></td> -->
</tr>






            </thead>
           <tbody>

<?php $totalIssue=0; $totalDatewise=0; ?>
               @forelse ($jobArray as $index=> $job)
                            
           <?php   
                  $delimiters = ['@@', '##', '$$','}}}','%%','&&','**','++','--','~~','==','__'];

                        $newStr = str_replace($delimiters, $delimiters[0], $job); // 'foo. bar. baz.'

                        $arrValue = explode($delimiters[0], $newStr);
                         $totalIssue=$totalIssue+$arrValue[9];
           ?>
                    <tr style="height: 23px">
                            <th id="413323679R4" style="height: 23px;" class="row-headers-background">
                                <div class="row-header-wrapper" style="line-height: 23px">{{++$index}}</div>
                            </th>

                            <!--<td class="s10">01</td> -->
                            <td class="s11" nowrap>{{$arrValue[0]}}</td>
                            <td class="s12" nowrap>{{$arrValue[1]}}</td>
                            <td class="s12" nowrap>{{$arrValue[2]}}</td>
                            <td class="s12" nowrap>{{$arrValue[3]}}</td>
                            <td class="s13" nowrap>{{$arrValue[4]}}</td>
                            <td class="s14" nowrap>{{$arrValue[5]}} </td>
                            <td class="s12" nowrap>{{$arrValue[6]}}</td>
                            <td class="s12" nowrap>N</td>
                            <td class="s12" nowrap>{{$arrValue[7]}}</td>
                            <td class="s12" nowrap>{{$arrValue[8]}} </td>
                            <td class="s15" nowrap>{{$arrValue[9]}} </td>
                            <td class="s12" nowrap>{{$arrValue[10]}} </td> 

 
                              <?php    
                              foreach($DepartureArray as $Depkey => $DepValue){ 
                                      if(!empty($DepartureArrays[$arrValue[11]][$DepValue])){ // echo $DepValue; // echo "<br>";
                                         $countDep = $DepartureArrays[$arrValue[11]][$DepValue];
                                     }else{
                                        $countDep =0;
                                     }
                                     $totalDatewise=$totalDatewise+$countDep;
                                     echo '<td class="s13">'.$countDep.'</td>';
                               } ?>
                         

                            <td></td>
                        <!--     <td class="s12"></td>
                            <td class="s12"></td>
                            <td class="s12"></td>
                            <td class="s12"></td>
                            <td class="s12"></td>
                            <td class="s12"></td>
                            <td class="s12"></td> -->
                            <!-- <td class="s12"></td>
                            <td class="s16"></td> -->
                    </tr>




                @empty
                    <tr>No Result Found</tr>
                @endforelse


    <tr style="height: 18px">
        <!-- <th id="413323679R33" style="height: 18px;" class="row-headers-background">
            <div class="row-header-wrapper" style="line-height: 18px">34</div>
        </th> -->
    <td class="s18"></td>
    <td class="s21" style="font-weight: bold;">TOTAL</td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s22">{{$totalIssue}}</td>
    <td class="s23"></td>
    <td class="s12">-</td>
    <td class="s12">-</td>
    <!-- <td class="s12">-</td>
    <td class="s12"></td>
    <td class="s12"></td>
    <td class="s12"></td>
    <td class="s12"></td>
    <td class="s12"></td>
     <td class="s12"></td> -->
<!--<td class="s12"></td>
    <td class="s12"></td>
    <td class="s12"></td>
    <td class="s12"></td>
    <td class="s12"></td>
    <td class="s15">15</td> -->
</tr>




<tr style="height: 18px">
    <!-- <th id="413323679R34" style="height: 18px;" class="row-headers-background">
        <div class="row-header-wrapper" style="line-height: 18px">35</div>
    </th> -->
    <td class="s18"></td>
    <td class="s24" style="font-weight: bold;">DEPLOYED</td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s18"></td>
    <td class="s25">{{$totalDatewise}}</td>
    <td class="s12"></td>
    <td class="s12"></td>
   <td class="s12"></td>
    <!--  <td class="s12"></td>
    <td class="s12"></td>
    <td class="s12"></td>
    <td class="s12"></td>
    <td class="s12"></td>
    <td class="s12"></td>
    <td class="s12"></td> -->
<!--<td class="s12"></td>
    <td class="s12"></td>
    <td class="s12"></td>
    <td class="s12"></td>
    <td class="s12"></td>
    <td class="s18"></td> -->
</tr>

<tr style="height: 18px">
       <!--  <th id="413323679R35" style="height: 18px;" class="row-headers-background">
            <div class="row-header-wrapper" style="line-height: 18px">36</div>
        </th> -->
        <td class="s18"></td>
        <td class="s26" style="font-weight: bold;">BALANCE to FLY</td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s27">{{$totalIssue - $totalDatewise}}</td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
      <!-- <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td> -->
       <!-- <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s18"></td> -->
 </tr>

 {{--<tr style="height: 18px">
   <!--  <th id="413323679R36" style="height: 18px;" class="row-headers-background">
        <div class="row-header-wrapper" style="line-height: 18px">37</div>
    </th> -->
    <td class="s18"></td>
    <td class="s28" style="font-weight: bold;">CANCELLED</td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s18"></td>
        <td class="s29"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <!-- <td class="s12"></td
        ><td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s12"></td>
        <td class="s18"></td> -->
    </tr>--}}



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



/***********************  Job  ************************************/

     $('#enquiry_id').change(function(){
  var enquiryID = $(this).val();  
  if(enquiryID){
    $.ajax({
      type:"GET",
      url:"{{url('getJobReports')}}?enquiry_id="+enquiryID,
      success:function(res){  
      if(res){
        $("#job_id").empty();
        $("#job_id").append('<option value="0">Select All</option>');
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
/***********************  Job  ************************************/


});


// -----------------export/download the HTML table to Excel---------------

        // function ExportToExcel(type, fn, dl) {
        //     var elt = document.getElementById('tbl_exporttable_to_xls');
        //     var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        //     return dl ?
        //         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        //         XLSX.writeFile(wb, fn || ('SummaryOfArrival.' + (type || 'xlsx')));
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
             var fileName = formattedDate + "_" + "SOA";

             var htmltable= document.getElementById('tbl_exporttable_to_xls');

             var html = htmltable.outerHTML;
             element.setAttribute('href', 'data:application/vnd.ms-excel,' + encodeURIComponent(html));
             element.setAttribute('download', fileName);     
             element.click();

           
              //  newWindow=window.open(myWindow, 'filename.txt');
        }
     
</script>
@stop