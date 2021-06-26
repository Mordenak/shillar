@extends('layouts.admin')

@section('content')

<div>
	<form action="/spell/save" method="POST" class="form-horizontal main-form">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-1 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($spell) ? $spell->name : ''}}" class="form-control" required>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-1 col-form-label text-md-right">Display Text:</label>
			<div class="col-md-3">
				<input type="text" name="display_text" value="{{isset($spell) ? $spell->display_text : ''}}" class="form-control" required>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-1 col-form-label text-md-right">Description:</label>
			<div class="col-md-6">
				<textarea class="form-control" name="description">{{isset($spell) ? $spell->description : ''}}</textarea>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-1 col-form-label text-md-right">Trained at Room:</label>
			<div class="col-md-1">
				<input type="text" name="base_training_value" value="{{isset($spell) ? $spell->base_training_value : ''}}" class="form-control" required>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-1 col-form-label text-md-right">Trained at Room:</label>
			<div class="col-md-1">
				<input type="text" name="rooms_id" value="{{isset($spell) ? $spell->rooms_id : ''}}" class="form-control auto-lookup room-lookup" required>
			</div>
		</div>


		<div class="form-group row">
			<label class="col-md-1 col-form-label text-md-right">Combat Casted:</label>
			<div class="col-md-1">
				<input type="checkbox" name="is_combat" class="form-control" {{isset($spell) ? $spell->is_combat ? 'checked' : '' : ''}}>
			</div>
		</div>


		@if (isset($spell))
		<input type="hidden" name="id" id="db-id" value="{{$spell->id}}">
		@endif

		<div style="margin-left:1rem;">
		<h3>Properties:</h3>
		<div class="spell-properties">
			<div class="properties-forms">
			@if (isset($spell) && $spell_properties->count() > 0)
				@foreach ($spell_properties as $prop)
				<input type="hidden" name="spell_properties[{{$prop->id}}][id]" value="{{$prop->id}}">
				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">Property:</label>
					<div class="col-md-2">
						<select class="form-control spell-property" name="spell_properties[{{$prop->id}}][spell_properties_id]" class="form-control">
							<option value="null">--None--</option>
							@foreach ($properties as $property)
							<option value="{{$property->id}}" {{$prop->property()->first()->id == $property->id ? 'selected' : ''}}>({{$property->id}}) {{$property->name}}</option>
							@endforeach
						</select>
					</div>
					<label class="col-md-0 col-form-label text-md-right">Target:</label>
					<div class="col-md-1">
						<select class="form-control" name="spell_properties[{{$prop->id}}][target]">
							<option value="self">Self</option>
							<option value="other" {{$prop->target_is_self ? '' : 'selected'}}>Other</option>
						</select>
					</div>
					<label class="col-md-0 col-form-label text-md-right">Data:</label>
					<div class="col-md-6">
						<input type="text" name="spell_properties[{{$prop->id}}][data]" value="{{$prop->data}}" class="form-control">
					</div>
				</div>
				@endforeach
			@endif
				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">Property:</label>
					<div class="col-md-2">
						<select class="form-control spell-property" name="spell_properties[0][spell_properties_id]" class="form-control">
							<option value="null">--None--</option>
							@foreach ($properties as $property)
							<option value="{{$property->id}}">({{$property->id}}) {{$property->name}}</option>
							@endforeach
						</select>
					</div>
					<label class="col-md-0 col-form-label text-md-right">Target:</label>
					<div class="col-md-1">
						<select class="form-control" name="spell_properties[0][target]">
							<option value="self">Self</option>
							<option value="other">Other</option>
						</select>
					</div>
					<label class="col-md-0 col-form-label text-md-right">Data:</label>
					<div class="col-md-6">
						<input type="text" name="spell_properties[0][data]" class="form-control">
					</div>
				</div>
			</div>
		</div>

		<br>
		<a class="fa fa-plus" onclick="addSpellProperty(this);">Add Property</a>
		<br><br>
		</div>

	</form>
</div>

<!-- This is where this should live: -->
<x-admin-nav title="{{ isset($spell) ? 'Editing a Spell' : 'Creating a Spell' }}" baseroute="spell" dbid="{{ isset($spell) ? $spell->id : 0}}"></x-admin-nav>

<!-- HAHAHAH HAVE FUN! -->
<script>
$('.spell-properties').on('change', 'select.spell-property', function(e) {
	$.ajax({
		url: '/spell_property/placeholder',
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

function addSpellProperty($btn)
	{
	var $tmp = $('.properties-forms > div').last().clone();
	// console.log($tmp.find('input').first().attr('name'));
	var matches = $tmp.find('input').first().attr('name').match(/spell_properties\[(\d*)\]/);
	
	var new_id = parseInt(matches[1]) + 1;

	$tmp.find('.form-control').each(function(i) {
		var name = $(this).attr('name').replace(/spell_properties\[\d*\]/, 'spell_properties['+new_id+']');
		$(this).attr('name', name);
		$(this).removeAttr('placeholder');
		});

	$('.properties-forms').append($tmp);
	$('.properties-forms').last().find('input[name="id"]').remove();
	}
</script>

@endsection