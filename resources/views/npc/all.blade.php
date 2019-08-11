@extends('layouts.admin')

@section('content')

@foreach ($npcs as $npc)
	<a href="/npc/edit/{{$npc->id}}">({{$npc->id}}) {{$npc->name}}</a><br>
@endforeach

<br>
<a href="/admin">Go back</a>
<br>

@endsection