@extends('layouts.admin')

@section('title')
Update Assessment
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Assessment</h3>
        <div class="card-tools">
                <a href="{{ route('assessment.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
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

    <form method="POST" action="{{ route('assessment.update',$assessment->assessment_id) }}">
        @csrf
         @method('PUT')
          <div class="card-body">
            <div class="form-group">
                 


        <div class="row">
                <div class="col-lg-4">
               <label class="control-label" for="inputEmail3">  Assessment Type</label>
                                         <select class="form-control valdation_select" name="assessment_type" required>
                   <option value=''> Select </option>           
                
                 <option value='Post' <?=isset($assessment->assessment_type) && $assessment->assessment_type ==  'Post' ? 'selected':""?> > Pre </option>
             <!--     <option value='2'  <?=isset($assessment->assessment_type) && $assessment->assessment_type == '2' ? 'selected':""?> > Post </option>    -->
           </select>                 
                </div>

                <div class="col-lg-4">
                 <label>Candidate</label>
                     <select class="form-control select2" name="candidate_id" id="candidate_id" required>
                              <option value="">-select-</option>
                              @foreach ($personal as $data)                               
                               <option value="{{ $data->candidate_id }}" {{ $data->candidate_id == $assessment->candidate_id ?  'selected' : '' }}>{{$data->name}}</option>
                              @endforeach
                     </select>  
                </div>

                 <div class="col-lg-4">
               <label>Enquiry</label>
                     <select class="form-control select2" name="enquiry_id" id="enquiry_id" required>
                              <option value="">-select-</option>
                              @foreach ($enquiry as $data)
                                <option value="{{ $data->enquiry_id }}" {{ $data->enquiry_id == $assessment->enquiry_id ?  'selected' : '' }}>{{$data->enquiry_title}}</option>
                              @endforeach
                     </select>  
                </div>
     </div><br>


 
       <div class="row">
                
                <div class="col-lg-4">
                 <label>Job Category  </label>
                     <select class="form-control select2" name="job_id" id="job_id" required>
                              <option value="">-select-</option>
                              @foreach ($result as $data)
                                <option value="{{ $data->category_id }}" {{ $data->category_id == $assessment->job_id ?  'selected' : '' }}>{{$data->category_name}}</option>
                              @endforeach
                     </select>  
                </div>

           
                 <div class="col-lg-4">
                <label>Branch</label>
                     <select class="form-control select2" name="branch_id" id="branch_id" required>
                              <option value="">-select-</option>
                              @foreach ($branch as $data)
                               <option value="{{ $data->branch_id }}" {{ $data->branch_id == $assessment->branch_id ?  'selected' : '' }}>{{$data->branch_name}}</option>
                              @endforeach
                     </select>  
                </div>

             
     </div> <br>


     <div class="row">

                <div class="col-lg-4">
                <label> Personality appearence</label>
                <input type="text"  name="personality_appearence"  id="personality_appearence" class="form-control @error('personality_appearence') is-invalid @enderror" value="{{ $assessment->personality_appearence }}" required>
                @error('personality_appearence')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

                <div class="col-lg-4">
                <label> Personality remark</label>
                <textarea type="text"  name="personality_remark"  id="personality_remark" class="form-control @error('personality_remark') is-invalid @enderror" value="" required >{{ $assessment->personality_remark }}</textarea>
                @error('personality_remark')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="col-lg-4">
                <label> Knowledge</label>
                <input type="text"  name="knowledge"  id="knowledge" class="form-control @error('knowledge ') is-invalid @enderror" value="{{ $assessment->knowledge }}" required >
                @error('knowledge ')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

    </div><br>



        <div class="row">
                <div class="col-lg-4">
                <label> Knowledge remark</label>
                <textarea type="text"  name="knowledge_remark"  id="knowledge_remark" class="form-control @error('knowledge_remark') is-invalid @enderror" value="" required >{{ $assessment->knowledge_remark  }}</textarea>
                @error('knowledge_remark')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                 <div class="col-lg-4">
                <label> Ledership</label>
                <input type="text"  name="ledership"  id="ledership"   class="form-control @error('ledership') is-invalid @enderror" value="{{ $assessment->ledership }}" required >
                @error('ledership')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label> Leadership remark </label>
                <textarea type="text"  name="leadership_remark"  id="leadership_remark"  class="form-control @error('leadership_remark') is-invalid @enderror" value="" required >{{ $assessment->leadership_remark }}</textarea>
                @error('leadership_remark')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

      </div><br>



  


     <div class="row">

                <div class="col-lg-4">
                <label>Communication </label>
                <input type="text"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror" value="{{ $assessment->communication}}" required >
                @error('communication')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>

                <div class="col-lg-4">
                <label> Communication remark</label>
                <textarea type="text"  name="communication_remark"  id="communication_remark"   class="form-control @error('communication_remark') is-invalid @enderror" value="" required >{{ $assessment->communication_remark }}</textarea>
                @error('communication_remark')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                 <div class="col-lg-4">
                <label> Other assessment </label>
                <input type="text"  name="other_assessment"  id="other_assessment"  class="form-control @error('  other_assessment') is-invalid @enderror" value="{{ $assessment->other_assessment }}" required >
                @error('language')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

    </div><br>



      <div class="row">

                  <div class="col-lg-4">
                <label> Other assessment remark </label>
                <textarea type="text"  name="other_assessment_remark"  id="other_assessment_remark" class="form-control @error('   other_assessment_remark') is-invalid @enderror" value="" required >{{ $assessment->other_assessment_remark }}</textarea>
                @error('other_skill')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>
 
                <div class="col-lg-4">
                <label> Degree Optain</label>
                <input type="text"  name="degree_optain"  id="degree_optain"   class="form-control @error('degree_optain') is-invalid @enderror" value="{{$assessment->degree_optain }}" required >
                @error('age')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label> Professional Licence no </label>
                <input type="text"  name="professional_licence_no"  id="professional_licence_no"  class="form-control @error('professional_licence_no') is-invalid @enderror" value="{{ $assessment-> professional_licence_no}}" required >
                @error('professional_licence_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>  
    </div><br>
    


    <div class="row">

                <div class="col-lg-4">
                <label>Technical qualification</label>
                <input type="text"  name="technical_qualification"  id="technical_qualification"  class="form-control @error('technical_qualification') is-invalid @enderror" value="{{ $assessment->technical_qualification }}" required >
                @error('technical_qualification')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>  

                 <div class="col-lg-4">
                <label> Key skill </label>
                <input type="text"  name="key_skill"  id="key_skill"  class="form-control @error('key_skill') is-invalid @enderror" value="{{ $assessment->key_skill }}" required >
                @error('key_skill')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>  

                  <div class="col-lg-4">
                <label> Trade test</label>
                <input type="text"  name="trade_test"  id="trade_test"  class="form-control @error('trade_test') is-invalid @enderror" value="{{$assessment->trade_test }}" required >
                @error('trade_test')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
        
    </div><br>




         <div class="row">

                <div class="col-lg-4">
                <label> Languge used </label>
                <input type="text"  name="languge_used"  id="languge_used" class="form-control @error('languge_used') is-invalid @enderror" value="{{$assessment->languge_used }}" required >
                @error('languge_used')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>  

                 <div class="col-lg-4">
                <label>Local work experience</label>
                <input type="text"  name="local_work_experience"  id="local_work_experience"  class="form-control @error('local_work_experience') is-invalid @enderror" value="{{$assessment->local_work_experience}}" required >
                @error('local_work_experience')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>  

                 <div class="col-lg-4">
                <label> Local experience year </label>
                <input type="text"  name="local_experience_year"  id="local_experience_year"  class="form-control @error('local_experience_year') is-invalid @enderror" value="{{$assessment-> local_experience_year }}" required >
                @error('key_skill')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>  

    </div><br>



  <div class="row">
 

                 <div class="col-lg-4">
                <label> Overseas expereicne</label>
                <input type="text"  name="overseas_expereicne"  id="overseas_expereicne"  class="form-control @error('overseas_expereicne') is-invalid @enderror" value="{{ $assessment->overseas_expereicne  }}" required >
                @error('overseas_expereicne')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="col-lg-4">
                <label> Overseaase year</label>
                <input type="text"  name="overseaase_year"  id="overseaase_year"  class="form-control @error('overseaase_year') is-invalid @enderror" value="{{ $assessment->overseaase_year  }}" required >
                @error('overseaase_year')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label> Overall assessment</label>
                <input type="text"  name="overall_assessment"  id="overall_assessment" class="form-control @error('overall_assessment') is-invalid @enderror" value="{{$assessment->overall_assessment}}" required >
                @error('languge_used')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>  

               

 </div><br>



      <div class="row">


            <div class="col-lg-4">
                <label> Overall rating</label>
                <input type="text"  name="overall_rating"  id="overall_rating"  class="form-control @error('  overall_rating') is-invalid @enderror" value="{{$assessment->overall_rating}}" required >
                @error('overall_rating')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>  


              <div class="col-lg-4">
                <label> Remark </label>
                <textarea type="text"  name="remark"  id="remark"  class="form-control @error('remark') is-invalid @enderror" value="" required >{{$assessment->remark }}</textarea>
                @error('remark')
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
