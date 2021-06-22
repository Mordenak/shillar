@extends('layouts.admin')

@section('content')
	
<div>
	<form action="/race/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($race) ? $race->name : ''}}" class="form-control">
			</div>
		</div>

		<div style="margin-left:1rem;">
			<h3>Stats</h3>
			<br>
			<div class="form-group row">
				<label class="col-md-1 offset-md-2 col-form-label text-md-center">Male Multiplier</label>
				<label class="col-md-1 col-form-label text-md-center">Female Multiplier</label>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label text-md-right">Strength:</label>
				<div class="col-md-1">
					<input type="text" name="starting_strength" value="{{isset($starting_stats) ? $starting_stats->strength : ''}}" class="form-control" placeholder="0-100">
				</div>
				<div class="col-md-1">
					<input type="text" name="strength_cost[1]" value="{{isset($male_costs) ? $male_costs->strength_cost : ''}}" class="form-control" placeholder="0-10">
				</div>
				<div class="col-md-1">
					<input type="text" name="strength_cost[2]" value="{{isset($female_costs) ? $female_costs->strength_cost : ''}}" class="form-control" placeholder="0-10">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label text-md-right">Dexterity:</label>
				<div class="col-md-1">
					<input type="text" name="starting_dexterity" value="{{isset($starting_stats) ? $starting_stats->dexterity : ''}}" class="form-control" placeholder="0-100">
				</div>
				<div class="col-md-1">
					<input type="text" name="dexterity_cost[1]" value="{{isset($male_costs) ? $male_costs->dexterity_cost : ''}}" class="form-control" placeholder="0-10">
				</div>
				<div class="col-md-1">
					<input type="text" name="dexterity_cost[2]" value="{{isset($female_costs) ? $female_costs->dexterity_cost : ''}}" class="form-control" placeholder="0-10">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label text-md-right">Constitution:</label>
				<div class="col-md-1">
					<input type="text" name="starting_constitution" value="{{isset($starting_stats) ? $starting_stats->constitution : ''}}" class="form-control" placeholder="0-100">
				</div>
				<div class="col-md-1">
					<input type="text" name="constitution_cost[1]" value="{{isset($male_costs) ? $male_costs->constitution_cost : ''}}" class="form-control" placeholder="0-10">
				</div>
				<div class="col-md-1">
					<input type="text" name="constitution_cost[2]" value="{{isset($female_costs) ? $female_costs->constitution_cost : ''}}" class="form-control" placeholder="0-10">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label text-md-right">Wisdom:</label>
				<div class="col-md-1">
					<input type="text" name="starting_wisdom" value="{{isset($starting_stats) ? $starting_stats->wisdom : ''}}" class="form-control" placeholder="0-100">
				</div>
				<div class="col-md-1">
					<input type="text" name="wisdom_cost[1]" value="{{isset($male_costs) ? $male_costs->wisdom_cost : ''}}" class="form-control" placeholder="0-10">
				</div>
				<div class="col-md-1">
					<input type="text" name="wisdom_cost[2]" value="{{isset($female_costs) ? $female_costs->wisdom_cost : ''}}" class="form-control" placeholder="0-10">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label text-md-right">Intelligence:</label>
				<div class="col-md-1">
					<input type="text" name="starting_intelligence" value="{{isset($starting_stats) ? $starting_stats->intelligence : ''}}" class="form-control" placeholder="0-100">
				</div>
				<div class="col-md-1">
					<input type="text" name="intelligence_cost[1]" value="{{isset($male_costs) ? $male_costs->intelligence_cost : ''}}" class="form-control" placeholder="0-10">
				</div>
				<div class="col-md-1">
					<input type="text" name="intelligence_cost[2]" value="{{isset($female_costs) ? $female_costs->intelligence_cost : ''}}" class="form-control" placeholder="0-10">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label text-md-right">Charisma:</label>
				<div class="col-md-1">
					<input type="text" name="starting_charisma" value="{{isset($starting_stats) ? $starting_stats->charisma : ''}}" class="form-control" placeholder="0-100">
				</div>
				<div class="col-md-1">
					<input type="text" name="charisma_cost[1]" value="{{isset($male_costs) ? $male_costs->charisma_cost : ''}}" class="form-control" placeholder="0-10">
				</div>
				<div class="col-md-1">
					<input type="text" name="charisma_cost[2]" value="{{isset($female_costs) ? $female_costs->charisma_cost : ''}}" class="form-control" placeholder="0-10">
				</div>
			</div>
		</div>

		<div style="margin-left:1rem;">
			<h3>Properties:</h3>
			<div class="racial-modifiers">
				<div class="modifiers-forms">
				@if (isset($race) && $modifiers->count() > 0)
					@foreach ($modifiers as $modifier)
					<input type="hidden" name="racial_modifiers[{{$modifier->id}}][id]" value="{{$modifier->id}}">
					<div class="form-group row">
						<label class="col-md-1 col-form-label text-md-right">Modifier:</label>
						<div class="col-md-2">
							<select class="form-control racial-modifier" name="racial_modifiers[{{$modifier->id}}][racial_modifiers_id]" class="form-control">
								<option value="null">--None--</option>
								@foreach ($racial_modifiers as $racial_modifier)
								<option value="{{$racial_modifier->id}}" {{$modifier->modifier()->first()->id == $racial_modifier->id ? 'selected' : ''}}>({{$racial_modifier->id}}) {{$racial_modifier->name}}</option>
								@endforeach
							</select>
						</div>
						<label class="col-md-1 col-form-label text-md-right">Value:</label>
						<div class="col-md-5">
							<input type="text" name="racial_modifiers[{{$modifier->id}}][value]" value="{{$modifier->value}}" class="form-control">
						</div>
					</div>
					@endforeach
				@endif
					<div class="form-group row">
						<label class="col-md-1 col-form-label text-md-right">Modifier:</label>
						<div class="col-md-2">
							<select class="form-control racial-modifier" name="racial_modifiers[0][racial_modifiers_id]" class="form-control">
								<option value="null">--None--</option>
								@foreach ($racial_modifiers as $racial_modifier)
								<option value="{{$racial_modifier->id}}">({{$racial_modifier->id}}) {{$racial_modifier->name}}</option>
								@endforeach
							</select>
						</div>
						<label class="col-md-1 col-form-label text-md-right">Value:</label>
						<div class="col-md-5">
							<input type="text" name="racial_modifiers[0][value]" class="form-control">
						</div>
					</div>
				</div>
			</div>

			<br>
			<a class="fa fa-plus" onclick="addRacialModifier(this);">Add Modifier</a>
			<br><br>
		</div>


		@if (isset($race))
		<input type="hidden" name="id" id="db-id" value="{{$race->id}}">
		@endif
	</form>
	<!-- TODO: See zone/edit.blade.php for comments on this component placement -->
	<x-admin-nav title="{{ isset($race) ? 'Editing a Race' : 'Creating a Race' }}" baseroute="race" dbid="{{ isset($race) ? $race->id : 0}}"></x-admin-nav>
</div>

<!-- HAHAHAH HAVE FUN! -->
<script>
$('.racial-modifiers').on('change', 'select.racial-modifier', function(e) {
	$.ajax({
		url: '/racial_modifier/placeholder',
		valueType: 'json',
		timeout: 5000,
		value: {
			id: $(e.target).val(),
			},
		success: function(resp) {
			$(e.target).closest('.form-group').find('input').first().attr('placeholder', JSON.stringify(resp));
			}
		});
	});

function addRacialModifier($btn)
	{
	var $tmp = $('.modifiers-forms > div').last().clone();
	// console.log($tmp.find('input').first().attr('name'));
	var matches = $tmp.find('input').first().attr('name').match(/racial_modifiers\[(\d*)\]/);
	
	var new_id = parseInt(matches[1]) + 1;

	$tmp.find('.form-control').each(function(i) {
		var name = $(this).attr('name').replace(/racial_modifiers\[\d*\]/, 'racial_modifiers['+new_id+']');
		$(this).attr('name', name);
		$(this).removeAttr('placeholder');
		});

	$('.modifiers-forms').append($tmp);
	$('.modifiers-forms').last().find('input[name="id"]').remove();
	}
</script>



@endsection