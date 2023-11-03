@extends('layouts.admin')

@section('title')
Create Call type
@endsection

@section('content')

<!-- Modal Call Status Start -->
<div class="modal fade" id="call" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Add Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form method="POST"   action="">
           {{ csrf_field() }}   
              @csrf
            @method('POST')   
                    <div class="modal-body">

<?php
    $calltypes = DB::table('call_type')->get();
    if(!empty($_GET)){
      $client_id=$_GET['client_id'];
      $enquiry_id=$_GET['enquiry_id'];
      $job_id=$_GET['job_id'];
    }else{
      $client_id="";
      $enquiry_id="";
      $job_id="";
    }
?>

                               <input type="text" name="" value="{{($client_id)}}">
                               <input type="text" name="" value="{{($enquiry_id)}}">
                               <input type="text" name="" value="{{($job_id)}}">
                               <input type="text" name="" value="{{($candidate->candidate_id)}}">
                            
                               <label> Call Type  </label>
                                <select class="form-control select2" name="call_type_id" id="call_type_id" required>
                                <option value="">-Select-</option>
                                @foreach ($calltypes as $calltype)
                                    <option value="{{ $calltype->call_type_id }}">{{ $calltype->call_type }}</option>
                                 @endforeach
                              </select>   
                              <br>

                              <label> Remark  </label>
                              <input type="text" name="remark"  id="remark" class="form-control" value="{{ old('remark') }}" required >
                              <br>

                               <label> Created Date  </label>
                              <input type="date" name="created_date"  id="created_date" class="form-control" value="{{ old('created_date') }}" required>
                              <br>
                         
                    </div>
                   <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                  </div>
    </form>
    </div>
  </div>
</div>    
<!-- Modal Call Status Close -->     

@stop
