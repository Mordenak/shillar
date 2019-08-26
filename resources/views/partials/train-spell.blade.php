<style>
	.non-train
		{
		color: red;
		}

	#training-form input[name="submit"]
		{
		margin-bottom: .5rem;
		}
</style>

@if ($character)

	Current Exp: {{ $character->xp }}

	@if( Session::has("training") )
	<p>
	{{ Session::get("training") }}
	</p>
	@endif

	<br><br>
	<form method="post" id="training-form" action="/spells/train" class="ajax">

		<!-- Loop through spells: -->
		@foreach ($spells as $spell)
		Train {{$spell->name}}<br>
		@endforeach

		Nothing yet... Come back later.
		<input type="hidden" name="character_id" value="{{$character->id}}">
		{{csrf_field()}}
	</form>
	
@endif