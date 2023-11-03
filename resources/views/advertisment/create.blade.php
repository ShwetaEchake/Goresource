@extends('layouts.admin')

@section('title')
Create Advertisment
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New</h3>
        <div class="card-tools">
                <a href="{{ route('advertisment.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>
    <form method="POST" action="{{ route('advertisment.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                 


          <div class="row">

               
                <div class="col-lg-2">
                   <input type="hidden" name="enquiry_id" value="<?php echo $_GET['enquiryid'] ?>">
                </div>   

               <div class="col-lg-2">    
                   <input type="hidden" name="client_id" value="<?php echo $_GET['clientid'] ?>">
               </div> 

         {{--  <div class="col-lg-2">   
                 <input type="hidden" name="job_id" value="<?php echo $_GET['jobid'] ?>">
               </div> 

               <div class="col-lg-2">   
                 <input type="hidden" name="branch_id" value="<?php echo $_GET['branchid'] ?>">
               </div> --}}
             

                
    </div><br>


 
       <div class="row">
                
                

              <!--   <div class="col-lg-4">
                   <label>Branch</label>
                     <select class="form-control select2" name="branch_id" id="branch_id" required>
                                  <option value="">-Select-</option>
                                  @foreach ($branch as $data)
                                  <option value="{{ $data->branch_id }}">{{ $data->branch_name }}</option>
                                  @endforeach
                     </select>  
                 </div> -->

                <div class="col-lg-4">
                <label>Adv Date </label>
                <input type="date" name="adv_date"  id="adv_date" class="form-control @error('adv_date') is-invalid @enderror" value="{{ old('adv_date')  }}" required >
                @error('adv_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                 <div class="col-lg-4">
                <label> Adv Publish Date  </label>
                <input type="date" name="adv_publish_date"  id="adv_publish_date" class="form-control @error('adv_publish_date') is-invalid @enderror" value="{{ old('adv_publish_date')  }}"  required >
                @error('adv_publish_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

             
     </div> <br>


     <div class="row">

                <div class="col-lg-4">
                <label>Adv Cost</label>
                <input type="text"  name="adv_cost"  id="adv_cost" class="form-control @error('adv_cost') is-invalid @enderror" value="{{ old('adv_cost')  }}" required>
                @error('adv_cost')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>


                <div class="col-lg-4">
                <label> Dtp cost</label>
                <input type="text"  name="dtp_cost"  id="dtp_cost" class="form-control @error('dtp_cost') is-invalid @enderror" value="{{ old('dtp_cost')  }}" required >
                @error('dtp_cost')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>



                <div class="col-lg-4">
                <label>Adv check recipt</label>
                <input type="text"  name="adv_check_recipt"  id="adv_check_recipt"  class="form-control @error('adv_check_recipt') is-invalid @enderror" value="{{ old('adv_check_recipt')  }}" required >
                @error('adv_check_recipt')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

              

    </div><br>



        <div class="row">

              <div class="col-lg-3">
                <label> Adv Cost check attachment </label>
                <input type="file"  name="adv_cost_check_attachment"  id="adv_cost_check_attachment" class=" @error('adv_cost_check_attachment') is-invalid @enderror" value="{{ old('adv_cost_check_attachment')  }}"  >
                @error('adv_cost_check_attachment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="col-lg-3">
                <label> Dtp cost check attachment</label>
                <input type="file"  name="dtp_cost_check_attachment"  id="dtp_cost_check_attachment" class=" @error('dtp_cost_check_attachment') is-invalid @enderror" value="{{ old('dtp_cost_check_attachment')  }}"  >
                @error('dtp_cost_check_attachment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

             

      </div><br>



  


     <div class="row">

                <div class="col-lg-3">
                <label> Adv media1</label>
                <input type="file"  name="adv_media1"  id="adv_media1"   class=" @error('adv_media1') is-invalid @enderror" value="{{ old('adv_media1')  }}" >
                @error('adv_media1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-3">
                <label> Adv media2</label>
                <input type="file"  name="adv_media2"  id="adv_media2"  class=" @error('adv_media2') is-invalid @enderror" value="{{ old(' adv_media2') }}" >
                @error('contact_person_mobile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="col-lg-4">
                <label>Adv media3 </label>
                <input type="file"  name="adv_media3"  id="adv_media3"  class=" @error('adv_media3') is-invalid @enderror" value="{{ old('adv_media3')  }}" >
                @error('adv_media3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 </div>


               
            

    </div><br>



             </div>
            </div>
             <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Create </button>
        </div>
       
        

       
    </form>
</div>
@endsection


@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script type="text/javascript">
$(document).ready(function(){


     $('#client_id').change(function(){
  var clientID = $(this).val();  
  if(clientID){
    $.ajax({
      type:"GET",
      url:"{{url('getEnquiryAdd')}}?client_id="+clientID,
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
      url:"{{url('getJobAdd')}}?enquiry_id="+enquiryID,
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