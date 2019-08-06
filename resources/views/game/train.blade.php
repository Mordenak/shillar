training

<br><br>

@if ($character)

	<form method="post" action="/train_stat" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		Str: {{$character->strength}} - {{$costs['strength']}}
		<label for="strength_submit" class="fa fa-plus"></label>
		<input type="submit" id="strength_submit" name="submit" value="strength">
		<br>
		Dex: {{$character->dexterity}} - {{$costs['dexterity']}}
		<label for="dexterity_submit" class="fa fa-plus"></label>
		<input type="submit" id="dexterity_submit" name="submit" value="dexterity">
		<br>
		Con: {{$character->constitution}} - {{$costs['constitution']}}
		<label for="constitution_submit" class="fa fa-plus"></label>
		<input type="submit" id="constitution_submit" name="submit" value="constitution">
		<br>
		Wis: {{$character->wisdom}} - {{$costs['wisdom']}}
		<label for="wisdom_submit" class="fa fa-plus"></label>
		<input type="submit" id="wisdom_submit" name="submit" value="wisdom">
		<br>
		Int: {{$character->intelligence}} - {{$costs['intelligence']}}
		<label for="intelligence_submit" class="fa fa-plus"></label>
		<input type="submit" id="intelligence_submit" name="submit" value="intelligence">
		<br>
		Cha: {{$character->charisma}} - {{$costs['charisma']}}
		<label for="charisma_submit" class="fa fa-plus"></label>
		<input type="submit" id="charisma_submit" name="submit" value="charisma">
		<br>
	</form>
	
	<!--
	<form method="post" action="/train_stat" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="stat" value="strength">
		<input type="hidden" name="character_id" value="{{$character->id}}">
		Str: {{$character->strength}} - {{$costs['strength']}} 
		<label for="strength_submit" class="fa fa-plus"></label>
		<input type="submit" id="strength_submit" style="display: none;">
	</form>

	<form method="post" action="/train_stat" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="stat" value="dexterity">
		<input type="hidden" name="character_id" value="{{$character->id}}">
		Dex: {{$character->dexterity}} - {{$costs['dexterity']}} 
		<label for="dexterity_submit" class="fa fa-plus"></label>
		<input type="submit" id="dexterity_submit" style="display: none;">
	</form>

	<form method="post" action="/train_stat" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="stat" value="constitution">
		<input type="hidden" name="character_id" value="{{$character->id}}">
		Con: {{$character->constitution}} - {{$costs['constitution']}} 
		<label for="constitution_submit" class="fa fa-plus"></label>
		<input type="submit" id="constitution_submit" style="display: none;">
	</form>

	<form method="post" action="/train_stat" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="stat" value="wisdom">
		<input type="hidden" name="character_id" value="{{$character->id}}">
		Wis: {{$character->strength}} - {{$costs['strength']}} 
		<label for="strength_submit" class="fa fa-plus"></label>
		<input type="submit" id="strength_submit" style="display: none;">
	</form>
	Con: {{$character->constitution}} - {{$costs['constitution']}}<br>
	Wis: {{$character->wisdom}} - {{$costs['wisdom']}}<br>
	Int: {{$character->intelligence}} - {{$costs['intelligence']}}<br>
	Cha: {{$character->charisma}} - {{$costs['charisma']}}<br>
	-->
@endif