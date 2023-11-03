@extends('layouts.admin')

@section('title')
Cities
@endsection


@section('content')
<section class="content">
    
    <div class="row">
        <div class="col-md-6">

        <div class="card card-primary ">
        <div class="card-body ">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-users mr-1"></i> Cities </h3>
   </div>
        <div class="card-body table-responsive p-0">
    

        <table class="table table-hover">
            <thead>
                <tr>
                   
                        <th> Name</th>
                
                        <th> Status</th>
                             @if ((auth()->user()->role != 'Brand') && (auth()->user()->role != 'Vendor') && (auth()->user()->role != 'Partner'))

                        <th>Action</th>
                        @endif
                       
                </tr>
            </thead>
            <tbody>
                   @forelse ($citiess as $cities)
                    <tr>
                        
                        
                         <td>{{ $cities->city_name }}</td> 
                       
                    <td>
                        @if($cities->cities_status ==1)
                        <span class="">Active</span>
                        @else
                        <span class="">Deactive</span>
                        @endif
                    </td> 
      @if ((auth()->user()->role != 'Brand') && (auth()->user()->role != 'Vendor') && (auth()->user()->role != 'Partner'))

                        <td>
                             <form action="{{ route('cities.destroy', $cities->cities_id) }}" method="POST" onclick="return confirm('Are you sure you want to delete this item?')" >
   
                                @csrf
                                @method('DELETE') 
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>

                        </td>
     @endif
                    </tr>
                @empty
                    <!-- <tr>No Result Found</tr> -->
                @endforelse
            </tbody>
        </table>
        <hr>
         <div class="float-right">
                   {!! $citiess->onEachSide(1)->links()!!}
         </div>
        </div>

        </div>
        </div>
        </div>

    <!-- /.card-body -->
    
     @if ((auth()->user()->role != 'Brand') && (auth()->user()->role != 'Vendor') && (auth()->user()->role != 'Partner'))

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4> New Cites </h4>
                </div>
                <div class="card-body">
                        
                    <form class="form-horizontal" method="POST" action="{{ route('cities.index') }}">
                                    @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">City </label>
                                    <input type="text" name="city_name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('city_name') }}" required placeholder="Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
   
                                </div>

                                <div class="form-group">
                                     <label>State </label>
                                      <select class="form-control select2" name="state_id" id="state_id" required>
                                              <option value="">---select---</option>
                                              @foreach ($state as $data)
                                                  <option value="{{ $data->state_id }}">{{$data->state_name}}</option>
                                               @endforeach
                                     </select>                                        
                 
                                 </div>
             <div>
                 <label class="control-label" for="inputEmail3"> Status</label>
         <select class="form-control valdation_select" name="cities_status" required>
                        
         <option value='1' <?=isset($cities->cities_status) && $cities->cities_status ==  '1' ? 'selected':""?> > Active </option>
         <option value='0'  <?=isset($cities->cities_status) && $cities->cities_status == '0' ? 'selected':""?> > Deactive </option>                    
                      </select>
          </div><br>

            <label>Sequence</label>
            <input type="number" name="sequence"  id="sequence" class="form-control @error('sequence') is-invalid @enderror" value="{{ old('sequence') }}" required placeholder="sequence">
            @error('sequence')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
                                <br>
                                <div class="form-group button">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Create</button>
                                   
                                </div>
                              
                            </div>
                                      
                        </div>
                    </form>
                </div>

        </div>
        </div>
@endif
    </div>
</section>
@endsection
