@extends('layouts.dashboard')

@section('css')

@endsection
@section('content')
  <div class="back-link">
                                <a href="/devices/{{$device_id}}" class="btn btn-accent">Back to {{ $name }}</a>
                            </div>
     <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                              
                            </div>
                          History of activies in: {{ $name }}
                        </div>
                        <div class="panel-body">
                            <p>
                               {{ $name }} was regstered by  {{$creation_date->format('g:i:sA')}} {{"  on "}} {{ date('jS F Y',strtotime( $creation_date)) }}
                              
                            </p>
                            <div class="table-responsive">

                                <table id="tableExample3" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Device Name</th>
                                        <th>Action taken By</th>
                                        <th>Email</th>
                                        <th>Action taken on Port</th>
                                       
                                        <th>Action </th>

                                        <th>Source of Action</th>
                                        <th>Date & Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($histories as $history)

                                    <tr>
                                        <td>{{$name}}</td>
                                        @foreach($users as $user)
                                        @if($user->id == $history->user_id)
                                        <td>{{$user->username }}</td>
                                         <td>{{$user->email }}</td>
                                        @endif
                                        @endforeach 
                                        <?php 
                                        $stat = 0;
                                        ?>
                                        @foreach($ports as $port)
                                        @if($history->port_id == $port->id)
                                        <?php 
                                        $stat = 1;
                                        $portname = $port->port_name;
                                        ?>
                                        @endif
                                        @endforeach
                                        @if($stat == 1)
                                        <td>{{$portname }}</td>
                                        @else
                                        <td> device </td>
                                        @endif
                                        <td>{{ $history->action }}</td>
                                        <td>{{$history->source}}</td>
                                        <td>  {{$history->created_at->format('g:i:sA')}} {{"  on "}} {{ date('jS F Y',strtotime($history->created_at)) }}</td>
                                       
                                    </tr>
                                   @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>



            
@endsection

@section('script')
<script src="/homecss/vendor/pacejs/pace.min.js"></script>
<script src="/homecss/vendor/jquery/dist/jquery.min.js"></script>
<script src="/homecss/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/homecss/vendor/datatables/datatables.min.js"></script>

<!-- App scripts -->
<script src="/homecss/scripts/luna.js"></script>
@endsection