@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

@foreach ($rooms as $room)
	<a href="/room/edit/{{$room->id}}">({{$room->id}}) {{$room->title}}</a><br>
@endforeach

@endsection