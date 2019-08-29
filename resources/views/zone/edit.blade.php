@extends('layouts.admin')

@section('content')

@if (isset($zone))
Editing a zone:
@else
Creating a zone:
@endif
<br>
<div>
	<form action="/zone/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($zone) ? $zone->name : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Description:</label>
			<div class="col-md-3">
				<input type="text" name="description" value="{{isset($zone) ? $zone->description : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Darkness Level:</label>
			<div class="col-md-3">
				<input type="text" name="darkness_level" value="{{isset($zone) ? $zone->darkness_level : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Img Src:</label>
			<div class="col-md-3">
				<input type="text" name="img_src" value="{{isset($zone) ? $zone->img_src : ''}}" class="form-control">
			</div>
		</div>

		@if (isset($zone))
		<input type="hidden" name="id" id="db-id" value="{{$zone->id}}">
		@endif

		<div class="form-group row mb-0">
			<div class="col-md-1 offset-md-1">
				<a href="/zone/all" class="btn btn-primary">Cancel</a>
			</div>
			<div class="col-md-2 offset-md-2">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>

<!-- HAHAHAH HAVE FUN! -->

@foreach ($zone->rooms_q()->orderBy('id', 'asc')->get() as $room)
[
@foreach ($room->toArray() as $key => $value)

@if ($key != 'id')
@if ($value)
@if (is_numeric($value))
'{{$key}}' => {{$value}}, 
@else

@if ($key == 'created_at' || $key == 'updated_at')
'{{$key}}' => date("Y-m-d H:i:s"),
@else

@if ($key == 'spawns_enabled')
'{{$key}}' => true,
@else
'{{$key}}' => '{{$value}}', 
@endif
@endif

@endif

@else
'{{$key}}' => null, 
@endif
@endif

@endforeach
],<br>
@endforeach

@endsection