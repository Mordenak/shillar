<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Equipment Slot:</label>
	<div class="col-md-3">
		@if ($equip_slots->count() > 0)
		<select name="equipment_slot" class="form-control">
		@foreach ($equip_slots as $equip_slot)
			<option value="{{$equip_slot->id}}" {{isset($actual_item) && $actual_item->equipment_slot == $equip_slot->id ? 'selected' : ''}}>{{$equip_slot->name}}</option>
		@endforeach
		</select>
		@endif
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Strength:</label>
	<div class="col-md-3">
		<input type="text" name="strength_bonus" value="{{isset($actual_item) ? $actual_item->strength_bonus : ''}}" class="form-control">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Dexterity:</label>
	<div class="col-md-3">
		<input type="text" name="dexterity_bonus" value="{{isset($actual_item) ? $actual_item->dexterity_bonus : ''}}" class="form-control">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Constitution:</label>
	<div class="col-md-3">
		<input type="text" name="constitution_bonus" value="{{isset($actual_item) ? $actual_item->constitution_bonus : ''}}" class="form-control">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Wisdom:</label>
	<div class="col-md-3">
		<input type="text" name="wisdom_bonus" value="{{isset($actual_item) ? $actual_item->wisdom_bonus : ''}}" class="form-control">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Intelligence:</label>
	<div class="col-md-3">
		<input type="text" name="intelligence_bonus" value="{{isset($actual_item) ? $actual_item->intelligence_bonus : ''}}" class="form-control">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Charisma:</label>
	<div class="col-md-3">
		<input type="text" name="charisma_bonus" value="{{isset($actual_item) ? $actual_item->charisma_bonus : ''}}" class="form-control">
	</div>
</div>

@if ($actual_item)
<input type="hidden" name="actual_id" id="actual-db-id" value="{{$actual_item->id}}">
@endif
