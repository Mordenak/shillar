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
	
	@foreach ($character->spells() as $char_spell)
	<form method="post" id="training-form" action="/spells/train" class="ajax">
		{{$char_spell->spell()->name}}: Level {{$char_spell->level}} - {{$char_spell->level * ($char_spell->level * $char_spell->spell()->training_cost + 5000) - $char_spell->level}}
		<input type="hidden" name="cost" value="5000">
		<input type="submit" value="Train {{$char_spell->spell()->name}}"><br>
		<input type="hidden" name="spells_id" value="{{$char_spell->spell()->id}}">
		<input type="hidden" name="character_id" value="{{$character->id}}">
		{{csrf_field()}}
	</form>
	@endforeach
	<!-- Loop through spells: -->
	@foreach ($spells as $spell)
	@if ($character->spells() && in_array($spell->id, $character->spell_ids()))
	@else
	<form method="post" id="training-form" action="/spells/train" class="ajax">
		{{$spell->name}}: Level 0 - 5000
		<input type="hidden" name="cost" value="5000">
	
		<input type="submit" value="Train {{$spell->name}}"><br>
		<input type="hidden" name="spells_id" value="{{$spell->id}}">
		<input type="hidden" name="character_id" value="{{$character->id}}">
		{{csrf_field()}}
	</form>
	@endif
	@endforeach

		Nothing yet... Come back later.
	
@endif