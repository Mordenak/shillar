
This is a shop:<br>

<p>
{{$shop->description}}
</p>


@if( Session::has("purchase") )
{{ Session::get("purchase") }}
@endif

<form method="post" action="/shop/purchase" class="ajax">
	<select name="item_purchase">
		<option>-- Select --</option>
	@foreach ($shop->shop_items() as $shop_item)
		@if ($shop_item->price)
		<option value="{{$shop_item->id}}">{{$shop_item->item()->name}} ({{$shop_item->price / $character->charisma}})</option>
		@else
		<option value="{{$shop_item->id}}">{{$shop_item->item()->name}} ({{ ($shop_item->item()->value * $shop_item->markup) / $character->charisma }})</option>
		@endif
	@endforeach
	</select>
	<input type="submit" value="Buy">
	<input type="hidden" name="shop_id" value="{{$shop->id}}">
	<input type="hidden" name="room_id" value="{{$room->id}}">
	<input type="hidden" name="character_id" value="{{$character->id}}">
	{{csrf_field()}}
</form>