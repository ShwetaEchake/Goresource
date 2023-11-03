@extends('layouts.admin')

@section('title')
Role
@endsection


@section('content')
<section class="content">
    
    <div class="row">
        <div class="col-md-6">

        <div class="card card-primary ">
        <div class="card-body ">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-users mr-1"></i> Roles </h3>
   </div>
        <div class="card-body table-responsive p-0 ">
    

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                   
                    <th> Name</th>
                    <th>Status</th>
                    <th>Action</th>
            
                </tr>
            </thead>
            <tbody>
                      @forelse ($roles as $rolee )
                    <tr>
                          <td>{{ $rolee->title }}</td>
                          <td>
                            @if( $rolee->status ==1)
                              <span class="badge badge-info">Active</span>
                            @else
                               <span class="badge badge-info">Deactive</span>
                            @endif
                            </td>
                        
                          
                        <td>
                             <div class="row">
                                 <a class="btn btn-flat btn-warning" href="{{ route('role.edit',$rolee->id) }}"><i class="fa fa-edit"></i> </a>&nbsp;
                             <form action="{{ route('role.destroy', $rolee->id ) }}" method="POST" onclick="return confirm('Are you sure you want to delete this item?')" >
   
                                @csrf
                                @method('DELETE') 
                            <button type="submit" class="btn btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </form>
                            <div>

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
                    @if(isset($role->id))
                        <h5> Edit Role </h5>
                         <a style="position: absolute;top: 10px;right: 10px;" href="{{ route('role.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
                     @else
                        <h5> Add New Role </h5>
                     @endif
                 </div>
                           
               
                <div class="card-body">

          @if(isset($role->id))

            <form class="form-horizontal" method="POST" action="{{ route('role.update',$role->id) }}">
                    @csrf
                    @method('PUT')
        
           @else
           <form class="form-horizontal" method="POST" action="{{ route('role.store') }}">
                    @csrf
           @endif

                        <div class="row">
                            <div class="col-md-12">

                        
                                    <div class="form-group">
                                    <label for="First Name">Title</label>
                                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" required="" value=
                                    @if(isset($role->id))
                                          {{$role->title}}
                                      @else
                                        {{ old('title')}}
                                      @endif >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                 <div>
                                         <label class="control-label" for="inputEmail3"> Status</label>
                                         <select class="form-control valdation_select" name="status" required>
<option value='' <?=isset($role->status) && $role->status ==  '0' ? 'selected':""?> > Select </option>
 <option value='1' <?=isset($role->status) && $role->status == '1' ? 'selected':""?> > Active </option>
 <option value='2' <?=isset($role->status) && $role->status == '2' ? 'selected':""?> >                     
                                       </select>
                                </div>

                                    <br>
                                <div class="form-group button">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Submit</button>
                                   
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
