	@if ($chat)
	<div>
		<h3 style="display: inline-block;">{{$chat->name}}</h3>
		<form method="post" action="/footer" class="ajax" style="display: inline-block;">
			<label for="refresh-chat" class="fas fa-sync"> Refresh</label>
			<input type="submit" id="refresh-chat" value="Refresh" style="display:none;">
			<input type="hidden" name="characters_id" value="{{$character->id}}">
			{{csrf_field()}}
		</form><br>
		<table class="chat-room">
			@if ($chat->messages()->count() > 0)
			@foreach ($chat->messages() as $message)
			<tr>
				<td class="fit-width">{!! $message->character()->display_name() !!}</td>
				<td class="fit-width">{{$message->created_date()}} {{$message->created_time()}}</td>
				<td>{{$message->message}}</td>
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

	<!-- Debug section -->

	@if (auth()->user()->admin_level > 0)

		@if (isset($combat))
		{{$combat->id}} {{$combat->remaining_health}}
		@endif

		Current weight: {{$character->inventory()->current_weight()}} / {{$character->inventory()->max_weight()}}<br>

		@foreach ($character->inventory()->character_items() as $item)
			{{$item->id}}: {{$item->items_id}} -- {{$item->item()->name}}, {{$item->item()->item_types_id}} ({{$item->quantity}})<br>
		@endforeach
	@endif