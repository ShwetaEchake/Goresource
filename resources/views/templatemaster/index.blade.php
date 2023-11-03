<?php
use app\Models\Country;
?>
@extends('layouts.admin')

@section('title')
Template
@endsection


@section('content')
<section class="content">
    
    <div class="row">
       
        <div class="col-md-12">
            <div class="card">
                 <div class="card-header">
                    @if(isset($template->template_id))
                        <h5> Edit </h5>
                         <a style="position: absolute;top: 10px;right: 10px;" href="{{ route('templatemaster.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
                     @else
                        <h5> Add New </h5>
                     @endif
                 </div>

            
                <div class="card-body">
                @if(isset($template->template_id))
      
            <form class="form-horizontal" method="POST" action="{{ route('templatemaster.update',$template->template_id) }}">
                    @csrf
                    @method('PUT')
        
           @else
           <form class="form-horizontal" method="POST" action="{{ route('templatemaster.store') }}">
                    @csrf
           @endif
                              
                        <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                   
                                   <label for="First Name">Title</label>
                                    <textarea type="text" style="resize:none" name="title"  id="title" cols="1" rows="1" class="form-control @error('title') is-invalid @enderror" 
                                    required="">@if(isset($template->template_id)){{ $template->title }}
                                      @else
                                        {{ old('title')}}
                                      @endif </textarea>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>    

                                
                                <div class="form-group">
                                   
                                   <label for="First Name">Short Code</label>
                                    <input type="text" name="shortcode" id="shortcode" class="form-control @error('shortcode') is-invalid @enderror" 
                                    required="" value=
                                    @if(isset($template->template_id))
                                          {{ $template->shortcode }}
                                      @else
                                        {{ old('shortcode')}}
                                      @endif >
                                    @error('shortcode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                   
                                   <label for="First Name">Country</label>
                                  <select class="form-control select2" name="country" id="country" required>
                                              <option value="">-select-</option>
                          <?php $countri = DB::table('country')->get(); ?>

                             @foreach($countri as $data)
                                                                            
                                    @if(isset($template->country))
                                       <option value="{{ $data->country_id }}" {{ $data->country_id == $template->country ?  'selected' : '' }}>{{$data->country_name}}</option>
                                    @else
                                       <option value="{{$data->country_id}}">{{$data->country_name}}</option>
                                    @endif 
                                  @endforeach
      
                                </select>  
                              </div>
                                
                                <div class="form-group">
                                   
                                   <label for="First Name">Template</label>
                                     <textarea style="resize:none" name="template" class="form-control editor" cols="2" rows="5">@if(isset($template->template_id)){{ $template->template }}
                                      @else
                                        {{ old('template')}}
                                      @endif
                                  </textarea>
                                    @error('template')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                   
                                   <label for="First Name">Status</label>
                        
<select class="form-control valdation_select" name="status" required>
<option value='' <?=isset($template->status) && $template->status ==  '0' ? 'selected':""?> > Select </option>
 <option value='1' <?=isset($template->status) && $template->status == '1' ? 'selected':""?> > Active </option>
 <option value='2' <?=isset($template->status) && $template->status == '2' ? 'selected':""?> > Deactive </option>                    
                                       </select>

                                </div>
                                
                                <div class="form-group button">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                                   
                                </div>
                              
                            </div>
                                      
                        </div>
                    </form>
                </div>

        </div>
        </div>

 <div class="col-md-12">

        <div class="card card-primary ">
        <div class="card-body ">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-users mr-1"></i>Template</h3>
   </div>
        <div class="card-body table-responsive p-0 ">
    

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    
                    <th>Title</th>
                    <th>Short Code</th>
                    <th>Country</th>
                    {{--<th>Template</th>--}}
                    <th>Status</th>
                    <th>Action</th>
        </tr>
            </thead>
            <tbody>
                   @forelse ($templates as $templatee)
                    <tr>
                          
                          <td>{!!$templatee->title !!}</td>   
                          <td>{{ $templatee->shortcode }}</td>   
                          <td>
                            <?php $country = DB::table('country')->where('country_id', '=', $templatee->country )->first(); ?>

                          {{ $country->country_name }}
                          </td>   
                          {{--<td>{!! $templatee->template !!}</td>--}}
                          <td>
                            @if($templatee->status ==1)
                              <span class="badge badge-info">Active</span>
                            @else
                               <span class="badge badge-info">Deactive</span>
                            @endif
                            </td> 
                        <td>

   <div class="row">
                       <a class="btn btn-flat btn-sm btn-warning" href="{{ route('templatemaster.edit',$templatee->template_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;

                             <form action="{{ route('templatemaster.destroy', $templatee->template_id) }}" method="POST" onclick="return confirm('Are you sure you want to delete this item?')" >
   
                                @csrf
                                @method('DELETE') 
                            <button type="submit" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
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
    </div>
</section>
@endsection
