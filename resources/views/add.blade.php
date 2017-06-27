@extends('layouts.header')

@section('content')
	<div class="container-fluid">
		<h2 class="text-center">  Upload Data ( CSV ONLY )</h2>
			<form method="POST" action="{{ route('create') }}">
				{{ csrf_field() }}
			  	<div class="form-group">
				    <label for="source">From:</label>
				    <select name="source" class="form-control">
				    	<option value=""> Select </option>
				  		@foreach($data['source'] as $key=>$source)
				  		<option value="{{$source->source_id}}">  
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
				  		<option value="{{$relation->relation_id}}">  
				  			{{$relation->relation_name}}
				  		</option>
				  	@endforeach
				    </select>
		  		</div>
		  		<div class="checkbox">
    				<label>
    				<input type="checkbox" name="invitation" checked="checked"> Invitation
    				</label>
  				</div>
		  		<div class="form-group">
		  			<input type="file" name="csv">
		  		</div>
  				<button type="submit" class="btn btn-default">
  					Submit
  				</button>
			</form> 
	
	</div>
@endsection