<?php
use App\Models\Client;
use App\Models\Enquiry;
use App\Models\Personal;

?>
@extends('layouts.admin')

@section('title')
selection
@endsection

@section('css')
@endsection




@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title "><i class="fa fa-paw mr-1"></i>
                    selection</h3>

            <div class="card-tools">
                <a href="{{ route('selection.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create selection</a>
            </div>
     

   

    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
  
        <table class="table table-hover" id="example">
            <thead>
                <tr>
                        <th>Candidate</th>
                        <th>Company  </th>
                        <th>Enquiry</th>
                    
                      
                        <th>Action</th>
                       
                </tr>
            </thead>
            <tbody>
                   @forelse ($selections as $selection)
                    <tr>
                       
                      
                         

                          <td>
                         <?php $name = Personal::where(['candidate_id'=>$selection->candidate_id])->get()?>
                             @foreach ($name as $data)
                                {{$data->name}}
                            @endforeach
                         </td>

                         <td>
                         <?php $name = Client::where(['client_id'=>$selection->client_id])->get()?>
                             @foreach ($name as $data)
                                {{$data->company_name}}
                            @endforeach
                         </td>

                           <td>
                         <?php $name = Enquiry::where(['enquiry_id'=>$selection->enquiry_id])->get()?>
                             @foreach ($name as $data)
                                {{$data->enquiry_title}}
                            @endforeach
                         </td>


                      
                     

                      
                        <td>

                    <div class="row">
                       {{-- <a class="btn btn-sm btn-primary"  href="{{ route('selection.show',$selection->selection_id) }}"><i class="fa fa-eye"></i> </a>&nbsp;--}}
                        
                       <a class="btn btn-sm btn-warning" href="{{ route('selection.edit',$selection->selection_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;


                        <form action="{{ route('selection.destroy',$selection->selection_id) }}" method="POST" onclick="return confirm(' Are you sure you want to Delete?')">

                            @csrf
                            @method('DELETE') 
                        <button type="submit" class="btn btn-sm btn-danger"  ><i class="fa fa-trash-alt"> </i></button>
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