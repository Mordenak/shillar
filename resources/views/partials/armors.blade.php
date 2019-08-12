<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Equipment Slot:</label>
	<div class="col-md-3">
		<input type="text" name="effect" value="{{isset($actual_item) ? $actual_item->equipment_slot : ''}}" class="form-control">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Armor Rating:</label>
	<div class="col-md-3">
		<input type="text" name="potency" value="{{isset($actual_item) ? $actual_item->armor : ''}}" class="form-control">
	</div>
</div>