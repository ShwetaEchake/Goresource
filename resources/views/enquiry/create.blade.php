@extends('layouts.admin')

@section('title')
Create Enquiry
@endsection

@section('css')
<style>
div.scrollable
{
width:100%;
height: 100px;
margin: 0;
padding: 0;
overflow-y: scroll
}

</style>
 
@endsection
 

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New</h3>
        <div class="card-tools">
                <a href="{{ route('enquiry.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>
    <form method="POST" action="{{ route('enquiry.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                 
    <div class="row">
                <?php $company=DB::table('client')->where('client_id',$_GET['clientid'])->first(); ?>
                  
                 <div class="col-lg-6">
                     <label>  Company Name </label>
                      <input type="text" name="" value="{{$company->company_name}}" class="form-control" readonly>
                      <input type="hidden" name="client_id" value="<?php echo $_GET['clientid'] ?>">

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


 

<br>
    <h5> Job :</h5>

<div class="panel panel-footer">
    <table class="table table-bordered table-responsive"  id="dynamicAddRemove">
        <thead>
                <tr>
                    <th nowrap> Category Name</th>
                    <!--<th> Trade</th> -->
                    <th nowrap>Project Location</th>
                    <th nowrap>Basic Salary</th>
                    <th nowrap>Cola </th>
                    <th nowrap>Food </th>
                    <th>Transportation </th> 
                    <th>Accomodation </th>
                    <th nowrap>Medical  </th>
                    <th>Overtime </th>
                    <th>Fuel</th>
                    <th>Mobile </th>
                    <th>Other </th>
                    <th>Detail</th>
                    <th>Gross Salary</th>


                  

                     <th><a href="javascrip:" class="btn btn-sm btn-success addRow"><i class="fa fa-plus"></i> </a></th>
                </tr>
        </thead>

        <tbody id="jobs">
            <tr>
                <td> 
                    <select class="form-control" name="job_main_category_id[]" id="category" required>
                                <option value="">-Select-</option>
                                @foreach ($categories as $data)
                                <option value="{{ $data->category_id  }}">{{ $data->category_name }}</option>
                                @endforeach
                    </select>  <br>
                   <!--  <select name="job_sub_category_id[]" id="subcategory" class="form-control" required=""></select> -->
                </td>
<!--      <td width=""><select name="job_sub_category_id[]" id="subcategory" class="form-control" required=""></select></td>-->
               <!--  <td><input type="text" name="enquiy_project_location_id[]" class="form-control" required=""></td> -->


    
<?php
  $values= DB::table('client_location')->where('client_id',$_GET['clientid'])->get(); 
?>


                <td>
                    <label>Required No :</label>
                    <div class="scrollable">
                   <!--<select class="form-control select2" name="enquiy_project_location_id[]" id="category" required> -->
                            <!--<option value="">-select-</option> -->
                                @foreach ($values as $data)
                                   {{ $data->client_location_code }}     
                                   <input type="hidden" name="location_id[]" value="{{ $data->client_location_id }}" class="form-control"></input>         
                                   <input type="text" name="required_position[{{ $data->client_location_id }}][]" value="" class="form-control"></input>
                                @endforeach
                    <!--</select>  <br>-->
                     </div>
                </td>

                <td><input type="text" style="width: 120px;" name="basic_salary[]" class="form-control"></td>
                <td><input type="text" style="width: 120px;" name="cola_allownces[]" class="form-control"></td>
                <td><input type="text" style="width: 120px;"  name="food_allownce[]" class="form-control"></td>
                <td><input type="text" name="transportation_allownce[]" class="form-control"></td> 
                <td><input type="text" name="accomodation_allownce[]" class="form-control"></td>
                <td><input type="text" style="width: 120px;" name="medical_allownce[]" class="form-control"></td>
                <td><input type="text" style="width: 120px;" name="overtime_allownce[]" class="form-control"></td>
                <td><input type="text" style="width: 120px;"  name="fuel[]" class="form-control"></td>
                <td><input type="text" style="width: 120px;"  name="mobile[]" class="form-control"></td>
                <td><input type="text" style="width: 120px;"  name="other[]" class="form-control"></td>
                <td>
                    <textarea rows="2" cols="200" name="detail[]" class="form-control" style="width:500px; height: 100px;"></textarea>
                </td>
                 <td><input type="number" style="width: 120px;"  name="gross_salary[]" class="form-control"></td>

                <td><a href="javascrip:" class="btn btn-sm btn-danger remove"><i class="fa fa-remove"></i></a></td>
            <tr>
        </tbody>

             
    </table>
</div>


<br>


     <div class="row">

                <div class="col-lg-4">
                <label>Contract Period </label>
                <input type="text" name="contract_period"  id="contract_period" class="form-control @error('contract_period') is-invalid @enderror" value="{{ old('contract_period') }}"  >
                @error('contract_period')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label> Place of Work </label>
                <input type="text" name="place_of_work"  id="place_of_work" class="form-control @error('place_of_work') is-invalid @enderror" value="{{ old('place_of_work')  }}"    >
                @error('place_of_work')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="col-lg-4">
                <label> Trial Period </label>
                <input type="text" name="trial_period"  id="trial_period" class="form-control @error('trial_period') is-invalid @enderror" value="{{ old('trial_period')  }}"    >
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
                <select name="air_fare" id="air_fare" class="form-control">
                  <option value="">-Select-</option>
                  <option value="provided">Provided</option>
                  <option value="not_provided">Not Provided</option>
                  <option value="as_per_company_rule">As Per Company Rule</option>
                </select>
                <!-- <input type="text" name="air_fare"  id="air_fare" class="form-control @error('air_fare') is-invalid @enderror" value="{{ old('air_fare')  }}"  >
                @error('air_fare')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
                </div>

                   <div class="col-lg-4">
                <label> Employment visa</label>
                 <select name="employment_visa" id="employment_visa" class="form-control">
                  <option value="">-Select-</option>
                  <option value="provided">Provided</option>
                  <option value="not_provided">Not Provided</option>
                  <option value="as_per_company_rule">As Per Company Rule</option>
                </select>
              <!--   <input type="text"  name="employment_visa"  id="employment_visa" class="form-control @error('employment_visa') is-invalid @enderror" value="{{ old('employment_visa')  }}" >
                @error('employment_visa')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
                 </div>


                <div class="col-lg-4">
                   <label> Food </label>
                 <select name="food_status" id="food_status" class="form-control">
                  <option value="">-Select-</option>
                  <option value="provided">Provided</option>
                  <option value="food_allownce">Food Allownce</option>
                </select>
              <!--   <input type="text"  name="food_status"  id="food_status" class="form-control @error('food_status') is-invalid @enderror" value="{{ old('food_status')  }}" >
                @error('food_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
                 </div>

             

             
     </div> <br>


        <div class="row">
                <div class="col-lg-4">
                <label> Transportation </label>
                <select name="transportation_status" id="transportation_status" class="form-control">
                  <option value="">-Select-</option>
                  <option value="provided">Provided</option>
                  <option value="not_provided">Not Provided</option>
                  <option value="as_per_company_rule">As Per Company Rule</option>
                </select>
               <!--  <input type="text"  name="transportation_status"  id="transportation_status" class="form-control @error('transportation_status') is-invalid @enderror" value="{{ old('transportation_status')  }}" >
                @error('transportation_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
                 </div>

                <div class="col-lg-4">
                 <label>Accomodation </label>
                <select name="accomodation_status" id="accomodation_status" class="form-control">
                  <option value="">-Select-</option>
                  <option value="provided">Provided</option>
                  <option value="not_provided">Not Provided</option>
                  <option value="as_per_company_rule">As Per Company Rule</option>
                </select>
             <!--    <input type="text"  name="accomodation_status"  id="accomodation_status" class="form-control @error('accomodation_status') is-invalid @enderror" value="{{ old('accomodation_status')  }}" >
                @error('accomodation_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
                 </div>

                <div class="col-lg-4">
                 <label> Medical </label>
                <select name="medical_status" id="medical_status" class="form-control">
                  <option value="">-Select-</option>
                  <option value="provided">Provided</option>
                  <option value="not_provided">Not Provided</option>
                  <option value="as_per_company_rule">As Per Company Rule</option>
                </select>
             <!--    <input type="text"  name="medical_status"  id="medical_status" class="form-control @error('medical_status') is-invalid @enderror" value="{{ old('medical_status')  }}" >
                @error('medical_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
                </div>
      </div><br>



  


     <div class="row">
                <div class="col-lg-4">
                <label> Duty Hours </label>
                <input type="text"  name="duty_hours"  id="duty_hours"  class="form-control @error('duty_hours') is-invalid @enderror" value="{{ old('duty_hours') }}"  >
                @error('duty_hours')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="col-lg-4">
                <label>Overtime</label>
                 <select name="overtime_hours" id="overtime_hours" class="form-control">
                  <option value="">-Select-</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                  <option value="fixed_ot">Fixed OT</option>
                  <option value="as_per_company_rule">As Per Company Rule</option>
                </select>
               <!--  <input type="text"  name="overtime_hours"  id="overtime_hours"  class="form-control @error('overtime_hours') is-invalid @enderror" value="{{ old('overtime_hours')  }}"  >
                @error('overtime_hours')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
                 </div>

                <div class="col-lg-4">
                <label> Uniform </label>
                <select name="uniform_status" id="uniform_status" class="form-control">
                  <option value="">-Select-</option>
                  <option value="provided">Provided</option>
                  <option value="not_provided">Not Provided</option>
                  <option value="as_per_company_rule">As Per Company Rule</option>
                </select>
                <!-- <input type="text"  name="uniform_status"  id="uniform_status" class="form-control @error('uniform_status') is-invalid @enderror" value="{{ old('uniform_status')  }}" >
                @error('uniform_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
                 </div>
      </div><br>



      <div class="row">

                  <div class="col-lg-4">
                <label> Other Benefits </label>
                <input type="text"  name="other_benefits"  id="other_benefits" class="form-control @error('other_benefits') is-invalid @enderror" value="{{ old('other_benefits')  }}"  >
                @error('other_benefits')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

                  <div class="col-lg-4">
                <label> Other Condition </label>
                <input type="text"  name="other_condition"  id="other_condition" class="form-control @error('  other_condition') is-invalid @enderror" value="{{ old('other_condition')  }}"  >
                @error('other_condition')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>



                  <div class="col-lg-4">
                <label> Water,Gas,Electricity </label>
                 <select name="water_gas" id="water_gas" class="form-control">
                  <option value="">-Select-</option>
                  <option value="provided">Provided</option>
                  <option value="not_provided">Not Provided</option>
                  <option value="as_per_company_rule">As Per Company Rule</option>
                </select>
                <!-- <input type="text"  name="water_gas"  id="water_gas" class="form-control @error('water_gas') is-invalid @enderror" value="{{ old('water_gas')  }}"  >
                @error('water_gas')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
                 </div>
              
     </div><br>

     <div class="row">
         
                  <div class="col-lg-4">
                <label>Service Charge </label>
                <input type="text"  name="service_charge"  id="service_charge" class="form-control @error('  service_charge') is-invalid @enderror" value="{{ old('service_charge')  }}"  >
                @error('service_charge')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>
     </div><br>


     <h4>Assign Enquiry Brach:</h4>

         <div class="form-group">
               <!--  <label>Branch</label><br> -->
                @foreach ($branch as $data)
                 <input type="checkbox" name="permission[{{$data->branch_id}}]"  id=""> {{$data->branch_name}}</>
                @endforeach                      
        </div> <br>





<!--------------------------------Documents Start--------------------------- -->

<h4> Enquiry Documents:</h4>

<div class="panel panel-footer">
    <table class="table  table-responsive table-bordered" id="dynamicAddRemove">
        <thead>
                <tr>
                    <th width="50%">Title</th>
                    <th width="50%"> Image</th>
                    <th><a href="javascip:" class="btn btn-sm btn-success addDocuments"><i class="fa fa-plus"></i> </a></th>
                </tr>
        </thead>

        <tbody id="documents">
            <tr>
                <td width="50%">   
                   <!--  <input type="text" name="enquiry_document_title[]" class="form-control"> -->
                      <select class="form-control select2" name="enquiry_document_title[]" id="enquiry_document_title" >
                                <option value="">-select-</option>
                                @foreach ($document as $data)
                                <option value="{{ $data->enquiry_documenttype_id  }}">{{ $data->enquiry_documenttype_name }}</option>
                                @endforeach
                    </select>  

                </td>
                <td width="50%"><input type="file" name="enquiry_document_path[]" class="form-control" ></td>    
                <td><a href="javascip:" class="btn btn-sm btn-danger removeDocuments"><i class="fa fa-remove"></i></a></td>
            <tr>
        </tbody>

   <!-- <tfoot>
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
<!-- ------------------------------Documents End--------------------------- -->





    {{-- <div class="row">
                <div class="col-lg-4">
                <label> Attached Document 1 </label>
                <input type="file" name="attached_document1"  id="  attached_document1" class=" @error('  attached_document1') is-invalid @enderror" value="{{ old('attached_document1')  }}"  >
                @error('attached_document1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                 <div class="col-lg-4">
                <label> Attached Document 2 </label>
                <input type="file" name="attached_document2"  id="attached_document2" class=" @error('  attached_document2') is-invalid @enderror" value="{{ old('attached_document2')  }}"  >
                @error('attached_document2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                   <div class="col-lg-4">
                <label> Attached Document 3 </label>
                <input type="file" name="attached_document3"  id="attached_document3" class=" @error('  attached_document3') is-invalid @enderror" value="{{ old('attached_document3')  }}"  >
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
                <input type="file" name="attached_document4"  id="  attached_document4" class=" @error('  attached_document4') is-invalid @enderror" value="{{ old('attached_document4')  }}"  >
                @error('attached_document4')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                 <div class="col-lg-4">
                <label> Attached Document 5 </label>
                <input type="file" name="attached_document5"  id="attached_document5" class=" @error('  attached_document5') is-invalid @enderror" value="{{ old('attached_document5')  }}"   >
                @error('attached_document5')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
     </div> <br>--}}







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
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}" defer> </script>

<script type="text/javascript">
  $(document).ready(function(){

  $('#category').select2();
/*
  $('#category').change(function(){
   var clientID = $(this).val();  

	alert(clientID);

	});
*/
  //   $('#category').select2().change(function(){
  // var categoryID = $(this).val();  
  // if(categoryID){
  //   $.ajax({
  //     type:"GET",
  //     url:"{{url('getCategory')}}?category_id="+categoryID,
  //     success:function(res){  
  //     if(res){
  //       $("#subcategory").empty();
  //       $("#subcategory").append('<option>Select Enquiry</option>');
  //       $.each(res,function(key,value){
  //         $("#subcategory").append('<option value="'+key+'">'+value+'</option>');
  //       });
      
  //     }else{
  //       $("#subcategory").empty();
  //     }
  //     }
  //   });
  // }else{
  //   $("#subcategory").empty();
   
  // }   
  // });



  //    $('#client_id').change(function(){
  // var clientID = $(this).val();  
  // if(clientID){
  //   $.ajax({
  //     type:"GET",
  //     url:"{{url('getEnquiry')}}?client_id="+clientID,
  //     success:function(res){  
  //     if(res){
  //       $("#enquiry_id").empty();
  //       $("#enquiry_id").append('<option>Select Enquiry</option>');
  //       $.each(res,function(key,value){
  //         $("#enquiry_id").append('<option value="'+key+'">'+value+'</option>');
  //       });
      
  //     }else{
  //       $("#enquiry_id").empty();
  //     }
  //     }
  //   });
  // }else{
  //   $("#enquiry_id").empty();
   
  // }   
  // });


  








  $('.addRow').on('click',function(){
    addRow();


         $('select[name="job_main_category_id[]"]').select2().on('change',function(){
    var categoryID = $(this).val();  

    // if(categoryID)
    //   {
    //      $.ajax({
    //         url:"{{url('getCategory')}}?category_id="+categoryID,
    //          type : "GET",
    //          dataType : "json",
    //          success:function(data)
    //              {
    //                 console.log(data);
    //                 $('select[name="job_sub_category_id[0]"]').empty();
    //                 $('select[name="job_sub_category_id[0]"]').append('<option value="" selected disabled >-Select-</option>');
    //                 $.each(data, function(key,value){     

    //                        $('select[name="job_sub_category_id[0]"]').append('<option value="'+key+'">'+value+'</option>');

    //                  });
    //              }
    //        });
    //   }
    //   else
    //   {
    //       $('select[name="job_sub_category_id[0]"]').empty();
    //    }
});




  });
// <select name="job_sub_category_id[0]" id="subcategory" class="form-control" required></select>



  // <div class="scrollable">
                  
  //                               @foreach ($values as $data)
  //                                  {{ $data->client_location_code }}     
  //                                  <input type="hidden" name="location_id[]" value="{{ $data->client_location_id }}" class="form-control"></input>         
  //                                  <input type="text" name="required_position[]" value="" class="form-control"></input>
  //                               @endforeach
  //                   <!--</select>  <br>-->
  //                    </div>

  function addRow(){
    var tr='<tr>'+
    '<td><select class="form-control" name="job_main_category_id[]" id="" required><option value="">-select-</option>@foreach ($categories as $data)<option value="{{ $data->category_id  }}">{{ $data->category_name }}</option>@endforeach </select></td>'+
    '<td> <div class="scrollable"> @foreach ($values as $data){{ $data->client_location_code }}<input type="hidden" name="location_id[]" value="{{ $data->client_location_id }}" class="form-control"></input><input type="text" name="required_position[{{$data->client_location_id }}][]" value="" class="form-control"></input>@endforeach <br></div></td>'+
    '<td><input type="text" name="basic_salary[]" class="form-control"></td>'+
    '<td><input type="text" name="cola_allownces[]" class="form-control"></td>'+
     '<td><input type="text" name="food_allownce[]" class="form-control"></td>'+
     '<td><input type="text" name="transportation_allownce[]" class="form-control"></td>'+
     '<td><input type="text" name="accomodation_allownce[]" class="form-control"></td>'+
     '<td><input type="text" name="medical_allownce[]" class="form-control"></td>'+
     '<td><input type="text" name="overtime_allownce[]" class="form-control"></td>'+
     '<td><input type="text"  name="fuel[]" class="form-control"></td>'+
     '<td><input type="text"  name="mobile[]" class="form-control"></td>'+
     '<td><input type="text"  name="other[]" class="form-control"></td>'+
     '<td><textarea rows="2" cols="200" name="detail[]" class="form-control" style="width:500px; height: 100px;"></textarea></td>'+
     '<td><input type="number" style="width: 120px;"  name="gross_salary[]" class="form-control"></td>'+

    
    '<td><a href="javascrip:" class="btn btn-sm btn-danger remove"><i class="fa fa-remove"></i></a></td>'
    '<tr>';
    $('#jobs').append(tr);
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






// --------------------------Documents Start-------------------
  $('.addDocuments').on('click',function(){
    addDocuments();
  });

  function addDocuments(){
    var tr='<tr>'+
    '<td width="50%"><select class="form-control select2" name="enquiry_document_title[]" id="enquiry_document_title" required><option value="">-select-</option>@foreach ($document as $data)<option value="{{ $data->enquiry_documenttype_id  }}">{{ $data->enquiry_documenttype_name }}</option>@endforeach</select></td>'+
    '<td width="50%"><input type="file" name="enquiry_document_path[]" class="form-control" multiple=""></td>'+
    '<td><a href="javascrip:" class="btn btn-sm btn-danger removeDocuments"><i class="fa fa-remove"></i></a></td>'
    '<tr>';
    $('#documents').append(tr);
  };

  $('.removeDocuments').live('click',function () {
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
// --------------------------Documents End-------------------





    });





  </script>

  
@stop

