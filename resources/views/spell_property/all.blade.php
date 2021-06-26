@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div class="dt-container">
	<div>
		<form method="get" action="/spell_property/create">
			<div class="form-group row">
				<div class="col-md-2">
					<input type="submit" value="Add Spell Property" class="form-control btn btn-success">
				</div>
			</div>
		</form>
	</div>
	@if ($spell_properties)
	<table id="all-records">
		<thead>
			<th>ID</th>
			<th>Spell Name</th>
		</thead>
		<tbody>
			@foreach ($spell_properties as $spell_property)
			<tr>
				<td>{{$spell_property->id}}</td>
				<td><a href="/spell_property/edit/{{$spell_property->id}}">{{$spell_property->name}}</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>	
	@endif
</div>
@endsection 