@extends('layouts.admin')

@section('content')

@if (isset($user))
Editing a User:
@endif
<br>
<div>
	<form action="/user/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Admin Level:</label>
			<div class="col-md-3">
				<input type="text" name="admin_level" value="{{$user->admin_level}}" class="form-control">
			</div>
		</div>

		@if (isset($user))
		<input type="hidden" name="id" id="db-id" value="{{$user->id}}">
		@endif

		<div class="form-group row mb-0">
			<div class="col-md-1 offset-md-1">
				<a href="/user/all" class="btn btn-primary">Cancel</a>
			</div>
			<div class="col-md-2 offset-md-2">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>

@if (isset($user))
<form method="post" action="/user/delete">
	{{csrf_field()}}
	<input type="hidden" name="id" value="{{$user->id}}">
	<input type="submit" value="Delete" class="btn btn-danger">
</form>
@endif
@endsection