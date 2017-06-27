@extends('layouts.header')

<style type="text/css">
	table tr th {text-align: center}
</style>
@section('content')
	<div class="container-fluid">
		<h2 class="text-center"> Weeding Package List </h2> 

		<div class="pull-right">
			<a href="{{ route('add') }}" class="btn btn-primary">
          	<span class="glyphicon glyphicon-plus"></span> Add New Quest 
        	</a>
		</div>

  		 <form class="form-inline">
		  	<div class="form-group">
			    <label for="source">From:</label>
			    <select name="source" class="form-control">
			    	<option value=""> Select </option>
			  		@foreach($data['source'] as $key=>$source)
			  		<option value="{{$source->source_id}}"
			  		{{ $source->source_id == $filter['source'] ? 'selected' : '' }}
			  		>  
			  			{{$source->source_name}}
			  		</option>
			  		@endforeach
			    </select>
		  	</div>
		  	<div class="form-group">
			    <label for="source">Relation:</label>
			    <select name="relation" class="form-control">
			    	<option value=""> Select </option>
			    	@foreach($data['relation'] as $key=>$relation)
			  		<option value="{{$relation->relation_id}}"
			  		{{$relation->relation_id == $filter['relation'] ? 'selected' : ''}}
			  		>  
			  			{{$relation->relation_name}}
			  		</option>
			  	@endforeach
			    </select>
		  	</div>
		  	<br/>
		  <button type="submit" class="btn btn-primary" style="margin-top: 5px">
		  	Submit
		  </button>
		</form> 

		<div class="clearfix"> </div>

  		<div class="table-responsive">          
		  	<table class="table table-bordered table-condensed">
		    <thead>
		      	<tr class="text-center">
		        <th> No </th>
		        <th> Name </th>
		        <th> Person </th>
		        <th> Invitation </th>
		        <th> From </th>
		        <th> Relation </th>
		        <th> Prediction </th>
		        <th> Action </th>
		      	</tr>
		    </thead>
		    <tbody>
		    	@if($data['quest'] === null)
		    	<tr>
		    		<td class="text-center" colspan="10">  No Quest Data </td>
		    	</tr> 
		    	@else
		    		@foreach($data['quest'] as $key=>$val)
		    		<tr class="text-center">
		    			<td>
		    				@if($filter['page'])
		    					{{ ($filter['page']-1) * 20 + $key + 1 }}
		    				@else
		    					{{$key+1}}
		    				@endif
		    			</td>
		    			<td> {{ $val->quest_name }}</td>
		    			<td> 
		    				<?php 
		    				$child 		= $val->child * 80/100;
		    				$baby 		= $val->infant * 25/100;
		   					echo $val->adult + $child + $baby;
		    				?>
		    			</td>
		    			<td class="">
		    				<?php echo $val->invitation == 1 ? 'YES' : 'NO';?>

		    			</td>
		    			<td>
		    				{{ $val->source_name }}
		    			</td>
		    			<td>
		    				{{ $val->relation_name }}
		    			</td>
		    			<td>
		    				{{ number_format($val->prediction) }}
		    			</td>
		    			<td class="
		    			<?php
			    		switch($val->is_come) :
			    		case 1 	: echo "btn-primary";break;
			    		case 2 	: echo "btn-warning";break;
			    		case 3 	: echo "btn-danger";break;
			    		default : echo "btn-default";break;
			    		endswitch; 
			    		?>
		    			">
		    				Action
		    			</td>
		    		</tr>
		    		@endforeach
		    	@endif

		    </tbody>
		  	</table>
  		</div>
  		<div class="pull-right"> 
  		{{ $data['quest']->appends($filter)->links() }}
  		</div>
	</div>
@endsection