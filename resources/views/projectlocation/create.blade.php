@extends('layouts.admin')

@section('title')
Create projectlocation
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New</h3>
        <div class="card-tools">
                <a href="{{ route('projectlocation.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>
    <form method="POST" action="{{ route('projectlocation.store') }}"  enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                 


        <div class="row">

               <div class="col-lg-6">
                    <label>Enquiry</label>
                     <select class="form-control select2" name="enquiry_id" id="enquiry_id" required>
                              <option value="">-select-</option>
                              @foreach ($enquiry as $data)
                              <option value="{{ $data->enquiry_id }}">{{ $data->enquiry_title }}</option>
                              @endforeach
                     </select>  
                </div>

              <div class="col-lg-6">
                    <label>Location</label>
                     <select class="form-control select2" name="location_id" id="location_id " required>
                              <option value="">-select-</option>
                              @foreach ($location as $data)
                              <option value="{{ $data->location_id  }}">{{ $data->location_name }}</option>
                              @endforeach
                     </select>  
                </div>
               
     </div><br>


 
       <div class="row">
                  

                 <div class="col-lg-6">
                <label>job_id </label>
                <input type="text" name="job_id"  id="job_id" class="form-control @error('job_id') is-invalid @enderror" value="{{ old('job_id') }}" required >
                @error('job_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                  <div class="col-lg-6">
                <label>Required Position </label>
                <input type="text" name="required_position"  id="required_position" class="form-control @error('required_position') is-invalid @enderror" value="{{ old('required_position') }}" required >
                @error('required_position')
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


@stop