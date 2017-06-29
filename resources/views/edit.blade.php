@extends('layouts.header')

@section('content')
	<div class="container-fluid">
		<h2 class="text-center">   Update Data </h2>
			<form class="form-inline" method="POST" action="{{ route('update') }}">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{$id}}">
			  	<div class="input-group">
			  		<span class="input-group-addon">
			  			<i class="glyphicon glyphicon-user">
			  			</i>
			  		</span>
				    <input type="text" name="quest" class="form-control" 
				    placeholder="Quest Name" required="required" value="{{$data['quest']->quest_name}}"> 
				</div>
				<div class="input-group">
				    <span class="input-group-addon">
				    	<i class="glyphicon glyphicon-tag">
			  			</i>
				    </span>
				    <select name="source" class="form-control" required="required">
				  		@foreach($data['source'] as $key=>$source)
				  		<option value="{{$source->source_id}}"
				  		@if($source->source_id == $data['quest']->source_id) 
				  		selected
				  		@endif
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
				    <select name="relation" class="form-control" required="required">
				    	@foreach($data['relation'] as $key=>$relation)
				  		<option value="{{$relation->relation_id}}"
				  		@if($relation->relation_id == $data['quest']->relation_id)
				  		selected
				  		@endif
				  		>  
				  			{{$relation->relation_name}}
				  		</option>
				  		@endforeach
				    </select>
		  		</div>
		  		<div class="input-group">
			  		<span class="input-group-addon">
			  			<i class="glyphicon glyphicon-usd">
			  			</i>
			  		</span>
				    <select name="prediction" class="form-control">
				    	<option value=""> Undefined Value </option>
				    	@for($i=1;$i<=20;$i++)
				    	<option value="{{$i*50000}}"
				    	@if($i*50000 == $data['quest']->prediction)
				    	selected
				    	@endif
				    	> 
				    		{{number_format($i*50000)}}
				    	</option>
				    	@endfor
				    </select>
				</div>
				<div class="input-group">
			  		<span class="input-group-addon">
			  			<i class="glyphicon glyphicon-star">
			  			</i>
			  		</span>
				    <select name="is_come" class="form-control">
				    	<option value="1"
				    	@if($data['quest']->is_come == 1 )
				    	selected
				    	@endif
				    	> 
				    		High 
				    	</option>
				    	<option value="2"
				    	@if($data['quest']->is_come == 2 )
				    	selected
				    	@endif
				    	> 
				    		Medium 
				    	</option>
				    	<option value="3"
				    	@if($data['quest']->is_come == 3 )
				    	selected
				    	@endif
				    	> 
				    		Low 
				    	</option>
				    </select>
				</div>
				<br>
		  		<br>
		  		<div class="input-group">
			  		<span class="input-group-addon"> 
			  			Adult :
			  		</span>
				    <input type="number" name="adult" class="form-control" min="1" max="5" value="{{$data['quest']->adult}}"> 
				</div>
				<div class="input-group">
			  		<span class="input-group-addon"> 
			  			Child :
			  		</span>
				    <input type="number" name="child" class="form-control" min="0" max="5" value="{{$data['quest']->child}}"> 
				</div>
				<div class="input-group">
			  		<span class="input-group-addon"> 
			  			Infant :
			  		</span>
				    <input type="number" name="infant" class="form-control" min="0" max="5" value="{{$data['quest']->infant}}">  
				</div>
				
				
		  		<div class="checkbox">
    				<label>
    				<input type="checkbox" name="invitation" 
    				@if($data['quest']->invitation == 1)
    				checked="checked"
    				@endif
    				> 
    				Invitation
    				</label>
  				</div>
  				<button type="submit" class="btn btn-primary">
  					Submit
  				</button>
			</form> 
	
	</div>
@endsection