@extends('layouts.admin')

@section('title')
Post Assesmnt Print
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
  $qvc=DB::table('qvc_process')->where('qvc_id',$_GET['id'])->first(); 
  ?>



      <h4>Qvc Process Detail: <span>[Medical Fit]</span></h4><br>
      <button class="btn btn-flat btn-primary" id="hide-print" style="position: absolute;top: 10px;right: 10px;"  onclick="window.print()">
                  <i class="fa fa-print" aria-hidden="true"></i> Print</button>

 <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>Applied Date</th>
                        <th>Appointment Date</th>
                        <th>Fit Date</th>
                        <th>Fit Remark</th>
                     </tr>

                     <tr> 
                        <td id="">{{ date('d-m-Y',$qvc->client_applied_date) }}</td>
                        <td id=""> {{ date('d-m-Y',$qvc->appointment_date) }} </td>
                        <td id="">{{ date('d-m-Y',$qvc->medical_fit_date) }} </td>
                        <td id=""> {{ $qvc->medical_fit_remark}}<td>      
                    </tr>

                    <tr>
                          <th>Unfit Date</th>
                          <th>Unfit Remark</th>
                          <th>Report Pending</th>
                          <th>ReportPending Remark</th>
                    </tr>

                    <tr>
                         <td id="">{{ date('d-m-Y',$qvc-> medical_unfit_date) }} </td>
                         <td id="">{{$qvc->medical_unfit_remark}}</td>
                         <td id="">{{date('d-m-Y',$qvc->report_pending)}} </td>
                         <td id="">{{$qvc->report_pending_remark}} </td>
                         
                    </tr>

                    <tr>
                          <th>Reschedule</th>
                          <th>Reschedule Remark</th>
                          <th></th><th></th>
                    </tr>
                    <tr>
                          <td id=""> {{date('d-m-Y',$qvc->reschedule)}} </td>
                          <td id="">{{$qvc->reschedule_remark}} </td>
                          <td></td><td></td>
                    </tr>





                     <tr>
                        
                        <th>Attached Document 1</th>
                        <th>Attached Document 2</th>
                        <th>Attached Document 3</th>
                        <th></th>
                       
                     </tr>
<?php $candidatePath=DB::table('personal')->where('candidate_id',$qvc->candidate_id)->select('directory_path')->first();
?>
                     <tr> 
                       
                        <td> 
                            @if(!empty($qvc->attached_document1))
                                 <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$qvc->attached_document1)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif

                        </td>

                        <td> 
                            @if(!empty($qvc->attached_document2))
                                 <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$qvc->attached_document2)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif
                        </td>

                        <td> 
                            @if(!empty($qvc->attached_document3))
                                 <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$qvc->attached_document3)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif

                        </td>
                        <td></td>

                      
                    </tr>

                  
      </tbody>
            </table>


    </div>
    </div> 
</div>
@endsection




 




   



            
     