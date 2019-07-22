@extends('layouts.dashboard')
@section('css')

@endsection
@section('content')
<div class="">
 
    	<div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">PORT CONTROL UNIT</h3>
						
					</div>
					<hr>
					<div class="row">
						<?php 
						$device_id = 0;

						?>
						@foreach($ports as $port)
						<?php 
						$device_id = $port->product_id;

						?>

						@endforeach
						
						<div class="col-md-6 col-md-offset-3">
							<a class="btn btn-info" href="/devicehistory/{{$device_id}}">View Device Hisotry</a>
						</div>
						
					</div>
					<hr>
					<table class="table table-hover" id="dev-table">
						<thead>
							<tr>
								<th>#</th>
								<th>PORT Name</th>
								<th>Actions<td>
								
								
							</tr>
						</thead>
						<tbody>
						<?php $i=1; ?>
						@foreach($ports as $port)
							<tr>
								<td>{{$i}}</td>
								<?php $i=$i + 1; ?>
								<td>{{$port->port_name}}</td>
								<td>
									
									<a href="/port/edit/{{$port->id}}"><i class="fa fa-edit">edit name ....</i></a>
									
									<a href="/device/schedule/{{$port->product_id}}/{{$port->id}}"><i class="fa fa-clock-o" aria-hidden="true">schedule task ....</i></a><a href="/porthistory/{{$port->product_id}}/{{$port->id}}"><i class="fa fa-history" aria-hidden="true">history</i></a></td>
								<td>
								@if($port->state == '1')
								<a href="/control/{{$productid}}/{{$port->id}}" class="btn btn-danger">OFF</a>
								@else
								<a href="/control/{{$productid}}/{{$port->id}}" class="btn btn-success"> ON</a> 
								@endif
								@if($port->state == '1')
									<p>
								 <div class="radio radio-success">
                                    <input type="radio" id="singleRadio2{{$port->id}}" value="option2{{$port->id}}" name="radioSingle2{{$port->id}}" checked="" aria-label="Single radio Two">
                                    <label></label>
                                     </div>
								@else
							
								 <div class="radio radio-danger">
                                            <input type="radio" name="radio2{{$port->id}}" id="radio4{{$port->id}}" value="option2{{$port->id}}" checked="">
                                            <label for="radio4">
                                            </label>
                                        </div>

								@endif
								  @if($port->new_value == $port->previous_value)
                                        @else
                                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                                        <span class="sr-only">Loading...</span>
                                        @endif
                                        </p>
								</td>

							</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">MONITORING UNIT</h3>
						<div class="pull-right">
							<span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
								<i class="glyphicon glyphicon-filter"></i>
							</span>
						</div>
					</div>
					<div class="panel-body">
						<input type="text" class="form-control" id="task-table-filter" data-action="filter" data-filters="#task-table" placeholder="Filter Tasks" />
					</div>
					<table class="table table-hover" id="task-table">
						<thead>
							<tr>
								<th>#</th>
								<th>Terminal Name</th>
								<th><i class="fa fa-edit"></i></th>
								<th>Value</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Room temperature</td>
								<td><i class="fa fa-edit"></i></td>
								<td>25 *c</td>
							</tr>
						
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@endsection
@section('script')

@endsection