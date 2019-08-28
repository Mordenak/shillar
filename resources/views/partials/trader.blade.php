
This is a trader:<br>

<p>
{{$trader->description}}
</p>


@if( Session::has("receive") )
{{ Session::get("receive") }}
@endif

<form method="post" action="/trade/receive" class="ajax">
	<select name="item_received">
		<option value="null">-- Select --</option>
		@if (count($trader_items) > 0)
		@foreach ($trader_items as $item)
		@if ($trader->will_trade($item['type']))
		<option value="{{$item['id']}}">{{$item['label']}}</option>
		@endif
		@endforeach
		@endif
	</select>
	<input type="submit" value="Receive">
	<input type="hidden" name="trader_id" value="{{$trader->id}}">
	<input type="hidden" name="room_id" value="{{$room->id}}">
	<input type="hidden" name="character_id" value="{{$character->id}}">
	{{csrf_field()}}
</form>
<br>
<br>
@if( Session::has("send") )
{{ Session::get("send") }}
@endif
<br>
<form method="post" action="/trade/send" class="ajax">
	Send To:
	<input type="text" name="send_character">
	<select name="item_send">
		<option value="null">-- Select --</option>
	@foreach ($character->inventory()->character_items() as $char_item)
		@if ($trader->will_trade($char_item->item()->item_types_id))
		<option value="{{$char_item->id}}">{{$char_item->item()->name}}</option>
		@endif
	@endforeach
	</select>
	<input type="submit" value="Send">
	<input type="hidden" name="trader_id" value="{{$trader->id}}">
	<input type="hidden" name="room_id" value="{{$room->id}}">
	<input type="hidden" name="character_id" value="{{$character->id}}">
	{{csrf_field()}}
</form>