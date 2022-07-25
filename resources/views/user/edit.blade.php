@extends('layouts.admin')

@section('content')

<br>
<div>
	<form action="/user/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{$user->name}}" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Email:</label>
			<div class="col-md-3">
				<input type="text" name="email" value="{{$user->email}}" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Admin Level:</label>
			<div class="col-md-1">
				<input type="text" name="admin_level" value="{{$user->admin_level}}" class="form-control">
			</div>
		</div>

		<div class="col-md-3">
			<h4>Characters linked:</h4>

			@if (isset($characters))
				@foreach ($characters as $character)
				<a href="/character/edit/{{$character->id}}">{{$character->name}}</a><br>
				@endforeach
			@endif
		</div>

		@if (isset($user))
		<input type="hidden" name="id" id="db-id" value="{{$user->id}}">
		@endif
	</form>
	<!-- TODO: See zone/edit.blade.php for comments on this component placement -->
	<x-admin-nav title="{{ isset($user) ? 'Editing a User' : 'Creating a User' }}" baseroute="user" dbid="{{ isset($user) ? $user->id : 0}}"></x-admin-nav>
</div>
@endsection