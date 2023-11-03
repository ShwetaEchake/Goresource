<?php
use App\Models\Personal;
use App\Models\Assessment;
use App\Models\Passport;

?>
@extends('layouts.admin')

@section('title')
Create Assesment
@endsection

@section('content')

<div class="card card-primary center">

    <div class="card-header">
        <h3 class="card-title">Add New</h3>
        <div class="card-tools">
                <a href="{{ route('personal.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>

    <CENTER><h1>ASSESMENT FORM</h1></CENTER>


<form method="POST" action="{{ route('assessment.store') }}" enctype="multipart/form-data">
        @csrf

<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%" >

<thead><tr>
          <th width="15">Rating</th>
          <th width="14">1</th>
          <th width="14">2</th>
          <th width="14">3</th>
          <th width="14">4</th>
          <th width="14">5</th>
          <th width="15">Remarks</th>
        </tr></thead>
          <tbody>
            <tr>
    <td>Personality Apperance/Attitude:</td>
    <td><input type="radio"   name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" value="INEFFECTIVE" ></td>
    <td><input type="radio"   name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" value="NEEDSIMPROVMENT" ></td>
    <td><input type="radio"   name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" value="GOOD" ></td>
    <td><input type="radio"   name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" value="VERYGOOD" ></td>
    <td><input type="radio"  name="personality_appearence"  id="personality_appearence"   class="form-control @error('personality_appearence') is-invalid @enderror" value="EXCELLENT" ></td>

    <td><input type="text"  name="personality_remark"  id="personality_remark"   class="form-control @error('personality_remark') is-invalid @enderror" value="{{ old('personality_remark')  }}" ></td>
     </tr>
     <tr>
      <td>Knowladge & Technical Skills:</td>
      <td><input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" value="INEFFECTIVE" ></td>
    <td><input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" value="NEEDSIMPROVMENT" ></td>
    <td><input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" value="GOOD" ></td>
    <td><input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" value="VERYGOOD" ></td>
    <td><input type="radio"  name="knowledge"  id="knowledge"   class="form-control @error('knowledge') is-invalid @enderror" value="EXCELLENT" ></td>
  
    <td><input type="text"  name="knowledge_remark"  id="knowledge_remark" class="form-control @error('knowledge_remark') is-invalid @enderror" value="{{ old('knowledge_remark')  }}" ></td>
     </tr>
    
      <tr>
      <td>Initiative & Leadership:</td>
         <td><input type="radio"  name="Ledership"  id="Ledership"  class="form-control @error('Ledership') is-invalid @enderror" value="INEFFECTIVE" ></td>
    <td><input type="radio"  name="Ledership"  id="Ledership"  class="form-control @error('Ledership') is-invalid @enderror" value="NEEDSIMPROVMENT" ></td>
    <td><input type="radio"  name="Ledership"  id="Ledership"  class="form-control @error('Ledership') is-invalid @enderror" value="GOOD" ></td>
    <td><input type="radio"  name="Ledership"  id="Ledership"  class="form-control @error('Ledership') is-invalid @enderror" value="VERYGOOD" ></td>
    <td><input type="radio"  name="Ledership"  id="Ledership"  class="form-control @error('Ledership') is-invalid @enderror" value="EXCELLENT" ></td>

    <td><input type="text"  name="leadership_remark"  id="leadership_remark" class="form-control @error('leadership_remark') is-invalid @enderror" value="{{ old('leadership_remark')  }}" ></td>
     </tr>
    
      <tr>
      <td>English Communication</td>
    
        <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror" value="INEFFECTIVE" ></td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror" value="NEEDSIMPROVMENT" ></td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror" value="GOOD" ></td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror" value="VERYGOOD" ></td>
    <td><input type="radio"  name="communication"  id="communication"  class="form-control @error('communication') is-invalid @enderror" value="EXCELLENT" ></td>

    <td><input type="text"  name="communication_remark"  id="communication_remark" class="form-control @error('communication_remark') is-invalid @enderror" value="{{ old('communication_remark')  }}" ></td>
     </tr>
     <tr>
      <td>Others (Please Spacify)</td>
      
         <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="INEFFECTIVE" ></td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment" class="form-control @error('other_assessment') is-invalid @enderror" value="NEEDSIMPROVMENT" ></td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="GOOD" ></td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="VERYGOOD" ></td>
    <td><input type="radio"  name="other_assessment"  id="other_assessment"  class="form-control @error('other_assessment') is-invalid @enderror" value="EXCELLENT" ></td>


    <td><input type="text"  name="other_assessment_remark" id="other_assessment_remark"   class="form-control @error('other_assessment_remark') is-invalid @enderror" value="{{ old('other_assessment_remark')  }}" ></td>
     </tr>
</tbody>
</table>

<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">

<thead><tr><th colspan="7">Education</th></tr></thead>
<tbody>
<tr><td>DEGREE OBTAINED</td> <td colspan="6"><input type="text"  name="degree_optain"  id="degree_optain"   class="form-control @error('degree_optain') is-invalid @enderror" value="{{ old('degree_optain')  }}" ></td></tr>
 <tr><td>PROFFETIONAL LICENSE NO.</td><td colspan="6"><input type="text"  name="professional_licence_no"  id="professional_licence_no"  class="form-control @error('professional_licence_no') is-invalid @enderror" value="{{ old(' professional_licence_no') }}" ></td></tr>
  <tr><td>TECHNICAL QUALIFICATION</td><td colspan="6"><input type="text"  name="technical_qualification"  id="technical_qualification"  class="form-control @error('technical_qualification') is-invalid @enderror" value="{{ old(' technical_qualification') }}" ></td></tr>

  <tr><td>KEY SKILLS</td><td colspan="6"><input type="text"  name="key_skill"  id="key_skill"  class="form-control @error('key_skill') is-invalid @enderror" value="{{ old(' key_skill') }}" ></td></tr>
  <tr><td>TRADE TEST</td><td colspan="6"><input type="text"  name="trade_test"  id="trade_test"  class="form-control @error('trade_test') is-invalid @enderror" value="{{ old('trade_test')  }}" required ></td></tr>

</tbody>

</table>

<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">


<thead><tr><th>LANGVAGE USED</th> <th>English</th><th>Hindi</th><th  colspan="4">Others</th></tr></thead>
<tbody>
<tr><td>RATINFG</td> <td><select class="form-control valdation_select" name="languge_used[]">
                        <option value=''> -Select- </option>  
                        <option value='G' > Good </option>  
                        <option value='VG'> Very Good</option>   
                        <option value='EX' > Excellent </option>  
        </select></td>
        <td>
          <select class="form-control valdation_select" name="languge_used[]">
                        <option value=''> -Select- </option>  
                        <option value='G' > Good </option>  
                        <option value='VG'> Very Good</option>   
                        <option value='EX' > Excellent </option>  
        </select>
        </td><td colspan="4"><input type="text"  name="languge_used"  id="languge_used"  class="form-control @error('languge_used') is-invalid @enderror" value="{{ old(' languge_used') }}" ></td></tr>

</tbody>

</table>

<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">
<thead><tr><th colspan="7">WORK EXPERIANCE</th> </tr>
<tr><th></th> <th colspan="3">POSITION HELD</th><th colspan="3">TOTAL YEARS/MONTHS</th></tr></thead>
<tbody>
<tr><td>LOCAL</td> <td colspan="3"><input type="text"  name="local_work_experience"  id="local_work_experience"  class="form-control @error('local_work_experience') is-invalid @enderror" value="{{ old(' local_work_experience') }}" ></td>
  <td colspan="3"><input type="text"  name="local_experience_year"  id="local_experience_year"  class="form-control @error('local_experience_year') is-invalid @enderror" value="{{ old(' local_experience_year') }}" ></td></tr>

<tr><td>OVERSEAS</td> 
  <td colspan="3"><input type="text"  name="overseas_expereicne"  id="overseas_expereicne"  class="form-control @error('overseas_expereicne') is-invalid @enderror" value="{{ old(' overseas_expereicne') }}" ></td>
  <td colspan="3"><input type="text"  name="overseaase_year"  id="overseaase_year"  class="form-control @error('overseaase_year') is-invalid @enderror" value="{{ old(' overseaase_year') }}" ></td></tr>

</tbody>
</table>

<table id="dynamicAddRemove" class="table table-responsive table-bordered" width="50%">
<thead><tr><th colspan="7">
OVERALL ASSESSMENT</th></tr></thead>
<tbody>
<tr> <td><center><input type="radio" id="age1" name="overall_assessment" value="Selected">
  <label for="age1">Selected</label></center></td>
  <td><input type="radio" id="age1" name="overall_assessment" value="Reserved">
  <label for="age1">Reserved</label></td>
  <td><input type="radio" id="age1" name="overall_assessment" value="Rejected">
  <label for="age1">Rejected</label></td>
  <td> <input type="radio" id="age1" name="overall_assessment" value="Others">
  <label for="age1">Others</label></td>
  <td colspan="3">
     <label for="age1">Overall Rating%</label><input type="number" id="age1" name="overall_rating" class="form-control" value="">
 </td></tr>

</tbody>
</table>

<table id="dynamicAddRemove" class="table table-responsive">
<thead><tr><th colspan="7">Remarks</th></tr></thead>
<tbody>
  <tr><td colspan="7"><textarea type="text"  name="remark"  id="remark"  class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark') }}" ></textarea></td></tr>
</tbody>

<thead><tr><th colspan="7">
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Create </button></th></tr>
</thead>

</table>
</form>

</div>
@endsection

@section('js')


@stop








