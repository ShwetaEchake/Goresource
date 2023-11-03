<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use Illuminate\Http\Request;
use DB;
class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $locations=Locations::get();
       return view('locations.index',['locations'=>$locations]);
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
        date_default_timezone_set("Asia/kolkata");
        $locations=new Locations();
        $locations->location_name=$request->location_name;
        $locations->status=$request->status;
        $locations->created_by=auth()->user()->id;
        $locations->created_date=strtotime(Date('Y-m-d'));
        $locations->updated_date=strtotime(Date('Y-m-d'));
      
       $locations->save();

       return redirect()->route('locations.index')
                        ->with('success','Location Deleted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Locations  $locations
     * @return \Illuminate\Http\Response
     */
    public function show(Locations $locations)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Locations  $locations
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location=Locations::find($id);
        $locations=Locations::all();
        return view('locations.index',['location'=>$location],compact('locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Locations  $locations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $location= Locations::find($id);
        $location->location_name=$request->location_name;
        $location->status=$request->status;
        $location->created_by=auth()->user()->id;
        $location->created_date=strtotime(Date('Y-m-d'));
        $location->save(); 

        return redirect()->route('locations.index')->with('success','Location Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Locations  $locations
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $locations=DB::table('locations')->where('location_id',$id)->delete();
       return redirect()->route('locations.index')
                        ->with('success','Location Deleted Successfully');
    }
}
