@extends('layouts.admin')

@section('title')
Invoice
@endsection

@section('css')
@endsection




@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title "><i class="fa fa-paw mr-1"></i>Invoice</h3>
            <div class="card-tools">
                <a href="{{ route('invoice.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create Invoice</a>
            </div>
    </div>


    
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
  
        <table class="table table-bordered table-striped " id="example">
            <thead>
                <tr>
                    <th width="10%">Invoice ID</th>
                    <th>Invoice Code</th>
                    <th>Company Name</th>
                    <th>Invoice Date</th>
                    <th>From Date</th>
                    <th>To Date</th>  
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                   @forelse ($invoices as $invoice)
                    <tr>
                         <td>{{$invoice->invoice_id}}</td>
                         <td>{{$invoice->invoice_code}}</td>
                         <td>{{$invoice->company_name}}</td>
                         <td>{{date('d-m-Y',$invoice->invoice_date)}}</td>
                         <td>{{date('d-m-Y',$invoice->from_date)}}</td>
                         <td>{{date('d-m-Y',$invoice->to_date)}}</td>
                       
                       
                   <td>
                    <div class="row">
                        
            <a class="btn btn-sm btn-warning" href="{{route('invoice.show',$invoice->invoice_id)}}"><i class="fa fa-eye"></i></a>&nbsp;

                          <!-- <form action="{{ route('invoice.destroy',$invoice->invoice_id) }}" method="POST" onclick="return confirm(' Are you sure you want to Delete?')">

                             @csrf
                             @method('DELETE') 
                          <button type="submit" class="btn btn-sm btn-danger"  ><i class="fa fa-trash"> </i></button>
                        </form> -->
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