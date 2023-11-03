@extends('layouts.admin')

@section('title')
Visa Print
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
  $deployment=DB::table('deployment_process')->where('deployment_id',$_GET['id'])->first(); 
  ?>



      <h4>Deployment Process Detail: <span>[Visa]</span></h4><br>
      <button class="btn btn-flat btn-primary" id="hide-print" style="position: absolute;top: 10px;right: 10px;"  onclick="window.print()">
                  <i class="fa fa-print" aria-hidden="true"></i> Print</button>

    <table class="table table-bordered table-striped">
                <tbody>
                     <tr>
                        <th>Ticket No</th>
                        <th>PNR No</th>
                        <th>Flight No</th>
                     </tr>

                     <tr> 
                          <td id="">{{$deployment->ticket_no}}</td>
                          <td id="">{{$deployment->pnr_no}}</td>
                          <td id="">{{$deployment->flight_no}}</td>
                    </tr>


                     <tr>
                        <th>Flight Date</th>
                        <th>Duration</th>
                        <th>Destination / Sector</th>
                     </tr>

                     <tr> 
                        <td id="">{{date('d-m-Y',$deployment->flight_date)}} </td>
                        <td id="">{{$deployment->duration}}</td>
                        <td id="">{{$deployment->destination}} </td>
                    </tr>



                     <tr>
                        <th>Departure Date</th>
                        <th>Departure Time</th>
                        <th>Arrival Date</th>
                     </tr>

                     <tr> 
                        <td id="">{{date('d-m-Y',$deployment->departure)}}</td>
                        <td id="">{{date('d-m-Y',$deployment->departure_time)}}</td>
                        <td id="">{{date('d-m-Y',$deployment->arrival)}}</td>
                        
                    </tr>

                    <tr>
                        <th>Arrival Time</th>
                        <th>PCR Test</th>
                        @if($deployment->pcr_test =="positive")
                        <th> Positive Date</th>
                         @endif
                    </tr>

                    <tr>
                        <td id="">{{ date('d-m-Y',$deployment->arrival_time) }}</td>
                        <td id="">{{ $deployment->pcr_test}}</td>
                        @if($deployment->pcr_test =="positive")
                        <td id=""> {{ date('d-m-Y',$deployment->positive_date) }}</td>
                        @endif
                    </tr>



                     <tr>   
                      @if($deployment->pcr_test =="positive")
                            <th> Positive Time</th> 
                      @endif
                      @if($deployment->pcr_test =="negative")
                            <th> Negative Date</th>
                            <th> Negative Time</th>   
                      @endif
                     </tr>

                     <tr>
                        @if($deployment->pcr_test =="positive")
                           <td id="">{{ date('H:i:s',$deployment->positive_time) }} </td>
                        @endif
                        @if($deployment->pcr_test =="negative")
                           <td id="">{{ date('d-m-Y',$deployment->negative_date) }} </td>
                           <td id="">{{ date('H:i:s',$deployment->negative_time) }} </td>   
                        @endif
                    </tr>





                     <tr>
                        <th>(PCR Test)</th>
                        <th>(Flight Ticket)</th>
                        <th>(QR Code)</th>
                       
                     </tr>
<?php $candidatePath=DB::table('personal')->where('candidate_id',$deployment->candidate_id)->select('directory_path')->first();
?>
                     <tr> 
                        <td> 
                            @if(!empty($deployment->attached_document1))
                             <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$deployment->attached_document1)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif

                        </td>
                        <td> 
                            @if(!empty($deployment->attached_document2))
                             <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$deployment->attached_document2)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif
                        </td>

                        <td> 
                            @if(!empty($deployment->attached_document3))
                             <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$deployment->attached_document3)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif

                        </td>

                        
                    </tr>

                  
      </tbody>
            </table>


    </div>
    </div> 
</div>
@endsection




 




   



            
     