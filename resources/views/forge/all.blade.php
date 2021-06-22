@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div>
	<form method="get" action="/forge/create">
		<div class="form-group row">
			<div class="col-md-3">
				<input type="submit" value="Add Forge Recipe" class="btn btn-success">
			</div>
		</div>
	</form>
</div>

@if ($forges)
<table id="all-records">
	<thead>
		<th>ID</th>
		<th>Recipe Name</th>
		<th>Resulting Item</th>
		<th>Armor</th>
		<th>Jewel</th>
		<th>Weapon</th>
		<th>Dust</th>
		<th>Food</th>
	</thead>
	<tbody>
		@foreach ($forges as $forge)
		<tr>
			<td>{{$forge->id}}</td>
			<td><a href="/forge/edit/{{$forge->id}}">{{$forge->name ?? '[No Name]'}}</a></td>
			<td>{{$forge->result_item()->name}}</td>
			<td>{{$forge->armor()->name}}</td>
			<td>{{$forge->jewel()->name}}</td>
			<td>{{$forge->weapon()->name}}</td>
			<td>{{$forge->dust()->name}}</td>
			<td>{{$forge->food()->name}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endif

@endsection