@extends('layouts.admin')

@section('content')
Editing an item:<br>

<div>
	<form action="/item/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{$item->name}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Type:</label>
			<div class="col-md-3">
				<select id="type-select" name="item_types_id" class="form-control">
					@foreach ($item_types as $item_type)
					<option value="{{$item_type->id}}">{{$item_type->name}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div id="item-type-fields">
			<!-- This is where the custom fields go: -->
			{!! $item_fields !!}
		</div>

		<input type="hidden" name="id" value="{{$item->id}}">

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
	var val = $(e.target).val();

	$.ajax({
		type: 'GET',
		url: 'http://localhost:8000/item/get_item_type?id='+val,
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