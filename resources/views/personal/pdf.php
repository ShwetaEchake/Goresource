<?php

use App\Models\Personal;
use App\Models\Education;
use App\Models\Profesional;
use App\Models\Experience;
use App\Models\Seminar;
use App\Models\Beneficiary;
use App\Models\Dependents;
use App\Models\CandidateDocument;
use App\Models\DocumentType;
use App\Models\Passport;

echo "MAhesh";
?>


<style type="text/css">  
    table td, table th{  
        border:1px solid black;  
    }  
</style>  
<div class="container">  
  <?php 
  $candidate=Personal::where('candidate_id',$_GET['id'])->first(); 
  $educations=Education::where('candidate_id',$_GET['id'])->get(); 
  $profesionals=Profesional::where('candidate_id',$_GET['id'])->get(); 
  $experiences=Experience::where('candidate_id',$_GET['id'])->get(); 
  $seminars=Seminar::where('candidate_id',$_GET['id'])->get(); 
  $beneficiaries=Beneficiary::where('candidate_id',$_GET['id'])->get(); 
  $dependentss=Dependents::where('candidate_id',$_GET['id'])->get(); 

  $candidatedocuments=CandidateDocument::where('candidate_id',$_GET['id'])->get(); 

  $passport=Passport::where('candidate_id',$_GET['id'])->first(); 
  ?>




<!DOCTYPE html>
<html>
  
<head>
    <title></title>
    <style>
        table, th, td {

            border: 1px solid black;
            border-collapse: collapse;
            padding: 6px;
            text-align:center;
            margin:0;
            padding:0;
        }
  
    </style>
</head>
  
<body>
    <center>

        <table width="100%;">
            <tr>
                <th colspan="3" >PERSONAL DATA</th>
                <th></th>
            </tr>

            <tr>
                <th style="border: 1px solid; padding:12px;" width="20%">First Name</th>
                <th style="border: 1px solid; padding:12px;" width="20%">Middle Name</th>
                <th style="border: 1px solid; padding:12px;" width="20%">Last Name</th>
                <th rowspan="5">
                      <?php $candidate_documents=CandidateDocument::leftjoin('document_type','document_type_id','=','candidate_documents.document_title')
                          ->where('candidate_id',$_GET['id'])
                          ->where('document_type_name','color photo')->first(); 
                        
                         if(isset($candidate_documents)){ ?>
                               <img src="{{asset('documents/Candidate/' .$candidate_documents->folder_path.'/'.$candidate_documents->document_path)}}" 
                                        width="110px" height="110px"  alt="Image">
                       <?php } ?>
                    
                </th>
            </tr>

            <tr>
                <td>{{ $candidate->name}}</td>
                <td>{{ $candidate->middle_name}}</td>
                <td>{{ $candidate->last_name}}</td>
            </tr>

            <tr>
                <th colspan="1"  style="border: 1px solid; padding:12px;" width="30%">Father Name</th>
                <th colspan="2"  style="border: 1px solid; padding:12px;" width="30%">Mother Name</th>
            </tr>
           
            <tr>
                <td colspan="1" >{{ $candidate->father_name}}</td>
                <td colspan="2" >{{ $candidate->mother_name}}</td>
            </tr>
        </table>

        <table width="100%">
              <tr>
                 <th style="border: 1px solid; padding:7px;" width="15%">Citizenship</th>
                 <td style="border: 1px solid;" width="15%">{{ $candidate->citizenship}}</td>  
                 <th style="border: 1px solid padding:7px;"  width="15%">Height (Ft.In) </th>
                 <td style="border: 1px solid;  "width="15%">{{ $candidate->height}}</td>  
                 <th colspan="7" rowspan="10">
                       <?php $candidate_documents=CandidateDocument::leftjoin('document_type','document_type_id','=','candidate_documents.document_title')
                          ->where('candidate_id',$_GET['id'])
                          ->where('document_type_name','color photo')->first(); 
                        
                         if(isset($candidate_documents)){ ?>
                               <img src="{{asset('documents/Candidate/' .$candidate_documents->folder_path.'/'.$candidate_documents->document_path)}}" 
                                        width="170px" height="170px"  alt="Image">
                       <?php } ?>
                 </th>
              </tr>
             
              <tr>
                <th style="border: 1px solid;  "width="2%"> Date of Birth</th>
                <td style="border: 1px solid;  "width="2%">{{ $candidate->date_of_birth}}</td>
                <th style="border: 1px solid;  "width="2%">Weight (Kg)</th>
                <td style="border: 1px solid;  "width="2%">{{ $candidate->weight}}</td> 
              </tr>
              
              <tr>
                <th style="border: 1px solid;  "width="2%"> Place of Birth</th>
                <td style="border: 1px solid;  "width="2%">{{ $candidate->place_of_birth}}</td>
                <th style="border: 1px solid;  "width="2%">Age</th>
                <td style="border: 1px solid;  "width="2%">{{ $candidate->age}}</td>  
              </tr>
               
             <tr>
                <th style="border: 1px solid;  "width="2%">Gender</th>
                <td style="border: 1px solid;  "width="2%">{{ $candidate->gender}}</td>
                <th style="border: 1px solid;  "width="2%">Religion</th>
                <td style="border: 1px solid;  "width="2%">{{ $candidate->religion}}</td> 
             </tr>
      
      
              <tr>
                <th> Marital Status</th>
                <td colspan="3" >{{ $candidate->merital_status}}</td>
              </tr>
              
               <tr>
                <th> Language</th>
                <td colspan="3">{{ $candidate->language}}</td> 
              </tr>

              <tr>
                <th >  Passport No.</th>
                @if(isset($passport->passport_no))
                 <td colspan="3">{{$passport->passport_no}}</td>
                @endif
              </tr>

              <tr>
                <th>  Date Issued</th>
                 @if(isset($passport->date_issue))
                   <td colspan="3">{{date('Y-m-d',strtotime($passport->date_issue))}}</td>
                 @endif
              </tr>

              <tr>
                <th>Date Expire </th>
                 @if(isset($passport->date_expire))
                  <td colspan="3">{{date('Y-m-d',strtotime($passport->date_expire))}}</td> 
                 @endif
              </tr>

              <tr>
                <th >  Place Issued</th>
                 @if(isset($passport->place_issue))
                   <td colspan="3">{{$passport->place_issue}}</td>
                 @endif
              </tr>
            
            
        </table>

        <table width="100%">

          <tr>
            <th colspan="7" style="text-align: left; padding-left: 5px;">EDUCATION</th>
          </tr>
              <tr>
                <th>Degree</th>
                <th>Name of School/University</th>
                <th>Course Name</th>
                <th>Year Graduated</th>
                <th colspan="3">Board Rate (Ave)</th>
              </tr>
           @foreach($educations as $education)
           <tr>
             <td>{{ $education->education_type}}</td>
             <td>{{ $education->school_university_name}}</td>
             <td>{{ $education->course_name  }}</td>
              <td>{{ $education->completed_year  }}</td>
             <td colspan="3">{{ $education->board_rate  }}</td> 
           </tr>
               @endforeach
        </table>

       




       <table width="100%">

          <tr>
            <th colspan="7">For PROFESSIONAL APPLICANTS  (and those who passed Board Exams, i.e. Engineers, Architects, CPAs, etc.)</th>
          </tr>
         <tr>  
              <th>Type Of License</th>
              <th>License No</th>
              <th>Date Issued</th>
              <th>Place Issued</th>
              <th colspan="4">Remarks</th>
             
         </tr>  
                @foreach($profesionals as $profesional)
           <tr>
             <td>{{ $profesional->type_of_licence}}</td>
             <td>{{ $profesional->licence_no}}</td>
             <td>{{ $profesional->date_issue  }}</td>
             <td>{{ $profesional->place_issue  }}</td>
             <td colspan="4">{{ $profesional->remark  }}</td> 
            
           </tr>
               @endforeach

               <tr>
                <th>Key Skills</th>
                <th colspan="7"></th>
              </tr>

              <tr>
                <td>Other Skills:</td>
                <td colspan="7" style="text-align: left; padding-left: 5px;" >{{ $candidate->other_skill}}</td>
              </tr>

              <tr>
                <td>Computer Skills:</td>
                <td colspan="7" style="text-align: left; padding-left: 5px;" >{{ $candidate->computer_skill}}</td>
              </tr>

              <tr>
                <td>Hobbies / Sports:</td>
                <td colspan="7" style="text-align: left; padding-left: 5px;" >{{ $candidate->hobbies_sport}}</td>
              </tr>

        </table>
    </center>



     <h3 style="margin-bottom: 0px;"> WORK EXPERIENCE SUMMARY (Please start from present to previous employers)
     </h3>

   <table>  
        <tr>    
               <!--  <th>#</th> -->
                <th>Company Name</th>
                <th>Location(Country)</th>
                <th>Designation (Position)</th>
                <th>From (MM/YY)</th>
                <th>To (MM/YY))</th>
                <th>Type</th>
                <th> Total Years</th>
        </tr>  
               @foreach($experiences as $index => $experience)
           <tr>
             <!-- <td>{{++$index}}</td> -->
             <td>{{ $experience->company_name}}</td>
             <td>{{ $experience->location}}</td>
             <td>{{ $experience->designation  }}</td>
             <td>{{ date('d-m-Y', strtotime($experience->from_date)) }}</td>
             <td>{{ date('d-m-Y', strtotime($experience->to_date))}}</td> 
             <td>{{ $experience->type  }}</td>
             <td>{{ $experience->totalyear }}</td> 

           </tr>
               @endforeach
    </table>  


       <h3 style="margin-bottom: 0px;"> SEMINAR / TRAINING DETAILS </h3>

   <table width="100%">  
        <tr>  
                    <th>Course Title</th>
                    <th>Training Center </th>
                    <th>Seminar Held</th>
                    <th>Date Completed</th>
                    <th>Remarks</th>
        </tr>  
               @foreach($seminars as $seminar)
           <tr>
             <td>{{ $seminar->course_title}}</td>
             <td>{{ $seminar->training_center}}</td>
             <td>{{ $seminar->seminar_held}}</td>
             <td>{{ $seminar->completion_date}}</td>
             <td>{{ $seminar->remark}}</td> 

           </tr>
               @endforeach
    </table>  


      <h3 style="margin-bottom: 0px;"> BENEFICIARY</h3>

   <table width="100%">  
        <tr>  
                    <th>Beneficiary</th>
                    <th>First Name</th>
                    <th>Family Name </th>
                    <th>MI</th>
                    <th>Birth Date</th>
                    <th>Address</th>
                    <th>Zipcode</th>
        </tr>  
                @foreach($beneficiaries as $beneficiary)
           <tr>
            
            <td>{{ $beneficiary->beneficiary_type}}</td>
            <td>{{ $beneficiary->beneficiary_name}}</td>
            <td>{{ $beneficiary->beneficiary_family_name}}</td>
            <td>{{ $beneficiary->beneficiary_mi}}</td>
            <td>{{ $beneficiary->beneficiary_birth_date}}</td>
            <td>{{ $beneficiary->beneficiary_address}}</td>
            <td>{{ $beneficiary->beneficiary_zip}}</td>

           </tr>
               @endforeach
    </table>  

       <h3 style="margin-bottom: 0px;"> DEPENDENTS</h3>

   <table width="100%">  
        <tr>        <th>Dependents</th>
                    <th>First Name</th>
                    <th>Family Name </th>
                    <th>MI</th>
                    <th>Birth Date</th>
                    <th>Occupation </th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Emp</th>
        </tr>  
                @foreach($dependentss as $dependents)
           <tr>
            <td>{{$dependents->dependent_relation}}</td>
            <td>{{ $dependents->first_name}}</td>
            <td>{{ $dependents->family_name}}</td>
            <td>{{ $dependents->dependent_mi}}</td>
            <td>{{ $dependents->birth_date}}</td>
            <td>{{ $dependents->occupation}}</td>
            <td>{{ $dependents->gender}}</td>
            <td>{{ $dependents->status}}</td>
            <td>{{ $dependents->emp}}</td>
         


           </tr>
                @endforeach
    </table>  




</body>
  
</html>                 









</div>  


 <h3> Documents:</h3>

   <table>  
        <tr>        
          <th>Document Type</th>
          <th>Document Path</th>       
        </tr>  

              @foreach($candidatedocuments as $documents)
           <tr>
                   <td>
                       <?php $name = DocumentType::where(['document_type_id'=>$documents->document_title])->first()?>
                       {{$name->document_type_name}}
                  </td>
                  <td>
                     <img src="{{asset('documents/Candidate/' .$documents->folder_path.'/'.$documents->document_path)}}" 
                            width="80px" height="80px"  alt="Image">
                  </td>
           </tr>
                @endforeach
    </table>  


</div>  


            
     
