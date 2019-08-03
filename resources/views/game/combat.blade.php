begin combat!

<p>
@foreach ($combat_log as $log_entry)
	{{$log_entry}}<br>
@endforeach
</p>

end combat!


@if ($return_room)
	<form method="post" action="/game" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="room_id" value="{{$return_room}}">
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<label for="return_room">Return</label>
		<input type="submit" id="return_room" style="display: none;">
	</form>
@endif