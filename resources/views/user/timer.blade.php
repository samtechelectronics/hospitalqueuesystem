@extends('layouts.dashboard')
@section('css')

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  
    <link rel="stylesheet" href="/homecss/vendor/select2/dist/css/select2.min.css"/>
@endsection
@section('content')
 <!-- Main content-->

       <div class="back-link">
                                <a href="/devices/{{$key}}/" class="btn btn-accent">Back</a>
                            </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                                <a class="panel-close"><i class="fa fa-times"></i></a>
                            </div>
                            Schedule An Event on this Port
                              @if(session()->has('message'))
                                <h4 class="alert alert-success">{{session()->get('message')}}</h4>
                                @elseif(session()->has('error'))
                                <h4 class="alert alert-danger">{{session()->get('error')}}</h4>
                              @endif
                                        @if(count($errors)>0)
                                        <div class="alert alert-danger">
                                          @foreach($errors->all() as $error)
                                          <p>{{$error}}</p>
                                          @endforeach
                                        </div>

                        @endif
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-4">
                                    <p>
                                       Select starting time for the Schedule.
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                    <p>
                                        Select Stopping time for the Schedule.
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                    <p>
                                        
                                    </p>
                                </div>
                            </div>
                         <form method="post" action="/device/schedule"> 
                                 {{ csrf_field() }}
                          <input type="hidden" name="device_id" value="{{$device_id}}"> 
                          <input type="hidden" name="port_id" value="{{$port_id}}">
                            <div class="row">
                                <div class="col-lg-4">
                                    <input type="text" class="timepicker form-control" name="date1"  autocomplete="off">
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" class="timepicker form-control" name="date2" autocomplete="off">
                                   
                                </div>
                             
                                  <div class="font-example-box col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                    
                                    
                                    <button type="submit" ><a class="btn btn-warning" ><span class="pe-7s-alarm"></span> <span class="icon-example-name">ADD</span></a></button>

                                
                            </div>
                        </div>
                      </form>
                    </div>
                </div>
            </div>

            
        </div>
             <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                              
                            </div>
                        <a> Schedule History.</a>
                        </div>
                        <div class="panel-body">
                            <p>
                               History of all Schedules set by you on this port.
                            
                            </p>
                            <div class="table-responsive">

                                <table id="tableExample3" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        
                                        <th>Schedule By</th>
                                        <th>Device Name</th>
                                        <th>Port Name</th>
                                        <th>Schedule time ON</th>
                                        <th>Schedule time OFF</th>
                                        <th>Status of Schedule</th>
                                        <th>Remaining Time</th>
                                        <th>Creation Date</th>
                                        <th>Cancel Shedule</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($schedules as $schedule)

                                    <tr>
                                        <td>{{$schedule->user_name }}</td>
                                       
                                        <td>{{$schedule->device_name }}</td>
                                         <td>{{$schedule->port_name }}</td>
                                         <td>  {{$schedule->time_on->format('g:i:sA')}} {{"  on "}} {{ date('jS F Y',strtotime($schedule->time_on)) }}</td>
                                         <td>  {{$schedule->time_off->format('g:i:sA')}} {{"  on "}} {{ date('jS F Y',strtotime($schedule->time_off)) }}</td>
                                         <td>{{$schedule->status}}</td>
                                         <td>
                                           {{$schedule->time_left}}
                                         </td>
                                          <td>  {{$schedule->time_off->format('g:i:sA')}} {{"  on "}} {{ date('jS F Y',strtotime($schedule->time_off)) }}</td>

                                          <td>@if($schedule->status == 'cancelled' )
                                            <span class="alert alert-danger">Cancelled</span>
                                            @elseif( $schedule->status == 'completed')
                                             <span class="alert alert-success">Completed</span>
                                            @else
                                            <a href="/schedule/cancel/{{$schedule->id}}" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                                            @endif
                                          </td>
                                       
                                    </tr>
                                   @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
 
    <!-- End main content-->


<script type="text/javascript">

    $('.timepicker').datetimepicker({

        format: 'YYYY-MM-DD HH:mm:ss'

    }); 

</script> 
<!-- End wrapper-->

  @endsection
@section('script')


<script src="/homecss/vendor/pacejs/pace.min.js"></script>
<script src="/homecss/vendor/jquery/dist/jquery.min.js"></script>
<script src="/homecss/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/homecss/vendor/datatables/datatables.min.js"></script>

<!-- App scripts -->
<script src="/homecss/scripts/luna.js"></script>


<script>
    $(document).ready(function () {

        $('#tableExample1').DataTable({
            "dom": 't'
        });

        $('#tableExample2').DataTable({
            "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "lengthMenu": [ [6, 25, 50, -1], [6, 25, 50, "All"] ],
            "iDisplayLength": 6,
        });

        $('#tableExample3').DataTable({
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            buttons: [
                {extend: 'copy',className: 'btn-sm'},
                {extend: 'csv',title: 'device history', className: 'btn-sm'},
                {extend: 'pdf', title: 'device history', className: 'btn-sm'},
                {extend: 'print',className: 'btn-sm'}
            ]
        });

    });
</script>
<script src="/newcss/vendor/select2/dist/js/select2.js"></script>
@endsection


