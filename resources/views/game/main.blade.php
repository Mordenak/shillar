@extends('layouts.main')

@section('menu')
<div style="text-align: left;">
	It is the 200th cycle in<br>
	the year of our lord 505?<br>
	<br>
	There is 1 active players online.
	<br><br>
	Menu:
	<form method="post" action="/game" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<label for="back_home">Menu</label>
		<input type="submit" id="back_home" style="display: none;">
	</form>
	<form method="post" action="/show_stats" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<label for="stats">Stats</label>
		<input type="submit" id="stats" style="display: none;">
	</form>
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
		<label for="back_home">Settings</label>
		<input type="submit" id="back_home" style="display: none;">
	</form>
	<br><br>
	<form method="get" action="/home">
		{{csrf_field()}}
		<label for="char_select">Logout</label>
		<input type="submit" id="char_select" style="display: none;">
	</form>
</div>
@endsection

@section('main')
	@if (isset($combat_log))
	<p style="color: red;display: inline;">
	@foreach ($combat_log as $log_entry)
		@if (!auth()->user()->short_mode)
		{{$log_entry['attack_text']}}<br>
		@if ($log_entry['no_fatigue'])
		You are too tired to attack.<br>
		@else
		You made attacks {{$log_entry['attack_count']}} and missed {{$log_entry['miss_count']}} times.<br>
		You did {{$log_entry['round_damage']}} damage.<br>
		@endif
		@if ($log_entry['npc_round'] > 0)
		{{$log_entry['npc_text']}}, doing {{$log_entry['npc_round']}} damage.<br>
		@endif

		@if (isset($log_entry['pc_died']))
		You have died!</br>
		<form method="post" action="/game">
			{{csrf_field()}}
			<input type="hidden" name="character_id" value="{{$character->id}}">
			<input type="submit" value="Continue">
		</form>
		@endif
		@else

		@endif
	@endforeach
	</p>
	@endif
	@if (isset($reward_log))
	<p style="display: inline;">
	@foreach ($reward_log as $log_entry)
		{{$log_entry}}<br>
	@endforeach
	</p>
	@endif

	@if (isset($death))
	<p style="color: red;display: inline;">
		You have died.
	</p>
	@endif


	<br>
	<div style="position: relative;">
	@if (isset($npc))
		<div style="display: inline-block;">
			@if ($npc->img_src)
			<img src="{{asset('img/'.$npc->img_src)}}">
			@else
			<img src="{{asset('img/unknown.jpg')}}">
			@endif
			<form method="post" action="/combat" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="room_id" value="{{$room->id}}">
				<input type="hidden" name="npc_id" value="{{$npc->id}}">
				<input type="hidden" name="character_id" value="{{$character->id}}">
				@if (!$no_attack)
				<table id="combat-table">
					<tr>
<!-- 						<td style="color:yellow;">
							<div>All Out Attack</div>
							<div><input type="submit" id="all_out" value="{{$npc->name}}" class="submit-id"></div>
						</td>
						<td style="color:#55ff8b;">
							<div>Single Attack</div>
							<div><input type="submit" id="single" value="{{$npc->name}}" class="submit-id"></div>
						</td>
						<td style="color:red;">
							<div>Run Away</div>
							<div><input type="submit" id="flee" value="{{$npc->name}}" class="submit-id"></div>
						</td> -->
					</tr>
				</table>
				<script>
					// TODO: OPTIMIZE!!!
					var $options = {
						all_out: 'All Out Attack',
						single: 'Single Attack',
						flee: 'Run Away'
					}

					var npc = '{{$npc->name}}';

					var $new_options = shuffle($options);

					for (var key in $new_options)
						{
						if (Math.random() > 0.5)
							{
							$('#combat-table tr').append($new_options[key]+'<br>');
							$('#combat-table tr').append($('<input/>', {type: 'submit', id: key, "class": 'submit-id', value: npc}));
							}
						else
							{
							$('#combat-table tr').append($('<input/>', {type: 'submit', id: key, "class": 'submit-id', value: npc}));
							$('#combat-table tr').append($new_options[key]+'<br>');
							}
						}

				</script>
				@else
				<span style="color:red;">You are too tired to attack</span>
				@endif
			</form>
		</div>
		<div style="display: inline-block;position:absolute;top:50%;transform: translateY(-50%);margin-left: .5rem;">
			Health: {{$character->health}} / {{$character->max_health}}<br>
			<progress value="{{$character->health}}" max="{{$character->max_health}}" class="stat-bar stat-bar-health {{ ($character->health <= ($character->max_health * .4)) ? '__low' : ''}}"></progress><br>
			Mana: {{$character->mana}} / {{$character->max_mana}}<br>
			<progress value="{{$character->mana}}" max="{{$character->max_mana}}" class="stat-bar stat-bar-mana"></progress><br>
			Fatigue: {{$character->fatigue}} / {{$character->max_fatigue}}<br>
			<progress value="{{$character->fatigue}}" max="{{$character->max_fatigue}}" class="stat-bar stat-bar-fatigue"></progress><br>
		</div>
	@else
		@if ($room->img_src)
		<img src="{{asset('img/'.$room->img_src)}}">
		@else
			@if ($room->zone()->img_src)
			<img src="{{asset('img/'.$room->zone()->img_src)}}">
			@endif
		@endif
	@endif
	</div>

	@if (isset($timer))
	<script>
		console.log('Adding timer');
		// $combatTimer = true;
		$timers.combat = setTimeout(function(e) {
			$('#single').click();
			}, 4000);
	</script>
	@endif

	@if (isset($room_custom))
	{!! $room_custom !!}
	@endif

	@if (!$npc && ($room->title || $room->description))
	<p>
		@if ($room->title)
		{{$room->title}}
		@endif
		<br>
		@if ($room->description)
		{{$room->description}}
		@endif
	</p>
	@endif

	<p>
		{{$room->zone()->description}}
	</p>

	@if ($room->has_property('CAN_SLEEP'))
	<form method="post" action="/rest" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		You can <label for="begin_rest">sleep</label> here.
		<input type="submit" id="begin_rest" style="display: none;">
	</form>
	@endif


	<!-- Do the loot: -->
	@if (isset($no_carry))
	<span style="color:red;">You cannot carry anymore!</span><br>
	@endif
	@if (isset($ground_items))
	@foreach ($ground_items as $ground_item)
	<form method="post" action="/item_pickup" class="ajax">
		<input type="hidden" name="room_id" value="{{$room->id}}">
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<input type="hidden" name="item_id" value="{{$ground_item->id}}">
		<input type="hidden" name="no_spawn" value="true">
		You notice a <label for="pickup">{{$ground_item->name}}</label> just dropped.
		<input type="submit" id="pickup" style="display: none;">
	</form>
	@endforeach
	@endif
	
	<p>
		@if ($room->up_rooms_id)
			<form method="post" action="/move" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="room_id" value="{{$room->up_rooms_id}}">
				<input type="hidden" name="character_id" value="{{$character->id}}">
				You can travel <label for="move_up">up</label>
				<input type="submit" id="move_up" style="display: none;">
			</form>
		@endif

		@if ($room->down_rooms_id)
			<form method="post" action="/move" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="room_id" value="{{$room->down_rooms_id}}">
				<input type="hidden" name="character_id" value="{{$character->id}}">
				You can travel <label for="move_down">down</label>
				<input type="submit" id="move_down" style="display: none;">
			</form>
		@endif

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

	@if ($room->has_property('WALL_SCORE'))
		<table>
		@foreach ($score_list as $listing)
			<tr>
				<td>{!! $listing->display_name() !!}</td>
				<td>{{$listing->score}}</td>
				<td>{{ $listing->rank() }}</td>
				<td>{{$listing->playerrace()->gender}}</td>
				<td>{{$listing->playerrace()->name}}</td>
			</tr>
		@endforeach
		</table>
	@endif

	@if ($room->current_characters())
		@foreach ($room->current_characters() as $entry)
		@if ($entry->id != $character->id)
		{!! $entry->display_name() !!} is here.<br>
		@endif
		@endforeach
	@endif


	<!-- Debug -->
	@if ($is_admin)
	<div style="padding-left: 1rem;">
		-- Admin --<br>
		Current Room: <a href="/room/edit/{{$room->id}}" target="_blank">{{$room->id}}</a>
		n: {{$room->north_rooms_id}}, e: {{$room->east_rooms_id}}, s: {{$room->south_rooms_id}}, w: {{$room->west_rooms_id}}, u: {{$room->up_rooms_id}}, d: {{$room->down_rooms_id}}<br>
	</div>
	@endif
@endsection

@section('footer')
	A chat?

	<!-- Debug section -->

	@if ($is_admin)

		@if (isset($combat))
		{{$combat->id}} {{$combat->remaining_health}}
		@endif

		Current weight: {{$character->inventory()->currentWeight()}} / {{$character->inventory()->max_weight}}<br>

		@foreach ($character->inventory()->character_items() as $item)
			{{$item->id}}: {{$item->items_id}} -- {{$item->item()->name}}, {{$item->item()->item_types_id}} ({{$item->quantity}})<br>
		@endforeach
	@endif
@endsection