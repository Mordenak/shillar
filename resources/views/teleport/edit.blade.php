@extends('layouts.admin')

@section('content')

<div>
	<form action="/teleport/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($teleport) ? $teleport->name : ''}}" class="form-control" required>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Room:</label>
			<div class="col-md-3">
				<input type="text" name="rooms_id" value="{{isset($teleport) ? $teleport->rooms_id : ''}}" class="form-control room-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">On Spell:</label>
			<div class="col-md-3">
				<input type="text" name="rooms_id" value="{{isset($teleport) ? $teleport->spells_id : '1'}}" class="form-control spell-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Level Req:</label>
			<div class="col-md-3">
				<input type="text" name="level_req" value="{{isset($teleport) ? $teleport->level_req : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Wisdom Req:</label>
			<div class="col-md-3">
				<input type="text" name="wisdom_req" value="{{isset($teleport) ? $teleport->wisdom_req : ''}}" class="form-control">
			</div>
		</div>

		@if (isset($teleport))
		<input type="hidden" name="id" id="db-id" value="{{$teleport->id}}">
		@endif
	</form>
	<!-- TODO: See zone/edit.blade.php for comments on this component placement -->
	<x-admin-nav title="{{ isset($teleport) ? 'Editing a Telepolrt Target' : 'Creating a Teleport Target' }}" baseroute="teleport" dbid="{{ isset($teleport) ? $teleport->id : 0}}"></x-admin-nav>
</div>

@endsection