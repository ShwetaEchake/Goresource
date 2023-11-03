@extends('layouts.admin')
@section('content')


<div class="card">
    <div class="card-header">
       Personal Show
    </div>

    <div class="card-body">
        <div class="form-group">
           
            <table class="table table-bordered table-striped">
                <tbody>
<!-- //personal Start -->
                    <h4>Personal Detail</h4>
                    <tr>
                        <th> Name </th>
                        <th> Middle Name </th>
                        <th> Last Name </th>
                        <th>  Father Name </th>
                     </tr>

                     <tr>
                           <td> {{ $personal->name }}  </td>
                           <td> {{ $personal->middle_name }} </td>
                           <td>  {{ $personal->last_name }}</td>
                           <td> {{ $personal->father_name }} </td>
                    </tr>



                     <tr>
                        <th> Middle Name </th>
                        <th> Citizenship </th>
                        <th> Mobile No </th>
                        <th> Email </th>
                     </tr>

                     <tr>
                           <td>  {{ $personal->mother_name }} </td>
                           <td>  {{ $personal->citizenship }}</td>
                           <td>  {{ $personal->mobile_no }}</td>
                           <td>  {{ $personal->email }}</td>
                    </tr>



                     <tr>
                        <th>Primary Mobile No </th>
                        <th> Primary Email</th>
                        <th> Secondary Mobile No </th>
                        <th>Secondary Email </th>
                     </tr>


                    <tr>
                           <td>  {{ $personal->mobile_no }} </td>
                           <td>  {{ $personal->email }}</td>
                           <td>  {{ $personal->mobile_no2 }}</td>
                           <td>  {{ $personal->email2 }}</td>
                    </tr>



                    <tr>
                        <th>  Date of birth </th>
                        <th>  Place of birth</th>
                        <th> Gender </th>
                        <th>  Merital Status</th>
                     </tr>

                     <tr>
                           <td> {{ $personal->date_of_birth }}</td>
                           <td>{{ $personal->place_of_birth }}</td>
                           <td> {{ $personal->gender }}</td>
                           <td>{{ $personal->merital_status }}</td>
                    </tr>




                    <tr>
                        <th> Age </th>
                        <th> Height</th>
                        <th> Weight </th>
                        <th> Religion</th>
                     </tr>

                     <tr>
                           <td> {{ $personal-> age }}</td>
                           <td>{{ $personal->height }}</td>
                           <td> {{ $personal->weight }}</td>
                           <td>{{ $personal->religion }}</td>
                    </tr>





                    <tr>
                        <th> Language </th>
                        <th> Other Skill</th>
                        <th> Computer Skill </th>
                        <th> Hobbies Sport</th>
                     </tr>

                     <tr>
                           <td> {{ $personal->language }}</td>
                           <td>{{ $personal->other_skill }}</td>
                           <td> {{ $personal->computer_skill }}</td>
                           <td>{{ $personal->hobbies_sport }}</td>
                    </tr>

<!-- //personal End -->



   
                </tbody>
            </table>

<br>



<!-- Passport Start -->

  <table class="table table-bordered table-striped">
                <tbody>
                    <h4>Passport</h4>
                    <tr>
                        <th> Passport No </th>
                        <th> Date Issue</th>
                        <th> Date Expire</th>
                         <th> Place Issue</th>
                     </tr>
        @foreach ($passport as $passports)
                     <tr>
                           <td> 
                          
                                     {{ $passports->passport_no }}
                             
                          </td>
                           <td> 
                            
                                     {{ $passports->date_issue }}
                             
                               </td>
                           <td> 
                            
                                     {{ $passports->date_expire }}
                             
                          </td>
                          <td>
                            
                                     {{ $passports->place_issue }}
                             
                         </td>
                    </tr>

        @endforeach 

                  
      </tbody>
            </table>
<!-- Passport End -->


<br>

<!-- Education Start -->

  <table class="table table-bordered table-striped">
                <tbody>
                    <h4>Education</h4>
                    <tr>
                        <th>  Degree </th>
                        <th> Name of School/University</th>
                        <th> Course Name</th>
                         <th> Year Graduated </th>
                        <th> Board Rate (Ave)</th>
                     </tr>
            @foreach ($educations as $education)
                     <tr>
                           <td> 
                           
                                     {{ $education->education_type }}
                             
                          </td>
                           <td> 
                           
                                     {{ $education->school_university_name }}
                             
                               </td>
                           <td> 
                        
                                     {{ $education->course_name }}
                             
                          </td>
                          <td>
                           
                                     {{ $education->completed_year }}
                             
                         </td>

                          <td>
                           
                                     {{ $education->board_rate }}
                             
                         </td>
                    </tr>

           @endforeach 
                  
      </tbody>
            </table>
<!-- Education End -->


<br>











<!-- Profesional Applicants Start -->

  <table class="table table-bordered table-striped">
                <tbody>
                    <h4>Profesional Applicants</h4>
                    <tr>
                        <th>  Type Of License (PRC) </th>
                        <th>License NO. </th>
                        <th> Date Issued    </th>
                         <th> Place Issued</th>
                           <th> Remarks</th>
                     </tr>
@foreach ($profesionals as $profesional)
                     <tr> 
                           <td> 
                           
                                     {{ $profesional->type_of_licence }}
                              
                          </td>
                           <td> 
                        
                                     {{ $profesional->licence_no }}
                           
                               </td>
                           <td> 
                          
                                     {{ $profesional->date_issue }}
                            
                          </td>
                          <td>
                          
                                     {{ $profesional->place_issue }}
                          
                         </td>

                         <td>
                           
                                     {{ $profesional->remark }}
                              
                         </td>

                    </tr>

@endforeach 
                  
      </tbody>
            </table>
<!-- Profesional Applicants End -->


<br>

<!-- Experience Summary Start -->

  <table class="table table-bordered table-striped">
                <tbody>
                    <h4>Experience Summary</h4>
                    <tr>
                        <th>  Company Name </th>
                        <th>Location(Country)</th>
                        <th> Designation (Position) </th>
                         <th> From (MM/YY)</th>
                           <th> To (MM/YY))</th>

                           <th> Type</th>
                           <th> Total Years</th>
                     </tr>
@foreach ($experiences as $experience)
                     <tr> 
                           <td> 
                           
                                     {{ $experience->company_name }}
                              
                          </td>
                           <td> 
                        
                                     {{ $experience->location }}
                           
                               </td>
                           <td> 
                          
                                     {{ $experience->designation }}
                            
                          </td>
                          <td>
                          
                                     {{ $experience->from_date }}
                          
                         </td>

                         <td>
                           
                                     {{ $experience->to_date }}
                              
                         </td>

                            <td>
                           
                                     {{ $experience->type }}
                              
                         </td>


                            <td>
                           
                                     {{ $experience->totalyear }}
                              
                         </td>

                    </tr>

@endforeach 
                  
      </tbody>
            </table>
<!-- Experience Summary End -->



<br>


<!-- Seminar/Training Details Start -->

  <table class="table table-bordered table-striped">
                <tbody>
                    <h4>Seminar/Training Details </h4>
                    <tr>
                        <th>  Course Title </th>
                        <th>Training Center</th>
                        <th> Seminar Held </th>
                         <th> Date Completed</th>
                           <th> Remarks</th>
                     </tr>
@foreach ($seminars as $seminar)
                     <tr> 
                           <td> 
                           
                                     {{ $seminar->course_title }}
                              
                          </td>
                           <td> 
                        
                                     {{ $seminar->training_center }}
                           
                               </td>
                           <td> 
                          
                                     {{ $seminar->seminar_held }}
                            
                          </td>
                          <td>
                          
                                     {{ $seminar-> completion_date }}
                          
                         </td>

                         <td>
                           
                                     {{ $seminar->remark }}
                              
                         </td>

                          

                    </tr>

@endforeach 
                  
      </tbody>
            </table>
<!-- Seminar/Training Details End -->






<br>


<!-- Beneficiary Start -->

  <table class="table table-bordered table-striped">
                <tbody>
                    <h4>Beneficiary </h4>
                    <tr>
                        <th> Beneficiary </th>
                        <th>First Name  </th>
                        <th>Family Name  </th>
                         <th> MI</th>
                           <th> Birth Date</th>
                           <th>Address</th>
                           <th>Zipcode</th>
                     </tr>
@foreach ($beneficiaries as $beneficiarie)
                     <tr> 
                           <td> 
                           
                                     {{ $beneficiarie->beneficiary_type }}
                              
                          </td>
                           <td> 
                        
                                     {{ $beneficiarie->beneficiary_name }}
                           
                               </td>
                           <td> 
                          
                                     {{ $beneficiarie->beneficiary_family_name }}
                            
                          </td>
                          <td>
                          
                                     {{ $beneficiarie->beneficiary_mi }}
                          
                         </td>

                         <td>
                           
                                     {{ $beneficiarie-> beneficiary_birth_date   }}
                              
                         </td>

                        <!--   <td>
                           
                                     {{ $beneficiarie-> beneficiary_mobile   }}
                              
                         </td> -->


                           <td>
                           
                                     {{ $beneficiarie-> beneficiary_address   }}
                              
                         </td>

                                   <td>
                           
                                     {{ $beneficiarie-> beneficiary_zip   }}
                              
                         </td>



                          

                    </tr>

@endforeach 
                  
      </tbody>
            </table>
<!-- Beneficiary End -->






<br>


<!-- Dependents Start -->

  <table class="table table-bordered table-striped">
                <tbody>
                    <h4>Dependents </h4>
                    <tr>
                        <th>  Dependents </th>
                        <th>First Name</th>
                        <th> Family Name</th>
                         <th> MI</th>
                           <th> Birth Date</th>
                            <th> Occupation</th>
                         <th> Gender</th>
                           <th> Status</th>
                           <th>Emp</th>
                     </tr>
@foreach ($dependentss as $dependents)
                     <tr> 
                           <td> 
                           
                                     {{ $dependents->dependent_relation }}
                              
                          </td>
                           <td> 
                        
                                     {{ $dependents->first_name }}
                           
                               </td>
                           <td> 
                          
                                     {{ $dependents->family_name }}
                            
                          </td>
                          <td>
                          
                                     {{ $dependents-> dependent_mi }}
                          
                         </td>

                         <td>
                           
                                     {{ $dependents->occupation }}
                              
                         </td>

                               <td>
                           
                                     {{ $dependents->birth_date }}
                              
                         </td>

                               <td>
                           
                                     {{ $dependents->gender }}
                              
                         </td>

                              <td>
                           
                                     {{ $dependents->status  }}
                              
                         </td>

                            <td>
                           
                                     {{ $dependents->emp  }}
                              
                         </td>


                          

                    </tr>

@endforeach 
                  
      </tbody>
            </table>
<!-- Dependents End -->






<br>



<!-- Documents -->

  <table class="table table-bordered table-striped">
                <tbody>
                    <h4>Documents </h4>
                    <tr>
                        <th> Title </th>
                        <th>Image</th>
                     
                     </tr>
@foreach ($candidate_documents as $candidate_document)
                     <tr> 
                           <td> 
                           
                                     {{ $candidate_document->document_type_name }}
                              
                          </td>
                           <td> 
                        
                                  <a href="{{asset('documents/Candidate/' .$personal->directory_path.'/'.$candidate_document->document_path)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                           
                               </td>
                           

                          

                    </tr>

@endforeach 
                  
      </tbody>
            </table>
<!-- Documents End -->


<br>
<br>

<?php

$CallStatus=DB::table('call_status')->where('candidate_id',$personal->candidate_id)->first();
?><label>Call History</label>
<textarea readonly class="form-control" >{{$CallStatus->show_remark}} </textarea>

<br>
<br>



@if(auth()->user()->user_type != 'Client')

<!--------------------------------------- Tabs Start --------------------------------------------->


    <div class="col-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-assessment" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Assessment</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-enrollment" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Enrollment</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-interview" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Interview</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-selection" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Selection</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-offers" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Offers</a>
                  </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-medical" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Medical</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-qvc" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">QVC</a>
                  </li>
                 <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-visa" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Visa</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-deployment" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Deployment</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show" id="custom-tabs-three-assessment" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                        <table class="table table-bordered table-striped">
                              <tr>
                                <th>Assessment ID</th>
                                <th>Company Name </th>
                                <th>Enquiry Title</th>
                                <th>Job Title</th>
                                <th>Location</th>
                                <th>Overall Assessment</th>
                               
                                <th>Action</th>
                              </tr>

                              @foreach($assessments as $assessment)
                                  <tr>
                                     <td class="assessment_id">{{$assessment->assessment_id}}</td>
                                     <td>{{$assessment->company_name}}</td>
                                     <td>{{$assessment->enquiry_title}}</td>
                                     <td>{{$assessment->category_name}}</td>
                                     <td>{{$assessment->client_location_code}}</td>
                                     <td>{{$assessment->overall_assessment }}</td>
                            
                                     <td nowrap="">
                                        <button type="button" class="btn btn-sm btn-primary assessmentview_btn" data-toggle="modal" data-target="#assessmentModal">View</i></button>

                                        <a class="btn btn-flat btn-sm btn-primary" title="Pdf"  href="{{url('/assmntprint')}}?id={{$assessment->assessment_id}}"><i class="fa fa-download"></i> </a>&nbsp;

                                     </td>
                                  </tr>
                              @endforeach      
                         </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-enrollment" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                     
                             <table class="table table-bordered table-striped">
                                  <tr>
                                    <th> Candidate Interview ID</th>
                                     <th>Company Name </th>
                                     <th>Enquiry Title</th>
                                     <th>Job Title</th>
                                     <th>Location</th>
                                    <th>Interview Date</th>
                                    <th>Interview Venu</th>
                                    <th>Action</th>
                                  </tr>

                                 @foreach($candidate_interviews as $candidate_interview)
                                      <tr>
                                         <td class="candidate_interview_id">{{$candidate_interview->candidate_interview_id}}</td>
                                         <td>{{$candidate_interview->company_name}}</td>
                                         <td>{{$candidate_interview->enquiry_title}}</td>
                                         <td>{{$candidate_interview->category_name}}</td>
                                        <td>{{$candidate_interview->client_location_code}}</td>
                                         <td>{{ (date('d-m-Y',$candidate_interview->interview_date))}}</td>
                                         <td>{{$candidate_interview->interview_venu}}</td>
                                     
                                         <td nowrap="">
                                            <button type="button" class="btn btn-sm btn-primary sendinterview_btn" data-toggle="modal" data-target="#enrollmentModal"> View </button>

                                            <a class="btn btn-flat btn-sm btn-primary" title="Pdf"  href="{{url('/viewinterviewprint')}}?id={{$candidate_interview->candidate_interview_id}}"><i class=" fa fa-download"></i> </a>&nbsp;
                                         </td>
                                     </tr>
                                 @endforeach 
                            </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-interview" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                      <table class="table table-bordered table-striped">
                                  <tr>
                                    <th>Post Assessment ID</th>
                                    <th>Company Name </th>
                                     <th>Enquiry Title</th>
                                     <th>Job Title</th>
                                     <th>Location</th>
                                    <th>Overall Assessment</th>
                                    <th>Action</th>
                                  </tr>

                                 @foreach($post_assessments as $post_assessment)
                                      <tr>
                                         <td class="post_assessment_id">{{ $post_assessment->post_assessment_id }}</td>
                                          <td>{{$post_assessment->company_name}}</td>
                                         <td>{{$post_assessment->enquiry_title}}</td>
                                         <td>{{$post_assessment->category_name}}</td>
                                         <td>{{$post_assessment->client_location_code}}</td>
                                         <td>{{$post_assessment->overall_assessment}}</td>
                                         <td nowrap="">
                                            <button type="button" class="btn btn-sm  btn-primary postassessview_btn" data-toggle="modal" data-target="#interviewModal">View</button>

                                            <a class="btn btn-flat btn-sm btn-primary" title="Pdf"  href="{{url('/postassmntprint')}}?id={{$post_assessment->post_assessment_id}}"><i class="fa fa-download"></i> </a>&nbsp;

                                         </td>
                                     </tr>
                                 @endforeach 
                        </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-selection" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                   <table class="table table-bordered table-striped">
                                          <tr>
                                            <th>Offer Letter ID</th>
                                           <th>Company Name </th>
                                             <th>Enquiry Title</th>
                                             <th>Job Title</th>
                                             <th>Location</th>
                                           <!--  <th>Issue Date</th>
                                            <th>Signed Date</th>
                                            <th>Refuse Date</th> -->
                                            <th>Action</th>
                                          </tr>

                                         @foreach($offer_letters as $offer_letter)
                                              <tr>
                                                <td class="offer_letter_id">{{$offer_letter->offer_letter_id}}</td>
                                                <td>{{$offer_letter->company_name}}</td>
                                                 <td>{{$offer_letter->enquiry_title}}</td>
                                                 <td>{{$offer_letter->category_name}}</td>
                                                 <td>{{$offer_letter->client_location_code}}</td>
                                               <!--   <td>{{ (date('d-m-Y',$offer_letter->issue_date))  }}</td>
                                                 <td>{{ (date('d-m-Y',$offer_letter->signed_date)) }}</td>
                                                 <td>{{ (date('d-m-Y',$offer_letter->refuse_date)) }} </td> -->
                                                 <td nowrap="">
                                                    <button type="button" class="btn btn-sm btn-primary offer_viewbtn" data-toggle="modal" data-target="#selectionModal">
                                                      View
                                                    </button>

                                                    <a class="btn btn-flat btn-sm btn-primary" title="Pdf"  href="{{url('/offerformprint')}}?id={{$offer_letter->offer_letter_id}}"><i class="fa fa-download"></i> </a>&nbsp;
                                                 </td>
                                             </tr>
                                         @endforeach 
                             </table> 
                  </div>

                    <div class="tab-pane fade" id="custom-tabs-three-offers" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                              <table class="table table-bordered table-striped">
                                          <tr>
                                            <th>Pre-Medical ID </th>
                                           <th>Company Name </th>
                                             <th>Enquiry Title</th>
                                             <th>Job Title</th>
                                             <th>Location</th>
                                            <th>Fit Date</th>
                                            <th>Unfit Date</th>
                                            <th>Action</th>
                                          </tr>

                                         @foreach($pre_medicals as $pre_medical)
                                              <tr>
                                                  <td class="pre_medical_id">{{ $pre_medical->premedical_id }}</td>
                                                 <td>{{$pre_medical->company_name}}</td>
                                                 <td>{{$pre_medical->enquiry_title}}</td>
                                                 <td>{{$pre_medical->category_name}}</td>
                                                 <td>{{$pre_medical->client_location_code}}</td>
                                                 <td>{{ (date('d-m-Y',$pre_medical->fit_date)) }}</td>
                                                 <td>{{ (date('d-m-Y',$pre_medical->unfit_date)) }}</td>
                                                 <td nowrap="">
                                                    <button type="button" class="btn btn-sm btn-primary premedical_viewbtn" data-toggle="modal" data-target="#offersModal">
                                                      View
                                                    </button>
                                                    <a class="btn btn-flat btn-sm btn-primary" title="Pdf"  href="{{url('/premedicalprint')}}?id={{$pre_medical->premedical_id}}"><i class="fa fa-download"></i> </a>&nbsp;
                                                 </td>
                                             </tr>
                                         @endforeach 
                             </table> 
                  </div>

                    <div class="tab-pane fade" id="custom-tabs-three-medical" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                              <table class="table table-bordered table-striped">
                                          <tr>
                                            <th>Qvc ID</th>
                                               <th>Company Name </th>
                                             <th>Enquiry Title</th>
                                             <th>Job Title</th>
                                             <th>Location</th>
                                            <th>Action</th>
                                          </tr>

                                         @foreach($qvc as $qvc_process)
                                              <tr>
                                                 <td class="qvc_id">{{$qvc_process->qvc_id}}</td>
                                                 <td>{{$qvc_process->company_name}}</td>
                                                 <td>{{$qvc_process->enquiry_title}}</td>
                                                 <td>{{$qvc_process->category_name}}</td>
                                                 <td>{{$qvc_process->client_location_code}}</td>
                                                


                                                 <td nowrap="">
                                                    <button type="button" class="btn btn-sm btn-primary qvc_viewbtn" data-toggle="modal"   data-target="#medicalModal">
                                                       View
                                                   </button>

                                                    <a class="btn btn-flat btn-sm btn-primary" title="Pdf"  href="{{url('/qvcprint')}}?id={{$qvc_process->qvc_id}}"><i class="fa fa-download"></i> </a>&nbsp;
                                                 </td>
                                             </tr>
                                         @endforeach 
                              </table> 
                  </div>

                 <div class="tab-pane fade" id="custom-tabs-three-qvc" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                          <table class="table table-bordered table-striped">
                                      <tr>
                                        <th>Visa ID</th>
                                        <th>Company Name</th>
                                         <th>Enquiry Title</th>
                                         <th>Job Title</th>
                                         <th>Location</th>
                                        <th>Action</th>
                                      </tr>

                                     @foreach($visa as $visa_process)
                                          <tr>
                                             <td class="visa_id">{{ $visa_process->visa_id }} </td>
                                                 <td>{{$visa_process->company_name}}</td>
                                                 <td>{{$visa_process->enquiry_title}}</td>
                                                 <td>{{$visa_process->category_name}}</td>
                                                 <td>{{$visa_process->client_location_code}}</td>
                                                
                                             <td>
                                                <button type="button" class="btn btn-sm btn-primary visa_viewbtn" data-toggle="modal" data-target="#qvcModal">
                                                 View
                                               </button>
                                                 <a class="btn btn-flat btn-sm btn-primary" title="Pdf"  href="{{url('/visaprint')}}?id={{$visa_process->visa_id}}"><i class="fa fa-download"></i> </a>&nbsp;
                                             </td>
                                         </tr>
                                     @endforeach 
                          </table> 
                  </div>

                 <div class="tab-pane fade" id="custom-tabs-three-visa" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                             <table class="table table-bordered table-striped">
                                          <tr>
                                            <th>Deployment Id</th>
                                           <th>Company Name</th>
                                             <th>Enquiry Title</th>
                                             <th>Job Title</th>
                                             <th>Location</th>
                                       
                                            <th>Action</th>
                                          </tr>

                                         @foreach($deployment as $deployment_process)
                                              <tr>
                                                 <td class="deployment_id">{{$deployment_process->deployment_id}} </td>
                                                 <td>{{$deployment_process->company_name}}</td>
                                                 <td>{{$deployment_process->enquiry_title}}</td>
                                                 <td>{{$deployment_process->category_name}}</td>
                                                 <td>{{$deployment_process->client_location_code}}</td>
                                            
                                                 <td nowrap="">
                                                    <button type="button" class="btn btn-sm btn-primary deployment_viewbtn" data-toggle="modal" data-target="#visaModal">
                                                     View
                                                   </button>
                                                   
                                                    <a class="btn btn-flat btn-sm btn-primary" title="Pdf"  href="{{url('/deploymentprint')}}?id={{$deployment_process->deployment_id}}"><i class="fa fa-download"></i> </a>&nbsp;
                                                 </td>
                                             </tr>
                                         @endforeach 
                             </table> 
                  </div>

                   <div class="tab-pane fade" id="custom-tabs-three-deployment" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                           <table class="table table-bordered table-striped">
                              <tr>
                                <th>Company Name </th>
                                <th>Enquiry Title</th>
                                <th>Job Title</th>
                                                       
                              </tr>

                              @foreach($deployment as $dep)
                                  <tr>
                                     <td>{{$dep->company_name}}</td>
                                     <td>{{$dep->enquiry_title}}</td>
                                     <td>{{$dep->category_name}}</td>
                            
                                  </tr>
                              @endforeach      
                         </table>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
   </div>
        


<!--------------------------------------- Tabs End --------------------------------------------->




<!------------------------------------- Assessment Modal Start------------------------------->
<div class="modal fade" id="assessmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
       <!-------------------------- //Assessment Start ------------------------------------>
<div class="student_viewing_data">
           <table class="table table-bordered table-striped">
                <tbody>

                    <h4>Assessment Detail :<span>[Shortlist]</span></h4><br>
                    <th>Rating:</th>
                    <th></th>
                    <th>Remarks:</th>
                   
                        <tr>
                            <th> Personality Appearence </th>
                            <td id="pre_personalityappearence">  </td>
                            <td id="pre_personalityremark"> </td>
                        </tr>


                        <tr>
                            <th> Knowledge </th>
                            <td id="pre_knowledge">  </td>
                            <td id="pre_knowledge_remark"> </td>
                        </tr>


                        <tr>
                            <th> Ledership </th>
                            <td id="pre_leadership"> </td>
                            <td id="pre_leadership_remark"> </td>
                        </tr>
                             

                        <tr>
                            <th> Communication </th>
                            <td id="pre_communication">  </td>
                            <td id="pre_communication_remark"> </td>
                        </tr>


                         <tr>
                              <th> Other Assessment </th>
                              <td id="pre_other_assessment"> </td>
                              <td id="pre_other_assessment_remark"> </td>
                         </tr>


                         <th>Education:</th>
                         <th></th>
                         <th></th>
                        <tr>
                            <th> DEGREE OBTAINED </th>
                            <td id="pre_degree_optain">  </td>
                        </tr>
                         <tr>
                            <th> PROFESSTIONAL LICENSE NO.   </th>
                            <td id="pre_professional_licence_no">  </td>
                        </tr>
                         <tr>
                            <th> TECHNICAL QUALIFICATION </th>
                            <td id="pre_technical_qualification"> </td>
                        </tr>
                         <tr>
                            <th>KEY SKILLS   </th>
                            <td id="pre_key_skill">  </td>
                        </tr>
                          <tr>
                            <th> TRADE TEST  </th>
                            <td id="pre_trade_test"> </td>
                        </tr>

                     <tr>
                         <th>Language Used</th>
                         <th>English </th>   
                         <th> English </th>
                         <th> Other</th>
                    </tr>

                      <tr>
                         <th>Rafting</th>
                         <td id="pre_languge_used">   </td>   
                         <td id="pre_languge_used1">  </td>
                         <td id="pre_languge_used2">  </td>
                      </tr>


                      <th>Work Experience</th>
                      <tr>
                          <th></th>
                          <th>POSITION HELD</th>
                          <th>TOTAL YEARS/MONTHS</th>
                      </tr>

                      <tr>
                          <th>LOCAL</th>
                          <td id="pre_local_work_experience"> </td>
                          <td id="pre_local_experience_year"> </td>
                      </tr>

                        <tr>
                          <th>OVERSEAS</th>
                          <td id="pre_overseas_expereicne"></td>
                           <td id="pre_overseaase_year"></td>
                      </tr>


                      <th>Overall Assessment</th>
                      <th>Overall Rating</th>
                      <th>Remark</th>
                      <tr>
                          <td id="pre_overall_assessment"></td>
                          <td id="pre_overall_rating"></td>
                          <td id="pre_remark"></td>
                      </tr>
                 
   
                </tbody>
            </table>



<!-------------------------- //Assessment End ------------------------------------>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>

    </div><!-- dfsg -->
  </div>
</div>

<!--Assessment  Modal Close-->



<!---------------------------------------Enrollment  Modal ----------------------------------->
<div class="modal fade" id="enrollmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-------------------------- // Interview Start ------------------------------------>

@if(isset($candidate_interview))
 <table class="table table-bordered table-striped">
                <tbody>
                    <h4>Send Interview Detail:<span>[Selected]</span></h4><br>
                    <tr>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th> End Time</th>
                        <th> Venue</th>
                     </tr>

                     <tr> 
                        <td id="interview_date"></td>
                        <td id="start_time">  </td>
                        <td id="end_time"></td>
                        <td id="interview_venu"> </td>
                    </tr>

                     <tr>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th> Zipcode </th>
                     </tr>

                     <tr> 
                        <td id="interview_city"> </td>
                        <td id="interview_state"> </td>
                        <td id="interview_country"> </td>
                       <td id="interview_zipcode"></td>
                    </tr>

                     <tr>
                        <th>Interviewer Name</th>
                        <th>Interviewer Mobile No</th>
                        <th>Interviewer Email</th>
                        <th></th>
                     
                     </tr>

                     <tr> 
                        <td id="interviewer_name"> </td>
                        <td id="interviewer_mobileno"> </td>
                        <td id="interviewer_email"> </td>
                        <td></td>
                    </tr>

                  
      </tbody>
            </table>

@else
<tr><th>No Data Found</th></tr>
@endif
<!-------------------------- // Interview Start ------------------------------------>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-----------------------------Enrollment  Modal End -------------------------------------->










<!-----------------------------------Interview Modal ---------------------------------------------->
<div class="modal fade" id="interviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<!-------------------------- // POST Assessment Start ------------------------------------>

@if(isset($post_assessment))
           <table class="table table-bordered table-striped">
                <tbody>

                    <h4>Interview Assessment Detail :<span>[Confirm]</span></h4><br>
                    <th>Rating:</th>
                    <th></th>
                    <th>Remarks:</th>
                        <tr>
                            <th> Personality Appearence </th>
                            <td id="post_personality_appearence">  </td>
                            <td id="post_personality_remark">  </td>
                        </tr>


                        <tr>
                            <th> Knowledge </th>
                            <td id="post_knowledge"> </td>
                            <td id="post_knowledge_remark"> </td>
                        </tr>


                        <tr>
                            <th> Ledership </th>
                            <td id="post_ledership"></td>
                            <td id="post_leadership_remark"> </td>
                        </tr>
                             

                        <tr>
                            <th> Communication </th>
                            <td id="post_communication">  </td>
                            <td id="post_communication_remark"> </td>
                        </tr>


                         <tr>
                              <th> Other Assessment </th>
                              <td id="post_other_assessment"> </td>
                              <td id="post_other_assessment_remark"> </td>
                         </tr>


                         <th>Education:</th>
                         <th></th>
                         <th></th>
                        <tr>
                            <th> DEGREE OBTAINED </th>
                            <td id="post_degree_optain">  </td>
                        </tr>
                         <tr>
                            <th> PROFESSTIONAL LICENSE NO.   </th>
                            <td id="post_professional_licence_no">   </td>
                        </tr>
                         <tr>
                            <th> TECHNICAL QUALIFICATION </th>
                            <td id="post_technical_qualification">  </td>
                        </tr>
                         <tr>
                            <th>KEY SKILLS   </th>
                            <td id="post_key_skill">  </td>
                        </tr>
                          <tr>
                            <th> TRADE TEST  </th>
                            <td id="post_trade_test">  </td>
                        </tr>


                     <tr>
                         <th>Language Used</th>
                         <th>English </th>   
                         <th> English </th>
                         <th> Other</th>
                    </tr>


                      <tr>
                         <th>Rafting</th>
                         <td id="post_languge_used">   </td>   
                         <td id="post_languge_used1">   </td>
                         <td id="post_languge_used2">   </td>
                      </tr>


                      <th>Work Experience</th>
                      <tr>
                          <th></th>
                          <th>POSITION HELD</th>
                          <th>TOTAL YEARS/MONTHS</th>
                      </tr>

                      <tr>
                          <th>LOCAL</th>
                          <td id="post_local_work_experience"></td>
                          <td id="post_local_experience_year"></td>
                      </tr>

                        <tr>
                          <th>OVERSEAS</th>
                          <td id="post_overseas_expereicne"></td>
                           <td id="post_overseaase_year"></td>
                      </tr>


                      <th>Overall Post Assessment</th>
                      <th>Overall Rating</th>
                      <th>Remark</th>
                      <tr>
                          <td id="post_overall_assessment"> </td>
                          <td id="post_overall_rating"> </td>
                          <td id="post_remark"></td>
                      </tr>

   
                </tbody>
            </table>

@else
<tr><th>No Data Found</th></tr>
@endif

<!-------------------------- // POST Assessment End ------------------------------------>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!--Interview Modal end -->






<!-------------------------------------------------Selection Modal ----------------------------------------->
<div class="modal fade" id="selectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<!-------------------------- // Offer Start ------------------------------------>

 <table class="table table-bordered table-striped">
                <tbody>
                    <h4>Offer Letter Detail: <span>[Selection]</span></h4><br>
                    <tr>
                        <th>Issue Date</th>
                        <th>Signed Date</th>
                        <th>Refuse Date</th>
                        <th>Remark</th>
                      
                     </tr>

                     <tr> 
                       
                        <td id="offer_issue_date"> </td>
                        <td id="offer_signed_date"> </td>
                        <td id="offer_refuse_date"></td>
                        <td id="offer_remark"></td>
                    </tr>


                    <tr>
                        <th>Confirm Date</th>
                        <th>Confirmation Remark</th>
                        <th>Rejection Date</th>
                        <th>Rejection Remark</th>
                      
                     </tr>

                     <tr> 
                       
                        <td id="confirmation_date"> </td>
                        <td id="confirmation_remark"> </td>
                        <td id="rejection_date"></td>
                        <td id="rejection_remark"></td>
                    </tr>


                     <tr>
                        <th>Attached Document 1</th>
                        <th>Attached Document 2</th>
                        <th>Attached Document 3</th>
                        <th></th>
                     </tr>

                     <tr> 
                          <td> </td>
                          <td> </td>
                          <td></td>
                          <td></td>
                    </tr>

                  
      </tbody>
            </table>





<!-------------------------- // Offer End ------------------------------------>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     <!--    <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<!---------------------- Modal end -------------------------------------->



<!-------------------------------------------------Offers Modal ----------------------------------------->
<div class="modal fade" id="offersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<!-------------------------- // Pre Medical Start ------------------------------------>

@if(isset($pre_medical))
 <table class="table table-bordered table-striped">
                <tbody>
                    <h4>Pre Medical Detail: <span>[Offers]</span></h4><br>
                    <tr>
                        <th>Medical Examination Center</th>
                        <th>Fit Date</th>
                        <th>Unfit Date</th>
                        <th>Remark</th>
                      
                     </tr>

                     <tr> 
                       
                        <td id="medical_examination_center_id">
                             {{--<?php $medical_examination=DB::table('medical_examination_center')->where('medical_examination_center_id',$pre_medical->medical_examination_center_id)->first();?>
                              {{ $medical_examination->medical_examination_center_name }}--}}
                        </td>
                        <td id="fit_date"> </td>
                        <td id="unfit_date"> </td>
                        <td id="premedical_remark"></td>
                    </tr>


                     <tr>
                        <th>Attached Document 1</th>
                        <th>Attached Document 2</th>
                        <th>Attached Document 3</th>
                        <th></th>
                     </tr>

                     <tr> 


        <?php $candidatePath=DB::table('personal')->where('candidate_id',$pre_medical->candidate_id)->select('directory_path')->first(); ?>
              <td> 
                    @if(!empty($pre_medical->attached_document1))
                    <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$pre_medical->attached_document1)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                    @endif
              </td>
                <td> 
                    @if(!empty($pre_medical->attached_document2))
                    <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$pre_medical->attached_document2)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                    @endif
              </td>

               <td> 
                    @if(!empty($pre_medical->attached_document3))
                    <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$pre_medical->attached_document3)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                    @endif
              </td>


                        <td></td>
                    </tr>

                  
      </tbody>
            </table>


@else
<tr><th>No Data Found</th></tr>
@endif


<!-------------------------- // Pre Medical End ------------------------------------>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     <!--    <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<!-- Modal end -->





<!------------------------------ Pre Medical Modal  Start --------------------------------->
<div class="modal fade" id="medicalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <!-------------------------- // Qvc Process Start ------------------------------------>

@if(isset($qvc_process))
 <table class="table table-bordered table-striped">
                <tbody>
                    <h4>Qvc Process Detail: <span>[Medical Fit]</span></h4><br>
                    <tr>
                        <th>Applied Date</th>
                        <th>Appointment Date</th>
                        <th>Fit Date</th>
                        <th>Fit Remark</th>
                     </tr>

                     <tr> 
                        <td id="client_applied_date"></td>
                        <td id="appointment_date">  </td>
                        <td id="medical_fit_date"> </td>
                        <td id="medical_fit_remark"> <td>      
                    </tr>

                    <tr>
                          <th>Unfit Date</th>
                          <th>Unfit Remark</th>
                          <th>Report Pending</th>
                          <th>ReportPending Remark</th>
                    </tr>

                    <tr>
                         <td id="medical_unfit_date"> </td>
                         <td id="medical_unfit_remark"></td>
                         <td id="report_pending"> </td>
                         <td id="report_pending_remark"> </td>
                         
                    </tr>

                    <tr>
                          <th>Reschedule</th>
                          <th>Reschedule Remark</th>
                          <th></th><th></th>
                    </tr>
                    <tr>
                          <td id="reschedule">  </td>
                          <td id="reschedule_remark"> </td>
                          <td></td><td></td>
                    </tr>





                     <tr>
                        
                        <th>Attached Document 1</th>
                        <th>Attached Document 2</th>
                        <th>Attached Document 3</th>
                        <th></th>
                       
                     </tr>
<?php $candidatePath=DB::table('personal')->where('candidate_id',$qvc_process->candidate_id)->select('directory_path')->first();
?>
                     <tr> 
                       
                        <td> 
                            @if(!empty($qvc_process->attached_document1))
                                 <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$qvc_process->attached_document1)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif

                        </td>

                        <td> 
                            @if(!empty($qvc_process->attached_document2))
                                 <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$qvc_process->attached_document2)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif
                        </td>

                        <td> 
                            @if(!empty($qvc_process->attached_document3))
                                 <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$qvc_process->attached_document3)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif

                        </td>
                        <td></td>

                      
                    </tr>

                  
      </tbody>
            </table>

@else
<tr><th>No Data Found</th></tr>
@endif

<!-------------------------- // Qvc Process End ------------------------------------>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <!--   <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- Modal End-->










<!-------------------------------------QVC  Modal ------------------------------------------->
<div class="modal fade" id="qvcModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <!-------------------------- //Visa Process Start ------------------------------------>

@if(isset($visa_process))
 <table class="table table-bordered table-striped">
                <tbody>
                    <h4>Visa Process Detail: <span>[QVC]</span></h4><br>
                    <tr>
                        <th>Issue Date</th>
                        <th>Expiry Date</th>
                        <th>Remark</th>
                      
                     </tr>

                     <tr> 
                        <td id="visa_issue_date"></td>
                        <td id="visa_expiry_date"> </td>
                        <td id="visa_remark"></td>
                    </tr>


                     <tr>
                        <th>Ev No</th>
                        <th>Ev No</th>
                        <th>Visa Profession</th>
                      
                     </tr>

                     <tr> 
                        <td id="ev_no"> </td>
                        <td id="sim_no">  </td>
                        <td id="vissa_profession"> </td>
                       
                    </tr>

                     <tr>
                        <th>Attached Document 1</th>
                        <th>Attached Document 2</th>
                        <th>Attached Document 3</th>
                     </tr>
<?php $candidatePath=DB::table('personal')->where('candidate_id',$visa_process->candidate_id)->select('directory_path')->first();
?> 
                     <tr> 
                        <td> 
                            @if(!empty($visa_process->attached_document1))
                             <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$visa_process->attached_document1)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif
                        </td>
                        <td> 
                            @if(!empty($visa_process->attached_document2))
                             <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$visa_process->attached_document2)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif

                         </td>
                        <td> 

                            @if(!empty($visa_process->attached_document3))
                             <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$visa_process->attached_document3)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif

                        </td>
                    </tr>

                  
      </tbody>
            </table>

@else
<tr><th>No Data Found</th></tr>
@endif

<!-------------------------- // Visa Process End ------------------------------------>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <!--       <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- Modal -->









<!---------------------------------- Visa Modal ------------------------------------>
<div class="modal fade" id="visaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <!-------------------------- //Deployment Process Start ------------------------------------>

@if(isset($deployment_process))
 <table class="table table-bordered table-striped">
                <tbody>
                    <h4>Deployment Process Detail: <span>[Visa]</span></h4><br>
                     <tr>
                        <th>Ticket No</th>
                        <th>PNR No</th>
                        <th>Flight No</th>
                     </tr>

                     <tr> 
                          <td id="ticket_no"></td>
                          <td id="pnr_no"></td>
                          <td id="flight_no"></td>
                    </tr>


                     <tr>
                        <th>Flight Date</th>
                        <th>Duration</th>
                        <th>Destination / Sector</th>
                     </tr>

                     <tr> 
                        <td id="flight_date"> </td>
                        <td id="duration"></td>
                        <td id="destination"> </td>
                    </tr>



                     <tr>
                        <th>Departure Date</th>
                        <th>Departure Time</th>
                        <th>Arrival Date</th>
                     </tr>

                     <tr> 
                        <td id="departure_date"></td>
                        <td id="departure_time"></td>
                        <td id="arrival_date"></td>
                        
                    </tr>

                    <tr>
                        <th>Arrival Time</th>
                        <th>PCR Test</th>
                        <th> Postive Date</th>
                    </tr>

                    <tr>
                        <td id="arrival_time"></td>
                        <td id="pcr_test"></td>
                        <td id="positive_date"> </td>
                    </tr>



                     <tr>
                        <th> Postive Time</th>
                        <th> Negative Date</th>
                        <th> Negative Time</th>
                     </tr>

                     <tr>
                           <td id="positive_time"> </td>
                           <td id="negative_date"> </td>
                           <td id="negative_time"> </td>   
                    </tr>





                     <tr>
                        <th>(PCR Test)</th>
                        <th>(Flight Ticket)</th>
                        <th>(QR Code)</th>
                       
                     </tr>
<?php $candidatePath=DB::table('personal')->where('candidate_id',$deployment_process->candidate_id)->select('directory_path')->first();
?>
                     <tr> 
                        <td> 
                            @if(!empty($deployment_process->attached_document1))
                             <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$deployment_process->attached_document1)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif

                        </td>
                        <td> 
                            @if(!empty($deployment_process->attached_document2))
                             <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$deployment_process->attached_document2)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif
                        </td>

                        <td> 
                            @if(!empty($deployment_process->attached_document3))
                             <a href="{{asset('documents/Candidate/' .$candidatePath->directory_path.'/'.$deployment_process->attached_document3)}}"  target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>
                            @endif

                        </td>

                        
                    </tr>

                  
      </tbody>
            </table>

@else
<tr><th>No Data Found</th></tr>
@endif

<!-------------------------- // Deployment Process End ------------------------------------>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!---------------------------------------- Visa Modal ----------------------------------------------------->


@endif






              
            <!-- <div class="form-group">
                <a class="btn btn-default" href="{{ route('personal.index') }}">
                   Back to List
                </a>
            </div> -->
        </div>
    </div>
</div>



@endsection

@section('js')

<script>

     $(document).ready(function () {
//----------------------------------------- Pre Assessment----------------------------
            $('.assessmentview_btn').click(function (e) { 
                e.preventDefault();
                
                var assessment_id = $(this).closest('tr').find('.assessment_id').text();
                 // console.log(assessment_id);

                 $.ajax({
                    type: "GET",
                    url:"{{url('getAssessment')}}?assessment_id="+assessment_id,
                    success: function (response) {
                   
                   $('#pre_personalityappearence').html(response[0].personality_appearence);
                   $('#pre_personalityremark').html(response[0].personality_remark);

                   $('#pre_knowledge').html(response[0].knowledge);
                   $('#pre_knowledge_remark').html(response[0].knowledge_remark);

                   $('#pre_leadership').html(response[0].ledership);
                   $('#pre_leadership_remark').html(response[0].leadership_remark);

                   $('#pre_communication').html(response[0].communication);
                   $('#communication_remark').html(response[0].communication_remark);

                   $('#pre_other_assessment').html(response[0].other_assessment);
                   $('#pre_other_assessment_remark').html(response[0].other_assessment_remark);

                   $('#pre_degree_optain').html(response[0].degree_optain);
                   $('#pre_professional_licence_no').html(response[0].professional_licence_no);
                   $('#pre_technical_qualification').html(response[0].technical_qualification);
                   $('#pre_key_skill').html(response[0].key_skill);
                   $('#pre_trade_test').html(response[0].trade_test);
                   $('#pre_languge_used').html(response[0].languge_used);
                   $('#pre_languge_used1').html(response[0].languge_used1);
                   $('#pre_languge_used2').html(response[0].languge_used2);
                   $('#pre_local_work_experience').html(response[0].local_work_experience);
                   $('#pre_local_experience_year').html(response[0].local_experience_year);
                   $('#pre_overseas_expereicne').html(response[0].overseas_expereicne);
                   $('#pre_overseaase_year').html(response[0].overseaase_year);
                   $('#pre_overall_assessment').html(response[0].overall_assessment);
                   $('#pre_overall_rating').html(response[0].overall_rating);
                   $('#pre_remark').html(response[0].remark);

                    }
                });

            });

//---------------------------------------------------- Pre Assessment--------------------------------------------------



//-----------------------------------------Enrollment(Send Interview Detail)----------------------------
            $('.sendinterview_btn').click(function (e) { 
                e.preventDefault();
                
                var candidate_interview_id = $(this).closest('tr').find('.candidate_interview_id').text();
                 // alert(candidate_interview_id);

                 $.ajax({
                    type: "GET",
                   // url: "code.php",
                    url:"{{url('getCandidateInterview')}}?candidate_interview_id="+candidate_interview_id,
                    success: function (response) {
                   
                        var interviewdate = response[0].interview_date;
                        var dateinterview = new Date(interviewdate * 1000).toJSON().slice(0, 10);
                        $('#interview_date').html(dateinterview);



                     var strttime = response[0].start_time;
                     var newtime = new Date(strttime * 1000).toISOString().substr(11, 8);
                     $('#start_time').html(newtime);

                     var endtime = response[0].end_time;
                     var endtimes = new Date(endtime * 1000).toISOString().substr(11, 8);
                     $('#end_time').html(endtimes);


                   $('#interview_venu').html(response[0].interview_venu);
                   $('#interview_city').html(response[0].interview_city);
                   $('#interview_state').html(response[0].interview_state);
                   $('#interview_country').html(response[0].interview_country);
                   $('#interview_zipcode').html(response[0].interview_zipcode);
                   $('#interviewer_name').html(response[0].interviewer_name);
                   $('#interviewer_mobileno').html(response[0].interviewer_mobileno);
                   $('#interviewer_email').html(response[0].interviewer_email);
                 

                    }
                });

            });

//---------------------------------------------------- Enrollment--------------------------------------------------


//----------------------------------------- POST Assessment----------------------------
            $('.postassessview_btn').click(function (e) { 
                e.preventDefault();
                
                var post_assessment_id = $(this).closest('tr').find('.post_assessment_id').text();
                 // alert(post_assessment_id);

                 $.ajax({
                    type: "GET",

                    url:"{{url('getPostAssessment')}}?post_assessment_id="+post_assessment_id,
                    success: function (response) {
                   

                   $('#post_personality_appearence').html(response[0].personality_appearence);
                   $('#post_personality_remark').html(response[0].personality_remark);

                   $('#post_knowledge').html(response[0].knowledge);
                   $('#post_knowledge_remark').html(response[0].knowledge_remark);

                   $('#post_ledership').html(response[0].ledership);
                   $('#post_leadership_remark').html(response[0].leadership_remark);

                   $('#post_communication').html(response[0].communication);
                   $('#post_communication_remark').html(response[0].communication_remark);

                   $('#post_other_assessment').html(response[0].other_assessment);
                   $('#post_other_assessment_remark').html(response[0].other_assessment_remark);

                   $('#post_degree_optain').html(response[0].degree_optain);
                   $('#post_professional_licence_no').html(response[0].professional_licence_no);
                   $('#post_technical_qualification').html(response[0].technical_qualification);
                   $('#post_key_skill').html(response[0].key_skill);
                   $('#post_trade_test').html(response[0].trade_test);
                   $('#post_languge_used').html(response[0].languge_used);
                   $('#post_languge_used1').html(response[0].languge_used1);
                   $('#post_languge_used2').html(response[0].languge_used2);
                   $('#post_local_work_experience').html(response[0].local_work_experience);
                   $('#post_local_experience_year').html(response[0].local_experience_year);
                   $('#post_overseas_expereicne').html(response[0].overseas_expereicne);
                   $('#post_overseaase_year').html(response[0].overseaase_year);
                   $('#post_overall_assessment').html(response[0].overall_assessment);
                   $('#post_overall_rating').html(response[0].overall_rating);
                   $('#post_remark').html(response[0].remark);

                    }
                });

            });

//---------------------------------------------------- POST Assessment--------------------------------------------------



//-----------------------------------------Offers view----------------------------------------
            $('.offer_viewbtn').click(function (e) { 
                e.preventDefault();
                
                var offer_letter_id = $(this).closest('tr').find('.offer_letter_id').text();
                  //alert(offer_letter_id);

                 $.ajax({
                    type: "GET",
                    url:"{{url('getOfferLetter')}}?offer_letter_id="+offer_letter_id,
                    success: function (response) {
                        //console.log(response);
                           
                            var issue = response[0].issue_date;
                            var dateissue = new Date(issue * 1000).toJSON().slice(0, 10);
                            $('#offer_issue_date').html(dateissue);

                            var numb = response[0].signed_date;
                            var ymdate = new Date(numb * 1000).toJSON().slice(0, 10);
                            $('#offer_signed_date').html(ymdate);

                            var numm = response[0].refuse_date;
                            var ymmd = new Date(numm * 1000).toJSON().slice(0, 10);
                            $('#offer_refuse_date').html(ymmd);

                            $("#offer_remark").html(response[0].remark);

                               
                            var confirmation = response[0].confirmation_date;
                            var cmdate = new Date(confirmation * 1000).toJSON().slice(0, 10);
                            $('#confirmation_date').html(cmdate);

                            $("#confirmation_remark").html(response[0].confirmation_remark);

                             var rejection = response[0].rejection_date;
                            var rjdate = new Date(rejection * 1000).toJSON().slice(0, 10);
                            $('#rejection_date').html(rjdate);

                            $("#rejection_remark").html(response[0].rejection_remark);

    

                    }
                });

            });

//-----------------------------------------Offers view-----------------------------------




//-----------------------------------------PreMedical view----------------------------
            $('.premedical_viewbtn').click(function (e) { 
                e.preventDefault();
                
                var premedical_id = $(this).closest('tr').find('.pre_medical_id').text();
                 // alert(premedical_id);

                 $.ajax({
                    type: "GET",
                    url:"{{url('getPreMedical')}}?premedical_id="+premedical_id,
                    success: function (response) {
                        //console.log(response);
                   

      
                    $("#medical_examination_center_id").html(response[0].medical_examination_center_id);

                    // $("#dateFit option[value='unfit_date']")[0].selected = true;

                        var fitt = response[0].fit_date;
                        var ymde = new Date(fitt * 1000).toJSON().slice(0, 10);
                        $('#fit_date').html(ymde);

                        var unfitt = response[0].unfit_date;
                        var ymdpre = new Date(unfitt * 1000).toJSON().slice(0, 10);
                        $('#unfit_date').html(ymdpre);


                     // var SITEURL = '{{URL::to('')}}';
                     // $('#imges').attr('src',SITEURL+'/documents/Candidate/Navya_1639983873/'+response[0].attached_document1);
                     // $('#attached_document2_premedical').attr('src',SITEURL+'/documents/Candidate/Navya_1639983873/'+response[0].attached_document2);
                     // $('#attached_document3_premedical').attr('src',SITEURL+'/documents/Candidate/Navya_1639983873/'+response[0].attached_document3);

                    $("#premedical_remark").html(response[0].remark);
                 

                    }
                });

            });

//-----------------------------------------PreMedical view----------------------------



//-----------------------------------------QVC Process---------------------------------
            $('.qvc_viewbtn').click(function (e) { 
                e.preventDefault();
                
                var qvc_id = $(this).closest('tr').find('.qvc_id').text();
                  // alert(qvc_id);

                 $.ajax({
                    type: "GET",
                    url:"{{url('getQvc')}}?qvc_id="+qvc_id,
                    success: function (response) {


                            var client_applieddate = response[0].client_applied_date;
                            var dates = new Date(client_applieddate* 1000).toJSON().slice(0, 10);
                            $('#client_applied_date').html(dates);

                            var appointmentdate = response[0].appointment_date;
                            var appdate = new Date(appointmentdate* 1000).toJSON().slice(0, 10);
                            $('#appointment_date').html(appdate);

                   
                          
                            $("#medical_fit_remark").html(response[0].medical_fit_remark);
                            $("#medical_unfit_remark").html(response[0].medical_unfit_remark);
                            $("#report_pending_remark").html(response[0].report_pending_remark);
                            $("#reschedule_remark").html(response[0].reschedule_remark);


                            var medical_fit = response[0].medical_fit_date;
                            var lst = new Date(medical_fit* 1000).toJSON().slice(0, 10);
                            $('#medical_fit_date').html(lst);

                            var medical_unfit = response[0].medical_unfit_date;
                            var lsts = new Date(medical_unfit* 1000).toJSON().slice(0, 10);
                            $('#medical_unfit_date').html(lsts);

                            var reschedules = response[0].reschedule;
                            var sch = new Date(reschedules* 1000).toJSON().slice(0, 10);
                            $('#reschedule').html(sch);


                            var report_pending = response[0].report_pending;
                            var pending = new Date(report_pending * 1000).toJSON().slice(0, 10);
                            $('#report_pending').html(pending);

                          



                    }
                });

            });

//-----------------------------------------QVC Process---------------------------------




//-----------------------------------------Visa Process---------------------------------
            $('.visa_viewbtn').click(function (e) { 
                e.preventDefault();
                
                var visa_id = $(this).closest('tr').find('.visa_id').text();
                  //alert(visa_id);

                 $.ajax({
                    type: "GET",
                    url:"{{url('getVisa')}}?visa_id="+visa_id,
                    success: function (response) {
                   
                          
                            $("#visa_remark").html(response[0].remark);
                            $("#vissa_profession").html(response[0].vissa_profession);
                            $("#ev_no").html(response[0].ev_no);
                            $("#sim_no").html(response[0].sim_no);

                            var number = response[0].issue_date;
                            var ymds = new Date(number * 1000).toJSON().slice(0, 10);
                            $('#visa_issue_date').html(ymds);

                            var num = response[0].expiry_date;
                            var ymd = new Date(num * 1000).toJSON().slice(0, 10);
                            $('#visa_expiry_date').html(ymd);



                    }
                });

            });

//-----------------------------------------Visa Process---------------------------------




//-----------------------------------------Deployment Process---------------------------------
            $('.deployment_viewbtn').click(function (e) { 
                e.preventDefault();
                
                var deployment_id = $(this).closest('tr').find('.deployment_id').text();
                  //alert(deployment_id);

                 $.ajax({
                    type: "GET",
                    url:"{{url('getDeployment')}}?deployment_id="+deployment_id,
                    success: function (response) {
                   
                
                                        $("#ticket_no").html(response[0].ticket_no);
                                        $("#pnr_no").html(response[0].pnr_no);
                                        $("#flight_no").html(response[0].flight_no);


                                         var flightDate = response[0].flight_date;
                                        var fDate = new Date(flightDate * 1000).toJSON().slice(0, 10);
                                        $('#flight_date').html(fDate);


                                        var dep_date = response[0].departure;
                                        var conv = new Date(dep_date * 1000).toJSON().slice(0, 10);
                                        $('#departure_date').html(conv);

                                         var arri_date = response[0].arrival;
                                        var change = new Date(arri_date * 1000).toJSON().slice(0, 10);
                                        $('#arrival_date').html(change);

                                         // $("#departure_time").html(response[0]. departure_time);
                                         // $("#arrival_time").html(response[0].arrival_time);

                                          var departuretime = response[0].departure_time;
                                         var deptime = new Date(departuretime * 1000).toISOString().substr(11, 8);
                                         $('#departure_time').html(deptime);

                                         var atime = response[0].arrival_time;
                                         var arrtime = new Date(atime * 1000).toISOString().substr(11, 8);
                                         $('#arrival_time').html(arrtime);






                                        $("#duration").html(response[0].duration);
                                        $("#destination").html(response[0].destination);
                                    

                                        $("#pcr_test").html(response[0].pcr_test);

                                        if(response[0].pcr_test=="positive"){
                                                  var postive = response[0].positive_date;
                                                var datechange = new Date(postive * 1000).toJSON().slice(0, 10);
                                                $('#positive_date').html(datechange);   
                                        }
                                        else if(response[0].pcr_test=="negative"){
                                                  var negative = response[0].negative_date;
                                                var dateformat = new Date(negative * 1000).toJSON().slice(0, 10);
                                                $('#negative_date').html(dateformat);
                                               
                                        }


                    }
                });

            });

//-----------------------------------------Deployment Process---------------------------------







        });

</script>


  























@endsection