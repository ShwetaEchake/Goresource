<?php

use App\Models\Client;
// $assessment=DB::table('assessment')->count();
// $enrollment=DB::table('enrollment')->count();
// $interview=DB::table('interview')->count();
// $selection=DB::table('selection')->count();
// $offers=DB::table('offer_letter')->count();
// $medical=DB::table('pre_medical')->count();
// $qvc=DB::table('qvc_process')->count();
// $visa=DB::table('visa_process')->count();

if(auth()->user()->user_type == 'Client'){
// Dashboard Client
$Cli =DB::table('client')->where('user_id',auth()->user()->id)->first();
$EnquiryC=DB::table('enquiry')->where('client_id',$Cli->client_id)->first();

$EnquiryClient=DB::table('enquiry')->where('client_id',$Cli->client_id)->count();
$JobsClient=DB::table('jobs')->where('client_id',$Cli->client_id)->count();
$InterviewClient=DB::table('interview')->where('enquiry_id',$EnquiryC->enquiry_id)->count();
// Dashboard Client
}
else{

$assessment=DB::table('job_applied')->where('current_status','shortlist')->count();
$enrollment=DB::table('job_applied')->where('current_status','selected')->count();
$interview=DB::table('job_applied')->where('current_status','confirm')->count();
$selection=DB::table('job_applied')->where('current_status','selection')->count();
$offers=DB::table('job_applied')->where('current_status','offers')->count();
$medical=DB::table('job_applied')->where('current_status','pre_medical')->count();
$qvc=DB::table('job_applied')->where('current_status','qvc')->count();
$visa=DB::table('job_applied')->where('current_status','visa')->count();

 $Date = Date('Y-m-d');
 $expire= date('Y-m-d', strtotime($Date. ' + 30 days'));

// SELECT * 
// FROM visa_process
// WHERE date(from_unixtime(expiry_date,'%Y-%m-%d')) BETWEEN CURRENT_DATE()
//                    AND DATE_ADD(CURRENT_DATE(), INTERVAL 30 DAY)

$visaexpires=DB::table('visa_process')
->leftjoin('personal','personal.candidate_id','visa_process.candidate_id')
->whereBetween(DB::raw("date(from_unixtime(expiry_date,'%Y-%m-%d'))"), [$Date,$expire])
->paginate(10);


$interviews=DB::table('interview')->leftjoin('client','client.client_id','interview.client_id')->paginate(10);
$enquiries=DB::table('enquiry')->leftjoin('client','client.client_id','enquiry.client_id')->paginate(10);

$jobs=DB::table('jobs')
  ->leftjoin('client','client.client_id','jobs.client_id')
  ->leftjoin('categories','categories.category_id','jobs.job_main_category_id')
  ->orderBy('job_id','DESC')->take(10)->get();

}

?>
@section('css')

<style type="text/css">
  .graph_container{
  display:block;
  width:600px;
}
</style>
@endsection
@extends('layouts.admin')

@section('content')

   <!-- <a href="{{url('/invoice')}}" class="btn btn-flat btn-primary" title="INVOICE"><i class="fa fa-file-pdf-o"></i> Invoice</a> -->


@if(auth()->user()->user_type != 'Client')

     <section class="content">
      <div class="container-fluid">
       
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Assessment</span>
                <span class="info-box-number">{{$assessment}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Enrollment</span>
                <span class="info-box-number">{{$enrollment}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Interview</span>
                <span class="info-box-number">{{$interview}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Selection</span>
                <span class="info-box-number">{{$selection}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        <!-- second -->

         <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Offers</span>
                <span class="info-box-number">{{$offers}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Medical</span>
                <span class="info-box-number">{{$medical}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Qvc</span>
                <span class="info-box-number">{{$qvc}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Visa</span>
                <span class="info-box-number">{{$visa}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- second -->




      </div>
  </section>

<!-- Progress Bar Start-->
       <div class="card card-body">
          
               <div id="Chart1"></div>
         
       </div>
    
<!-- Progress Bar End-->




<div class="row"><!-- /.row start-->

<!-------------- Recent Jobs  Start------------------------------------>
    <div class="col-md-7">
        <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">Jobs Published</h3>
                </div>

                 <div class="card-body table-responsive p-0">
                  <table class="table">
                    <!-- <thead>
                      <tr>
                         <th nowrap=""> Job Id</th>
                         <th>Company Name</th>
                         <th>Job Title</th>
                      </tr>
                    </thead> -->
                    <tbody>
                        @foreach($jobs as $job)
                        <tr>
                          <!-- <td>{{ $job->job_id }}</td> -->
                         <!--  <td></td> -->
                          <td>{{ $job->category_name }}
                          <p style="font-size:15px; color: gray"> {{ $job->company_name }}<p>
                          </td>
                        <?php 
                          $countApplicants=DB::table('job_applied')->select('job_id')->where('job_id',$job->job_id)->count();

                           $today = date('Y-m-d');
                           $countNew=DB::table('job_applied')->select('job_id')
                             ->where('job_id',$job->job_id)
                             ->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d 00:00:00'))"), ">=", $today)
                             ->count();
                        ?>

                          <td> 
                             <span style="color:#249175;">{{($countApplicants)}}</span> Applicants<br>
                             <span style="color:#249175;">{{($countNew)}}</span>  New
                          </td>
                        <!--   <td>&#xFE19;</td> -->
                       </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>  
          </div><!-- /.card -->
    </div><!-- /.col -->
<!-------------- Recent Jobs  End------------------------------------>



<!------------------------- Enquiries Start------------------------------------>
    <div class="col-md-5">
        <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Enquiries</h3>

                    <div class="pagination pagination-sm float-right">
                     {!! $enquiries->onEachSide(1)->links()!!}
                   </div>

                </div>
                

                 <div class="card-body table-responsive p-0">
                  <table class="table table table-bordered  table-sm">
                    <thead>
                    <tr>
                       <th> Id</th>
                       <th>Company</th>
                       <th>Enquiry Title</th>
                       <th> Location</th>
                    </tr>
                    </thead>
                      <tbody>
                        @foreach($enquiries as $enquiry)
                          <tr>
                              <td>{{ $enquiry->enquiry_id }}</td>
                              <td> 
                                   {{$enquiry->company_name}}
                              </td>
                                  <td>{{ $enquiry->enquiry_title }}</td>
                              <td></td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
                </div>
         
          </div><!-- /.card -->
    </div><!-- /.col -->
<!--------------------- Enquiries End------------------------------------>





<!------------------------- Visa Expire Start------------------------------------>
    <div class="col-md-7">
        <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Visa Expire</h3>

                    <div class="pagination pagination-sm float-right">
                     {!! $visaexpires->onEachSide(1)->links()!!}
                   </div>

                </div>
                

                 <div class="card-body table-responsive p-0">
                  <table class="table table table-bordered  table-sm">
                    <thead>
                    <tr>
                       <th nowrap> Visa Id</th>
                       <th nowrap> Candidate Name </th>
                       <th > Issue Date </th>
                       <th > Expire Date</th>
                    </tr>
                    </thead>
                      <tbody>
                        @foreach($visaexpires as $visaexpire)
                          <tr>
                              <td>{{ $visaexpire->visa_id }}</td>
                              <td>{{ $visaexpire->name}} {{ $visaexpire->middle_name}} {{ $visaexpire->last_name}}</td>
                              <td nowrap> {{ date('d-m-Y',$visaexpire->issue_date)  }}</td>
                              <td nowrap style="color: red;"> {{ date('d-m-Y',$visaexpire->expiry_date) }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
                </div>
         
          </div><!-- /.card -->
    </div><!-- /.col -->
<!--------------------- Visa Expire End------------------------------------>

</div><!-- /.row end-->
          





     

   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
<!-------------------------------- EVENTS  Start------------------------------------->

          <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Interview Events</h3>
                 <!--  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div> -->

                   <div class="pagination pagination-sm float-right">
                     {!! $interviews->onEachSide(1)->links()!!}
                   </div>

                </div>
              <!-- /.card-header -->

              <div class="card-body table-responsive p-0">
                <table class="table table table-bordered  table-sm">
                  <thead>
                      <tr>
                        <th>Company </th>
                        <th> Date</th>
                        <th> Venu</th>
                        <th>Job Name</th>
                      </tr>
                  </thead>
                    <tbody>
                        @foreach($interviews as $interview)
                      <tr>
                           <td>
                                      {{$interview->company_name}}
                           </td>
                           <td nowrap="">{{ date('d-m-Y',$interview->interview_date) }}</td>
                           <td>{{ $interview->interview_venu }}</td>
                           <td>
                               <?php $job_name = DB::table('jobs')
                                                  ->leftjoin('categories','categories.category_id','=','jobs.job_main_category_id')
                                                  ->where('job_id',$interview->job_id)->first()?>
                                    @if(isset($job_name->category_name))
                                      {{$job_name->category_name}}
                                    @endif
                           </td>
                      </tr>
                        @endforeach
                  </tbody>
                </table><br>
                    
              </div><!-- /.card-body -->
            </div><!-- /.card -->
         </div><!-- /.col -->
<!------------------------------- EVENTS End ---------------------------------------->


          <div class="">
            <div class="sticky-top mb-3">
              <div class="card">
                <div class="card-header" style="display:none;" >
                  <h4 class="card-title">Draggable Events</h4>
                </div>
                <div class="card-body" style="display: none;">
                  <!-- the events -->
                  <div id="external-events">
                    <div class="external-event bg-success">Lunch</div>
                    <div class="external-event bg-warning">Go home</div>
                    <div class="external-event bg-info">Do homework</div>
                    <div class="external-event bg-primary">Work on UI design</div>
                    <div class="external-event bg-danger">Sleep tight</div>
                    <div class="checkbox">
                      <label for="drop-remove">
                        <input type="checkbox" id="drop-remove">
                        remove after drop
                      </label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            {{-- <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Create Event</h3>
                </div>
                <div class="card-body">
                  <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                    </ul>
                  </div>
                  <!-- /btn-group -->
                  <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                    <div class="input-group-append">
                      <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                    </div>
                    <!-- /btn-group -->
                  </div>
                  <!-- /input-group -->
                </div>
              </div>--}}
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  @endif
  



@if(auth()->user()->user_type == 'Client')
     <section class="content">
      <div class="container-fluid">
       
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Enquiry</span>
                <span class="info-box-number">{{$EnquiryClient}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Jobs</span>
                <span class="info-box-number">{{ $JobsClient }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Interview</span>
                <span class="info-box-number">{{$InterviewClient}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
        </div>
        <!-- /.row -->
</div>
</section>
 @endif




@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/apexcharts" defer></script>

  <script>
  $(function () {

    //------------------------  stack graph start--------------------------
var options = {
          series: [{
          name: 'Applied',
          data: [<?php echo $appliedCount; ?>]
        }, {
          name: 'Shortlist',
          data: [<?php echo $shortlistCount; ?>]
        }, {
          name: 'Selected',
          data: [<?php echo $selectedCount; ?>]
        }, {
          name: 'Confirm',
          data: [<?php echo $confirmCount; ?>]
        }, {
          name: 'Selection',
          data: [<?php echo $selectionCount; ?>]
        }, {
          name: 'Offers',
          data: [<?php echo $offersCount; ?>]
        }, {
          name: 'Medical fit',
          data: [<?php echo $medicalfitCount; ?>]
        }, {
          name: 'Qvc',
          data: [<?php echo $qvcCount; ?>]
        },{
          name: 'Visa',
          data: [<?php echo $visaCount; ?>]
        },
        {
          name: 'Deployment',
          data: [<?php echo $deploymentCount; ?>]
        }

        ],
          chart: {
          fontSize: '14px',
          fontFamily: 'Poppins',
          fontWeight: 400,
          type: 'bar',
          height: 350,
          stacked: true,
        },
        plotOptions: {
          bar: {
            horizontal: true,
          },
        },
        stroke: {
          width: 1,
          colors: ['#fff']
        },
        title: {
          text: 'Stack Graph'
        },
        xaxis: {
          categories: [

          <?php
           foreach($enQIdArray as $key => $EnqValue){
              echo "'".$EnqValue."', "; 
            }
          ?>

          ],
          labels: {
            formatter: function (val) {
              return val + ""
            }
          }
        },
        yaxis: {
          title: {
            text: undefined
          },
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + ""
            }
          }
        },
        fill: {
          opacity: 1
        },
        legend: {
          fontSize: '14px',
          fontFamily: 'Poppins',
          fontWeight: 400,
          position: 'top',
          horizontalAlign: 'left',
          offsetX: 40
        }
        };

        var chart = new ApexCharts(document.querySelector("#Chart1"), options);
        chart.render();
      
      
//------------------------  stack graph--------------------------


    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (https://fullcalendar.io/docs/event-object)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };
      }
    });

    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth'
      },
      themeSystem: 'bootstrap',
      //Random default events

      events:{!! json_encode($events) !!},
      
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      }
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      // Save color
      currColor = $(this).css('color')
      // Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      // Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      // Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.text(val)
      $('#external-events').prepend(event)

      // Add draggable funtionality
      ini_events(event)

      // Remove event from text input
      $('#new-event').val('')
    })
  })
</script>
    @endsection      
