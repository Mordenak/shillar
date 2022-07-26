@extends('layouts.admin')

@section('content')

<div>
	<form action="/inventory_item/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Inventory ID:</label>
			<div class="col-md-3">
				<input type="text" name="inventory_id" value="{{isset($inventory_item) ? $inventory_item->inventory_id : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Item ID:</label>
			<div class="col-md-3">
				<input type="text" name="items_id" value="{{isset($inventory_item) ? $inventory_item->items_id : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Quantity:</label>
			<div class="col-md-3">
				<input type="text" name="quantity" value="{{isset($inventory_item) ? $inventory_item->quantity : ''}}" class="form-control">
			</div>
		</div>

		@if (isset($inventory_item))
		<input type="hidden" name="id" id="db-id" value="{{$inventory_item->id}}">
		@endif

		<div style="margin-left:1rem;">
		<h3>Properties:</h3>
		<div class="inventory_item-properties">
			<div class="properties-forms">
			@if (isset($inventory_item) && $inventory_item_properties->count() > 0)
				@foreach ($inventory_item_properties as $prop)
				<input type="hidden" name="item_properties[{{$prop->id}}][id]" value="{{$prop->id}}">
				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">Property:</label>
					<div class="col-md-2">
						<select class="form-control item-property" name="item_properties[{{$prop->id}}][item_properties_id]" class="form-control">
							<option value="null">--None--</option>
							@foreach ($properties as $property)
							<option value="{{$property->id}}" {{$prop->property()->first()->id == $property->id ? 'selected' : ''}}>({{$property->id}}) {{$property->name}}</option>
							@endforeach
						</select>
					</div>
					<label class="col-md-1 col-form-label text-md-right">Data:</label>
					<div class="col-md-5">
						<input type="text" name="item_properties[{{$prop->id}}][data]" value="{{$prop->data}}" class="form-control">
					</div>
				</div>
				@endforeach
			@endif
				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">Property:</label>
					<div class="col-md-2">
						<select class="form-control item-property" name="item_properties[0][item_properties_id]" class="form-control">
							<option value="null">--None--</option>
							@foreach ($properties as $property)
							<option value="{{$property->id}}">({{$property->id}}) {{$property->name}}</option>
							@endforeach
						</select>
					</div>
					<label class="col-md-1 col-form-label text-md-right">Data:</label>
					<div class="col-md-5">
						<input type="text" name="item_properties[0][data]" class="form-control">
					</div>
				</div>
			</div>
		</div>

		<br>
		<a class="fa fa-plus" onclick="addItemProperty(this);">Add Property</a>
		<br><br>
		</div>
	</form>
</div>

<x-admin-nav title="{{ isset($inventory_item) ? 'Editing a Inventory Item' : 'Creating a Iventnroy Item' }}" baseroute="inventory_item" dbid="{{ isset($inventory_item) ? $inventory_item->id : 0}}"></x-admin-nav>

<!-- HAHAHAH HAVE FUN! -->
<script>
$('.item-properties').on('change', 'select.item-property', function(e) {
	$.ajax({
		url: '/item_property/placeholder',
		dataType: 'json',
		timeout: 5000,
		data: {
			id: $(e.target).val(),
			},
		success: function(resp) {
			$(e.target).closest('.form-group').find('input').first().attr('placeholder', JSON.stringify(resp));
			}
		});
	});

function addItemProperty($btn)
	{
	var $tmp = $('.properties-forms > div').last().clone();
	// console.log($tmp.find('input').first().attr('name'));
	var matches = $tmp.find('input').first().attr('name').match(/item_properties\[(\d*)\]/);
	
	var new_id = parseInt(matches[1]) + 1;

	$tmp.find('.form-control').each(function(i) {
		var name = $(this).attr('name').replace(/item_properties\[\d*\]/, 'item_properties['+new_id+']');
		$(this).attr('name', name);
		$(this).removeAttr('placeholder');
		});

	$('.properties-forms').append($tmp);
	$('.properties-forms').last().find('input[name="id"]').remove();
	}
</script>

@endsection
