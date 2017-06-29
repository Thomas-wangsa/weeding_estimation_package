@extends('layouts.header')

@section('content')
	<div class="container-fluid">
		<h2 class="text-center">   Added Data </h2>
			<form class="form-inline" method="POST" action="{{ route('create') }}">
				{{ csrf_field() }}
			  	<div class="input-group">
			  		<span class="input-group-addon">
			  			<i class="glyphicon glyphicon-user">
			  			</i>
			  		</span>
				    <input type="text" name="quest" class="form-control" 
				    placeholder="Quest Name" required="required"> 
				</div>
				<div class="input-group">
				    <span class="input-group-addon">
				    	<i class="glyphicon glyphicon-tag">
			  			</i>
				    </span>
				    <select name="source" class="form-control" required="required">
				  		@foreach($data['source'] as $key=>$source)
				  		<option value="{{$source->source_id}}">  
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
				  		<option value="{{$relation->relation_id}}">  
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
				    	<option value="{{$i*100000}}"> 
				    		{{number_format($i*100000)}}
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
				    	<option value="1"> 
				    		High 
				    	</option>
				    	<option value="2"> 
				    		Medium 
				    	</option>
				    	<option value="3"> 
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
				    <input type="number" name="adult" class="form-control" min="1" max="5" value="1"> 
				</div>
				<div class="input-group">
			  		<span class="input-group-addon"> 
			  			Child :
			  		</span>
				    <input type="number" name="child" class="form-control" min="0" max="5" value="0"> 
				</div>
				<div class="input-group">
			  		<span class="input-group-addon"> 
			  			Infant :
			  		</span>
				    <input type="number" name="infant" class="form-control" min="0" max="5" value="0">  
				</div>
				
				
		  		<div class="checkbox">
    				<label>
    				<input type="checkbox" name="invitation" checked="checked"> Invitation
    				</label>
  				</div>
  				<button type="submit" class="btn btn-primary">
  					Submit
  				</button>
			</form> 
	
	</div>
@endsection