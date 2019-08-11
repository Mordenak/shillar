@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

@foreach ($items as $item)
	<a href="/item/edit/{{$item->id}}">({{$item->id}}) {{$item->name}}</a><br>
@endforeach

@endsection