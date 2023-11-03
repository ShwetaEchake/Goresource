<?php

use App\Models\Enquiry;


?>
@extends('layouts.admin')

@section('title')
Document
@endsection

@section('css')

<style type="text/css">
  u {
    border-bottom:1px dashed;
    text-decoration: none;
  }

  @media print {
  #hide-print{
    display: none;
  }
}
</style>
@endsection




@section('content')

 <?php 

  $enquiry=Enquiry::leftjoin('client','enquiry.client_id','=','client.client_id')->where('enquiry_id',$_GET['id'])->first(); 

  $template=DB::table('template')->where('country',$enquiry->client_country)->get();

  ?>

  <div class="card card-primary card-outline">
          <div class="card-header" id="AllDetails">
            <center>   
                <h4>Embassy of Nepal <h6>Doha, State of Qatar<h6></h4>
            </center><hr>
            <center> 
               </h5>APPLICATION FORM FOR DEMAND LETTER ATTESTATION</h5>
           </center><hr>

<h6>1.  Details of Employer Company in Qatar:</h6>
<h6>Name:     <u><?php echo $enquiry->company_name?></u></h6>
<h6>Address:  <u><?php echo $enquiry->client_address?></u>  Tel: ………….…………Fax: ..………………....…Website: <u><?php echo $enquiry->website_url?></u></h6>
<h6>Name of  HR. Manager <u><?php echo $enquiry->contact_person1?></u>. Mobile: <u><?php echo$enquiry->contact_person_mobile1?></u>.</h6>
<h6>Email: <u><?php echo$enquiry->contact_person_email1?></u>. Name of Sponsor: …………..……………...............................................</h6>
<hr>

<h6>2.  Details of License Holder Agency of Nepal: </h6>
<h6>Name: Rotary Overseas Pvt. Ltd.   Address: Kathmandu, Nepal   License No: 562/062/063</h6>
<h6>Tel(landline): + 977 - 1- 5903872, 5903873 Fax:  977-5903873 Website: www.rotaryoverseas.com </h6>
<h6>Email: info@rotaryoverseas.com  Owner's Name: Prem Prasad Dulal  Mobile:…9851048233</h6>
<hr>


<h6>3. Details of Documents Submittant:</h6>
<h6>Name: <u><?php echo$enquiry->contact_person?></u>. Qatari ID No.: …………………………Passport No: <u><?php echo$enquiry->passport_no?></u>.
</h6>
<h6>Nationality: <u><?php echo$enquiry->nationality?></u>.Position at Company: <u><?php echo$enquiry->designation?></u>
    Mobile: <u><?php echo$enquiry->contact_person_mobile?></u>. Email: <u><?php echo$enquiry->contact_person_email?></u></h6>
<hr>

<h6>4. Submitted Documents: [Please prepare the document, according to the order as follows and put Tick (√)  
mark against each attached document. visit Embassy Website: www.eondoha.gov.np]<h6>

          </div>

          <?php
  $Enq=Enquiry::leftjoin('client','enquiry.client_id','=','client.client_id')
      ->leftjoin('jobs','jobs.client_id','=','enquiry.client_id')
      ->where('enquiry.enquiry_id',$_GET['id'])->first(); 
  
          ?>
          <div class="card-body">
            <h5>Required Attachments</h5>
            <div class="row">
              <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100 " id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
               @foreach ($template as $templates)
                  <a class="nav-link" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home{{ $templates->template_id }}" role="tab" aria-controls="vert-tabs-home" aria-selected="true">{{$templates->title}}</a>
               @endforeach
                </div>
              </div>
              <div class="col-7 col-sm-9" id="printMe" >
                <div class="tab-content" id="vert-tabs-tabContent">
              @foreach ($template as $templates)
                  <div class="tab-pane text-left fade show" id="vert-tabs-home{{ $templates->template_id }}" role="tabpanel" aria-labelledby="vert-tabs-home-tab" >

          <button class="btn btn-sm btn-flat btn-primary" id="hide-print" style="margin-left:85%;"onclick="printReport('printMe')"> 
            <i class="fa fa-print" aria-hidden="true"></i> Print</button>

             
    <p>
      <?php 

    
       $Enqr=Enquiry::
         leftjoin('client','enquiry.client_id','=','client.client_id')
       ->leftjoin('jobs','jobs.enquiry_id','=','enquiry.enquiry_id')
       ->leftjoin('categories','categories.category_id','=','jobs.job_main_category_id')
       ->where('jobs.enquiry_id',$_GET['id'])->get(); 

     

//----------------------------Description of Demand-------------------Start

$mSTRDemand='<table class="waffle" width="100%" border="1px solid black">
		<tbody>
      <tr style="height: 18px"><td class="s0" colspan="13"></td></tr>
      <tr style="height: 18px"><td class="s1" colspan="13">5.  Description of Demand:</td></tr>
      <tr style="height: 18px"><td class="s2" rowspan="2">S.N.</td><td class="s2" colspan="3" rowspan="2">Proffession / Position</td>
            <td class="s3" colspan="3">NUMBER</td>
            <td class="s3" colspan="3">SALARY / ALLOWANCE</td>
            <td class="s3" colspan="3">VISA APPROVAL</td>
      </tr>
      <tr style="height: 18px">
		      <td class="s2">MALE</td><td class="s2">FEMALE</td>
          <td class="s2">TOTAL</td><td class="s2">BASIC</td>
          <td class="s2">FOOD</td><td class="s4">TOTAL</td>
          <td class="s5"><div class="softmerge-inner" style="width:45px;left:-3px">TOTAL</div></td>
          <td class="s2">USED</td><td class="s2">REM</td>
      </tr>';
//----------------------------Description of Demand-------------------End


//----------------------------Description of Demand-------------------Start

      $mSTRDetail=
   '<table width ="100%" class="waffle" width="100%" border="1px solid black">
      <tbody>
      <tr style="height: 18px"><td class="s0" colspan="13">Details of Nepali Workers [Add Pages as required]</td></tr>
      <tr style="height: 18px"><td class="s1" rowspan="2">S.N.</td><td class="s1" colspan="3" rowspan="2">NAME OF THE WORKER</td><td class="s1" colspan="2" rowspan="2">JOB CATEGORY</td><td class="s1" colspan="3">SALARY</td><td class="s1"></td><td class="s1"></td><td class="s1" colspan="2"></td>
      </tr>
      <tr style="height: 18px">
      <td class="s1">BASIC</td><td class="s2">FOOD</td><td class="s3 softmerge"><div class="softmerge-inner" style="width:45px;left:-3px">TOTAL</div></td><td class="s3 softmerge"><div class="softmerge-inner" style="width:85px;left:-3px">PASSPORT NO</div></td><td class="s4 softmerge"><div class="softmerge-inner" style="width:45px;left:-3px">QID NO</div></td><td class="s1" colspan="2">MED.NO</td>
      </tr>';
//----------------------------Description of Demand-------------------End


// --------------------------------DEMAND LETTER------------------------------------Start

$mSTRDEMANDLETTER=
        '<tr style="height: 18px">
           <td class="s5">SL</td><td class="s5" colspan="3">CATEGORIES</td><td class="s5">SEX</td><td class="s5" colspan="2">QTY</td><td class="s5" colspan="2">SALARY IN QR</td><td class="s5" colspan="2">FOOD ALLOW.</td><td class="s5" colspan="3">TOTAL IN QR</td>
        </tr>';

// --------------------------------DEMAND LETTER------------------------------------End


// --------------------------------EMPLOYMENT CONTRACT------------------------------------End

$mSTRCONTRACT=
    '<tr style="height: 18px"><td class="s8">SL</td>
      <td class="s8" colspan="3">CATEGORIES</td><td class="s8">SEX</td><td class="s8" colspan="2">QTY</td><td class="s8" colspan="2">SALARY IN QR</td><td class="s8" colspan="2">FOOD ALLOW.</td><td class="s8" colspan="3">TOTAL IN QR</td>
    </tr>';

// --------------------------------EMPLOYMENT CONTRACT------------------------------------End

foreach( $Enqr as $index=> $category ) {
$indexkey=$index;
$indexkeys=$index;
$indexkeyss=$index;

             $mSTRDemand.=
             '<tr style="height: 18px">
          				<td class="s6">'.++$index.'</td>
                  <td class="s3" colspan="3">'.$category->category_name.'</td>
                  <td class="s7"></td><td class="s7"></td>
                  <td class="s7"></td><td class="s7"></td>
                  <td class="s7"></td><td class="s7"></td>
                  <td class="s7"></td><td class="s7"></td>
                  <td class="s7"></td>
              </tr>';

              $mSTRDetail.= 
               '<tr style="height: 18px">
                  <td class="s5">'.++$indexkey.'</td>
                  <td class="s6" colspan="3"> </td>
                  <td class="s6" colspan="2">'.$category->category_name.'</td>
                  <td class="s6"></td><td class="s6"></td>
                  <td class="s6"></td><td class="s6"></td>
                  <td class="s6"></td><td class="s6" colspan="2"></td>
                </tr>';

                $mSTRDEMANDLETTER.= 
                     '<tr style="height: 18px">
                          <td class="s5">'.++$indexkeys.'</td>
                          <td class="s5" colspan="3">'.$category->category_name.'</td>
                          <td class="s5"></td><td class="s5" colspan="2"></td>
                          <td class="s5" colspan="2"></td>
                          <td class="s5" colspan="2"></td>
                          <td class="s5" colspan="3"></td>
                      </tr>';

               $mSTRCONTRACT.= 
                      '<tr style="height: 18px">
                          <td class="s8">'.++$indexkeyss.'</td>
                          <td class="s8" colspan="3">'.$category->category_name.'</td>
                          <td class="s8"></td><td class="s8" colspan="2"></td>
                          <td class="s8" colspan="2"></td>
                          <td class="s8" colspan="2"></td>
                          <td class="s8" colspan="3"></td>
                      </tr>';
      }



$mSTRDemand.='</tbody>
</table>';


$mSTRDetail.='</tbody>
</table>';





          $string = [ "[[Employment_Contract]]", "[[Demand_letter]]", "[[Detail_Workers]]", "[[DEMAND_DESCRIPTION]]",
                      "contact_person1","contact_person_mobile1", 
                      "contact_person_email1","website_url","client_address",
                      "company_name","contactpersonname","contactpersonmobile","contactpersonemail","passport_no","nationality",
                      "designation",
                      "contract_period","place_of_work","air_fare","duty_hours","overtime_hours","trial_period"," employment_visa",
                      "accomodation_status","food_status","medical_status","transportation_status","uniform_status","other_benefits",
                      "other_condition"

                    ];

          $replace   =[ $mSTRCONTRACT, $mSTRDEMANDLETTER, $mSTRDetail,$mSTRDemand,$Enq->contact_person1,$Enq->contact_person_mobile1, 
                        $Enq->contact_person_email1,
                        $Enq->website_url,$Enq->client_address,
                        $Enq->company_name,$Enq->contact_person,$Enq->contact_person_mobile,$Enq->contact_person_email,$Enq->passport_no,
                        $Enq->nationality,$Enq->designation,

                        $Enq->contract_period,$Enq->place_of_work,$Enq->air_fare,$Enq->duty_hours,$Enq->overtime_hours,
                        $Enq->trial_period,$Enq->employment_visa,$Enq->accomodation_status,$Enq->food_status,$Enq->medical_status, 
                        $Enq->transportation_status,$Enq->uniform_status,$Enq->other_benefits,$Enq->other_condition


                      ];

                        echo str_replace($string, $replace, $templates->template);
      ?> 
  </p>
               
                  </div>
              @endforeach
                  
                </div>
              </div>
            </div>
        
           
          </div>
          <!-- /.card -->
        </div>



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















{{--<div class="container">
  <div class="row">
    <div class="col-6">
      <div class="card mt-3 tab-card">
        <div class="card-header tab-card-header">
          <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true">One</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false">Two</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="Three" aria-selected="false">Three</a>
            </li>
          </ul>
        </div>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
            <h5 class="card-title">Tab Card One</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>              
          </div>
          <div class="tab-pane fade p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
            <h5 class="card-title">Tab Card Two</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>              
          </div>
          <div class="tab-pane fade p-3" id="three" role="tabpanel" aria-labelledby="three-tab">
            <h5 class="card-title">Tab Card Three</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>              
          </div>

        </div>
      </div>
    </div>
  </div>
</div>--}}
@endsection
