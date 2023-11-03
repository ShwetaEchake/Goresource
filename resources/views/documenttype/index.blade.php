@extends('layouts.admin')

@section('title')
Document Type
@endsection


@section('content')
<section class="content">

<div class = "row">
        <div class="col-md-6">

        <div class="card card-primary ">
        <div class="card-body ">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-users mr-1"></i> Document Type </h3>
   </div>
        <div class="card-body table-responsive p-0 ">
    

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                   
                   
                   <!--  <th> Id</th> -->
                    <th>Document Type</th>
                 
                    <th>Action</th>
            
                </tr>
            </thead>
            <tbody>
                   @forelse ($documenttypes as $documenttypee)
                    <tr>
                          <td>{{ $documenttypee->document_type_name }}</td>
                        
                          

                        <td>

          <div class="row">
                             <a class="btn btn-sm btn-flat btn-warning" href="{{ route('documenttype.edit',$documenttypee->document_type_id) }}"><i class="fa fa-edit"></i> </a>

                             <form action="{{ route('documenttype.destroy', $documenttypee->document_type_id ) }}" method="POST" onclick="return confirm('Are you sure you want to delete this item?')" >
   
                                @csrf
                                @method('DELETE') 
                             <button type="submit" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
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
        </table><br>
        <div class="float-right">
           {{$documenttypes->links()}}
        </div>
       
        </div>

        </div>
        </div>
        </div>


                <div class="col-md-6">
            <div class="card">
                 <div class="card-header">
                    @if(isset($documenttype->document_type_id))
                        <h5> Edit Document Type </h5>
                         <a style="position: absolute;top: 10px;right: 10px;" href="{{ route('documenttype.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
                     @else
                        <h5> Add New </h5>
                     @endif
                 </div>


                <div class="card-body">
                             
     @if(isset($documenttype->document_type_id))

            <form class="form-horizontal" method="POST" action="{{ route('documenttype.update',$documenttype->document_type_id) }}">
                    @csrf
                    @method('PUT')
        
           @else
           <form class="form-horizontal" method="POST" action="{{ route('documenttype.store') }}">
                    @csrf
           @endif

                                
                        <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="First Name">Document Type</label>
                                    
                                      <textarea style="resize:none" name="document_type_name" class="form-control editor" cols="2" rows="1">@if(isset($documenttype->document_type_id)){{ $documenttype->document_type_name }}
                                      @else
                                        {{ old('document_type_name')}}
                                      @endif
                                  </textarea>
                                    @error('document_type_name')
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


    <!-- /.card-body -->
    

</section>
@endsection
