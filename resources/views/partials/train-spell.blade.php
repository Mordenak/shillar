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
	
	<!-- Loop through spells: -->
	@foreach ($spells as $spell)
	<form method="post" id="training-form" action="/spells/train" class="ajax">
		{{$spell->name}}: Level {{$character->has_spell($spell->id) ? $character->has_spell($spell->id)->level : 0}} -- {{$costs[$spell->id]}}
		<input type="hidden" name="cost" value="{{$costs[$spell->id]}}">
	
		<input type="submit" value="Train {{$spell->name}}"><br>
		<input type="hidden" name="spells_id" value="{{$spell->id}}">
		<input type="hidden" name="character_id" value="{{$character->id}}">
		{{csrf_field()}}
	</form>
	@endforeach

		Nothing yet... Come back later.
	
@endif