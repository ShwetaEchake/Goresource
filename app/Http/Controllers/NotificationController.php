<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use DB;
class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('firebase');
    }





    public function saveToken(Request $request)
    {
        auth()->user()->update(['device_token'=>$request->token]);
        return response()->json(['token saved successfully.']);
    }


     public function sendNotification(Request $request)
    {
      // $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        //    print_r($firebaseToken);
        // exit();

      $request->validate([
            'title' => 'required|string',
            'detail' => 'required',

        ]);

        $notification = new Notification();
      
        $notification->title = $request->title;
        $notification->detail = $request->detail;

           if($request->hasfile('image')){
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time() .'.' .$extension;
            $file->move('media/image',$filename);
            $notification->image=$filename;
        }else{
          //  return $request;
            $notification->image="";
        }

        $notification->save();


     $fcm_registration_ids = DB::table('fcm_registration_ids')
        ->select('fcmid')
        ->get();

          $data = [];
        foreach ($fcm_registration_ids as  $value) {
        //echo $value->fcmid;
            array_push($data,$value->fcmid);
         }



        if($request->hasfile('image')){
              $Imgname=asset('media/image/' . $filename);
         }else{
            $Imgname="";
         }
  
        // $firebaseToken  = "eOI5r3n9Qd2wRp8lE6VVXD:APA91bEgbpK-C6ncwgLW9lbi4TfO_MWcY0krs_KpztYeaAGI5cJqYcr12pjxhwx-zWAgmUHA8aCPKQWR54LTsCUZzvhuA_PrZlALonSFO_iUK1pIUzYOJlu5TSXSuOL96CWYnI6m5230";

        $SERVER_API_KEY = 'AAAA-NBKXSQ:APA91bGretMCRwVvaeYdY24wbX39M5Sf6kgNabLRJJbXt2N1j_nUzGqWLuYTaC-WfFvi1etPimzmeTLJS2A7xtaLF18vYBJKT7PGQjagbzZe9uwnS4glTPD-_F310UA8eSQXQ1Jgp2_W';
  
        $data = [
            "registration_ids" =>$data,
            "notification" => [
                "title" => $request->title,
                "body" => $request->detail, 
                "image" => $Imgname,
                'sound' => 'mySound',

            ]
        ];
        $dataString = json_encode($data);
    

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);
       
  
        dd($response);

           return view('firebase', ['fcm_registration_ids'=>$fcm_registration_ids]);
    }


  

}
