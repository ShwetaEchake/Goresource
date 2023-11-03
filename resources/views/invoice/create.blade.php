@extends('layouts.admin')

@section('title')
INVOICE
@endsection

@section('css')
<style type="text/css">
    table, th, td {
    border: 0.5px solid #c6c6c6;  
}

div.company-address span{
           /*border:1px solid #ccc;*/
            text-align: center;
            font-weight: bolder;
            /*width:200pt;*/
        }
        
        div.invoice-details {
            /*border:1px solid #ccc;*/
            float:right;
            /*width:200pt;*/
        }
        
        div.customer-address {
            /*border:1px solid #ccc;*/
            float:left;
            margin-bottom:50px;
           /* margin-top:100px;
            width:200pt;*/
        }

 @media print {
  #hide-print{
    display: none;
  }

</style>
@endsection




@section('content')
<div class="card">
    <div class="card-header">
       <h3 class="card-title" style=""><i class="fa fa-file"></i> Invoice</h3>
      
<br><hr>
    <form  action="" method="GET">
                    <div class="row">
                            <div class="col-lg-3">
                              <label>Company Name</label>
                                <select class="form-control select2" name="client_id" id="client_id" required>
                                  <option value="">-select-</option>
                                  @foreach ($client as $data)
                                  <option value="{{ $data->client_id }}">{{ $data->company_name }}</option>
                                  @endforeach
                                </select>  
                            </div>
                              <div class="col-lg-3">
                                   <label> Invoice Date </label>
                                    <input type="date" name="invoice_date"  id="invoice_date" class="form-control @error('invoice_date') is-invalid @enderror" value="{{ date('Y-m-d') }}"  >
                                    @error('invoice_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>

                            <div class="col-lg-3">
                                <label>  From Date  </label>
                                <input type="date" name="from_date"  id="from_date" class="form-control @error('from_date') is-invalid @enderror" value="{{ old('from_date')  }}"  required >
                                @error('from_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                 <label> To Date</label>
                                <input type="date"  name="to_date"  id="to_date" class="form-control @error('to_date') is-invalid @enderror" value="{{ old('to_date') }}" required >
                                @error('to_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      </div><br>

                       <div class="row">
                           <div class="col-lg-3">
                               <button type="submit"  id="box" class="btn btn-primary" ></i> Search </button>
                           </div>
                      </div>
   </form>
</div>

    <!-- /.card-header -->

    <div class="card-body table-responsive"  id="printMe">
 <?php if(isset($_GET["client_id"])){ ?>
    <button class="btn  btn-flat btn-primary" id="hide-print" style="margin-left:90%;"onclick="printReport('printMe')">
                  <i class="fa fa-print" aria-hidden="true"></i> Print</button>




    <form action="{{route('invoice.store')}}" method="POST">
        @csrf
            <center><img src="{{asset('img/GoLogo.png')}}"></center>  <br>
        <div class="company-address">
            <center><span> Goresource.</span><br>
              604 - 170, HARGRAVE ST., <br>
              WINNIPEG R3C 3H4, MB - CANADA <br>
              Email : info@goresources.ca <br>
              Office Tel : + 1 204 416 8056
        </center>
        </div>
        <?php     
         $invoice=DB::table('invoice')->orderBy('invoice_id','desc')->first();
      if(!empty($invoice)){
        $bill_no=$invoice->bill_no+1;
      }else{
        $bill_no=1;
      }
      ?>
        <div class="invoice-details">
            Invoice : <?php echo ' I /'.$bill_no; ?>
            <br />
                    Date : <?php if(!empty($_GET['invoice_date'])){
                                    $invoicedate= date('d-m-Y',strtotime($_GET['invoice_date'])); }
                                 else{ $invoicedate=''; } ?>
                                    {{ $invoicedate}}<br>

                    From Date : <?php if(!empty($_GET['from_date'])){
                                         $fromdate= date('d-m-Y',strtotime($_GET['from_date'])); }
                                     else{ $fromdate=''; } ?>
                                         {{ $fromdate}}<br>

                     To Date : <?php if(!empty($_GET['to_date'])){
                                        $todate= date('d-m-Y',strtotime($_GET['to_date'])); }
                                     else{ $todate=''; } ?>
                                        {{ $todate}}
        </div>
  
<?php if(!empty($_GET['client_id'])){ ?>
      <?php $clientDetail= DB::table('client')->where('client_id',$_GET['client_id'])->first();?>
            <div class="customer-address">
                To :
                <br />
                {{ $clientDetail->company_name}}
                <br />
                {{ $clientDetail->client_address}}
                <br />
                 Office no : {{ $clientDetail->client_officeno}}
                <br />
            </div>
 <?php } ?>

       
        
<br><br><br>
           <table class="table table-hover">
            
                <thead>
                    <tr>   
                        <th>Enquiry Title</th>
                        <th>Location Name</th>
                        <th>Category Name</th>
                        <th>Candidate Quantity</th>
                        <th>Gross Salary</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php  $total = 0; $vat = $clientDetail->commission; ?>
                       <input type="hidden" name="client_id" value="{{ $_GET['client_id']; }}">
                       <input type="hidden" name="invoice_date" value="{{ $_GET['invoice_date']; }}">
                       <input type="hidden" name="from_date" value="{{ $_GET['from_date']; }}">
                       <input type="hidden" name="to_date" value="{{ $_GET['to_date']; }}"><br>
                       @forelse ($invoiceReport as $invoicedetail)
                       <?php $total += $invoicedetail->Total; ?>
                        <tr>
                            <td>{{ $invoicedetail->enquiry_title}}
                             <input type="hidden"   name="enquirytitle[]" value="{{$invoicedetail->enquiry_title}}">
                            </td>
                            <td>{{ $invoicedetail->client_location_code}}
                              <input type="hidden"   name="clientlocationcode[]" value="{{ $invoicedetail->client_location_code}}">
                             </td>
                            <td>{{ $invoicedetail->category_name}}
                             <input type="hidden"   name="categoryname[]" value="{{ $invoicedetail->category_name}}">
                            </td>
                            <td class="text-right">{{ $invoicedetail->Quantity }}
                              <input type="hidden"   name="candidatequantity[]" value="{{ $invoicedetail->Quantity }}">
                           </td>
                            <td class="text-right"> {{number_format($invoicedetail->Total/ $invoicedetail->Quantity) }}
                               <input type="hidden"   name="grosssalary[]" value="  {{($invoicedetail->Total/ $invoicedetail->Quantity) }}"> 
                           </td>
                            <td class="text-right">{{ number_format($invoicedetail->Total) }}
                             <input type="hidden"   name="total[]" value="{{ ($invoicedetail->Total) }}">
                           </td>
                        </tr>
                    @empty
                      <!--   <tr>No Result Found</tr> -->
                    @endforelse
                          <tr>
                            <td colspan="5" class="text-right">Sub total</td>
                            <td class='text-right'>{{ number_format($total,2) }}</td>
                          </tr>
                          <tr>
                            <td colspan="5" class="text-right">Commision ({{ $vat}}%) </td>
                            <td class='text-right' >{{ number_format(($total*$vat)/100,2)    }}</td>
                          </tr>
                           <tr>
                            <th colspan="5" class="text-right">TOTAL</th>
                            <th class='text-right'>{{number_format(((($total*$vat)/100)+$total),2)}}</th>
                           </tr>
                </tbody>
                
            </table><br>

            <div class="row"> 
                <div class="col-lg-9">
                  <label>Invoice Remark</label>
                  <textarea type="text" name="invoice_remark" class="form-control" required ></textarea>
                </div>
            </div>
             <button type="submit" class="btn btn-flat btn-primary float-right" id="hide-print">Save Invoice</button>
             </form> 
              <?php } ?>

    </div>
    <!-- /.card-body -->


  </div>
@endsection

@section('js')
 <script src="{{asset('plugins/select2/js/select2.full.min.js')}}" defer> </script>
 <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js" defer></script>

<script type="text/javascript">


$(document).ready(function(){
    $('#client_id').select2();
  });

function printReport(divName){
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;

    }

</script>



@stop