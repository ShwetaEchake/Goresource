
@extends('layouts.admin')

@section('title')
Enquiry Document Type
@endsection


@section('content')
<section class="content">
    
    <div class="row">
        <div class="col-md-6">

        <div class="card card-primary ">
        <div class="card-body ">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-users mr-1"></i>Enquiry Document Type</h3>
   </div>
        <div class="card-body table-responsive p-0 ">
    

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    
                    <th>Enquiry Document Name</th>
                   
                    <th>Action</th>
            
                </tr>
            </thead>
            <tbody>
                   @forelse ($enquirydocumenttypes as $enquirydocumenttyp)
                    <tr>
                          
                          <td>{{ $enquirydocumenttyp->enquiry_documenttype_name }}</td>   
                        <td>

   <div class="row">
                       <a class="btn btn-flat btn-warning" href="{{ route('enquirydocumenttype.edit',$enquirydocumenttyp->enquiry_documenttype_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;

                             <form action="{{ route('enquirydocumenttype.destroy', $enquirydocumenttyp->enquiry_documenttype_id) }}" method="POST" onclick="return confirm('Are you sure you want to delete this item?')" >
   
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
        </table><br>

         <div class="float-right">
           {{$enquirydocumenttypes->links()}}
        </div>
       
        </div>

        </div>
        </div>
        </div>

    <!-- /.card-body -->

        <div class="col-md-6">
            <div class="card">
                 <div class="card-header">
                    @if(isset($enquirydocumenttype->enquiry_documenttype_id))
                        <h5> Edit </h5>
                         <a style="position: absolute;top: 10px;right: 10px;" href="{{ route('enquirydocumenttype.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
                     @else
                        <h5> Add New </h5>
                     @endif
                 </div>

            
                <div class="card-body">
                @if(isset($enquirydocumenttype->enquiry_documenttype_id))
      
            <form class="form-horizontal" method="POST" action="{{ route('enquirydocumenttype.update',$enquirydocumenttype->enquiry_documenttype_id) }}">
                    @csrf
                    @method('PUT')
        
           @else
           <form class="form-horizontal" method="POST" action="{{ route('enquirydocumenttype.store') }}">
                    @csrf
           @endif
                              
                        <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="First Name">Enquiry Document Type Name</label>
                                    <textarea style="resize:none" cols="2" rows="1" type="text" name="enquiry_documenttype_name"  id="enquiry_documenttype_name" class="form-control @error('enquiry_documenttype_name') is-invalid @enderror" required="" value="" >@if(isset($enquirydocumenttype->enquiry_documenttype_id)){{ $enquirydocumenttype->enquiry_documenttype_name }}
                                      @else
                                        {{ old('enquiry_documenttype_name')}}
                                      @endif 
                                   </textarea>
                                    @error('enquiry_documenttype_name')
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
