<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalExaminationCenter;
use DB;
class MedicalExaminationCenterController extends Controller
{
     public function index()
    {
         $medicalexaminationcenters = MedicalExaminationCenter::all();
 

        return view('medicalexaminationcenter.index',['medicalexaminationcenters'=>$medicalexaminationcenters]);
        
    }


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
        $medicalexaminationcenters= new MedicalExaminationCenter();
          $medicalexaminationcenters->medical_examination_center_code=$request->medical_examination_center_code;
          $medicalexaminationcenters->medical_examination_center_name=$request->medical_examination_center_name;
          $medicalexaminationcenters->medical_examination_center_city=$request->medical_examination_center_city;
          $medicalexaminationcenters->medical_examination_center_state=$request->medical_examination_center_state;
          $medicalexaminationcenters->medical_examination_center_country=$request->medical_examination_center_country;

          
         $medicalexaminationcenters->save(); 
         return redirect()->route('medicalexaminationcenter.index')->with('success','Document Created Successfully');
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
        $medicalexaminationcenter=MedicalExaminationCenter::find($id);
    
        $medicalexaminationcenters=MedicalExaminationCenter::all();

        return view('medicalexaminationcenter.index',['medicalexaminationcenter'=>$medicalexaminationcenter],compact('medicalexaminationcenters'));
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
        $medicalexaminationcenter=MedicalExaminationCenter::find($id);
        $medicalexaminationcenter->medical_examination_center_code=$request->medical_examination_center_code;
          $medicalexaminationcenter->medical_examination_center_name=$request->medical_examination_center_name;
          $medicalexaminationcenter->medical_examination_center_city=$request->medical_examination_center_city;
          $medicalexaminationcenter->medical_examination_center_state=$request->medical_examination_center_state;
          $medicalexaminationcenter->medical_examination_center_country=$request->medical_examination_center_country;


          $medicalexaminationcenter->save(); 

        return redirect()->route('medicalexaminationcenter.index')->with('success','Medical Examination Center Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicalexaminationcenter = DB::table('medical_examination_center')->where('medical_examination_center_id',$id)->delete();
        return redirect()->route('medicalexaminationcenter.index')
                        ->with('success','Medical Examination Center Deleted Successfully');
    }




}
