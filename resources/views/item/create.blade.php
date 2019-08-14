@extends('layouts.admin')

@section('content')
Creating an item:<br>

<div>
	<form action="/item/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Type:</label>
			<div class="col-md-3">
				<select name="item_types_id" class="form-control">
					@foreach ($item_types as $item_type)
					<option value="{{$item_type->id}}">{{$item_type->name}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="form-group row mb-0">
			<div class="col-md-1 offset-md-1">
				<a href="/item/all" class="btn btn-primary">Cancel</a>
			</div>
			<div class="col-md-2 offset-md-2">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
@endsection