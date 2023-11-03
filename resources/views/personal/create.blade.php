@extends('layouts.admin')

@section('title')
Create Candidate
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New Candidate</h3>
        <div class="card-tools">
                <a href="{{ route('personal.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>
    <form method="POST" action="{{ route('personal.store') }}" id="dynamicAddRemove" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                

<div class="row">
               @if(auth()->user()->user_type =='User')
                 <div class="col-lg-4">
                    <label>Branch </label>
                    <input type="text" name="" class="form-control" value="{{$branchnames->branch_name}}" readonly>
                 </div>
               @else
               <div class="col-lg-4">
                     <label>Branch <span style="color: red;">*</span></label>
                     <select class="form-control select2" name="branch_id" id="branch_id" required>
                          <option value="">-select-</option>
                          @foreach ($branch as $data)
                          <option value="{{ $data->branch_id }}">{{ $data->branch_name }}  - {{$data->branch_city}}</option>
                          @endforeach
                     </select>  
                </div>
                @endif


                <div class="col-lg-4">
                <label>  User Name <span style="color: red;">*</span></label>
                <input type="email"  name="user_email"  id="user_email" class="form-control @error('user_email') is-invalid @enderror" value="{{ old('user_email')  }}" required placeholder="Enter your email here ">
                @error('user_email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>


                   <div class="col-lg-4">
                <label>Password <span style="color: red;">*</span></label>
                <input type="password" name="user_password"  id="user_password" class="form-control @error('user_password') is-invalid @enderror" value="{{ old('user_password') }}" required >
                @error('user_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                    
</div><br>

           <div class="row">
                <div class="col-md-3 col-lg-4">
                <label> First Name <span style="color: red;">*</span></label>
                <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-md-3 col-lg-4">
                <label> Middle Name <span style="color: red;">*</span></label>
                <input type="text" name="middle_name"  id="middle_name" class="form-control @error('middle_name') is-invalid @enderror" value="{{ old('middle_name') }}" required >
                @error('middle_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                 <div class="col-md-3 col-lg-4">
                <label> Last Name <span style="color: red;">*</span></label>
                <input type="text" name="last_name"  id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required >
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

         </div><br>


      <div class="row">
                <div class="col-lg-4">
                    <label> Father Name </label>
                    <input type="text" name="father_name"  id="father_name" class="form-control @error('father_name') is-invalid @enderror" value="{{ old('father_name')  }}"    >
                    @error('father_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-lg-4">
                    <label> Mother Name </label>
                    <input type="text" name="mother_name"  id="mother_name" class="form-control @error('mother_name') is-invalid @enderror" value="{{ old('mother_name')  }}"  >
                    @error('mother_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                 <div class="col-lg-4">
                    <label>  Citizenship  <span style="color: red;">*</span></label>
                    <select class="form-control select2" name="citizenship" id="citizenship" required>
                              <option value="">-Select-</option>
                              @foreach ($country as $name)
                              <option value="{{ $name->country_id }}">{{ $name->country_name }}</option>
                              @endforeach
                   </select>  
                </div>

    </div><br>


 <div class="row">

                <div class="col-lg-3">
                     <div class="form-group">
                      <label> Primary Mobile No <span style="color: red;">*</span> </label>
                       <div class="input-group">
                            <div class="input-group-prepend">
                                  <input type="text" style="width:80px"  name="countrycode_mobile_no"  id="countrycode"   class="form-control @error('countrycode_mobile_no') is-invalid @enderror" value="{{ old('countrycode_mobile_no')  }}" readonly >
                            </div>
                           <input type="number"  name="mobile_no"  id="mobile_no"  class="form-control @error('mobile_no') is-invalid @enderror" value="{{ old('mobile_no') }}"  required>
                            @error('mobile_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
                    </div>
                 </div>    


               <div class="col-lg-3">
                    <label>Primary Email <span style="color: red;">*</span></label>
                    <input type="email"  name="email"  id="email"  class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"  required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>    

                 <div class="col-lg-3">
                     <div class="form-group">
                       <label> Secondary Mobile No </label>
                       <div class="input-group">
                            <div class="input-group-prepend">
                                  <input type="text" style="width:80px"  name="countrycode_mobile_no2"  id="country_code"   class="form-control @error('countrycode_mobile_no2') is-invalid @enderror" value="{{ old('countrycode_mobile_no2')  }}" readonly >
                            </div>
                            <input type="number" name="mobile_no2"  id="mobile_no2"  class="form-control @error('mobile_no2') is-invalid @enderror" value="{{ old('mobile_no2') }}"  >
                            @error('mobile_no2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
                    </div>
                 </div>

                    <div class="col-lg-3">
                        <label>Secondary Email</label>
                        <input type="email"  name="email2"  id="email2"  class="form-control @error('email2') is-invalid @enderror" value="{{ old('email2') }}"  >
                        @error('email2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
    </div><br>




    <div class="row">

                <div class="col-lg-3">
                    <label> Date Of Birth </label>
                    <input type="date" onchange="fnCalculateAge();"   name="date_of_birth"  id="txtDOB" class="form-control @error('date_of_birth') is-invalid @enderror" maxlength="10" placeholder="mm/dd/yyyy"  value="{{ old('date_of_birth')  }}" required >

                    @error('date_of_birth')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>

                <div class="col-lg-3">
                    <label> Place Of Birth </label>
                    <input type="text"  name="place_of_birth"  id="place_of_birth" class="form-control @error('place_of_birth') is-invalid @enderror" value="{{ old('place_of_birth')  }}"  >
                    @error('place_of_birth')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            
             <div class="col-lg-3">
                    <label class="control-label" for="inputEmail3">Marital Status</label>
                    <select class="form-control valdation_select" name="merital_status"  >
                    <option value=''> -Select- </option>  
                    <option value='Married' > Married </option>  
                    <option value='Unmarried'> Unmarried </option>   
                    </select>         
             </div>

                
             <div class="col-lg-3">
                    <label class="control-label" for="inputEmail3">Gender</label>
                    <select class="form-control valdation_select" name="gender" >
                    <option value=''> -Select- </option>  
                    <option value='M' > Male</option>  
                    <option value='F'> Female </option>   
                    <option value='O'> Other </option>   
                   </select>         
             </div>


    </div><br>


     <div class="row">

                <div class="col-lg-3">
                    <label> Age</label>
                    <input type="text" readonly  name="age"  id="btnCalculate" min="1"  class="form-control @error('age') is-invalid @enderror">

                    @error('age')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-lg-3">
                    <label> Height </label>
                    <input type="text"  name="height"  id="height" min="1" class="form-control @error('height') is-invalid @enderror" value="{{ old('height') }}"  >
                    @error('height')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                  <div class="col-lg-3">
                    <label>Weight </label>
                    <input type="text"  name="weight"  id="weight"  min="1" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight')  }}"  >
                    @error('weight')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>

                <div class="col-lg-3">
                    <label> Religion</label>
                    <input type="text"  name="religion"  id="religion"   class="form-control @error('religion') is-invalid @enderror" value="{{ old('religion')  }}"  >
                    @error('age')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

    </div>
    <br>



            <div class="row">
 
                <div class="col-lg-3">
                    <label>  Language </label>
                    <input type="text"  name="language"  id="language"  class="form-control @error('language') is-invalid @enderror" value="{{ old(' language') }}"  >
                    @error('language')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
             
 
                <div class="col-lg-3">
                    <label>Other Skill </label>
                    <input type="text"  name="other_skill"  id="other_skill" class="form-control @error('other_skill') is-invalid @enderror" value="{{ old('other_skill')  }}" >
                    @error('other_skill')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>

                <div class="col-lg-3">
                    <label> Computer Skill</label>
                    <input type="text"  name="computer_skill"  id="computer_skill"   class="form-control @error('computer_skill') is-invalid @enderror" value="{{ old('computer_skill')  }}"  >
                    @error('age')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-lg-3">
                    <label> Hobbies Sport </label>
                    <input type="text"  name="hobbies_sport"  id="hobbies_sport"  class="form-control @error('hobbies_sport') is-invalid @enderror" value="{{ old(' hobbies_sport') }}"  >
                    @error('language')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>    

    </div><br>



       <div class="row">
                <div class="col-lg-3">
                    <label>  Aadhar Card </label>
                    <input type="text"  name="aadhar_card"  id="aadhar_card"  class="form-control @error('aadhar_card') is-invalid @enderror" value="{{ old('aadhar_card') }}"   >
                    @error('adhar_card')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
             
                <div class="col-lg-3">
                    <label>Pan Card </label>
                    <input type="text"  name="pan_card"  id="pan_card" class="form-control @error('pan_card') is-invalid @enderror" value="{{ old('pan_card')  }}" >
                    @error('pan_card')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>

                <div class="col-lg-3">
                    <label> Driving Licence</label>
                    <input type="text"  name="driving_licence"  id="driving_licence"   class="form-control @error('driving_licence') is-invalid @enderror" value="{{ old('driving_licence')  }}"  >
                    @error('driving_licence')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                  <div class="col-lg-3">
                   <label for="cars">Type:</label>
                  <select id="type" name="userstype" class="form-control">
                    <option value="Candidate">Candidate</option>
                    <option value="User">User</option>
                  </select>
                </div>

    </div><br>


     <div class="row">
                <div class="col-lg-3">
                    <label> Reffer By</label>
                    <input type="text"  name="reffer_by"  id="reffer_by" class="form-control @error('reffer_by') is-invalid @enderror" value="{{ old('reffer_by') }}" >
                    @error('reffer_by')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
     </div><br>


<hr>
<!--------------------- Passport Start--------------------------->
<h4>Passport :</h4><br>
            <div class="row">
 
                <div class="col-lg-3">
                <label> Passport No </label>
                <input type="text"  name="passport_no"  id="passport_no"  class="form-control @error('passport_no') is-invalid @enderror" value="{{ old(' passport_no') }}"  >
                @error('passport_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
             
 
                <div class="col-lg-3">
                <label>Date of Issue</label>
                <input type="date"  name="issue"  id="date_issue" class="form-control @error('date_issue') is-invalid @enderror" value="{{ old('date_issue')  }}" >
                @error('date_issue')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

                <div class="col-lg-3">
                <label> Date of Expire</label>
                <input type="date"  name="expire"  id="date_expire"   class="form-control @error('date_expire') is-invalid @enderror" value="{{ old('date_expire')  }}"  >
                @error('date_expire')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-3">
                <label> Place of Issue</label>
                <input type="text"  name="place"  id="place_issue"  class="form-control @error('place_issue') is-invalid @enderror" value="{{ old(' place_issue') }}"  >
                @error('language')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>    

    </div><br>
<!--------------------- Passport End--------------------------->
<hr>



<!-- ------------------------------Education Start--------------------------- -->
<h4> Education :</h4>

<div class="panel panel-footer">
    <table class="table table-responsive table-bordered" id="dynamicAddRemove">
        <thead>
                <tr>
                    <th>Degree</th>
                    <th>Name of School/University</th>
                    <th>Course Name</th>
                    <th>Year Graduated</th>
                    <th>Board Rate (Ave)</th>
                                   

                     <th><a href="javascrip:" class="btn btn-sm btn-success addEducation"><i class="fa fa-plus"></i> </a></th>
                </tr>
        </thead>

        <tbody id="education">
            <tr>
                <td>
                     <select class="form-control valdation_select" name="education_type[]"   style="width:135px;">
                        <option value=''> -Select- </option>  
                        <option value='Grade6'> Grade 6</option>   
                        <option value='Grade10'> Grade 10</option>
                        <option value='Diploma'> Diploma</option>  
                        <option value='Degree' > Degree </option> 
                        <option value='Btech'>Btech </option>
                        <option value='ITI' >ITI </option>  
                        <option value='IIT'> IIT</option> 
                        <option value='Vocational'>Vocational </option> 
                        <option value='Pluse2'> Pluse 2</option>   
                          
                    </select>     
                </td>
                <td><input type="text" name="school_university_name[]" class="form-control" ></td>
                <td><input type="text" name="course_name[]" class="form-control" ></td>
                <td><input type="text" name="completed_year[]" class="form-control" ></td>
                <td><input type="text" name="board_rate[]" class="form-control" ></td>
                <td><a href="javascrip:" class="btn btn-sm btn-danger removeEducation disabled"><i class="fa fa-remove"></i></a></td>
            <tr>
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
<!-- ------------------------------Education End--------------------------- -->




<!-- ------------------------------Profesional APPLICANTS  Start--------------------------- -->

<h4> Professional Applicants:</h4>

<div class="panel panel-footer">
    <table class="table table-responsive table-bordered" id="dynamicAddRemove">
        <thead>
                <tr>
                    <th>Type Of License <span style="margin-left: 50px;">(PRC)<span></th>
                    <th>License NO.</th>
                    <th>Date of Issued </th>
                    <th>Place of Issued</th>
                    <th>Remarks</th>
                    <th><a href="javascrip:" class="btn btn-sm btn-success addProfesional"><i class="fa fa-plus"></i> </a></th>
                </tr>
        </thead>

        <tbody id="profesional">
            <tr>
                <td><input type="text" name="type_of_licence[]" class="form-control" ></td>
                <td><input type="text" name="licence_no[]" class="form-control" ></td>
                <td><input type="date" name="date_issue[]" class="form-control" ></td>
                <td><input type="text" name="place_issue[]" class="form-control" ></td>
                <td><textarea type="text" name="remark[]" class="form-control" ></textarea></td>
                <td><a href="javascrip:" class="btn btn-sm btn-danger removeProfesional disabled"><i class="fa fa-remove"></i></a></td>
            <tr>
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
<!-- ------------------------------PROFESSIONAL APPLICANTS  End--------------------------- -->



<!-- ------------------------------Work Experience Summary Start--------------------------- -->

<h4>Experience Summary :</h4>

<div class="panel panel-footer">
    <table class="table table-responsive  table-bordered" id="dynamicAddRemove">
        <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Location(Country)</th>
                    <th>Designation (Position)</th>
                    <th>From (MM/YY)</th>
                    <th>To (MM/YY))</th>
                    <th>Type</th>
                    <th> Total Years</th>
                    <th><a href="javascip:" class="btn btn-sm btn-success addExperience"><i class="fa fa-plus"></i> </a></th>
                </tr>
        </thead>

        <tbody id="experience">
            <tr>
                <td><input type="text" name="company_name[]" class="form-control"  style="width:140px;"></td>
                <td><input type="text" name="location[]" class="form-control" ></td>
                <td><input type="text" name="designation[]" class="form-control"  style="width:135px;"></td>
                <td><input type="date" name="from_date[]" class="form-control" ></td>
                <td><input type="date" name="to_date[]" class="form-control" ></td>
                <td>
                    <select class="form-control valdation_select" name="type[]"  style="width:135px;" >
                        <option value=''> -Select- </option>  
                        <option value='Local' > Local</option>  
                        <option value='Abroad'> Abroad</option> 
                    </select>
                </td>
                <td><input type="text" name="totalyear[]" class="form-control" ></td>
                <td><a href="javascip:" class="btn btn-sm btn-danger removeExperience disabled"><i class="fa fa-remove"></i></a></td>
            <tr>
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
<!-- ------------------------------Work Experience End--------------------------- -->



<!-- ------------------------------Seminar/Training Details Start--------------------------- -->

<h4> Seminar/Training Details:</h4>

<div class="panel panel-footer">
    <table class="table table-responsive table-bordered" id="dynamicAddRemove">
        <thead>
                <tr>
                    <th>Course Title</th>
                    <th>Training Center </th>
                    <th>Seminar Held</th>
                    <th>Date Completed</th>
                    <th>Remarks</th>
                    <th><a href="javascip:" class="btn btn-sm btn-success addSeminar"><i class="fa fa-plus"></i> </a></th>
                </tr>
        </thead>

        <tbody id="seminar">
            <tr>
                <td><input type="text" name="course_title[]" class="form-control" ></td>
                <td><input type="text" name="training_center[]" class="form-control" ></td>
                <td><input type="text" name="seminar_held[]" class="form-control" ></td>
                <td><input type="date" name="completion_date[]" class="form-control" ></td>
                <td><textarea type="text" name="remark[]" class="form-control" ></textarea></td>
                <td><a href="javascip:" class="btn btn-sm btn-danger removeSeminar disabled"><i class="fa fa-remove"></i></a></td>
            <tr>
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
<!-- ------------------------------Seminar/Training Details End--------------------------- -->



<!-- ------------------------------Beneficiary Start--------------------------- -->


<h4> Beneficiary:</h4>

<div class="panel panel-footer">
    <table class="table table-responsive table-bordered" id="dynamicAddRemove">
        <thead>
                <tr>
                    <th>Beneficiary</th>
                    <th>First Name</th>
                    <th>Last Name </th>
                    <th>MI</th>
                    <th>Mobile No </th>
                    <th>Email </th>
                    <th>Birth Date</th>
                    <th>Address</th>
                    <th>Zipcode</th>
                    <th><a href="javascip:" class="btn btn-sm btn-success addBeneficiary"><i class="fa fa-plus"></i> </a></th>
                </tr>
        </thead>

        <tbody id="beneficiary">
            <tr>
                <td>  
                     <select class="form-control valdation_select" name="beneficiary_type[]"  style="width:135px;">
                       <option value=''> -Select- </option>  
                       <option value='BN' > Beneficiary Name </option>  
                       <option value='AB'> Alternative Beneficiary</option>   
                       <option value='CP' > Contact Person in case of Emergency </option>    
                     </select>      
                </td>
                <td><input type="text" name="beneficiary_name[]" class="form-control"  style="width:135px;"></td>
                <td><input type="text" name="beneficiary_family_name[]" class="form-control"  style="width:135px;"></td>
                <td><input type="text" name="beneficiary_mi[]" class="form-control"  style="width:135px;"></td>
                <td><input type="text" name="phone_no[]" class="form-control"  style="width:135px;"></td>
                <td><input type="email" name="email_address[]" class="form-control"  style="width:135px;"></td>
                <td><input type="date" name="beneficiary_birth_date[]" class="form-control"  style=""></td>
                <td><textarea type="text" name="beneficiary_address[]" class="form-control"  style="width:135px;"></textarea></td>
                <td><input type="text" name="beneficiary_zip[]" class="form-control"  style="width:135px;"></td>

                <td><a href="javascip:" class="btn btn-sm btn-danger removeBeneficiary disabled"><i class="fa fa-remove"></i></a></td>
            <tr>
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
<!-- ------------------------------Beneficiary End--------------------------- -->


<!-- ------------------------------Dependents Start--------------------------- -->

<h4> Dependents:</h4>

<div class="panel panel-footer">
    <table class="table  table-responsive table-bordered" id="dynamicAddRemove">
        <thead>
                <tr>
                    <th>Dependents</th>
                    <th>First Name</th>
                    <th>Last Name </th>
                    <th>MI</th>
                    <th>Mobile No </th>
                    <th>Email </th>
                    <th>Birth Date</th>
                    <th>Occupation </th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Emp</th>
                    <th><a href="javascip:" class="btn btn-sm btn-success addDependents"><i class="fa fa-plus"></i> </a></th>
                </tr>
        </thead>

        <tbody id="dependents">
            <tr>
                <td>   
                     <select class="form-control validation_select" name="dependent_relation[]"  style="width:135px;">
                         <option value> -Select- </option>  
                         <option value='Spouse' > Spouse </option>  
                         <option value='Father'> Father</option>   
                         <option value='Mother' > Mother </option>  
                         <option value='Children'> Children</option>   
                    </select>       
                 </td>
                <td><input type="text" name="first_name[]" class="form-control"  style="width:135px;"></td>
                <td><input type="text" name="family_name[]" class="form-control"  style="width:135px;"></td>
                <td><input type="text" name="dependent_mi[]" class="form-control"  style="width:135px;"></td>
                <td><input type="text" name="phone_no1[]" class="form-control"  style="width:135px;"></td>
                <td><input type="email" name="email_address1[]" class="form-control"  style="width:135px;"></td>
                <td><input type="date" name="birth_date[]" class="form-control"  style=""></td>
                <td><input type="text" name="occupation[]" class="form-control"  style="width:135px;"></td>
                <td><input type="text" name="genders[]" class="form-control"  style="width:135px;"></td>
                <td><input type="text" name="status[]" class="form-control"  style="width:135px;"></td>
                <td><input type="text" name="emp[]" class="form-control"  style="width:135px;"></td>             
                <td><a href="javascip:" class="btn btn-sm btn-danger removeDependents disabled"><i class="fa fa-remove"></i></a></td>
            <tr>
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
<!-- ------------------------------Dependents End--------------------------- -->



<!-- ------------------------------Documents Start--------------------------- -->

<h4> Documents:</h4>

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
                    <select class="form-control select2" name="document_title[]" id="document_title" >
                                <option value="">-select-</option>
                                @foreach ($document as $data)
                                <option value="{{ $data->document_type_id  }}">{{ $data->document_type_name }}</option>
                                @endforeach
                    </select>  
  
                 </td>
                <td width="50%"><input type="file" name="document_path[]" class="form-control" multiple=""></td>    
                <td><a href="javascip:" class="btn btn-sm btn-danger removeDocuments disabled"><i class="fa fa-remove"></i></a></td>
            <tr>
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
<!-- ------------------------------Documents End--------------------------- -->



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

//------------------calculate age
      function fnCalculateAge(){

     var getDtLive = document.getElementById("txtDOB").value;  
     console.log(getDtLive);
     
     var born_date = new Date(getDtLive);
      console.log(" birthDate"+ born_date);
     
     var diff_dt=Date.now() - born_date.getTime(); 
         
     var  ageDate = new Date(diff_dt); 
     var total_calc_member_age=   Math.abs(ageDate.getUTCFullYear() - 1970);
   //  alert(total_calc_member_age);
   document.getElementById('btnCalculate').value = total_calc_member_age;


}
//------------------calculate age




    $(document).ready(function(){

$('#branch_id').select2();
$('#citizenship').select2();



     $('#citizenship').change(function(){
  var countryID = $(this).val();  
  //alert(countryID);
  if(countryID){
    $.ajax({
      type:"GET",
      url:"{{url('getCountryCode')}}?citizenship="+countryID,
      success:function(res){  
      if(res){
        $("#countrycode").empty();
        $.each(res,function(key,value){
            // alert(key);
            // alert(value);
           $("#countrycode").val(value);
           $("#country_code").val(value);
        });
      
      }else{
        $("#countrycode").empty();
      }
      }
    });
  }else{
    $("#countrycode").empty();
  }   
  });


// --------------------------Education Start-------------------
  $('.addEducation').on('click',function(){
    addEducations();
  });

  function addEducations(){
    var tr='<tr>'+
        '<td>'+
                 '<select class="form-control" name="education_type[]" required="">'+
                        '<option value>-Select-</option>'+
                        '<option value="Grade6"> Grade 6</option>'+   
                        '<option value="Grade10"> Grade 10</option>'+ 
                        '<option value="Diploma"> Diploma</option>'+
                        '<option value="Degree"> Degree </option>'+ 
                        '<option value="Btech">Btech </option>'+
                        '<option value="ITI" >ITI </option>'+  
                        '<option value="IIT"> IIT</option>'+ 
                        '<option value="Vocational">Vocational </option>'+ 
                        '<option value="Pluse2"> Pluse 2</option>'+   
                 '</select>'+
        '</td>'+
    '<td><input type="text" name="school_university_name[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="course_name[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="completed_year[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="board_rate[]" class="form-control" required=""></td>'+
    '<td><a href="javascrip:" class="btn btn-sm btn-danger removeEducation"><i class="fa fa-remove"></i></a></td>'
    '<tr>';
    $('#education').append(tr);
  };

  $('.removeEducation').live('click',function () {
      var last= $('tbody tr').length;
        // alert(last);
      if(last==12){
        alert('You can not remove last row');
      }
      else{
        $(this).parent().parent().remove();
        // alert('yes');
      }
  });
// --------------------------Education End-------------------


// --------------------------Profesional Start-------------------
  $('.addProfesional').on('click',function(){
    addProfesional();
  });

  function addProfesional(){
    var tr='<tr>'+
    '<td><input type="text" name="type_of_licence[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="licence_no[]" class="form-control" required=""></td>'+
    '<td><input type="date" name="date_issue[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="place_issue[]" class="form-control" required=""</td>'+
    '<td><textarea type="text" name="remark[]" class="form-control" required=""></textarea></td>'+
    '<td><a href="javascrip:" class="btn btn-sm btn-danger removeProfesional"><i class="fa fa-remove"></i></a></td>'
    '<tr>';
    $('#profesional').append(tr);
  };

  $('.removeProfesional').live('click',function () {
      //var last= $('tbody tr').length;
    //alert(last);
      // if(last==12){
      //   alert('You can not remove last row');
      // }
      // else{
        $(this).parent().parent().remove();
        //alert('yes');
     // }
  });
// --------------------------Profesional End-------------------


// --------------------------Experience Start-------------------
  $('.addExperience').on('click',function(){
    addExperience();
  });

  function addExperience(){
    var tr='<tr>'+
    '<td><input type="text" name="company_name[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="location[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="designation[]" class="form-control" required=""></td>'+
    '<td><input type="date" name="from_date[]" class="form-control" required=""</td>'+
    '<td><input type="date" name="to_date[]" class="form-control" required=""></td>'+
     '<td>'+
                 '<select class="form-control" name="type[]" required>'+
                 '<option value>-Select-</option>'+
                 '<option value="Local">Local </option>'+
                 '<option value="Abroad">Abroad</option>'+
                 '</select>'+
    '</td>'+
    '<td><input type="text" name="totalyear[]" class="form-control" required=""></td>'+
    '<td><a href="javascrip:" class="btn btn-sm btn-danger removeExperience"><i class="fa fa-remove"></i></a></td>'
    '<tr>';
    $('#experience').append(tr);
  };

  $('.removeExperience').live('click',function () {
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
// --------------------------Experience End-------------------


// --------------------------Seminar Start-------------------
  $('.addSeminar').on('click',function(){
    addSeminar();
  });

  function addSeminar(){
    var tr='<tr>'+
    '<td><input type="text" name="course_title[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="training_center[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="seminar_held[]" class="form-control" required=""></td>'+
    '<td><input type="date" name="completion_date[]" class="form-control" required=""</td>'+
    '<td><textarea type="text" name="remark[]" class="form-control" required=""></textarea></td>'+
    '<td><a href="javascrip:" class="btn btn-sm btn-danger removeSeminar"><i class="fa fa-remove"></i></a></td>'
    '<tr>';
    $('#seminar').append(tr);
  };

  $('.removeSeminar').live('click',function () {
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
// --------------------------Seminar End-------------------


// --------------------------Beneficiary Start-------------------
  $('.addBeneficiary').on('click',function(){
    addBeneficiary();
  });

  function addBeneficiary(){
    var tr='<tr>'+
    '<td>'+
                 '<select class="form-control" name="beneficiary_type[]" required >'+
                 '<option value>-Select-</option>'+
                 '<option value="BN" > Beneficiary Name </option>'+
                 '<option value="AB"> Alternative Beneficiary</option>'+
                 '<option value="CP"> Contact Person in case of Emergency </option>'+    
                 '</select>'+
    '</td>'+
    '<td><input type="text" name="beneficiary_name[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="beneficiary_family_name[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="beneficiary_mi[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="phone_no[]" class="form-control" required=""></td>'+
    '<td><input type="email" name="email_address[]" class="form-control" required=""></td>'+
    '<td><input type="date" name="beneficiary_birth_date[]" class="form-control" required=""</td>'+
    '<td><textarea type="text" name="beneficiary_address[]" class="form-control" required=""></textarea></td>'+
    '<td><input type="number" name="beneficiary_zip[]" class="form-control" required=""</td>'+
    '<td><a href="javascrip:" class="btn btn-sm btn-danger removeBeneficiary"><i class="fa fa-remove"></i></a></td>'
    '<tr>';
    $('#beneficiary').append(tr);
  };

  $('.removeBeneficiary').live('click',function () {
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
// --------------------------Beneficiary End-------------------


// --------------------------Dependents Start-------------------
  $('.addDependents').on('click',function(){
    addDependents();
  });

  function addDependents(){
    var tr='<tr>'+
    '<td>'+
                 '<select class="form-control" name="dependent_relation[]" required>'+
                 '<option value >-Select-</option>'+
                 '<option value="Spouse"> Spouse </option>'+
                 '<option value="Father"> Father</option>'+
                 '<option value="Mother"> Mother </option>'+    
                 '<option value="Children">Children</option>'+
                 '</select>'+
    '</td>'+
    '<td><input type="text" name="first_name[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="family_name[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="dependent_mi[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="phone_no1[]" class="form-control" required=""></td>'+
    '<td><input type="email" name="email_address1[]" class="form-control" required=""></td>'+
    '<td><input type="date" name="birth_date[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="occupation[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="genders[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="status[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="emp[]" class="form-control" required=""></td>'+
    '<td><a href="javascrip:" class="btn btn-sm btn-danger removeDependents"><i class="fa fa-remove"></i></a></td>'
    '<tr>';
    $('#dependents').append(tr);
  };

  $('.removeDependents').live('click',function () {
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
// --------------------------Dependents End-------------------


// --------------------------Documents Start-------------------
  $('.addDocuments').on('click',function(){
    addDocuments();
  });

  function addDocuments(){
    var tr='<tr>'+
    '<td width="50%"><select class="form-control select2" name="document_title[]" id="document_title" required><option value="">-select-</option>@foreach ($document as $data)<option value="{{ $data->document_type_id  }}">{{ $data->document_type_name }}</option>@endforeach</select></td>'+
    '<td width="50%"><input type="file" name="document_path[]" class="form-control" multiple=""></td>'+
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
  });
// --------------------------Documents End-------------------

</script> 
@stop
