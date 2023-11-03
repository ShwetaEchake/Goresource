<?php
use App\Models\Assessment;
use App\Models\Personal;
use App\Models\Interview;
?>
@extends('layouts.admin')

@section('title')
Enrollment
@endsection

@section('css')
@endsection




@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title "><i class="fa fa-paw mr-1"></i>
                    Enrollment</h3>

            <div class="card-tools">
                <a href="{{ route('enrollment.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create Enrollment</a>
            </div>
     

   

    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
  
        <table class="table table-hover" id="example">
            <thead>
                <tr>
                        
                        <th>Assessment </th>
                        <th>Candidate</th>
                        <th>Interview </th>
                        <th>Action</th>
                       
                </tr>
            </thead>
            <tbody>
                   @forelse ($enrollments as $enrollment)
                    <tr>
                       
                      

                         <td>
                         <?php $name = Assessment::where(['assessment_id'=>$enrollment->assessment_id])->get()?>
                             @foreach ($name as $data)
                                {{$data->assessment_type}}
                            @endforeach
                         </td>

                         <td>
                         <?php $name = Personal::where(['candidate_id'=>$enrollment->candidate_id])->get()?>
                             @foreach ($name as $data)
                                {{$data->name}}
                            @endforeach
                         </td>

                            <td>
                         <?php $name = Interview::where(['interview_id'=>$enrollment->interview_id])->get()?>
                             @foreach ($name as $data)
                                {{$data->interview_venu}}
                            @endforeach
                         </td>
                    
                       
                      
                     

                      
                        <td>

                    <div class="row">
                       {{-- <a class="btn btn-sm btn-primary"  href="{{ route('enrollment.show',$enrollment->enrollment_id) }}"><i class="fa fa-eye"></i> </a>&nbsp;--}}
                        
                       <a class="btn btn-sm btn-warning" href="{{ route('enrollment.edit',$enrollment->enrollment_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;


                        <form action="{{ route('enrollment.destroy',$enrollment->enrollment_id) }}" method="POST" onclick="return confirm(' Are you sure you want to Delete?')">

                            @csrf
                            @method('DELETE') 
                        <button type="submit" class="btn btn-sm btn-danger"  ><i class="fa fa-trash"> </i></button>
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