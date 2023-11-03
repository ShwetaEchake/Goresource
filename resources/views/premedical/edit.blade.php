@extends('layouts.admin')

@section('title')
Update Pre Medical
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Pre Medical </h3>
        <div class="card-tools">
                <a href="{{ route('premedical.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>
    <form method="POST" action="{{ route('premedical.update',$premedical->premedical_id) }}" enctype="multipart/form-data">
        @csrf
         @method('PUT')
        <div class="card-body">
            <div class="form-group">
                 



      <div class="row">
                 <div class="col-lg-4">
                <label>Company Name</label>
                <select class="form-control select2" name="client_id" id="client_id" required>
                              <option value="">-Select-</option>
                              @foreach ($client as $data)
                               <option value="{{ $data->client_id }}" {{ $data->client_id == $premedical->client_id ?  'selected' : '' }}>{{$data->company_name}}</option>
                              @endforeach
                </select>  
               </div>


                 <div class="col-lg-4">
                  <?php $data=DB::table('enquiry')->where('enquiry_id',$premedical->enquiry_id)->first();?>
                <label>Enquiries</label>
                   <select name="enquiry_id" id="enquiry_id" class="form-control" required="">
                       <option value="{{ $data->enquiry_id }}" {{ $data->enquiry_id == $premedical->enquiry_id ?  'selected' : '' }}>{{$data->enquiry_title}}</option>
                   </select>
                </div>


                  <div class="col-lg-4">
                   <?php $name=DB::table('jobs')->where('job_id',$premedical->job_id)
                          ->leftjoin('categories', 'jobs.job_main_category_id', '=', 'categories.category_id')->first();
                   ?>
                   <label>Job</label>
                   <select name="job_id" id="job_id" class="form-control" required="">
                   <option value="{{ $name->job_id }}"{{ $name->job_id == $premedical->job_id ?  'selected' : '' }}>{{$name->category_name}}</option>
                   </select>
                 </div>

       </div><br>



        <div class="row">
               
                <div class="col-lg-4">
                    <label>Candidate</label>
                      <select class="form-control select2" name="candidate_id" id="candidate_id" required>
                              <option value="">-Select-</option>
                              @foreach ($personal as $data)
                                  <option value="{{ $data->candidate_id }}" {{ $data->candidate_id == $premedical->candidate_id ?  'selected' : '' }}>{{$data->name}}</option>
                              @endforeach
                     </select>  
                </div>

                  <div class="col-lg-4">
                <label>Remark </label>
                <textarea type="text" name="remark"  id="remark" class="form-control @error('remark') is-invalid @enderror" value="" required >{{ $premedical->remark }}   </textarea>
                @error('remark')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

     </div> <br>


        <div class="row">
              
                <div class="col-lg-4">
                <label>Fit Date </label>
                <input type="date" name="fit_date"  id="fit_date" class="form-control @error('fit_date') is-invalid @enderror" value="{{ (date('Y-m-d',$premedical->fit_date)) }}"   required >
                @error('fit_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                  <div class="col-lg-4">
                <label>Unfit Date </label>
                <input type="date" name="unfit_date"  id=" unfit_date" class="form-control @error('unfit_date') is-invalid @enderror" value="{{ (date('Y-m-d',$premedical->unfit_date))  }}" required >
                @error('unfit_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

     </div> <br>




 <div class="row">
              <?php $candidatePath=DB::table('candidate_documents')->where('candidate_id',$premedical->candidate_id)->select('folder_path')->first();
              ?>
  

                <div class="col-lg-4">
                <label> Attached Document 1 </label>

                    @if(!empty($premedical->attached_document1))
                 <a href="{{asset('documents/Candidate/' .$candidatePath->folder_path.'/'.$premedical->attached_document1)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                    @endif

                <input type="file" name="attached_document1"  id="  attached_document1" class=" @error('attached_document1') is-invalid @enderror" value="{{ $premedical->attached_document1  }}"   >
                @error('attached_document1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                 <div class="col-lg-4">
                <label> Attached Document 2 </label>

                     @if(!empty($premedical->attached_document2))
                 <a href="{{asset('documents/Candidate/' .$candidatePath->folder_path.'/'.$premedical->attached_document2)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                    @endif

                <input type="file" name="attached_document2"  id="attached_document2" class=" @error('  attached_document2') is-invalid @enderror" value="{{ $premedical->attached_document2  }}"   >
                @error('attached_document2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                   <div class="col-lg-4">
                <label> Attached Document 3 </label>
                    @if(!empty($premedical->attached_document3))
                 <a href="{{asset('documents/Candidate/' .$candidatePath->folder_path.'/'.$premedical->attached_document3)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                    @endif

                <input type="file" name="attached_document3"  id="attached_document3" class=" @error('  attached_document3') is-invalid @enderror" value="{{ $premedical->attached_document3  }}"   >
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
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update </button>
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
      url:"{{url('getEnquiryPre')}}?client_id="+clientID,
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
      url:"{{url('getJobPre')}}?enquiry_id="+enquiryID,
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