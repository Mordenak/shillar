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

		<div class="form-group row fixed-top" style="padding:.5rem;background-color:#555;border-bottom:2px solid white;">
			<div class="col-md-1">
				<a href="/admin" class="btn btn-info">Admin Home</a>
			</div>
			<div class="col-md-3 offset-md-1">
				<h3>
				@if (isset($teleport))
				Editing a TeleportTarget:
				@else
				Creating a TeleportTarget:
				@endif
				</h3>
			</div>
			<div class="col-md-1">
				<a href="/teleport/all" class="btn btn-secondary">Cancel</a>
			</div>
			<div class="col-md-1">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>

<br><br>
@if (isset($teleport))
<div class="col-md-1">
	<form method="post" action="/teleport/delete">
		{{csrf_field()}}
		<input type="hidden" name="id" value="{{$teleport->id}}">
		<input type="submit" value="Delete This TeleportTarget" class="btn btn-danger">
	</form>
</div>
@endif

@endsection