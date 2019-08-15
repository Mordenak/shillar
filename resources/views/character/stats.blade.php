<header>{{ $character->name }}, {{$character->playerrace->gender}} {{$character->playerrace->name}}</header>
<strong> -- Stats -- </strong>
<ul>
	<li>Strength: {{$stats->strength}}</li>
	<li>Dexterity: {{$stats->dexterity}}</li>
	<li>Constitution: {{$stats->constitution}}</li>
	<li>Wisdom: {{$stats->wisdom}}</li>
	<li>Intelligence: {{$stats->intelligence}}</li>
	<li>Charisma: {{$stats->charisma}}</li>
	<br>
	<li>Score: {{$stats->score}}</li>
</ul>

<form method="post" action="/game" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="back_home">Main</label>
	<input type="submit" id="back_home" style="display: none;">
</form>