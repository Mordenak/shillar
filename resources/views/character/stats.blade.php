<span style="color: #00FFFF">
	<strong>Player Score</strong>
</span>
<br><br>
<table>
	<tr>
		<td>Name</td>
		<td>{{$character->name}}</td>
	</tr>
	<tr>
		<td>Race</td>
		<td>{{$character->playerrace()->name}}</td>
	</tr>
	<tr>
		<td>Sex</td>
		<td>{{$character->playerrace()->gender}}</td>
	</tr>
	@if ($character->alignment())
	<tr>
		<td>Alignment</td>
		<td><span style="color: #{{$character->alignment()->color}}">{{$character->alignment()->name}}</span></td>
	</tr>
	@endif
	<tr>
		<td>Strength</td>
		<td>{{$character->strength()}}</td>
	</tr>
	<tr>
		<td>Dexterity</td>
		<td>{{$character->dexterity()}}</td>
	</tr>
	<tr>
		<td>Constitution</td>
		<td>{{$character->constitution()}}</td>
	</tr>
	<tr>
		<td>Wisdom</td>
		<td>{{$character->wisdom()}}</td>
	</tr>
	<tr>
		<td>Intelligence</td>
		<td>{{$character->intelligence()}}</td>
	</tr>
	<tr>
		<td>Charisma</td>
		<td>{{$character->charisma()}}</td>
	</tr>
	<tr>
		<td>Class</td>
		<td><strong>{!! $character->display_rank() !!}</strong></td>
	</tr>
	<tr>
		<td>Wall Score</td>
		<td><strong>{{$character->score}}</strong></td>
	</tr>
	<tr>
		<td>Exp</td>
		<td>{{$character->xp}}</td>
	</tr>
	<tr>
		<td>Gold</td>
		<td>{{$character->gold}}</td>
	</tr>
	<tr>
		<td>Bank</td>
		<td>{{$character->bank}}</td>
	</tr>
	<tr>
		<td>Quest Points</td>
		<td>{{$character->quest_points}}</td>
	</tr>
	<tr>
		<td>Deaths</td>
		<td>{{$character->death_count}}</td>
	</tr>
</table>
<br><br>
<div style="margin-left: .5rem;">
	Health: {{$character->health}} / {{$character->max_health}}<br>
	<progress value="{{$character->health}}" max="{{$character->max_health}}" class="stat-bar stat-bar-health {{ ($character->health <= ($character->max_health * .4)) ? '__low' : ''}}"></progress><br>
	Mana: {{$character->mana}} / {{$character->max_mana}}<br>
	<progress value="{{$character->mana}}" max="{{$character->max_mana}}" class="stat-bar stat-bar-mana"></progress><br>
	Fatigue: {{$character->fatigue}} / {{$character->max_fatigue}}<br>
	<progress value="{{$character->fatigue}}" max="{{$character->max_fatigue}}" class="stat-bar stat-bar-fatigue"></progress><br>
</div>
<br><br>

<form method="post" id="menu-form" action="/menu" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<input type="submit" style="display: none;">
</form>

<span style="color: #00FFFF">
	<strong>Menu:</strong>
</span>
<form method="post" action="/menu" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="back_home">Menu</label>
	<input type="submit" id="back_home" style="display: none;">
</form>
<form method="post" action="/show_stats" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="stats" class="disabled" disabled>Stats</label>
	<input type="submit" id="stats" style="display: none;">
</form>
<form method="post" action="/equipment" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="equipment">Equipment</label>
	<input type="submit" id="equipment" style="display: none;">
</form>
<form method="post" action="/food" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="food">Food</label>
	<input type="submit" id="food" style="display: none;">
</form>
@if ($character->spells())
<form method="post" action="/spells" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="spells">Spells</label>
	<input type="submit" id="spells" style="display: none;">
</form>	
@endif
<form method="post" action="/settings" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="settings">Options</label>
	<input type="submit" id="settings" style="display: none;">
</form>
<br><br>
<form method="get" action="/home">
	{{csrf_field()}}
	<label for="char_select">Logout</label>
	<input type="submit" id="char_select" style="display: none;">
</form>

<style>
.menu table tr td:first-child
	{
	color: #0099FF;
	}
</style>

@if ($character->settings()->refresh_rate > 0)
<script>
var refresh_rate = parseInt('{{$character->settings()->refresh_rate * 1000}}');
setTimeout(function(e) {
	console.log('Refreshing stats every '+refresh_rate);
	var formData = new FormData(document.getElementById('menu-form'));
	$.ajax({
		type: 'POST',
		url: '/show_stats',
		contentType: false,
		processData: false,
		data: formData,
		success: function(resp) {
			$('.menu').html(resp);
			}
		});
	}, refresh_rate);
</script>
@endif