<p style="color: red;display: inline;">
@foreach ($combat_log as $log_entry)
	{{$log_entry}}<br>
@endforeach
</p>

<div style="float:right;">
	Quick Stats here:<br>
	Health: {{$character->health}} / {{$character->max_health}}<br>
	<progress value="{{$character->health}}" max="{{$character->max_health}}" class="stat-bar stat-bar-health {{ ($character->health <= ($character->max_health * .4)) ? '__low' : ''}}"></progress><br>
	Mana: {{$character->mana}} / {{$character->max_mana}}<br>
	<progress value="{{$character->mana}}" max="{{$character->max_mana}}" class="stat-bar stat-bar-mana"></progress><br>
	Fatigue: {{$character->fatigue}} / {{$character->max_fatigue}}<br>
	<progress value="{{$character->fatigue}}" max="{{$character->max_fatigue}}" class="stat-bar stat-bar-fatigue"></progress><br>
</div>


@if ($return_room)
	<form method="post" action="/game" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="room_id" value="{{$return_room}}">
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<label for="return_room">Return</label>
		<input type="submit" id="return_room" style="display: none;">
	</form>
@endif