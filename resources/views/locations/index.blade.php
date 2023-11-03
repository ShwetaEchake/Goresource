@extends('layouts.admin')

@section('title')
Locations
@endsection


@section('content')
<section class="content">
    
    <div class="row">
        <div class="col-md-6">

        <div class="card card-primary ">
        <div class="card-body ">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-users mr-1"></i> Locations </h3>
   </div>
        <div class="card-body table-responsive p-0 ">
    

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                   
                    <th>Locations Name</th>
                    <th>Status</th>
                    <th>Action</th>
            
                </tr>
            </thead>
            <tbody>
                   @forelse ($locations as $locationn)
                    <tr>
                          <td>{{ $locationn->location_name }}</td>
                          <td>
                            @if( $locationn->status ==1)
                              <span class="badge badge-info">Active</span>
                            @else
                               <span class="badge badge-info">Deactive</span>
                            @endif
                            </td>
                        
                          
                        <td>

             <div class="row">
                       <a class="btn btn-flat btn-warning" href="{{ route('locations.edit',$locationn->location_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;
                             <form action="{{ route('locations.destroy', $locationn->location_id ) }}" method="POST" onclick="return confirm('Are you sure you want to delete this item?')" >
   
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
                    @if(isset($location->location_id))
                        <h5> Edit Location </h5>
                         <a style="position: absolute;top: 10px;right: 10px;" href="{{ route('locations.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
                     @else
                        <h5> Add New Location</h5>
                     @endif
                 </div>

                <div class="card-body">
                        
            <!--     <form class="form-horizontal" method="POST" action="{{ route('locations.store') }}">
                                    @csrf -->



          @if(empty($location->location_id))
            <form class="form-horizontal" method="POST" action="{{ route('locations.store') }}">
                    @csrf
           @else
            <form class="form-horizontal" method="POST" action="{{ route('locations.update',$location->location_id) }}">
                    @csrf
                    @method('PUT')
           @endif

                        <div class="row">
                            <div class="col-md-12">

                        
                                 <div class="form-group">
                                    <label for="First Name">Location Name</label>
                                    <input type="text" name="location_name"  id="location_name" class="form-control @error('location_name') is-invalid @enderror" required="" value=
                                    @if(isset($location->location_id))
                                          {{$location->location_name}}
                                      @else
                                        {{ old('location_name')}}
                                      @endif >

                                    @error('location_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                 <div>
                                     <label class="control-label" for="inputEmail3"> Status</label>
                                     <select class="form-control valdation_select" name="status" required>
<option value='' <?=isset($location->status) && $location->status ==  '0' ? 'selected':""?> > Select </option>
 <option value='1' <?=isset($location->status) && $location->status == '1' ? 'selected':""?> > Active </option>
 <option value='2' <?=isset($location->status) && $location->status == '2' ? 'selected':""?> > Deactive </option>                    
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
