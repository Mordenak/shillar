

@if ($character)
	Weapon:
	<select>
		<option>-- Nothing --</option>
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
@endif

<form method="post" action="/game" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="back_home">Main</label>
	<input type="submit" id="back_home" style="display: none;">
</form>