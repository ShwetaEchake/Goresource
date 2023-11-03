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
$offerform =DB::table('offer_letter')->where('offer_letter_id',$_GET['id'])->first();
?>


        <h4>Offer Letter Detail: <span>[Selection]</span></h4><br>
       <button class="btn btn-flat btn-primary" id="hide-print" style="position: absolute;top: 10px;right: 10px;"  onclick="window.print()">
                  <i class="fa fa-print" aria-hidden="true"></i> Print</button>





<table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>Issue Date</th>
                        <th>Signed Date</th>
                        <th>Refuse Date</th>
                        <th>Remark</th>
                      
                     </tr>

                     <tr> 
                       
                        <td id="">{{date('d-m-Y',$offerform->issue_date)}} </td>
                        <td id="">{{date('d-m-Y',$offerform->signed_date)}}  </td>
                        <td id="">{{date('d-m-Y',$offerform->refuse_date)}} </td>
                        <td id="">{{$offerform->remark}} </td>
                    </tr>


                     <tr>
                        <th>Attached Document 1</th>
                        <th>Attached Document 2</th>
                        <th>Attached Document 3</th>
                        <th></th>
                     </tr>

<?php $candidatePath=DB::table('personal')->where('candidate_id',$offerform->candidate_id)->select('directory_path')->first();?>
                     <tr> 
                          <td> 
                             @if(!empty($offerform->attached_document1))
                              <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$offerform->attached_document1)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                             @endif
                          </td>

                            <td>
                                @if(!empty($offerform->attached_document2))
                                  <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$offerform->attached_document2)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                                @endif
                            </td>

                            <td>      
                                @if(!empty($offerform->attached_document3))
                                 <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$offerletter->attached_document3)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
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


