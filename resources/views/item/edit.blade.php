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

		<div class="form-group row mb-0">
			<div class="col-md-2 offset-md-4">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>

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
