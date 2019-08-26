Welcome to the Water Temple!
<br><br>
Add some description here:
<br><br>
@if (!$character->alignment())
<form method="post" action="game/choose_alignment" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<input type="hidden" name="alignments_id" value="4">
	<label for="bow">Bow</label> your head to the statue.
	<input type="submit" id="bow" style="display:none;">
</form>
@endif