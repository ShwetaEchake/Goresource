@extends('layouts.admin')

@section('title')
Edit Job
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
        <h3 class="card-title">Edit Job </h3>
        <div class="card-tools">
                <a href="{{ route('enquiry.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>
    <form method="POST" action="{{ route('enquiry.update',$enquiry->enquiry_id) }}" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                 


   {{--     <div class="row">
            

                <div class="col-lg-6">
                <label>Company Name</label>
                <select class="form-control select2" name="client_id" id="client_id" required>
                              <option value="">-select-</option>
                              @foreach ($client as $data)
                                  <option value="{{ $data->client_id }}" {{ $data->client_id == $job->client_id ?  'selected' : '' }}>{{$data->company_name}}</option>
                              @endforeach
                </select>  
                </div>

                 <div class="col-lg-6">
                <label>Enquiries</label>
                <select class="form-control select2" name="enquiry_id" id="enquiry_id" required>
                              <option value="">-select-</option>
                              @foreach ($enquiry as $data)
                              <option value="{{ $data->enquiry_id }}" {{ $data->enquiry_id == $job->enquiry_id ?  'selected' : '' }}>{{$data->enquiry_title}}</option>
                              @endforeach
                </select>  
                </div>
     </div><br>


 
       <div class="row">
                
  
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
                    <select name="job_sub_category_id" id="subcategory" class="form-control" required=""></select>
                </div>



             
     </div> <br>


     <div class="row">

                <div class="col-lg-4">
              <label>Project Location</label>
                <select class="form-control select2" name="enquiy_project_location_id" id="enquiy_project_location_id" required>
                              <option value="">-select-</option>
                              @foreach ($projectlocation as $data)
                               <option value="{{ $data->enquiy_project_location_id }}" {{ $data->enquiy_project_location_id == $job->enquiy_project_location_id ?  'selected' : '' }}>{{$data->required_position}}</option>


                              @endforeach
                </select>  
                 </div>

                <div class="col-lg-4">
                <label>Basic Salary</label>
                <input type="text"  name="basic_salary"  id="basic_salary" class="form-control @error('  basic_salary') is-invalid @enderror" value="{{$job->basic_salary}}" required ></input>
                @error('basic_salary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="col-lg-4">
                <label> Cola Allownces</label>
                <input type="text"  name="cola_allownces"  id="cola_allownces" class="form-control @error('cola_allownces') is-invalid @enderror" value="{{$job->cola_allownces }}" required >
                @error('cola_allownces ')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

    </div><br>



        <div class="row">
              
                <div class="col-lg-4">
                <label> Food Allownce</label>
                <input type="text"  name="food_allownce"  id="food_allownce"   class="form-control @error('food_allownce') is-invalid @enderror" value="{{ $job->food_allownce }}" required >
                @error('food_allownce')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                 <div class="col-lg-4">
                <label> Transportation Allownce</label>
                <input type="text"  name="transportation_allownce"  id="transportation_allownce"   class="form-control @error('transportation_allownce') is-invalid @enderror" value="{{ $job->transportation_allownce }}" required >
                @error('transportation_allownce')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label> Accomodation Allownce </label>
                <input type="text"  name="accomodation_allownce"  id="accomodation_allownce"  class="form-control @error('   accomodation_allownce') is-invalid @enderror" value="{{ $job->accomodation_allownce}}" required ></input>
                @error('accomodation_allownce')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

      </div><br>



  


     <div class="row">

                <div class="col-lg-4">
                <label> Medical Allownce </label>
                <input type="text"  name="medical_allownce"  id="medical_allownce"  class="form-control @error('  medical_allownce') is-invalid @enderror" value="{{ $job->medical_allownce  }}" required >
                @error('medical_allownce')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

                <div class="col-lg-4">
                <label> Overtime Allownce </label>
                <input type="text"  name="overtime_allownce"  id="overtime_allownce"   class="form-control @error('overtime_allownce') is-invalid @enderror" value="{{$job->overtime_allownce}}" required >
                @error('overtime_allownce')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


    </div><br>
    --}}



  <div class="row">
                  <div class="col-lg-6">
                        <label>Company Name</label>
                        <select class="form-control select2" name="client_id" id="client_id" required readonly>
                                      <option value="">-select-</option>
                                      @foreach ($client as $data)
                                          <option value="{{ $data->client_id }}" {{ $data->client_id == $enquiry->client_id ?  'selected' : '' }}>{{$data->company_name}}</option>
                                      @endforeach
                        </select>  
                   </div>
 

                <div class="col-lg-6">
                <label>  Title </label>
           
                <input type="text" name="enquiry_title"  id="enquiry_title" class="form-control @error('enquiry_title') is-invalid @enderror" value="{{$enquiry->enquiry_title}}" required  readonly=""> 
              
                @error('enquiry_title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
   </div>
<br>
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
                @foreach($jobs as $job)
                <input type="hidden" name="id[]" value="{{$job->job_id}}">
            <tr>
                <td> 
                    <select class="form-control select2" name="job_main_category_id[]" id="category" required>
                                <option value="">-select-</option>
                                @foreach ($categories as $data)
                                  <option value="{{ $data->category_id }}" {{ $data->category_id == $job->job_main_category_id ?  'selected' : '' }}>{{$data->category_name}}</option>
                                @endforeach
                    </select>  
                </td>

           {{-- <td>
                 <select name="job_sub_category_id[]" id="subcategory" value="{{$job->job_sub_category_id}}" class="form-control">
                   @foreach ($sub as $data) @endforeach
                  <option value="{{ $data->category_id }}" {{ $data->category_id == $job->job_sub_category_id ?  'selected' : '' }}>{{$data->category_name}}</option>
                 </select>
            </td>  --}}

              <!--   <td><input type="number" name="enquiy_project_location_id[]" value="{{$job->enquiy_project_location_id}}" class="form-control" required=""></td> -->

                <td>
    <label>Required No :</label>
 <div class="scrollable">

                   <!-- <select class="form-control select2" name="enquiy_project_location_id[]" id="category" required>
                                <option value="">-select-</option>
                                @foreach ($client_location as $data)
                                <option value="{{ $data->client_location_id  }}">{{ $data->client_location_name }}</option>
                                @endforeach
                    </select><br> -->
   
         @foreach ($client_location as $data)
                       {{ $data->client_location_code }}     
                       <input type="hidden" name="location_id[]" value="{{ $data->client_location_id }}" class="form-control"></input>   
                       <input type="hidden" name="job_ids[]" value="{{$job->job_id}}" class="form-control"></input>   

                   <?php      
                        $project_location=DB::table('project_location')->where('location_id',$data->client_location_id)  
                                                                       ->where('enquiry_id',$enquiry->enquiry_id)
                                                                      ->where('job_id',$job->job_id)->first();
                        if(!empty($project_location)){
                            $required_position=$project_location->required_position;
                        }else{
                             $required_position='';
                        }
                   ?>
                       <input type="text" name="required_position[{{ $data->client_location_id }}-{{$job->job_id}}]" value="{{ $required_position }}" class="form-control"></input>        
                      
                        
        @endforeach

</div>            

               </td>



                <td><input type="text" style="width: 120px;" name="basic_salary[]" value="{{$job->basic_salary}}" class="form-control" ></td>
                <td><input type="text" style="width: 120px;" name="cola_allownces[]" value="{{$job->cola_allownces}}" class="form-control" ></td>
                <td><input type="text" style="width: 120px;" name="food_allownce[]" value="{{$job->food_allownce}}" class="form-control" ></td>
                <td><input type="text" name="transportation_allownce[]" value="{{$job->transportation_allownce}}" class="form-control" ></td> 
                <td><input type="text" name="accomodation_allownce[]" value="{{$job->accomodation_allownce}}" class="form-control" ></td>
                <td><input type="text" style="width: 120px;" name="medical_allownce[]" value="{{$job->medical_allownce}}" class="form-control" ></td>
                <td><input type="text" style="width: 120px;" name="overtime_allownce[]" value="{{$job->overtime_allownce}}" class="form-control" ></td>

              <td><input type="text" style="width: 120px;"  name="fuel[]" value="{{$job->fuel}}"  class="form-control" ></td>
              <td><input type="text" style="width: 120px;"  name="mobile[]" value="{{$job->mobile}}"  class="form-control" ></td>
              <td><input type="text" style="width: 120px;"  name="other[]" value="{{$job->other}}"  class="form-control" ></td>


                <td> <textarea rows="2" cols="200" name="detail[]" class="form-control" style="width:500px; height: 100px;">{{$job->detail}}</textarea></td>

                <td><input type="number" style="width: 120px;"  name="gross_salary[]" value="{{$job->gross_salary}}" class="form-control"></td>
             


                <td><a href="javascrip:" class="btn btn-sm btn-danger remove" style="display:none;"><i class="fa fa-remove"></i></a></td>
            <tr>
                @endforeach
        </tbody>

             
    </table>
</div>


<br>

     <div class="row">
              
                <div class="col-lg-4">
                <label>Contract Period </label>
                <input type="text" name="contract_period"  id="contract_period" class="form-control @error('contract_period') is-invalid @enderror" value="{{ $enquiry->contract_period }}"  >
                @error('contract_period')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="col-lg-4">
                <label> Place of Work </label>
                <input type="text" name="place_of_work"  id="place_of_work" class="form-control @error('place_of_work') is-invalid @enderror" value="{{ $enquiry->place_of_work }}"    >
                @error('place_of_work')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="col-lg-4">
                <label> Trial Period </label>
                <input type="text" name="trial_period"  id="trial_period" class="form-control @error('trial_period') is-invalid @enderror" value="{{$enquiry->trial_period}}"    >
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

<select class="form-control valdation_select" name="air_fare" >
    <option value=''> -Select- </option>  
    <option value='provided' <?=isset($enquiry->air_fare) && $enquiry->air_fare ==  'provided' ? 'selected':""?> >  Provided </option>
    <option value='not_provided' <?=isset($enquiry->air_fare) && $enquiry->air_fare == 'not_provided' ? '  selected':""?>      > Not Provided </option>    
    <option value='as_per_company_rule' <?=isset($enquiry->air_fare) && $enquiry->air_fare == 'as_per_company_rule' ? '  selected':""?> >       As Per Company Rule </option>      
</select>     

               <!--  <input type="text" name="air_fare"  id="air_fare" class="form-control @error('air_fare') is-invalid @enderror" value="{{ $enquiry->air_fare }}"  >
                @error('air_fare')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
                </div>

                   <div class="col-lg-4">
                <label> Employment visa</label>

<select class="form-control valdation_select" name="employment_visa" >
    <option value=''> -Select- </option>  
    <option value='provided' <?=isset($enquiry->employment_visa) && $enquiry->employment_visa ==  'provided' ? 'selected':""?> >  Provided </option>
    <option value='not_provided' <?=isset($enquiry->employment_visa) && $enquiry->employment_visa == 'not_provided' ? '  selected':""?>      > Not Provided </option>    
    <option value='as_per_company_rule' <?=isset($enquiry->employment_visa) && $enquiry->employment_visa == 'as_per_company_rule' ? '  selected':""?> >       As Per Company Rule </option>      
</select> 

               <!--  <input type="text"  name="employment_visa"  id="employment_visa" class="form-control @error('employment_visa') is-invalid @enderror" value="{{ $enquiry->employment_visa  }}" >
                @error('employment_visa')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
                 </div>


                <div class="col-lg-4">
                   <label> Food </label>

<select class="form-control valdation_select" name="food_status" >
    <option value=''> -Select- </option>  
    <option value='provided' <?=isset($enquiry->food_status) && $enquiry->food_status ==  'provided' ? 'selected':""?> >  Provided </option>
    <option value='food_allownce' <?=isset($enquiry->food_status) && $enquiry->food_status == 'food_allownce' ? '  selected':""?>      > Food Allownce </option>         
</select> 


             <!--    <input type="text"  name="food_status"  id="food_status" class="form-control @error('food_status') is-invalid @enderror" value="{{ $enquiry->food_status  }}" >
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

<select class="form-control valdation_select" name="transportation_status" >
    <option value=''> -Select- </option>  
    <option value='provided' <?=isset($enquiry->transportation_status) && $enquiry->transportation_status ==  'provided' ? 'selected':""?> >  Provided </option>
    <option value='not_provided' <?=isset($enquiry->transportation_status) && $enquiry->transportation_status == 'not_provided' ? '  selected':""?>      > Not Provided </option>    
    <option value='as_per_company_rule' <?=isset($enquiry->transportation_status) && $enquiry->transportation_status == 'as_per_company_rule' ? '  selected':""?> >       As Per Company Rule </option>      
</select> 
               <!--  <input type="text"  name="transportation_status"  id="transportation_status" class="form-control @error('transportation_status') is-invalid @enderror" value="{{$enquiry->transportation_status }}" >
                @error('transportation_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
                 </div>

                <div class="col-lg-4">
                     <label>Accomodation </label>
<select class="form-control valdation_select" name="accomodation_status" >
    <option value=''> -Select- </option>  
    <option value='provided' <?=isset($enquiry->accomodation_status) && $enquiry->accomodation_status ==  'provided' ? 'selected':""?> >  Provided </option>
    <option value='not_provided' <?=isset($enquiry->accomodation_status) && $enquiry->accomodation_status == 'not_provided' ? '  selected':""?>      > Not Provided </option>    
    <option value='as_per_company_rule' <?=isset($enquiry->accomodation_status) && $enquiry->accomodation_status == 'as_per_company_rule' ? '  selected':""?> >       As Per Company Rule </option>      
</select> 
              <!--   <input type="text"  name="accomodation_status"  id="accomodation_status" class="form-control @error('accomodation_status') is-invalid @enderror" value="{{ $enquiry->accomodation_status }}" >
                @error('accomodation_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
                 </div>

                <div class="col-lg-4">
                      <label> Medical </label>

<select class="form-control valdation_select" name="medical_status" >
    <option value=''> -Select- </option>  
    <option value='provided' <?=isset($enquiry->medical_status) && $enquiry->medical_status ==  'provided' ? 'selected':""?> >  Provided </option>
    <option value='not_provided' <?=isset($enquiry->medical_status) && $enquiry->medical_status == 'not_provided' ? '  selected':""?>      > Not Provided </option>    
    <option value='as_per_company_rule' <?=isset($enquiry->medical_status) && $enquiry->medical_status == 'as_per_company_rule' ? '  selected':""?> >       As Per Company Rule </option>      
</select> 
               <!--  <input type="text"  name="medical_status"  id="medical_status" class="form-control @error('medical_status') is-invalid @enderror" value="{{ $enquiry->medical_status  }}" >
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
                <input type="text"  name="duty_hours"  id="duty_hours"  class="form-control @error('duty_hours') is-invalid @enderror" value="{{ $enquiry->duty_hours }}"  >
                @error('duty_hours')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="col-lg-4">
                <label>Overtime </label>
<select class="form-control valdation_select" name="overtime_hours" >
    <option value=''> -Select- </option>  
    <option value='yes' <?=isset($enquiry->overtime_hours) && $enquiry->overtime_hours ==  'yes' ? 'selected':""?> >  Yes </option>
    <option value='no' <?=isset($enquiry->overtime_hours) && $enquiry->overtime_hours ==  'no' ? 'selected':""?> >  No </option>
    <option value='fixed_ot' <?=isset($enquiry->overtime_hours) && $enquiry->overtime_hours == 'fixed_ot' ? '  selected':""?>      > Not Fixed OT </option>    
    <option value='as_per_company_rule' <?=isset($enquiry->overtime_hours) && $enquiry->overtime_hours == 'as_per_company_rule' ? '  selected':""?> >       As Per Company Rule </option>      
</select> 
               <!--  <input type="text"  name="overtime_hours"  id="overtime_hours"  class="form-control @error('overtime_hours') is-invalid @enderror" value="{{$enquiry->overtime_hours  }}"  >
                @error('overtime_hours')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
                 </div>

                <div class="col-lg-4">
                      <label> Uniform </label>

<select class="form-control valdation_select" name="uniform_status" >
    <option value=''> -Select- </option>  
    <option value='provided' <?=isset($enquiry->uniform_status) && $enquiry->uniform_status ==  'provided' ? 'selected':""?> >  Provided </option>
    <option value='not_provided' <?=isset($enquiry->uniform_status) && $enquiry->uniform_status == 'not_provided' ? '  selected':""?>      > Not Provided </option>    
    <option value='as_per_company_rule' <?=isset($enquiry->uniform_status) && $enquiry->uniform_status == 'as_per_company_rule' ? '  selected':""?> >       As Per Company Rule </option>      
</select>
               <!--  <input type="text"  name="uniform_status"  id="uniform_status" class="form-control @error('uniform_status') is-invalid @enderror" value="{{ $enquiry->uniform_status}}" >
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
                <input type="text"  name="other_benefits"  id="other_benefits" class="form-control @error('other_benefits') is-invalid @enderror" value="{{ $enquiry->other_benefits  }}"  >
                @error('other_benefits')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

                  <div class="col-lg-4">
                <label> Other Condition </label>
                <input type="text"  name="other_condition"  id="other_condition" class="form-control @error('  other_condition') is-invalid @enderror" value="{{ $enquiry->other_condition  }}"  >
                @error('other_condition')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>


                <div class="col-lg-4">
                <label> Water,Gas,Electricity </label>

<select class="form-control valdation_select" name="water_gas" >
    <option value=''> -Select- </option>  
    <option value='provided' <?=isset($enquiry->water_gas) && $enquiry->water_gas ==  'provided' ? 'selected':""?> >  Provided </option>
    <option value='not_provided' <?=isset($enquiry->water_gas) && $enquiry->water_gas == 'not_provided' ? '  selected':""?>      > Not Provided </option>    
    <option value='as_per_company_rule' <?=isset($enquiry->water_gas) && $enquiry->water_gas == 'as_per_company_rule' ? '  selected':""?> >       As Per Company Rule </option>      
</select>

               <!--  <input type="text"  name="water_gas"  id="water_gas" class="form-control @error('water_gas') is-invalid @enderror" value="{{ $enquiry->water_gas  }}"  >
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
                <input type="text"  name="service_charge"  id="service_charge" class="form-control @error('  service_charge') is-invalid @enderror"  value="{{ $enquiry->service_charge  }}"  >
                @error('service_charge')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>
     </div><br>

     
<?php
$assignenquiryname="";
    foreach ($assign_enquiry_branch as  $key => $val) {
        $assignenquiryname .= ',' .$val->branch_id;
    }
    $assignenquiryname = substr($assignenquiryname,1);
    $assignenquiryname = explode(',',$assignenquiryname);
?>

 

    <h4>Assign Enquiry Brach:</h4>

         <div class="form-group">
               <!--  <label>Branch</label><br> -->
                @foreach ($branch as $data)
                @if(in_array($data->branch_id,$assignenquiryname))
                <input type="checkbox" name="permission[{{$data->branch_id}}]" checked value="<?php echo $data->branch_id; ?>">
                 {{$data->branch_name}}</>
               
                @else
                 <input type="checkbox" name="permission[{{$data->branch_id}}]" >
                 {{$data->branch_name}}</>
                 @endif
                @endforeach   

        </div> <br>

<?php $clientPath=DB::table('client')->where('client_id',$enquiry->client_id)->select('folder_path')->first();
?>



<!--------------------------------Documents Start--------------------------- -->

<h4> Enquiry Documents:</h4>

<div class="panel panel-footer">
    <table class="table  table-responsive table-bordered" id="dynamicAddRemove">
        <thead>
                <tr>
                    <th></th>
                    <th width="50%">Title</th>
                    <th width="50%"> Image</th>
                    <th><a href="javascip:" class="btn btn-sm btn-success addDocuments"><i class="fa fa-plus"></i> </a></th>
                </tr>
        </thead>

        <tbody id="documents">
            <tr>
                @foreach($enquiry_documents as $documents)
                <td><input type="hidden" name="enquiry_document_id[]" value="{{$documents->enquiry_document_id}}"></td>
                <td width="50%">   
<!--                 <input type="text" name="enquiry_document_title[]" value="{{ $documents->enquiry_document_title }}" class="form-control">
 -->
                 <select class="form-control select2" name="enquiry_document_title[]" id="enquiry_document_title" >
                                <option value="">-select-</option>
                                @foreach ($document as $data)
                                <option value="{{ $data->enquiry_documenttype_id  }}" {{ $data->enquiry_documenttype_id == $documents->enquiry_document_title ?  'selected' : '' }}>{{ $data->enquiry_documenttype_name }}</option>
                                @endforeach
                    </select>  


                </td>
                <td width="50%">
                  @if(!empty($documents->enquiry_document_path))
                     <a href="{{asset('documents/' .$clientPath->folder_path.'/'.$enquiry->directory_path.'/'.$documents->enquiry_document_path)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button>
                    </a> 
                 @endif

                     <input type="file" name="enquiry_document_path[]" class=""  style="margin-left: 3%;">
              </td>   


                <td><a href="javascip:" class="btn btn-sm btn-danger removeDocuments" style="display:none;"><i class="fa fa-remove"></i></a></td>
            <tr>
               @endforeach
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
                    @if(!empty($enquiry->attached_document1))
                    <a href="{{asset('documents/'.$clientPath->folder_path.'/'.$enquiry->folder_path.'/'.$enquiry->attached_document1)}}" target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                    @endif
                <input type="file" name="attached_document1"  id="  attached_document1" class=" @error('  attached_document1') is-invalid @enderror" value="{{$enquiry->attached_document1  }}" >
                @error('attached_document1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                 <div class="col-lg-4">
                <label> Attached Document 2 </label>
                   @if(!empty($enquiry->attached_document2))
                    <a href="{{asset('documents/'.$clientPath->folder_path.'/'.$enquiry->folder_path.'/'.$enquiry->attached_document2)}}" target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                    @endif
                <input type="file" name="attached_document2"  id="attached_document2" class=" @error('  attached_document2') is-invalid @enderror" value="{{ $enquiry->attached_document2 }}" >
                @error('attached_document2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                   <div class="col-lg-4">
                <label> Attached Document 3 </label>
                   @if(!empty($enquiry->attached_document3))
                    <a href="{{asset('documents/'.$clientPath->folder_path.'/'.$enquiry->folder_path.'/'.$enquiry->attached_document3)}}" target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                    @endif
                <input type="file" name="attached_document3"  id="attached_document3" class=" @error('  attached_document3') is-invalid @enderror" value="{{ $enquiry->attached_document3 }}" >
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
                   @if(!empty($enquiry->attached_document4))
                    <a href="{{asset('documents/'.$clientPath->folder_path.'/'.$enquiry->folder_path.'/'.$enquiry->attached_document4)}}" target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                    @endif
                <input type="file" name="attached_document4"  id="  attached_document4" class=" @error('  attached_document4') is-invalid @enderror" value="{{$enquiry->attached_document4  }}" >
                @error('attached_document4')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                 <div class="col-lg-4">
                <label> Attached Document 5 </label>
                  @if(!empty($enquiry->attached_document5))
                    <a href="{{asset('documents/'.$clientPath->folder_path.'/'.$enquiry->folder_path.'/'.$enquiry->attached_document5)}}" target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                    @endif
                <input type="file" name="attached_document5"  id="attached_document5" class=" @error('  attached_document5') is-invalid @enderror" value="{{ $enquiry->attached_document5  }}" >
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
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update </button>
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




  $('.addRow').on('click',function(){
    addRow();






  });
// '<td><select name="job_sub_category_id[]" id="subcategory" value="" class="form-control" required></select></td>'+
  function addRow(){
    var tr='<tr>'+
    '   <input type="hidden" name="id[]" value=""><td><select class="form-control select2" name="job_main_category_id[]" id="category" required><option value="">-select-</option>@foreach ($categories as $data)<option value="{{ $data->category_id  }}">{{ $data->category_name }}</option>@endforeach</select></td>'+
    '<td><div class="scrollable"> @foreach ($client_location as $data){{ $data->client_location_code }} <input type="text" name="required_position[{{ $data->client_location_id }}]" value="" class="form-control"></input>    @endforeach</div></td>'+


    '<td><input type="text" name="basic_salary[]" value="" class="form-control" ></td>'+
    '<td><input type="text" name="cola_allownces[]" value="" class="form-control" ></td>'+
     '<td><input type="text" name="food_allownce[]" value="" class="form-control" ></td>'+
     '<td><input type="text" name="transportation_allownce[]" value="" class="form-control" ></td>'+
     '<td><input type="text" name="accomodation_allownce[]" value="" class="form-control" ></td>'+
     '<td><input type="text" name="medical_allownce[]" value="" class="form-control" ></td>'+
     '<td><input type="text" name="overtime_allownce[]" value="" class="form-control" ></td>'+
      '<td><input type="text"  name="fuel[]"   value=""  class="form-control" ></td>'+
      '<td><input type="text"  name="mobile[]" value=""  class="form-control" ></td>'+
      '<td><input type="text"  name="other[]"  value=""  class="form-control" ></td>'+

     '<td><textarea rows="2" cols="200" name="detail[]" class="form-control" style="width:500px; height: 100px;"></textarea></td>'+
     '<td><input type="number" style="width: 120px;"  name="gross_salary[]" class="form-control"></td>'+
    
    '<td><a href="javascrip:" class="btn btn-sm btn-danger remove"><i class="fa fa-remove"></i></a></td>'
    '<tr>';
    $('#jobs').append(tr);
  };

  $('.remove').live('click',function () {
      var last= $('tbody tr').length;
      //alert(last);
      if(last==3){
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
    '<td><input type="hidden" name="enquiry_document_id[]" value=""></td>'+
   '<td width="50%"><select class="form-control select2" name="enquiry_document_title[]" id="enquiry_document_title" ><option value="">-select-</option>@foreach ($document as $data)<option value="{{ $data->enquiry_documenttype_id  }}">{{ $data->enquiry_documenttype_name }}</option>@endforeach</select></td>'+
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
