<select id="refresh-rate" name="refresh-rate">
	<option value="10000" {{isset($refresh_rate) && $refresh_rate == 10000 ? 'selected' : ''}}>10</option>
	<option value="30000" {{isset($refresh_rate) && $refresh_rate == 30000 ? 'selected' : ''}}>30</option>
	<option value="60000" {{isset($refresh_rate) && $refresh_rate == 60000 ? 'selected' : ''}}>60</option>
</select>

<header>
	{{$character->name}}<br>
	{{$character->playerrace()->gender}} {{$character->playerrace()->name}}
</header>

<table>
	<tr>
		<td>XP</td>
		<td>{{$character->xp}}</td>
	</tr>
	<tr>
		<td>Gold</td>
		<td>{{$character->gold}}</td>
	</tr>
	<tr>
		<td>Deaths</td>
		<td>{{$character->death_count}}</td>
	</tr>
	<tr>
		<td>Armor</td>
		<td>{{$character->equipment()->calculate_armor()}}</td>
	</tr>
</table>

<table>
	<tr>
		<td>Wall Score</td>
		<td><strong>{{$character->score}}</strong></td>
	</tr>
	<tr>
		<td>Strength</td>
		<td>{{$character->strength}}</td>
	</tr>
	<tr>
		<td>Dexterity</td>
		<td>{{$character->dexterity}}</td>
	</tr>
	<tr>
		<td>Constitution</td>
		<td>{{$character->constitution}}</td>
	</tr>
	<tr>
		<td>Wisdom</td>
		<td>{{$character->wisdom}}</td>
	</tr>
	<tr>
		<td>Intelligence</td>
		<td>{{$character->intelligence}}</td>
	</tr>
	<tr>
		<td>Charisma</td>
		<td>{{$character->charisma}}</td>
	</tr>
</table>

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