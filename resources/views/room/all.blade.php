@extends('layouts.admin')

@section('content')

@foreach ($rooms as $room)
	<a href="/room/edit/{{$room->id}}">({{$room->id}}) {{$room->title}}</a><br>
@endforeach

<br>
<a href="/admin">Go back</a>
<br>

@endsection