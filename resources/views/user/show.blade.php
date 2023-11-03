@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
       User Show
    </div>

    <div class="card-body">
        <div class="form-group">
            
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                           ID
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Email
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>

                     <tr>
                        <th>
                           Phone
                        </th>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                          User Type
                        </th>
                        <td>
                              <span class=" badge-info">{{ $user->user_type }}</span>
                        </td>
                    </tr>

        
                
                   {{-- <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info" >{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>--}}
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('user.index') }}">
                   Back to List
                </a>
            </div>
        </div>
    </div>
</div>



@endsection