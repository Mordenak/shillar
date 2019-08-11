@extends('layouts.admin')

@section('content')

Creating a new zone:<br>

<form action="/zone/save" method="POST" class="form-horizontal">
	{{ csrf_field() }}
	Name: <input type="text" name="name">

	<input type="submit" value="Create!">
</form>

@endsection