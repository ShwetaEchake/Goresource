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

?>


<style type="text/css">  
    table td, table th{  
        border: 0.5px solid #c6c6c6;  
       padding: 10px;
font-family: Helvetica, Arial, Sans-Serif;
text-transform: uppercase;
font-size: 10px;
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

  $candidatedocuments=CandidateDocument::leftjoin('document_type','document_type_id','=','candidate_documents.document_title')
  ->where('candidate_id',$_GET['id'])->get(); 

  $passport=Passport::where('candidate_id',$_GET['id'])->first(); 
  ?>




<!DOCTYPE html>
<html>
  
<head>
    <title></title>
    <style>
        table, th, td {

            border:  0.5px #c6c6c6;
            border-collapse: collapse;
            padding: 10px;
            text-align:left;
            margin:0;
            padding:0;
font-family: Helvetica, Arial, Sans-Serif;
text-transform: uppercase;
font-size: 10px;
        }
  
    </style>
</head>
  
<body>
    <center>

        <table width="100%;">
          

            <tr>
                <th width="20%"><img src="{{public_path()}}/img/GOLOGOtm-2020.png" width="200px"></th>
                <th width="20%"><h2>Application Form</h3></th>
                <th width="20%"><img src=""></th>
                <th rowspan="8">
                      <?php $candidate_documents=CandidateDocument::leftjoin('document_type','document_type_id','=','candidate_documents.document_title')
                          ->where('candidate_id',$_GET['id'])
                          ->where('document_type_name','color photo')->first(); 
                        
                         if(isset($candidate_documents)){ ?>
                               <img src="{{asset('documents/Candidate/' .$candidate->directory_path.'/'.$candidate_documents->document_path)}}" 
                                        width="160px"  alt="Image">
                       <?php } ?>
                    
                </th>
            </tr>

            <tr>
                <td colspan="4">GOID:</td>              
            </tr>
 <tr>
                <th colspan="2"  width="40%">Date & Time Applied : </th>
                <th colspan="2"  width="40%">Ref By :</th>
            </tr>

<tr>
                <th colspan="2"  width="40%">Country Prefered : </th>
                <th colspan="2"  width="40%">Expected Salary :</th>
            </tr>


		 <tr>
                <td colspan="4">Position Applied For</td>
              
            </tr>


            <tr>
                <th colspan="2"  width="40%">1st Choice</th>
                <th colspan="2"  width="40%">2st Choice</th>
            </tr>
           
            
        </table>

        <table width="100%">

<tr>
                 <th Colspan="4">PERSONAL DATA</th>
               
                 <th  rowspan="14">
                       <?php 
                         if(isset($candidate_documents)){ ?>
                               <img src="{{asset('documents/Candidate/' .$candidate->directory_path.'/'.$candidate_documents->document_path)}}" 
                                        width="300px"  alt="Image">
                       <?php } ?>
                 </th>
              </tr>

 <tr>
                 <th style=" padding:7px;" width="15%" colspan="2">First Name</th>
                                  <th style="border:  solid padding:7px;"  width="15%">Middle Name </th>
                 <td style="  "width="15%">Last Name</td>  
                 
              </tr>
 <tr>
                 <th style=" padding:7px;" width="15%" colspan="2">{{ $candidate->name}}</th>
                 <th style="border:  solid padding:7px;"  width="15%">{{ $candidate->middle_name}} </th>
                 <td style="  "width="15%">{{ $candidate->last_name}}</td>  
                 
              </tr>
 <tr>
                 <th style=" padding:7px;" width="15%" colspan="2">FATHER NAME</th>
             
                 <th style="border:  solid padding:7px;"  width="15%" colspan="2">MOTHER NAME</th>
            
                 
              </tr>
              <tr>
                 <th  width="15%" colspan="2">{{ $candidate->father_name}}</th>
                 <th   width="15%" colspan="2">{{ $candidate->mother_name}}</th>
              
                 
              </tr>

   <tr>
                 <th style=" padding:7px;" width="15%">Citizenship</th>
                 <td style="" width="15%">{{ $candidate->citizenship}}</td>  
                 <th style="border:  solid padding:7px;"  width="15%">Height (Ft.In) </th>
                 <td style="  "width="15%">{{ $candidate->height}}</td>  
                 
              </tr>
             
              <tr>
                <th style="  "width="2%"> Date of Birth</th>
                <td style="  "width="2%">{{ $candidate->date_of_birth}}</td>
                <th style="  "width="2%">Weight (Kg)</th>
                <td style="  "width="2%">{{ $candidate->weight}}</td> 
              </tr>
              
              <tr>
                <th style="  "width="2%"> Place of Birth</th>
                <td style="  "width="2%">{{ $candidate->place_of_birth}}</td>
                <th style="  "width="2%">Age</th>
                <td style="  "width="2%">{{ $candidate->age}}</td>  
              </tr>
               
             <tr>
                <th style="  "width="2%">Gender</th>
                <td style="  "width="2%">{{ $candidate->gender}}</td>
                <th style="  "width="2%">Religion</th>
                <td style="  "width="2%">{{ $candidate->religion}}</td> 
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






</div>  


 <h3> Documents:</h3>

   <table>  
        <tr>        
       
          <th>Document Path</th>       
        </tr>  

              @foreach($candidatedocuments as $documents)
           <tr>
                
                  <td>
                     <img src="{{asset('documents/Candidate/' .$candidate->directory_path.'/'.$documents->document_path)}}" 
                             width="700px" alt="Image">
<br>
  
                       {{$documents->document_type_name}}
<br>
                  </td>
           </tr>
                @endforeach
    </table>  


</div>  





</body>
  
</html>                 





            
     
