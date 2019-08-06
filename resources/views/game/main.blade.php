<html>

	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	</head>

	<body>

	<script>
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});


	</script>

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

	form
		{
		margin-block-end: 0px;
		}

	label
		{
		text-decoration: underline;
		color: blue;
		}

	.stat-bar
		{
		-webkit-appearance: none;
		appearance: none;
		border: 1px solid white;
		height: .5rem;
		}

	.stat-bar::-webkit-progress-bar
		{
		background: #999;
		}

	.stat-bar-health::-webkit-progress-value
		{
		background: #33d433;
		}

	.stat-bar-health.__low::-webkit-progress-value
		{
		background: #d43333;
		}

	.stat-bar-mana::-webkit-progress-value
		{
		background: blue;
		}

	.stat-bar-fatigue::-webkit-progress-value
		{
		background: gray;
		}
	</style>

	<div class="game-container">

		<div class="stats">
			<header>{{ $character->name }}, {{$character->playerrace->name}}</header>
			<ul>
				<li>XP: {{$character->xp}}</li>
				<li>Gold: {{$character->gold}}</li>
			</ul>
			<strong> -- Stats -- </strong>
			<ul>
				<li>Strength: {{$character->strength}}</li>
				<li>Dexterity: {{$character->dexterity}}</li>
				<li>Constitution: {{$character->constitution}}</li>
				<li>Wisdom: {{$character->wisdom}}</li>
				<li>Intelligence: {{$character->intelligence}}</li>
				<li>Charisma: {{$character->charisma}}</li>
				<br>
				<li>Score: {{$character->score}}</li>
				<!-- <li>Brute: {{$character->brute}}</li> -->
				<!-- <li>Finesse: {{$character->finesse}}</li> -->
				<!-- <li>Insight: {{$character->insight}}</li> -->
			</ul>
			<form method="post" action="/game" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="character_id" value="{{$character->id}}">
				<label for="back_home">Main</label>
				<input type="submit" id="back_home" style="display: none;">
			</form>

			<form method="get" action="/home">
				{{csrf_field()}}
				<label for="char_select">Home</label>
				<input type="submit" id="char_select" style="display: none;">
			</form>
		</div>

		<div class="main">


			<div>
				Quick Stats here:<br>
				Health: {{$character->health}} / {{$character->max_health}}<br>
				<progress value="{{$character->health}}" max="{{$character->max_health}}" class="stat-bar stat-bar-health {{ ($character->health <= ($character->max_health * .4)) ? '__low' : ''}}"></progress><br>
				Mana: {{$character->mana}} / {{$character->max_mana}}<br>
				<progress value="{{$character->mana}}" max="{{$character->max_mana}}" class="stat-bar stat-bar-mana"></progress><br>
				Fatigue: {{$character->fatigue}} / {{$character->max_fatigue}}<br>
				<progress value="{{$character->fatigue}}" max="{{$character->max_fatigue}}" class="stat-bar stat-bar-fatigue"></progress><br>
			</div>

			This will be the main game window:

			You are in: {{ $room->title }}

			<p>
				{{ $room->description }}
			</p>

			@if ($npc)
				<form method="post" action="/combat" class="ajax">
					{{csrf_field()}}
					<input type="hidden" name="room_id" value="{{$room->id}}">
					<input type="hidden" name="npc_id" value="{{$npc->id}}">
					<input type="hidden" name="character_id" value="{{$character->id}}">
					<label for="start_combat">[A] There is a {{ $npc->name }} here.</label>
					<input type="submit" id="start_combat" style="display: none;">
				</form>
			@endif

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

				@if ($room->east_rooms_id)
					<form method="post" action="/move" class="ajax">
						{{csrf_field()}}
						<input type="hidden" name="room_id" value="{{$room->east_rooms_id}}">
						<input type="hidden" name="character_id" value="{{$character->id}}">
						<label for="move_east">Go east</label>
						<input type="submit" id="move_east" style="display: none;">
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

				@if ($room->west_rooms_id)
					<form method="post" action="/move" class="ajax">
						{{csrf_field()}}
						<input type="hidden" name="room_id" value="{{$room->west_rooms_id}}">
						<input type="hidden" name="character_id" value="{{$character->id}}">
						<label for="move_west">Go west</label>
						<input type="submit" id="move_west" style="display: none;">
					</form>
				@endif

			</p>
		</div>

		<div class="footer">
			A chat?
			<form method="post" action="/train" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="character_id" value="{{$character->id}}">
				<label for="begin_train">Train</label>
				<input type="submit" id="begin_train" style="display: none;">
			</form>

			<form method="post" action="/rest" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="character_id" value="{{$character->id}}">
				<label for="begin_rest">Rest</label>
				<input type="submit" id="begin_rest" style="display: none;">
			</form>
		</div>

	</div>

	<script>
	$('body').on('submit', 'form.ajax', function(e, i) {
		e.preventDefault();
		if ($(e.target).hasClass('event-fired'))
			{
			return true;
			}

		$(e.target).addClass('event-fired');

		var formData = new FormData(e.target);
		// console.log($(document.activeElement));
		formData.append('submit', $(document.activeElement).val());

		// console.log('ajaxing to ' + $(e.target).attr('action'));

		// console.log(data.entries);

		for (var pair of formData.entries())
			{
			// console.log(pair[0] +':' + pair[1]);
			}

		$.ajax({
			type: 'POST',
			url: $(e.target).attr('action'),
			contentType: false,
			processData: false,
			data: formData,
			success: function(resp) {
				var main_inserts = [
					'/combat',
					'/train',
					'/train_stat',
					'/rest'
					];
				// location.reload();
				// console.log(this);
				// console.log(this['url']);
				var replace = 'body';
				if (main_inserts.includes(this['url']))
					{
					replace = '.main';
					}
				// console.log('replace:' + replace);
				$(replace).html(resp);
				}
			});
		console.log('done?');
		});
	</script>

</body>

</html>