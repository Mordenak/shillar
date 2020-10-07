Inventory:
<br><br>
Current weight: {{$character->inventory()->current_weight()}} / {{$character->inventory()->max_weight()}}<br>
<br><br>
@foreach ($character->inventory()->character_items() as $item)
	{{$item->item()->name}}, {{$item->item()->item_types_id}} ({{$item->quantity}})
	<form method="post" action="/item_drop" class="ajax" style="display: inline;">
		<label for="{{$item->id}}_drop">X Drop</label>
		<input type="submit" id="{{$item->id}}_drop" style="display: none;">
		<input type="hidden" name="item_id" value="{{$item->items_id}}">
		<input type="hidden" name="character_id" value="{{$character->id}}">
	</form><br>
@endforeach