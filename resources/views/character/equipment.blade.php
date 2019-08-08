

@if ($character)
<form method="post" action="/equipment" class="ajax" id="equip">
	Weapon:
	<select name="weapon">
		<option value="0">-- Nothing --</option>
		@foreach ($weapons as $weapon)
		<option value="{{$weapon['id']}}" {{ $weapon['selected'] ? 'selected' : '' }} >{{$weapon['name']}}</option>
		@endforeach
	</select>
	Head:
	<select>
		<option>-- Nothing --</option>
	</select>
	Chest:
	<select>
		<option>-- Nothing --</option>
	</select>
	Legs:
	<select>
		<option>-- Nothing --</option>
	</select>
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<input type="hidden" name="action" value="equip">
	{{csrf_field()}}
</form>
@endif

<script>
	$('#equip').on('change', 'select', function(e) {
		console.log('fire away');
		$(e.delegateTarget).submit();
	});
</script>

<form method="post" action="/game" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="back_home">Main</label>
	<input type="submit" id="back_home" style="display: none;">
</form>