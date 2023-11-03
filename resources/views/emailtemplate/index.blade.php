@extends('layouts.admin')

@section('title')
Email Template
@endsection


@section('content')
<section class="content">
    
    <div class="row">
        <div class="col-md-6">

        <div class="card card-primary ">
        <div class="card-body ">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-users mr-1"></i> Email Template </h3>
   </div>
        <div class="card-body table-responsive p-0 ">
    

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                   
                 <!--    <th>Email Template</th> -->
                    <th>Title</th>
                    <th>Action</th>
            
                </tr>
            </thead>
            <tbody>
                   @forelse ($emailtemplates as $emailtemplatee)
                    <tr>
                        <!--   <td>{{ $emailtemplatee->email_template }}</td> -->
                           <td>{{ $emailtemplatee->email_title }}</td>
                        
                        
                          
                        <td>

                 <div class="row">
            <a class="btn btn-flat btn-warning" href="{{ route('emailtemplate.edit',$emailtemplatee->email_template_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;


                             <form action="{{ route('emailtemplate.destroy', $emailtemplatee->email_template_id ) }}" method="POST" onclick="return confirm('Are you sure you want to delete this item?')" >
   
                                @csrf
                                @method('DELETE') 
                             <button type="submit" class="btn btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </form>

                </div>

                        </td>
                    </tr>
                 @empty
                  <!--   <tr>
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
                    @if(isset($emailtemplate->email_template_id))
                        <h5> Edit Email Template </h5>
                         <a style="position: absolute;top: 10px;right: 10px;" href="{{ route('emailtemplate.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
                     @else
                        <h5> Add New Email Template</h5>
                     @endif
                 </div>


                <div class="card-body">
                        
              <!--   <form class="form-horizontal" method="POST" action="{{ route('emailtemplate.store') }}">
                                    @csrf -->


            @if(empty($emailtemplate->email_template_id))
            <form class="form-horizontal" method="POST" action="{{ route('emailtemplate.store') }}">
                    @csrf
           @else
            <form class="form-horizontal" method="POST" action="{{ route('emailtemplate.update',$emailtemplate->email_template_id) }}">
                    @csrf
                    @method('PUT')
           @endif



                        <div class="row">
                            <div class="col-md-12">

                              <div class="form-group">
                                    <label for="Title">Title</label>
                                    <input type="text" name="email_title"  id="email_title" class="form-control @error('email_title') is-invalid @enderror" required="" value=
                                    @if(isset($emailtemplate->email_template_id))
                                          {{$emailtemplate->email_title}}
                                      @else
                                        {{ old('email_title')}}
                                      @endif >
                                    @error('email_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                 <div class="form-group">
                                    <label for="First Name">Email Template</label>
                                    <textarea type="text" name="email_template"  id="email_template" class="form-control @error('email_template') is-invalid @enderror">@if(isset($emailtemplate->email_template_id)){{$emailtemplate->email_template}}
                                      @else
                                        {{ old('email_template')}}
                                      @endif

                                    </textarea>
                                    @error('email_template')
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
