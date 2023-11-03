@extends('layouts.admin')

@section('title')
Sms Template
@endsection


@section('content')
<section class="content">
    
    <div class="row">
        <div class="col-md-6">

        <div class="card card-primary ">
        <div class="card-body ">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-users mr-1"></i> Sms Template </h3>
   </div>
        <div class="card-body table-responsive p-0 ">
    

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                   
                  <!--   <th>Sms Template</th> -->
                    <th>Title</th>
                    <th>Action</th>
            
                </tr>
            </thead>
            <tbody>
                   @forelse ($smstemplates as $smstemplatee)
                    <tr>
                         <!--  <td>{{ $smstemplatee->sms_template }}</td> -->
                           <td>{{ $smstemplatee->sms_title }}</td>
                        
                        
                          
                        <td>

                 <div class="row">
                       <a class="btn btn-flat btn-warning" href="{{ route('smstemplate.edit',$smstemplatee->sms_template_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;

                             <form action="{{ route('smstemplate.destroy', $smstemplatee->sms_template_id ) }}" method="POST" onclick="return confirm('Are you sure you want to delete this item?')" >
   
                                @csrf
                                @method('DELETE') 
                            <button type="submit" class="btn btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </form>
                  </div>
                        </td>
                    </tr>
                 @empty
                    <!-- <tr>
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
                    @if(isset($smstemplate->sms_template_id))
                        <h5> Edit SMS Template </h5>
                         <a style="position: absolute;top: 10px;right: 10px;" href="{{ route('smstemplate.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
                     @else
                        <h5> Add New SMS Template</h5>
                     @endif
                 </div>



                <div class="card-body">
                        
              <!--   <form class="form-horizontal" method="POST" action="{{ route('smstemplate.store') }}">
                                    @csrf -->

          @if(empty($smstemplate->sms_template_id))
            <form class="form-horizontal" method="POST" action="{{ route('smstemplate.store') }}">
                    @csrf
           @else
            <form class="form-horizontal" method="POST" action="{{ route('smstemplate.update',$smstemplate->sms_template_id) }}">
                    @csrf
                    @method('PUT')
           @endif



                        <div class="row">
                            <div class="col-md-12">

                        

                              <div class="form-group">
                                    <label for="Title">Title</label>
                                    <input type="text" name="sms_title"  id="sms_title" class="form-control @error('sms_title') is-invalid @enderror" required="" value=
                                    @if(isset($smstemplate->sms_template_id))
                                          {{$smstemplate->sms_title}}
                                      @else
                                        {{ old('sms_title')}}
                                      @endif >
                                    @error('sms_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                 <div class="form-group">
                                    <label for="First Name">Sms Template</label>
                                    <textarea type="text" name="sms_template"  id="sms_template" class="form-control @error('sms_template') is-invalid @enderror" required="">@if(isset($smstemplate->sms_template_id)){{$smstemplate->sms_template}}
                                      @else
                                        {{ old('sms_template')}}
                                      @endif  
                                    </textarea>
                                
                                    @error('sms_template')
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
