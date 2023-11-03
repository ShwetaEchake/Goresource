@extends('layouts.admin')

@section('title')
Create Job
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New</h3>
        <div class="card-tools">
                <a href="{{ route('enquiry.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>
    <form method="POST" action="{{ route('job.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                 
    <div class="row">
                <div class="col-lg-6">
                 <label> Company Name</label>
                <select class="form-control select2" name="client_id" id="client_id" required>
                              <option value="">-select-</option>
                              @foreach ($client as $data)
                              <option value="{{ $data->client_id }}">{{ $data->company_name }}</option>
                              @endforeach
                </select>  
                </div>

                <div class="col-lg-6">
                <label>  Title </label>
                <input type="text" name="enquiry_title"  id="enquiry_title" class="form-control @error('  enquiry_title') is-invalid @enderror" value="{{ old('enquiry_title') }}" required >
                @error('enquiry_title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
   </div>


    {{--    
       <!--  <div class="row">
            

                <div class="col-lg-6">
                <label>Company Name</label>
                <select class="form-control select2" name="client_id" id="client_id" required>
                              <option value="">-select-</option>
                              @foreach ($client as $data)
                              <option value="{{ $data->client_id }}">{{ $data->company_name }}</option>
                              @endforeach
                </select>  
                </div>

                 <div class="col-lg-6">
                <label>Enquiries</label>
                   <select name="enquiry_id" id="enquiry_id" class="form-control"></select>
           
                </div>
     </div><br> -->
     --}}


 
     {{-- <!--  <div class="row">
                
                <div class="col-lg-6">
                  <label>Main Category  </label>
                    <select class="form-control select2" name="job_main_category_id" id="category" required>
                                <option value="">-select-</option>
                                @foreach ($categories as $data)
                                <option value="{{ $data->category_id  }}">{{ $data->category_name }}</option>
                                @endforeach
                  </select>  
                </div>

              

               
                <div class="col-md-6">
                  <label for="city">Sub Category</label>
                    <select name="enquiry_id" id="subcategory" class="form-control"></select>
                </div>



             
     </div> <br>
 -->

    <!--  <div class="row">

                <div class="col-lg-4">
                <label>Project Location</label>
                <select class="form-control select2" name="enquiy_project_location_id" id="enquiy_project_location_id" required>
                              <option value="">-select-</option>
                              @foreach ($projectlocation as $data)
                              <option value="{{ $data->enquiy_project_location_id  }}">{{ $data->required_position  }}</option>
                              @endforeach
                </select>  
                 </div>

                <div class="col-lg-4">
                <label>Basic Salary</label>
                <input type="text"  name="basic_salary"  id="basic_salary" class="form-control @error('  basic_salary') is-invalid @enderror" value="{{ old('basic_salary')  }}" required ></input>
                @error('basic_salary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="col-lg-4">
                <label> Cola Allownces</label>
                <input type="text"  name="cola_allownces"  id="cola_allownces" class="form-control @error('cola_allownces') is-invalid @enderror" value="{{ old('cola_allownces')  }}" required >
                @error('cola_allownces ')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

    </div><br>
 -->


        <!-- <div class="row">
              
                <div class="col-lg-4">
                <label> Food Allownce</label>
                <input type="text"  name="food_allownce"  id="food_allownce"   class="form-control @error('food_allownce') is-invalid @enderror" value="{{ old('food_allownce')  }}" required >
                @error('food_allownce')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                 <div class="col-lg-4">
                <label> Transportation Allownce</label>
                <input type="text"  name="transportation_allownce"  id="transportation_allownce"   class="form-control @error('transportation_allownce') is-invalid @enderror" value="{{ old('transportation_allownce')  }}" required >
                @error('transportation_allownce')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label> Accomodation Allownce </label>
                <input type="text"  name="accomodation_allownce"  id="accomodation_allownce"  class="form-control @error('   accomodation_allownce') is-invalid @enderror" value="{{ old('accomodation_allownce') }}" required ></input>
                @error('accomodation_allownce')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

      </div><br>


 -->
  


 <!--     <div class="row">

                <div class="col-lg-4">
                <label> Medical Allownce </label>
                <input type="text"  name="medical_allownce"  id="medical_allownce"  class="form-control @error('  medical_allownce') is-invalid @enderror" value="{{ old('medical_allownce')  }}" required >
                @error('medical_allownce')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

                <div class="col-lg-4">
                <label> Overtime Allownce </label>
                <input type="text"  name="overtime_allownce"  id="overtime_allownce"   class="form-control @error('overtime_allownce') is-invalid @enderror" value="{{ old('overtime_allownce')  }}" required >
                @error('overtime_allownce')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


    </div><br> -->
    --}}

<br>
    <h5> Job :</h5>

<div class="panel panel-footer">
    <table class="table table-bordered table-responsive"  id="dynamicAddRemove">
        <thead>
                <tr>
                    <th> Category</th>
                    <th> Trade</th>
                    <th>Project Location</th>
                    <th>Basic Salary</th>
                    <th>Cola</th>
                    <th>Food </th>
                    <th>Transportation </th> 
                    <th>Accomodation </th>
                    <th>Medical </th>
                    <th>Overtime </th>
              
                  

                     <th><a href="javascrip:" class="addRow"><i class="fa fa-plus"></i> </a></th>
                </tr>
        </thead>

        <tbody>
            <tr>
                <td> 
                    <select class="form-control select2" name="job_main_category_id[]" id="category" required>
                                <option value="">-select-</option>
                                @foreach ($categories as $data)
                                <option value="{{ $data->category_id  }}">{{ $data->category_name }}</option>
                                @endforeach
                    </select>  
                </td>
                <td width=""><select name="job_sub_category_id[]" id="subcategory" class="form-control"></select></td>

                <td><input type="text" name="enquiy_project_location_id[]" class="form-control" required=""></td>
                <td><input type="text" name="basic_salary[]" class="form-control" required=""></td>
                <td><input type="text" name="cola_allownces[]" class="form-control" required=""></td>
                <td><input type="text" name="food_allownce[]" class="form-control" required=""></td>
                <td><input type="text" name="transportation_allownce[]" class="form-control" required=""></td> 
                <td><input type="text" name="accomodation_allownce[]" class="form-control" required=""></td>
                <td><input type="text" name="medical_allownce[]" class="form-control" required=""></td>
                <td><input type="text" name="overtime_allownce[]" class="form-control" required=""></td>
             


                <td><a href="javascrip:" class="btn btn-sm btn-danger remove"><i class="fa fa-remove"></i></a></td>
            <tr>
        </tbody>

             
    </table>
</div>


<br>


     <div class="row">

                <div class="col-lg-4">
                <label>Contract Period </label>
                <input type="text" name="contract_period"  id="contract_period" class="form-control @error('contract_period') is-invalid @enderror" value="{{ old('contract_period') }}" required >
                @error('contract_period')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label> Place of Work </label>
                <input type="text" name="place_of_work"  id="place_of_work" class="form-control @error('place_of_work') is-invalid @enderror" value="{{ old('place_of_work')  }}"   required >
                @error('place_of_work')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="col-lg-4">
                <label> Trial Period </label>
                <input type="text" name="trial_period"  id="trial_period" class="form-control @error('trial_period') is-invalid @enderror" value="{{ old('trial_period')  }}"   required >
                @error('trial_period')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
   </div><br>


 
     <div class="row">

                <div class="col-lg-4">
                <label>Air fare</label>
                <input type="text" name="air_fare"  id="air_fare" class="form-control @error('air_fare') is-invalid @enderror" value="{{ old('air_fare')  }}" required >
                @error('air_fare')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                   <div class="col-lg-4">
                <label> Employment visa</label>
                <input type="text"  name="employment_visa"  id="employment_visa" class="form-control @error('employment_visa') is-invalid @enderror" value="{{ old('employment_visa')  }}" required>
                @error('employment_visa')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>


                <div class="col-lg-4">
                   <label> Food status</label>
                <input type="text"  name="food_status"  id="food_status" class="form-control @error('food_status') is-invalid @enderror" value="{{ old('food_status')  }}" required>
                @error('food_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

             

             
     </div> <br>


        <div class="row">
                <div class="col-lg-4">
                <label> Transportation Status</label>
                <input type="text"  name="transportation_status"  id="transportation_status" class="form-control @error('transportation_status') is-invalid @enderror" value="{{ old('transportation_status')  }}" required>
                @error('transportation_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

                <div class="col-lg-4">
                     <label>Accomodation Status</label>
                <input type="text"  name="accomodation_status"  id="accomodation_status" class="form-control @error('accomodation_status') is-invalid @enderror" value="{{ old('accomodation_status')  }}" required>
                @error('accomodation_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

                <div class="col-lg-4">
                      <label> Medical Status</label>
                <input type="text"  name="medical_status"  id="medical_status" class="form-control @error('medical_status') is-invalid @enderror" value="{{ old('medical_status')  }}" required>
                @error('medical_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
      </div><br>



  


     <div class="row">
                <div class="col-lg-4">
                <label> Duty Hours </label>
                <input type="text"  name="duty_hours"  id="duty_hours"  class="form-control @error('duty_hours') is-invalid @enderror" value="{{ old('duty_hours') }}" required >
                @error('duty_hours')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="col-lg-4">
                <label>Overtime Hours</label>
                <input type="text"  name="overtime_hours"  id="overtime_hours"  class="form-control @error('overtime_hours') is-invalid @enderror" value="{{ old('overtime_hours')  }}" required >
                @error('overtime_hours')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

                <div class="col-lg-4">
                      <label> Uniform Status</label>
                <input type="text"  name="uniform_status"  id="uniform_status" class="form-control @error('uniform_status') is-invalid @enderror" value="{{ old('uniform_status')  }}" required>
                @error('uniform_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>
      </div><br>



      <div class="row">

                  <div class="col-lg-4">
                <label> Other Benefits </label>
                <input type="text"  name="other_benefits"  id="other_benefits" class="form-control @error('other_benefits') is-invalid @enderror" value="{{ old('other_benefits')  }}" required >
                @error('other_benefits')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

                  <div class="col-lg-4">
                <label> Other Condition </label>
                <input type="text"  name="other_condition"  id="other_condition" class="form-control @error('  other_condition') is-invalid @enderror" value="{{ old('other_condition')  }}" required >
                @error('other_condition')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>
              
     </div><br>


     <div class="row">
                <div class="col-lg-4">
                <label> Attached Document 1 </label>
                <input type="file" name="attached_document1"  id="  attached_document1" class=" @error('  attached_document1') is-invalid @enderror" value="{{ old('attached_document1')  }}"   required >
                @error('attached_document1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                 <div class="col-lg-4">
                <label> Attached Document 2 </label>
                <input type="file" name="attached_document2"  id="attached_document2" class=" @error('  attached_document2') is-invalid @enderror" value="{{ old('attached_document2')  }}"   required >
                @error('attached_document2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                   <div class="col-lg-4">
                <label> Attached Document 3 </label>
                <input type="file" name="attached_document3"  id="attached_document3" class=" @error('  attached_document3') is-invalid @enderror" value="{{ old('attached_document3')  }}"   required >
                @error('attached_document3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
     </div> <br>


      <div class="row">
                <div class="col-lg-4">
                <label> Attached Document 4</label>
                <input type="file" name="attached_document4"  id="  attached_document4" class=" @error('  attached_document4') is-invalid @enderror" value="{{ old('attached_document4')  }}"   required >
                @error('attached_document4')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                 <div class="col-lg-4">
                <label> Attached Document 5 </label>
                <input type="file" name="attached_document5"  id="attached_document5" class=" @error('  attached_document5') is-invalid @enderror" value="{{ old('attached_document5')  }}"   required >
                @error('attached_document5')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
     </div> <br>









             </div>
            </div>
             <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Create </button>
        </div>
       
        

       
    </form>
</div>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js" defer></script>

<script type="text/javascript">
  $(document).ready(function(){

    $('#category').change(function(){
  var categoryID = $(this).val();  
  if(categoryID){
    $.ajax({
      type:"GET",
      url:"{{url('getCategory')}}?category_id="+categoryID,
      success:function(res){  
      if(res){
        $("#subcategory").empty();
        $("#subcategory").append('<option>Select Enquiry</option>');
        $.each(res,function(key,value){
          $("#subcategory").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#subcategory").empty();
      }
      }
    });
  }else{
    $("#subcategory").empty();
   
  }   
  });



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
   
  }   
  });


  








  $('.addRow').on('click',function(){
    addRow();


         $('select[name="job_main_category_id[]"]').on('change',function(){
    var categoryID = $(this).val();  

    if(categoryID)
      {
         $.ajax({
            url:"{{url('getCategory')}}?category_id="+categoryID,
             type : "GET",
             dataType : "json",
             success:function(data)
                 {
                    console.log(data);
                    $('select[name="job_sub_category_id[]"]').empty();
                    $('select[name="job_sub_category_id[]"]').append('<option value="" selected disabled >-Select-</option>');
                    $.each(data, function(key,value){     

                           $('select[name="job_sub_category_id[]"]').append('<option value="'+key+'">'+value+'</option>');

                     });
                 }
           });
      }
      else
      {
          $('select[name="job_sub_category_id[]"]').empty();
       }
});




  });

  function addRow(){
    var tr='<tr>'+
    '<td><select class="form-control select2" name="job_main_category_id[]" id="category" required><option value="">-select-</option>@foreach ($categories as $data)<option value="{{ $data->category_id  }}">{{ $data->category_name }}</option>@endforeach</select></td>'+
    '<td><select name="job_sub_category_id[]" id="subcategory" class="form-control" required></select></td>'+
    '<td><input type="text" name="enquiy_project_location_id[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="basic_salary[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="cola_allownces[]" class="form-control" required=""></td>'+
     '<td><input type="text" name="food_allownce[]" class="form-control" required=""></td>'+
     '<td><input type="text" name="transportation_allownce[]" class="form-control" required=""></td>'+
     '<td><input type="text" name="accomodation_allownce[]" class="form-control" required=""></td>'+
     '<td><input type="text" name="medical_allownce[]" class="form-control" required=""></td>'+
     '<td><input type="text" name="overtime_allownce[]" class="form-control" required=""></td>'+
    
    
    '<td><a href="javascrip:" class="btn btn-sm btn-danger remove"><i class="fa fa-remove"></i></a></td>'
    '<tr>';
    $('tbody').append(tr);
  };

  $('.remove').live('click',function () {
      var last= $('tbody tr').length;
      //alert(last);
      if(last==2){
        alert('you can not remove last row');
      }
      else{
        $(this).parent().parent().remove();
      }
  });










    });






  </script>
@stop

