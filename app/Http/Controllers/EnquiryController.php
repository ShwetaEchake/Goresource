<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Job;
use App\Models\Client;
use App\Models\AssignEnquiryBranch;
use Illuminate\Http\Request;
use DB;
use PDF;
use File;
use App\Models\EnquiryDocument;
use App\Models\ProjectLocation;
use ZipArchive;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


        public function mypdf($id)
    {

        // $pdf = PDF::loadView('enquiry.mypdf');
        // return $pdf->download('enquiry.pdf'); <!-- mypdfprivious -->

          $enquiryDatas = Enquiry::find($id);
          $pdf = PDF::loadView('enquiry.mypdf', compact('enquiryDatas'));
          return $pdf->download($enquiryDatas->enquiry_title.'.pdf');
    }


//         public function template(Request $request)
//     {
// // print_r($request->id);
// // exit();
//         $pdf = PDF::loadView('enquiry.template');

//         //$pdf->save('documents/TATA_1632833213/REQUIRMENT FOR DEVELOPER_1632833371/template.pdf', $pdf->output());

//         return $pdf->download('template.pdf');


//     }

public function document(){
    return view('enquiry.document');
}

     public function template(Request $request)
 {

  $enquiry=Enquiry::leftjoin('client','enquiry.client_id','=','client.client_id')->where('enquiry_id',$_GET['id'])->first(); 
  $template=DB::table('template')->where('country',$enquiry->client_country)->get();

$clientFolderPath=DB::table('client')->where('client_id',$enquiry->client_id)->select('folder_path')->first();
$enquiryFolderPath=Enquiry::leftjoin('enquiry_documents','enquiry.enquiry_id','=','enquiry_documents.enquiry_id')
                                     ->where('enquiry.enquiry_id',$_GET['id'])->first(); 


// -------------------------PDF Create--------------------
  $files = [];

  // error enquiry start
if(!empty($enquiryFolderPath->folder_path)){

  foreach($template as $templates)
  {
      $view = view('enquiry.template', compact('templates'));
      $html = $view->render();
      $pdf = PDF::loadHTML($html);            
      $pdf->setPaper('a4', 'landscape');


$file = public_path('documents/'.$clientFolderPath->folder_path.'/'.$enquiryFolderPath->folder_path.'/'.'ClientFolder'); 
if (! File::exists($file)) {
$result = mkdir($file);
}

$pdf->save('documents/'.$clientFolderPath->folder_path.'/'.$enquiryFolderPath->folder_path.'/'.'ClientFolder'.'/'.$templates->title.'.pdf'); 
      $files[] = 'documents/'.$templates->template.'.pdf';
  }


// -------------------------PDF Create--------------------------


//-------------------------ZIP Folder----------------------
  $zip = new ZipArchive;
   
        //$fileName = $enquiryFolderPath->enquiry_title.'.zip';
          $fileName = 'documents/'.$clientFolderPath->folder_path.'/'.$enquiryFolderPath->folder_path.'/'.'ClientFolder'.'.zip';

   
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {

            $filezip = File::files(public_path('documents/'.$clientFolderPath->folder_path.'/'.$enquiryFolderPath->folder_path.'/'.'ClientFolder'));

   
            foreach ($filezip as $key => $value) {

            
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
             
            $zip->close();
        }
       return response()->download(public_path($fileName));

//-------------------------ZIP Folder----------------------


}//error enquiry end

  return redirect()->back()->with('success','Save Successfully');
}


 

    
  public function index()
    {
        $Client = Client::where('user_id',auth()->user()->id)->first();
       
        if(auth()->user()->user_type == "Client"){

                $enquiries=Enquiry::where('client_id',$Client->client_id)->orderBy('enquiry_id','desc')->get();
        }
        else if(auth()->user()->user_type == "Executive"){

            $enquiries=
            DB::table('enquiry')
            ->leftJoin('assign_enquiry_branch', 'enquiry.enquiry_id', '=', 'assign_enquiry_branch.enquiry_id')
            ->leftJoin('executive', 'assign_enquiry_branch.branch_id', '=', 'executive.branch_name')
            ->where('executive.user_id', '=', auth()->user()->id)
            ->get();
        
        }

        else{

                $enquiries=Enquiry::orderBy('enquiry_id','desc')->get();

        }
         $data['enquiry'] = DB::table('enquiry')->get();
         $data['jobs'] = DB::table('jobs')->get();

        return view('enquiry.index',['enquiries'=>$enquiries],$data);
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
        $data['categories']=DB::table('categories')->get();
     
        $data['branch']=DB::table('branch')
        ->orderByraw('CHAR_LENGTH(branch_name) ASC')
        ->orderBy('branch_name','ASC')->get();

        $data['client_location']=DB::table('client_location')->get();
        $data['document']=DB::table('enquiry_documenttype')->get();

        return view('enquiry.create',$data);
    }

       public function getCategory(Request $request)
  {
  
    $cities = DB::table("categories")
    ->where("parent_category_id",$request->category_id)
    ->pluck("category_name","category_id");
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
        $enquiry->water_gas =$request->water_gas;
        $enquiry->service_charge =$request->service_charge;
        $enquiry->Save();


       $client=DB::table('client')->where('client_id',$request->client_id)->select('folder_path')->first();
       $enquiry_folderPath = $enquiry->enquiry_title."_".$enquiry->enquiry_id;

           $directory = File::makeDirectory('documents/'.$client->folder_path."/".$enquiry_folderPath);
           $enquiry->directory_path= $enquiry_folderPath ;
           $enquiry->Save();   


/*************** Enquiry Document Upload Start **************/
  $images = request()->file('enquiry_document_path');    
  $names  = request('enquiry_document_title');

  foreach($names as $i => $code) {
    if(isset($images[$i])) {
       if($request->hasFile('enquiry_document_path') && isset($images[$i])) {
            // $pathToStore =$request->name.'_'.time();
            $img_name = $images[$i]->getClientOriginalName();
            $images[$i]->move("documents/".$client->folder_path."/".$enquiry_folderPath, $img_name);
            $enquirydocument = new EnquiryDocument([

               'enquiry_id'=> $enquiry->enquiry_id,
               'enquiry_document_path' => "{$img_name}",
               'enquiry_document_title' => $names[$i],
           ]);
           $enquirydocument->save();
           
      }
    }
  }

 /*************** Enquiry Document Upload End **************/






	$jobIdArrya = array();

  foreach($request->job_main_category_id as $key=>$job_main_category_id) {

            $data= new Job();
            $data->enquiry_id =$enquiry->enquiry_id ;
            $data->client_id=$request->client_id;
            $data->job_main_category_id=$request->job_main_category_id[$key];
          //  $data->job_sub_category_id=$request->job_sub_category_id[$key];
            $data->detail=$request->detail[$key];
            //$data->enquiy_project_location_id=$request->enquiy_project_location_id[$key];
            $data->basic_salary=$request->basic_salary[$key];
            $data->cola_allownces=$request->cola_allownces[$key];
            $data->food_allownce=$request->food_allownce[$key];
              $data->fuel=$request->fuel[$key];
              $data->mobile=$request->mobile[$key];
              $data->other=$request->other[$key];
            $data->transportation_allownce=$request->transportation_allownce[$key];
            $data->accomodation_allownce=$request->accomodation_allownce[$key];   
            $data->medical_allownce=$request->medical_allownce[$key];
            $data->overtime_allownce=$request->overtime_allownce[$key];
            $data->gross_salary=$request->gross_salary[$key];
            $data->save();

	$jobIdArrya[]=$data->job_id;

   //   print_r($request->required_position); 

		 // echo "<br>";


                                // foreach ($_REQUEST['required_position'] as  $key => $value) {
                                //         $projectlocation= new ProjectLocation();
                                //         $projectlocation->enquiry_id =$enquiry->enquiry_id ;
                                //         $projectlocation->job_id =$data->job_id ;
                                //         $projectlocation->location_id=$key;
                                //         $projectlocation->required_position=$value;
                                //         $projectlocation->save();

                                //        }




        }
  
 

//echo $jobId;

	//print_r($jobIdArrya);

  // print_r($request->required_position); 
  // echo "<pre>";

$project=$request->required_position;

//$array = array_map('array_filter', $project);
//$array = array_filter($array);



//    print_r($array);
// exit();

  foreach($project as $mKey=>$mValue) {

	//echo $mKey."=>". $mValue."<br>";

	foreach($mValue AS $mKey2 =>$mValue2 ){

		//echo $mKey."=>". $mValue2."<br>";
    
  	  $projectlocation= new ProjectLocation();
            $projectlocation->enquiry_id =$enquiry->enquiry_id ;
            $projectlocation->job_id =$jobIdArrya[$mKey2];
            $projectlocation->location_id=$mKey;
            $projectlocation->required_position=$mValue2;
            $projectlocation->save();
	
}


   

}


//    foreach($request->location_id as $key=>$location_id) {
    
//         $project=array_filter($request->required_position);
//        if(!empty($project[$key])){
//              $projectlocation= new ProjectLocation();
//              $projectlocation->job_id=$request->job_ids[$key];
//              $projectlocation->enquiry_id=$enquiry->enquiry_id;
//              $projectlocation->location_id=$request->location_id[$key];
//              $projectlocation->required_position=$project[$key];
//              $projectlocation->save();
//         }

// }





if (!empty($_REQUEST['permission'])) {
             foreach ($_REQUEST['permission'] as  $key => $value) {
                        $assignenquirybranch = new AssignEnquiryBranch();
                        $assignenquirybranch->branch_id = $key;
                        $assignenquirybranch->enquiry_id = $enquiry->enquiry_id ;
                        $assignenquirybranch->save();
                }
}

        return redirect()->route('enquiry.index')->with('success','Enquiry Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Enquiry $enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
           $enquiry= Enquiry::find($id);
           $data['client']=DB::table('client')->get();
           $data['enquirys']=DB::table('enquiry')->get();
           $data['jobs']=DB::table('jobs')->where('enquiry_id',$enquiry->enquiry_id)->get();
           $data['projectlocation']=DB::table('project_location')->get();
           $data['categories']=DB::table('categories')->where('parent_category_id',0)->get();
          // $assign_enquiry_branch=DB::table('assign_enquiry_branch')->where('enquiry_id',$enquiry->enquiry_id)->get();
           $data['sub']=DB::table('categories')->get();
           $data['branch']=DB::table('branch')
              ->orderByraw('CHAR_LENGTH(branch_name) ASC')
              ->orderBy('branch_name','ASC')->get();
           $data['assign_enquiry_branch']=DB::table('assign_enquiry_branch')->where('enquiry_id',$enquiry->enquiry_id)->get();
           $data['client_location']=DB::table('client_location')->where('client_id',$enquiry->client_id)->get();
           $data['enquiry_documents']=DB::table('enquiry_documents')->where('enquiry_id',$enquiry->enquiry_id)->get();
           $data['document']=DB::table('enquiry_documenttype')->get();





        return view('enquiry.edit',compact('enquiry'),$data);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $enquiry= Enquiry::find($id);
       
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
        $enquiry->water_gas =$request->water_gas;
        $enquiry->service_charge =$request->service_charge;
        $enquiry->save();
   
   
   
  //$enquiryfolderpath=DB::table('enquiry_documents')->where('enquiry_id',$enquiry->enquiry_id)->select('folder_path')->first();
   $clientFolderPath=DB::table('client')->where('client_id',$request->client_id)->select('folder_path')->first();
   $pathToStore =$enquiry->directory_path;

  $images = request()->file('enquiry_document_path');    
  $names  = request('enquiry_document_title');
  
if(isset($request->enquiry_document_id)){
  foreach ($request->enquiry_document_id as  $index => $value) {

     if($value!=''){
               if(isset($images[$index])) {
                   if($request->hasFile('enquiry_document_path') && isset($images[$index])){


         // -------------unlink img-----------
            $e_path=  DB::table('enquiry_documents')->where('enquiry_document_id',$value)->first();
            $file=$e_path->enquiry_document_path;
            $filename=public_path("documents/".$clientFolderPath->folder_path."/".$pathToStore ."/" . $file);
              if(!empty($file)){
                   if (File::exists($filename)) {       
                       unlink($filename);
                }
              }
          //------------unlink img-------------

                         // $pathToStore =$enquiryfolderpath->folder_path;
                         $img_name = $images[$index]->getClientOriginalName();
                         $images[$index]->move("documents/".$clientFolderPath->folder_path."/".$pathToStore, $img_name);

                           $documentUpdate=array(
                                   'enquiry_document_path' => "{$img_name}",
                                   'enquiry_document_title' => $names[$index],
                                );
                            $document=EnquiryDocument::where('enquiry_document_id',$value)->first();
                            $document->update($documentUpdate);
                   }
                }

      }else{
                 if(isset($images[$index])) {
                       if($request->hasFile('enquiry_document_path') && isset($images[$index])) {
                             // $pathToStore = $enquiry->enquiry_title.'_'.$enquiry->enquiry_id;
                            $img_name = $images[$index]->getClientOriginalName();
                            $images[$index]->move("documents/".$clientFolderPath->folder_path."/".$pathToStore, $img_name);

                            $enquirydocument = new EnquiryDocument([
                               'enquiry_document_path' => "{$img_name}",
                               'enquiry_document_title' => $names[$index],
                               'enquiry_id'=> $id,
                                ]);
                            $enquirydocument->save();
                           
                      }
                    }

        }
}///end of for
}


    foreach ($request->id as  $index => $value) {

	if($value!=''){

     $datad=array(
              'enquiry_id' =>$enquiry->enquiry_id,
              'client_id'=>$request->client_id,
            'job_main_category_id'=> $request->job_main_category_id[$index],
           // 'job_sub_category_id'=> $request->job_sub_category_id [$index],
            //'enquiy_project_location_id'=> $request->enquiy_project_location_id[$index],
            'basic_salary'=> $request->basic_salary [$index],
            'cola_allownces'=> $request->cola_allownces[$index],
            'food_allownce'=> $request->food_allownce [$index],
            'transportation_allownce'=> $request->transportation_allownce[$index],
            'accomodation_allownce'=> $request->accomodation_allownce [$index],
            'medical_allownce'=> $request->medical_allownce [$index],
            'overtime_allownce'=> $request->overtime_allownce[$index],
            'fuel'=>$request->fuel[$index],
            'mobile'=>$request->mobile[$index],
            'other'=>$request->other[$index],
            'detail'=> $request->detail[$index],
            'gross_salary'=> $request->gross_salary[$index],
    );
        $job=Job::where('job_id',$value)->first();
        $job->update($datad);

             	
	   //foreach($request->location_id as $key=>$location_id) {
    
       // $project=array_filter($request->required_position);

		
$LocationArray=$request->required_position;

    foreach($LocationArray AS $mKey22 =>$mValue2 ){
      
           $mLocationArrya=explode("-",$mKey22);

	    if(!empty($mLocationArrya[1])){
	// $dataLocation="";
// print_r($mLocationArrya);
// exit();
        $dataLocation=array(
                 'job_id'=>$mLocationArrya[1],
                 'enquiry_id'=>$enquiry->enquiry_id,
                 'location_id'=>$mLocationArrya[0],
                 'required_position'=>$mValue2,
            );

	//print_r($dataLocation);
        $new_projectlocation=DB::table('project_location')->where('job_id',$mLocationArrya[1])->where('location_id',$mLocationArrya[0])->first();


        if(!empty($new_projectlocation)){
            $project_location=DB::table('project_location')
            ->where('job_id',$mLocationArrya[1])
            ->where('location_id',$mLocationArrya[0])
            ->update($dataLocation);
            
        }else{
            $projectlocation= new ProjectLocation();
            $projectlocation->enquiry_id =$enquiry->enquiry_id ;
            $projectlocation->job_id =$mLocationArrya[1];
            $projectlocation->location_id=$mLocationArrya[0];
            $projectlocation->required_position=$mValue2;
            $projectlocation->save();
         }


        }
}
	

	//exit();

   }else{

		  $data= new Job();
            $data->enquiry_id =$enquiry->enquiry_id ;
            $data->client_id=$request->client_id;
            $data->job_main_category_id=$request->job_main_category_id[$index];
          //  $data->job_sub_category_id=$request->job_sub_category_id[$key];
            $data->detail=$request->detail[$index];
            //$data->enquiy_project_location_id=$request->enquiy_project_location_id[$key];
            $data->basic_salary=$request->basic_salary[$index];
            $data->cola_allownces=$request->cola_allownces[$index];
            $data->food_allownce=$request->food_allownce[$index];
              $data->fuel=$request->fuel[$index];
              $data->mobile=$request->mobile[$index];
              $data->other=$request->other[$index];
            $data->transportation_allownce=$request->transportation_allownce[$index];
            $data->accomodation_allownce=$request->accomodation_allownce[$index];   
            $data->medical_allownce=$request->medical_allownce[$index];
            $data->overtime_allownce=$request->overtime_allownce[$index];
            $data->gross_salary=$request->gross_salary[$index];
            $data->save();

        
$LocationArr=$request->required_position;
// print_r($LocationArr);
// exit();
    foreach($LocationArr AS $mKey23 =>$mValue23 ){
      
           $mLocationArry=explode("-",$mKey23);

           if(empty($mLocationArry[1])){
            $projectlocation= new ProjectLocation();
            $projectlocation->enquiry_id =$enquiry->enquiry_id ;
            $projectlocation->job_id =$data->job_id;
            $projectlocation->location_id=$mLocationArry[0];
            $projectlocation->required_position=$mValue23;
            $projectlocation->save();

        }
      }
         }
         








}///end of for

$assignenquirybranch=DB::table('assign_enquiry_branch')
                    ->where('enquiry_id',$enquiry->enquiry_id)->delete();


if (!empty($_REQUEST['permission'])) {
             foreach ($_REQUEST['permission'] as  $key => $value) {
                        $assignenquirybranch = new AssignEnquiryBranch();
                        $assignenquirybranch->branch_id = $key;
                        $assignenquirybranch->enquiry_id = $enquiry->enquiry_id ;
                        $assignenquirybranch->save();
                }
}





        return redirect()->route('enquiry.index')->with('success','Enquiry Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $enquiry=DB::table('enquiry')->leftJoin('client','client.client_id','=','enquiry.client_id')->where('enquiry_id',$id)->first();
        $job=DB::table('jobs')->where('enquiry_id',$enquiry->enquiry_id)->delete();
        $project_location=DB::table('project_location')->where('enquiry_id',$enquiry->enquiry_id)->delete();
        $assign_enquiry=DB::table('assign_enquiry_branch')->where('enquiry_id',$enquiry->enquiry_id)->delete();
        $enquiry_documents=DB::table('enquiry_documents')->where('enquiry_id',$enquiry->enquiry_id)->delete();

        File::deleteDirectory(public_path('documents/'.$enquiry->folder_path."/".$enquiry->directory_path));
        $enquiry=DB::table('enquiry')->where('enquiry_id',$id)->delete();
        return redirect()->route('enquiry.index')->with('success','Enquiry Deleted Successfully');

    }
}
