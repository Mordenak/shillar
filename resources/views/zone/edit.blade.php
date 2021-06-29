@extends('layouts.admin')

@section('content')

<div>
	<form action="/zone/save" method="POST" class="form-horizontal main-form">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-1 col-form-label text-md-right">Name:</label>
			<div class="col-md-2">
				<input type="text" name="name" value="{{isset($zone) ? $zone->name : ''}}" class="form-control" required>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-1 col-form-label text-md-right">Travel Text:</label>
			<div class="col-md-6">
				<input type="text" name="travel_text" value="{{isset($zone) ? $zone->travel_text : ''}}" class="form-control" required>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-1 col-form-label text-md-right">Image:</label>
			<div class="col-md-2">
				<input type="text" name="img_src" value="{{isset($zone) ? $zone->img_src : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-1 col-form-label text-md-right">Background Image:</label>
			<div class="col-md-2">
				<input type="text" name="bg_img" value="{{isset($zone) ? $zone->bg_img : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-1 col-form-label text-md-right">Background Color:</label>
			<div class="col-md-1">
				<input type="text" name="bg_color" value="{{isset($zone) ? $zone->bg_color : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-1 col-form-label text-md-right">Text Color:</label>
			<div class="col-md-1">
				<input type="text" name="font_color" value="{{isset($zone) ? $zone->font_color : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-1 col-form-label text-md-right">Link Color [NYI]:</label>
			<div class="col-md-1">
				<input type="text" name="label_color" value="{{isset($zone) ? $zone->label_color : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-1 col-form-label text-md-right">Description:</label>
			<div class="col-md-6">
				<textarea class="form-control" name="description">{{isset($zone) ? $zone->description : ''}}</textarea>
			</div>
		</div>

		@if (isset($zone))
		<input type="hidden" name="id" id="db-id" value="{{$zone->id}}">
		@endif

		<div style="margin-left:1rem;">
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
		<br><br>
		</div>

		<div style="margin-left:1rem;">
		<h3>Levels:</h3>
		<div class="zone-levels">
			@if (isset($zone_levels))
			@foreach ($zone_levels as $level)
			{{$level->level}} :: <br>
			@endforeach
			@endif
		</div>
	</form>
	<!-- This somehow still joins the form above and everything still seems to work accordingly for some reason when it really shouldn't... Maybe the JS is responsible -->
	<!-- TODO: Keep an eye out for weird bugs here and be ready to enable the below marked snippet instead -->
	<!-- <x-admin-nav title="{{ isset($zone) ? 'Editing a Zone' : 'Creating a Zone' }}" baseroute="zone" dbid="{{ isset($zone) ? $zone->id : 0}}"></x-admin-nav> -->
</div>

<!-- This is where this should live: -->
<x-admin-nav title="{{ isset($zone) ? 'Editing a Zone' : 'Creating a Zone' }}" baseroute="zone" dbid="{{ isset($zone) ? $zone->id : 0}}"></x-admin-nav>

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
		$(this).removeAttr('placeholder');
		});

	$('.properties-forms').append($tmp);
	$('.properties-forms').last().find('input[name="id"]').remove();
	}
</script>

<div style="">
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
@elseif ($key == 'inherit_creatures')
'{{$key}}' => true,
@elseif ($key == 'inherit_properties')
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