<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Profesional;
use App\Models\Seminar;
use App\Models\Beneficiary;
use App\Models\Dependents;
use App\Models\CandidateDocument;
use App\Models\Passport;
use App\Models\JobApplied;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use PDF;
use Excel;
use File;
use App\Models\ApplicationProcess;
date_default_timezone_set("Asia/Calcutta");

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function pdf()
    {

        $pdf = PDF::loadView('personal.pdf');
        return $pdf->download('personal.pdf');
       //return view('personal.pdf');

	
    }

 public function Personalexport(Request $request) 
    {

    $id=explode(",", $_GET['id']);
   return Excel::download(new Personal($id),'personal.xlsx');
    }





    public function index()
    {  
$branch =DB::table('personal')->where('user_id',auth()->user()->id)->first();

if(auth()->user()->user_type == "User"){
         $data=    DB::table('personal')
            ->where('personal.branch_id', '=', $branch->branch_id)
            ->where('personal.type', '=', 'Candidate')
            ->OrderBy('candidate_id','Desc')
            ->paginate(20);

         $new['country']=DB::table('country')->select('country_name','country_id')->distinct()->get();
      $new['emailtemplates']=DB::table('email_templates')->get();
      $new['smstemplates']=DB::table('sms_templates')->get();
      $new['client'] = DB::table('client')->get();
      $new['languages']=DB::table('language')->get();
      $new['branch']=DB::table('branch')->get();

          // $data['result'] = DB::select(DB::raw("select category_id ,category_name from jobs  LEFT JOIN categories ON categories.category_id = jobs.job_main_category_id  "));

}

else{
      $data = \DB::table('personal')->where('type','Candidate')->OrderBy('candidate_id','Desc')->paginate(10);
      $new['country']=DB::table('country')->select('country_name','country_id')->distinct()->get();
      $new['emailtemplates']=DB::table('email_templates')->get();
      $new['smstemplates']=DB::table('sms_templates')->get();
      $new['client'] = DB::table('client')->get();
      $new['languages']=DB::table('language')->get();
      $new['branch']=DB::table('branch')->get();


    }
       return view('personal.index',$new,compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $data['document']=DB::table('document_type')->get();
       $data['country']=DB::table('country')->select('country_name','country_id')->distinct()->get();
       $data['branch'] = DB::table('branch')->get();

        $data['branchnames'] = 
        DB::table('branch')
           ->leftJoin('personal','personal.branch_id','=','branch.branch_id')
           ->leftJoin('users','users.id','=','personal.user_id')
           ->where('id',auth()->user()->id)->first();

       return view('personal.create',$data);
    }


 public function advance(Request $request)
    {
        $data = \DB::table('personal');
        $country=DB::table('country')->select('country_name','country_id')->distinct()->get();
        $languages=DB::table('language')->get();
        $branch=DB::table('branch')->get();




           if($request->education_type || $request->course_name){
             $data= Personal::orwhereHas('edu', function($data) use ($request)
             {
             $data->where('education_type', 'LIKE', '%'.$request->education_type.'%')
                   ->where('course_name', 'LIKE', '%'.$request->course_name.'%');
             });
             }

             if($request->designation || $request->type || $request->totalyear){
             $data= Personal::orwhereHas('exp', function($data) use ($request)
             {
             $data->where('designation', 'LIKE', '%'.$request->designation.'%')
                  ->where('type', 'LIKE', '%'.$request->type.'%')
                  ->where('totalyear', 'LIKE', '%'.$request->totalyear.'%');
             });
             }



        if($request->candidate_id){
            $data = $data->where('candidate_id',$request->candidate_id)
                        ->orwhere('candidate_code', 'LIKE', "%" . $request->candidate_id . "%");
        }

         if($request->branch_id){
            $data = $data->where('branch_id',$request->branch_id);
        }

        if($request->name){
            $data = $data->where('name', 'LIKE', "%" . $request->name . "%");
        }
         if($request->middle_name){
            $data = $data->where('middle_name', 'LIKE', "%" . $request->middle_name . "%");
        }
         if($request->last_name){
            $data = $data->where('last_name', 'LIKE', "%" . $request->last_name . "%");
        }
        if($request->age){
            $data = $data->where('age', 'LIKE', "%" . $request->age . "%");
        }

        if($request->gender){
            $data = $data->where('gender', 'LIKE', "%" . $request->gender . "%");
        }
        if($request->citizenship){
            $data = $data->where('citizenship', 'LIKE', "%" . $request->citizenship . "%");
        }

        if($request->merital_status){
            $data = $data->where('merital_status', 'LIKE', "%" . $request->merital_status . "%");
        }
        if($request->religion){
            $data = $data->where('religion', 'LIKE', "%" . $request->religion . "%");
        }

        if($request->language){
            $data = $data->where('language', 'LIKE', "%" . $request->language . "%");
        }
        if($request->other_skill){
            $data = $data->where('other_skill', 'LIKE', "%" . $request->other_skill . "%");
        }

        if($request->computer_skill){
            $data = $data->where('computer_skill', 'LIKE', "%" . $request->computer_skill . "%");
        }
        if($request->hobbies_sport){
            $data = $data->where('hobbies_sport', 'LIKE', "%" . $request->hobbies_sport . "%");
        }
      
          $data = $data->paginate(10);
          $new['client'] = DB::table('client')->get();
          $new['emailtemplates']=DB::table('email_templates')->get();
          $new['smstemplates']=DB::table('sms_templates')->get();
        return view('personal.index', compact('data','country','languages','branch'),$new);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function shortlist(Request $request){

    $string = explode(',', $request->names);
    //  print_r($string);
    //$Implode='"'.implode('","', $string).'"';
   

     $insert=DB::table('job_applied')->whereIn('candidate_id',$string)
     ->where('job_id',$request->jobid)
     ->where('location',$request->location)
     ->first();
     //    print_r($insert);

     // exit();
     if ($insert === null) {
             foreach ($string as $key => $value) {
                            $branchid =DB::table('personal')->where('candidate_id',$value)->first();
                            $jobapplied=new JobApplied();
                            $jobapplied->candidate_id=$value;
                            $jobapplied->branch_id=$branchid->branch_id;
                            $jobapplied->client_id =$request->clientid;
                            $jobapplied->enquiry_id =$request->enquiryid;
                            $jobapplied->job_id =$request->jobid;
                            $jobapplied->location =$request->location;
                            $jobapplied->current_status ="applied";
                            $jobapplied->created_by =auth()->user()->id;
                            $jobapplied->date_applied =strtotime(Date('Y-m-d'));
                            $jobapplied->save();   

                            $applicationprocess= new ApplicationProcess();
                            $applicationprocess->candidate_id=$value;
                            $applicationprocess->client_id=$request->clientid;
                            $applicationprocess->enquiry_id=$request->enquiryid;
                            $applicationprocess->job_id=$request->jobid;
                            $applicationprocess->location_id=$request->location;
                            $applicationprocess->created_by=auth()->user()->id;
                            $applicationprocess->created_date=strtotime(Date('Y-m-d'));
                            $applicationprocess->application_activity='applied';
                            $applicationprocess->application_status='applied';
                            $applicationprocess->save();
               }
           return redirect()->back()->with('success','Shortlist Assign Successfully');
      }else{
            return redirect()->back()->with('error','Candidate exits');
           }

 }



    public function store(Request $request)
    {

        $user= new User();
        $user->name= $request->name;
        $user->email= $request->user_email;
        $user->password=bcrypt($request->user_password);
        $user->phone= $request->mobile_no;
        $user->user_type=$request->userstype ;
        $user->save();

        $personal = new Personal();
        $personal->user_id=$user->id;
        $personal->name =$request->name ;
        $personal->middle_name =$request->middle_name;
        $personal->last_name=$request->last_name;
        $personal->father_name =$request->father_name;
        $personal->mother_name =$request->mother_name;
        $personal->citizenship =$request->citizenship;
        $personal->date_of_birth=$request->date_of_birth;
        $personal->place_of_birth =$request->place_of_birth ;
        $personal->gender=$request->gender;
        $personal->merital_status =$request->merital_status;
        $personal->age =$request->age;
        $personal->height =$request->height;
        $personal->weight=$request->weight;
        $personal->religion=$request->religion ;
        $personal->language =$request->language;
        $personal->other_skill =$request->other_skill;
        $personal->computer_skill=$request->computer_skill;
        $personal->hobbies_sport=$request->hobbies_sport;
        $personal->branch_id=$request->branch_id ;
        $personal->email=$request->email ;
        $personal->mobile_no=$request->countrycode_mobile_no."-".$request->mobile_no;
        $personal->email2=$request->email2 ;
        $personal->mobile_no2=$request->countrycode_mobile_no2."-".$request->mobile_no2;
        $personal->aadhar_card=$request->aadhar_card ;
        $personal->pan_card=$request->pan_card ;
        $personal->driving_licence=$request->driving_licence ;
        $personal->type=$request->userstype ;
        $personal->reffer_by=$request->reffer_by;
        $personal->save();

           $dirname = $personal->name."_".$personal->candidate_id;
           $directory = File::makeDirectory('documents/Candidate/'.$dirname);
           $personal->directory_path= $dirname ;

             $branchsName=DB::table('branch')->where('branch_id',$request->branch_id)->first();
             if(isset($branchsName)){
             $personal->candidate_code=$branchsName->branch_name."-".$personal->candidate_id;
              }
             $personal->save();

           $passport = new Passport();
           $passport->candidate_id=$personal->candidate_id;
           $passport->passport_no=$request->passport_no;
           $passport->date_issue= $request->issue;
           $passport->date_expire=$request->expire;
           $passport->place_issue=$request->place;
           $passport->save();



        foreach($request->education_type as $key=>$education_type) {

            $data= new Education();
            $data->education_type=$request->education_type[$key];
            $data->school_university_name=$request->school_university_name[$key];
            $data->course_name=$request->course_name[$key];
            $data->completed_year=$request->completed_year[$key];
            $data->board_rate=$request->board_rate[$key];
            $data->candidate_id=$personal->candidate_id;
//             print_r($request->completed_year);
//           print_r($data);
// exit();
            $data->save();
        }



          foreach($request->type_of_licence as $key=>$type_of_licence){
            $profesional= new Profesional();
            $profesional->type_of_licence=$request->type_of_licence[$key];
            $profesional->licence_no=$request->licence_no[$key];
            $profesional->date_issue=$request->date_issue[$key];
            $profesional->place_issue=$request->place_issue[$key];
            $profesional->remark=$request->remark[$key];
            $profesional->candidate_id=$personal->candidate_id;
            $profesional->save();
          }



           foreach($request->company_name as $key=>$company_name){
                $experience= new Experience();
                $experience->company_name=$request->company_name[$key];
                $experience->location=$request->location[$key];
                $experience->designation=$request->designation[$key];
                $experience->from_date=$request->from_date[$key];
                $experience->to_date=$request->to_date[$key];
                $experience->type=$request->type[$key];
                $experience->totalyear=$request->totalyear[$key];
                $experience->candidate_id=$personal->candidate_id;
                $experience->save();
            }


            foreach($request->course_title as $key=>$course_title){
                $seminar= new Seminar();
                $seminar->course_title=$request->course_title[$key];
                $seminar->training_center=$request->training_center[$key];
                $seminar->seminar_held=$request->seminar_held[$key];
                $seminar->completion_date=$request->completion_date[$key];
                $seminar->remark=$request->remark[$key];
                $seminar->candidate_id=$personal->candidate_id;
                $seminar->save();
             }


                 foreach($request->beneficiary_type as $key=>$beneficiary_type){
                $beneficiary= new Beneficiary();
                $beneficiary->beneficiary_type=$request->beneficiary_type[$key];
                $beneficiary->beneficiary_name=$request->beneficiary_name[$key];
                $beneficiary->beneficiary_family_name=$request->beneficiary_family_name[$key];
                $beneficiary->beneficiary_mi=$request->beneficiary_mi[$key];
                $beneficiary->beneficiary_mobile=$request->phone_no[$key];
                $beneficiary->email=$request->email_address[$key];
                $beneficiary->beneficiary_birth_date=$request->beneficiary_birth_date[$key];
                $beneficiary->beneficiary_address=$request->beneficiary_address[$key];
                $beneficiary->beneficiary_zip=$request->beneficiary_zip[$key];
                $beneficiary->candidate_id=$personal->candidate_id;
                $beneficiary->save();
             }

            foreach($request->dependent_relation as $key=>$dependent_relation){
                $dependents= new Dependents();
                $dependents->dependent_relation=$request->dependent_relation[$key];
                $dependents->first_name=$request->first_name[$key];
                $dependents->family_name=$request->family_name[$key];
                $dependents->dependent_mi=$request->dependent_mi[$key];
                $dependents->mobile_no=$request->phone_no1[$key];
                $dependents->email=$request->email_address1[$key];
                $dependents->birth_date=$request->birth_date[$key];
                $dependents->occupation=$request->occupation[$key];
                $dependents->gender=$request->genders[$key];
                $dependents->status=$request->status[$key];
                $dependents->emp=$request->emp[$key];
                $dependents->candidate_id=$personal->candidate_id;
                $dependents->save();
             }
             
 $path =DB::table('personal')->where('candidate_id',$personal->candidate_id)->first();
 $pathToStore =$path->directory_path;

             /** New document */
  $images = request()->file('document_path');    
  $names  = request('document_title');
  foreach($names as $i => $code) {
    if(isset($images[$i])) {
       if($request->hasFile('document_path') && isset($images[$i])) {
            $img_name =$images[$i]->getClientOriginalName();
            $images[$i]->move('documents/Candidate/' .$pathToStore,$img_name);
            $candidatedocument = new CandidateDocument([
               'document_path' => "{$img_name}",
               'document_title' => $names[$i],
               'candidate_id'=> $personal->candidate_id,
               'date_submited'=> strtotime(Date('Y-m-d')),
           ]);
           $candidatedocument->save();
           
      }
    }
  }


     if($personal->type=='Candidate'){
        return redirect()->route('personal.index')->with('success','Candided Created Successfully');
     }else{
        return redirect()->route('user.index')->with('success','User Created Successfully');
     }



    }


  public function getCountryCode(Request $request)
    {
        $country = DB::table("country")
        ->where("country_id",$request->citizenship)
        ->pluck('country_code');
        return response()->json($country);
    }


     public function getmailtemplate(Request $request)
    {

            $id  = $request->input('email_title') ;
            $empt = DB::table("email_templates")
            ->where("email_template_id",$id)
            ->get();


            return response()->json($empt);


    }

    public function getsmstemplate(Request $request)
    {

            $id  = $request->input('sms_title') ;
            $sms = DB::table("sms_templates")
            ->where("sms_template_id",$id)
            ->get();


            return response()->json($sms);


    }



          public function getLocation(Request $request)
         {
             $project_location = DB::table("project_location")
             ->join('client_location', 'client_location.client_location_id','=','project_location.location_id' )
             ->where("project_location.job_id",$request->job_id)
             ->pluck("client_location_code","client_location_id");
             return response()->json($project_location);
         }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function show(Personal $personal)
    {
        $data['educations']=DB::table('education')->where('candidate_id',$personal->candidate_id)->get();
        $data['profesionals']=DB::table('profesional')->where('candidate_id',$personal->candidate_id)->get();
        $data['experiences']=DB::table('experience')->where('candidate_id',$personal->candidate_id)->get();
        $data['seminars']=DB::table('seminar')->where('candidate_id',$personal->candidate_id)->get();
        $data['beneficiaries']=DB::table('beneficiary')->where('candidate_id',$personal->candidate_id)->get();
        $data['dependentss']=DB::table('dependents')->where('candidate_id',$personal->candidate_id)->get();
        $data['candidate_documents']=DB::table('candidate_documents')->where('candidate_id',$personal->candidate_id)->
        leftjoin('document_type','document_type.document_type_id','=','candidate_documents.document_title')->get();
        $data['document']=DB::table('document_type')->get();
        $data['country']=DB::table('country')->select('country_name','country_id')->distinct()->get();
        $data['passport']=DB::table('passport')->where('candidate_id',$personal->candidate_id)->get();
        $data['branch'] = DB::table('branch')->get();



// if(isset($_GET['job_id'])){
//     $job_id=$_GET['job_id'];
// }else{
//     $job_id="";
// }



        $data['assessments']=DB::table('assessment')
          ->leftJoin('enquiry','enquiry.enquiry_id','=','assessment.enquiry_id')
          ->leftJoin('client','client.client_id','=','enquiry.client_id')
          ->leftJoin('jobs','jobs.job_id','=','assessment.job_id')
          ->leftJoin('client_location','client_location.client_location_id','=','assessment.location_id')
          ->leftJoin('categories','categories.category_id','=','jobs.job_main_category_id')
          ->where('candidate_id',$personal->candidate_id)->get();


        $data['post_assessments']=DB::table('post_assessment')
           ->leftJoin('enquiry','enquiry.enquiry_id','=','post_assessment.enquiry_id')
           ->leftJoin('client','client.client_id','=','enquiry.client_id')
           ->leftJoin('jobs','jobs.job_id','=','post_assessment.job_id')
           ->leftJoin('client_location','client_location.client_location_id','=','post_assessment.location_id')
           ->leftJoin('categories','categories.category_id','=','jobs.job_main_category_id')
           ->where('candidate_id',$personal->candidate_id)->get();

        $data['candidate_interviews']=DB::table('candidate_interview')
           ->leftJoin('enquiry','enquiry.enquiry_id','=','candidate_interview.enquiry_id')
           ->leftJoin('client','client.client_id','=','enquiry.client_id')
           ->leftJoin('jobs','jobs.job_id','=','candidate_interview.job_id')
           ->leftJoin('client_location','client_location.client_location_id','=','candidate_interview.location_id')
           ->leftJoin('categories','categories.category_id','=','jobs.job_main_category_id')
           ->where('candidate_id',$personal->candidate_id)->get();


           $data['offer_letters']=DB::table('offer_letter')
            ->leftJoin('enquiry','enquiry.enquiry_id','=','offer_letter.enquiry_id')
            ->leftJoin('client','client.client_id','=','enquiry.client_id')
            ->leftJoin('jobs','jobs.job_id','=','offer_letter.job_id')
            ->leftJoin('client_location','client_location.client_location_id','=','offer_letter.location_id')
            ->leftJoin('categories','categories.category_id','=','jobs.job_main_category_id')
            ->where('candidate_id',$personal->candidate_id)->get();


        $data['pre_medicals']=DB::table('pre_medical')
          ->leftJoin('enquiry','enquiry.enquiry_id','=','pre_medical.enquiry_id')
          ->leftJoin('client','client.client_id','=','enquiry.client_id')
          ->leftJoin('jobs','jobs.job_id','=','pre_medical.job_id')
          ->leftJoin('client_location','client_location.client_location_id','=','pre_medical.location_id')
          ->leftJoin('categories','categories.category_id','=','jobs.job_main_category_id')
          ->where('candidate_id',$personal->candidate_id)->get();

        $data['qvc']=DB::table('qvc_process')
          ->leftJoin('enquiry','enquiry.enquiry_id','=','qvc_process.enquiry_id')
          ->leftJoin('client','client.client_id','=','enquiry.client_id')
          ->leftJoin('jobs','jobs.job_id','=','qvc_process.job_id')
          ->leftJoin('client_location','client_location.client_location_id','=','qvc_process.location_id')
          ->leftJoin('categories','categories.category_id','=','jobs.job_main_category_id')
          ->where('candidate_id',$personal->candidate_id)->get();

        $data['visa']=DB::table('visa_process')
           ->leftJoin('enquiry','enquiry.enquiry_id','=','visa_process.enquiry_id')
           ->leftJoin('client','client.client_id','=','enquiry.client_id')
           ->leftJoin('jobs','jobs.job_id','=','visa_process.job_id')
           ->leftJoin('client_location','client_location.client_location_id','=','visa_process.location_id')
           ->leftJoin('categories','categories.category_id','=','jobs.job_main_category_id')
        ->where('candidate_id',$personal->candidate_id)->get();

        $data['deployment']=DB::table('deployment_process')
           ->leftJoin('enquiry','enquiry.enquiry_id','=','deployment_process.enquiry_id')
           ->leftJoin('client','client.client_id','=','enquiry.client_id')
           ->leftJoin('jobs','jobs.job_id','=','deployment_process.job_id')
           ->leftJoin('client_location','client_location.client_location_id','=','deployment_process.location_id')
           ->leftJoin('categories','categories.category_id','=','jobs.job_main_category_id')
           ->where('candidate_id',$personal->candidate_id)->get();


      


        $data['client']=DB::table('client')->get();


        
        return view('personal.show',compact('personal'),$data);
    }



     public function getEnquirydata(Request $request)
           {

            $enquirys = DB::table("enquiry")
            ->where("client_id",$request->client_id)
            ->pluck("enquiry_title","enquiry_id");
              return response()->json($enquirys);

       }


        public function getJobdata(Request $request)
         {
         $jobs = DB::table("jobs")
         ->join('categories', 'jobs.job_main_category_id', '=', 'categories.category_id')
         ->where("enquiry_id",$request->enquiry_id)
         ->pluck("categories.category_name","job_id");
         return response()->json($jobs);
         }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personal=Personal::find($id);
        $data['educations']=DB::table('education')->where('candidate_id',$personal->candidate_id)->get();
        $data['profesionals']=DB::table('profesional')->where('candidate_id',$personal->candidate_id)->get();
        $data['experiences']=DB::table('experience')->where('candidate_id',$personal->candidate_id)->get();
        $data['seminars']=DB::table('seminar')->where('candidate_id',$personal->candidate_id)->get();
        $data['beneficiaries']=DB::table('beneficiary')->where('candidate_id',$personal->candidate_id)->get();
        $data['dependentss']=DB::table('dependents')->where('candidate_id',$personal->candidate_id)->get();
        $data['candidate_documents']=DB::table('candidate_documents')->where('candidate_id',$personal->candidate_id)->get();
        $data['document']=DB::table('document_type')->get();
        $data['country']=DB::table('country')->select('country_name','country_id')->distinct()->get();
        $data['passport']=DB::table('passport')->where('candidate_id',$personal->candidate_id)->get();
        $data['branch'] = DB::table('branch')->get();

        $data['branchnames'] = 
           DB::table('branch')
           ->leftJoin('personal','personal.branch_id','=','branch.branch_id')
           ->leftJoin('users','users.id','=','personal.user_id')
           ->where('id',auth()->user()->id)->first();

        return view('personal.edit',compact('personal'),$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $personal=Personal::find($id);
        $personal->name =$request->name ;
        $personal->middle_name =$request->middle_name;
        $personal->last_name=$request->last_name;
        $personal->father_name =$request->father_name;
        $personal->mother_name =$request->mother_name;
        $personal->citizenship =$request->citizenship;
        $personal->date_of_birth=$request->date_of_birth;
        $personal->place_of_birth =$request->place_of_birth ;
        $personal->gender=$request->gender;
        $personal->merital_status =$request->merital_status;
        $personal->age =$request->age;
        $personal->height =$request->height;
        $personal->weight=$request->weight;
        $personal->religion=$request->religion ;
        $personal->language =$request->language;
        $personal->other_skill =$request->other_skill;
        $personal->computer_skill=$request->computer_skill;
        $personal->hobbies_sport=$request->hobbies_sport ;
        $personal->branch_id=$request->branch_id ;
        $personal->email=$request->email ;
        $personal->mobile_no=$request->countrycode_mobile_no."-".$request->mobile_no;
        $personal->email2=$request->email2 ;
        $personal->mobile_no2=$request->countrycode_mobile_no2."-".$request->mobile_no2;
        $personal->aadhar_card=$request->aadhar_card ;
        $personal->pan_card=$request->pan_card ;
        $personal->driving_licence=$request->driving_licence ;
        $personal->type=$request->userstype ;
        $personal->reffer_by=$request->reffer_by;
        $personal->save();



        $user=  User::find($personal->user_id);
        $user->name= $request->name;
        $user->email= $request->user_email;
        $user->password=bcrypt($request->user_password);
        $user->phone= $request->mobile_no;
        $user->user_type=$request->userstype ;
        $user->save();

       

           $passport = Passport::where('candidate_id',$personal->candidate_id)->first();
        if(!empty($passport)){
           $passport->passport_no=$request->passport_no;
           $passport->date_issue= $request->issue;
           $passport->date_expire=$request->expire;
           $passport->place_issue=$request->place;
           $passport->save();
         }else{
            
           $passport = new Passport();
           $passport->candidate_id=$personal->candidate_id;
           $passport->passport_no=$request->passport_no;
           $passport->date_issue= $request->issue;
           $passport->date_expire=$request->expire;
           $passport->place_issue=$request->place;
           $passport->save();

         }

if(isset($request->education_id)){
 foreach ($request->education_id as  $key => $education_id) {

                if($education_id!=''){
                    $educationUpdate=array(
                                          'education_type'=> $request->education_type[$key],
                                          'school_university_name'=> $request->school_university_name[$key],
                                          'course_name'=> $request->course_name[$key],
                                          'completed_year'=> $request->completed_year[$key],
                                          'board_rate'=> $request->board_rate[$key],
                                          );
                    $educations=Education::where('education_id',$education_id)->first();
                    $educations->update($educationUpdate);

                }else{
                        $dataCreate= new Education();
                        $dataCreate->education_type=$request->education_type[$key];
                        $dataCreate->school_university_name=$request->school_university_name[$key];
                        $dataCreate->course_name=$request->course_name[$key];
                        $dataCreate->completed_year=$request->completed_year[$key];
                        $dataCreate->board_rate=$request->board_rate[$key];
                        $dataCreate->candidate_id=$id;
                        $dataCreate->save();
                     }
   }///end of for
}

if(isset($request->profession_id)){
          foreach ($request->profession_id as  $prof => $profession_id) {

                if($profession_id!=''){
                    $profesionalUpdate=array(
                                          'type_of_licence'=> $request->type_of_licence[$prof],
                                          'licence_no'=> $request->licence_no[$prof],
                                          'date_issue'=> $request->date_issue[$prof],
                                          'place_issue'=> $request->place_issue[$prof],
                                          'remark'=> $request->remark[$prof],
                                          );
                    $profesionals=Profesional::where('profession_id',$profession_id)->first();
                    $profesionals->update($profesionalUpdate);

                }else{
                        $profesionalCreate= new Profesional();
                        $profesionalCreate->type_of_licence=$request->type_of_licence[$prof];
                        $profesionalCreate->licence_no=$request->licence_no[$prof];
                        $profesionalCreate->date_issue=$request->date_issue[$prof];
                        $profesionalCreate->place_issue=$request->place_issue[$prof];
                        $profesionalCreate->remark=$request->remark[$prof];
                        $profesionalCreate->candidate_id=$id;
                        $profesionalCreate->save();
                     }
   }///end of for
}

if(isset($request->experience_id)){
             foreach ($request->experience_id as  $edu => $experience_id) {

                if($experience_id!=''){
                    $experienceUpdate=array(
                                          'company_name'=> $request->company_name[$edu],
                                          'location'=> $request->location[$edu],
                                          'designation'=> $request->designation[$edu],
                                          'from_date'=> $request->from_date[$edu],
                                          'to_date'=> $request->to_date[$edu],
                                          'type'=> $request->type[$edu],
                                          'totalyear'=> $request->totalyear[$edu],
                                          );
                    $experiences=Experience::where('experience_id',$experience_id)->first();
                    $experiences->update($experienceUpdate);

                }else{
                        $experienceCreate= new Experience();
                        $experienceCreate->company_name=$request->company_name[$edu];
                        $experienceCreate->location=$request->location[$edu];
                        $experienceCreate->designation=$request->designation[$edu];
                        $experienceCreate->from_date=$request->from_date[$edu];
                        $experienceCreate->to_date=$request->to_date[$edu];
                        $experienceCreate->type=$request->type[$edu];
                        $experienceCreate->totalyear=$request->totalyear[$edu];
                        $experienceCreate->candidate_id=$id;
                        $experienceCreate->save();
                     }
   }///end of for
}

if(isset($request->seminar_id)){

                foreach ($request->seminar_id as  $sem => $seminar_id) {

                if($seminar_id!=''){
                    $seminarUpdate=array(
                                          'course_title'=> $request->course_title[$sem],
                                          'training_center'=> $request->training_center[$sem],
                                          'seminar_held'=> $request->seminar_held[$sem],
                                          'completion_date'=> $request->completion_date[$sem],
                                          'remark'=> $request->seminar_remark[$sem],
                                          );
                    $seminars=Seminar::where('seminar_id',$seminar_id)->first();
                    $seminars->update($seminarUpdate);

                }else{
                        $seminar= new Seminar();
                        $seminar->course_title=$request->course_title[$sem];
                        $seminar->training_center=$request->training_center[$sem];
                        $seminar->seminar_held=$request->seminar_held[$sem];
                        $seminar->completion_date=$request->completion_date[$sem];
                        $seminar->remark=$request->seminar_remark[$sem];
                        $seminar->candidate_id=$id;
                        $seminar->save();
                     }
   }///end of for

}

if(isset($request->beneficiary_id)){

     foreach ($request->beneficiary_id as  $sem => $beneficiary_id) {

                if($beneficiary_id!=''){
                    $beneficiaryUpdate=array(
                                          'beneficiary_type'=> $request->beneficiary_type[$sem],
                                          'beneficiary_name'=> $request->beneficiary_name[$sem],
                                          'beneficiary_family_name'=> $request->beneficiary_family_name[$sem],
                                          'beneficiary_mi'=> $request->beneficiary_mi[$sem],
                                          'beneficiary_mobile'=> $request->phone_no[$sem],
                                          'email'=> $request->email_address[$sem],
                                          'beneficiary_birth_date'=> $request->beneficiary_birth_date[$sem],
                                          'beneficiary_address'=> $request->beneficiary_address[$sem],
                                          'beneficiary_zip'=> $request->beneficiary_zip[$sem],
                                          );
                    $beneficiarys=Beneficiary::where('beneficiary_id',$beneficiary_id)->first();
                    $beneficiarys->update($beneficiaryUpdate);

                }else{
                        $beneficiary= new Beneficiary();
                        $beneficiary->beneficiary_type=$request->beneficiary_type[$key];
                        $beneficiary->beneficiary_name=$request->beneficiary_name[$key];
                        $beneficiary->beneficiary_family_name=$request->beneficiary_family_name[$key];
                        $beneficiary->beneficiary_mi=$request->beneficiary_mi[$key];
                        $beneficiary->beneficiary_mobile=$request->phone_no[$key];
                        $beneficiary->email=$request->email_address[$key];
                        $beneficiary->beneficiary_birth_date=$request->beneficiary_birth_date[$key];
                        $beneficiary->beneficiary_address=$request->beneficiary_address[$key];
                        $beneficiary->beneficiary_zip=$request->beneficiary_zip[$key];
                        $beneficiary->candidate_id=$id;
                        $beneficiary->save();
                     }
   }///end of for
}

if(isset($request->dependent_id)){

             foreach ($request->dependent_id as  $dep => $dependent_id) {

                if($dependent_id!=''){
                    $dependentsUpdate=array(
                                          'dependent_relation'=> $request->dependent_relation[$dep],
                                          'first_name'=> $request->first_name[$dep],
                                          'family_name'=> $request->family_name[$dep],
                                          'dependent_mi'=> $request->dependent_mi[$dep],
                                          'mobile_no'=> $request->phone_no1[$dep],
                                          'email'=> $request->email_address1[$dep],
                                          'birth_date'=> $request->birth_date[$dep],
                                          'occupation'=> $request->occupation[$dep],
                                          'gender'=> $request->genders[$dep],
                                          'status'=> $request->status[$dep],
                                          'emp'=> $request->emp[$dep],
                                          );
                    $dependents=Dependents::where('dependent_id',$dependent_id)->first();
                    $dependents->update($dependentsUpdate);

                }else{
                        $dependents= new Dependents();
                        $dependents->dependent_relation=$request->dependent_relation[$dep];
                        $dependents->first_name=$request->first_name[$dep];
                        $dependents->family_name=$request->family_name[$dep];
                        $dependents->dependent_mi=$request->dependent_mi[$dep];
                        $dependents->mobile_no=$request->phone_no1[$dep];
                        $dependents->email=$request->email_address1[$dep];
                        $dependents->birth_date=$request->birth_date[$dep];
                        $dependents->occupation=$request->occupation[$dep];
                        $dependents->gender=$request->genders[$dep];
                        $dependents->status=$request->status[$dep];
                        $dependents->emp=$request->emp[$dep];
                        $dependents->candidate_id=$id;
                        $dependents->save();
                     }
   }///end of for
}
         

  //$candidatefolderpath=DB::table('candidate_documents')->where('candidate_id',$personal->candidate_id)->first();
  $path =DB::table('personal')->where('candidate_id',$personal->candidate_id)->first();
  $pathToStore =$path->directory_path;

  $images = request()->file('document_path');    
  $names  = request('document_title');

if(isset($request->document_id)){
  foreach ($request->document_id as  $index => $value) {

     if($value!=''){
               if(isset($images[$index])) {
                   if($request->hasFile('document_path') && isset($images[$index])){


         // -------------unlink img-----------
            $cand_path=  DB::table('candidate_documents')->where('document_id',$value)->first();
            $file=$cand_path->document_path;
            $filename=public_path('documents/Candidate/'.$pathToStore."/".$file);
              if(!empty($file)){
                   if (File::exists($filename)) {       
                       unlink($filename);
                }
              }
          //------------unlink img-------------


                         //$pathToStore =$candidatefolderpath->folder_path;
                         $img_name = $images[$index]->getClientOriginalName();
                         $images[$index]->move('documents/Candidate/' .$pathToStore,$img_name);

                           $documentUpdate=array(
                                   'document_path' => "{$img_name}",
                                   'document_title' => $names[$index],
                                   'date_updated'=> strtotime(Date('Y-m-d')),
                                );
                            $document=CandidateDocument::where('document_id',$value)->first();
                            $document->update($documentUpdate);
                   }
                }

      }else{
                 if(isset($images[$index])) {
                       if($request->hasFile('document_path') && isset($images[$index])) {
                            //$pathToStore =$request->name.'_'.$personal->candidate_id;
                            $img_name = $images[$index]->getClientOriginalName();
                            $images[$index]->move('documents/Candidate/' .$pathToStore,$img_name);

                            $candidatedocument = new CandidateDocument([
                               'document_path' => "{$img_name}",
                               'document_title' => $names[$index],
                               'candidate_id'=> $personal->candidate_id,
                               'date_submited'=> strtotime(Date('Y-m-d')),
                                ]);
                            $candidatedocument->save();
                           
                      }
                    }

        }
}///end of for
}




     if($personal->type=='Candidate'){
        return redirect()->route('personal.index')->with('success','Candided Updated Successfully');
     }else{
        return redirect()->route('user.index')->with('success','User Updated Successfully');
     }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $personal=DB::table('personal')->where('candidate_id',$id)->first();
        $passport=DB::table('passport')->where('candidate_id',$personal->candidate_id)->delete();
        $educations=DB::table('education')->where('candidate_id',$personal->candidate_id)->delete();
        $profesionals=DB::table('profesional')->where('candidate_id',$personal->candidate_id)->delete();
        $experiences=DB::table('experience')->where('candidate_id',$personal->candidate_id)->delete();
        $seminars=DB::table('seminar')->where('candidate_id',$personal->candidate_id)->delete();
        $beneficiaries=DB::table('beneficiary')->where('candidate_id',$personal->candidate_id)->delete();
        $dependentss=DB::table('dependents')->where('candidate_id',$personal->candidate_id)->delete();
        $candidate_documents=DB::table('candidate_documents')->where('candidate_id',$personal->candidate_id)->delete();
        $users=DB::table('users')->where('id',$personal->user_id)->delete();
         File::deleteDirectory(public_path('documents/Candidate/'.$personal->directory_path));
        $personalD=DB::table('personal')->where('candidate_id',$id)->delete();


        return redirect()->route('personal.index')->with('success','Candided Deleted Successfully');

      
    }
}
