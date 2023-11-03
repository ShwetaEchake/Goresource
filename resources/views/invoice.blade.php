<!-- @extends('layouts.admin')

@section('title')
Addvertismnt
@endsection


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
@section('css')

<style type="text/css">  

   table td, table th{  
        border: 0.5px solid #c6c6c6;  
        padding: 10px;
        font-family: poppins;
        font-size: 14px;
       }  

</style>  
@endsection


@section('content')
<body>
  <table width="100%">
              <tr>
                 <th>Categories</th>
                 <th>Candidate quantity</th>
                 <th>Gross Salary</th>
                 <th>Total</th>
              </tr>
         
              	@foreach($invoices as $invoice)
              	<tr>
                  <td>{{$invoice->category_name}}</td>
                  <td>{{$invoice->candidateQuantity}}</td>
                  <td>{{$invoice->gross_salary}}</td>
                  <td></td>
                 </tr>
                 @endforeach
   </table>
</body>
</html>
@endsection
 -->