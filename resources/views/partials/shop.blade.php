
<p>
{{$shop->description}}
</p>

@if( Session::has("purchase") )
{{ Session::get("purchase") }}
@endif

<form method="post" action="/shop/purchase" class="ajax">
	<select name="item_purchase">
		<!--<option value="0">-- Select --</option>-->
	@foreach ($shop->shop_items() as $shop_item)
		<option value="{{$shop_item->id}}">{{$shop_item->item()->name}} ({{ $shop_item->get_cost($character->charisma) }})</option>
	@endforeach
	</select>
	@if ($shop->show_quantity_buy)
	<input type="text" name="quantity" size="3" value="1">
	@endif
	<input type="submit" value="Buy">
	<input type="hidden" name="shop_id" value="{{$shop->id}}">
	<input type="hidden" name="room_id" value="{{$room->id}}">
	<input type="hidden" name="character_id" value="{{$character->id}}">
	{{csrf_field()}}
</form>
<br>
<br>
@if( Session::has("sell") )
{{ Session::get("sell") }}
@endif
<br>
<form method="post" action="/shop/sell" class="ajax">
	<select name="item_sell">
		<!--<option value="0">-- Select --</option>-->
	@foreach ($character->inventory()->unequipped_items() as $char_item)
		@if ($shop->will_buy($char_item->item()->item_types_id))
		<option value="{{$char_item->id}}">{{$char_item->item()->name}} ()</option>
		@endif
	@endforeach
	</select>
	<input type="submit" value="Sell">
	<input type="hidden" name="shop_id" value="{{$shop->id}}">
	<input type="hidden" name="room_id" value="{{$room->id}}">
	<input type="hidden" name="character_id" value="{{$character->id}}">
	{{csrf_field()}}
</form>