<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Effect:</label>
	<div class="col-md-3">
		<input type="text" name="effect" value="{{isset($actual_item) ? $actual_item->effect : ''}}" class="form-control">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Potency:</label>
	<div class="col-md-3">
		<input type="text" name="potency" value="{{isset($actual_item) ? $actual_item->potency : ''}}" class="form-control">
	</div>
</div>

@if ($actual_item)
<input type="hidden" name="actual_id" id="actual-db-id" value="{{$actual_item->id}}">
@endif
