@extends('layouts.admin')

@section('content')

@foreach ($zones as $zone)
	<a href="/zone/edit/{{$zone->id}}">({{$zone->id}}) {{$zone->name}}</a><br>
@endforeach

<br>
<a href="/admin">Go back</a>
<br>

@endsection 