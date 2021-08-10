
<p>
This is the Town Forge>
</p>


@if( Session::has("forged") )
{{ Session::get("forged") }}
@endif

<form method="post" action="/game/forge" class="ajax">
	Weapon:
	<select name="forge_weapon">
		<option>-- Select --</option>
	@foreach ($character->inventory()->character_items() as $char_item)
		@if ($char_item->item()->item_types_id == 1)
		<option value="{{$char_item->id}}">{{$char_item->item()->name}}</option>
		@endif
	@endforeach
	</select>
	Armor:
	<select name="forge_armor">
		<option>-- Select --</option>
	@foreach ($character->inventory()->character_items() as $char_item)
		@if ($char_item->item()->item_types_id == 2)
		<option value="{{$char_item->id}}">{{$char_item->item()->name}}</option>
		@endif
	@endforeach
	</select>
	Food:
	<select name="forge_food">
		<option>-- Select --</option>
	@foreach ($character->inventory()->character_items() as $char_item)
		@if ($char_item->item()->item_types_id == 4)
		<option value="{{$char_item->id}}">{{$char_item->item()->name}}</option>
		@endif
	@endforeach
	</select>
	Jewel:
	<select name="forge_jewel">
		<option>-- Select --</option>
	@foreach ($character->inventory()->character_items() as $char_item)
		@if ($char_item->item()->item_types_id == 5)
		<option value="{{$char_item->id}}">{{$char_item->item()->name}}</option>
		@endif
	@endforeach
	</select>
	Dust:
	<select name="forge_dust">
		<option>-- Select --</option>
	@foreach ($character->inventory()->character_items() as $char_item)
		@if ($char_item->item()->item_types_id == 6)
		<option value="{{$char_item->id}}">{{$char_item->item()->name}}</option>
		@endif
	@endforeach
	</select>
	<input type="submit" value="Forge">
	<input type="hidden" name="room_id" value="{{$room->id}}">
	<input type="hidden" name="character_id" value="{{$character->id}}">
	{{csrf_field()}}
</form>