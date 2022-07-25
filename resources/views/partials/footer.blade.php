@if ($chat)
<div>
	<h3 style="display: inline-block;">{{$chat->name}}</h3>

	<form method="post" action="/change_chat_room" class="ajax" style="display: inline-block;">
		<select name="chatroom" onchange="$(this).closest('form').submit();">
			@foreach ($available_chatrooms as $chatroom)
			<option value="{{$chatroom->id}}" {{$chatroom->id == $character->settings()->selected_chat_rooms_id ? 'selected' : ''}} >{{$chatroom->name}}</option>
			@endforeach
		</select>
		<input type="hidden" name="characters_id" value="{{$character->id}}">
		{{csrf_field()}}
	</form>


	<form method="post" action="/footer" class="ajax" style="display: inline-block;">
		<label for="refresh-chat" class="fas fa-sync"> Refresh</label>
		<input type="submit" id="refresh-chat" value="Refresh" style="display:none;">
		<input type="hidden" name="chat_rooms_id" value="{{$chat->id}}">
		<input type="hidden" name="characters_id" value="{{$character->id}}">
		{{csrf_field()}}
	</form><br>

	<table class="chat-room">
		@if ($chat->messages()->count() > 0)
		@foreach ($chat->messages() as $message)
		<tr>
			<td class="fit-width">{!! $message->character()->display_name() !!}</td>
			<td class="fit-width">{{$message->created_date()}} {{$message->created_time()}}</td>
			<td>{!! $message->message !!}</td>
		</tr>
		@endforeach
		@else
		<h5>Looks like there are no messages here!</h5>
		@endif
	</table>
</div>
<form method="post" action="/chat/message" class="ajax">
	<input type="text" name="message" placeholder="Type a message here!">
	<input type="submit" value="Send">
	<input type="hidden" name="chat_rooms_id" value="{{$chat->id}}">
	<input type="hidden" name="characters_id" value="{{$character->id}}">
	{{csrf_field()}}
</form>
@endif