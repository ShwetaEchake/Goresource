<?php

namespace App\Http\Controllers;

use App\Models\ProjectLocation;
use Illuminate\Http\Request;
use DB;
class ProjectLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $projectlocations=ProjectLocation::all();
        return view('projectlocation.index',['projectlocations'=>$projectlocations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['enquiry'] = DB::table('enquiry')->get();
        $data['jobs'] = DB::table('jobs')->get();
        $data['location'] = DB::table('locations')->get();
        return view('projectlocation.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $projectlocation= new ProjectLocation();
          $projectlocation->enquiry_id =$request->enquiry_id ;
          $projectlocation->location_id=$request->location_id;
          $projectlocation->required_position=$request->required_position;
          $projectlocation->job_id=$request->job_id;
    
          $projectlocation->save(); 

        return redirect()->route('projectlocation.index')->with('success','Project Location Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectLocation  $projectLocation
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectLocation $projectLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectLocation  $projectLocation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projectlocation=ProjectLocation::find($id);
        $data['enquiry'] = DB::table('enquiry')->get();
        $data['jobs'] = DB::table('jobs')->get();
        $data['location'] = DB::table('locations')->get();
        return view('projectlocation.edit',compact('projectlocation'),$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectLocation  $projectLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $projectlocation=  ProjectLocation::find($id);
          $projectlocation->enquiry_id =$request->enquiry_id ;
          $projectlocation->location_id=$request->location_id;
          $projectlocation->required_position=$request->required_position;
          $projectlocation->job_id=$request->job_id;
    
          $projectlocation->save(); 

        return redirect()->route('projectlocation.index')->with('success','Project Location Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectLocation  $projectLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectLocation $projectLocation)
    {
        //
    }
}
