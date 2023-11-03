 
@extends('layouts.admin')

@section('title')
Country
@endsection


@section('content')
<section class="content">


    
    <div class="row">
        <div class="col-md-6">

        <div class="card card-primary ">
        <div class="card-body ">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-users mr-1"></i> Country</h3>
   </div>
        <div class="card-body table-responsive p-0 ">
    

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                   
                   
                 
                    <th>Country Name</th>
                    <th>Country Code</th>
                    <th>Country Currency</th>
                 
                    <th>Action</th>
            
                </tr>
            </thead>
            <tbody>
                   @forelse ($countries as $countrye)
                    <tr>
                          <td>{{ $countrye->country_name }}</td>
                          <td>{{ $countrye->country_code}}</td>
                         <td>{{ $countrye->country_currency}}</td>
                        
                          

                        <td>

          <div class="row">
                             <a class="btn btn-flat btn-warning" href="{{ route('country.edit',$countrye->country_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;

                             <form action="{{ route('country.destroy', $countrye->country_id ) }}" method="POST" onclick="return confirm('Are you sure you want to delete this item?')" >
   
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
    
        <div class="col-lg-6">
            <div class="card">
                

<div class="card-header">
                    @if(isset($country->country_id))
                        <h5> Edit Country </h5>
                         <a style="position: absolute;top: 10px;right: 10px;" href="{{ route('country.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
                     @else
                        <h5> Add Country </h5>
                     @endif
                 </div>





                <div class="card-body">
                             
      
         @if(isset($country->country_id))


          <form class="form-horizontal" method="POST" action="{{ route('country.update',$country->country_id) }}">
                    @csrf
                    @method('PUT')
           
           @else
            <form class="form-horizontal" method="POST" action="{{ route('country.store') }}">
                    @csrf
           
           @endif
                                
                        <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="First Name">Country Name</label>
                                    <input type="text" name="country_name"  id="country_name" class="form-control @error('country_name') is-invalid @enderror" required="" value=
                                    @if(isset($country->country_id))
                                          {{$country->country_name}}
                                      @else
                                        {{ old('country_name')}}
                                      @endif >
                                      @error('country_name')  >
                                    
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                 <div class="form-group">
                                    <label for="First Name">Country Code</label>
                                    <input type="text" name="country_code"  id="country_code" class="form-control @error('country_code') is-invalid @enderror" required="" value=
                                    @if(isset($country->country_id))
                                          {{$country->country_code}}
                                      @else
                                        {{ old('country_code')}}
                                      @endif >
                                      @error('country_code')  >
                                    
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                 <div class="form-group">
                                    <label for="First Name">Country Currency</label>
                                    <input type="text" name="country_currency"  id="country_currency" class="form-control @error('country_currency') is-invalid @enderror" required="" value=
                                    @if(isset($country->country_id))
                                          {{$country->country_currency}}
                                      @else
                                        {{ old('country_currency')}}
                                      @endif >
                                      @error('country_currency')  >
                                    
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
