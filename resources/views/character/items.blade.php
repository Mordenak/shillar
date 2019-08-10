

@if ($character)
<form method="post" action="/items" class="ajax" id="consume">
	Consumable:
	<select name="item">
		@foreach ($items as $item)
		<option value="{{$item['id']}}" {{ $item['selected'] ? 'selected' : '' }}>{{$item['name']}} ({{$item['quantity']}})</option>
		@endforeach
	</select><br>
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<input type="hidden" name="action" value="consume">
	{{csrf_field()}}
	<input type="submit" value="Use">
</form>

<div style="display: inline-block;">
	Health: {{$character->health}} / {{$character->max_health}}<br>
	<progress value="{{$character->health}}" max="{{$character->max_health}}" class="stat-bar stat-bar-health {{ ($character->health <= ($character->max_health * .4)) ? '__low' : ''}}"></progress><br>
	Mana: {{$character->mana}} / {{$character->max_mana}}<br>
	<progress value="{{$character->mana}}" max="{{$character->max_mana}}" class="stat-bar stat-bar-mana"></progress><br>
	Fatigue: {{$character->fatigue}} / {{$character->max_fatigue}}<br>
	<progress value="{{$character->fatigue}}" max="{{$character->max_fatigue}}" class="stat-bar stat-bar-fatigue"></progress><br>
</div>
@endif

<form method="post" action="/game" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="back_home">Main</label>
	<input type="submit" id="back_home" style="display: none;">
</form>