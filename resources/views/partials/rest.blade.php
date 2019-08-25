@if ($character)

	<div style="float:left;">
		Quick Stats here:<br>
		Health: {{$character->health}} / {{$character->max_health}}<br>
		<progress value="{{$character->health}}" max="{{$character->max_health}}" class="stat-bar stat-bar-health {{ ($character->health <= ($character->max_health * .4)) ? '__low' : ''}}"></progress><br>
		Mana: {{$character->mana}} / {{$character->max_mana}}<br>
		<progress value="{{$character->mana}}" max="{{$character->max_mana}}" class="stat-bar stat-bar-mana"></progress><br>
		Fatigue: {{$character->fatigue}} / {{$character->max_fatigue}}<br>
		<progress value="{{$character->fatigue}}" max="{{$character->max_fatigue}}" class="stat-bar stat-bar-fatigue"></progress><br>
	</div>

	resting

	<form method="post" action="/game" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<label for="wake_up">Wake Up</label>
		<input type="submit" id="wake_up" style="display: none;">
	</form>

	<br><br>

	<form method="post" action="/rest"  class="rest-form">
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<input type="hidden" name="action" value="heal">
	</form>
	
	@if (!$healing)
	<script>
		$.ajaxSetup({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(document).ajaxComplete(function(event, xhr,settings) {
			if (settings.url !== '/rest')
				{
				console.log('killing interval');
				clearInterval(healingTimer);
				}
		});

		function send_rest()
			{
			console.log('running interval');
			var $data = new FormData($('.rest-form')[0]);
			// console.log($data);
			$.ajax({
			type: 'POST',
			url: '/rest',
			contentType: false,
			processData: false,
			data: $data,
			success: function(resp) {
				var replace = '.main';
				// console.log('resp:' + resp);
				$(replace).html(resp);
				}
			});	
			}

		var healingTimer = setInterval( send_rest, 3000);
	</script>
	@endif

@endif