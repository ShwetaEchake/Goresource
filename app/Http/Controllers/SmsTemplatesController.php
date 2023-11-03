<?php

namespace App\Http\Controllers;

use App\Models\SmsTemplates;
use Illuminate\Http\Request;
use DB;
class SmsTemplatesController extends Controller
{

    // private $SMS_SENDER = "Sample";
    // private $RESPONSE_TYPE = 'json';
    // private $SMS_USERNAME = 'Your username';
    // private $SMS_PASSWORD = 'Your password';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $smstemplates=SmsTemplates::all();
       return view('smstemplate.index',['smstemplates'=>$smstemplates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

// ----------------SMS Template Start------------------------------

 public function SendSMS(Request $request)
    {

if(request()->isMethod("post")){
        $string=explode(",",$request->candidateidsms);
       
       $canidatemobile=DB::table('personal')->whereIn('candidate_id',$string)->get();
       // print_r($canidatemobile);
       // exit();

       foreach ($canidatemobile as $key => $value) {
           $phone_number = $value->mobile_no;
      
          
          //$sms_title=DB::table('sms_templates')->where('sms_template_id',$request->sms_title)->first();

      
      $to = $phone_number;
      $from = getenv("TWILIO_FROM");
      $message = $request->sms_template;
       //  print_r($message);
       // exit();



      //open connection


              $ch = curl_init();

              //set the url, number of POST vars, POST data
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_USERPWD, getenv("TWILIO_SID").':'.getenv("TWILIO_TOKEN"));
              curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
              curl_setopt($ch, CURLOPT_URL, sprintf('https://api.twilio.com/2010-04-01/Accounts/'.getenv("TWILIO_SID").
              	'/Messages.json', getenv("TWILIO_SID")));
              curl_setopt($ch, CURLOPT_POST, 3);
              curl_setopt($ch, CURLOPT_POSTFIELDS, 'To='.$to.'&From='.$from.'&Body='.$message);

              //execute post
              $result = curl_exec($ch);
              $result = json_decode($result);

              //close connection
              curl_close($ch);

              return [$result];

              // if($result) {
              //  $success = "Message sents";
              //  //echo "send";
              // }else{
              //   $error = "Sent failed";
              //  // echo "not";
              // } 
              // // exit();
    }

     }

        return redirect()->back()->with('success','Sms Send  Successfully');
    }



 
    // ----------------SMS Template End------------------------------




    public function store(Request $request)
    {

        $request->validate([
    
    'sms_title' => 'required|unique:sms_templates|max:255',

          
        ]);


         $smstemplates= new SmsTemplates();

        $smstemplates->sms_template=$request->sms_template;
        $smstemplates->sms_title=$request->sms_title;
        $smstemplates->save();

        return redirect()->route('smstemplate.index')->with('success','Sms Template Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SmsTemplates  $smsTemplates
     * @return \Illuminate\Http\Response
     */
    public function show(SmsTemplates $smsTemplates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SmsTemplates  $smsTemplates
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $smstemplate=SmsTemplates::find($id);
        $smstemplates=SmsTemplates::all();
        return view('smstemplate.index',['smstemplate'=>$smstemplate],compact('smstemplates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SmsTemplates  $smsTemplates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $smstemplate=  SmsTemplates::find($id);
          $smstemplate->sms_template=$request->sms_template;
          $smstemplate->sms_title=$request->sms_title;
          $smstemplate->save(); 

      return redirect()->route('smstemplate.index')->with('success','SmsTemplate Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SmsTemplates  $smsTemplates
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $smstemplates = DB::table('sms_templates')->where('sms_template_id',$id)->delete();
       return redirect()->route('smstemplate.index')->with('success','Sms Template Created Successfully');

    }
}
