@extends('layouts.admin')

@section('content')
Editing an item:<br>

<form action="/item/save" method="POST" class="form-horizontal">
	{{ csrf_field() }}
	
	Name: <input type="text" name="name" value="{{$item->name}}"><br>
	<input type="hidden" name="id" value="{{$item->id}}">
	<input type="submit" value="Save!">
</form>
@endsection