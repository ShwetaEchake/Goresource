<?php
use App\Models\Client;
use App\Models\AssignEnquiryBranch;
?>
@extends('layouts.admin')

@section('title')
Enquiry
@endsection

@section('css')
@endsection




@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title "><i class="fa fa-paw mr-1"></i>
                    Enquiries</h3>
            @if(auth()->user()->user_type!='Executive')
            <!-- <div class="card-tools">
                <a href="{{ route('enquiry.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create Enquiry</a>
            </div> -->
            @endif
     

   

    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
  
        <table class="table  table-hover" id="example">
            <thead>
                <tr>
                         
                         <th>Enquiry Id</th>
                         <th>Company Name</th>
                         <th>Enquiry Title</th>
                         <th>Enquiry Location</th>


                    {{-- <th>Branch Name</th>
                         <th>Contact Period</th>
                         <th>Place of Work</th>
                         <th>Trial Period</th>
                         <th>Air Fare</th>
                         <th>Employment Visa</th>
                         <th>Food</th>
                         <th>Transportation</th>--}}
                       @if(auth()->user()->user_type !='Client')
                         <th>Action</th>
                       @endif
                       
                </tr>
            </thead>
            <tbody>
                   @forelse ($enquiries as $enquiry)
                    <tr>
                        <td>{{ $enquiry->enquiry_id }}</td>
                        <td>
                         <?php $name = Client::where(['client_id'=>$enquiry->client_id])->get()?>
                            @foreach ($name as $data)
                                {{$data->company_name}}
                            @endforeach
                        </td>
                        <td>{{ $enquiry->enquiry_title }}</td>
                        <td></td>


                 {{-- <td>
                         <?php $branch_name = AssignEnquiryBranch::leftjoin('branch','branch.branch_id','=','assign_enquiry_branch.branch_id')->where(['enquiry_id'=>$enquiry->enquiry_id])->get()?>
                             @foreach ($branch_name as $value)
                                {{$value->branch_name}}
                            @endforeach
                        </td>
                        <td>{{ $enquiry->contract_period }}</td>
                         <td>{{ $enquiry->place_of_work }}</td>
                        <td>{{ $enquiry->trial_period }}</td>
                         <td>{{ $enquiry->air_fare }}</td>
                        <td>{{ $enquiry->employment_visa }}</td>
                        <td>{{ $enquiry->food_status }}</td>
                        <td>{{ $enquiry->transportation_status }}</td>--}}

                       
                      
                     

@if(auth()->user()->user_type !='Client')
                      
            <td>
                    <div class="row" style="width:200px;">
                       {{-- <a class="btn btn-sm btn-primary"  href="{{ route('enquiry.show',$enquiry->enquiry_id) }}"><i class="fa fa-eye"></i> </a>&nbsp;--}}

     {{--<a class="btn btn-flat btn-sm btn-primary" title="Pdf"  href="{{url('/mypdf')}}?id={{$enquiry->enquiry_id}}"><i class=" fa fa-file-pdf-o"></i> </a>&nbsp;--}} <!-- mypdfprivious -->


                         <a class="btn btn-flat btn-sm btn-primary" href="{{route('mypdf', $enquiry->enquiry_id)}}"> <i class=" fa fa-file-pdf-o"></i> PDF</a>&nbsp;


                        
                        <a class="btn btn-flat btn-sm btn-warning" href="{{ route('enquiry.edit',$enquiry->enquiry_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;


                        <form action="{{ route('enquiry.destroy',$enquiry->enquiry_id) }}" method="POST" onclick="return confirm(' Are you sure you want to Delete?')">

                            @csrf
                            @method('DELETE') 
                            <button type="submit" class="btn btn-flat btn-sm btn-danger"  ><i class="fa fa-trash-alt"> </i></button>
                        </form>&nbsp;

                    {{-- <a  class="btn btn-sm btn-info" href="{{url('/template')}}?id={{$enquiry->enquiry_id}}"><i class="fa fa-download"></i> </a> --}}

                       <a class="btn btn-flat btn-sm btn-info" href="{{url('/document')}}?id={{$enquiry->enquiry_id}}"><i class="fa fa-download"></i> </a>
                     </div>
            </td>
 @endif

                    </tr>
                @empty
                  <!--   <tr>
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