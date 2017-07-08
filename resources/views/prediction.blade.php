@extends('layouts.header')
<style type="text/css">
	table tr th {text-align: center}
	table tr td {text-align: center;vertical-align: middle!important}
</style>
@section('content')
<!-- Container (Pricing Section) -->
<div id="pricing" class="container-fluid">
  <div class="text-center">
    <h2> Prediction </h2>
    <h4> Let System Predict your Quest </h4>
  </div>
  <div class="row ">
  	<?php 
  	$total_food = 0;
  	$total_food_prediction = 0;
  	?>
  	@foreach($data['is_come'] as $key=>$val)
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1> {{$val['is_come']}}</h1>
        </div>
        <div class="panel-body">
          <p><strong>{{$val['quest']}}</strong> Quest </p>
          <p><strong>{{$val['adult']}}</strong> Adult </p>
          <p><strong>{{$val['child']}}</strong> Child </p>
          <p><strong>{{$val['infant']}}</strong> Infant </p>
          <p><strong>{{$val['total']}}</strong>  Total </p>
        </div>
        <div class="panel-footer">
          <h3>
          	@if($val['is_come'] == "High")
          		{{$total_prediction = $val['total'] * 90/100}}
          	@elseif($val['is_come'] == "Medium")
          		{{$total_prediction = $val['total'] * 75/100}}
          	@elseif($val['is_come'] == "Low")
          		{{$total_prediction = $val['total'] * 50/100}}
          	@else
          		Undefined
          	@endif
          		<?php 
          		$total_food += $val['total'];
          		$total_food_prediction += $total_prediction;
          		?>
          </h3>
          <h4> PACKS </h4>
        </div>
      </div>      
    </div>     
    @endforeach

    <div class="clearfix"> </div>
    <div class="table-responsive">          
	  <table class="table table-bordered table-condensed">
	    <thead>
	      <tr class="info">
	        <th> Total Quest </th>
	        <th> Total Invitation </th>
	        <th> Total Food </th>
	        <th> Total Food Prediction </th>
	        <th> Detail </th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr>
	        <td>{{$data['total_quest']}}</td>
	        <td>{{$data['total_invitation']}}</td>
	        <td>{{$total_food}}</td>
	        <td>{{$total_food_prediction}}</td>
	        <td> Save Packs {{$total_food_prediction += ($total_food_prediction*10/100)}} </td>
	      </tr>
	    </tbody>
	  </table>
  	</div>
   
  </div> <!-- ROW -->
</div> <!--ID Pricing-->
@endsection 