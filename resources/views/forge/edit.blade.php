@extends('layouts.admin')

@section('content')

<div>
	<form action="/forge/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($forge) ? $forge->name : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Result:</label>
			<div class="col-md-3">
				<input type="text" name="result_items_id" value="{{isset($forge) ? $forge->result_items_id : ''}}" class="form-control item-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Armor:</label>
			<div class="col-md-3">
				<input type="text" name="item_armors_id" value="{{isset($forge) ? $forge->item_armors_id : ''}}" class="form-control item-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Jewel:</label>
			<div class="col-md-3">
				<input type="text" name="item_jewels_id" value="{{isset($forge) ? $forge->item_jewels_id : ''}}" class="form-control item-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Weapon:</label>
			<div class="col-md-3">
				<input type="text" name="item_weapons_id" value="{{isset($forge) ? $forge->item_weapons_id : ''}}" class="form-control item-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Dust:</label>
			<div class="col-md-3">
				<input type="text" name="item_dusts_id" value="{{isset($forge) ? $forge->item_dusts_id : ''}}" class="form-control item-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Food:</label>
			<div class="col-md-3">
				<input type="text" name="item_foods_id" value="{{isset($forge) ? $forge->item_foods_id : ''}}" class="form-control item-lookup">
			</div>
		</div>

		@if (isset($forge))
		<input type="hidden" name="id" id="db-id" value="{{$forge->id}}">
		@endif

		<!-- TODO: See zone/edit.blade.php for comments on this component placement -->
		<x-admin-nav title="{{ isset($forge) ? 'Editing a Forge Recipe' : 'Creating a Forge Recipe' }}" baseroute="forge" dbid="{{ isset($forge) ? $forge->id : 0}}"></x-admin-nav>
	</form>
</div>
@endsection