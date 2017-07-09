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
          <h1 onclick="ajax({{$val['n']}})"> {{$val['is_come']}}</h1>
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

<!-- Modal -->
  <div class="modal fade" id="detailModal" role="dialog" style="margin-top: 75px">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="panel" style="margin-bottom: 0px">
          <div class="panel-heading">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title text-center" id="">
                <span id="modal_title"> </span>
                Quest
              </h4>
          </div>
          <div class="panel-body">
            <div class="table-responsive ">          
          <table class="table table-condensed table-hover table-bordered table-striped">
            <thead>
              <tr>
                <th> No </th>
                <th> Quest Name </th>
                <th> Inv </th>
                <th> Source </th>
                <th> Relation </th>
                <th> A </th>
                <th> C </th>
                <th> I </th>
                <th> Prediction </th>
              </tr>
            </thead>
            <tbody id="tbody_ajax">
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
<script type="text/javascript">
  
  function ajax(id) {
    $("#detailModal").modal();
    $('#tbody_ajax').empty();
    $.ajax({
    type: "POST",
        url: "{{route('ajax')}}",
        data: {
          "_token": "{{ csrf_token() }}",
          "id": id,
          "type" : "get_ajax"
        },
      success: function (data) {
        $('#modal_title').html(data.quest_total);
        var tr = '';
        var number = 1;
        $.each( data.quest, function( key, value ) {
            tr += '<tr> ';
            tr += '<td> '+ number +' </td>';
            tr += '<td> '+ value.quest_name +' </td>';
            tr += '<td> '+ value.invitation +' </td>';
            tr += '<td> '+ value.source_name +' </td>';
            tr += '<td> '+ value.relation_name +' </td>';
            tr += '<td> '+ value.adult +' </td>';
            tr += '<td> '+ value.child +' </td>';
            tr += '<td> '+ value.infant +' </td>';
            tr += '<td> '+ value.prediction +' </td>';
            tr += '</tr>';
            number ++;
        });
        
        $('#tbody_ajax').append(tr);
      },
    });
  }

</script>
@endsection 