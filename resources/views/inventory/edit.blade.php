@extends('layouts.admin')

@section('content')
<div>
	<form action="/inventory/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
			
		@if (count($inventory->character_items()) > 0)
		<h4 style="display:inline;">Inventory Items for <a href="/character/edit/{{$inventory->character_direct()->id}}">{{$inventory->character_direct()->name}}</a></h4> <a href="/inventory/edit/{{$inventory->id}}" class="fa fa-redo"> Refresh</a>
		<br><br>
		<div class="item-list">
			@foreach ($inventory->character_items() as $item)

			<div class="form-group row">
				<input type="hidden" name="inventory_items[{{$item->id}}][id]" value="{{$item->id}}">
				
				<label class="col-md-1 col-form-label text-md-right">Item:</label>
				<div class="col-md-1">
					<input type="text" name="inventory_items[{{$item->id}}][items_id]" value="{{isset($item) ? $item->items_id : ''}}" class="form-control auto-lookup item-lookup">
				</div>
				<label class="col-md-1 col-form-label text-md-right">Quantity:</label>
				<div class="col-md-1">
					<input type="text" name="inventory_items[{{$item->id}}][quantity]" value="{{isset($item) ? $item->quantity : ''}}" class="form-control">
				</div>
				<div class="col-md-2" style="margin-top: auto; margin-bottom: auto;">
					<a href="/inventory_item/edit/{{$item->id}}">[{{$item->id}}] Edit inventory item</a>
				</div>
			</div>

			@endforeach

			<div class="form-group row">
				<label class="col-md-1 col-form-label text-md-right">Item:</label>
				<div class="col-md-1">
					<input type="text" name="inventory_items[0][items_id]" value="" class="form-control auto-lookup item-lookup">
				</div>
				<label class="col-md-1 col-form-label text-md-right">Quantity:</label>
				<div class="col-md-1">
					<input type="text" name="inventory_items[0][quantity]" value="" class="form-control">
				</div>
			</div>

		</div>
		@endif

		<a class="fa fa-plus" onclick="addItem(this);">Add Item</a>


		@if (isset($inventory))
		<input type="hidden" name="id" id="db-id" value="{{$inventory->id}}">
		@endif
	</form>
	<!-- TODO: See zone/edit.blade.php for comments on this component placement -->
	<x-admin-nav title="Editing Character Inventory" baseroute="inventory" dbid="{{ isset($inventory) ? $inventory->id : 0}}"></x-admin-nav>
</div>
@endsection


<!-- HAHAHAH HAVE FUN! -->
<script>

function addItem($btn)
	{
	var $tmp = $('.item-list > div').last().clone();
	// console.log($tmp.find('input').first().attr('name'));
	var matches = $tmp.find('input').first().attr('name').match(/inventory_items\[(\d*)\]/);
	
	var new_id = parseInt(matches[1]) + 1;

	$tmp.find('.form-control').each(function(i) {
		var name = $(this).attr('name').replace(/inventory_items\[\d*\]/, 'inventory_items['+new_id+']');
		$(this).attr('name', name);
		$(this).removeAttr('placeholder');
		});

	$('.item-list').append($tmp);
	$('.item-list').last().find('input[name="id"]').remove();
	}
</script>