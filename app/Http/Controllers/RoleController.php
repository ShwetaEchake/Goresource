<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use DB;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }
    public function index()
    {
        $roles=Role::all();
        return view('role.index',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $role=new Role();

        $role->title=$request->title;
        $role->status=$request->status;
        $role->created_by=auth()->user()->id;
        $role->save();

        return redirect()->route('role.index')->with('success','Role Created Successfully');
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           $role=Role::find($id);
        $roles=Role::all();
        return view('role.index',['role'=>$role],compact('roles'));
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
       
          $role=  Role::find($id);
          $role->title=$request->title;
          $role->status=$request->status;
        
    
          $role->save(); 

        return redirect()->route('role.index')->with('success','Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $role=DB::table('roles')->where('id',$id)->delete();
    return redirect()->route('role.index')->with('success','Role Deleted Successfully');

    }
}