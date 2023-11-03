@extends('layouts.admin')

@section('title')
Edit Interview
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New</h3>
        <div class="card-tools">
                <a href="{{ route('interview.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>


    <form method="POST" action="{{ route('interview.update',$interview->interview_id) }}">
        @csrf
         @method('PUT')
        <div class="card-body">
            <div class="form-group">
                 


        <div class="row">

                <div class="col-lg-4">
             <label> Company Name</label>
                <select class="form-control select2" name="client_id" id="client_id" required >
                              <option value="">-select-</option>
                              @foreach ($client as $data)
                                <option value="{{ $data->client_id }}" {{ $data->client_id == $interview->client_id ?  'selected' : '' }}>{{$data->company_name}}</option>
                              @endforeach

                </select>  
                </div>

                <div class="col-lg-4">
                 <label>Enquiry</label>
                  <?php  $enquiry=DB::table('enquiry')->where('client_id', $interview->client_id)->get();?>
                     <select class="form-control select2" name="enquiry_id" id="enquiry_id" required >
                              <option value="">-select-</option>
                              @foreach ($enquiry as $data)
                                <option value="{{ $data->enquiry_id }}" {{ $data->enquiry_id == $interview->enquiry_id ?  'selected' : '' }}>{{$data->enquiry_title}}</option>
                              @endforeach

                     </select>  
                </div>

                  <div class="col-lg-4">
                     <label>Job  </label>
                      <?php  
                          $results=DB::table('jobs')
                          ->select('job_id','category_id','category_name')
                          ->leftjoin('categories','categories.category_id','=','jobs.job_main_category_id')
                          ->where('enquiry_id', $interview->enquiry_id)->get();
                      ?>
                     <select class="form-control select2" name="job_id" id="job_id" required >
                              <option value="">-select-</option>
                              @foreach ($results as $datas)
                                <option value="{{ $datas->job_id }}" {{ $datas->job_id == $interview->job_id ?  'selected' : '' }}>{{$datas->category_name}}</option>
                              @endforeach
                     </select>  
                </div>





     </div><br>


 
       <div class="row">
            
                <div class="col-lg-4">
                <label>Interview date </label>
                <input type="date" name="interview_date"  id="interview_date" class="form-control @error('interview_date') is-invalid @enderror" value="{{ (date('Y-m-d',$interview->interview_date)) }}" required >
                @error('interview_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label>  Start Time  </label>
                <input type="time" name="start_time"  id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{(date('H:i:s',$interview->start_time))}}"  required >
                @error('start_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label> End Time</label>
                <input type="time"  name="end_time"  id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ (date('H:i:s',$interview->end_time))}}" required >
                @error('end_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
             
     </div> <br>


     <div class="row">

               
                <div class="col-lg-4">
                <label> Interview venu </label>
                <input type="text" name="interview_venu"  id="interview_venu" class="form-control @error('interview_venu') is-invalid @enderror" value="{{ $interview->interview_venu  }}"  required >
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
                      @foreach ($country as $countries)
                       <option value="{{ $countries->country_id }}" {{ $countries->country_id == $interview->interview_country ?  'selected' : '' }}>{{$countries->country_name}}</option>

                      @endforeach
                  </select>  
                </div>

                 <div class="col-lg-4">
                <label>  State</label>
                <?php  $state=DB::table('state')->where('country_id', $interview->interview_country)->get();?>
                <select name="interview_state" id="state_id" class="form-control">
                      <option value="">-Select-</option>
                      @foreach ($state as $states)
                        <option value="{{ $states->state_id }}" {{ $states->state_id == $interview->interview_state ?  'selected' : '' }}>{{$states->state_name}}</option>
                      @endforeach
                </select>
                </div>


    </div><br>



        <div class="row">
              
                <div class="col-lg-4">
                   <label>City </label>
                   <?php  $cities=DB::table('cities')->where('state_id', $interview->interview_state)->get();?>
                   <select name="interview_city" id="city_id" class="form-control">
                          <option value="">-Select-</option>
                              @foreach ($cities as $city)
                                <option value="{{ $city->cities_id }}" {{ $city->cities_id == $interview->interview_city ?  'selected' : '' }}>{{$city->city_name}}</option>
                              @endforeach
                   </select>
                </div>

                <div class="col-lg-4">
                <label> Interview zipcode </label>
                <input type="text"  name="interview_zipcode"  id="interview_zipcode"  class="form-control @error('interview_zipcode') is-invalid @enderror" value="{{ $interview-> interview_zipcode }}" required >
                @error('interview_zipcode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

           
      </div><br>



  


     <div class="row">

                <div class="col-lg-4">
                <label>Interviewer name </label>
                <input type="text"  name="interviewer_name"  id="interviewer_name"  class="form-control @error('interviewer_name') is-invalid @enderror" value="{{ $interview->interviewer_name  }}" required >
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
                        <?php 
                         if(!empty($interview->interviewer_mobileno)){
                            $splitedata= explode("-",$interview->interviewer_mobileno);
                            $splitedata[0]= $splitedata[0];
                            $splitedata[1]= $splitedata[1];
                         }else{
                            $splitedata[0]="";
                            $splitedata[1]="";
                         }

                        ?>
                            <div class="input-group-prepend">
                                  <input type="text" style="width:80px"  name="countrycodes"  id="countrycodes"   class="form-control @error('countrycodes') is-invalid @enderror" value="{{  $splitedata[0]  }}" readonly >
                            </div>
                           <input type="number"  name="interviewer_mobileno"  id="interviewer_mobileno" class="form-control @error('interviewer_mobileno') is-invalid @enderror" value="{{  $splitedata[1] }}"  >
                            @error('interviewer_mobileno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
                    </div>
                </div>    

                <div class="col-lg-4">
                <label> Interviewer email </label>
                <input type="email"  name="interviewer_email"  id="interviewer_email"   class="form-control @error('interviewer_email') is-invalid @enderror" value="{{ $interview->interviewer_email  }}" required >
                @error('interviewer_email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>    
    </div><br>

     <div class="row">
                <div class="col-lg-4">
                <label>Video  Calls :</label>
                   <select name="video_call" id="video_call" class="form-control">
                        <option value="">-Select-</option>
                        <option value='Skype' <?=isset($interview->video_call) && $interview->video_call ==  'Skype' ? 'selected':""?> > Skype </option>
                        <option value='Vonage' <?=isset($interview->video_call) && $interview->video_call ==  'Vonage' ? 'selected':""?> > Vonage </option>
                        <option value='Google_Meet'<?=isset($interview->video_call) && $interview->video_call == 'Google_Meet' ? 'selected':""?>> Google Meet </option>
                        <option value='Zoom' <?=isset($interview->video_call) && $interview->video_call ==  'Zoom' ? 'selected':""?> > Zoom </option>

                    </select>
                 </div>

                <div class="col-lg-4">
                <label> Interview Detail </label>
                <textarea type="text"  style="width:550px; height: 100px;" name="interview_detail"  id="interview_detail"   class="form-control @error('interview_detail') is-invalid @enderror" value="" > {{ $interview->interview_detail }}</textarea>
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
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update </button>
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