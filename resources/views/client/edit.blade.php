@extends('layouts.admin')

@section('title')
Update Client
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Client</h3>
        <div class="card-tools">
                <a href="{{ route('client.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Warning!</strong> Please check input field code<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

  
    <form method="POST" action="{{ route('client.update',$client->client_id) }}" enctype="multipart/form-data">
       @csrf
         @method('PUT')
        <div class="card-body">
            <div class="form-group">
                 


        <div class="row">
            <?php   $username=DB::table('users')->where('id',$client->user_id)->select('name','password')->first();
             // $user = $username->name;
             // $pass = $username->password;

             if(!empty($username)){
                    $user = $username->name;
                    $pass = $username->password;
             }else{
                   $user = '';
                   $pass = '';
             }

             
            ?>
                 <div class="col-lg-4">
                <label> Client Name <span style="color:red;">*</span></label>
                <input type="text" name="user_id"  id="user_id" class="form-control @error('user_id') is-invalid @enderror" value="{{$user}}" required  readonly="">
                @error('user_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                  <div class="col-lg-4">
                <label> User Name <span style="color:red;">*</span></label>
                <input type="email"  name="client_email"  id="client_email" class="form-control @error('client_email') is-invalid @enderror" value="{{  $client->client_email  }}" required>
                @error('client_email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>


                   <div class="col-lg-4">
                <label>Password <span style="color:red;">*</span></label>
                <input type="password" name="password"  id="password" class="form-control @error('password') is-invalid @enderror" value="{{$pass}}" required  >
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


            
     </div><br>


 
       <div class="row">


                <div class="col-lg-4">
                <label> Company Name <span style="color:red;">*</span></label>
                <input type="text" name="company_name"  id="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ $client->company_name }}" required >
                @error('company_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>



                   <div class="col-lg-4">
                     <label>  Country  </label>
                     <select class="form-control select2" name="client_country" id="country_id">
                              <option value="">-Select-</option>
                              @foreach ($country as $name)
                                <option value="{{ $name->country_id }}" {{ $name->country_id == $client->client_country ?  'selected' : '' }}>{{$name->country_name}}</option>
                              @endforeach
                     </select>  
                </div>

                  <div class="col-lg-4">
                    <label>State</label>
                    <?php  $state=DB::table('state')->where('country_id', $client->client_country)->get();?>
                    <select name="client_state" id="state_id" class="form-control">
                        <option value="">-Select-</option>
                              @foreach ($state as $states)
                                <option value="{{ $states->state_id }}" {{ $states->state_id == $client->client_state ?  'selected' : '' }}>{{$states->state_name}}</option>
                              @endforeach
                    </select>
                </div>     
     </div> <br>


     <div class="row">

              
              <div class="col-lg-4">
                    <label>City</label>
                    <?php  $cities=DB::table('cities')->where('state_id', $client->client_state)->get();?>
                    <select name="client_city" id="city_id" class="form-control">
                           <option value="">-Select-</option>
                              @foreach ($cities as $city)
                                <option value="{{ $city->cities_id }}" {{ $city->cities_id == $client->client_city ?  'selected' : '' }}>{{$city->city_name}}</option>
                              @endforeach
                    </select>
              </div>


                <div class="col-lg-4">
                <label> Address</label>
                <textarea type="text"  name="client_address"  id="client_address" class="form-control @error('  client_address') is-invalid @enderror" value=""  >{{  $client->client_address }}</textarea>
                @error('client_address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

     <div class="col-lg-4">
                <label> Zipcode </label>
                <input type="text" name="client_zipcode"  id="client_zipcode" class="form-control @error('client_zipcode') is-invalid @enderror" value="{{ $client->client_zipcode  }}"  >
                @error('client_zipcode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


             

    </div><br>



        <div class="row">

             <div class="col-lg-4">
                    <div class="form-group">
                       <label>  Officeno</label>
                       <div class="input-group">
                            <div class="input-group-prepend">
                                <?php $splite=explode('-',$client->client_officeno); ?>
                              <input type="text" style="width:80px"  name="countrycode_client_officeno"  id="countrycode"   class="form-control @error('client_officeno') is-invalid @enderror" value="{{ $splite[0]  }}" readonly >
                            </div>
                           <input type="number"  name="client_officeno"  id="client_officeno" class="form-control @error('client_officeno') is-invalid @enderror" value="{{ $splite[1] }}"   >
                            @error('client_officeno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
                    </div>
                 </div>

                   <div class="col-lg-4">
                     <div class="form-group">
                       <label>  Mobile</label>
                       <div class="input-group">
                         <?php $spliteCode=explode('-',$client->client_mobile); ?>
                            <div class="input-group-prepend">
                             <input type="text" style="width:80px"  name="countrycode_client_mobile"  id="country_code"   class="form-control @error('client_mobile') is-invalid @enderror" value="{{ $spliteCode[0]  }}" readonly> 
                            </div>
                          <input type="number"  name="client_mobile"  id="client_mobile" class="form-control @error('client_mobile') is-invalid @enderror"  value="{{ $spliteCode[1]}}"   >
                            @error('client_mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
                    </div>
                </div>

        
<div class="col-lg-4">
    <label>  Website url</label>
                <input type="text"  name="website_url"  id="website_url" class="form-control @error('website_url') is-invalid @enderror" value="{{ $client->website_url }}"  >
                @error('website_url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
</div>

               

    </div><br>



  <div class="row">
                   <div class="col-lg-4">
                        <label> Employee No</label>
                        <input type="text"  name="employee_no"  id="employee_no"   class="form-control @error('employee_no') is-invalid @enderror" value="{{ $client->employee_no }}"  >
                        @error('employee_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>

                    <div class="col-lg-4">
                        <label> Currency</label>
                        <input type="text"  name="currency"  id="currency"   class="form-control @error('currency') is-invalid @enderror" value="{{ $client->currency  }}" readonly > </input>
                   </div>

                  <div class="col-lg-4">
                    <label> Commission</label>
                    <input type="text"  name="commission"  id="commission"   class="form-control @error('commission') is-invalid @enderror" value="{{ $client->commission }}"  > </input>
                  </div>
                       



  </div><br>


<div class="row">

                     <div class="col-lg-4">
                        <label> Commercial Registration no</label>
                        <input type="text"  name="commercial_registration_no"  id="commercial_registration_no"   class="form-control @error('commercial_registration_no') is-invalid @enderror" value="{{ $client->commercial_registration_no }}"  >
                        @error('commercial_registration_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="col-lg-4">
                        <label> Date of Expiry</label>
                        <input type="date"  name="date_expiry"  id="date_expiry"   class="form-control @error('date_expiry') is-invalid @enderror" value="{{ (date('Y-m-d',$client->date_expiry)) }}"  >
                        @error('date_expiry')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-lg-4">
                        <label> Date of Issue</label>
                        <input type="date"  name="date_issue"  id="date_issue"   class="form-control @error('date_issue') is-invalid @enderror" value="{{ (date('Y-m-d',$client->date_issue)) }}"  >
                        @error('date_issue')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                   </div>

</div><br>





<div class="row">
                      <div class="col-lg-4">
                            <label> Passport No</label>
                            <input type="text"  name="passport_no"  id="passport_no"   class="form-control @error('passport_no') is-invalid @enderror" value="{{ $client->passport_no  }}"  >
                            @error('passport_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>

                    <div class="col-lg-4">
                        <label> Date of Expiry</label>
                        <input type="date"  name="expiry_date"  id="expiry_date"   class="form-control @error('expiry_date') is-invalid @enderror" value="{{ (date('Y-m-d',$client->expiry_date)) }}"  >
                        @error('expiry_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-lg-4">
                        <label> Date of Issue</label>
                        <input type="date"  name="issue_date"  id="issue_date"   class="form-control @error('issue_date') is-invalid @enderror" value="{{ (date('Y-m-d',$client->issue_date)) }}"  >
                        @error('issue_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                   </div>    
</div><br>
























  <div class="row">


                 <div class="col-lg-4">
                     <label> Nationality</label>
                      <input type="text"  name="nationality"  id="nationality"   class="form-control @error('nationality') is-invalid @enderror" value="{{ $client->nationality }}"  >
                    @error('nationality')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>

                 <div class="col-lg-4">
                             <label> Designation</label>
                           <input type="text"  name="designation"  id="designation"   class="form-control @error('designation') is-invalid @enderror" value="{{ $client->designation }}"  >
                        @error('designation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                 </div>

            
</div> <br>

  <div class="row">
        <div class="col-lg-4">
                <label> Contact Person</label>
                <input type="text"  name="contact_person"  id="contact_person"   class="form-control @error('contact_person') is-invalid @enderror" value="{{  $client->contact_person }}"  >
                @error('contact_person')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label> Contact Person Mobile </label>
                <input type="number"  name="contact_person_mobile"  id="contact_person_mobile"  class="form-control @error('contact_person_mobile') is-invalid @enderror" value="{{  $client->contact_person_mobile }}"  >
                @error('contact_person_mobile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label>Contact Person Email </label>
                <input type="email"  name="contact_person_email"  id="contact_person_email"  class="form-control @error('contact_person_email') is-invalid @enderror" value="{{  $client->contact_person_email  }}"  >
                @error('contact_person_email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

      </div><br>







    <div class="row">

       <div class="col-lg-4">
                <label> Contact Person 1</label>
                <input type="text"  name="contact_person1"  id="contact_person1"   class="form-control @error('contact_person1') is-invalid @enderror" value="{{  $client->contact_person1  }}"  >
                @error('contact_person1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label> Contact Person Mobile 1</label>
                <input type="number"  name="contact_person_mobile1"  id="contact_person_mobile1"  class="form-control @error('contact_person_mobile1') is-invalid @enderror" value="{{  $client->contact_person_mobile1  }}"  >
                @error('contact_person_mobile1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="col-lg-4">
                <label>Contact Person Email 1 </label>
                <input type="email"  name="contact_person_email1"  id="contact_person_email1"  class="form-control @error('contact_person_email1') is-invalid @enderror" value="{{  $client->contact_person_email1  }}"  >
                @error('contact_person_email1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>
    
</div><br>




      <div class="row">

            <div class="col-lg-4">
                                   
                        <label class="control-label" for="inputEmail3"> Status</label>
                        <select class="form-control valdation_select" name="client_status" >
                <option value='' <?=isset($client->client_status) && $client->client_status ==  '0' ? 'selected':""?> > Select </option>
               <option value='1' <?=isset($client->client_status) && $client->client_status == '1' ? 'selected':""?> > Active </option>
               <option value='0' <?=isset($client->client_status) && $client->client_status == '0' ? 'selected':""?> > Deactive </option>     
                       </select>
                </div>
            

                  <div class="col-lg-4">
                <label>  Remark </label>
                <textarea type="text"  name="client_remark"  id="client_remark" class="form-control @error('client_remark') is-invalid @enderror" value=""  >{{  $client->client_remark  }}</textarea>
                @error('client_remark')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>
 
  <div class="col-lg-4">
                <label> Logo</label>

                     @if(!empty($client->client_logo))
                 <a href="{{asset('documents/' .$client->folder_path.'/'.$client->client_logo)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                    @endif


                <input type="file"  name="client_logo"  id="client_logo"  class="form-control @error('client_logo') is-invalid @enderror" value="{{  $client->client_logo  }}"  >
                @error('client_logo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

    </div><br>












<!-- ------------------------------Client location Start--------------------------- -->

<h4> Client Project Location:</h4>

<div class="panel panel-footer">
    <table class="table table-responsive table-bordered" id="dynamicAddRemove">
        <thead>
                <tr>
                    <th></th>
                    <th>Project Location Name </th>
                    <th>Project Location Code</th>
                    <th>Project Location Detail</th>
                    <th><a href="javascip:" class="btn btn-sm btn-success addClientLocation"><i class="fa fa-plus"></i> </a></th>
                </tr>
        </thead>

        <tbody id="clientlocation">
      @foreach($clientlocation as $clientlocations)
            <tr>
                <td><input type="hidden" name="client_location_id[]" value="{{$clientlocations->client_location_id}}" class="form-control" ></td>
                <td><input type="text" name="client_location_name[]" value="{{$clientlocations->client_location_name}}" class="form-control" ></td>
                <td><input type="text" name="client_location_code[]"  value="{{$clientlocations->client_location_code}}"  class="form-control" ></td>
                <td><textarea type="text" name="client_location_detail[]" value="" class="form-control" >{{$clientlocations->client_location_detail}}</textarea></td>
                <td><a href="javascip:" class="btn btn-sm btn-danger removeClientLocation" style="display:none;"><i class="fa fa-remove"></i></a></td>
            <tr>
     @endforeach
        </tbody>

   <!--      <tfoot>
            <tr>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td>Total</td>
                <td><input type="submit" name="" value="Submit" class=" btn btn-success"></td>
            </tr>
        </tfoot> -->

             
    </table>
</div><br>
<!-- ------------------------------Client location End--------------------------- -->





















             </div>
            </div>


        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update </button>
        </div>
       
        

       
    </form>
</div>
@endsection



@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js" defer></script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}" defer> </script>

<script type="text/javascript">

// --------------------------Client Location Start-------------------
$(document).ready(function(){
 $('#country_id').select2();
  $('#state_id').select2();
  $('#city_id').select2();



     $('#country_id').change(function(){
  var countryID = $(this).val();  
  if(countryID){
    $.ajax({
      type:"GET",
      url:"{{url('getCurrency')}}?country_id="+countryID,
      success:function(res){  
      if(res){
        $("#currency").empty();
        $.each(res,function(key,value){
            // alert(key);
            // alert(value);
           $("#currency").val(value);
           $("#countrycode").val(key);
           $("#country_code").val(key);
        });
      
      }else{
        $("#currency").empty();
      }
      }
    });
  }else{
    $("#currency").empty();
   
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




  $('.addClientLocation').on('click',function(){
    addClientLocation();
  });

  function addClientLocation(){
    var tr='<tr>'+
    ' <td><input type="hidden" name="client_location_id[]" value="" class="form-control" ></td>'+
    '<td><input type="text" name="client_location_name[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="client_location_code[]"  class="form-control" required=""></td>'+
    '<td><textarea type="text" name="client_location_detail[]" class="form-control" required=""></textarea></td>'+
    '<td><a href="javascrip:" class="btn btn-sm btn-danger removeClientLocation"><i class="fa fa-remove"></i></a></td>'
    '<tr>';
    $('#clientlocation').append(tr);
  };

  $('.removeClientLocation').live('click',function () {
      //var last= $('tbody tr').length;
    // alert(last);
      // if(last==12){
      //   alert('You can not remove last row');
      // }
      // else{
        $(this).parent().parent().remove();
        // alert('yes');
      // }
  });


    });
// --------------------------Client Location End-------------------



</script>

@stop