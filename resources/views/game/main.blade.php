<html>

	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	</head>

	<body>

	<script>
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	</script>

	You made it!

	Something character: {{$character->name}} ?? {{$character->health}}

	<style>
	body
		{
		background-color: #c5c5c5;
		}

	.game-container
		{
		display: grid;
		grid-template-areas:
			'stats main'
			'footer footer';
		grid-template-columns: 20% auto;
		grid-gap: .25rem;
		}

	.game-container div
		{
		border: 1px solid black;
		/*height: 100px;*/
		min-height: 100px;
		padding: .5rem;
		}

	.game-container .stats
		{
		grid-area: stats;
		text-align: center;
		}

	.game-container .stats header
		{
		font-weight: bold;
		border-bottom: 1px solid #ccc;
		}

	.game-container .stats ul
		{
		/*text-align: left;*/
		list-style: none;
		padding: 0;
		margin: 0;
		}

	.game-container .main
		{
		grid-area: main;
		}

	.game-container .footer
		{
		grid-area: footer;
		}
	</style>

	<div class="game-container">

		<div class="stats">
			<header>{{ $character->name }}, Level {{$character->level}} {{$character->playerrace}} {{$character->class}}</header>
			<ul>
				<li>Health: {{$character->health}} / {{$character->max_health}}</li>
				<li>Mana: {{$character->mana}} / {{$character->max_mana}}</li>
				<li>Ward: {{$character->ward}} / {{$character->max_ward}}</li>
			</ul>
			<strong> -- Stats -- </strong>
			<ul>
				<li>Strength: {{$character->strength}}</li>
				<li>Dexterity: {{$character->dexterity}}</li>
				<li>Intelligence: {{$character->intelligence}}</li>
				<li>Vitality: {{$character->vitality}}</li>
				<li>Guard: {{$character->guard}}</li>
				<li>Wisdom: {{$character->wisdom}}</li>
				<li>Brute: {{$character->brute}}</li>
				<li>Finesse: {{$character->finesse}}</li>
				<li>Insight: {{$character->insight}}</li>
			</ul>
		</div>

		<div class="main">
			This will be the main game window:

			You are in: {{ $room->title }}

			<p>
				{{ $room->description }}
			</p>

			<p>
				@if ($room->north_rooms_id)
					<form method="post" action="/move" class="ajax">
						{{csrf_field()}}
						<input type="hidden" name="room_id" value="{{$room->north_rooms_id}}">
						<input type="hidden" name="character_id" value="{{$character->id}}">
						<label for="move_north">Go north</label>
						<input type="submit" id="move_north" style="display: none;">
					</form>
				@endif

				@if ($room->south_rooms_id)
					<form method="post" action="/move" class="ajax">
						{{csrf_field()}}
						<input type="hidden" name="room_id" value="{{$room->south_rooms_id}}">
						<input type="hidden" name="character_id" value="{{$character->id}}">
						<label for="move_south">Go south</label>
						<input type="submit" id="move_south" style="display: none;">
					</form>
				@endif

			</p>
		</div>

		<div class="footer">
			A chat?
		</div>

	</div>

	<script>
	$('form.ajax').on('submit', function(e, i) {
		console.log('got this');
		e.preventDefault();

		var formData = new FormData(e.target);

		console.log('ajaxing to ' + $(e.target).attr('action'));

		// console.log(data.entries);

		for (var pair of formData.entries())
			{
			console.log(pair[0] +':' + pair[1]);
			}

		$.ajax({
			type: 'POST',
			url: $(e.target).attr('action'),
			// url: "{{action('GameController@move')}}",
			contentType: false,
			processData: false,
			data: formData,
			success: function(resp) {
				// location.reload();
				// console.log(resp);
				$('body').html(resp);
				}
			});
	});
	</script>

</body>

</html>