@extends('layouts.admin')

@section('content')
Create a NPC:<br>

<form action="/npc/save" method="POST" class="form-horizontal">
	{{ csrf_field() }}
	
	Name: <input type="text" name="name"><br>
	Img Src: <input type="text" name="img_src"><br>
	<input type="submit" value="Create!">
</form>
@endsection