<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Enquiry;
use App\Models\Client;

use Illuminate\Http\Request;
use DB;
class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
       $Client = Client::where('user_id',auth()->user()->id)->first();

        if(auth()->user()->user_type == "Client"){

                $jobs=Job::where('client_id',$Client->client_id)->get();
        }

       
       else if(auth()->user()->user_type == "Executive"){
            $jobs=
             DB::table('jobs')
            ->leftJoin('assign_enquiry_branch', 'jobs.enquiry_id', '=', 'assign_enquiry_branch.enquiry_id')
             ->leftJoin('executive', 'executive.branch_name', '=', 'assign_enquiry_branch.branch_id')
            ->where('executive.user_id', '=', auth()->user()->id)
            ->get();
        }


        else{

                $jobs=DB::table('jobs')
                 ->leftJoin('enquiry','enquiry.enquiry_id','jobs.enquiry_id')
                 ->leftJoin('client','client.client_id','jobs.client_id')
                 ->leftJoin('categories','categories.category_id','jobs.job_main_category_id')
                 ->leftJoin('project_location','project_location.job_id','jobs.job_id')
                 ->leftJoin('client_location','client_location.client_location_id','project_location.location_id')
                 ->get();

        }

      return view('job.index',['jobs'=>$jobs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['client']=DB::table('client')->get();
        $data['enquiry']=DB::table('enquiry')->get();
        $data['projectlocation']=DB::table('project_location')->get();
        $data['categories']=DB::table('categories')->where('parent_category_id',0)->get();
        return view('job.create',$data);
    }






    public function getCategory(Request $request)
  {
  
    $cities = DB::table("categories")
    ->where("parent_category_id",$request->category_id)
    ->pluck("category_name","category_id");
    return response()->json($cities);

  }


  public function getEnquiry(Request $request)
  {
  
    $cities = DB::table("enquiry")
    ->where("client_id",$request->client_id )
    ->pluck("enquiry_title","enquiry_id");
    return response()->json($cities);

  }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enquiry=new Enquiry();
        $enquiry->client_id =$request->client_id ;
        $enquiry->enquiry_title =$request->enquiry_title ;
        $enquiry->contract_period=$request->contract_period;
        $enquiry->place_of_work =$request->place_of_work;
        $enquiry->trial_period=$request->trial_period ;
        $enquiry->air_fare =$request->air_fare ;
        $enquiry->employment_visa=$request->employment_visa;
        $enquiry->food_status =$request->food_status;
        $enquiry->transportation_status =$request->transportation_status ;
        $enquiry->accomodation_status=$request->accomodation_status;
        $enquiry->medical_status=$request->medical_status;
        $enquiry->duty_hours =$request->duty_hours ;
        $enquiry->overtime_hours=$request->overtime_hours;
        $enquiry->uniform_status =$request->uniform_status;
        $enquiry->other_benefits=$request->other_benefits;
        $enquiry->other_condition =$request->other_condition;

           if($request->hasfile('attached_document1')){
            $file=$request->file('attached_document1');
            $extension=$file->getClientOriginalExtension();
            $filename=time() .'.' .$extension;
            $file->move('uploads/documents',$filename);
            $enquiry->attached_document1=$filename;
            }else{
          //  return $request;
            $enquiry->attached_document1="";
           }

         if($request->hasfile('attached_document2')){
            $file=$request->file('attached_document2');
            $extension=$file->getClientOriginalExtension();
            $filename=time() .'.' .$extension;
            $file->move('uploads/documents',$filename);
            $enquiry->attached_document2=$filename;
            }else{
          //  return $request;
            $enquiry->attached_document2="";
           }

         if($request->hasfile('attached_document3')){
            $file=$request->file('attached_document3');
            $extension=$file->getClientOriginalExtension();
            $filename=time() .'.' .$extension;
            $file->move('uploads/documents',$filename);
            $enquiry->attached_document3=$filename;
           }else{
          //  return $request;
            $enquiry->attached_document3="";
                }

          if($request->hasfile('attached_document4')){
            $file=$request->file('attached_document4');
            $extension=$file->getClientOriginalExtension();
            $filename=time() .'.' .$extension;
            $file->move('uploads/documents',$filename);
            $enquiry->attached_document4=$filename;
            }else{
          //  return $request;
            $enquiry->attached_document4="";
           }

         if($request->hasfile('attached_document5')){
            $file=$request->file('attached_document5');
            $extension=$file->getClientOriginalExtension();
            $filename=time() .'.' .$extension;
            $file->move('uploads/documents',$filename);
            $enquiry->attached_document5=$filename;
           }else{
          //  return $request;
            $enquiry->attached_document5="";
                }
        $enquiry->save();


  foreach($request->job_main_category_id as $key=>$job_main_category_id) {
            $data= new Job();
            $data->enquiry_id =$enquiry->enquiry_id ;
            $data->client_id=$request->client_id;
            $data->job_main_category_id=$request->job_main_category_id[$key];
            $data->job_sub_category_id=$request->job_sub_category_id[$key];
            $data->enquiy_project_location_id=$request->enquiy_project_location_id[$key];
            $data->basic_salary=$request->basic_salary[$key];
            $data->cola_allownces=$request->cola_allownces[$key];
            $data->food_allownce=$request->food_allownce[$key];
            $data->transportation_allownce=$request->transportation_allownce[$key];
            $data->accomodation_allownce=$request->accomodation_allownce[$key];   
            $data->medical_allownce=$request->medical_allownce[$key];
            $data->overtime_allownce=$request->overtime_allownce[$key];
            $data->save();

        }




   // foreach ($request->addMoreInputFields as $key => $value) {
   //      $jobs=Job::where('job_id',$job->job_id)->get();
   //      }
   //      $job->update();
        return redirect()->route('job.index')
                        ->with('success','Job Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

             $job=Job::find($id);
           $data['client']=DB::table('client')->get();
           $data['enquirys']=DB::table('enquiry')->get();
           $data['enquiry']=DB::table('enquiry')->where('enquiry_id',$job->enquiry_id)->get();
           $data['projectlocation']=DB::table('project_location')->get();
           $data['categories']=DB::table('categories')->where('parent_category_id',0)->get();


        return view('job.edit',compact('job'),$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $job= Job::find($job->job_id);
        $job->enquiry_id =$request->enquiry_id ;
        $job->client_id=$request->client_id;
        $job->job_main_category_id=$request->job_main_category_id;
        $job->job_sub_category_id =$request->job_sub_category_id;
        //$job->project_location=$request->project_location;
        $job->enquiy_project_location_id  =$request->enquiy_project_location_id ;
        $job->basic_salary=$request->basic_salary;
        $job->cola_allownces=$request->cola_allownces;
        $job->food_allownce=$request->food_allownce;
        $job->transportation_allownce=$request->transportation_allownce;
        $job->accomodation_allownce=$request->accomodation_allownce;
        $job->medical_allownce=$request->medical_allownce;
        $job->overtime_allownce=$request->overtime_allownce;
    
        $job->save();

        return redirect()->route('job.index')
                        ->with('success','Job Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $job = DB::table('jobs')->where('job_id',$id)->delete();
        return redirect()->route('job.index')
                        ->with('success','Job Deleted Successfully');
    }
}
