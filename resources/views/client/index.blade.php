<?php
use App\Models\User;
?>
@extends('layouts.admin')

@section('title')
Client
@endsection

@section('css')
@endsection




@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title "><i class="fa fa-paw mr-1"></i>
                    Clients</h3>

            <div class="card-tools">
                <a href="{{ route('client.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create Client</a>
            </div>
     

   

    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
  
        <table class="table table-hover" id="example">
            <thead>
                <tr>
                       <th>Client Id</th>
                       <th>Logo</th>
                        <th>User Name</th>
                        <th>Company Name</th>
                    <!--     <th> City</th> -->
                    
                      
                        <th>Action</th>
                       
                </tr>
            </thead>
            <tbody>
                   @forelse ($clients as $client)
                    <tr>
                         <td>{{ $client->client_id }}</td>
                         <td>
                 @if(!empty($client->client_logo))
                    <img src="{{asset('documents/'. $client->folder_path.'/'.$client->client_logo)}}" width="70px;" height="70px;">
                 @else
                    <img src="{{asset('img/no-user.jpg')}}" width="70px;" height="70px;">
                 @endif
                         </td>

                          <td>
                         <?php $name = User::where(['id'=>$client->user_id])->get()?>
                             @foreach ($name as $data)
                                {{$data->name}}
                            @endforeach
                         </td>
                        <td>{{ $client->company_name }}</td>
                        <!-- <td>{{ $client->client_city }}</td> -->
                       
                      
                     

                      
                        <td>

                    <div class="row">
                       {{-- <a class="btn btn-sm btn-primary"  href="{{ route('client.show',$client->client_id) }}"><i class="fa fa-eye"></i> </a>&nbsp;--}}


               

                     <a href="{{url('/enquiry/create')}}?clientid={{$client->client_id}}" class="btn btn-sm btn-flat btn-info">
                        <i class="fa fa-plus-circle"></i> Create Enquiry</a>&nbsp;

           
                        
                       <a class="btn btn-sm btn-flat  btn-warning" href="{{ route('client.edit',$client->client_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;


                        <form action="{{ route('client.destroy',$client->client_id) }}" method="POST" onclick="return confirm(' Are you sure you want to Delete?')">

                            @csrf
                            @method('DELETE') 
                        <button type="submit" class="btn btn-sm btn-flat  btn-danger"  ><i class="fa fa-trash-alt"> </i></button>
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
    <!-- /.card-body -->
  </div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    var table = $('#example').DataTable({
       orderCellsTop: true,
       fixedHeader: true 
    });

    //Creamos una fila en el head de la tabla y lo clonamos para cada columna
    $('#example thead tr').clone(true).appendTo( '#example thead' );

    $('#example thead tr:eq(1) th').each( function (i) {
        var title = $(this).text(); //es el nombre de la columna
          if (title != 'Action') {
        $(this).html( '<input type="text" placeholder="'+title+'" class="form-control" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        });
    }
    } );   
});
</script> 
@stop