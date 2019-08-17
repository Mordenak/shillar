<select id="refresh-rate" name="refresh-rate">
	<option value="10000" {{isset($refresh_rate) && $refresh_rate == 10000 ? 'selected' : ''}}>10</option>
	<option value="30000" {{isset($refresh_rate) && $refresh_rate == 30000 ? 'selected' : ''}}>30</option>
	<option value="60000" {{isset($refresh_rate) && $refresh_rate == 60000 ? 'selected' : ''}}>60</option>
</select>

<header>
	{{$character->name}}<br>
	{{$character->playerrace->gender}} {{$character->playerrace->name}}
</header>
<strong> -- Stats -- </strong>
<ul>
	<li>XP: {{$stats->xp}}</li>
	<li>Gold: {{$stats->gold}}</li>
</ul>
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

<form method="post" id="menu-form" action="/menu" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="back_home">Main</label>
	<input type="submit" id="back_home" style="display: none;">
</form>

<script>

setTimeout(function(e) {	
	var formData = new FormData(document.getElementById('menu-form'));
	formData.append('refresh-rate', $('refresh-rate').val());
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
	}, $('#refresh-rate').val());
</script>