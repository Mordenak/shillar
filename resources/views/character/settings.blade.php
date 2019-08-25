Stats Refresh:
<br>
Brief Mode:

<br><br>
<form method="post" id="menu-form" action="/menu" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="back_home">Main</label>
	<input type="submit" id="back_home" style="display: none;">
</form>