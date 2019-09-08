@section('menu')
<div style="text-align: left;">
	<div style="color:#12a1df;">
	It is the <span style="color:#33ffee">{{App\World::cycle()}}</span> cycle in<br>
	the year of our lord <span style="color:#33ffee">{{App\World::year()}}</span><br>
	<br>
	@if ($online_count > 1)
	There are <span style="color:#33ffee">{{$online_count}}</span> active players online.
	@else
	There is <span style="color:#33ffee">{{$online_count}}</span> active player online.
	<br>
	Population: YOU
	@endif
	</div>
	<br><br>
	<span style="color: #00FFFF">
		<strong>Menu:</strong>
	</span>
	<form method="post" action="/game" class="ajax">
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
</div>
@endsection