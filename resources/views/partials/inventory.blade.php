Inventory:
<br><br>
Current weight: {{$character->inventory()->current_weight()}} / {{$character->inventory()->max_weight()}}<br>
<br><br>
@foreach ($character->inventory()->character_items() as $item)
	{{$item->item()->name}}, {{$item->item()->item_types_id}} ({{$item->quantity}})<br>
@endforeach