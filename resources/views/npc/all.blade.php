@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

@foreach ($npcs as $npc)
	<a href="/npc/edit/{{$npc->id}}">({{$npc->id}}) {{$npc->name}}</a><br>
@endforeach

@endsection