@extends('layouts.admin')

@section('content')
Creating an item:<br>

<form action="/item/save" method="POST" class="form-horizontal">
	{{ csrf_field() }}
	
	Name: <input type="text" name="name"><br>
	<input type="submit" value="Save!">
</form>
@endsection