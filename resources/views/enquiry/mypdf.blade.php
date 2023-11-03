<?php
use App\Models\Enquiry;
use App\Models\Client;
use App\Models\Job;
use App\Models\Category;
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
  $enquiry=Enquiry::where('enquiry_id',$enquiryDatas->enquiry_id)
  ->leftjoin('client','client.client_id','=','enquiry.client_id')
  ->leftjoin('country','country.country_id','=','client.client_country')

  ->first(); 

  $jobs=DB::table('jobs')
  ->leftjoin('categories','categories.category_id','=','jobs.job_main_category_id')
  ->where('enquiry_id',$enquiry->enquiry_id)
  ->get();
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
            font-family: Poppins, Sans-Serif;
            text-transform: uppercase;
            font-size: 10px;
         }
  
    </style>
</head>
  

<body>
     <center><img src="{{public_path()}}/img/GOLOGOtm-2020.png" width="200px"></center>
<br>

<span style="position: absolute;left: 10px;">CLIENT REF:<u>{{$enquiry->company_name}}<u></span>
<span style="margin-left: 260px;"> PROJ. REF: <u>{{$enquiry->company_name}}</u></span>
<span style="position: absolute;right: 10px;margin-bottom: 10px;"> DATE: <u> {{$enquiry->created_at}}</u></span>

<br><br>
     <table class="c82" width="100%">
    <tbody>
        <tr class="c45">
            <td class="c65" colspan="17" rowspan="1">
                <p class="c21"><span class="c33"><center>{{$enquiry->enquiry_title}}</center></span></p></td>
        </tr>
        <tr class="c45"><td class="c65" colspan="17" rowspan="1">
            <p class="c21"><span class="c33"><center>{{$enquiry->company_name}}</center></span></p></td>
        </tr>
        <tr class="c45">
            <td class="c51" colspan="1" rowspan="1"><p class="c9"><span class="c33">SN</span></p></td>
            <td class="c80" colspan="1" rowspan="1"><p class="c21 c93"><span class="c33">trade</span></p></td>
            <td class="c40" colspan="1" rowspan="1"><p class="c21"><span class="c33">S</span></p></td>
            <td class="c70" colspan="4" rowspan="1"><p class="c21"><span class="c33">NOS</span></p></td>
            <td class="c44" colspan="4" rowspan="1"><p class="c21"><span class="c33">SALARY</span></p></td>
            <td class="c89" colspan="6" rowspan="1"><p class="c21"><span class="c33">NATIONALITY</span></p></td>
        </tr>
        <tr class="c45">
            <td class="c50" colspan="7" rowspan="1"><p class="c21 c29"><span class="c13"></span></p></td>
            <td class="c34" colspan="1" rowspan="1"><p class="c21"><span class="c10">BASIC</span></p></td>
            <td class="c15" colspan="1" rowspan="1"><p class="c21"><span class="c10">COLA</span></p></td>
            <td class="c71" colspan="1" rowspan="1"><p class="c21"><span class="c10">OT</span></p></td>
            <td class="c17" colspan="1" rowspan="1"><p class="c21"><span class="c10">Food</span></p></td>
            <td class="c66" colspan="6" rowspan="1"><p class="c21"><span class="c10">{{$enquiry->country_name}}</span></p></td>
           
        </tr>  
         <?php $total = 0; ?>
        @foreach($jobs as $index => $job)
        <tr class="c6">
            <td class="c55" colspan="1" rowspan="1"><p class="c9"><span class="c30">{{++$index }}</span></p></td>
            <td class="c88" colspan="1" rowspan="1"><p class="c9"><span class="c67" nowrap>{{$job->category_name}}</span></p></td>
            <td class="c94" colspan="2" rowspan="1"><p class="c21"><span class="c30">M</span></p></td>
            <?php 
          $projectlocation=DB::select(DB::raw("select sum(required_position) as Total from `project_location` where `job_id` = '".$job->job_id."'  "));
            ?> 

            
               @foreach ($projectlocation as $values) 
               <?php  $total += $values->Total; ?>
            <td class="c98" colspan="3" rowspan="1"><p class="c21"><span class="c30"><?php echo ($values->Total); ?></span></p></td>
               @endforeach
            <td class="c76" colspan="1" rowspan="1"><p class="c21"><span class="c39">{{$job->basic_salary}}</span></p></td>
            <td class="c72" colspan="1" rowspan="1"><p class="c21 c29"><span class="c13">{{$job->cola_allownces}}</span></p></td>
            <td class="c97" colspan="1" rowspan="1"><p class="c21 c29"><span class="c13">{{$job->overtime_allownce}}</span></p></td>
            <td class="c92" colspan="1" rowspan="1"><p class="c21"><span class="c39">{{$enquiry->food_status}}</span></p></td>
            <td class="c69" colspan="6" rowspan="1"><p class="c21 c29"><span class="c13"></span></p></td>
          
        </tr> 
        @endforeach
        <tr class="c28"><td class="c91" colspan="4" rowspan="1"><p class="c21"><span class="c60">TOTAL</span></p></td>
            <td class="c99" colspan="13" rowspan="1"><p class="c9 c90"><span class="c60 c74">{{ $total }} &nbsp;(Only)</span></p></td>
        </tr>
    </tbody>
</table>

<br><br>



<!DOCTYPE html>
<html>
<head>
<!-- <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style> -->
</head>
<body>

<h5>TERMS AND CONDITIONS:</h5>

<table width="100%">
  <tr>
    <th>1</th>
    <th>Period of Contract :</th>
    <td>{{ $enquiry->contract_period }}</td>
  </tr>
  <tr>
    <th>2</th>
    <th>Place of Work :</th>
    <td>{{ $enquiry->place_of_work }}</td>
  </tr>
  <tr>
    <th>3</th>
    <th>Trial Period :</th>
    <td>{{ $enquiry->trial_period }}</td>
  </tr>
  <tr>
    <th>4</th>
    <th>Air Fare :</th>
    <td>{{ $enquiry->air_fare }}</td>
  </tr>
  <tr>
    <th>5</th>
    <th>Employment Visa :</th>
    <td>{{ $enquiry->employment_visa }}</td>
  </tr>
  <tr>
    <th>6</th>
    <th>Food :</th>
    <td>{{ $enquiry->food_status }}</td>
  </tr>
  <tr>
    <th>7</th>
    <th>Transportation :</th>
    <td>{{ $enquiry->transportation_status }}</td>
  </tr>
  <tr>
   <th>8</th>
   <th>Accommodation :</th>
   <td>{{ $enquiry->accomodation_status }}</td>
 </tr>

   <tr>
    <th>9</th>
    <th>Medical :</th>
    <td>{{ $enquiry->medical_status }}</td>
  </tr>

 <tr>
    <th>10</th>
    <th>Duty Hours :</th>
    <td>{{ $enquiry->duty_hours }}</td>
  </tr>
   <tr>
    <th>11</th>
    <th>Overtime Hours :</th>
    <td>{{ $enquiry->overtime_hours }}</td>
  </tr>
   <tr>
    <th>12</th>
    <th>Uniform :</th>
    <td>{{ $enquiry->uniform_status }}</td>
  </tr>

  <tr>
    <th>13</th>
    <th>All other Conditions :</th>
    <td>{{ $enquiry->other_condition }}</td>
  </tr>
</table>

</body>
</html>





  {{--<h3> Enquiries:</h3>

    <table>
            <tr>  
               <th>Company </th>
               <th>Enquiry </th>
               <th>Contact Period</th>
               <th>Place of Work</th>
               <th>Trial Period</th>
               <th>Air Fare</th>
               <th>Employment Visa</th>
               <th>Food</th>
              <!--  <th>Transportation</th> -->
               <!-- <th>Accomodation </th>
               <th> Medical </th> -->
              <!--  <th> Duty Hours</th>
               <th>Overtime Hours</th>
               <th>Uniform Status</th>
               <th>Other Benefits</th>
               <th>Other condition</th>    -->      
            </tr>  
              
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
                        <td>{{ $enquiry->food_status }}</td>
                       <!--  <td>{{ $enquiry->transportation_status }}</td>
                        <td>{{ $enquiry->accomodation_status }}</td>
                        <td>{{ $enquiry-> medical_status }}</td> -->
                       <!--  <td>{{ $enquiry->duty_hours }}</td>
                        <td>{{ $enquiry->overtime_hours }}</td>
                         <td>{{ $enquiry->uniform_status }}</td>
                        <td>{{ $enquiry->other_benefits }}</td>
                        <td>{{ $enquiry->other_condition }}</td>
                        -->
                 </tr>
         
    </table>  





    <h3> Jobs :</h3>
    <table>
            <tr>
                <th> Category</th>
               <!--  <th> Trade</th> -->
                <th>Project Location</th>
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
                <td>
                  <?php $subcategory = Category::where(['category_id'=>$job->job_sub_category_id])->first()?>
                        {{$subcategory->category_name}}
                </td>
                 <td>
                     <?php  $client_location=DB::table('client_location')->where('client_id',$job->client_id)->get(); ?>
                         @foreach ($client_location as $data) {{ $data->client_location_code }}  =   

                                <?php  $project_location=DB::table('project_location')->where('location_id',$data->client_location_id)  
                                                                              ->where('job_id',$job->job_id)->get();  ?>
                                @foreach ($project_location as $location)
                                    {{ $location->required_position }}   <br> 
                                @endforeach 

                        @endforeach
                 </td>
                <td>{{$job->basic_salary}}</td>
                <td>{{$job->cola_allownces}}</td>
                <td>{{$job->food_allownce}}</td>
                <td>{{$job->transportation_allownce}}</td>
                <td>{{$job->accomodation_allownce}}</td>
                <td>{{$job->medical_allownce}}</td>
                <td>{{$job->overtime_allownce}}</td>          
           </tr>
            @endforeach

    </table>--}}

  </div>  
</body>
</html>                 




   



            
     