@extends('layouts.header')

@section('content')
<style type="text/css">
	table tr th {text-align: center}
	table tr td {vertical-align: middle!important}
</style>
<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center">
  <h2> Total Cost Rp. {{ number_format($data['total_cost'])}} </h2>
  <h4> Detail Cost </h4>
  <br>

  	@foreach($data['detail'] as $key=>$val)
  	<div class="col-sm-4">
  		@if($key == 0)
  			<span class="glyphicon glyphicon-home logo-small" 
  			onclick="detail({{$val->estimation_id}})"></span>
	      	<h4>PACKAGE</h4>
	      	<p> Wedding Package</p>
  		@endif
  		@if($key == 1)
  			<span class="glyphicon glyphicon-heart logo-small"
  			onclick="detail({{$val->estimation_id}})"></span>
	      	<h4>Bridal</h4>
	      	<p>Bridall Add On </p>
  		@endif
  		@if($key == 2)
  			<span class="glyphicon glyphicon-plus logo-small"
  			onclick="detail({{$val->estimation_id}})"></span>
      		<h4> Food </h4>
      		<p> Food Add On </p>
      		<br> <br>
  		@endif
  		@if($key == 3)
  			<span class="glyphicon glyphicon-shopping-cart logo-small"
  			onclick="detail({{$val->estimation_id}})"></span>
      		<h4>Exclude </h4>
      		<p> Exclude Add On</p>
  		@endif
  		@if($key == 4)
      		<span class="glyphicon glyphicon-user logo-small"
      		onclick="detail({{$val->estimation_id}})"></span>
		    <h4>Event </h4>
		    <p>Event Budget </p>
  		@endif
  		@if($key == 5)
  			<span class="glyphicon glyphicon-thumbs-up logo-small"
  			onclick="detail({{$val->estimation_id}})"></span>
      		<h4 style="color:#303030;">Other</h4>
      		<p>Cost & Etc </p>
  		@endif
      
    </div>
  	@endforeach

</div>


<!-- Modal -->
  <div class="modal fade" id="detailModal" role="dialog" style="margin-top: 75px">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
      	<div class="panel" style="margin-bottom: 0px">
	      	<div class="panel-heading">
	      		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4 class="modal-title text-center" id="modal-title">
          			-
          		</h4>
	      	</div>
	      	<div class="panel-body">
	      		<div class="table-responsive ">          
				  <table class="table table-condensed table-hover table-bordered table-striped">
				    <thead>
				      <tr>
				        <th> No </th>
				        <th> Prediction </th>
				        <th> Paid </th>
				        <th> Detail </th>
				      </tr>
				    </thead>
				    <tbody>
				    </tbody>
				  </table>
				</div>
	      	</div>
	      	<div class="panel-footer">
	      		<button type="button" class="btn btn-warning pull-right" 
	      		data-dismiss="modal">
	      			Close
	      		</button>
	      		<div class="clearfix"/>
	      	</div>
    	</div>
      </div>
      
    </div>
  </div>

<script>
$(document).ready(function(){
    
});

function detail(id) {
	$("#detailModal").modal();
	$.ajax({
		type: "POST",
        url: "{{route('detail')}}",
        data: {
        	"_token": "{{ csrf_token() }}",
        	"id": id,
        	"type" : "get_detail"
        }
	});
		 
}
</script>

@endsection