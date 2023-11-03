

@extends('layouts.admin')

@section('title')
Executive
@endsection


@section('content')
<section class="content">
    

            <div class="card">
                         <div class="card-header">
                            @if(isset($medicalexaminationcenter->medicalexaminationcenter_id))
                                <h5> Edit Medical Examination Center </h5>
                                 <a style="position: absolute;top: 10px;right: 10px;" href="{{ route('medicalexaminationcenter.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
                             @else
                                <h5> Add New </h5>
                             @endif
                         </div>

             
                <div class="card-body">

          @if(isset($medicalexaminationcenter->medical_examination_center_id))

            <form class="form-horizontal" method="POST" action="{{ route('medicalexaminationcenter.update',$medicalexaminationcenter->medical_examination_center_id) }}">
                    @csrf
                    @method('PUT')
        
           @else
           <form class="form-horizontal" method="POST" action="{{ route('medicalexaminationcenter.store') }}">
                    @csrf
           @endif


    <div class="row">
                                                 <div class="col-md-4">
                                                        
                                                          <label>Examination Center Code </label>
                                                           <input type="text" name="medical_examination_center_code"  id="medical_examination_center_code" class="form-control @error('medical_examination_center_code') is-invalid @enderror" required="" value=@if(isset($medicalexaminationcenter->medical_examination_center_id))
                                                                {{$medicalexaminationcenter->medical_examination_center_code}}
                                                            @else
                                                              {{ old('name')}}
                                                            @endif
                                                           >
                                                           @error('medical_examination_center_code')
                                                              <span class="invalid-feedback" role="alert">
                                                                  <strong>{{ $message }}</strong>
                                                              </span>
                                                           @enderror
                                                          
                                                </div>
<div class="col-md-4">
 <label>Examination Center name </label>
                                                           <textarea type="text" style="resize:none" cols="2" rows="1" name="medical_examination_center_name"  id="medical_examination_center_name" class="form-control @error('medical_examination_center_name') is-invalid @enderror" required="">@if(isset($medicalexaminationcenter->medical_examination_center_id)){{$medicalexaminationcenter->medical_examination_center_name}}
                                                            @else
                                                              {{ old('name')}}
                                                            @endif
                                                           </textarea>
                                                           @error('medical_examination_center_name')
                                                              <span class="invalid-feedback" role="alert">
                                                                  <strong>{{ $message }}</strong>
                                                              </span>
                                                           @enderror
                                                          
                                                </div>
                                                
<div class="col-md-4">
  <label>Examination Center city </label>
                                                           <textarea type="text" style="resize:none" cols="2" rows="1" name="medical_examination_center_city"  id="medical_examination_center_city" class="form-control @error('medical_examination_center_city') is-invalid @enderror" required="" >@if(isset($medicalexaminationcenter->medical_examination_center_id)){{$medicalexaminationcenter->medical_examination_center_city}}
                                                            @else
                                                              {{ old('name')}}
                                                            @endif
                                                           </textarea>
                                                           @error('medical_examination_center_city')
                                                              <span class="invalid-feedback" role="alert">
                                                                  <strong>{{ $message }}</strong>
                                                              </span>
                                                           @enderror
                                                          
                                                </div>



 </div><br>


             <div class="row">

  <div class="col-md-4">
  <label>Examination Center state </label>
                                                           <input type="text" name="medical_examination_center_state"  id="medical_examination_center_state" class="form-control @error('medical_examination_center_state') is-invalid @enderror" required="" value=@if(isset($medicalexaminationcenter->medical_examination_center_id))
                                                                {{$medicalexaminationcenter->medical_examination_center_state}}
                                                            @else
                                                              {{ old('name')}}
                                                            @endif
                                                           >
                                                           @error('medical_examination_center_state')
                                                              <span class="invalid-feedback" role="alert">
                                                                  <strong>{{ $message }}</strong>
                                                              </span>
                                                           @enderror
                                                          
                                                </div>

                                 <div class="col-md-4">
  <label>Examination Center Country </label>
                                                           <input type="text" name="medical_examination_center_country"  id="medical_examination_center_country" class="form-control @error('medical_examination_center_country') is-invalid @enderror" required="" value=@if(isset($medicalexaminationcenter->medical_examination_center_id))
                                                                {{$medicalexaminationcenter->medical_examination_center_country}}
                                                            @else
                                                              {{ old('name')}}
                                                            @endif
                                                           >
                                                           @error('medical_examination_center_country')
                                                              <span class="invalid-feedback" role="alert">
                                                                  <strong>{{ $message }}</strong>
                                                              </span>
                                                           @enderror
                                                          
                                                </div>

                            


                                      

</div><br>

                                      <div class="form-group button">
                                          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                                      </div>
                

        </form>





                </div><!-- card-body -->
              </div>  <!--  card -->
         

</section>



<div class="row">
        <div class="col-md-12">

        <div class="card card-primary ">
        <div class="card-body ">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-users mr-1"></i> Medical Examination Center </h3>
               </div>
        <div class="card-body table-responsive p-0 ">
    

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                   
                    <th>Code</th>
                    <th>Medical Examination Center Name</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Action</th>
            
                </tr>
            </thead>
            <tbody>
                   @forelse ($medicalexaminationcenters as $medicalexamcenter)
                    <tr>
                        
                          <td>{{ $medicalexamcenter->medical_examination_center_code }}</td>
                           <td>{{ $medicalexamcenter->medical_examination_center_name }}</td>
                          <td>{{ $medicalexamcenter->medical_examination_center_city }}</td>
                          <td>{{ $medicalexamcenter->medical_examination_center_state }}</td>
                           <td>{{ $medicalexamcenter->medical_examination_center_country }}</td>                   

            
                   <td>
                          <div class="row">
                               <a style="" class="btn btn-sm btn-flat btn-warning" href="{{ route('medicalexaminationcenter.edit',$medicalexamcenter->medical_examination_center_id) }}"><i class="fa fa-edit"></i> </a>



                               <form action="{{ route('medicalexaminationcenter.destroy', $medicalexamcenter->medical_examination_center_id) }}" method="POST" onclick=" return confirm('Are you sure you want to delete this item?')" >
   
                                 @csrf
                                 @method('DELETE') 
                               <button style="" type="submit" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
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
</div>

@endsection