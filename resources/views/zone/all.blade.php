@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

@foreach ($zones as $zone)
	<a href="/zone/edit/{{$zone->id}}">({{$zone->id}}) {{$zone->name}}</a><br>
@endforeach

@endsection 