Inventory:
<br><br>
Current weight: {{$character->inventory()->current_weight()}} / {{$character->inventory()->max_weight()}}<br>
<br><br>
@foreach ($character->inventory()->character_items() as $item)
	@if (isset($is_admin) && $is_admin)
	[{{$item->id}}] 
	@endif

	@if (in_array($item->id, $character->equipment_list()))
	<span style="color:yellow">
	[Equipped] {{$item->item()->name}} (x{{$item->quantity}})<br>
	</span>
	@else
	{{$item->item()->name}} (x{{$item->quantity}})
	<form method="post" action="/item_drop" class="ajax" style="display: inline;">
		<label for="{{$item->id}}_drop">Drop</label>
		<input type="submit" id="{{$item->id}}_drop" style="display: none;">
		<input type="hidden" name="item_id" value="{{$item->items_id}}">
		<input type="hidden" name="character_id" value="{{$character->id}}">
	</form><br>
	@endif
@endforeach