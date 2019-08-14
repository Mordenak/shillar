@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Dashboard</div>

				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					You are logged in!

					<a href="/character/create">Create a character!</a>

					<br>
					<br>

					<form method="post" action="/game">
						{{csrf_field()}}
					@foreach ($characters as $character)
						<input type="submit" id="ch_{{$character->id}}" name="character_id" value="{{$character->id}}" style="display:none;">
						<label for="ch_{{$character->id}}">{{ $character->name }}</label>
						<br>
					@endforeach
					</form>

						@if (isset($admin_level) && $admin_level >= 1)
						<a href="/admin">Admin</a>
						@endif

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
