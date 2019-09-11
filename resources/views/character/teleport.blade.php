<span style="color: #00FFFF">
	<strong>Teleport:</strong>
</span>
<br><br>
@if ($character)
@if ($character->eligible_teleports()->count() > 0)
@foreach ($character->eligible_teleports() as $target)
<form method="post" action="/game/teleport" class="ajax" id="cast">
	<label for="spell_{{$target->id}}">{{$target->name}}</label>
	<input type="submit" id="spell_{{$target->id}}" style="display:none;">
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<input type="hidden" name="target_id" value="{{$target->id}}">
	{{csrf_field()}}
</form>
@endforeach
@endif
@endif
<br><br>
<form method="post" action="/menu" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="back_home">Cancel</label>
	<input type="submit" id="back_home" style="display: none;">
</form>