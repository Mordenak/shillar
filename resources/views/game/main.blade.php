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
		background-color: #111;
		color: white;
		}

	form label
		{
		color: #55ff8b;
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

	.game-container > div
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
		border: 1px solid #bbb;
		height: .3rem;
		}

	.stat-bar::-webkit-progress-bar
		{
		background: transparent;
		}

	.stat-bar-health::-webkit-progress-value
		{
		/*background: #33d433;*/
		background: #d43333;s
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
			<form method="post" action="/equipment" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="character_id" value="{{$character->id}}">
				<label for="equipment">Equipment</label>
				<input type="submit" id="equipment" style="display: none;">
			</form>
			<form method="post" action="/items" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="character_id" value="{{$character->id}}">
				<label for="items">Items</label>
				<input type="submit" id="items" style="display: none;">
			</form>
			<form method="post" action="/game" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="character_id" value="{{$character->id}}">
				<label for="back_home">Main</label>
				<input type="submit" id="back_home" style="display: none;">
			</form>
			

			<br><br>
			<form method="get" action="/home">
				{{csrf_field()}}
				<label for="char_select">Home</label>
				<input type="submit" id="char_select" style="display: none;">
			</form>
			<form method="post" action="/game" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="character_id" value="{{$character->id}}">
				<label for="back_home">Settings</label>
				<input type="submit" id="back_home" style="display: none;">
			</form>
		</div>

		<div class="main">

			@if (isset($combat_log))
			<p style="color: red;display: inline;">
			@foreach ($combat_log as $log_entry)
				{{$log_entry}}<br>
			@endforeach
			</p>
			@endif

			@if (isset($loot_log))
			<p style="display: inline;">
			@foreach ($loot_log as $log_entry)
				{{$log_entry}}<br>
			@endforeach
			</p>
			@endif

			<br>
			<div style="position: relative;">
			@if ($npc)
				<div style="display: inline-block;">
					<strong>{{ $npc->name }}</strong><br>
					@if ($npc->img_src)
					<img width="250" height="250" src="{{asset('img/'.$npc->img_src)}}">
					@else
					<img width="250" height="250" src="{{asset('img/wtf_slime.jpg')}}">
					@endif
					<form method="post" action="/combat" class="ajax">
						{{csrf_field()}}
						<input type="hidden" name="room_id" value="{{$room->id}}">
						<input type="hidden" name="npc_id" value="{{$npc->id}}">
						<input type="hidden" name="character_id" value="{{$character->id}}">
						<!-- <label for="start_combat">All Out Attack</label> -->
						<!-- <label for="start_combat">Single Attack</label> -->
						<!-- <label for="start_combat">Run Away</label> -->
						<!-- <input type="submit" id="start_combat" style="display: none;"> -->
						@if (!$no_attack)
						<table>
							<tr>
								<td style="color:yellow;">
									All Out Attack<br>
									<input type="submit" id="all_out" value="{{$npc->name}}">
								</td>
								<td style="color:#55ff8b;">
									Single Attack<br>
									<input type="submit" id="single" value="{{$npc->name}}">
								</td>
								<td style="color:red;">
									Run Away<br>
									<input type="submit" id="flee" value="{{$npc->name}}">
								</td>
							</tr>
						</table>
						@else
						<span style="color:red;">You are too tired to attack</span>
						@endif
					</form>
				</div>
				<div style="display: inline-block;position:absolute;top:50%;transform: translateY(-50%);">
					Health: {{$character->health}} / {{$character->max_health}}<br>
					<progress value="{{$character->health}}" max="{{$character->max_health}}" class="stat-bar stat-bar-health {{ ($character->health <= ($character->max_health * .4)) ? '__low' : ''}}"></progress><br>
					Mana: {{$character->mana}} / {{$character->max_mana}}<br>
					<progress value="{{$character->mana}}" max="{{$character->max_mana}}" class="stat-bar stat-bar-mana"></progress><br>
					Fatigue: {{$character->fatigue}} / {{$character->max_fatigue}}<br>
					<progress value="{{$character->fatigue}}" max="{{$character->max_fatigue}}" class="stat-bar stat-bar-fatigue"></progress><br>
				</div>
			@else
				<div style="display: inline-block;">
					Health: {{$character->health}} / {{$character->max_health}}<br>
					<progress value="{{$character->health}}" max="{{$character->max_health}}" class="stat-bar stat-bar-health {{ ($character->health <= ($character->max_health * .4)) ? '__low' : ''}}"></progress><br>
					Mana: {{$character->mana}} / {{$character->max_mana}}<br>
					<progress value="{{$character->mana}}" max="{{$character->max_mana}}" class="stat-bar stat-bar-mana"></progress><br>
					Fatigue: {{$character->fatigue}} / {{$character->max_fatigue}}<br>
					<progress value="{{$character->fatigue}}" max="{{$character->max_fatigue}}" class="stat-bar stat-bar-fatigue"></progress><br>
				</div>
			@endif
			</div>
			

			<br>

			<!-- {{ $room->title }} -->

			<p>
				You are walking around in the {{ $room->zone()->first()->name }}
				<!-- {{ $room->description }} -->
			</p>

			
			<p>
				@if ($room->north_rooms_id)
					<form method="post" action="/move" class="ajax">
						{{csrf_field()}}
						<input type="hidden" name="room_id" value="{{$room->north_rooms_id}}">
						<input type="hidden" name="character_id" value="{{$character->id}}">
						You can travel <label for="move_north">north</label>
						<input type="submit" id="move_north" style="display: none;">
					</form>
				@endif

				@if ($room->east_rooms_id)
					<form method="post" action="/move" class="ajax">
						{{csrf_field()}}
						<input type="hidden" name="room_id" value="{{$room->east_rooms_id}}">
						<input type="hidden" name="character_id" value="{{$character->id}}">
						You can travel <label for="move_east">east</label>
						<input type="submit" id="move_east" style="display: none;">
					</form>
				@endif

				@if ($room->south_rooms_id)
					<form method="post" action="/move" class="ajax">
						{{csrf_field()}}
						<input type="hidden" name="room_id" value="{{$room->south_rooms_id}}">
						<input type="hidden" name="character_id" value="{{$character->id}}">
						You can travel <label for="move_south">south</label>
						<input type="submit" id="move_south" style="display: none;">
					</form>
				@endif

				@if ($room->west_rooms_id)
					<form method="post" action="/move" class="ajax">
						{{csrf_field()}}
						<input type="hidden" name="room_id" value="{{$room->west_rooms_id}}">
						<input type="hidden" name="character_id" value="{{$character->id}}">
						You can travel <label for="move_west">west</label>
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
		console.log('main ajax submit fire');
		e.preventDefault();
		if ($(e.target).hasClass('event-fired'))
			{
			console.log($(e.target)[0].className.split(/\s+/));
			console.log('we already fired');
			// $(e.target).removeClass('event-fired');
			return true;
			}

		$(e.target).addClass('event-fired');

		var formData = new FormData(e.target);
		// console.log($(document.activeElement));
		if ($(document.activeElement).hasClass('submit-val'))
			{
			formData.append('submit', $(document.activeElement).val());
			}

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
					// '/combat',
					'/train',
					'/train_stat',
					'/rest'
					];
				var menu_inserts = [
					'/equipment',
					'/items'
					];
				// location.reload();
				// console.log(this);
				// console.log(this['url']);
				var replace = 'body';
				if (main_inserts.includes(this['url']))
					{
					replace = '.main';
					}
				if (menu_inserts.includes(this['url']))
					{
					replace = '.stats';
					}
				// console.log('replace:' + replace);
				$(replace).html(resp);
				}
			});
		// console.log('done?');
		});
	</script>

</body>

</html>