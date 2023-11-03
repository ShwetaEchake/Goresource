@extends('layouts.admin')

@section('title')
Create Interview
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New</h3>
        <div class="card-tools">
                <a href="{{ route('interview.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>
    <form method="POST" action="{{ route('interview.store') }}" >
        @csrf
        <div class="card-body">
            <div class="form-group">
                 


        <div class="row">

              <!--   <div class="col-lg-4">
                  <label>Company Name</label>
                <select class="form-control select2" name="client_id" id="client_id" required>
                              <option value="">-select-</option>
                              @foreach ($client as $data)
                              <option value="{{ $data->client_id }}">{{ $data->company_name }}</option>
                              @endforeach
                </select>  
                </div>

                <div class="col-lg-4">
                 <label>Enquiry</label>
                     <select class="form-control select2" name="enquiry_id" id="enquiry_id" required>
                              <option value="">-select-</option>
                              @foreach ($enquiry as $data)
                              <option value="{{ $data->enquiry_id }}">{{ $data->enquiry_title }}</option>
                              @endforeach
                     </select>  
                </div>

                  <div class="col-lg-4">
               <label>Job  </label>
                     <select class="form-control select2" name="job_id" id="job_id" required>
                              <option value="">-select-</option>
                              @foreach ($result as $data)
                              <option value="{{ $data->category_id }}">{{ $data->category_name }}</option>
                              @endforeach
                     </select>  
                </div> -->

                <div class="col-lg-4">
                                    <label>Company Name</label>
                                    <select class="form-control select2" name="client_id" id="client_id" required>
                                                  <option value="">-Select-</option>
                                                  @foreach ($client as $data)
                                                  <option value="{{ $data->client_id }}">{{ $data->company_name }}</option>
                                                  @endforeach
                                    </select>  
                </div>

               <div class="col-lg-4">
                    <label>Enquiries</label>
                    <select name="enquiry_id" id="enquiry_id" class="form-control"></select>
               </div>

               <div class="col-lg-4">
                    <label>Job</label>
                    <select name="job_id" id="job_id" class="form-control"></select>
               </div>





     </div><br>


 
       <div class="row">
            
                <div class="col-lg-4">
                <label> Date </label>
                <input type="date" name="interview_date"  id="interview_date" class="form-control @error('interview_date') is-invalid @enderror" value="{{ old('interview_date')  }}" required >
                @error('interview_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label>  Start Time  </label>
                <input type="time" name="start_time"  id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time')  }}"  required >
                @error('start_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label> End Time</label>
                <input type="time"  name="end_time"  id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time') }}" required >
                @error('end_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
             
     </div> <br>


     <div class="row">

               
                <div class="col-lg-4">
                <label>  Venu </label>
                <input type="text" name="interview_venu"  id="interview_venu" class="form-control @error('interview_venu') is-invalid @enderror" value="{{ old('interview_venu')  }}"  required >
                @error('interview_venu')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                  <label>  Country  </label>
                  <select class="form-control select2" name="interview_country" id="country_id">
                      <option value="">-Select Country</option>
                      @foreach ($country as $name)
                      <option value="{{ $name->country_id }}">{{ $name->country_name }}</option>
                      @endforeach
                  </select>  
                </div>

                <div class="col-lg-4">
                <label>  State</label>
                <select name="interview_state" id="state_id" class="form-control"></select>
                </div>


    </div><br>



        <div class="row">
              
                 <div class="col-lg-4">
                 <label>City </label>
                   <select name="interview_city" id="city_id" class="form-control"></select>
                </div>

                <div class="col-lg-4">
                <label> Zipcode </label>
                <input type="text"  name="interview_zipcode"  id="interview_zipcode"  class="form-control @error('interview_zipcode') is-invalid @enderror" value="{{ old(' interview_zipcode') }}" required >
                @error('interview_zipcode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

              

      </div><br>



  


     <div class="row">

                <div class="col-lg-4">
                <label>Interviewer Name </label>
                <input type="text"  name="interviewer_name"  id="interviewer_name"  class="form-control @error('interviewer_name') is-invalid @enderror" value="{{ old('interviewer_name')  }}" required >
                @error('interviewer_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

                <div class="col-lg-4">
                      <div class="form-group">
                       <label>  Interviewer Mobileno</label>
                       <div class="input-group">
                            <div class="input-group-prepend">
                                  <input type="text" style="width:80px"  name="countrycodes"  id="countrycodes"   class="form-control @error('countrycodes') is-invalid @enderror" value="{{ old('countrycodes')  }}" readonly >
                            </div>
                           <input type="number"  name="interviewer_mobileno"  id="interviewer_mobileno" class="form-control @error('interviewer_mobileno') is-invalid @enderror" value="{{ old('interviewer_mobileno')  }}"  >
                            @error('interviewer_mobileno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
                    </div>
                </div>    

                <div class="col-lg-4">
                <label> Interviewer Email </label>
                <input type="email"  name="interviewer_email"  id="interviewer_email"   class="form-control @error('interviewer_email') is-invalid @enderror" value="{{ old('interviewer_email')  }}" required >
                @error('interviewer_email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>    
    </div><br>




    <div class="row">
                <div class="col-lg-4">
                <label>Video Call </label>
                   <select name="cars" id="cars" class="form-control">
                        <option value="">-Select-</option>
                        <option value="Skype">Skype</option>
                        <option value="Vonage">Vonage</option>
                        <option value="Google_Meet">Google Meet</option>
                        <option value="Zoom">Zoom</option>
                    </select>
                 </div>

                <div class="col-lg-4">
                <label> Interview Detail  </label>
                <textarea type="text"  style="width:550px; height: 100px;" name="interview_detail"  id="interview_detail"   class="form-control @error('interview_detail') is-invalid @enderror" value="{{ old('interview_detail')  }}" required> </textarea>
                @error('interview_detail')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>    
    </div><br>



             </div>
            </div>
             <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Create </button>
        </div>
       
        

       
    </form>
</div>
@endsection

@section('js')
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}" defer> </script>

<script type="text/javascript">

$(document).ready(function(){

$('#client_id').select2();
$('#enquiry_id').select2();
$('#job_id').select2();
$('#country_id').select2();
$('#state_id').select2();
$('#city_id').select2();


       $('#client_id').change(function(){
  var clientID = $(this).val();  
  if(clientID){
    $.ajax({
      type:"GET",
      url:"{{url('getEnquirydata')}}?client_id="+clientID,
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
      url:"{{url('getJobdata')}}?enquiry_id="+enquiryID,
      success:function(res){  
      if(res){
        $("#job_id").empty();
        $("#job_id").append('<option>Select Job</option>');
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


     $('#country_id').change(function(){
  var countryID = $(this).val();  
  if(countryID){
    $.ajax({
      type:"GET",
      url:"{{url('getState')}}?country_id="+countryID,
      success:function(res){  
      if(res){
        $("#state_id").empty();
        $("#state_id").append('<option>Select State</option>');
        $.each(res,function(key,value){
          $("#state_id").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#state_id").empty();
      }
      }
    });
  }else{
    $("#state_id").empty();
    $("#city_id").empty();
   
  }   
  });


     $('#state_id').change(function(){
  var stateID = $(this).val();  
  if(stateID){
    $.ajax({
      type:"GET",
      url:"{{url('getCity')}}?state_id="+stateID,
      success:function(res){  
      if(res){
        $("#city_id").empty();
        $("#city_id").append('<option>Select City</option>');
        $.each(res,function(key,value){
          $("#city_id").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#city_id").empty();
      }
      }
    });
  }else{
    $("#city_id").empty();
   
  }   
  });



      $('#country_id').change(function(){
  var countryID = $(this).val();  
  //alert(countryID);
  if(countryID){
    $.ajax({
      type:"GET",
      url:"{{url('getCurrency')}}?country_id="+countryID,
      success:function(res){  
      if(res){
        $("#countrycodes").empty();
        $.each(res,function(key,value){
            // alert(key);
            // alert(value);
           $("#countrycodes").val(key);
        });
      
      }else{
        $("#countrycodes").empty();
      }
      }
    });
  }else{
    $("#countrycodes").empty();
  }   
  });




 });
</script>

@stop