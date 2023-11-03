@extends('layouts.admin')

@section('title')
Update Invoice
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit</h3>
        <div class="card-tools">
                <a href="{{ route('invoice.index') }}" class="btn btn-danger"><i class="fa fa-shield-alt"></i> Back</a>
        </div>
    </div>
      <form method="POST" action="{{ route('invoice.update',$invoice->invoice_id) }}" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                 


               <div class="row">

                <div class="col-lg-4">
                  <label>Company Name</label>
                <select class="form-control select2" name="client_id" id="client_id"  required>
                              <option value="">-select-</option>
                              @foreach ($client as $data)
                              <option value="{{ $data->client_id }}" {{ $data->client_id == $invoice->client_id ?  'selected' : '' }}>{{$data->company_name}}</option>
                              @endforeach
                </select>  
                </div>

                <!--    <div class="col-lg-4">
                <label> Invoice Code </label>
                <input type="text" name="invoice_code"  id="invoice_code" class="form-control @error('invoice_code') is-invalid @enderror" value="{{ $invoice->invoice_code }}" required >
                @error('invoice_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div> -->


               </div><br>


 
       <div class="row">
            
                <div class="col-lg-4">
                <label> Invoice Date </label>
                <input type="date" name="invoice_date"  id="invoice_date" class="form-control @error('invoice_date') is-invalid @enderror" value="{{ date('Y-m-d',$invoice->invoice_date) }}" required >
                @error('invoice_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label>  From Date  </label>
                <input type="date" name="from_date"  id="from_date" class="form-control @error('from_date') is-invalid @enderror" value="{{ date('Y-m-d',$invoice->from_date) }}"  required >
                @error('from_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="col-lg-4">
                <label> To Date</label>
                <input type="date"  name="to_date"  id="to_date" class="form-control @error('to_date') is-invalid @enderror" value="{{ date('Y-m-d',$invoice->to_date) }}" required >
                @error('to_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
             
     </div> <br>


       <div class="row">

               <!-- <div class="col-lg-4">
                <label> Amount</label>
                <input type="text"  name="amount"  id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ $invoice->amount }}" required >
                @error('amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

            
                <div class="col-lg-4">
                <label> Invoice Status </label>
                <input type="text" name="invoice_status"  id="invoice_status" class="form-control @error('invoice_status') is-invalid @enderror" value="{{ $invoice->invoice_status  }}" required >
                @error('invoice_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div> -->

                <div class="col-lg-4">
                <label>  Invoice Remark  </label>
                <textarea type="text" name="invoice_remark"  id="invoice_remark" class="form-control @error('invoice_remark') is-invalid @enderror" value="" rows="5"  required >{{$invoice->invoice_remark }}</textarea>
                @error('invoice_remark')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
             
     </div> <br>


<!-- ------------------------------Education Start--------------------------- -->
<h4> Invoice Detail :</h4>

<div class="panel panel-footer">
    <table class="table table-responsive table-bordered" id="dynamicAddRemove">
        <thead>
                <tr>
                    <th></th>
                    <th>Category</th>
                    <th>Candidate Quantity</th>
                    <th>Gross Salary</th>
                    <th>Total</th>
                                   

                     <th><a href="javascrip:" class="btn btn-sm btn-success addInvoice"><i class="fa fa-plus"></i> </a></th>
                </tr>
        </thead>

        <tbody id="invoice">
            @foreach($invoice_detail as $invoice_details)
            <tr>
                <td> <input type="hidden" name="invoice_detail_id[]" value="{{$invoice_details->invoice_detail_id}}"></td>
                <td>
                    <input type="" name="category[]" value="{{$invoice_details->category}}" class="form-control">
                     <!-- <select class="form-control" name="category[]" id="category" required>
                                <option value="">-Select-</option>
                                @foreach ($categories as $data)
                                <option value="{{ $data->category_id  }}">{{ $data->category_name }}</option>
                                @endforeach
                    </select>  <br> -->
                </td>
                <td><input type="text" name="candidate_quantity[]" value="{{$invoice_details->candidate_quantity}}" class="form-control" ></td>
                <td><input type="text" name="gross_salary[]" value="{{$invoice_details->gross_salary}}"  class="form-control" ></td>
                <td><input type="text" name="total[]" value="{{$invoice_details->total}}"  class="form-control" ></td>
                <td><a href="javascrip:" class="btn btn-sm btn-danger removeInvoice disabled"><i class="fa fa-remove"></i></a></td>
            <tr>
            @endforeach
        </tbody>

   <!--      <tfoot>
            <tr>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td>Total</td>
                <td><input type="submit" name="" value="Submit" class=" btn btn-success"></td>
            </tr>
        </tfoot> -->

             
    </table>
</div><br>
<!-- ------------------------------Education End--------------------------- -->

             </div>
            </div>
             <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update </button>
        </div>
       
        

       
    </form>
</div>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js" defer></script>

<script>

    $(document).ready(function(){
    // --------------------------Education Start-------------------
  $('.addInvoice').on('click',function(){
    addInvoices();
  });

  function addInvoices(){
    var tr='<tr>'+
    '<td><select class="form-control" name="category[]" id="category" required> <option value="">-Select-</option>@foreach ($categories as $data)<option value="{{ $data->category_id  }}">{{ $data->category_name }}</option> @endforeach</select></td>'+
    '<td><input type="text" name="candidate_quantity[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="gross_salary[]" class="form-control" required=""></td>'+
    '<td><input type="text" name="total[]" class="form-control" required=""></td>'+
    '<td><a href="javascrip:" class="btn btn-sm btn-danger removeInvoice"><i class="fa fa-remove"></i></a></td>'
    '<tr>';
    $('#invoice').append(tr);
  };

  $('.removeInvoice').live('click',function () {
        $(this).parent().parent().remove();
  });
// --------------------------Education End-------------------
});
</script>

@stop