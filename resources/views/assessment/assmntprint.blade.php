
@extends('layouts.admin')

@section('title')
Assessment print
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

  <?php $data=DB::table('assessment')->where('assessment_id',$_GET['id'])->first(); ?>



       <h4>Assessment Detail :<span>[Shortlist]</span></h4><br>
      <button class="btn btn-flat btn-primary" id="hide-print" style="position: absolute;top: 10px;right: 10px;"  onclick="window.print()">
                  <i class="fa fa-print" aria-hidden="true"></i> Print</button>

    <table class="table table-bordered table-striped">
                <tbody>                    
                        <th>Rating:</th>
                        <th></th>
                        <th>Remarks:</th>
                   
                        <tr>
                            <th> Personality Appearence </th>
                            <td id=""> {{$data->personality_appearence}} </td>
                            <td id="">{{$data->personality_remark}}  </td>
                        </tr>


                        <tr>
                            <th> Knowledge </th>
                            <td id=""> {{$data->knowledge}} </td>
                            <td id=""> {{$data->knowledge_remark}}</td>
                        </tr>


                        <tr>
                            <th> Ledership </th>
                            <td id=""> {{$data->ledership}} </td>
                            <td id=""> {{$data->leadership_remark}} </td>
                        </tr>
                             

                        <tr>
                            <th> Communication </th>
                            <td id="">  {{$data->communication}} </td>
                            <td id=""> {{$data->communication_remark}} </td>
                        </tr>


                         <tr>
                              <th> Other Assessment </th>
                              <td id=""> {{$data->other_assessment}} </td>
                              <td id=""> {{$data->other_assessment_remark}} </td>
                         </tr>


                         <th>Education:</th>
                         <th></th>
                         <th></th>

                        <tr>
                            <th> DEGREE OBTAINED </th>
                            <td id=""> {{$data->degree_optain}} </td>
                        </tr>
                         <tr>
                            <th> PROFESSTIONAL LICENSE NO.   </th>
                            <td id=""> {{$data->professional_licence_no}} </td>
                        </tr>
                         <tr>
                            <th> TECHNICAL QUALIFICATION </th>
                            <td id="">{{$data->technical_qualification}} </td>
                        </tr>
                         <tr>
                            <th>KEY SKILLS   </th>
                            <td id=""> {{$data->key_skill}} </td>
                        </tr>
                          <tr>
                            <th> TRADE TEST  </th>
                            <td id="">{{$data->trade_test}} </td>
                        </tr>

                     <tr>
                         <th>Language Used</th>
                         <th>English </th>   
                         <th> Hindi </th>
                         <th> Other</th>
                    </tr>

                      <tr>
                         <th>Rafting</th>
                         <td id="">  {{$data->languge_used}} </td>   
                         <td id=""> {{$data->languge_used1}} </td>
                         <td id=""> {{$data->languge_used2}} </td>
                      </tr>


                      <th>Work Experience</th>
                      <tr>
                          <th></th>
                          <th>POSITION HELD</th>
                          <th>TOTAL YEARS/MONTHS</th>
                      </tr>

                      <tr>
                          <th>LOCAL</th>
                          <td id=""> {{$data->local_work_experience}}</td>
                          <td id=""> {{$data->local_experience_year}}</td>
                      </tr>

                      <tr>
                          <th>OVERSEAS</th>
                          <td id=""> {{$data->overseas_expereicne}}</td>
                          <td id="">{{$data->overseaase_year}}</td>
                      </tr>


                      <th>Overall Assessment</th>
                      <th>Overall Rating</th>
                      <th>Remark</th>
                      <tr>
                          <td id="">{{$data->overall_assessment}}</td>
                          <td id="">{{$data->overall_rating}}</td>
                          <td id="">{{$data->remark}}</td>
                      </tr>
                </tbody>
 </table>



    </div>
    </div> 
</div>
@endsection




 




   



            
     