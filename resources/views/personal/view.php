<?php
use App\Models\Country;
use App\Models\Branch;
?>

@extends('layouts.admin')

@section('title')
Candidates
@endsection

@section('css')
<style type="text/css">
  #chkPassport, #chkCheckAll
  {
    width: 20px;
    height: 20px;
  }


    table tr {
  border: 1px solid #dee2e6;
  
}
  </style>
@endsection




@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title "><i class="fa fa-paw mr-1"></i>
                    Candidates</h3>
          @if(auth()->user()->user_type!='Executive')
            <div class="card-tools">
                <a href="{{ route('personal.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Candidates</a>
            </div>
          @endif
      </div>



    <!-- /.card-header -->
    <div class="card-body table-responsive ">

  <!------------------------Candidate Search Start ------------------------------->
<form action="{{ route('advance_search') }}" method="GET">
<h3> Search</h3><br>

<div class="row">

       

         <div class="col-lg-3">
               <select class="form-control select2" name="branch_id" id="branch_id">
                  <option value="">-Branch Name</option>
                  @foreach ($branch as $name)
                  <option value="{{ $name->branch_id }}">{{ $name->branch_name }}</option>
                  @endforeach
                </select>  
         </div>

           <div class="col-lg-3">
                <input type="text" name="candidate_id" class="form-control" placeholder="Candidate ID"><br>
           </div>
    
</div>

<div class="row">

        <div class="col-lg-3">
           <input type="text" name="name" class="form-control" placeholder="First Name"><br>
        </div>

         <div class="col-lg-3">
            <input type="text" name="middle_name" class="form-control" placeholder="Middle Name"><br>
        </div>

         <div class="col-lg-3">
            <input type="text" name="last_name" class="form-control" placeholder="Last Name"><br>
        </div>

         <div class="col-lg-3">
             <input type="text" name="age" class="form-control" placeholder="Age"><br>
        </div>

</div>
  
<div class="row">

            <div class="col-lg-3">
                <select class="form-control valdation_select" name="gender" id="gender">
                    <option value=''> -Gender </option>  
                    <option value='Male' > Male</option>  
                    <option value='Female'> Female </option>   
                    <option value='Other'> Other </option>   
                </select>         
            </div>

            <div class="col-lg-3">
                <select class="form-control valdation_select" name="merital_status" id="merital_status">
                    <option value=''> -Marital Status </option>  
                    <option value='Married' > Married</option>  
                    <option value='Unmarried'> Unmarried </option>   
                </select>         
            </div>


            <div class="col-lg-3">
               <select class="form-control select2" name="citizenship" id="citizenship">
                  <option value="">-Country</option>
                  @foreach ($country as $name)
                  <option value="{{ $name->country_id }}">{{ $name->country_name }}</option>
                  @endforeach
                </select>  
           </div>

          <div class="col-lg-3">
                <select class="form-control select2" name="language" id="language">
                  <option value="">-Language</option>
                  @foreach ($languages as $language)
                    <option value="{{ $language->language_id }}">{{ $language->language_name }}</option>
                  @endforeach
                </select>  
         </div>

</div><br>


<div class="row">
            <div class="col-lg-3">
                 <input type="text" name="religion" class="form-control" placeholder="Religion"><br>
            </div>

             <div class="col-lg-3">
                  <input type="text" name="other_skill" class="form-control" placeholder="Other Skill"><br>
            </div>

             <div class="col-lg-3">
               <input type="text" name="computer_skill" class="form-control" placeholder="Computer Skill"><br>
            </div>

            <div class="col-lg-3">
              <input type="text" name="hobbies_sport" class="form-control" placeholder="Hobbies Sport"><br>
            </div>
</div>


 <div class="row">

             <div class="col-lg-3">
                    <select class="form-control valdation_select" name="education_type" id="education_type">
                         <option value=''> -Education Type </option>  
                         <option value='Grade6' > Grade 6 </option>  
                         <option value='Grade10'> Grade 10</option>   
                         <option value='Diploma' >Diploma </option>  
                         <option value='Degree'>Degree</option> 
                         <option value='Btech'> BTech</option>   
                         <option value='ITI'>ITI</option> 
                         <option value='IIT'> IIT</option>   
                         <option value='Vocational'> Vocational</option>   
                         <option value='Pluse2'> Pluse 2</option>   
                    </select>  
             </div>

            <div class="col-lg-3">
                  <input type="text" name="course_name" class="form-control" placeholder="Course Name"><br>
            </div>

            <div class="col-lg-3">
                   <input type="text" name="designation" class="form-control" placeholder="Designation"><br>
            </div>

             <div class="col-lg-3">
                  <select class="form-control valdation_select" name="type" id="experience_type">
                         <option value=''>-Experience Type </option>  
                         <option value='Local'> Local </option>  
                         <option value='Abroad'> Abroad </option>  

                    </select>  
            </div>

            

          
</div>


<div class="row">
           

             <div class="col-lg-3">
                  <input type="text" name="totalyear" class="form-control" placeholder="Total Year of Experience"><br>
            </div>

            

            <div>
                <input type="submit" value="Search" class="btn btn-secondary">
            </div>

</div><br>

</form>
<!------------------------Candidate Search End ------------------------------->

<br>

<!-------------------- Buttons Start -------------------------------->

<div class="card-tools float-right">
        <div class="row" style="margin-bottom: 7%;">
 <a href='' class='btn btn-flat btn-success' title='Export' id='SelectedRecord'> 
        <i class='fa fa-file-excel-o' style='font-size:20px'></i>
        Export
 </a>&nbsp;

 <button href="" class="btn btn-flat btn-success"  id="candidatedata" data-toggle='modal' data-target='#shortlist'>
  <i class='fa fa-list-alt' style='font-size:20px'></i> Shortlist</button>&nbsp;

 <button  class='btn btn-flat btn-success' id="CandidateEmail" data-toggle='modal' data-target='#mail'> 
     <i class='fa fa-paper-plane' style='font-size:20px'></i> Send Mail</button>&nbsp;

 <button  class='btn btn-flat btn-success' id="CandidateSms" data-toggle='modal' data-target='#sms'>   <i class='fa fa-sms' style='font-size:20px'></i> Send Sms</button>&nbsp;

        </div>
</div>

<!-------------------- Buttons End -------------------------------->


   
  

        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>
                         @if($data->count() > 0)
                        <input type='checkbox' id='chkCheckAll'/></th>
                         @endif
                        <th width="5%">Photo</th>
                        <th width="25%">Personal </th>
                        <th width="25%">Professinal </th>
                        <th width="25%">Qualification</th>
                        <th width="20%">Action</th>
                       
                </tr>
            </thead>
            <tbody>
                   @forelse ($data as $candidate)
                    <tr>
                        <td> <input type="checkbox" id="chkPassport" name="checkArrya" class="checkBoxClass" value="<?php echo $candidate->candidate_id ?>" ></td>

                        <td>
                             <?php


                  $candidate_documentPhoto=DB::table('candidate_documents')->leftjoin('document_type','document_type_id','=','candidate_documents.document_title')
                     ->where('candidate_id',$candidate->candidate_id)
                     ->where('document_type_name','Color Photo')->first(); 


                  $candidate_documents=DB::table('candidate_documents')->leftjoin('document_type','document_type_id','=','candidate_documents.document_title')
                     ->where('candidate_id',$candidate->candidate_id)
                     ->where('document_type_name','Resume')->first(); 

                        
            if(isset($candidate_documentPhoto) && ($candidate_documents)){ 

			    $candidateResumePath='documents/Candidate/' .$candidate->directory_path.'/'.$candidate_documents->document_path;
				?>
                        <img src="{{asset('documents/Candidate/' .$candidate->directory_path.'/'.$candidate_documentPhoto->document_path)}}"  width="110px" height="110px"  alt="Image">

                <?php }else{ $candidateResumePath='';?>
                        <img src="{{ asset('img/no-user.jpg') }}" width="100px;" height="100px;">
             <?php } ?>
                        </td>

                              <?php

				 $experience_detail= DB::table('personal')
                                 ->leftjoin('experience','experience.candidate_id','=','personal.candidate_id')
                                 ->where('personal.candidate_id',$candidate->candidate_id)
                                ->first();

                              ?>

                     <td>
                     <p>
                       <a href='personal/<?php echo $candidate->candidate_id ?>/' target='_blank' style='color:black;font-weight:600' class='' title='Candidate Detail'> {{ $candidate->name }} {{ $candidate->middle_name}} {{ $candidate->last_name}}
                       </a>
                     </p>
                       <h6><b>Experience:</b> {{ $experience_detail->totalyear }} </h6>
                       <h6><b>Location:</b>   {{ $experience_detail->location }}</h6>
                       <h6><b>Age: </b>       {{ $candidate->age }} Year's</h6>
                     </td>


                     <td>
                         <p><b>{{$experience_detail->company_name}}</b></p>
                         <h6 style="color:#808080"> {{ $experience_detail->designation }}</h6>
                         <h6 style="color:#808080">@if(isset($experience_detail->from_date)) 
                                                     {{ date('d-m-Y',strtotime($experience_detail->from_date)) }}-
                                                   @endif
                                                   @if(isset($experience_detail->to_date))
                                                    {{ date('d-m-Y',strtotime($experience_detail->to_date)) }}
                                                   @endif
                         </h6>
                     </td>


                         <?php $education_data= DB::table('personal')
                             ->leftjoin('education','education.candidate_id','=','personal.candidate_id')
                             ->where('personal.candidate_id',$candidate->candidate_id)
                             ->first();
                          ?>
                     <td>
                       <p><b>{{ $education_data->school_university_name }}</b><p>
                       <h6 style="color:#808080">{{ $education_data->course_name }}</h6>
                       <h6 style="color:#808080">{{ $education_data->completed_year }}</h6>
                     </td>

                         

                        
                      


                        <td>

                    <div class="row">
                       {{-- <a class="btn btn-sm btn-primary"  href="{{ route('personal.show',$candidate->candidate_id ) }}"><i class="fa fa-eye"></i> </a>&nbsp;--}}

                            
                    {{--   <a class="btn btn-sm btn-dark" href="{{ route('assessment.create',$candidate->candidate_id ) }}"><i class="fa fa-file"></i> Assessment</a>&nbsp;--}}


                          <a class="btn btn-flat btn-sm btn-info resumeModal2 " data-id="{{$candidateResumePath}}" data-toggle="modal" data-target="#resumeModal" title="Resume"  href=""><i class=" fa fa-file"></i> </a>&nbsp;


                           <a class="btn btn-flat btn-sm btn-primary" title="Pdf"  href="{{url('/pdf')}}?id={{$candidate->candidate_id}}"><i class=" fa fa-file-pdf-o"></i> </a>&nbsp;

                        
                       <a class="btn btn-flat btn-sm btn-warning" title="Edit" href="{{ route('personal.edit',$candidate->candidate_id ) }}"><i class="fa fa-edit"></i> </a>&nbsp;


                        <form action="{{ route('personal.destroy',$candidate->candidate_id ) }}" method="POST" onclick="return confirm(' Are you sure you want to Delete?')">

                            @csrf
                            @method('DELETE') 
                        <button type="submit" class="btn btn-flat btn-sm btn-danger"  title="Delete" ><i class="fa fa-trash-alt"> </i></button>
                        </form>

                    </div>
                        
                           

                        </td>

                    </tr>
                @empty
                   <!--  <tr>
                        <td><i class="fas fa-folder-open"></i> No Record found </td>
                    </tr> -->
                @endforelse
            </tbody>
        </table><br>
         <div class="float-right">
        	  {{ $data->onEachSide(1)->links() }}
        	 <!--  {{ $data->appends(request()->except('page'))->links() }} -->
        </div>
    </div>
    <!-- /.card-body -->
  </div>


<!----------------------------- Resume PopUp ------------------------------->

<!-- Modal -->
<div class="modal fade" id="resumeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Resume</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	 <div id="pdfId">
	    <embed src="/resources/audio/_webbook_0001/embed_test.mp3" type="audio/mpeg" id="audio_"/>
	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!----------------------------- Resume PopUp End------------------------------->

<!----------------------------- Shortlist Start ---------------------------->

  <div class="modal fade" id="shortlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLongTitle">Shortlist</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>

   <div class="modal-body"><!-- modal-body start-->
     <form method="POST" action="personal/shortlist"  enctype="multipart/form-data">
           @csrf

                  
                        <input type="hidden" name="names" id="multipleids"><br>
                    
                         <label>Company Name</label>
                          <select class="form-control select2" name="clientid" id="client_id" required>
                              <option value="">-select-</option>

                              @foreach ($client as $data)
                              <option value="{{ $data->client_id }}">{{ $data->company_name }}</option>
                              @endforeach
                          </select>  
                          <br>
                        
              
                         <label>Enquiry</label>
                         <select class="form-control select2" name="enquiryid" id="enquiry_id" required></select>  
                         <br>

                         <label>Job  </label>
                         <select class="form-control select2" name="jobid" id="job_id" required></select>
                         <br>

                         <label>Location  </label>
                         <select class="form-control select2" name="location" id="location" required></select>
                              
                
                 <br>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
 
    </form>
</div><!-- modal-body end-->

                

    </div>
  </div>
</div>
 <!----------------------------- Shortlist End ---------------------------->



 <!----------------------------- Email Start ---------------------------->

  <div class="modal fade" id="mail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><!-- modal-body start-->
        <form method="POST" action="emailtemplate/email" >
              @csrf
                        <input type="hidden" name="candidateidemail" id="candidate_emailid"><br>
                
                       <label for="Title">Title</label>
                         <select class="form-control select2" name="email_title" id="email_title" required>
                             <option value="">-Select-</option>
                             @foreach ($emailtemplates as $data)
                             <option value="{{ $data->email_template_id }}">{{$data->email_title}}</option>
                             @endforeach
                         </select>  
                         <br>      
              
                             <label for="First Name">Email Template</label>
                            <textarea type="text" name="email_template"  id="email_template" class="form-control @error('email_template') is-invalid @enderror" value="{{ old('email_template') }}" required ></textarea>
                            @error('email_template')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
               

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Mail</button>
                </div>
    

      </form>
  </div> <!-- modal-body end-->
</div>
</div>
</div>

 <!----------------------------- Email End ---------------------------->



  <!----------------------------- SMS End ---------------------------->


<div class="modal fade" id="sms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">SMS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><!-- modal-body start-->
        <form method="POST" action="smstemplate/SendSMS" >
              @csrf
                   
                <input type="hidden" name="candidateidsms" id="candidate_smsid"><br>
                         
                            <label for="Title">Title</label>
                            <select class="form-control select2" name="sms_title" id="sms_title" required>
                                    <option value="">-Select-</option>
                                    @foreach ($smstemplates as $data)
                                    <option value="{{ $data->sms_template_id }}">{{$data->sms_title}}</option>
                                    @endforeach
                            </select>
                                     
                             <br>

                           <label for="First Name">Sms Template</label>
                           <textarea type="text" name="sms_template"  id="sms_template" class="form-control @error('sms_template') is-invalid @enderror" value="{{ old('sms_template') }}" required ></textarea>
                            @error('sms_template')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                     
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                 </div>
    

      </form>
   </div> <!-- modal-body end-->
</div>
</div>
</div>

  <!----------------------------- SMS  End ---------------------------->



@endsection



@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script src="{{asset('plugins/select2/js/select2.full.min.js')}}" defer> </script>

<script type="text/javascript">
$(document).ready(function(){
    var table = $('#example').DataTable({
       orderCellsTop: true,
       fixedHeader: true 
    });

    //Creamos una fila en el head de la tabla y lo clonamos para cada columna
    $('#example thead tr').clone(true).appendTo( '#example thead' );

    $('#example thead tr:eq(1) th').each( function (i) {
        var title = $(this).text(); //es el nombre de la columna
          if (title != 'Action') {
        $(this).html( '<input type="text" placeholder="'+title+'" class="form-control" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        });
    }
    } );   



$('#branch_id').select2();
$('#citizenship').select2();
$('#language').select2();
$('#education_type').select2();
$('#experience_type').select2();
$('#language').select2();
$('#merital_status').select2();
$('#gender').select2();


$('#client_id').select2({
              dropdownParent: $('#shortlist')
    });

$('#enquiry_id').select2({
              dropdownParent: $('#shortlist')
    });

$('#job_id').select2({
              dropdownParent: $('#shortlist')
    });

$('#location').select2({
              dropdownParent: $('#shortlist')
    });


$('#email_title').select2({
              dropdownParent: $('#mail')
    });

 $('#sms_title').select2({
              dropdownParent: $('#sms')
    });
 

    // for email template

     $('#email_title').change(function(){
  var clientID = $(this).val();
    
  if(clientID){
    $.ajax({
      type:"GET",
      url:"{{url('getmailtemplate')}}?email_title="+clientID,
      success:function(res){  
           
       if(res){
       
        $("#email_template").empty();
        $("#email_template").append('<option>Select Enquiry</option>');

  $.each(res,function(key,value){

          $("#email_template").append(value.email_template);
        });
      }else{
        $("#email_template").empty();
      }
      }
    });
  }else{
    $("#email_template").empty();
  
  }   
  });


     // for SMS template


     $('#sms_title').change(function(){
  var clientID = $(this).val();
    
  if(clientID){
    $.ajax({
      type:"GET",
      url:"{{url('getsmstemplate')}}?sms_title="+clientID,
      success:function(res){  
           
       if(res){
                      
        $("#sms_template").empty();
        $("#sms_template").append('<option>Select Enquiry</option>');

  $.each(res,function(key,value){
            $("#sms_template").append(value.sms_template);
        });
      }else{
        $("#sms_template").empty();
      }
      }
    });
  }else{
    $("#sms_template").empty();
  
  }   
  });



     // dependent dropdown

$('#client_id').change(function(){
  var clientID = $(this).val();  
  if(clientID){
    $.ajax({
      type:"GET",
      url:"{{url('getEnquiry')}}?client_id="+clientID,
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




     $('#enquiry_id').change(function(){
  var enquiryID = $(this).val();  
  if(enquiryID){
    $.ajax({
      type:"GET",
      url:"{{url('getJob')}}?enquiry_id="+enquiryID,
      success:function(res){  
      if(res){
        $("#job_id").empty();
        $("#job_id").append('<option>Select Enquiry</option>');
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




     $('#job_id').change(function(){
  var enquiryID = $(this).val();  
  if(enquiryID){
    $.ajax({
      type:"GET",
      url:"{{url('getLocation')}}?job_id="+enquiryID,
      success:function(res){  
      if(res){
        $("#location").empty();
        $("#location").append('<option>Select Location</option>');
        $.each(res,function(key,value){
          $("#location").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#location").empty();
      }
      }
    });
  }else{
    $("#location").empty();
  }   
  });


});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script>
//----------------------------------Shortlist Start--------------------------------------

$(function(e){
    
        $("#chkCheckAll").click(function(){
          $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        })

        $("#candidatedata").on('click',function(e){
          e.preventDefault();
          
          var allids =[];

    
          $("input:checkbox[name=checkArrya]:checked").each(function(){
           // alert($(this).val());
            allids.push($(this).val());
           })


          if(allids.length <=0)
            {
                alert("Please select atleast one record to shortlist.");
                return false;
            } 
          else {

                 var join_selected_values=allids.join(",");
                  //alert(join_selected_values);
                 document.getElementById("multipleids").value = join_selected_values;

               }
          

        })
});
//----------------------------------Shortlist End--------------------------------------

</script>


<script type="text/javascript">
  
//----------------------------------Export Start--------------------------------------

  $(function(e){
        $("#chkCheckAll").click(function(){
          $(".checkBoxClasss").prop('checked', $(this).prop('checked'));
        })

      $("#SelectedRecord").click(function(e){
          e.preventDefault();
          var allids =[];


          $("input:checkbox[name=checkArrya]:checked").each(function(){
            //alert($(this).val());
            allids.push($(this).val());
             })

        if(allids.length <=0)
            {
                alert("Please select atleast one record to export.");

            }  
         else 
        {
                var check = confirm("Are you sure, you want to export the selected records?");
           if(check == true){

                    var selected_values=allids.join(",");
                   //document.getElementById("multipleids").value = join_selected_values;


                     $.ajax({
                             type:"GET",
                             url:'//45.79.124.136/Goresource/GO/public/Personalexport',
                             data: 'id='+selected_values,
                             success: function (data) {
                             window.location="{{url('Personalexport')}}?id="+selected_values;
                            }
                        });

           }
       }
         

        })
   }); 

//----------------------------------Export End--------------------------------------


//----------------------------------Send Mail Start--------------------------------------


   $(function(e){
        $("#chkCheckAll").click(function(){
          $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        })

        $("#CandidateEmail").on('click',function(e){
          e.preventDefault();
          
          var allids =[];

    
          $("input:checkbox[name=checkArrya]:checked").each(function(){
           // alert($(this).val());
            allids.push($(this).val());
           })


          if(allids.length <=0)
            {
                alert("Please select atleast one record to send mail.");
                return false;
            } 
          else {

            var join_selected_values=allids.join(",");
             //alert(join_selected_values);
            document.getElementById("candidate_emailid").value = join_selected_values;

             }

          

        })
       });

//----------------------------------Send Mail End--------------------------------------


//----------------------------------Send Sms Start--------------------------------------
$(function(e){
        $("#chkCheckAll").click(function(){
          $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        })

        $("#CandidateSms").on('click',function(e){
          e.preventDefault();
          
          var allids =[];

    
          $("input:checkbox[name=checkArrya]:checked").each(function(){
           // alert($(this).val());
            allids.push($(this).val());
           })


          if(allids.length <=0)
            {
                alert("Please select atleast one record to send sms.");
                return false;
            } 
          else {

            var join_selected_values=allids.join(",");
             //alert(join_selected_values);
            document.getElementById("candidate_smsid").value = join_selected_values;

                }

        })
});

//----------------------------------Send Sms End--------------------------------------

$(document).on("click", ".resumeModal2", function () {

	
     var myResumeUrl = $(this).data('id');

     
		var pdfId = document.getElementById("pdfId");
            pdfId.removeChild(pdfId.childNodes[0]);
            var embed = document.createElement('embed');
            embed.setAttribute('src', myResumeUrl);
            embed.setAttribute('type', 'audio/mpeg');
            embed.setAttribute('width', '100%');
            embed.setAttribute('height', '600');
            pdfId.appendChild(embed);


     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script> 
@stop
