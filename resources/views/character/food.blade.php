<span style="color: #00FFFF">
	<strong>Food</strong>
</span>
<br><br>
@if ($character)
<form method="post" action="/food" class="ajax" id="consume">
	<select name="item">
		@if (count($items) > 0)
		@foreach ($items as $item)
		<option value="{{$item['id']}}" {{ $item['selected'] ? 'selected' : '' }}>{{$item['name']}} ({{$item['quantity']}})</option>
		@endforeach
		@else
		<option disabled selected>-- None --</option>
		@endif
	</select><br>
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<input type="hidden" name="action" value="consume">
	{{csrf_field()}}

	@if (count($items) > 0)
	<input type="submit" value="Use">
	@endif
</form>

<br>
<div style="display: inline-block;">
	Health: {{$character->health}} / {{$character->max_health}}<br>
	<progress value="{{$character->health}}" max="{{$character->max_health}}" class="stat-bar stat-bar-health {{ ($character->health <= ($character->max_health * .4)) ? '__low' : ''}}"></progress><br>
	Mana: {{$character->mana}} / {{$character->max_mana}}<br>
	<progress value="{{$character->mana}}" max="{{$character->max_mana}}" class="stat-bar stat-bar-mana"></progress><br>
	Fatigue: {{ceil($character->fatigue)}} / {{$character->max_fatigue}}<br>
	<progress value="{{$character->fatigue}}" max="{{$character->max_fatigue}}" class="stat-bar stat-bar-fatigue"></progress><br>
</div>
<br>
@endif
<br>
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
	<label for="stats">Stats</label>
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
	<label for="food" class="disabled" disabled>Food</label>
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