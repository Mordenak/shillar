@extends('layouts.admin')

@section('content')

<div>
	<form action="/item/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($item) ? $item->name : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Value:</label>
			<div class="col-md-3">
				<input type="text" name="value" value="{{isset($item) ? $item->value : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Weight:</label>
			<div class="col-md-3">
				<input type="text" name="weight" value="{{isset($item) ? $item->weight : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Type:</label>
			<div class="col-md-3">
				<select id="type-select" name="item_types_id" class="form-control">
					@if (!isset($item))
					<option disabled selected>-- Select --</option>
					@endif
					@foreach ($item_types as $item_type)
					@if (isset($item))
					<option value="{{$item_type->id}}" {{$item_type->id == $item->item_types_id ? 'selected' : ''}}>{{$item_type->name}}</option>
					@else
					<option value="{{$item_type->id}}">{{$item_type->name}}</option>
					@endif
					@endforeach
				</select>
			</div>
		</div>

		<!-- This is where the custom fields go: -->
		<div id="item-type-fields">
			@if (isset($item_fields))
			{!! $item_fields !!}
			@endif
		</div>

		@if (isset($item))
		<input type="hidden" name="id" id="db-id" value="{{$item->id}}">
		@endif
	</form>
</div>

<x-admin-nav title="{{ isset($item) ? 'Editing a Item' : 'Creating a Item' }}" baseroute="item" dbid="{{ isset($item) ? $item->id : 0}}"></x-admin-nav>

<div class="usage-display" style="position: absolute;top: 4rem;left: 50%;">
	@if (isset($item))

	
	@if (count($dropped_by) > 0)
	<h4>This item is dropped by:</h4>
	@foreach ($dropped_by as $drop)
	<a href="/creature/edit/{{$drop->creatures_id}}">{{$drop->creature()->name}} ({{$drop->creatures_id}})</a><br>
	@endforeach
	@endif
	
	@if (count($sold_by) > 0)
	<h4>This item is sold by:</h4>
	@foreach ($sold_by as $sold)
	<a href="/shop/edit/{{$sold->shops_id}}">{{$sold->shop()->name}} ({{$sold->shops_id}})</a><br>
	@endforeach
	@endif

	@if (count($forged_by) > 0)
	<h4>This item is forged by:</h4>
	@foreach ($forged_by as $forge)
	<a href="/forge/edit/{{$forge->id}}">{{$forge->name}} ({{$forge->id}})</a><br>
	@endforeach
	@endif

	@if (count($forged_with) > 0)
	<h4>This item is used in forges:</h4>
	@foreach ($forged_with as $forged)
	<a href="/forge/edit/{{$forged->id}}">{{$forged->name}} ({{$forged->id}})</a><br>
	@endforeach
	@endif

	@endif
</div>

<script>
$('#type-select').on('change', function(e) {
	// when this type changes, we need to update item-type-fields:
	var type_id = $(e.target).val();
	$url = '/item/get_item_type?type_id='+type_id;

	var item_id = null;
	if ($('#db-id').length > 0)
		{
		item_id = $('#db-id').val();
		$url = $url + '&item_id='+item_id;
		}

	$.ajax({
		type: 'GET',
		url: $url,
		contentType: false,
		processData: false,
		success: function(resp) {
			// something
			$('#item-type-fields').html(resp);
			}
		});
	
	});
</script>
@endsection
