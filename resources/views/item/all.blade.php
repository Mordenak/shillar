@extends('layouts.admin')

@section('content')

@foreach ($items as $item)
	<a href="/item/edit/{{$item->id}}">({{$item->id}}) {{$item->name}}</a><br>
@endforeach

<br>
<a href="/admin">Go back</a>
<br>

@endsection