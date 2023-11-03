<?php
use App\Models\Enquiry;
use App\Models\Client;
use App\Models\AssignEnquiryBranch;
?>
@extends('layouts.admin')

@section('title')
Advertisment
@endsection

@section('css')
@endsection




@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title "><i class="fa fa-paw mr-1"></i>
                    Addvertisments</h3>

           <!--  <div class="card-tools">
                <a href="{{ route('advertisment.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create Advertisment</a>
            </div> -->
     

   

    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
  
        <table class="table table-hover" id="example">
            <thead>
                <tr>
                         
                        <th>Enquiry</th>
                        <th>Enquiry Title</th>
                        <th>Company Name</th>
                        <th>Branch Name</th>
                        <th>Action</th>
                       
                </tr>
            </thead>
            <tbody>
                   @forelse ($enquiries as $enquiry)
                    <tr>
                              <td>{{ $enquiry->enquiry_id }}</td>
                              <td>{{$enquiry->enquiry_title}}</td>
                       <td>
                         <?php $name = Client::where(['client_id'=>$enquiry->client_id])->get()?>
                             @foreach ($name as $data)
                                {{$data->company_name}}
                            @endforeach
                         </td>
                     
                       
                           <td>
                         <?php $branch_name = AssignEnquiryBranch::leftjoin('branch','branch.branch_id','=','assign_enquiry_branch.branch_id')->where(['enquiry_id'=>$enquiry->enquiry_id])->get()?>
                             @foreach ($branch_name as $value)
                                {{$value->branch_name}}
                            @endforeach
                         </td>
                     

                      
                        <td>

                    <div class="row">


                     <a class="btn btn-flat btn-sm btn-warning" title="Addvertise Download"  href="{{url('/add')}}?id={{$enquiry->enquiry_id}}"><i class=" fa fa-download"></i> </a>&nbsp;
                 

                   <a href="{{url('/advertisment/create')}}?enquiryid={{$enquiry->enquiry_id}}&clientid={{$enquiry->client_id}}" class="btn btn-flat btn-sm btn-primary" title="Addvertise create"><i class="fa fa-ad"></i> Addvertise</a>



                   {{--<a href="{{url('/advertisment/create')}}?enquiryid={{$enquiry->enquiry_id}}&clientid={{$enquiry->client_id}}&jobid={{$enquiry->job_id}}&branchid={{$enquiry->branch_id}}" class="btn btn-sm btn-primary"><i class="fa fa-ad"></i>Addvertise</a>--}}

                       {{-- <a class="btn btn-sm btn-primary"  href="{{ route('advertisment.show',$advertisment->advertisment_id) }}"><i class="fa fa-eye"></i> </a>&nbsp;
                       <a class="btn btn-sm btn-warning" href="{{ route('advertisment.edit',$advertisment->adv_id) }}"><i class="fa fa-edit"></i> </a>&nbsp;
                        <form action="{{ route('advertisment.destroy',$advertisment->adv_id) }}" method="POST" onclick="return confirm(' Are you sure you want to Delete?')">
                            @csrf
                            @method('DELETE') 
                        <button type="submit" class="btn btn-sm btn-danger"  ><i class="fa fa-trash-alt"> </i></button>
                        </form>--}}

                    </div>
                        
                           

                        </td>

                    </tr>
                @empty
                    <!-- <tr>
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