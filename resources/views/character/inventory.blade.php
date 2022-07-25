@extends('layouts.admin')

@section('content')
<div>
	<form action="/character/save_inventory" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		

		@if (isset($character))

			
			@if (count($character->inventory()->character_items()) > 0)
			<h4>Inventory [Edit]</h4>
			@foreach ($character->inventory()->character_items() as $item)

			<div class="form-group row">
				<label class="col-md-2 col-form-label text-md-right">Name:</label>
				<div class="col-md-3">
					<input type="text" name="name" value="{{isset($character) ? $character->name : ''}}" class="form-control">
				</div>
			</div>

			@endforeach
			@endif

			@endif


		@if (isset($character))
		<input type="hidden" name="id" id="db-id" value="{{$character->id}}">
		@endif
	</form>
	<!-- TODO: See zone/edit.blade.php for comments on this component placement -->
	<x-admin-nav title="{{ isset($character) ? 'Editing Character Inventory' }}" baseroute="character" dbid="{{ isset($character) ? $character->id : 0}}"></x-admin-nav>
</div>
@endsection