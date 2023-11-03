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
    </div>

    <!-- /.card-header -->

    <div class="card-body table-responsive"  id="printMe">

    <button class="btn  btn-flat btn-primary" id="hide-print" style="margin-left:90%;"onclick="printReport('printMe')">
                  <i class="fa fa-print" aria-hidden="true"></i> Print</button>

<?php 
  $rowdata='';$totaldata='';
  $total = 0;
                      
                    foreach($InvoiceArray as $invoicedetail){
                        $invoiceDATA =explode('_',$invoicedetail);
                            $remark=$invoiceDATA[5];
                            $invoice_date=$invoiceDATA[6];$from_date=$invoiceDATA[7]; $to_date=$invoiceDATA[8];  
                            $company_name=$invoiceDATA[9];$client_address=$invoiceDATA[10]; $client_officeno=$invoiceDATA[11];  
                            $invoice_code=$invoiceDATA[12]; $invoice_commission=$invoiceDATA[13];
                        $total += $invoiceDATA[4];
                    
                $rowdata.=' <tr>
                                <td>'.$invoiceDATA[0].' </td>
                                <td>'.$invoiceDATA[1].'</td>
                                <td>'.$invoiceDATA[2].'</td>
                                <td class="text-right">'.$invoiceDATA[3].'</td>
                                <td class="text-right">'.number_format($invoiceDATA[4]/$invoiceDATA[3]).'</td>
                                <td class="text-right">'.number_format($invoiceDATA[4]).' </td>
                            </tr>';
                        }
                  
                $totaldata='<tr>
                               <td colspan="5" class="text-right">Sub total</td>
                               <td class="text-right">'.number_format($total,2) .'</td>
                            </tr>
                            <tr>
                             <td colspan="5" class="text-right">Commision ('.$invoice_commission.' %)</td>
                             <td class="text-right" >'.number_format(($total*$invoice_commission)/100,2).' </td>
                           </tr>
                           <tr>
                             <th colspan="5" class="text-right">TOTAL</th>
                             <th class="text-right">'.number_format(((($total*$invoice_commission)/100)+$total),2).'</th>
                            </tr>';

?>

    
            <center><img src="{{asset('img/GoLogo.png')}}"></center>  <br>
        <div class="company-address">
          <center><span> Goresource.</span><br>
              604 - 170, HARGRAVE ST., <br>
              WINNIPEG R3C 3H4, MB - CANADA <br>
              Email : info@goresources.ca <br>
              Office Tel : + 1 204 416 8056</center>
        </div>
              <div class="invoice-details">
                    Invoice :   {{$invoice_code}}<br />
                    Date :      {{ date('d-m-Y',$invoice_date)}}  <br>
                    From Date : {{ date('d-m-Y',$from_date)}} <br>
                    To Date :   {{ date('d-m-Y',$to_date)}} 
             </div>  
  
            <div class="customer-address">
                To:
                <br />
                {{ $company_name}}
                <br />
                {{ $client_address}}
                <br />
                 Office no:{{ $client_officeno}}
                <br />
            </div>

       
        
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
                 <?php echo $rowdata. "". $totaldata; ?>
                </tbody>  
            </table><br>


            <div class="row"> 
                <div class="col-lg-9" >
                  <label >Invoice Remark :</label>
                  {{$remark}}
                </div>
            </div>
             

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