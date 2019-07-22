@extends('layouts.dashboard')
@section('content')


            <div class="row">

                <div class="col-md-6 col-md-offset-3" >
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                            <div class="panel-tools">
                           
                            </div>
                            Register Device
                        </div>
                           @if(session()->has('message'))
			                <h4 class="alert alert-warning">{{session()->get('message')}}</h4>
			              @endif
			                        @if(count($errors)>0)
			                        <div class="alert alert-danger">
			                          @foreach($errors->all() as $error)
			                          <p>{{$error}}</p>
			                          @endforeach
			                        </div>

			                        @endif
                        <div class="panel-body">

                            

                            <form method="post" action="/device">
                                <div class="form-group"><label for="exampleInputName">Device Name </label> <input type="text" class="form-control" id="exampleInputName" placeholder="Name" name="product_name"></div>
                                <div class="form-group"><label for="exampleInputEmail1">Device ID</label> <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Device ID" name="product_id"></div>
                                 {{csrf_field()}}
                                <button type="submit" class="btn btn-default">Send</button>
                            </form>
                        </div>
                    </div>

                </div>
</div>
@endsection