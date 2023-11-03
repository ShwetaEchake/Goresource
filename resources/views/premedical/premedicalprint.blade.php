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
$premedical=DB::table('pre_medical')->where('premedical_id',$_GET['id'])->first();
?>





      <h4>Pre Medical Detail: <span>[Offers]</span></h4><br>
      <button class="btn btn-flat btn-primary" id="hide-print" style="position: absolute;top: 10px;right: 10px;"  onclick="window.print()">
                  <i class="fa fa-print" aria-hidden="true"></i> Print</button> 




 <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>Medical Examination Center</th>
                        <th>Fit Date</th>
                        <th>Unfit Date</th>
                        <th>Remark</th>
                      
                     </tr>

                     <tr> 
                       
                        <td id="">
                             <?php $medical_examination=DB::table('medical_examination_center')->where('medical_examination_center_id',$premedical->medical_examination_center_id)->first();?>

                              {{ $medical_examination->medical_examination_center_name }}

                        </td>
                        <td id="fit_date"> {{ date('d-m-Y',$premedical->fit_date)}}</td>
                        <td id="unfit_date"> {{ date('d-m-Y',$premedical->unfit_date)}}</td>
                        <td id="remark">{{ $premedical->unfit_remark}}</td>
                    </tr>


                     <tr>
                        <th>Attached Document 1</th>
                        <th>Attached Document 2</th>
                        <th>Attached Document 3</th>
                        <th></th>
                     </tr>


<tr> 

<?php $candidatePath=DB::table('personal')->where('candidate_id',$premedical->candidate_id)->select('directory_path')->first();?>

                 <td> 
                    @if(!empty($premedical->attached_document1))
                    <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$premedical->attached_document1)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                    @endif
                 </td>

                 <td> 
                    @if(!empty($premedical->attached_document2))
                    <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$premedical->attached_document2)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                    @endif
                 </td>

                 <td> 
                    @if(!empty($premedical->attached_document3))
                    <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$premedical->attached_document3)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                    @endif
                 </td>


                  <td>
                  </td>
</tr>

                  
      </tbody>
            </table>
            

    </div>
    </div> 
</div>
@endsection




 
