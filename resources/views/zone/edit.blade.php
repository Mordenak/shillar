@extends('layouts.admin')

@section('content')

@if (isset($zone))
Editing a zone:
@else
Creating a zone:
@endif
<br>
<div>
	<form action="/zone/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($zone) ? $zone->name : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Travel Text:</label>
			<div class="col-md-3">
				<input type="text" name="travel_text" value="{{isset($zone) ? $zone->travel_text : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Description:</label>
			<div class="col-md-3">
				<input type="text" name="description" value="{{isset($zone) ? $zone->description : ''}}" class="form-control">
			</div>
		</div>

		<h3>Properties:</h3>
		<div class="zone-properties">
			<div class="properties-forms">
			@if (isset($zone) && $zone_properties->count() > 0)
				@foreach ($zone_properties as $prop)
				<input type="hidden" name="zone_properties[{{$prop->id}}][id]" value="{{$prop->id}}">
				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">Property:</label>
					<div class="col-md-2">
						<select class="form-control zone-property" name="zone_properties[{{$prop->id}}][zone_properties_id]" class="form-control">
							<option value="null">--None--</option>
							@foreach ($properties as $property)
							<option value="{{$property->id}}" {{$prop->property()->first()->id == $property->id ? 'selected' : ''}}>({{$property->id}}) {{$property->name}}</option>
							@endforeach
						</select>
					</div>
					<label class="col-md-1 col-form-label text-md-right">Data:</label>
					<div class="col-md-5">
						<input type="text" name="zone_properties[{{$prop->id}}][data]" value="{{$prop->data}}" class="form-control">
					</div>
				</div>
				@endforeach
			@endif
				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">Property:</label>
					<div class="col-md-2">
						<select class="form-control zone-property" name="zone_properties[0][zone_properties_id]" class="form-control">
							<option value="null">--None--</option>
							@foreach ($properties as $property)
							<option value="{{$property->id}}">({{$property->id}}) {{$property->name}}</option>
							@endforeach
						</select>
					</div>
					<label class="col-md-1 col-form-label text-md-right">Data:</label>
					<div class="col-md-5">
						<input type="text" name="zone_properties[0][data]" class="form-control">
					</div>
				</div>
			</div>
		</div>

		<br>
		<a class="fa fa-plus" onclick="addZoneProperty(this);">Add Property</a>

		@if (isset($zone))
		<input type="hidden" name="id" id="db-id" value="{{$zone->id}}">
		@endif

		<div class="form-group row mb-0">
			<div class="col-md-1 offset-md-1">
				<a href="/zone/all" class="btn btn-primary">Cancel</a>
			</div>
			<div class="col-md-2 offset-md-2">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>

<!-- HAHAHAH HAVE FUN! -->
<script>
$('.zone-properties').on('change', 'select.zone-property', function(e) {
	$.ajax({
		url: '/zone_property/placeholder',
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

function addZoneProperty($btn)
	{
	var $tmp = $('.properties-forms > div').last().clone();
	// console.log($tmp.find('input').first().attr('name'));
	var matches = $tmp.find('input').first().attr('name').match(/zone_properties\[(\d*)\]/);
	
	var new_id = parseInt(matches[1]) + 1;

	$tmp.find('.form-control').each(function(i) {
		var name = $(this).attr('name').replace(/zone_properties\[\d*\]/, 'zone_properties['+new_id+']');
		$(this).attr('name', name);
		});

	$('.properties-forms').append($tmp);
	$('.properties-forms').last().find('input[name="id"]').remove();
	}
</script>

<div style="display:none;">
@if (isset($zone))
@foreach ($zone->rooms_q()->orderBy('id', 'asc')->get() as $room)
[
@foreach ($room->toArray() as $key => $value)

@if ($key != 'id')
@if ($value)
@if (is_numeric($value))
'{{$key}}' => {{$value}}, 
@else

@if ($key == 'created_at' || $key == 'updated_at')
'{{$key}}' => date("Y-m-d H:i:s"),
@else

@if ($key == 'spawns_enabled')
'{{$key}}' => true,
@else
'{{$key}}' => '{{$value}}', 
@endif
@endif

@endif

@else
'{{$key}}' => null, 
@endif
@endif

@endforeach
],<br>
@endforeach
@endif
</div>
@endsection