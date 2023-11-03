<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/icon/themify-icons/themify-icons.css')}}">
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/icon/font-awesome/css/font-awesome.min.css')}}">

  <!-- Select2 start -->
 <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
 <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
 <!-- Select2 end-->

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<!-- fullCalendar -->
  <link rel="stylesheet" href="{{asset('plugins/fullcalendar/main.css')}}">


<style type="text/css">
    body{
     font-family: 'Poppins', sans-serif;
    }

    label
{font-weight:normal!important;}

</style>
@yield('css')
</head>
<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper" id="app">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link"></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link"></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item d-none d-sm-inline-block">

                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <p>
                            <i class="nav-icon fa fa-power-off"></i>
                            Logout
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
            
                 <center>
                    <img src="{{ asset('img/GOLOGOtm-2020.png') }}" height="30px" height="50px;" alt="AdminLTE Logo" class="" style="">
                </center>
                <span class="brand-text font-weight-30px;" style=""></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/avatar.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}-{{ auth()->user()->user_type }}</a>
                    </div>
                </div>




@if(auth()->user()->user_type == "Client")
     <!------------------------------ Client  Start----------------------------------------->

               <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column  " data-widget="treeview" role="menu" data-accordion="true">
                       

                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-tv"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>



                      <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ request()->is('home*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-search"></i>
                                <p>
                                    My Candidates
                                </p>
                            </a>
                        </li>
                        
                       <li class="nav-item">
                            <a href="{{ route('enquiry.index') }}" class="nav-link {{ request()->is('enquiry*') ? 'active' : '' }}">
                            <i class="fa fa-question-circle nav-icon"></i>
                            <p>Enquiry</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('job.index') }}" class="nav-link {{ request()->is('job*') ? 'active' : '' }}">
                            <i class="fa fa-suitcase nav-icon"></i>
                            <p>Job</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('interview.index') }}" class="nav-link {{ request()->is('interview*') ? 'active' : '' }}">
                            <i class=" fa fa-question-circle nav-icon"></i>
                            <p>Interview</p>
                            </a>
                        </li>
                      

                     

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                <i class="nav-icon fa fa-power-off"></i>
                                <p>
                                    Logout
                                </p>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </nav>
     <!------------------------------ Client End ----------------------------------------->


@elseif(auth()->user()->user_type == "User")
     <!------------------------------ Executive  Start----------------------------------------->

               <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column  " data-widget="treeview" role="menu" data-accordion="true">
                       

                      <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ request()->is('home*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-tv"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>


                       <!--  <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                            <i class="fa fa-users nav-icon"></i>
                            <p>Users</p>
                            </a>
                        </li> -->

                        <li class="nav-item">
                            <a href="{{ route('personal.index') }}" class="nav-link {{ request()->is('personal*') ? 'active' : '' }}">
                            <i class="fa fa-user-edit nav-icon"></i>
                            <p>Candidate</p>
                            </a>
                        </li>

                        
                  <!--      <li class="nav-item">
                            <a href="{{ route('enquiry.index') }}" class="nav-link {{ request()->is('enquiry*') ? 'active' : '' }}">
                            <i class="fa fa-question-circle nav-icon"></i>
                            <p>Enquiry</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('job.index') }}" class="nav-link {{ request()->is('job*') ? 'active' : '' }}">
                            <i class="fa fa-suitcase nav-icon"></i>
                            <p>Job</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('interview.index') }}" class="nav-link {{ request()->is('interview*') ? 'active' : '' }}">
                            <i class=" fa fa-question-circle nav-icon"></i>
                            <p>Interview</p>
                            </a>
                        </li>

                         <li class="nav-item">
                            <a href="{{ route('advertisment.index') }}" class="nav-link {{ request()->is('advertisment*') ? 'active' : '' }}">
                            <i class="fa fa-ad nav-icon"></i>
                            <p>Advertise</p>
                            </a>
                        </li> -->
                      

                     

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                <i class="nav-icon fa fa-power-off"></i>
                                <p>
                                    Logout
                                </p>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </nav>
     <!------------------------------ Executive End ----------------------------------------->



@else
<!------------------------------ Admin ----------------------------------------->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-tv"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                          <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ request()->is('home*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-search"></i>
                                <p>
                                    My Candidates
                                </p>
                            </a>
                        </li>


                        <li class="nav-item has-treeview ">
                            <a href="{{ route('firebase') }}" class="nav-link {{ request()->is('firebase*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-bell"></i>
                                <p>
                                    Notification
                                   
                                </p>
                            </a>
                        </li>
                        
                     


                        {{--<li class="nav-item">
                            <a href="{{ route('userGetPassword') }}" class="nav-link">
                            <i class="fa fa-lock nav-icon"></i>
                            <p>Change Password</p>
                            </a>
                        </li>--}}

                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                            <i class="fa fa-users nav-icon"></i>
                            <p>Users</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('personal.index') }}" class="nav-link {{ request()->is('personal*') ? 'active' : '' }}">
                            <i class="fa fa-user-edit nav-icon"></i>
                            <p>Candidate</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('client.index') }}" class="nav-link {{ request()->is('client*') ? 'active' : '' }}">
                            <i class="fa fa-address-card nav-icon"></i>
                            <p>Client</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('enquiry.index') }}" class="nav-link {{ request()->is('enquiry*') ? 'active' : '' }}">
                            <i class="fa fa-question-circle nav-icon"></i>
                            <p>Enquiry</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('job.index') }}" class="nav-link {{ request()->is('job*') ? 'active' : '' }}">
                            <i class="fa fa-suitcase nav-icon"></i>
                            <p>Job</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('advertisment.index') }}" class="nav-link {{ request()->is('advertisment*') ? 'active' : '' }}">
                            <i class="fa fa-ad nav-icon"></i>
                            <p>Advertise</p>
                            </a>
                        </li>
                      

 @if((Request::is('country*'))  || (Request::is('state*')) || (Request::is('documenttype*')) || (Request::is('category*')) || (Request::is('language*')) || (Request::is('enquirydocumenttype*')) || (Request::is('medicalexaminationcenter*')) || (Request::is('branch*')) || (Request::is('emailtemplate*')) || (Request::is('smstemplate*')))

            @php($class="menu-open")
            @php($active="active")
            @else
            @php($class="")
            @php($active="")
            @endif


         <li class="nav-item has-treeview {{$class}}">
                      
                             <a href="#" class="nav-link {{$active}}">
                                <i class="nav-icon fa fa-cogs"></i>
                                <p >
                                    Masters
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                             </a>

                 <ul class="nav nav-treeview">



                       <li class="nav-item" style="margin-left:10px;">
                            <a href="{{ route('country.index') }}" class="nav-link {{ request()->is('country*') ? 'active' : '' }}">
                            <i class="fa fa-flag nav-icon"></i>
                            <p>Country</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item" style="margin-left:10px;">
                            <a href="{{ route('state.index') }}" class="nav-link {{ request()->is('state*') ? 'active' : '' }}">
                            <i class="fa fa-flag nav-icon"></i>
                            <p>State</p>
                            </a>
                        </li> -->


                      <li class="nav-item" style="margin-left:10px;">
                            <a href="{{ route('documenttype.index') }}" class="nav-link {{ request()->is('documenttype*') ? 'active' : '' }}">
                            <i class="fa fa-file nav-icon"></i>
                            <p>Candidate D Type</p>
                            </a>
                        </li>


                      <!--   <li class="nav-item" style="margin-left:10px;">
                            <a href="{{ route('executive.index') }}" class="nav-link {{ request()->is('executive*') ? 'active' : '' }}">
                            <i class="fa fa-user-plus nav-icon"></i>
                            <p>Executive</p>
                            </a>
                        </li> -->
                        <li class="nav-item" style="margin-left:10px; ">
                             <a href="{{ route('category.index') }}" class="nav-link {{ request()->is('category*') ? 'active' : '' }}">
                            <i class="fa fa-list-alt  nav-icon"></i>
                            <p>Category</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item" style="margin-left:10px;">
                            <a href="{{ route('role.index') }}" class="nav-link {{ request()->is('role*') ? 'active' : '' }}">
                            <i class="fa fa-tasks nav-icon"></i>
                            <p>Roles</p>
                            </a>
                        </li>
                         <li class="nav-item" style="margin-left:10px;">
                            <a href="{{ route('enquirychecklist.index') }}" class="nav-link {{ request()->is('enquirychecklist*') ? 'active' : '' }}">
                            <i class="fa fa-check-circle nav-icon"></i>
                            <p>Enquiry Checklist</p>
                            </a>
                        </li>
                         <li class="nav-item" style="margin-left:10px;">
                           <a href="{{ route('locations.index') }}" class="nav-link {{ request()->is('locations*') ? 'active' : '' }}">
                            <i class="fa fa-search-location nav-icon"></i>
                            <p>Location</p>
                            </a>
                         </li> -->
                        <li class="nav-item" style="margin-left:10px;">
                    <a href="{{ route('branch.index') }}" class="nav-link {{ request()->is('branch*') ? 'active' : '' }}">
                            <i class=" fa fa-map-marker-alt nav-icon"></i>
                            <p> Branch Location</p>
                            </a>
                        </li>
                          <li class="nav-item" style="margin-left:10px;">
                              <a href="{{ route('emailtemplate.index') }}" class="nav-link {{ request()->is('emailtemplate*') ? 'active' : '' }}">
                            <i class="fa fa-envelope nav-icon"></i>
                            <p> Email Template</p>
                            </a>
                        </li>
                        <li class="nav-item" style="margin-left:10px;" >
                          <a href="{{ route('smstemplate.index') }}" class="nav-link {{ request()->is('smstemplate*') ? 'active' : '' }}">

                            <i class=" fa fa-sms nav-icon"></i>
                            <p> Sms Template</p>
                            </a>
                        </li>

                         <li class="nav-item" style="margin-left:10px;" >
                          <a href="{{ route('language.index') }}" class="nav-link {{ request()->is('language*') ? 'active' : '' }}">
                            <i class="fa fa-language  nav-icon"></i>
                            <p> Language</p>
                            </a>
                        </li>

                         <li class="nav-item" style="margin-left:10px;" >
                          <a href="{{ route('medicalexaminationcenter.index') }}" class="nav-link {{ request()->is('medicalexaminationcenter*') ? 'active' : '' }}">
                            <i class="fa fa-medkit  nav-icon"></i>
                            <p>Examination Center</p>
                            </a>
                        </li>

                          <li class="nav-item" style="margin-left:10px;" >
                          <a href="{{ route('enquirydocumenttype.index') }}" class="nav-link {{ request()->is('enquirydocumenttype*') ? 'active' : '' }}">
                            <i class="fa fa-file  nav-icon"></i>
                            <p>Enquiry D Type</p>
                            </a>
                        </li>

                          <li class="nav-item" style="margin-left:10px;" >
                          <a href="{{ route('templatemaster.index') }}" class="nav-link {{ request()->is('templatemaster*') ? 'active' : '' }}">
                            <i class="fa fa-file  nav-icon"></i>
                            <p>Template</p>
                            </a>
                        </li>
                </ul>
            </li>

             <li class="nav-item has-treeview">
                      
                             <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-file"></i>
                                <p >
                                    Reports
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                             </a>

                 <ul class="nav nav-treeview">
                       <li class="nav-item" style="margin-left:10px;">
                            <a href="{{ url('soa') }}" class="nav-link {{ request()->is('soa*') ? 'active' : '' }}">
                            <i class="fa fa-file nav-icon"></i>
                            <p > SUMMARY  ARRIVAL </p>
                            </a>
                        </li>

                         <li class="nav-item" style="margin-left:10px;">
                            <a href="{{ url('isl') }}" class="nav-link {{ request()->is('isl*') ? 'active' : '' }}">
                            <i class="fa fa-file nav-icon"></i>
                            <p>INTERVIEW STATUS </p>
                            </a>
                        </li>

                         <li class="nav-item" style="margin-left:10px;">
                            <a href="{{ url('salary') }}" class="nav-link {{ request()->is('salary*') ? 'active' : '' }}">
                            <i class="fa fa-file nav-icon"></i>
                            <p>DQ Salary </p>
                            </a>
                        </li>
                </ul>
            </li>
                        <li class="nav-item">
                           <a href="{{ route('invoice.index') }}" class="nav-link {{ request()->is('invoice*') ? 'active' : '' }}">
                            <i class="fa fa-file-invoice-dollar nav-icon"></i>
                            <p>Invoice</p>
                            </a>
                        </li>
          
                        <li class="nav-item">
                        <a href="{{ route('interview.index') }}" class="nav-link {{ request()->is('interview*') ? 'active' : '' }}">
                            <i class=" fa fa-question-circle nav-icon"></i>
                            <p>Interview</p>
                            </a>
                        </li>

                       

     <!------------------------------------------------- //Help Menu ------------------------------------------------------>


                          <li class="nav-item has-treeview">
                      
                             <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-cogs"></i>
                                <p >
                                    Help Menu
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                             </a>

                 <ul class="nav nav-treeview">



                       <li class="nav-item" style="margin-left:10px;">
                            <a href=helpmenu/?q=candidate class="nav-link {{ request()->is('helpmenu?q=candidate*') ? 'active' : '' }}">
                            <i class="fa fa-users nav-icon"></i>
                            <p>Candidate</p>
                            </a>
                        </li>


                      <li class="nav-item" style="margin-left:10px;">
                            <a href=helpmenu/?q=client class="nav-link {{ request()->is('helmenu*') ? 'active' : '' }}">
                            <i class="fa fa-user nav-icon"></i>
                            <p>Client</p>
                            </a>
                        </li>


                        <li class="nav-item" style="margin-left:10px; ">
                             <a href=helpmenu/?q=enquiry class="nav-link {{ request()->is('enquiry*') ? 'active' : '' }}">
                            <i class="fa fa-question-circle  nav-icon"></i>
                            <p>Enquiry</p>
                            </a>
                        </li>
                        <li class="nav-item" style="margin-left:10px;">
                            <a href=helpmenu/?q=applied class="nav-link {{ request()->is('applied*') ? 'active' : '' }}">
                            <!-- <i class="fa fa-tasks nav-icon"></i> -->
                         <h6>My Candidates:</h6> <p>i) Applied</p>
                            </a>
                        </li>
                         <li class="nav-item" style="margin-left:10px;">
                            <a href=helpmenu/?q=assessment class="nav-link {{ request()->is('assessment*') ? 'active' : '' }}">
                            <!-- <i class="fa fa-check-circle nav-icon"></i> -->
                            <p>ii) Assessment</p>
                            </a>
                        </li>
                         <li class="nav-item" style="margin-left:10px;">
                           <a href=helpmenu/?q=enrollment class="nav-link {{ request()->is('enrollment*') ? 'active' : '' }}">
                            <!-- <i class="fa fa-search-location nav-icon"></i> -->
                            <p>iii) Enrollment</p>
                            </a>
                         </li>
                        <li class="nav-item" style="margin-left:10px;">
                          <a href=helpmenu/?q=interview class="nav-link {{ request()->is('interview*') ? 'active' : '' }}">
                            <!-- <i class=" fa fa-map-marker-alt nav-icon"></i> -->
                            <p> iv) Interview</p>
                            </a>
                        </li>
                          <li class="nav-item" style="margin-left:10px;">
                              <a href=helpmenu/?q=selection class="nav-link {{ request()->is('selection*') ? 'active' : '' }}">
                           <!--  <i class="fa fa-envelope nav-icon"></i> -->
                            <p>v) Selection</p>
                            </a>
                        </li>
                        <li class="nav-item" style="margin-left:10px;" >
                          <a href=helpmenu/?q=offers class="nav-link {{ request()->is('offers*') ? 'active' : '' }}">
                            <!-- <i class=" fa fa-sms nav-icon"></i> -->
                            <p>vi) Offer letter</p>
                            </a>
                        </li>

                         <li class="nav-item" style="margin-left:10px;" >
                          <a href=helpmenu/?q=medical class="nav-link {{ request()->is('medical*') ? 'active' : '' }}">
                          <!--   <i class="fa fa-language  nav-icon"></i> -->
                            <p> vii) Medical</p>
                            </a>
                        </li>

                         <li class="nav-item" style="margin-left:10px;" >
                          <a href=helpmenu/?q=qvc  class="nav-link {{ request()->is('qvc*') ? 'active' : '' }}">
                            <!-- <i class="fa fa-medkit  nav-icon"></i> -->
                            <p> Viii) Qvc </p>
                            </a>
                        </li>

                          <li class="nav-item" style="margin-left:10px;" >
                          <a href=helpmenu/?q=visa  class="nav-link {{ request()->is('visa*') ? 'active' : '' }}">
                            <!-- <i class="fa fa-file  nav-icon"></i> -->
                            <p> ix) Visa</p>
                            </a>
                        </li>

                         
                </ul>
            </li>
    <!-- //------------------------------------------------------Help Menu -------------------------------------------------------------------->

                       


        {{--  <li class="nav-item">
                <a href="{{ route('jobapplied.index') }}" class="nav-link {{ request()->is('jobapplied*') ? 'active' : '' }}">
                            <i class=" fa fa-quote-right  nav-icon"></i>
                            <p>Job Applied</p>
                            </a>
                        </li>

                        <li class="nav-item">
                <a href="{{ route('assessment.index') }}" class="nav-link {{ request()->is('assessment*') ? 'active' : '' }}">
                            <i class=" fa fa-industry nav-icon"></i>
                            <p>Assesment</p>
                            </a>
                        </li>

                          <li class="nav-item">
                <a href="{{ route('postassessment.index') }}" class="nav-link {{ request()->is('postassessment*') ? 'active' : '' }}">
                            <i class="fa fa-industry nav-icon"></i>
                            <p> Post Assesment</p>
                            </a>
                        </li>


                        <li class="nav-item">
                <a href="{{ route('enrollment.index') }}" class="nav-link {{ request()->is('enrollment*') ? 'active' : '' }}">
                            <i class=" fa fa-registered  nav-icon"></i>
                            <p>Enrollment</p>
                            </a>
                        </li>

              

                        <li class="nav-item">
                <a href="{{ route('selection.index') }}" class="nav-link {{ request()->is('selection*') ? 'active' : '' }}">
                            <i class=" fa fa-check-circle nav-icon"></i>
                            <p>Selection</p>
                            </a>
                        </li>

                          <li class="nav-item">
                <a href="{{ route('offerletter.index') }}" class="nav-link {{ request()->is('offerletter*') ? 'active' : '' }}">
                            <i class=" fa fa-sticky-note  nav-icon"></i>
                            <p>Offer Letter</p>
                            </a>
                        </li>

                         <li class="nav-item">
                <a href="{{ route('premedical.index') }}" class="nav-link {{ request()->is('premedical*') ? 'active' : '' }}">
                            <i class=" fa fa-medkit nav-icon"></i>
                            <p>Pre Medical</p>
                            </a>
                        </li>
                        <li class="nav-item">
                <a href="{{ route('qvcprocess.index') }}" class="nav-link {{ request()->is('qvcprocess*') ? 'active' : '' }}">
                            <i class="fa fa fa-quote-left  nav-icon"></i>
                            <p>QVC</p>
                            </a>
                        </li>

                 <li class="nav-item">
                    <a href="{{ route('visaprocess.index') }}" class="nav-link {{ request()->is('visaprocess*') ? 'active' : '' }}" class="nav-link">
                    <i class=" fa fa-credit-card   nav-icon"></i>
                    <p>Visa</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                    <i class="fa fa-building nav-icon"></i>
                    <p>Deployment</p>
                    </a>
                </li> --}}
                        

                          
                        


                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                <i class="nav-icon fa fa-power-off"></i>
                                <p>
                                    Logout
                                </p>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
<!------------------------------ Admin End----------------------------------------->
@endif
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 399px;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('name')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @include('partials.alert')
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                
            </div>
            <!-- Default to the left -->
            <strong>Copyright 
               &copy; 2020-{{date("Y")}}
             <a href="http://goresources.ca/">Go team</a>.</strong> All rights reserved.
        </footer>
        <div id="sidebar-overlay"></div>
    </div>
    <!-- ./wrapper -->



<script src="{{asset('plugins/jquery/jquery.min.js')}}" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<!-- <script src="{{asset('plugins/jquery/jquery.min.js')}}" ></script>
 -->
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}" defer></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}" defer></script>
<!-- fullCalendar 2.2.5 -->
<script src="{{asset('plugins/moment/moment.min.js')}}" defer ></script>
<script src="{{asset('plugins/fullcalendar/main.js')}}" defer></script>


<!-- Page specific script -->

    </body>
    @yield('js')

</html>
