<?php
use App\Models\Enquiry;

?>
@extends('layouts.admin')

@section('title')
Enquiry Chceklist
@endsection


@section('content')
<section class="content">
    
    <div class="row">
        <div class="col-md-6">

        <div class="card card-primary ">
        <div class="card-body ">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-users mr-1"></i> Enquiry Checklist </h3>
   </div>
        <div class="card-body table-responsive p-0 ">
    

        <table class="table table-hover table-bordered">

            <thead>
                <tr>
                   
                    <th>Enquiry</th>
                    <!-- <th>Parent Enquiry Chceklist</th> -->
                    <th>Status</th>
                    <th>Action</th>
            
                </tr>
            </thead>
            <tbody>
                   @forelse ($enquirychecklists as $enquirychecklistt)
                    <tr>
                          <td> 
                         <?php $name = Enquiry::where(['enquiry_id'=>$enquirychecklistt->enquiry])->get();
                        
                         ?>
                             @foreach ($name as $data)
                                {{$data->enquiry_title}}
                            @endforeach
                         </td>
                          <td>
                            @if( $enquirychecklistt->status ==1)
                              <span class="badge badge-info">Active</span>
                            @else
                               <span class="badge badge-info">Deactive</span>
                            @endif
                            </td>
                        
                          
                        <td>
                          <a class="btn btn-flat btn-warning" href="{{ route('enquirychecklist.edit',$enquirychecklistt->checklist_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;

                             <form action="{{ route('enquirychecklist.destroy', $enquirychecklistt->checklist_id ) }}" method="POST" onclick="return confirm('Are you sure you want to delete this item?')" >
   
                                @csrf
                                @method('DELETE') 
                            <button type="submit" class="btn btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </form>

                        </td>
                    </tr>
                 @empty
                    <tr>
                        <td><i class="fas fa-folder-open"></i> No Record found </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
       
        </div>

        </div>
        </div>
        </div>

    <!-- /.card-body -->
    
       <div class="col-md-6">
            <div class="card">
                 <div class="card-header">
                    @if(isset($enquiryChecklist->checklist_id))

                        <h5> Edit </h5>
                         <a style="position: absolute;top: 10px;right: 10px;" href="{{ route('enquirychecklist.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
                     @else
                        <h5> Add New </h5>
                     @endif
                 </div>



                <div class="card-body">
                    @if(isset($enquiryChecklist->checklist_id))
                  
                  <form class="form-horizontal" method="POST" action="{{ route('enquirychecklist.update',$enquiryChecklist->checklist_id) }}">
                    @csrf
                    @method('PUT')
        
           @else
           <form class="form-horizontal" method="POST" action="{{ route('enquirychecklist.store') }}">
                    @csrf
           @endif

                        <div class="row">
                            <div class="col-md-12">

                        
                                 <div class="form-group">
                                  <label>Enquiry</label>
                                     <select class="form-control select2" name="enquiry" id="enquiry" required>
                                              <option value="">-select-</option>
                                              
                          @foreach($enquiry as $data)
                                                 @if(isset($enquiryChecklist->enquiry))
                                  <option value="{{ $data->enquiry_id }}" {{ $data->enquiry_id ==$enquiryChecklist->enquiry ?  'selected' : '' }}>{{$data->enquiry_title}}</option>
                                                 @else
                                                       <option value="{{$data->enquiry_id}}">{{$data->enquiry_title}}</option>
                                                  
                                                  @endif

                                     @endforeach

                                     </select>  
                                </div>


                                 <div>
                <label class="control-label" for="inputEmail3"> Status</label>
      <select class="form-control valdation_select" name="status" required>
<option value='0' <?=isset($enquiryChecklist->status) && $enquiryChecklist->status ==  '0' ? 'selected':""?> > Select </option>
 <option value='1' <?=isset($enquiryChecklist->status) && $enquiryChecklist->status == '1' ? 'selected':""?> > Active </option>
 <option value='2' <?=isset($enquiryChecklist->status) && $enquiryChecklist->status == '2' ? 'selected':""?> > Deactive </option>                  
                                       </select>
                                </div>

                                <br>
                                <div class="form-group button">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                                   
                                </div>
                              
                            </div>
                                      
                        </div>
                    </form>
                </div>

        </div>
        </div>

    </div>
</section>
@endsection
