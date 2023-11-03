<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Send Mail(Candidate Interview Detail)</title>
</head>
<body>
<h3>Subject Line: {{ $company_name }} Invitation to Interview</h3><br>

<p>Dear {{ $name }},</p>

<p>Thank you for your application to the {{ $category_name }} role at {{ $company_name }}<br>


{{ $interview_venu }}
<p><br>


Please reply to this email directly with your availability during the following date and time options:

<?php echo date('d-m-Y',$interview_date) ?>

We look forward to speaking with you. 
<br>
Sincerely,
<br>
{{$interviewer_name}}
<br>
{{$interviewer_mobileno}}
<br>
{{$interviewer_email}}
</body>
</html>