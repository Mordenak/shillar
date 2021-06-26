@extends('layouts.admin')

@section('content')

<div>
	<form action="/spell_property/save" method="POST" class="form-horizontal main-form">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($spell_property) ? $spell_property->name : ''}}" class="form-control" required>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Display Text:</label>
			<div class="col-md-3">
				<input type="text" name="format" value="{{isset($spell_property) ? $spell_property->format : ''}}" class="form-control" required>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Format:</label>
			<div class="col-md-6">
				<textarea class="form-control" name="description">{{isset($spell_property) ? $spell_property->description : ''}}</textarea>
			</div>
		</div>

		@if (isset($spell_property))
		<input type="hidden" name="id" id="db-id" value="{{$spell_property->id}}">
		@endif

	</form>
</div>

<!-- This is where this should live: -->
<x-admin-nav title="{{ isset($spell_property) ? 'Editing a Spell Property' : 'Creating a Spell Property' }}" baseroute="spell_property" dbid="{{ isset($spell_property) ? $spell_property->id : 0}}"></x-admin-nav>

@endsection