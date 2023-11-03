<?php

namespace App\Http\Controllers;

use App\Models\Executive;
use App\Models\User;

use Illuminate\Http\Request;
use DB;
class ExecutiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $executives=Executive::leftjoin('branch','branch.branch_id','=','executive.branch_name')->get();
        // $data['branch'] = DB::table('branch')->get();
        // $data['role'] = DB::table('roles')->get();
        // $data['users'] = DB::table('users')->get();
        // return view('executive.index',['executives' => $executives],$data);

        return view('helpmenu.index');
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
    public function store(Request $request)
    {

        $user=new User();
        $user->name= $request->user_id;
        $user->password=bcrypt($request->password);
        $user->email= $request->email;
        $user->phone= $request->mobile_no;
        $user->user_type= $request->role_id;
        $user->save();

        $executive= new Executive();
        $executive->user_id=$user->id;
        $executive->first_name=$request->user_id;
        $executive->last_name=$request->last_name;
        $executive->role_id=$request->role_id;
        $executive->branch_name=$request->branch_name;
        $executive->mobile_no=$request->mobile_no;
        $executive->email=$request->email;
        $executive->save();

        return redirect()->route('executive.index')->with('success','Executive Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\executive  $executive
     * @return \Illuminate\Http\Response
     */
    public function show(executive $executive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\executive  $executive
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         
        $executive=Executive::find($id);
        $executives=Executive::all();
        $data['branch'] = DB::table('branch')->get();
        $data['role'] = DB::table('roles')->get();
        return view('executive.index',compact('executives','executive') ,$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\executive  $executive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $executive= Executive::find($id);
        //$executive->first_name=$request->first_name;
        $executive->last_name=$request->last_name;
        $executive->role_id=$request->role_id;
        $executive->branch_name=$request->branch_name;
        $executive->mobile_no=$request->mobile_no;
        $executive->email=$request->email;
        $executive->save();

      
        $user=  User::find($executive->user_id);
        $user->name= $request->user_id;
        $user->password=bcrypt($request->password);
        $user->email= $request->email;
        $user->phone= $request->mobile_no;
        $user->user_type= $request->role_id;
        $user->save();


    return redirect()->route('executive.index')->with('success','Executive Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\executive  $executive
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $executive = DB::table('executive')->where('executive_id',$id)->delete();
        return redirect()->route('executive.index')
                        ->with('success','Executive deleted successfully');
    }
}
