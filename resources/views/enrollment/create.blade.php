@extends('layouts.admin')

@section('title')
Create Enrollment
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New</h3>
        <div class="card-tools">
                <a href="{{ route('enrollment.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>
    <form method="POST" action="{{ route('enrollment.store') }}" >
        @csrf
        <div class="card-body">
            <div class="form-group">
                 


        <div class="row">
                <div class="col-lg-6">
               
                 <label class="control-label" for="inputEmail3"> Assessment Type</label>
                 <select class="form-control valdation_select" name="assessment_id" required>
                 <option value='0'> Select </option>
                 <option value='1'> Pre </option>
                 <option value='2'> Post </option>                    
               </select>
                              
                </div>

                <div class="col-lg-6">
                <label> Candidate </label>
                  <select class="form-control select2" name="candidate_id" id="candidate_id" required>
                              <option value="">-select-</option>
                              @foreach ($personal as $data)
                              <option value="{{ $data->candidate_id }}">{{ $data->name }}</option>
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
                              <option value="{{ $data->interview_id }}">{{ $data->interview_venu }}</option>
                              @endforeach
                     </select>  
                </div>

                <div class="col-lg-6">
                <label>Branch </label>
                <select class="form-control select2" name="branch_id" id="branch_id" required>
                              <option value="">-select-</option>
                              @foreach ($branch as $data)
                              <option value="{{ $data->branch_id }}">{{ $data->branch_name }}</option>
                              @endforeach
                     </select>  
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


@stop