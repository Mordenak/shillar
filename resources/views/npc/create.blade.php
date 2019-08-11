@extends('layouts.admin')

@section('content')
Create a NPC:<br>

<form action="/npc/save" method="POST" class="form-horizontal">
	{{ csrf_field() }}
	
	Name: <input type="text" name="name"><br>
	<input type="submit" value="Create!">
</form>
@endsection