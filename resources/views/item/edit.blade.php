@extends('layouts.admin')

@section('content')

@if (isset($item))
Editing an item:
@else
Creating an item:
@endif
<br>

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

		<div class="form-group row fixed-top" style="padding:.5rem;background-color:#555;border-bottom:2px solid white;">
			<div class="col-md-1">
				<a href="/admin" class="btn btn-info">Admin Home</a>
			</div>
			<div class="col-md-3 offset-md-1">
				<h3>
				@if (isset($zone))
				Editing a Item:
				@else
				Creating a Item:
				@endif
				</h3>
			</div>
			<div class="col-md-1">
				<a href="/item/all" class="btn btn-secondary">Cancel</a>
			</div>
			<div class="col-md-1">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>

<br><br>
@if (isset($item))
<div class="col-md-1">
	<form method="post" action="/item/delete">
		{{csrf_field()}}
		<input type="hidden" name="id" value="{{$item->id}}">
		<input type="submit" value="Delete This Item" class="btn btn-danger">
	</form>
</div>
@endif

<script>
$('#type-select').on('change', function(e) {
	// when this type changes, we need to update item-type-fields:
	var type_id = $(e.target).val();
	$url = 'http://'+window.location.host+'/item/get_item_type?type_id='+type_id;

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
