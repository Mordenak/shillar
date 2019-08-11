@extends('layouts.admin')

@section('content')
Editing a zone:<br>


<form action="/zone/save" method="POST" class="form-horizontal">
	{{ csrf_field() }}
	Name: <input type="text" name="name" value="{{$zone->name}}"><br>
	<input type="hidden" name="id" value="{{$zone->id}}">
	<input type="submit" value="Save!">
</form>
@endsection