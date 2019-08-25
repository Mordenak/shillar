@extends('layouts.admin')

@section('content')

<div>
	<form action="/admin/give_item" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col col-form-label text-md-right">Character:</label>
			<div class="col-md-2">
				<input type="text" name="characters_id" class="form-control">
			</div>
			<label class="col col-form-label text-md-right">Item:</label>
			<div class="col-md-2">
				<input type="text" name="items_id" class="form-control item-lookup">
			</div>
			<label class="col col-form-label text-md-right">Quantity?:</label>
			<div class="col-md-2">
				<input type="text" name="quantity" class="form-control">
			</div>
		</div>

		<div class="form-group row mb-0">
			<div class="col-md-1 offset-md-1">
				<a href="/item/all" class="btn btn-primary">Cancel</a>
			</div>
			<div class="col-md-2 offset-md-2">
				<input type="submit" value="Give" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>

@endsection
