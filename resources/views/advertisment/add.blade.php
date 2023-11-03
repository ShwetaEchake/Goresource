<?php

use App\Models\Enquiry;
use App\Models\Client;
use App\Models\Job;
use App\Models\Category;

?>
@extends('layouts.admin')

@section('title')
Addvertismnt
@endsection

@section('css')

<style type="text/css">  


@media print {
  #hide-print{
    display: none;
  }

   Header {
      display: none !important;
    }
    Footer {
      display: none !important;
    }

}

   table td, table th{  
        border: 0.5px solid #c6c6c6;  
        padding: 10px;
        font-family: poppins;
        font-size: 14px;
       }  

</style>  

@endsection




@section('content')
<div class="container">  
    <div class="card ">
        <div class="card-body">
  <?php 
  $enquiry=Enquiry::where('enquiry_id',$_GET['id'])->first(); 
  $jobs=Job::where('enquiry_id',$enquiry->enquiry_id)->get();
  ?>



 {{-- <h3> Enquiry:</h3>
    <table>

        <tr>  
           <th>Company Name</th>
           <th>Enquiry Title</th>
           <th>Contact Period</th>
           <th>Place of Work</th>
           <th>Trial Period</th>
           <th>Air Fare</th>
           <th>Employment Visa</th>
           <th>Food</th>
           <th>Transportation</th>
           <th>Accomodation Status</th>
           <th> Medical Status</th>
          <!--  <th> Duty Hours</th>
           <th>Overtime Hours</th>
           <th>Uniform Status</th>
           <th>Other Benefits</th>
           <th>Other condition</th>    -->      
        </tr>  

                @foreach($jobs as $job)
           <tr>
                        <td>
                         <?php $name = Client::where(['client_id'=>$enquiry->client_id])->first()?>
                                {{$name->company_name}}
                        </td>
                        <td>{{ $enquiry->enquiry_title }}</td>
                        <td>{{ $enquiry->contract_period }}</td>
                        <td>{{ $enquiry->place_of_work }}</td>
                        <td>{{ $enquiry->trial_period }}</td>
                        <td>{{ $enquiry->air_fare }}</td>
                        <td>{{ $enquiry->employment_visa }}</td>
                        <td>{{ $enquiry->employment_visa }}</td>
                        <td>{{ $enquiry->transportation_status }}</td>
                        <td>{{ $enquiry->accomodation_status }}</td>
                        <td>{{ $enquiry-> medical_status }}</td>
                       <!--  <td>{{ $enquiry->duty_hours }}</td>
                        <td>{{ $enquiry->overtime_hours }}</td>
                         <td>{{ $enquiry->uniform_status }}</td>
                        <td>{{ $enquiry->other_benefits }}</td>
                        <td>{{ $enquiry->other_condition }}</td>
                        -->
          </tr>
           @endforeach
    </table>  
    --}}










    <h4> Job Categories :</h4><br>

     <!-- <a style="position: absolute;top: 10px;margin-left: 830px;" href="{{ route('advertisment.index') }}" class="btn btn-flat btn-danger"><i class="fa fa-shield-alt"></i> Back</a> -->


      <button class="btn btn-flat btn-primary" id="hide-print" style="position: absolute;top: 10px;right: 10px;"  onclick="window.print()">
                  <i class="fa fa-print" aria-hidden="true"></i> Print</button>

    <table width="100%" border="1px;">

        <tr>  
                    <th> Category</th>
                 {{--<th> Trade</th>--}}
                 <!--    <th>Project Location</th> -->
                    <th>Basic Salary</th>
                    <th>Cola</th>
                    <th>Food </th>
                    <th>Transportation </th> 
                    <th>Accomodation </th>
                    <th>Medical </th>
                    <th>Overtime </th>     
       
        </tr>  
             @foreach($jobs as $job)
           <tr>

                         <td>
                          <?php $maincategory = Category::where(['category_id'=>$job->job_main_category_id])->first()?>
                                {{$maincategory->category_name}}
                         </td>
                       {{-- <td><?php $subcategory = Category::where(['category_id'=>$job->job_sub_category_id])->first()?>
                                     {{$subcategory->category_name}}
                            </td>--}}

                        <!--  <td>{{$job->enquiy_project_location_id}}</td> -->
                        <td>{{$job->basic_salary}}</td>
                        <td>{{$job->cola_allownces}}</td>
                        <td>{{$job->food_allownce}}</td>
                        <td>{{$job->transportation_allownce}}</td>
                        <td>{{$job->accomodation_allownce}}</td>
                        <td>{{$job->medical_allownce}}</td>
                        <td>{{$job->overtime_allownce}}</td>
                       
          </tr>
            @endforeach
    </table> 

    </div>
    </div> 
</div>
@endsection




 
sdsadsadsd



   



            
     