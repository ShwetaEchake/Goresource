@extends('layouts.admin')

@section('title')
Update Enrollment
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Enrollment</h3>
        <div class="card-tools">
                <a href="{{ route('enrollment.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
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

    <form method="POST" action="{{ route('enrollment.update',$enrollment->enrollment_id) }}">
        @csrf
         @method('PUT')
          <div class="card-body">
            <div class="form-group">
                 


       <div class="row">
                <div class="col-lg-6">
                   <label>Assessment Type</label>
                     <select class="form-control select2" name="assessment_id" id="assessment_id" required>
                              <option value="">-select-</option>
                              @foreach ($assessment as $data)
                                  <option value="{{ $data->assessment_id }}" {{ $data->assessment_id == $enrollment->assessment_id ?  'selected' : '' }}>{{$data->assessment_type}}</option>
                              @endforeach
                     </select>  
                </div>

                <div class="col-lg-6">
                 <label> Candidate </label>
                    <select class="form-control select2" name="candidate_id" id="candidate_id" required>
                              <option value="">-select-</option>
                              @foreach ($personal as $data)
                              <option value="{{ $data->candidate_id }}" {{ $data->candidate_id == $enrollment->candidate_id ?  'selected' : '' }}>{{$data->name}}</option>
                              @endforeach
                     </select>  
                </div>

               
     </div><br>


 
       <div class="row">
                <div class="col-lg-6">
                 <label> Interview</label>
                     <select class="form-control select2" name="interview_id" id="interview_id" required>
                              <option value="">-select-</option>
                              @foreach ($interview as $data)
                               <option value="{{ $data->interview_id }}" {{ $data->interview_id == $enrollment->interview_id ?  'selected' : '' }}>{{$data->interview_venu}}</option>
                              @endforeach
                     </select>  
                </div>

                <div class="col-lg-6">
                  <label>Branch </label>
                     <select class="form-control select2" name="branch_id" id="branch_id" required>
                              <option value="">-select-</option>
                              @foreach ($branch as $data)
                               <option value="{{ $data->branch_id }}" {{ $data->branch_id == $enrollment->branch_id ?  'selected' : '' }}>{{$data->branch_name}}</option>
                              @endforeach
                     </select>  
                </div>     
             
     </div> <br>








             </div>
            </div>




        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update </button>
        </div>
       

       
    </form>
</div>
@endsection
