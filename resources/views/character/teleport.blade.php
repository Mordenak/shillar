<span style="color: #00FFFF">
	<strong>Teleport:</strong>
</span>
<br><br>
@if ($character)
@if (count($params['available_rooms']) > 0)
@foreach ($params['available_rooms'] as $target)
<form method="post" action="/spells" class="ajax" id="cast">
	<label for="spell_{{$loop->index}}">{{$target['name']}}</label>
	<input type="submit" id="spell_{{$loop->index}}" style="display:none;">
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<input type="hidden" name="target_id" value="{{$target['id']}}">
	<input type="hidden" name="spell_id" value="{{$params['spell']->spell()->id}}">
	<input type="hidden" name="action" value="cast">
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