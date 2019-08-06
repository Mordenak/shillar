Please create a character:<br>


<form action="/character/save" method="POST" class="form-horizontal">
	{{ csrf_field() }}
	Name: <input type="text" name="character_name">
	Race:
	<select name="selected_race">
		@foreach ($races as $race)
			<option value="{{$race->id}}">{{$race->name}}</option>
		@endforeach
	</select>

	<input type="hidden" name="users_id" value="">

	<input type="submit" value="Create!">
</form>