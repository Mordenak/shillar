@extends('layouts.admin')

@section('content')

<div>
	<form action="/chat_room/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($chat_room) ? $chat_room->name : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Score Required:</label>
			<div class="col-md-3">
				<input type="text" name="score_req" value="{{isset($chat_room) ? $chat_room->score_req : ''}}" class="form-control">
			</div>
		</div>


		@if (isset($chat_room))
		<input type="hidden" name="id" id="db-id" value="{{$chat_room->id}}">
		@endif
	</form>
</div>

<!-- TODO: See zone/edit.blade.php for comments on this component placement -->
<x-admin-nav title="{{ isset($chat_room) ? 'Editing a Chat Room' : 'Creating a Chat Room' }}" baseroute="chat_room" dbid="{{ isset($chat_room) ? $chat_room->id : 0}}"></x-admin-nav>
@endsection