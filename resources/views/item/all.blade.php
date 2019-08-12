@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

@if ($items)
<table id="all-items">
	<thead>
		<th>ID</th>
		<th>Item Name</th>
		<th>Item Type</th>
	</thead>
	<tbody>
		@foreach ($items as $item)
		<tr>
			<td>{{$item->id}}</td>
			<td><a href="/item/edit/{{$item->id}}">{{$item->name}}</a></td>
			<td>{{$item->type()->name}}</a></td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>
$('#all-items').dataTable();
</script>
@endif

@endsection