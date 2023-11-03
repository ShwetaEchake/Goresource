<?php
use App\Models\Category;

?>
@extends('layouts.admin')

@section('title')
Category
@endsection


@section('content')
<section class="content">
    
    <div class="row">
        <div class="col-md-6">

        <div class="card card-primary ">
        <div class="card-body ">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-users mr-1"></i> Category </h3>
   </div>
        <div class="card-body table-responsive p-0 ">
    

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th> Category Name</th>
                   <!--  <th>Main Category </th> -->
                    <th> Photo </th>
                    <th>Status</th>
                    <th>Action</th>
            
                </tr>
            </thead>
            <tbody>
                   @forelse($categorie as $categoryy)
                    <tr>
                          <td>{{ $categoryy->category_name }}</td>
                        

                           {{--<td>
                         <?php $name = Category::where(['category_id'=>$categoryy->parent_category_id])->get();?>
                             @foreach ($name as $data)
                                {{$data->category_name}}
                            @endforeach
                         </td>--}}
                          <td>

                        <?php  if(isset($categoryy->category_photo)){ ?>
                          <img src="{{asset('uploads/itemPic/' . $categoryy->category_photo)}}" 
                            width="100px" height=""  alt="">
                          <?php }else {?>
                            <img src="{{ asset('img/no-user.jpg') }}" 
                            width="100px" height="100px"  alt="">
                        <?php  }?>

                        </td>
                          <td>
                            @if( $categoryy->status ==1)
                              <span class="badge badge-info">Active</span>
                            @else
                               <span class="badge badge-info">Deactive</span>
                            @endif
                            </td>
                        <td>
                          <div class="row">
                    
                            <a class="btn btn-flat btn-warning" href="{{ route('category.edit',$categoryy->category_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;

                             <form action="{{ route('category.destroy',$categoryy->category_id)}}" method="POST" enctype="multipart/form-data" onclick="return confirm('Are you sure you want to delete this item?')" >
   
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
           {{$categorie->links()}}
        </div>

       
        </div>

        </div>
        </div>
        </div>

    <!-- /.card-body -->
    

        <div class="col-md-6">
            <div class="card">
                 <div class="card-header">
                    @if(isset($category->category_id))
                        <h5> Edit Category </h5>
                         <a style="position: absolute;top: 10px;right: 10px;" href="{{ route('category.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
                     @else
                        <h5> Add New </h5>
                     @endif
                 </div>

                <div class="card-body">

                    @if(!empty($category->category_id))

                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('category.update',$category->category_id) }}">
                    @csrf
                    @method('PUT')
            
           @else
           <form class="form-horizontal" method="POST" action="{{ route('category.store')}}" enctype="multipart/form-data">
                  @csrf
            
           @endif

                        <div class="row">
                            <div class="col-md-12">


                                     <div class="form-group">
                                    <label for="First Name"> Category Name </label>
                                    <input type="text" name="category_name"  id="category_name" class="form-control @error('category_name') is-invalid @enderror" required="" value=@if(isset($category->category_id))
                                          {{$category->category_name}}
                                      @else
                                        {{ old('category_name')}}
                                      @endif >

                                    @error('category_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>




                                {{--<div class="form-group">
                                    <label for="name">Main Category</label>
                                     <select class="form-control select2" name="parent_category_id" id="parent_category_id" >
                                          <option value="0">-select-</option>
                                      
                                     @foreach ($categoryvalue as $data)
                                                 @if(isset($category->parent_category_id))
        <option value="{{ $data->category_id }}" {{ $data->category_id ==$category->parent_category_id ?  'selected' : ''}}>{{$data->category_name}}</option>


                                                 @else
                                                       <option value="{{ $data->category_id }}">{{$data->category_name}}</option>
                                                  
                                                @endif

                                     @endforeach


                                    </select>  
                                </div>--}}

                        
                            

                                     <div class="form-group">
                                    <label for="First Name">Photo Upload </label><br>
                                    <input type="file" name="category_photo"  id="category_photo" class=" @error('category_photo') is-invalid @enderror"  value=@if(isset($category->category_id))
                                          {{$category->category_photo}}
                                      @else
                                        {{ old('category_photo')}}
                                      @endif >

                                    @error('category_photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
 
                                 <div>
              <label class="control-label" for="inputEmail3"> Status</label>
                                         
              <select class="form-control valdation_select" name="status" >
<option value='' <?=isset($category->status) && $category->status ==  '0' ? 'selected':""?> > Select </option>
 <option value='1' <?=isset($category->status) && $category->status == '1' ? 'selected':""?> > Active </option>
 <option value='2' <?=isset($category->status) && $category->status == '2' ? 'selected':""?> > Deactive </option>                    
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
