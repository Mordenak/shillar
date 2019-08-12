
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