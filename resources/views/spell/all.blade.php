@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div class="dt-container">
	<div>
		<form method="get" action="/spell/create">
			<div class="form-group row">
				<div class="col-md-2">
					<input type="submit" value="Add Spell" class="form-control btn btn-success">
				</div>
			</div>
		</form>
	</div>
	@if ($spells)
	<table id="all-records">
		<thead>
			<th>ID</th>
			<th>Spell Name</th>
		</thead>
		<tbody>
			@foreach ($spells as $spell)
			<tr>
				<td>{{$spell->id}}</td>
				<td><a href="/spell/edit/{{$spell->id}}">{{$spell->name}}</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>	
	@endif
</div>
@endsection 