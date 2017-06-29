@extends('layouts.header')

<style type="text/css">
	table tr th {text-align: center}
	table tr td {vertical-align: middle!important}
</style>
@section('content')
	
	<div class="container">
		@if(Session::has('delete'))
	        <div class="alert alert-danger" style="margin-top: 150px">
	            <a class="close" data-dismiss="alert">×</a>
	            <strong> {!!Session::get('delete')!!} </strong> 
	        </div>
	    @elseif(Session::has('update'))
	    	<div class="alert alert-info" style="margin-top: 150px">
	            <a class="close" data-dismiss="alert">×</a>
	            <strong> {!!Session::get('update')!!} </strong> 
	        </div>
	    @elseif(Session::has('add'))
	    	<div class="alert alert-success" style="margin-top: 150px">
	            <a class="close" data-dismiss="alert">×</a>
	            <strong> {!!Session::get('add')!!} </strong> 
	        </div>    
	    @endif
    </div>
    

	<div class="container-fluid">
		<h2 class="text-center"> Weeding Package List </h2> 

		<div class="pull-right">
			<a href="{{ route('add') }}" class="btn btn-primary">
          	<span class="glyphicon glyphicon-plus"></span> Add New Quest 
        	</a>
		</div>

  		 <form class="form-inline">
  		 	<div class="input-group">
			    <span class="input-group-addon">
			    	<i class="glyphicon glyphicon-tag">
		  			</i>
			    </span>
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
	  		<div class="input-group">
	  			<span class="input-group-addon">
	  				<i class="glyphicon glyphicon-book">
		  			</i>
	  			</span>
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
	  		<div class="input-group">
		  		<span class="input-group-addon">
		  			<i class="glyphicon glyphicon-star">
		  			</i>
		  		</span>
			    <select name="is_come" class="form-control">
			    	<option value="1"
			    	{{$filter['is_come'] == '1' ? 'selected' : ''}}
			    	> 
			    		High 
			    	</option>
			    	<option value="2"
			    	{{$filter['is_come'] == '2' ? 'selected' : ''}}
			    	> 
			    		Medium 
			    	</option>
			    	<option value="3"
			    	{{$filter['is_come'] == '3' ? 'selected' : ''}}
			    	> 
			    		Low 
			    	</option>
			    </select>
			</div>
	  		<div class="checkbox">
				<label>
				<input type="checkbox" name="invitation" value="1" 
				{{$filter['invitation'] == '1' ? 'checked' : ''}}
				> 
				Invitation
				</label>
  			</div>
  			<div class="checkbox">
				<label>
				<input type="checkbox" name="deleted" value="1"
				{{$filter['deleted'] == '1' ? 'checked' : ''}}
				> Deleted
				</label>
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
		        <th style="width: 1px"> </th>
		        <th> Person </th>
		        <th> Invitation </th>
		        <th> From </th>
		        <th> Relation </th>
		        <th> Prediction </th>
		        <th> Action </th>
		      	</tr>
		    </thead>
		    <tbody>
		    	@if($data['quest']->total() == 0)
		    	<tr>
		    		<td class="text-center" colspan="10">  No Quest Data </td>
		    	</tr> 
		    	@else
		    		@foreach($data['quest'] as $key=>$val)
		    		<tr class="text-center">
		    			<td class="vertical"> 
		    				@if($filter['page'])
		    					{{ ($filter['page']-1) * 20 + $key + 1 }}
		    				@else
		    					{{$key+1}}
		    				@endif
		    			</td>
		    			<td> {{ $val->quest_name }}</td>
		    			<td class="
		    			<?php
			    		switch($val->is_come) :
			    		case 1 	: echo "btn-primary";break;
			    		case 2 	: echo "btn-warning";break;
			    		case 3 	: echo "btn-danger";break;
			    		default : echo "btn-default";break;
			    		endswitch; 
			    		?>
			    		"> </td>
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
		    			<td class="">
		    				<a href="{{route('edit',['id'=>$val->quest_id])}}">
							  	<i class="glyphicon glyphicon-edit">
							  	</i>
							</a>
							&nbsp;/&nbsp;
							@if($filter['deleted'] == 1)
							<a href="{{route('delete',['id'=>$val->quest_id,'status'=>0])}}">
							  	<i class="glyphicon glyphicon-repeat">
							  	</i>
							</a>

							@else
							<a href="{{route('delete',['id'=>$val->quest_id,'status'=>1])}}">
							  	<i class="glyphicon glyphicon-remove">
							  	</i>
							</a>
							@endif
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