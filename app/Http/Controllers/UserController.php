<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(user $user)
    {
        $this->user = $user;
        $this->middleware("auth");
    }

  

      public function index(Request $request)
    {


        // if(auth()->user()->user_type  == "Executive"){

        //      $users = DB::table('users')->leftJoin('executive','executive.branch_name','=','users.branch_id')->where('id',auth()->user()->id)->get();
        //      return view("user.index", ['users' => $users]);

        //  }

         // else{
                // $users = DB::table('users')->get();
                  $data = \DB::table('personal')->where('type','User')->OrderBy('candidate_id','Desc')->paginate(10);
                  $new['country']=DB::table('country')->select('country_name','country_id')->distinct()->get();
                  $new['emailtemplates']=DB::table('email_templates')->get();
                  $new['smstemplates']=DB::table('sms_templates')->get();
                  $new['client'] = DB::table('client')->get();
                  $new['languages']=DB::table('language')->get();
                  $new['branch']=DB::table('branch')->get();
            // }

          return view("user.index",$new,compact('data'));
                        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        $data['users'] = DB::table('users')->get();
        $data['roles'] = DB::table('roles')->get();

        return view("user.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
          
        ]);

        $user = new User();
         $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->user_type = $request->user_type;
        $user->otp = $request->otp;
        $user->created_date =strtotime(date('Y-m-d'));

        $user->save();
         return redirect()->route('user.index')->with('success', 'User Created Successfully');
    }
 


    public function show(User $user)
    {
        return view('user.show',compact('user'));
    }

   
    public function edit($id)
    {
        $user= User::find($id);
        $users= User::all();
         $data['roles'] = DB::table('roles')->get();
        return view('user.edit',compact('user','users'),$data);
    }


    public function update(Request $request, User $user )
    {
       
        

        $users =User::find($user->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->user_type = $request->user_type;
        $user->otp = $request->otp;
        $user->created_date =strtotime(date('Y-m-d'));

        $users->password = bcrypt($request->password);

          if($user->password == $request->password){
               
               $users->password = $request->password;

            }else{

                 $users->password = bcrypt($request->password);
            }
        
    
        $user->save();
  
        return redirect()->route('user.index')
                        ->with('success','User Updated Successfully');
    }

    public function destroy($id)
    {


        $user = DB::table('users')->where('id',$id)->delete();
  
        return redirect()->route('user.index')
                        ->with('success','User Deleted Successfully');
    }
        
}