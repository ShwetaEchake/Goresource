<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use App\Models\ClientLocation;
use File;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
       public function index()
    {
        
        if(auth()->user()->user_type == "Client"){

                $clients=Client::where('user_id',auth()->user()->id)->orderBy('client_id','desc')->get();
        }else{

                $clients=Client::all();

        }
     
       return view('client.index',['clients'=>$clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = DB::table('users')->get();
        $data['country']=DB::table('country')->distinct()->get();

        return view('client.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $todayDate=Date('Y-m-d');
         $request->validate([
         'client_email' => 'required|unique:client',
         'client_location_code' => 'required|unique:client_location',
         'created_date' => 'date_format:Y-m-d|after_or_equal:'.$todayDate,
         'updated_date' => 'date_format:Y-m-d|after_or_equal:created_date',
         'logo' => 'logo|mimes:jpeg,jpg|max:2048|dimensions:width=200,height=100',

    ]);


        $user= new User();
        $user->name= $request->user_id;
        $user->password=bcrypt($request->password);
        $user->email= $request->client_email;
        $user->phone= $request->client_mobile;
        $user->user_type= "Client";
        $user->save();


        $client=new Client();
        $client->user_id=$user->id;
       // $client->password=bcrypt($request->password);
        $client->company_name=$request->company_name;
        $client->client_city=$request->client_city;
        $client->client_state =$request->client_state;
        $client->client_zipcode=$request->client_zipcode;
        $client->client_country =$request->client_country;
        $client->client_email=$request->client_email;
        $client->client_mobile=$request->countrycode_client_mobile."-".$request->client_mobile;
        $client->client_officeno=$request->countrycode_client_officeno."-".$request->client_officeno;

        $client->website_url=$request->website_url;
        $client->commercial_registration_no=$request->commercial_registration_no;
        $client->date_expiry=strtotime($request->date_expiry);
        $client->date_issue=strtotime($request->date_issue);

        $client->employee_no=$request->employee_no;
        $client->currency=$request->currency;
        $client->commission=$request->commission;

        $client->passport_no=$request->passport_no;
        $client->expiry_date=strtotime($request->expiry_date);
        $client->issue_date=strtotime($request->issue_date);

        $client->nationality=$request->nationality;
        $client->designation=$request->designation;


        $client->client_address=$request->client_address;
        $client->contact_person=$request->contact_person;
        $client->contact_person_mobile=$request->contact_person_mobile;
        $client->contact_person_email=$request->contact_person_email;
        $client->contact_person1=$request->contact_person1;
        $client->contact_person_mobile1=$request->contact_person_mobile1;
        $client->contact_person_email1=$request->contact_person_email1;
        $client->client_status=$request->client_status;
        $client->client_remark=$request->client_remark;
        $client->created_by=auth()->user()->id;
        $client->updated_date=strtotime(Date('Y-m-d'));
        $client->save();

           $foldername = $user->name."_".$client->client_id;
           $directory = File::makeDirectory('documents/'.$foldername);
           $client->folder_path=$foldername;

         if($request->hasfile('client_logo')){
            $file=$request->file('client_logo');
            $extension=$file->getClientOriginalName();
            $filename=$extension;
            $destinationpath = $foldername ;
            $file->move('documents/'.$destinationpath,$filename);
            $client->folder_path=$destinationpath;
            $client->client_logo=$filename;
            }else{
            $client->client_logo="";
          }
         $client->save();



          foreach($request->client_location_code as $key=>$client_location_code){
                $clientlocation= new ClientLocation();
                $clientlocation->client_location_code=$request->client_location_code[$key];
                $clientlocation->client_location_name=$request->client_location_name[$key];
                $clientlocation->client_location_detail=$request->client_location_detail[$key];
                $clientlocation->client_id= $client->client_id;
                $clientlocation->save();
             }



        return redirect()->route('client.index')
                        ->with('success','Client Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */

     public function getState(Request $request)
       {
            $state = DB::table("state")
            ->where("country_id",$request->country_id)
            ->pluck("state_name","state_id");
              return response()->json($state);
       }


       public function getcity(Request $request)
        {
            $cities = DB::table("cities")
            ->where("state_id",$request->state_id)
            ->pluck("city_name","cities_id");
              return response()->json($cities);
        }

        public function getCurrency(Request $request)
          {
            $country = DB::table("country")
            ->where("country_id",$request->country_id)
            ->pluck("country_currency","country_code");
              return response()->json($country);
          }



    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $client= Client::find($id);
        $data['users'] = DB::table('users')->get();
        $data['country']=DB::table('country')->distinct()->get();
        $data['clientlocation'] = DB::table('client_location')->where('client_id',$client->client_id)->get();


        return view('client.edit',compact('client'),$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

         $request->validate([
         'logo' => 'logo|mimes:jpeg,jpg|max:2048|dimensions:width=200,height=100'
         ]);

        $client= Client::find($id);
        $client->company_name=$request->company_name;
        $client->client_city=$request->client_city;
        $client->client_state =$request->client_state;
        $client->client_zipcode=$request->client_zipcode;
        $client->client_country =$request->client_country;
        $client->client_email=$request->client_email;
        $client->client_mobile=$request->countrycode_client_mobile."-".$request->client_mobile;
        $client->client_officeno=$request->countrycode_client_officeno."-".$request->client_officeno;


        $client->website_url=$request->website_url;
        $client->commercial_registration_no=$request->commercial_registration_no;
        $client->date_expiry=strtotime($request->date_expiry);
        $client->date_issue=strtotime($request->date_issue);
        $client->employee_no=$request->employee_no;
        $client->currency=$request->currency;
        $client->commission=$request->commission;
        $client->passport_no=$request->passport_no;
        $client->expiry_date=strtotime($request->expiry_date);
        $client->issue_date=strtotime($request->issue_date);
        $client->nationality=$request->nationality;
        $client->designation=$request->designation;
        
        $client->client_address=$request->client_address;
        $client->contact_person=$request->contact_person;
        $client->contact_person_mobile=$request->contact_person_mobile;
        $client->contact_person_email=$request->contact_person_email;
        $client->contact_person1=$request->contact_person1;
        $client->contact_person_mobile1=$request->contact_person_mobile1;
        $client->contact_person_email1=$request->contact_person_email1;
        $client->client_status=$request->client_status;
        $client->client_remark=$request->client_remark;
        $client->created_by=auth()->user()->id;
        $client->updated_date=strtotime(Date('Y-m-d'));


           if($request->hasfile('client_logo')){

                    $file=  $client->client_logo;
                    $filename=public_path('documents/'.$client->folder_path."/". $file);
                      if(!empty($file)){
                           if (File::exists($filename)){       
                               unlink($filename);
                            }
                       }

                    $file=$request->file('client_logo');
                    $extension=$file->getClientOriginalName();
                    $filename=$extension;
                    $destinationpath = $client->folder_path;
                    $file->move('documents/'.$destinationpath,$filename);
                    //$client->folder_path=$destinationpath;
                    $client->client_logo=$filename;
            }



           $client->save();


       
        $user=  User::find($client->user_id);
        $user->name= $request->user_id;
        // $user->password=bcrypt($request->password);
          if($user->password == $request->password){
               
               $user->password = $request->password;

            }else{

                 $user->password = bcrypt($request->password);
            }
        $user->email= $request->client_email;
        $user->phone= $request->client_mobile;
        $user->save();


    
   foreach ($request->client_location_id as  $index => $value) {

    if($value!=''){

     $locationUpdate=array(
          'client_location_code'=> $request->client_location_code[$index],
          'client_location_name'=> $request->client_location_name[$index],
          'client_location_detail'=> $request->client_location_detail[$index],
           
    );
        $clientlocation=ClientLocation::where('client_location_id',$value)->first();
        $clientlocation->update($locationUpdate);

   }else{
            $locationCreate = new ClientLocation();
            $locationCreate->client_id= $id;
            $locationCreate->client_location_code=$request->client_location_code[$index];
            $locationCreate->client_location_name=$request->client_location_name[$index];
            $locationCreate->client_location_detail=$request->client_location_detail[$index];
            $locationCreate->save();

       }
   }///end of for






        return redirect()->route('client.index')
                        ->with('success','Client Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

         $client=DB::table('client')->where('client_id',$id)->first();
         $client_location=DB::table('client_location')->where('client_id',$client->client_id)->delete();

            $enquiries=DB::table('enquiry')->where('client_id',$client->client_id)->first();
          if(isset($enquiries)){
            $job=DB::table('jobs')->where('enquiry_id',$enquiries->enquiry_id)->delete();
            $project_location=DB::table('project_location')->where('enquiry_id',$enquiries->enquiry_id)->delete();
            $assign_enquiry=DB::table('assign_enquiry_branch')->where('enquiry_id',$enquiries->enquiry_id)->delete();
            $enquiry_documents=DB::table('enquiry_documents')->where('enquiry_id',$enquiries->enquiry_id)->delete();
            $enquiriesD=DB::table('enquiry')->where('client_id',$client->client_id)->delete();
          }

         File::deleteDirectory(public_path('documents/'.$client->folder_path));
         $client = DB::table('client')->where('client_id',$id)->delete();
         return redirect()->route('client.index')
                        ->with('success','Client Deleted Successfully');
    }
}
