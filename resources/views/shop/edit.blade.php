@extends('layouts.admin')

@section('content')

@if (isset($shop))
Editing a shop:
@else
Creating a shop:
@endif
	
<div>
	<form action="/shop/save" method="POST" class="form-horizontal ajax">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($shop) ? $shop->name : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Description:</label>
			<div class="col-md-3">
				<input type="text" name="description" value="{{isset($zone) ? $zone->description : ''}}" class="form-control">
			</div>
		</div>


		@if (isset($shop))
		<input type="hidden" name="id" id="db-id" value="{{$zone->id}}">
		@endif

		<div class="form-group row mb-0">
			<div class="col-md-1 offset-md-1">
				<a href="/shop/all" class="btn btn-primary">Cancel</a>
			</div>
			<div class="col-md-2 offset-md-2">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
@endsection