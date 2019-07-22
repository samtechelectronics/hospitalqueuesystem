@extends('layouts.dashboard')
{{-- @section('content')

<div class="alert alert-warning" ><center> <h2>DEVICES</h2></center>

</div>
<div class="row">
     <div class="col-md-2 col-md-offset-5">
    
     
         <a href="/device" class="btn btn-info" >Add Device</a>
         
     
          
     </div>
        
</div>
 <hr>
     <div class="row">
        @foreach($devices as $device)
                <div class="col-md-3 ">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                           
                            <h3><a href="/devices/{{$device->id}}" style="text-decoration:none">{{$device->product_name}} </a>  <a href="/sharedevice/{{$device->product_id}}/2"><i class="badge pull-right alert-warning"> <i class="fa fa-share" aria-hidden="true"></i>SHARE </i></a></h3>
                           <span><a href="/device/edit/{{$device->id}}" class=" pull-right"><i>edit</i> </a></span>

                        </div>
                        <div class="panel-body alert " >

                            <div class="row">

                                <div class="col-lg-4">
                                
                                </div>
                                <div class="col-lg-4">
                                  
                                </div>
                                <div class="col-lg-4">
                                <a href="/devices/{{$device->id}}" class="btn btn-warning pull-right">view</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          
            @endforeach
            @foreach($knightshared as $knight)
                     <div class="col-md-3 ">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                           
                            <h3><a href="/devices/{{$knight->deviceid}}" style="text-decoration:none">{{$knight->product_name}}</a> <i class="badge pull-right alert-warning"> SHARED</i></h3>
                            <h4>Shared By {{$knight->sharedby}}</h4>
                            <h4>Level  <i class="badge  alert-warning">KNIGHT</i>  <a href="/sharedevice/{{$knight->device_id}}/1"><i class="badge pull-right alert-warning"> <i class="fa fa-share" aria-hidden="true"></i>SHARE </i></a></h4>
                        </div>
                        <div class="panel-body alert alert-info ">

                            <div class="row">

                                <div class="col-lg-4 ">
                                
                                </div>
                                <div class="col-lg-4">
                                  
                                </div>
                                <div class="col-lg-4">
                                <a href="/devices/{{$knight->deviceid}}" class="btn btn-success">view</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
              @foreach($pawnshared as $pawn)
                     <div class="col-md-3 ">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                           
                            <h3><a href="/devices/{{$pawn->deviceid}}" style="text-decoration:none">{{$pawn->product_name}}</a> <i class="badge pull-right alert-warning"> SHARED</i></h3>
                            <h4>Shared By {{$pawn->sharedby}}</h4>
                            <h4>Level  <i class="badge  alert-warning">Pawn</i></h4>
                        </div>
                        <div class="panel-body alert alert-warning ">

                            <div class="row">

                                <div class="col-lg-4 ">
                                
                                </div>
                                <div class="col-lg-4">
                                  
                                </div>
                                <div class="col-lg-4">
                                <a href="/devices/{{$pawn->deviceid}}" class="btn btn-success">view</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
             </div>  
                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <h4 class="modal-title">Edit Device</h4>
                                                <small>Lorem Ipsum is simply dummy text.</small>
                                            </div>
                                            <div class="modal-body">
                                                <form >
                                                    <input type="text" id="name" name="device_name" class="form-control" placeholder="Enter Name">
                                                    <input type="text"  id="device_id" name="device_name" class="form-control" placeholder="Enter Name">

                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-accent">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
@endsection
@section('script')
<script type="text/javascript">
 
    function setdetail(e){
      $('#name').val(name);
      $('#device_id').val(id);
    }



</script>
@endsection  --}}