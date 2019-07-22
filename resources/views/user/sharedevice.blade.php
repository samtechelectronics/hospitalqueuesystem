@extends('layouts.dashboard')
@section('css')

   
    <link rel="stylesheet" href="/homecss/vendor/select2/dist/css/select2.min.css"/>
@endsection
@section('content')
 <!-- Main content-->

       <div class="back-link">
                                <a href="/dashboard/" class="btn btn-accent">Back</a>
                            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                                <a class="panel-close"><i class="fa fa-times"></i></a>
                            </div>
                            Share Device.
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
                                        Email of user to share device with!!!
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                    <p>
                                        Level of Share.
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                   
                                </div>
                            </div>

                            <div class="row">
                              <form action="/sharedevice" method="post" >
                                   {{ csrf_field() }}
                                  <input type="hidden" name="device_id" value="{{$device_id}}">
                                <div class="col-lg-4">
                                  <input type="email" name="email" placeholder="Enter Email"  class="select2_demo_2 form-control" >
                                </div>
                                <div class="col-lg-4">
                                    <select class="select2_demo_2 form-control" name="level"  style="width: 100%">
                                      
                                        @if($level == 2 )
                                        <option value="pawn">pawn</option>
                                        <option value="knight">knight</option>
                                      @else
                                      <option value="pawn">pawn</option>
                                      @endif
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                  <button type="submit" class="alert-warning">Share</button>
                                </div>
                                      </form>
                            </div>
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
                        <a>{{$device_name}} Share History.</a>
                        </div>
                        <div class="panel-body">
                            <p>
                               Device share history and status for every one connect to {{$device_name}}.
                            
                            </p>
                            <div class="table-responsive">

                                <table id="tableExample3" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        
                                        <th>Registered By</th>
                                        <th>Shared BY</th>
                                        <th>Shared To</th>
                                        <th>Status</th>
                                        <th>Level</th>
                                        <th>Share Date</th>
                                        <th>Action</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($shares as $share)

                                    <tr>
                                        <td>{{$share->owner_name }}</td>
                                       
                                        <td>{{$share->sharedby_name }}</td>
                                         <td>{{$share->sharedto_name }}</td>
                                         <td>{{$share->status }}</td>
                                         <td>{{$share->level }}</td>
                                   
                                
                                          <td>  {{$share->created_at->format('g:i:sA')}} {{"  on "}} {{ date('jS F Y',strtotime($share->created_at)) }}</td>
                                            <td>@if($share->status == 'active')
                                            <a href="/cancelshare/{{$share->id}}" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                                        
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
<script src="/homecss/vendor/select2/dist/js/select2.js"></script>
@endsection


