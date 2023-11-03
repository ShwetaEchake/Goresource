
<!-- <style type="text/css">  
    table td, table th{  
        border: 0.5px solid #c6c6c6;  
       padding: 10px;
font-family: Helvetica, Arial, Sans-Serif;
text-transform: uppercase;
font-size: 10px;
    }  
</style>  -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>


  <style>
       /* table, th, td {

border:  0.5px #c6c6c6;
border-collapse: collapse;
padding: 10px;
text-align:left;
margin:0;
padding:0;
font-family: Helvetica, Arial, Sans-Serif;
text-transform: uppercase;
font-size: 10px;
        }*/

        table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
  
    </style>
<body>

     {{--<?php $data=DB::table('assessment')->where('assessment_id',$_GET['id'])->first(); ?>
        <?php $data=DB::table('post_assessment')->where('post_assessment_id',$post_assmnt_id)->first();  ?> --}}



            <?php $data=DB::table('post_assessment')
                ->leftjoin('personal','personal.candidate_id','post_assessment.candidate_id')
                ->leftjoin('job_applied','job_applied.candidate_id','post_assessment.candidate_id')
                ->leftjoin('branch','branch.branch_id','personal.branch_id')
                ->leftjoin('candidate_documents','candidate_documents.candidate_id','personal.candidate_id')
                ->leftjoin('candidate_interview','candidate_interview.candidate_id','personal.candidate_id')
                ->leftjoin('jobs','jobs.job_id','job_applied.job_id')
                ->leftjoin('categories','categories.category_id','jobs.job_main_category_id')
                ->where('post_assessment.location_id',$locationID)
                ->where('post_assessment.job_id',$jobID)

                ->where('post_assessment_id',$post_assmnt_id)
                ->first(); 
            ?>



       <center></center>

        <table class="c17" width="100%">
            <tbody>
            <tr class="c62">
                <td class="c24" colspan="6" rowspan="1">
                 <p class="c25 c46">
                    <span>
                        <img alt="" src="http://45.79.124.136/Goresource/GO/public/img/image1.png" style="margin-top:10px;" height="60px;">
                   </span>

                   <span style="font-weight: bold; font-size: 30px; position: absolute; margin-top:10px;"> 
                       Post ASSESSMENT 
                  </span>

                   <span > 
                   <img alt="" src="http://45.79.124.136/Goresource/GO/public/img/image2.png" style=" margin-top:10px;margin-left:300px;" height="60px;">

                  </span>
                </p>

                   <!-- <span style="margin-left: 500px;">
                    <img alt="" src="{{public_path()}}/img/image2.png" height="60px;">
                   </span> -->

               <!--  <p class="c25 c46"><span class="c34 c12">&nbsp; &nbsp; &nbsp; &nbsp; </span>
                  <span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 354.87px; height: 38.80px;">
                    <img alt="" src="{{public_path()}}/img/image2.png" style="width: 354.87px; height: 38.80px; margin-left: 0.00px; margin-top: 0.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title="">
                 </span>
              </p> -->
                    </td>

    <td class="c23" colspan="1" rowspan="5"><p class="c25"><span class="c12 c77">Attached 1 pc. 2&rdquo; x 2&rdquo;</span></p><p class="c25"><span class="c77 c12">colored photo</span></p></td></tr><tr class="c49"><td class="c90" colspan="1" rowspan="1"><p class="c5"><span class="c61">GO ID#:</span></p></td><td class="c63" colspan="5" rowspan="1"><p class="c5"><span class="c61">&nbsp;Interviewed by:</span></p></td></tr><tr class="c75"><td class="c66" colspan="1" rowspan="1"><p class="c5"><span class="c8">Date &amp; Time Applied</span></p></td><td class="c54" colspan="3" rowspan="1"><p class="c3"><span class="c8"></span></p></td><td class="c9" colspan="1" rowspan="1"><p class="c5"><span class="c8">Ref.:</span></p></td><td class="c37" colspan="1" rowspan="1"><p class="c3"><span class="c8"></span></p></td></tr><tr class="c73"><td class="c43" colspan="2" rowspan="1"><p class="c5"><span class="c14">POSITION OFFERED:</span></p></td><td class="c15" colspan="2" rowspan="1"><p class="c5"><span class="c50">Proj. Ref:</span></p><p class="c3"><span class="c8"></span></p></td><td class="c42" colspan="2" rowspan="1"><p class="c5"><span class="c14">Country Preferred:</span></p></td></tr><tr class="c67"><td class="c68" colspan="3" rowspan="1"><p class="c5"><span class="c1">Position Applied: 1</span><span class="c22">st</span><span class="c1 c12">&nbsp;Choice</span></p></td><td class="c84" colspan="3" rowspan="1"><p class="c5"><span class="c1">Position Applied: 2</span><span class="c22">nd</span><span class="c1 c12">&nbsp;Choice</span></p></td></tr></tbody></table>

    <p class="c3"><span class="c1 c12"></span></p><a id="t.9881a417c5d14cefd08b63d5b03c6f6f2288e285"></a><a id="t.1"></a>

    <table class="c17" width="100%"><tbody><tr class="c7"><td class="c6" colspan="1" rowspan="1"><p class="c5"><span class="c30">APPLICANT&rsquo;S NAME</span></p></td><td class="c28" colspan="2" rowspan="1"><p class="c3"><span class="c1 c12"></span></p></td></tr><tr class="c59"><td class="c40" colspan="1" rowspan="1"><p class="c5"><span class="c50">PP Number:</span></p></td><td class="c41" colspan="1" rowspan="1"><p class="c5"><span class="c50">Issue Date:</span></p></td><td class="c85" colspan="1" rowspan="1"><p class="c5"><span class="c50">Expiry Date:</span></p></td></tr></tbody></table><p class="c3"><span class="c1 c12"></span></p><a id="t.cf8b60af333b9d8ecfbe13dc598c3fa2ace3bec7"></a><a id="t.2"></a>









    <table class="c17" width="100%"><tbody>
        <tr class="c29">
            <td class="c31" colspan="8" rowspan="1">
            <p class="c5"><span class="c61"> Post ASSESSMENT</span></p>
           </td>
       </tr>
    <tr class="c26">
        <td class="c56" colspan="2" rowspan="1"><p class="c25"><span class="c14" style="font-weight: bold;">Rating</span></p></td>
        <td class="c13" colspan="1" rowspan="1"><p class="c25"><span class="c14" style="font-weight: bold;">1</span></p> </td>
        <td class="c58" colspan="1" rowspan="1"><p class="c25"><span class="c14" style="font-weight:bold;">2</span></p> </td>
        <td class="c10" colspan="1" rowspan="1"><p class="c25"><span class="c14" style="font-weight:bold;">3</span></p> </td>
        <td class="c10" colspan="1" rowspan="1"><p class="c25"><span class="c14" style="font-weight:bold;">4</span></p> </td>
        <td class="c10" colspan="1" rowspan="1"><p class="c25"><span class="c14" style="font-weight:bold;">5</span></p> </td>
        <td class="c52" colspan="1" rowspan="1"><p class="c25"><span class="c14" style="font-weight:bold;">Remarks</span></p></td>
    </tr>

    <tr class="c26">
            <td class="c56" colspan="2" rowspan="1"><p class="c5"><span class="c14" style="font-weight: bold;">Personality Appearance/Attitude</span></p></td>
            <td class="c13" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                 @if($data->personality_appearence=='INEFFECTIVE')
                   {{$data->personality_appearence}} 
                 @endif
            </td>
            <td class="c58" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                  @if($data->personality_appearence=='NEEDSIMPROVMENT')
                   {{$data->personality_appearence}} 
                  @endif
              </td>
            <td class="c10" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p> 
                 @if($data->personality_appearence=='GOOD')
                   {{$data->personality_appearence}} 
                 @endif
             </td>
            <td class="c10" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p> 
                  @if($data->personality_appearence=='VERYGOOD')
                   {{$data->personality_appearence}} 
                  @endif
              </td>
            <td class="c10" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                 @if($data->personality_appearence=='EXCELLENT')
                   {{$data->personality_appearence}} 
                 @endif
             </td>
            <td class="c52" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
               {{ $data->personality_remark }}
            </td>
    </tr>


        <tr class="c26">
            <td class="c56" colspan="2" rowspan="1"><p class="c5"><span class="c14" style="font-weight: bold;">Knowledge &amp; Technical Skills</span></p></td>
            <td class="c13" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                  @if($data->knowledge=='INEFFECTIVE')
                   {{$data->knowledge}} 
                  @endif
            </td>
            <td class="c58" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                  @if($data->knowledge=='NEEDSIMPROVMENT')
                   {{$data->knowledge}} 
                  @endif
            </td>
            <td class="c10" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                  @if($data->knowledge=='GOOD')
                   {{$data->knowledge}} 
                  @endif
            </td>
            <td class="c10" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                 @if($data->knowledge=='VERYGOOD')
                   {{$data->knowledge}} 
                 @endif
            </td>
            <td class="c10" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                  @if($data->knowledge=='EXCELLENT')
                   {{$data->knowledge}} 
                  @endif
            </td>
            <td class="c52" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>{{ $data->knowledge_remark }}</td>
        </tr>


        <tr class="c89">
            <td class="c56" colspan="2" rowspan="1"><p class="c5"><span class="c14" style="font-weight: bold;">Initiative/Leadership</span></p></td>
            <td class="c13" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                  @if($data->ledership=='INEFFECTIVE')
                   {{$data->ledership}} 
                  @endif
            </td>
            <td class="c58" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                   @if($data->ledership=='NEEDSIMPROVMENT')
                   {{$data->ledership}} 
                   @endif
            </td>
            <td class="c10" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                  @if($data->ledership=='GOOD')
                   {{$data->ledership}} 
                  @endif
            </td>

            <td class="c10" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                   @if($data->ledership=='VERYGOOD')
                   {{$data->ledership}} 
                  @endif
            </td>
            <td class="c10" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                  @if($data->ledership=='EXCELLENT')
                   {{$data->ledership}} 
                  @endif
            </td>
            <td class="c52" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>{{$data->leadership_remark}}</td>
        </tr>



        <tr class="c26">
            <td class="c56" colspan="2" rowspan="1"><p class="c5"><span class="c14" style="font-weight: bold;">English &nbsp;Communication</span></p></td>
            <td class="c13" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p> 
                  @if($data->communication=='INEFFECTIVE')
                   {{$data->communication}} 
                  @endif
            </td>
            <td class="c58" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                 @if($data->communication=='NEEDSIMPROVMENT')
                   {{$data->communication}} 
                   @endif
            </td>
            <td class="c10" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                  @if($data->communication=='GOOD')
                   {{$data->communication}} 
                  @endif
            </td>
            <td class="c10" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                   @if($data->communication=='VERYGOOD')
                   {{$data->communication}} 
                   @endif
            </td>
            <td class="c10" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                  @if($data->communication=='EXCELLENT')
                   {{$data->communication}} 
                  @endif
            </td>
            <td class="c52" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>{{$data->communication_remark}} </td>
        </tr>



        <tr class="c70">
            <td class="c56" colspan="2" rowspan="1"><p class="c5"><span class="c14" style="font-weight: bold;">Others (Please Specify)</span></p></td>
            <td class="c13" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                  @if($data->other_assessment=='INEFFECTIVE')
                   {{$data->other_assessment}} 
                   @endif

            </td>
            <td class="c58" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                  @if($data->other_assessment=='NEEDSIMPROVMENT')
                   {{$data->other_assessment}} 
                   @endif
            </td>
            <td class="c10" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                  @if($data->other_assessment=='GOOD')
                   {{$data->other_assessment}} 
                   @endif
            </td>
            <td class="c10" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                   @if($data->other_assessment=='VERYGOOD')
                   {{$data->other_assessment}} 
                   @endif
            </td>
            <td class="c10" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>
                  @if($data->other_assessment=='EXCELLENT')
                   {{$data->other_assessment}} 
                  @endif
            </td>
            <td class="c52" colspan="1" rowspan="1"><p class="c3"><span class="c16 c12"></span></p>{{$data->other_assessment_remark}}</td>
        </tr>

        <tr class="c26"><td class="c81" colspan="1" rowspan="1"><p class="c25"><span class="c1 c12">1=22-40 Ineffective</span></p></td><td class="c57" colspan="2" rowspan="1"><p class="c25"><span class="c1 c12">2=41-59 NEEDS IMPROVEMENT</span></p></td><td class="c64" colspan="2" rowspan="1"><p class="c25"><span class="c1 c12">3=60-78 Good</span></p></td><td class="c86" colspan="2" rowspan="1"><p class="c25"><span class="c1 c12">4=79-97 Very Good</span></p></td><td class="c52" colspan="1" rowspan="1"><p class="c25"><span class="c1 c12">5=98-100 EXCELLENT</span></p></td></tr>
    </tbody></table>



    <p class="c3"><span class="c1 c12"></span></p><a id="t.fea070d58573215acb9d66d2a8a64b086156040d"></a><a id="t.3"></a>
    <table class="c17"  width="100%" ><tbody>
        <tr class="c7"><td class="c31" colspan="1" rowspan="1"><p class="c5"><span class="c30" style="font-weight: bold;">EDUCATION</span></p></td>
    </tr>
</tbody></table>
    <p class="c3"><span class="c1 c12"></span></p><a id="t.cf6b86701504e9daadc380f26d178d05f8f38705"></a><a id="t.4"></a>



    <table class="c17" width="100%" style="color: black;"><tbody>
    <tr class="c7">
        <td class="c6" colspan="1" rowspan="1"><p class="c5"><span class="c2">DEGREE OBTAINED</span></p></td>
        <td class="c28" colspan="1" rowspan="1"><p class="c3"><span class="c2"></span></p>{{$data->degree_optain }}</td>
    </tr>

    <tr class="c7">
        <td class="c6" colspan="1" rowspan="1"><p class="c5"><span class="c2">PROFESSIONAL LICENSE No.</span></p></td>
        <td class="c28" colspan="1" rowspan="1"><p class="c3"><span class="c2"></span></p>{{ $data->professional_licence_no }}</td>
    </tr>

    <tr class="c7">
        <td class="c6" colspan="1" rowspan="1"><p class="c5"><span class="c2">TECHNICAL QUALIFICATION</span></p></td>
        <td class="c28" colspan="1" rowspan="1"><p class="c3"><span class="c2"></span></p>{{ $data->technical_qualification }}</td>
    </tr>

    <tr class="c7">
        <td class="c6" colspan="1" rowspan="1"><p class="c5"><span class="c2">KEY SKILLS</span></p></td>
        <td class="c28" colspan="1" rowspan="1"><p class="c3"><span class="c2"></span></p>{{ $data->key_skill }}</td>
   </tr>

   <tr class="c7">
     <td class="c6" colspan="1" rowspan="1"><p class="c5"><span class="c2">TRADE TEST</span></p></td>
     <td class="c28" colspan="1" rowspan="1"><p class="c3"><span class="c2"></span></p>{{ $data->trade_test }}</td>
  </tr>

</tbody></table>



    <p class="c3"><span class="c1 c12"></span></p><a id="t.884045b66e29288e611e9815ac12984d0c7cd650"></a><a id="t.5"></a>



    <table class="c17" width="100%">
        <tbody>
    <tr class="c78">
        <td class="c44" colspan="1" rowspan="1">
         <p class="c5"><span class="c61 c72" style="font-weight:bold;">LANGUAGE USED:</span></p>
        </td>
           <td class="c4" colspan="1" rowspan="1"><p class="c5"><span class="c65 c12">English</span></p></td>
           <!--  <td class="c4" colspan="1" rowspan="1"><p class="c5"><span class="c65 c12">Nepal</span></p></td> -->
            <td class="c71" colspan="1" rowspan="1"><p class="c5"><span class="c65 c12">Hindi</span></p></td>
            <td class="c20" colspan="1" rowspan="1"><p class="c5"><span class="c12 c65">Others</span></p></td>
    </tr>

        <tr class="c78">
            <td class="c44" colspan="1" rowspan="1"><p class="c25"><span class="c14" style="font-weight:bold;">Rating</span></p></td>
      <!--  <td class="c4" colspan="1" rowspan="1"><p class="c19"><span class="c16 c12"></span></p></td>-->           
            <td class="c4" colspan="1" rowspan="1"><p class="c19"><span class="c16 c12"></span></p>{{$data->languge_used}}</td>
            <td class="c71" colspan="1" rowspan="1"><p class="c19"><span class="c16 c12"></span></p>{{$data->languge_used1}}</td>
            <td class="c20" colspan="1" rowspan="1"><p class="c19"><span class="c16 c12"></span></p>{{$data->languge_used2}}</td>
        </tr>
    </tbody>
</table>


    <p class="c3"><span class="c1 c12"></span></p><a id="t.0ad1fe5bf9f7a5c777d18a2f004c4dfa39d6bc6a"></a><a id="t.6"></a>


    <table class="c17" width="100%"><tbody>
        <tr class="c48"><td class="c31" colspan="3" rowspan="1"><p class="c5"><span class="c30" style="font-weight:bold;">WORK EXPERIENCE</span></p></td></tr>
        <tr class="c45">
            <td class="c36" colspan="1" rowspan="1"><p class="c19"><span class="c1 c12"></span></p></td>
            <td class="c38" colspan="1" rowspan="1"><p class="c25"><span class="c60" style="font-weight:bold;">POSITIONS HELD</span></p></td>
            <td class="c47" colspan="1" rowspan="1"><p class="c25"><span class="c60" style="font-weight:bold;">TOTAL YEARS/MONTHS</span></p></td>
        </tr>

        <tr class="c74">
            <td class="c36" colspan="1" rowspan="1"><p class="c5"><span class="c2" style="font-weight:bold;">LOCAL</span></p></td>
            <td class="c38" colspan="1" rowspan="1"><p class="c3"><span class="c2"></span></p>{{$data->local_work_experience}}</td>
            <td class="c47" colspan="1" rowspan="1"><p class="c3"><span class="c2"></span></p>{{$data->local_experience_year}}</td>
        </tr>
        <tr class="c55"><td class="c36" colspan="1" rowspan="1"><p class="c5"><span class="c2" style="font-weight:bold;">OVERSEAS</span></p></td>
            <td class="c38" colspan="1" rowspan="1"><p class="c3"><span class="c2"></span></p>{{$data->overseas_expereicne}}</td>
            <td class="c47" colspan="1" rowspan="1"><p class="c3"><span class="c2"></span></p>{{$data->overseaase_year}}</td>
        </tr>
    </tbody></table>



    <p class="c3"><span class="c1 c12"></span></p><a id="t.439d38914d70679623f819578b019eee4492871d"></a><a id="t.7"></a>



<table class="c17" width="100%">
    <tbody>
        <tr class="c7"><td class="c31" colspan="5" rowspan="1"><p class="c5"><span class="c27 c12" style="font-weight:bold">OVERALL ASSESSMENT</span></p></td>
        </tr>
            <tr class="c7"><td class="c11" colspan="1" rowspan="1"><p class="c5"><span class="c27 c12"></span></p>
                    @if($data->overall_assessment == 'selected')
                     {{$data->overall_assessment}}
                    @endif
            </td>
            <td class="c11" colspan="1" rowspan="1"><p class="c5"><span class="c27 c12"></span></p>
                @if($data->overall_assessment == 'reserved')
                 {{$data->overall_assessment}}
                @endif
            </td>
            <td class="c11" colspan="1" rowspan="1"><p class="c5"><span class="c27 c12"></span></p>
                 @if($data->overall_assessment == 'rejected')
                    {{$data->overall_assessment}}
                 @endif
            </td>
            <td class="c39" colspan="1" rowspan="1"><p class="c5"><span class="c27 c12"></span></p>
                 @if($data->overall_assessment == 'others')
                    {{$data->overall_assessment}}
                @endif
            </td>
            <td class="c20" colspan="1" rowspan="1"><p class="c5"><span class="c27 c12">Overall</span></p><p class="c5"><span class="c12 c27">Rating%</span></p>
                {{$data->overall_rating}}
            </td>
        </tr>
    </tbody>
</table>



    <p class="c3"><span class="c1 c12"></span></p><p class="c3"><span class="c1 c12"></span></p><a id="t.fcddc011112a37a3a73b79fd1c8cc4d547fe3d9a"></a><a id="t.8"></a>


    <table class="c17" width="100%"><tbody><tr class="c7"><td class="c31" colspan="1" rowspan="1"><p class="c5"><span class="c27 c12" style="font-weight: bold;">REMARKS</span></p></td></tr>
        <tr class="c7"><td class="c31" colspan="1" rowspan="1"><p class="c3"><span class="c2"></span></p>{{$data->remark}}</td></tr>


        <!-- <tr class="c7"><td class="c31" colspan="1" rowspan="1"><p class="c3"><span class="c2"></span></p></td></tr>
        <tr class="c7"><td class="c31" colspan="1" rowspan="1"><p class="c3"><span class="c2"></span></p></td></tr>
        <tr class="c7"><td class="c31" colspan="1" rowspan="1"><p class="c3"><span class="c2"></span></p></td></tr>
        <tr class="c7"><td class="c31" colspan="1" rowspan="1"><p class="c3"><span class="c2"></span></p></td></tr> -->

    </tbody></table>



    <p class="c3"><span class="c1 c12"></span></p>


</body></html>
