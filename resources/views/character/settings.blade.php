@if( Session::has("settings") )
<p>
{{ Session::get("settings") }}
</p>
@endif

<form method="post" action="/character/update_settings" class="ajax">
	Stats Refresh:
	<select name="refresh_rate">
		<option value="10" {{isset($settings) && $settings->refresh_rate == 10 ? 'selected' : ''}}>10</option>
		<option value="30" {{isset($settings) && $settings->refresh_rate == 30 ? 'selected' : ''}}>30</option>
		<option value="60" {{isset($settings) && $settings->refresh_rate == 60 ? 'selected' : ''}}>60</option>
	</select>
	<br>
	Brief Mode:
	<select name="brief_mode">
		<option value="1" {{isset($settings) && $settings->brief_mode == true ? 'selected' : ''}}>On</option>
		<option value="0" {{isset($settings) && $settings->brief_mode == false ? 'selected' : ''}}>Off</option>
	</select>
	<br>
	Life Gauge:
	<select name="life_gauge">
		<option value="1" {{isset($settings) && $settings->life_gauge == true ? 'selected' : ''}}>On</option>
		<option value="0" {{isset($settings) && $settings->life_gauge == false ? 'selected' : ''}}>Off</option>
	</select>
	<br>
	Mana Gauge:
	<select name="mana_gauge">
		<option value="1" {{isset($settings) && $settings->mana_gauge == true ? 'selected' : ''}}>On</option>
		<option value="0" {{isset($settings) && $settings->mana_gauge == false ? 'selected' : ''}}>Off</option>
	</select>
	<br>
	Fatigue Gauge:
	<select name="fatigue_gauge">
		<option value="1" {{isset($settings) && $settings->fatigue_gauge == true ? 'selected' : ''}}>On</option>
		<option value="0" {{isset($settings) && $settings->fatigue_gauge == false ? 'selected' : ''}}>Off</option>
	</select>
	<br>
	Food Sort:
	<select name="food_sort">
		<option value="0" {{isset($settings) && $settings->food_sort == 0 ? 'selected' : ''}}>Strength ASC</option>
		<option value="1" {{isset($settings) && $settings->food_sort == 1 ? 'selected' : ''}}>Strength DESC</option>
		<option value="2" {{isset($settings) && $settings->food_sort == 2 ? 'selected' : ''}}>Count ASC</option>
		<option value="3" {{isset($settings) && $settings->food_sort == 3 ? 'selected' : ''}}>Count DESC</option>
		<option value="4" {{isset($settings) && $settings->food_sort == 4 ? 'selected' : ''}}>Alphabetical ASC</option>
		<option value="5" {{isset($settings) && $settings->food_sort == 5 ? 'selected' : ''}}>Alphabetical DESC</option>
	</select>
	<br>
	Number commas:
	<select name="number_commas">
		<option value="1" {{isset($settings) && $settings->number_commas == true ? 'selected' : ''}}>On</option>
		<option value="0" {{isset($settings) && $settings->number_commas == false ? 'selected' : ''}}>Off</option>
	</select>
	<br>
	Creature Images:
	<select name="creature_images">
		<option value="1" {{isset($settings) && $settings->creature_images == true ? 'selected' : ''}}>On</option>
		<option value="0" {{isset($settings) && $settings->creature_images == false ? 'selected' : ''}}>Off</option>
	</select>
	<br>
	<input type="submit" value="Update">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
</form>

<br><br>
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
	<label for="food">Food</label>
	<input type="submit" id="food" style="display: none;">
</form>	
<form method="post" action="/settings" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="settings" class="disabled" disabled>Options</label>
	<input type="submit" id="settings" style="display: none;">
</form>
<br><br>
<form method="get" action="/home">
	{{csrf_field()}}
	<label for="char_select">Logout</label>
	<input type="submit" id="char_select" style="display: none;">
</form>