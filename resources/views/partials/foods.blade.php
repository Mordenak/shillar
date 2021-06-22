<div class="form-group row">
	<label class="col-md-2 col-form-label text-md-right">Potency:</label>
	<div class="col-md-3">
		<input type="text" name="potency" value="{{isset($actual_item) ? $actual_item->potency : ''}}" class="form-control">
	</div>
</div>

@if (isset($actual_item))
<input type="hidden" name="actual_id" id="actual-db-id" value="{{$actual_item->id}}">
@endif
