@extends('layouts.admin')

@section('title')
Salary
@endsection




@section('content')
<!DOCTYPE html> 
<html> 
<body> 

 <div class="card card-primary">   
    <div class="card-tools">
      <div class="card-body">

@if($_REQUEST["q"] =='candidate')
      <iframe width="1000" height="500" src="http://45.79.124.136/Goresource/HelpSheet/Candidate.webm" frameborder="0" allowfullscreen></iframe>

@elseif($_REQUEST["q"] =='client')
      <iframe width="1000" height="500" src="http://45.79.124.136/Goresource/HelpSheet/client.webm" frameborder="0" allowfullscreen></iframe>

@elseif($_REQUEST["q"] =='enquiry')
      <iframe width="1000" height="500" src="http://45.79.124.136/Goresource/HelpSheet/Enquiry.webm"  frameborder="0" allowfullscreen></iframe>

@elseif($_REQUEST["q"] =='applied')
<iframe width="1000" height="500" src="http://45.79.124.136/Goresource/HelpSheet/jobapplied/1applied.webm" frameborder="0" allowfullscreen></iframe>

@elseif($_REQUEST["q"] =='assessment')
<iframe width="1000" height="500" src="http://45.79.124.136/Goresource/HelpSheet/jobapplied/2Assessment.webm" frameborder="0" allowfullscreen></iframe>

@elseif($_REQUEST["q"] =='enrollment')
<iframe width="1000" height="500" src="http://45.79.124.136/Goresource/HelpSheet/jobapplied/3enrollment.webm" frameborder="0" allowfullscreen></iframe>

@elseif($_REQUEST["q"] =='interview')
<iframe width="1000" height="500" src="http://45.79.124.136/Goresource/HelpSheet/jobapplied/4interview.webm" frameborder="0" allowfullscreen></iframe>

@elseif($_REQUEST["q"] =='selection')
<iframe width="1000" height="500" src="http://45.79.124.136/Goresource/HelpSheet/jobapplied/5selection.webm" frameborder="0" allowfullscreen></iframe>

@elseif($_REQUEST["q"] =='offers')
<iframe width="1000" height="500" src="http://45.79.124.136/Goresource/HelpSheet/jobapplied/6offers.webm" frameborder="0" allowfullscreen></iframe>

@elseif($_REQUEST["q"] =='medical')
<iframe width="1000" height="500" src="http://45.79.124.136/Goresource/HelpSheet/jobapplied/7medical.webm" frameborder="0" allowfullscreen></iframe>

@elseif($_REQUEST["q"] =='vc')
<iframe width="1000" height="500" src="http://45.79.124.136/Goresource/HelpSheet/jobapplied/8vc.webm"  frameborder="0" allowfullscreen></iframe>

@elseif($_REQUEST["q"] =='visa')
<iframe width="1000" height="500" src="http://45.79.124.136/Goresource/HelpSheet/jobapplied/9visa.webm"  frameborder="0" allowfullscreen></iframe>
@endif


      </div>
  </div>
</div>



</body> 
</html>


@endsection
