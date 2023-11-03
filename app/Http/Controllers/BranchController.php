<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use DB;
date_default_timezone_set("Asia/Calcutta");

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches=Branch::all();
        $data['country'] = DB::table('country')->get();
        return view('branch.index',['branches'=>$branches],$data);
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

        $request->validate([
         'branch_name' => 'required|unique:branch'
        ]);
          $branch= new Branch();
          $branch->branch_name=$request->branch_name;
          $branch->status=$request->status;
          $branch->branch_city=$request->branch_city;
          $branch->branch_country=$request->branch_country;
          $branch->created_by=auth()->user()->id;
          $branch->created_date=strtotime(Date('Y-m-d'));
    
          $branch->save(); 

        return redirect()->route('branch.index')->with('success','Branch Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $branch=Branch::find($id);
        $branches=Branch::all();
        $data['country'] = DB::table('country')->get();
        return view('branch.index',compact('branches','branch'),$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $branch=  Branch::find($id);
          $branch->branch_name=$request->branch_name;
          $branch->status=$request->status;
          $branch->branch_city=$request->branch_city;
          $branch->branch_country=$request->branch_country;
          $branch->created_by=auth()->user()->id;
          $branch->updated_date=strtotime(Date('Y-m-d'));
    
          $branch->save(); 

        return redirect()->route('branch.index')->with('success','Branch Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $branch = DB::table('branch')->where('branch_id',$id)->delete();
        return redirect()->route('branch.index')
                        ->with('success','Branch Deleted Successfully');
    }
}
