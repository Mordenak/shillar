@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div>
	<form method="get" action="/shop/create">
		<div class="form-group row">
			<div class="col-md-3">
				<input type="submit" value="Add Shop" class="btn btn-success">
			</div>
		</div>
	</form>
</div>

@if ($shops)
<table id="all-shops">
	<thead>
		<th>ID</th>
		<th>Shop Name</th>
	</thead>
	<tbody>
		@foreach ($shops as $shop)
		<tr>
			<td>{{$shop->id}}</td>
			<td><a href="/shop/edit/{{$shop->id}}">{{$shop->name}}</a></td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>
$('#all-shops').dataTable();
</script>
@endif

@endsection 