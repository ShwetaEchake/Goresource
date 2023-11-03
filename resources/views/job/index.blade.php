<?php
use App\Models\Enquiry;
use App\Models\Client;
use App\Models\Category;

?>

@extends('layouts.admin')

@section('title')
Job
@endsection

@section('css')
@endsection




@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title "><i class="fa fa-paw mr-1"></i>
                    Jobs</h3>

     <!--        <div class="card-tools">
                <a href="{{ route('job.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create Job</a>
            </div> -->
     

   

    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
  
        <table class="table table-bordered table-striped " id="example">
            <thead>
                <tr>
                        <th>ID</th>
                        <th>Job Id</th>
                        <th>Enquiry</th>
                        <th>Client</th>
                        <th>Main Category</th>
                        <th>Location Name</th>
                        <th>Project Location</th>
                        <th>Basic Salary</th>
                        <th>Cola </th>
                        <th>Food </th>
                        <th>Transportation </th>
                       <th>Accomodation </th>
                       <th>Medical </th>
                       <th>Overtime </th>
                       
                </tr>
            </thead>
            <tbody>
                   @forelse ($jobs as $index => $job)
                    <tr>
                         <td>{{++$index}}</td>
                         <td>{{$job->job_id}}</td>
                         <td>{{$job->enquiry_title}}</td>
                         <td>{{$job->company_name}}</td>
                         <td>{{$job->category_name}}</td>
                         <td>{{$job->client_location_name}}</td>
                         <td>{{$job->required_position}}</td>
                         <td>{{$job->basic_salary}}</td>
                         <td>{{$job->cola_allownces}}</td>
                         <td>{{$job->food_allownce}}</td>
                        <td>{{$job->transportation_allownce}}</td>
                        <td>{{$job->accomodation_allownce}}</td>
                        <td>{{$job->medical_allownce}}</td>
                        <td>{{$job->overtime_allownce}}</td>
                       
                      
                    {{-- <td>
                   <div class="row">
                          <a class="btn btn-sm btn-primary"  href="{{ route('job.show',$job->job_id) }}"><i class="fa fa-eye"></i> </a>&nbsp;
                        
                          <a class="btn btn-sm btn-warning" href="{{ route('job.edit',$job->job_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;

                          <form action="{{ route('job.destroy',$job->job_id) }}" method="POST" onclick="return confirm(' Are you sure you want to Delete?')">

                             @csrf
                             @method('DELETE') 
                          <button type="submit" class="btn btn-sm btn-danger"  ><i class="fa fa-trash"> </i></button>
                        </form>
                   </div>
                        </td>--}} 

                    </tr>
                @empty
                 <!--    <tr>
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