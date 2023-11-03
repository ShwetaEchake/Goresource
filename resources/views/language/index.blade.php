
@extends('layouts.admin')

@section('title')
Language
@endsection


@section('content')
<section class="content">
    
    <div class="row">
        <div class="col-md-6">

        <div class="card card-primary ">
        <div class="card-body ">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-users mr-1"></i>Language</h3>
   </div>
        <div class="card-body table-responsive p-0 ">
    

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Language</th>
                    <th>Code</th>
                    <th>Action</th>
            
                </tr>
            </thead>
            <tbody>
                   @forelse ($languages as $languag)
                    <tr>
                          <td>{{ $languag->language_name }}</td>
                          <td>{{ $languag->language_code }}</td>   
                        <td>

   <div class="row">
                       <a class="btn btn-flat btn-warning" href="{{ route('language.edit',$languag->language_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;

                             <form action="{{ route('language.destroy', $languag->language_id) }}" method="POST" onclick="return confirm('Are you sure you want to delete this item?')" >
   
                                @csrf
                                @method('DELETE') 
                            <button type="submit" class="btn btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </form>
    </div>

                        </td>
                    </tr>
                 @empty
                   <!--  <tr>
                        <td><i class="fas fa-folder-open"></i> No Record found </td>
                    </tr> -->
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
                    @if(isset($language->language_id))
                        <h5> Edit </h5>
                         <a style="position: absolute;top: 10px;right: 10px;" href="{{ route('language.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
                     @else
                        <h5> Add New </h5>
                     @endif
                 </div>

            
                <div class="card-body">
                @if(isset($language->language_id))
      
            <form class="form-horizontal" method="POST" action="{{ route('language.update',$language->language_id) }}">
                    @csrf
                    @method('PUT')
        
           @else
           <form class="form-horizontal" method="POST" action="{{ route('language.store') }}">
                    @csrf
           @endif
                              
                        <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="First Name"> Name</label>
                                    <input type="text" name="language_name"  id="language_name" class="form-control @error('language_name') is-invalid @enderror" 
                                    required="" value=
                                    @if(isset($language->language_id))
                                          {{ $language->language_name }}
                                      @else
                                        {{ old('language_name')}}
                                      @endif >
                                    @error('language_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror



                                </div>
                                    <div class="form-group">
                                    <label for="First Name"> Code </label>
                                    <input type="text" name="language_code"  id="language_code" class="form-control @error('language_code') is-invalid @enderror" 
                                    required="" value=
                                    @if(isset($language->language_id))
                                          {{ $language->language_code }}
                                      @else
                                        {{ old('language_code')}}
                                      @endif >
                                    @error('language_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                

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

    </div>
</section>
@endsection
