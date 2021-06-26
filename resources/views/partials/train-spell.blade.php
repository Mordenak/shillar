<style>
	.non-train
		{
		color: red;
		}

	#training-form input[name="submit"]
		{
		margin-bottom: .5rem;
		}
</style>

@if ($character)

	Current Exp: {{ $character->xp }}

	@if( Session::has("training") )
	<p>
	{{ Session::get("training") }}
	</p>
	@endif

	<br><br>
	<form method="post" id="training-form" action="/spells/train" class="ajax">
		Training Amount:
		<input type="radio" id="train1" name="train_multi" value="1" {{ $multi == 1 ? 'checked' : '' }}>
		<label for="train1">1</label>
		<input type="radio" id="train10" name="train_multi" value="10" {{ $multi == 10 ? 'checked' : '' }}>
		<label for="train10">10</label>
		<input type="radio" id="train100" name="train_multi" value="100" {{ $multi == 100 ? 'checked' : '' }}>
		<label for="train100">100</label>
		<input type="radio" id="trainAll" name="train_multi" value="all" {{ $multi == "all" ? 'checked' : '' }}>
		<label for="trainAll">All</label>
		<br><br>

		@foreach ($spells as $spell)
		{{$spell->name}}: {{$character->has_spell($spell->id) ? $character->has_spell($spell->id)->level : 0}} - <span class="{{$costs[$spell->id] > $character->xp ? 'non-train' : ''}}">{{$costs[$spell->id]}}</span>
		<!-- <label for="strength_submit" class="fa fa-plus"></label> -->
		<input type="submit" id="{{$spell->id}}_submit" name="train" value="{{$spell->name}}" class="submit-val">
		<br>
		@endforeach
		<input type="hidden" name="rooms_id" value="{{$room->id}}">
		<input type="hidden" name="character_id" value="{{$character->id}}">
		{{csrf_field()}}
		
	</form>
	

	
@endif

<script>
	$('input[name="train_multi"]').on('change', function(e) {
		console.log('fire away');
		$(e.target).closest('form').submit();
		});
</script>