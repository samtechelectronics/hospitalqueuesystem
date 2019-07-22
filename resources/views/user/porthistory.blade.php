@extends('layouts.dashboard')

@section('css')

@endsection
@section('content')
   <div class="back-link">
                                <a href="/devices/{{$device_id}}/" class="btn btn-accent">Back to {{ $name }}</a>
                            </div>
     <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                              
                            </div>
                          History of activies On: <a>{{ $name }}</a> in <a >{{$device_name}}</a>
                        </div>
                        <div class="panel-body">
                            <p>
                               {{ $name }} was regstered by  {{$creation_date->format('g:i:sA')}} {{"  on "}} {{ date('jS F Y',strtotime( $creation_date)) }}
                            
                            </p>
                            <div class="table-responsive">

                                <table id="tableExample3" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Port Name</th>
                                        <th>Action taken By</th>
                                        <th>Email</th>
                                        
                                       
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
@endsection