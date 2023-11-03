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
  $visa=DB::table('visa_process')->where('visa_id',$_GET['id'])->first(); 
  ?>



                    <h4>Visa Process Detail: <span>[QVC]</span></h4><br>
      <button class="btn btn-flat btn-primary" id="hide-print" style="position: absolute;top: 10px;right: 10px;"  onclick="window.print()">
                  <i class="fa fa-print" aria-hidden="true"></i> Print</button>

    <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>Issue Date</th>
                        <th>Expiry Date</th>
                        <th>Remark</th>
                      
                     </tr>

                     <tr> 
                        <td id="">{{ date('d-m-Y',$visa->issue_date)}}</td>
                        <td id="">{{ date('d-m-Y',$visa->expiry_date)}}</td>
                        <td id="">{{ $visa->remark}}</td>
                    </tr>


                     <tr>
                        <th>Ev No</th>
                        <th>Sim No</th>
                        <th>Visa Profession</th>
                      
                     </tr>

                     <tr> 
                        <td id=""> {{ $visa->ev_no }}</td>
                        <td id=""> {{ $visa->sim_no }} </td>
                        <td id="">{{  $visa->vissa_profession }} </td>
                       
                    </tr>

                     <tr>
                        <th>Attached Document 1</th>
                        <th>Attached Document 2</th>
                        <th>Attached Document 3</th>
                     </tr>
<?php $candidatePath=DB::table('personal')->where('candidate_id',$visa->candidate_id)->select('directory_path')->first();
?> 
                     <tr> 
                        <td> 
                            @if(!empty($visa->attached_document1))
                             <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$visa->attached_document1)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif
                        </td>
                        <td> 
                            @if(!empty($visa->attached_document2))
                             <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$visa->attached_document2)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif

                         </td>
                        <td> 

                            @if(!empty($visa->attached_document3))
                             <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$visa->attached_document3)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif

                        </td>
                    </tr>

                  
      </tbody>
            </table>


    </div>
    </div> 
</div>
@endsection




 




   



            
     