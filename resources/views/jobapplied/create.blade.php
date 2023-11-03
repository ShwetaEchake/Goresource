@extends('layouts.admin')

@section('title')
Create Job Applied
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New</h3>
        <div class="card-tools">
                <a href="{{ route('jobapplied.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>
    <form method="POST" action="{{ route('jobapplied.store') }}"  enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                 


 
       <div class="row">

               
               <div class="col-lg-4">
                <label>Company Name</label>
                <select class="form-control select2" name="client_id" id="client_id" required>
                              <option value="">-select-</option>
                              @foreach ($client as $data)
                              <option value="{{ $data->client_id }}">{{ $data->company_name }}</option>
                              @endforeach
                </select>  
              </div>

                 <div class="col-lg-4">
                <label>Enquiries</label>
                   <select name="enquiry_id" id="enquiry_id" class="form-control" required=""></select>
                </div>

                 <div class="col-lg-4">
                <label>Job</label>
                   <select name="job_id" id="job_id" class="form-control" required=""></select>
                </div>
      </div><br>


          <div class="row">


                <div class="col-lg-4">
                  <label>Candidate</label>
                     <select class="form-control select2" name="candidate_id" id="candidate_id" required>
                              <option value="">-select-</option>
                              @foreach ($personal as $data)
                              <option value="{{ $data->candidate_id }}">{{ $data->name }}</option>
                              @endforeach
                     </select>  
                </div>



                  <div class="col-lg-4">
                <label>Choice 1 </label>
                <input type="text" name="choice1"  id="choice1" class="form-control @error('choice1') is-invalid @enderror" value="{{ old('choice1') }}" required >
                @error('choice1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

               <div class="col-lg-4">
                <label>Choice 2 </label>
                <input type="text" name="choice2"  id="choice2" class="form-control @error('choice2') is-invalid @enderror" value="{{ old('choice2') }}" required >
                @error('choice2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>





     </div> <br>


        <div class="row">


               <div class="col-lg-4">
                   <label>Branch</label>
                     <select class="form-control select2" name="branch_id" id="branch_id" required>
                                  <option value="">-Select-</option>
                                  @foreach ($branch as $data)
                                  <option value="{{ $data->branch_id }}">{{ $data->branch_name }}</option>
                                  @endforeach
                     </select>  
                 </div>



                <div class="col-lg-4">
                <label>Country Preference </label>
                <input type="text" name="country_preference"  id="country_preference " class="form-control @error('country_preference') is-invalid @enderror" value="{{ old('country_preference ') }}" required >
                @error('country_preference')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label>Salary Expectation </label>
                <input type="text" name="salary_expectation"  id="salary_expectation" class="form-control @error('salary_expectation') is-invalid @enderror" value="{{ old('salary_expectation')  }}"   required >
                @error('salary_expectation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

               
     </div> <br>
     
            <div class="row">
                      <div class="col-lg-4">
                            <label>Date Applied</label>
                            <input type="date" name="date_applied"  id="date_applied" class="form-control @error('date_applied') is-invalid @enderror" value="{{ old('date_applied')  }}"   required >
                            @error('date_applied')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
              
            </div>







             </div>
            </div>
             <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Create </button>
        </div>
       
        

       
    </form>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script type="text/javascript">
$(document).ready(function(){


     $('#client_id').change(function(){
  var clientID = $(this).val();  
  if(clientID){
    $.ajax({
      type:"GET",
      url:"{{url('getEnquiryJobapplied')}}?client_id="+clientID,
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
      url:"{{url('getJobJobapplied')}}?enquiry_id="+enquiryID,
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


});





</script> 
@stop