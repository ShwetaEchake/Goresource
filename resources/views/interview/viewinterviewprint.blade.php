
@extends('layouts.admin')

@section('title')
Interview Print
@endsection

@section('css')

<style type="text/css">  


@media print {
  #hide-print{
    display: none;
  }

   Header {
      display: none !important;
    }
    Footer {
      display: none !important;
    }

}

</style>  

@endsection




@section('content')
<div class="container">  
    <div class="card ">
        <div class="card-body">
  <?php 
  $candinterview=DB::table('candidate_interview')->where('candidate_interview_id',$_GET['id'])->first();
  ?>












      <h4>Send Interview Detail:<span>[Selected]</span></h4><br>
      <button class="btn btn-flat btn-primary" id="hide-print" style="position: absolute;top: 10px;right: 10px;"  onclick="window.print()">
                  <i class="fa fa-print" aria-hidden="true"></i> Print</button>

    <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th> End Time</th>
                        <th> Venue</th>
                     </tr>

                     <tr> 
                        <td id="">{{date('d-m-Y',$candinterview->interview_date)}}</td>
                        <td id="">  {{date('H:i:s',$candinterview->start_time)}} </td>
                        <td id=""> {{date('H:i:s',$candinterview->end_time)}}</td>
                        <td id=""> {{$candinterview->interview_venu}} </td>
                    </tr>

                     <tr>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th> Zipcode </th>
                     </tr>

                     <tr> 
                        <td id=""> {{$candinterview->interview_city}} </td>
                        <td id=""> {{$candinterview->interview_state}} </td>
                        <td id=""> {{$candinterview->interview_country}} </td>
                       <td id="">  {{$candinterview->interview_zipcode}}</td>
                    </tr>

                     <tr>
                        <th>Interviewer Name</th>
                        <th>Interviewer Mobile No</th>
                        <th>Interviewer Email</th>
                        <th></th>
                     
                     </tr>

                     <tr> 
                        <td id=""> {{$candinterview->interviewer_name}} </td>
                        <td id=""> {{$candinterview->interviewer_mobileno}} </td>
                        <td id=""> {{$candinterview->interviewer_email}} </td>
                        <td></td>
                    </tr>
            </tbody>
   </table>

    </div>
    </div> 
</div>
@endsection




 




   



            
     