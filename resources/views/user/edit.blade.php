@extends('layouts.admin')

@section('title')
Update User
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit User</h3>
        <div class="card-tools">
                <a href="{{ route('user.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Warning!</strong> Please check input field code<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.update',$user->id) }}">
        @csrf
         @method('PUT')
        <div class="card-body">
            <div class="form-group">


            <div class="row">
                    <div class="col-lg-6">
                    <label> Name </label>
                    <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" required placeholder="Name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                   <div class="col-lg-6">
                    <label> Email </label>
                    <input type="email" name="email"  id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" required placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                     </div>
              </div><br>


         <div class="row">
                <div class="col-lg-6">
                <label> Phone </label>
                <input type="number" name="phone"  id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" required placeholder="Phone">
                @error('Phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="col-lg-6">
                <label> Password </label>
                <input type="password" name="password"  id="password" class="form-control @error('password') is-invalid @enderror" value="{{ $user->password }}" required placeholder="Password">
                @error('Password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
               </div>
        </div><br>

          <div class="row">
                <div class="col-lg-6">
                <label >User Type</label>
                     <select class="form-control select2" name="user_type" id="user_type"  required>
                          <option value="">-select-</option>
                          @foreach ($roles as $data)
                               <option value="{{ $data->title }}" {{ $data->id == $user->user_type ?  'selected' : '' }}>{{$data->title}}</option>
                          @endforeach
                    </select>  
                </div>

                <div class="col-lg-6">
                <label> OTP </label>
                <input type="number" name="otp"  id="otp" class="form-control @error('otp') is-invalid @enderror" value="{{ $user->otp }}" required placeholder="otp">
                @error('otp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
               </div>
        </div>



          
            </div>
            </div>
             <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update </button>
        </div>
       

       
    </form>
</div>
@endsection
