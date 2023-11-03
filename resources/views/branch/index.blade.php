<?php
use app\Models\Country;
?>
@extends('layouts.admin')

@section('title')
Associate
@endsection


@section('content')
<section class="content">
    
    <div class="row">
        <div class="col-md-6">

        <div class="card card-primary ">
        <div class="card-body ">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-users mr-1"></i> Associate </h3>
   </div>
        <div class="card-body table-responsive p-0 ">
    

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                   
                   
                   <!--  <th> Id</th> -->
                    <th>Associate</th>
                    <th>Status</th>
                    <th>Action</th>
            
                </tr>
            </thead>
            <tbody>
                   @forelse ($branches as $branchh)
                    <tr>
                        
                          <td>{{ $branchh->branch_name }}</td>
                  
                          <td>
                            @if( $branchh->status ==1)
                              <span class="badge badge-info">Active</span>
                            @else
                               <span class="badge badge-info">Deactive</span>
                            @endif
                            </td>
                        
                          
                        <td>

   <div class="row">
                       <a class="btn btn-flat btn-warning" href="{{ route('branch.edit',$branchh->branch_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;

                             <form action="{{ route('branch.destroy', $branchh->branch_id ) }}" method="POST" onclick="return confirm('Are you sure you want to delete this item?')" >
   
                                @csrf
                                @method('DELETE') 
                            <button type="submit" class="btn btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </form>
    </div>

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
                    @if(isset($branch->branch_id))

                        <h5> Edit Associate </h5>
                         <a style="position: absolute;top: 10px;right: 10px;" href="{{ route('branch.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
                     @else
                        <h5> Add New Associate </h5>
                     @endif
                 </div>


                <div class="card-body">



          @if(isset($branch->branch_id))

            <form class="form-horizontal" method="POST" action="{{ route('branch.update',$branch->branch_id) }}">
                    @csrf
                    @method('PUT')
        
           @else
           <form class="form-horizontal" method="POST" action="{{ route('branch.store') }}">
                    @csrf
           @endif

          
                        <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">

                                    <label for="First Name">Associate</label>
                                    <input type="text" name="branch_name"  id="branch_name" class="form-control @error('branch_name') is-invalid @enderror" required="" value=
                                    @if(isset($branch->branch_id))
                                          {{$branch->branch_name}}
                                      @else
                                        {{ old('branch_name')}}
                                      @endif >
                                    @error('branch_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="First Name">City</label>
                                    <input type="text" name="branch_city"  id="branch_city" class="form-control @error('branch_city') is-invalid @enderror" required="" value=
                                    @if(isset($branch->branch_id))
                                          {{$branch->branch_city}}
                                      @else
                                        {{ old('branch_city')}}
                                      @endif >
                                    @error('branch_city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                 <label>Country</label>
                                <select class="form-control select2" name="branch_country" id="branch_country" required>
                                              <option value="">-select-</option>

                             @foreach($country as $data)
                                                                            
                                    @if(isset($branch->branch_country))
                                       <option value="{{ $data->country_id }}" {{ $data->country_id == $branch->branch_country ?  'selected' : '' }}>{{$data->country_name}}</option>
                                    @else
                                       <option value="{{$data->country_id}}">{{$data->country_name}}</option>
                                    @endif 
                                  @endforeach
      
                                </select>  
                                </div>

                                <div>
                                <label class="control-label" for="inputEmail3"> Status</label>
                                    <select class="form-control valdation_select" name="status" required>
                                     <option value='' <?=isset($branch->status) && $branch->status ==  '0' ? 'selected':""?> > Select </option>
                                     <option value='1' <?=isset($branch->status) && $branch->status == '1' ? 'selected':""?> > Active </option>
                                     <option value='2' <?=isset($branch->status) && $branch->status == '2' ? 'selected':""?> > Deactive </option>      </select>
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
