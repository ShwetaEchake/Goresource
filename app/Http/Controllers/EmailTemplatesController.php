<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplates;
use Illuminate\Http\Request;
use DB;
use Mail;
class EmailTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $emailtemplates=EmailTemplates::all();
       return view('emailtemplate.index',['emailtemplates'=>$emailtemplates]);
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



 // $data = User::all();
 //        $input['subject'] = $this->details['subject'];

 //        foreach ($data as $key => $value) {
 //            $input['email'] = $value->email;
 //            $input['name'] = $value->name;
 //            \Mail::send('emails.test', [], function($message) use($input){
 //                $message->to($input['email'], $input['name'])
 //                    ->subject($input['subject']);
 //            });
 //        }
 //    }


       public function email(Request $request)
    {
        $string = explode(',', $request->candidateidemail);
        $personalemail=DB::table('personal')->select('email')->whereIn('candidate_id',$string)->get();

foreach ($personalemail as $key => $value) {
// print_r($value->email);
// exit();

        $title=DB::table('email_templates')->where('email_template_id',$request->email_title)->first();

    $data=array('email_template'=>$request->email_template,
                'email_title'=>$title->email_title,
                'email'=>$value->email
               );

    Mail::send('emailtemplate.test', $data, function($message) use ($data) {
         $message->to($data['email'])->subject('Testing Mail');
         // $message->from('ankita24gavas@gmail.com');

        });
}
        return redirect()->back()->with('success','Mail Send Successfully');


    }




    public function store(Request $request)
    {

    	$request->validate([
    
       'email_title'=>'required|unique:email_templates|max:255',
            
        ]);

        $emailtemplates= new EmailTemplates();

        $emailtemplates->email_template=$request->email_template;
        $emailtemplates->email_title=$request->email_title;
        $emailtemplates->save();

        return redirect()->route('emailtemplate.index')->with('success','Email Template Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmailTemplates  $emailTemplates
     * @return \Illuminate\Http\Response
     */
    public function show(EmailTemplates $emailTemplates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmailTemplates  $emailTemplates
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $emailtemplate=EmailTemplates::find($id);
        $emailtemplates=EmailTemplates::all();
        return view('emailtemplate.index',['emailtemplate'=>$emailtemplate],compact('emailtemplates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmailTemplates  $emailTemplates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
          $emailtemplate=  EmailTemplates::find($id);
          $emailtemplate->email_template=$request->email_template;
          $emailtemplate->email_title=$request->email_title;
          $emailtemplate->save(); 

        return redirect()->route('emailtemplate.index')->with('success','Email Template Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmailTemplates  $emailTemplates
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emailtemplates = DB::table('email_templates')->where('email_template_id',$id)->delete();
       return redirect()->route('emailtemplate.index')->with('success','Email Template Created Successfully');

    }
}
