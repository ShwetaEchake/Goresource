@extends('layouts.admin')

@section('title')
Update projectlocation
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit</h3>
        <div class="card-tools">
                <a href="{{ route('projectlocation.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
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

    <form method="POST" action="{{ route('projectlocation.update',$projectlocation->enquiy_project_location_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                 


      
        <div class="row">

               <div class="col-lg-6">
                    <label>Enquiry</label>
                     <select class="form-control select2" name="enquiry_id" id="enquiry_id" required>
                              <option value="">-select-</option>
                              @foreach ($enquiry as $data)
                                <option value="{{ $data->enquiry_id }}" {{ $data->enquiry_id == $projectlocation->enquiry_id ?  'selected' : '' }}>{{$data->enquiry_title}}</option>
                              @endforeach
                     </select>  
                </div>

              <div class="col-lg-6">
                    <label>Location</label>
                     <select class="form-control select2" name="location_id" id="location_id " required>
                              <option value="">-select-</option>
                              @foreach ($location as $data)
                                 <option value="{{ $data->location_id }}" {{ $data->location_id == $projectlocation->location_id ?  'selected' : '' }}>{{$data->location_name}}</option>
                              @endforeach
                     </select>  
                </div>
               
     </div><br>


 
       <div class="row">
                  

                 <div class="col-lg-6">
                <label>job_id </label>
                <input type="text" name="job_id"  id="job_id" class="form-control @error('job_id') is-invalid @enderror" value="{{$projectlocation->job_id  }}" required >
                @error('job_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                  <div class="col-lg-6">
                <label>Required Position </label>
                <input type="text" name="required_position"  id="required_position" class="form-control @error('required_position') is-invalid @enderror" value="{{ $projectlocation->required_position }}" required >
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
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update </button>
        </div>
       
        

       
    </form>
</div>
@endsection

@section('js')


@stop