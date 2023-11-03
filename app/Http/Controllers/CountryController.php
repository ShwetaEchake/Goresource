<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use DB;
class CountryController extends Controller
{
   
    public function index()
    {
        $countries=Country::all();
      
        return view('country.index',['countries'=>$countries]);
    }

    public function store(Request $request)
    {
          $country= new Country();
          $country->country_name=$request->country_name;
          $country->country_code=$request->country_code;
          $country->country_currency=$request->country_currency;
          $country->save(); 

        return redirect()->route('country.index')->with('success','Country Created Successfully');
    }

   
    public function edit($id)
    {
        
        $country=Country::find($id);
        $countries=Country::all();
      
        return view('country.index',compact('country','countries'));
    }

 
    public function update(Request $request, $id)
    {
          $country=  Country::find($id);
          $country->country_name=$request->country_name;
          $country->country_code=$request->country_code;
          $country->country_currency=$request->country_currency;
          $country->save(); 

        return redirect()->route('country.index')->with('success','Country Updated Successfully');
    }

    
    public function destroy($id)
    {
         $country = DB::table('country')->where('country_id',$id)->delete();
        return redirect()->route('country.index')
                        ->with('success','Country Deleted Successfully');
    }
}
