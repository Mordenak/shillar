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
	<label class="col-md-2 col-form-label text-md-right">Armor Rating:</label>
	<div class="col-md-3">
		<input type="text" name="armor" value="{{isset($actual_item) ? $actual_item->armor : ''}}" class="form-control">
	</div>
</div>