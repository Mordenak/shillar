<span style="color: #00FFFF">
	<strong>Spell Book</strong>
</span>
<br><br>
@if( Session::has("errors") )
<p style="color: red;display: inline;">
{{ Session::pull("errors") }}
<p>
@endif
@if( Session::has("spell_messages") )
<p style="color: green;display: inline;">
{{ Session::pull("spell_messages") }}
<p>
@endif
@if ($character)

@foreach ($character->spells()->get() as $spell)
@if ($spell->spell()->is_combat == false)
<form method="post" action="/spells" class="ajax" id="cast">
	<label for="spell_{{$spell->spell()->id}}">{{$spell->spell()->display_text ? $spell->spell()->display_text : 'Cast ' . $spell->spell()->name}}</label>
	<input type="submit" id="spell_{{$spell->spell()->id}}" style="display:none;">
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<input type="hidden" name="spell_id" value="{{$spell->spell()->id}}">
	@if ($spell->spell()->has_property('HAS_PARTIAL'))
	<input type="hidden" name="delay_mana_cost" value="true">
	@endif
	<input type="hidden" name="action" value="cast">
	{{csrf_field()}}
</form>
@endif
@endforeach

<br>
<div style="display: inline-block;">
	Health: {{$character->health}} / {{$character->max_health}}<br>
	<progress value="{{$character->health}}" max="{{$character->max_health}}" class="stat-bar stat-bar-health {{ ($character->health <= ($character->max_health * .4)) ? '__low' : ''}}"></progress><br>
	Mana: {{$character->mana}} / {{$character->max_mana}}<br>
	<progress value="{{$character->mana}}" max="{{$character->max_mana}}" class="stat-bar stat-bar-mana"></progress><br>
	Fatigue: {{$character->fatigue}} / {{$character->max_fatigue}}<br>
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
	<label for="food">Food</label>
	<input type="submit" id="food" style="display: none;">
</form>
<form method="post" action="/spells" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="spells" class="disabled" disabled>Spells</label>
	<input type="submit" id="spells" style="display: none;">
</form>	
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