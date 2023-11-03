<?php
namespace App\Http\Controllers;

use App\Models\Cities;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;




class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(cities $cities)
    {
        $this->cities = $cities;
        $this->middleware("auth");
    }

    public function index()
    {
        $citiess = $this->cities::paginate(5);


        $data['state'] = DB::table('state')->get();

        return view("cities.index", ['citiess' => $citiess],$data);


    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['cities'] = DB::table('cities')->get();
        // $data['state'] =DB::table('state')->get();
        return view("cities.create",$data);
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
            'city_name' => 'required|string|unique:cities',
        ]);

        $cities = new Cities();
        $cities->city_name = $request->city_name;
        $cities->state_id = $request->state_id;
        $cities->cities_status = $request->cities_status;
        $cities->added_date =date('Y-m-d');
        $cities->sequence = $request->sequence;
        
        //$cities->updated_date =date('Y-m-d');
        //$cities->updated_by=auth()->user()->id;
        
        $cities->save();
         return redirect()->route('cities.index')->with('success', 'Cities Created');
    }
 


    public function show(cities $cities)
    {
        return view('cities.show',compact('cities'));
    }

   
    public function edit($id)
    {
        $cities= Cities::find($id);
        return view('cities.edit',compact('cities'));
    }


    public function update(Request $request, cities $cities )
    {
       
        $request->validate([
            'name' => 'required|string',
            
        ]);

        $cities =Cities::find($cities->cities_id);

        $cities->name = $request->name;
    
        $cities->save();
  
        return redirect()->route('cities.index')
                        ->with('success','cities updated successfully');
    }

    public function destroy($id)
    {

        $cities = new Cities();
        $cities->where('cities_id',$id)->delete();
  
        return redirect()->route('cities.index')
                        ->with('success','cities deleted successfully');
    }


    
}
