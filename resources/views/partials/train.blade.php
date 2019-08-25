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

	XP: {{ $character->xp }}

	<form method="post" id="training-form" action="/train" class="ajax">
		<br>
		<input type="radio" name="train_multi" value="1" {{ $multi == 1 ? 'checked' : '' }}>1
		<input type="radio" name="train_multi" value="10" {{ $multi == 10 ? 'checked' : '' }}>10
		<input type="radio" name="train_multi" value="100" {{ $multi == 100 ? 'checked' : '' }}>100
		<input type="radio" name="train_multi" value="all" {{ $multi == "all" ? 'checked' : '' }}>All
		<br><br>
		
		Str: {{$character->strength}} - <span class="{{$costs['strength'] > $character->xp ? 'non-train' : ''}}">{{$costs['strength']}}</span>
		<!-- <label for="strength_submit" class="fa fa-plus"></label> -->
		<input type="submit" id="strength_submit" name="submit" value="strength" class="submit-val">
		<br>
		Dex: {{$character->dexterity}} - <span class="{{$costs['dexterity'] > $character->xp ? 'non-train' : ''}}">{{$costs['dexterity']}}</span>
		<!-- <label for="dexterity_submit" class="fa fa-plus"></label> -->
		<input type="submit" id="dexterity_submit" name="submit" value="dexterity" class="submit-val">
		<br>
		Con: {{$character->constitution}} - <span class="{{$costs['constitution'] > $character->xp ? 'non-train' : ''}}">{{$costs['constitution']}}</span>
		<!-- <label for="constitution_submit" class="fa fa-plus"></label> -->
		<input type="submit" id="constitution_submit" name="submit" value="constitution" class="submit-val">
		<br>
		Wis: {{$character->wisdom}} - <span class="{{$costs['wisdom'] > $character->xp ? 'non-train' : ''}}">{{$costs['wisdom']}}</span>
		<!-- <label for="wisdom_submit" class="fa fa-plus"></label> -->
		<input type="submit" id="wisdom_submit" name="submit" value="wisdom" class="submit-val">
		<br>
		Int: {{$character->intelligence}} - <span class="{{$costs['intelligence'] > $character->xp ? 'non-train' : ''}}">{{$costs['intelligence']}}</span>
		<!-- <label for="intelligence_submit" class="fa fa-plus"></label> -->
		<input type="submit" id="intelligence_submit" name="submit" value="intelligence" class="submit-val">
		<br>
		Cha: {{$character->charisma}} - <span class="{{$costs['charisma'] > $character->xp ? 'non-train' : ''}}">{{$costs['charisma']}}</span>
		<!-- <label for="charisma_submit" class="fa fa-plus"></label> -->
		<input type="submit" id="charisma_submit" name="submit" value="charisma" class="submit-val">
		<br>
		<input type="hidden" name="character_id" value="{{$character->id}}">
		{{csrf_field()}}
	</form>
	
@endif

<script>
	$('input[name="train_multi"]').on('change', function(e) {
		console.log('fire away');
		$(e.target).closest('form').submit();
		});
</script>