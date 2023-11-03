<?php
namespace App\Http\Controllers;

use App\Models\State;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;




class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function __construct(state $state)
    {
        $this->state = $state;
        $this->middleware("auth");
    }

    public function index()
    {
        $states = $this->state::all();

        $data['cities'] = DB::table('cities')->get();

        return view("state.index", ['states' => $states], $data);


    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['state'] = DB::table('state')->get();
        return view("state.create",$data);
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
            'state_name' => 'required|string|unique:state',
        ]);

        $state = new state();
        $state->state_name = $request->state_name;
        $state->state_status = $request->state_status;
        $state->sequence = $request->sequence;
        
        $state->save();
         return redirect()->route('state.index')->with('success', 'State Created');
    }
 


    public function show(State $state)
    {
        return view('state.show',compact('state'));
    }

   
    public function edit($id)
    {
        $state= State::find($id);
        return view('state.edit',compact('state'));
    }


    public function update(Request $request, State $state )
    {
       
        $request->validate([
            'state_name' => 'required|string',
            
        ]);

        $state =State::find($state->state_id);

        $state->state_name = $request->state_name;
    
        $state->save();
  
        return redirect()->route('state.index')
                        ->with('success','state updated successfully');
    }

    public function destroy($id)
    {

        $state = new State();
        
        $state->where('state_id',$id)->delete();
  
        return redirect()->route('state.index')
                        ->with('success','State deleted successfully');
    }


    
}
