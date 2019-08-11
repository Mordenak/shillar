@extends('layouts.admin')

@section('content')
Editing a NPC:<br>

<form action="/npc/save" method="POST" class="form-horizontal">
	{{ csrf_field() }}
	
	Name: <input type="text" name="name" value="{{$npc->name}}"><br>
	<input type="hidden" name="id" value="{{$npc->id}}">
	<input type="submit" value="Save!">
</form>
@endsection