
<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Type:</label>
	<div class="col-md-3">
		<select id="weapon-type-select" name="weapon_types_id" class="form-control">
			@if (!isset($actual_item))
			<option disabled selected>-- Select --</option>
			@endif
			@foreach ($weapon_types as $weapon_type)
			@if (isset($actual_item))
			<option value="{{$weapon_type->id}}" {{$weapon_type->id == $actual_item->weapon_types_id ? 'selected' : ''}}>{{$weapon_type->name}}</option>
			@else
			<option value="{{$weapon_type->id}}">{{$weapon_type->name}}</option>
			@endif
			@endforeach
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Attack Text:</label>
	<div class="col-md-3">
		<input type="text" name="attack_text" value="{{isset($actual_item) ? $actual_item->attack_text : ''}}" class="form-control">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Damage Low:</label>
	<div class="col-md-3">
		<input type="text" name="damage_low" value="{{isset($actual_item) ? $actual_item->damage_low : ''}}" class="form-control">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Damage High:</label>
	<div class="col-md-3">
		<input type="text" name="damage_high" value="{{isset($actual_item) ? $actual_item->damage_high : ''}}" class="form-control">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Fatigue Use:</label>
	<div class="col-md-3">
		<input type="text" name="fatigue_use" value="{{isset($actual_item) ? $actual_item->fatigue_use : ''}}" class="form-control">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Accuracy:</label>
	<div class="col-md-3">
		<input type="text" name="accuracy" value="{{isset($actual_item) ? $actual_item->accuracy : ''}}" class="form-control" placeholder="0.0 - 1.0">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Required Stat:</label>
	<div class="col-md-3">
		<input type="text" name="required_stat" value="{{isset($actual_item) ? $actual_item->required_stat : ''}}" class="form-control">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Required Amount:</label>
	<div class="col-md-3">
		<input type="text" name="required_amount" value="{{isset($actual_item) ? $actual_item->required_amount : ''}}" class="form-control">
	</div>
</div>

@if (isset($actual_item))
<input type="hidden" name="actual_id" id="actual-db-id" value="{{$actual_item->id}}">
@endif
