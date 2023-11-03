@extends('layouts.admin')

@section('title')
Create selection
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New</h3>
        <div class="card-tools">
                <a href="{{ route('selection.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>
    <form method="POST" action="{{ route('selection.store') }}"  enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                 


        <div class="row">
          
              <div class="col-lg-4">
                  <label>Company Name</label>
                  <select class="form-control select2" name="client_id" id="client_id" required>
                      <option value="">-Select-</option>
                      @foreach ($client as $data)
                      <option value="{{ $data->client_id }}">{{ $data->company_name }}</option>
                      @endforeach
                  </select>  
              </div>

               <div class="col-lg-4">
                   <label>Enquiries</label>
                   <select name="enquiry_id" id="enquiry_id" class="form-control" required=""></select>
               </div>

               <div class="col-lg-4">
                  <label>Job</label>
                 <select name="job_id" id="job_id" class="form-control" required=""></select>
              </div>

    </div><br>


 
       <div class="row">
               
                  <div class="col-lg-4">
                       <label>Candidate</label>
                       <select class="form-control select2" name="candidate_id" id="candidate_id" required>
                          <option value="">-Select-</option>
                          @foreach ($personal as $data)
                          <option value="{{ $data->candidate_id }}">{{ $data->name }}</option>
                          @endforeach
                       </select>  
                  </div>

                  <div class="col-lg-4">
                <label>Remark </label>
                <textarea type="text" name="remark"  id="remark" class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark') }}" required ></textarea>
                @error('remark')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

     </div> <br>



 <div class="row">
              

                <div class="col-lg-4">
                <label> Attached Document 1 </label>
                <input type="file" name="attached_document1"  id="attached_document1" class=" @error('attached_document1') is-invalid @enderror" value="{{ old('attached_document1')  }}"  >
                @error('attached_document1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                 <div class="col-lg-4">
                <label> Attached Document 2 </label>
                <input type="file" name="attached_document2"  id="attached_document2" class=" @error('attached_document2') is-invalid @enderror" value="{{ old('attached_document2')  }}"  >
                @error('attached_document2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                   <div class="col-lg-4">
                <label> Attached Document 3 </label>
                <input type="file" name="attached_document3"  id="attached_document3" class=" @error('attached_document3') is-invalid @enderror" value="{{ old('attached_document3')  }}"  >
                @error('attached_document3')
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
<script type="text/javascript">
$(document).ready(function(){
    

     $('#client_id').change(function(){
  var clientID = $(this).val();  
  if(clientID){
    $.ajax({
      type:"GET",
      url:"{{url('getEnquirySelection')}}?client_id="+clientID,
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
    $("#job_id").empty();
   
  }   
  });




     $('#enquiry_id').change(function(){
  var enquiryID = $(this).val();  
  if(enquiryID){
    $.ajax({
      type:"GET",
      url:"{{url('getJobSelection')}}?enquiry_id="+enquiryID,
      success:function(res){  
      if(res){
        $("#job_id").empty();
        $("#job_id").append('<option>Select Enquiry</option>');
        $.each(res,function(key,value){
          $("#job_id").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#job_id").empty();
      }
      }
    });
  }else{
    $("#job_id").empty();
   
  }   
  });


});

</script>

@stop