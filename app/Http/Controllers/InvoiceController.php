<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Invoice;
use App\Models\InvoiceDetail;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // public function soa(){
     //    return view('invoice.index',compact('$data'));
     // }


    public function create(Request $request)
    {


    if(!empty($_GET['client_id'])){
         $client_id=$_GET['client_id'];
    }else{
          $client_id='';
    }
      if(!empty($_GET['from_date'])){
         $from_date=$_GET['from_date'];
    }else{
          $from_date='';
    }
      if(!empty($_GET['to_date'])){
         $to_date=$_GET['to_date'];
    }else{
          $to_date='';
    }

//  $invoiceReport= DB::select(DB::raw("SELECT enquiry_title, jobs.job_main_category_id, category_name,count(job_applied.candidate_id) as Quantity,sum(gross_salary) as Total from job_applied
// left join jobs ON jobs.job_id =job_applied.job_id
// left join categories ON categories.category_id =jobs.job_main_category_id
// left join enquiry ON enquiry.enquiry_id =job_applied.enquiry_id
// left join deployment_process ON deployment_process.job_id =job_applied.job_id
// WHERE   current_status ='deployment' AND jobs.client_id='".$client_id."' 
//  AND deployment_process.created_at BETWEEN  '".$from_date."'   AND '".$to_date."' 
// group by job_main_category_id,job_applied.enquiry_id,job_applied.job_id"));

$invoiceReport=DB::select(DB::raw("SELECT D.job_id,D.enquiry_id,D.location_id,count(*) as Quantity,C.category_name,E.enquiry_title,L.client_location_code,sum(gross_salary) as Total
FROM `deployment_process` D 
LEFT JOIN jobs J ON J.job_id=D.job_id 
LEFT JOIN categories C ON C.category_id=J.job_main_category_id 
LEFT JOIN enquiry E ON E.enquiry_id=D.enquiry_id
LEFT JOIN client_location L ON D.location_id=L.client_location_id
WHERE   D.client_id='".$client_id."' 
 AND date_format(D.created_at, '%Y-%m%-%d')  BETWEEN  '".$from_date."'   AND '".$to_date."' 
GROUP BY D.enquiry_id,D.location_id,D.job_id"));



    $client=DB::table('client')->get();
    $invoices=DB::table('invoice')->get();
     return view('invoice.create',compact('invoices','client','invoiceReport'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['client']=DB::table('client')->get();
        $data['categories']=DB::table('categories')->get();
        $data['invoices']=DB::table('invoice')
        ->leftjoin('client','client.client_id','=','invoice.client_id')->get();
       return view('invoice.index',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

// echo "<pre>";
// print_r($_REQUEST);
// echo "</pre>";

// //return $request;
// exit();
        $invoice=Invoice::orderBy('invoice_id','desc')->first();
      if(!empty($invoice)){
        $bill_no=$invoice->bill_no+1;
      }else{
        $bill_no=1;
      }

        $invoice=new Invoice();
        $invoice->client_id =$request->client_id ;
        $invoice->bill_no =$bill_no;
        $invoice->invoice_code = 'I / '.$bill_no;
        $invoice->invoice_date =strtotime($request->invoice_date) ;
        $invoice->from_date =strtotime($request->from_date) ;
        $invoice->to_date =strtotime($request->to_date) ;
       // $invoice->amount=$request->amount;
        $invoice->invoice_status =$request->invoice_status;
        $invoice->invoice_remark=$request->invoice_remark ;
        $invoice->save();

        foreach($request->categoryname as $key=>$categoryname) {
            $invoice_detail= new InvoiceDetail();
             $invoice_detail->invoice_id = $invoice->invoice_id;
            $invoice_detail->category=$request->categoryname[$key];
            $invoice_detail->candidate_quantity=$request->candidatequantity[$key];
            $invoice_detail->gross_salary=$request->grosssalary[$key];
            $invoice_detail->total=$request->total[$key];
            $invoice_detail->save();
        }

        return redirect()->route('invoice.index')->with('success','Invoice Created Successfully');

     }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
       /* $invoiceReports=DB::table('invoice_detail')
        ->leftjoin('invoice','invoice.invoice_id','=','invoice_detail.invoice_id')
        ->leftjoin('client','client.client_id','=','invoice.client_id')
        ->leftjoin('enquiry','enquiry.client_id','=','client.client_id')
        ->leftjoin('client_location','client_location.client_id','=','client.client_id')
        ->where('invoice.invoice_id',$invoice->invoice_id)
        ->get();

            // echo "<pre>";
            // print_r($reports);
            // echo "<pre>";
       */     
 $datename=  DB::table('invoice')
 ->leftjoin('client','client.client_id','=','invoice.client_id')
 ->where('invoice_id',$invoice->invoice_id)->first();

$invoiceReports=DB::select(DB::raw("SELECT D.job_id,D.enquiry_id,D.location_id,count(*) as Quantity,C.category_name,E.enquiry_title,L.client_location_code,sum(gross_salary) as Total
FROM `deployment_process` D 
LEFT JOIN jobs J ON J.job_id=D.job_id 
LEFT JOIN categories C ON C.category_id=J.job_main_category_id 
LEFT JOIN enquiry E ON E.enquiry_id=D.enquiry_id
LEFT JOIN client_location L ON D.location_id=L.client_location_id
WHERE   D.client_id='".$datename->client_id."' 
AND date_format(D.created_at, '%Y-%m%-%d')  BETWEEN '".date('Y-m-d',$datename->from_date)."' AND '".date('Y-m-d',$datename->to_date)."' 
GROUP BY D.enquiry_id,D.location_id,D.job_id"));


        $InvoiceArray=[];
        foreach($invoiceReports as $reports){
            $InvoiceArray[] =  $reports->enquiry_title."_".$reports->client_location_code."_".
                $reports->category_name."_".$reports->Quantity."_".$reports->Total."_".$datename->invoice_remark."_".$datename->invoice_date."_".$datename->from_date."_".$datename->to_date."_".$datename->company_name."_".$datename->client_address."_".$datename->client_zipcode."_".$datename->invoice_code."_".$datename->commission;
        } 


         return view('invoice.show',compact('invoiceReports','InvoiceArray'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
          $invoice= Invoice::find($id);
          $data['client']=DB::table('client')->get();
          $data['categories']=DB::table('categories')->get();
          $data['invoice_detail']=DB::table('invoice_detail')->where('invoice_id',$invoice->invoice_id)->get();
          return view('invoice.edit',$data,compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoice=Invoice::find($id);
        $invoice->client_id =$request->client_id ;
        $invoice->invoice_code =$request->invoice_code;
        $invoice->invoice_date =strtotime($request->invoice_date) ;
        $invoice->from_date =strtotime($request->from_date) ;
        $invoice->to_date =strtotime($request->to_date) ;
        $invoice->amount=$request->amount;
        $invoice->invoice_status =$request->invoice_status;
        $invoice->invoice_remark=$request->invoice_remark ;
        $invoice->save();


        if(isset($request->invoice_detail_id)){
            foreach ($request->invoice_detail_id as  $key => $invoice_detail_id) {
                if($invoice_detail_id!=''){
                    $invoice_detailUpdate=array(
                                          'category'=> $request->category[$key],
                                          'candidate_quantity'=> $request->candidate_quantity[$key],
                                          'gross_salary'=> $request->gross_salary[$key],
                                          'total'=> $request->total[$key],
                                          );
                    $invoice_details=InvoiceDetail::where('invoice_detail_id',$invoice_detail_id)->first();
                    $invoice_details->update($invoice_detailUpdate);
                }else{
                            $invoice_detail= new InvoiceDetail();
                            $invoice_detail->category=$request->category[$key];
                            $invoice_detail->candidate_quantity=$request->candidate_quantity[$key];
                            $invoice_detail->gross_salary=$request->gross_salary[$key];
                            $invoice_detail->total=$request->total[$key];
                            $invoice_detail->save();
                     }
   }///end of for
 }




        return redirect()->route('invoice.index')->with('success','Invoice Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
