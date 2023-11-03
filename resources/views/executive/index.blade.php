<?php
use app\Models\User;
?>

@extends('layouts.admin')

@section('title')
Executive
@endsection


@section('content')
<section class="content">
    
 
    

       
            <div class="card">
                         <div class="card-header">
                            @if(isset($executive->executive_id))
                                <h5> Edit Executive </h5>
                                 <a style="position: absolute;top: 10px;right: 10px;" href="{{ route('executive.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
                             @else
                                <h5> Add New </h5>
                             @endif
                         </div>

             
                <div class="card-body">

          @if(isset($executive->executive_id))

            <form class="form-horizontal" method="POST" action="{{ route('executive.update',$executive->executive_id) }}">
                    @csrf
                    @method('PUT')
        
           @else
           <form class="form-horizontal" method="POST" action="{{ route('executive.store') }}">
                    @csrf
           @endif


    <div class="row">
                                                 <div class="col-md-3">
                                                            <?php
                                                                if(!empty($executive)){
                                                                $user=User::where('id',$executive->user_id)->select('name','password')->first();
                                                                }
                                                            ?>
                                                          <label>First Name </label>
                                                           <input type="text" name="user_id"  id="user_id" class="form-control @error('user_id') is-invalid @enderror" required="" value=@if(isset($executive->executive_id))
                                                                {{$user->name}}
                                                            @else
                                                              {{ old('name')}}
                                                            @endif
                                                           >
                                                           @error('user_id')
                                                              <span class="invalid-feedback" role="alert">
                                                                  <strong>{{ $message }}</strong>
                                                              </span>
                                                           @enderror
                                                           </select>  
                                                </div>


                                                  <div class="col-md-3">
                                                    <label for="name">Last Name</label>
                                                    <input type="text" name="last_name"  id="last_name" class="form-control @error('last_name') is-invalid @enderror" required="" value=@if(isset($executive->executive_id))
                                                          {{$executive->last_name}}
                                                      @else
                                                        {{ old('last_name')}}
                                                      @endif  >
                                                    @error('last_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                  </div>

                                                  <div class="col-md-3">
                                                    <label for="name">Mobile Number</label>
                                                    <input type="number" name="mobile_no"  id="mobile_no" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" class="form-control @error('mobile_no') is-invalid @enderror" required="" value= @if(isset($executive->executive_id))
                                                          {{$executive->mobile_no}}
                                                      @else
                                                        {{ old('mobile_no')}}
                                                      @endif >
                                                    @error('mobile_no')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                   </div>


                                                 <div class="col-md-3">
                                                <label for="name">Email</label>
                                                <input type="text" name="email"  id="email" class="form-control @error('email') is-invalid @enderror" required="" value=@if(isset($executive->executive_id))
                                                      {{$executive->email}}
                                                  @else
                                                    {{ old('email')}}
                                                  @endif >
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                              </div>

 </div><br>


             <div class="row">


                                     <div class="col-md-3">
                                            <label>Password</label>
                                            <input type="password" name="password"  id="password" class="form-control @error('password') is-invalid @enderror" required="" value=@if(isset($executive->executive_id))
                                                  {{$user->password}}
                                              @else
                                                {{ old('password')}}
                                              @endif
                                             >
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                             </select>  
                                    </div>


                                      <div class="col-md-3">
                                        <label>Role </label>
                                         <select class="form-control select2" name="role_id" id="role_id" required>
                                                      <option value="">-select-</option>

                                          @foreach ($role as $data)
                                                @if(isset($executive->role_id))
                                                     <option value="{{ $data->title }}" {{ $data->id == $executive->role_id ?  'selected' : '' }}>{{$data->title}}</option> 
                                                @else
                                                <option value="{{ $data->title }}">{{$data->title}}</option>
                                                @endif
                                         @endforeach
                                         </select>  
                                      </div>


                                          <div class="col-md-3">
                                            <label>Branch </label>
                                             <select class="form-control select2" name="branch_name" id="branch_name" required>
                                                          <option value="">-select-</option>

                                             @foreach ($branch as $data)
                                                         @if(isset($executive->branch_name))
                                                               <option value="{{ $data->branch_id }}" {{ $data->branch_id == $executive->branch_name ?  'selected' : '' }}>{{$data->branch_name}}</option>
                                                         @else
                                                               <option value="{{ $data->branch_id }}">{{$data->branch_name}}</option>
                                                          
                                                        @endif

                                             @endforeach
                                             </select>  
                                         </div>

</div><br>

                                      <div class="form-group button">
                                          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                                      </div>
                

        </form>





                </div><!-- card-body -->
              </div>  <!--  card -->
         

</section>



<div class="row">
        <div class="col-md-12">

        <div class="card card-primary ">
        <div class="card-body ">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-users mr-1"></i> Executive </h3>
               </div>
        <div class="card-body table-responsive p-0 ">
    

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                   
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Branch</th>
                    <th>Action</th>
            
                </tr>
            </thead>
            <tbody>
                   @forelse ($executives as $executiv)
                    <tr>
                        
                          <td>{{ $executiv->first_name }}</td>
                           <td>{{ $executiv->last_name }}</td>
                          <td>{{ $executiv->mobile_no }}</td>
                          <td>{{ $executiv->email }}</td>
                           <td>{{ $executiv->role_id }}</td>
                          <td>{{ $executiv->branch_name }}</td>
                      

            
                   <td>
                          <div class="row">
                               <a style="" class="btn btn-sm btn-flat btn-warning" href="{{ route('executive.edit',$executiv->executive_id) }}"><i class="fa fa-edit"></i> </a>



                               <form action="{{ route('executive.destroy', $executiv->executive_id) }}" method="POST" onclick=" return confirm('Are you sure you want to delete this item?')" >
   
                                 @csrf
                                 @method('DELETE') 
                               <button style="" type="submit" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
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
</div>

@endsection