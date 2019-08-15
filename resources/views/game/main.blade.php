@extends('layouts.main')

@section('menu')
	<header>{{ $character->name }}, {{$character->playerrace->gender}} {{$character->playerrace->name}}</header>
	<ul>
		<li>XP: {{$stats->xp}}</li>
		<li>Gold: {{$stats->gold}}</li>
	</ul>
	<strong> -- Stats -- </strong>
	<ul>
		<li>Strength: {{$stats->strength}}</li>
		<li>Dexterity: {{$stats->dexterity}}</li>
		<li>Constitution: {{$stats->constitution}}</li>
		<li>Wisdom: {{$stats->wisdom}}</li>
		<li>Intelligence: {{$stats->intelligence}}</li>
		<li>Charisma: {{$stats->charisma}}</li>
		<br>
		<li>Score: {{$stats->score}}</li>
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
@endsection

@section('main')
	@if (isset($combat_log))
	<p style="color: red;display: inline;">
	@foreach ($combat_log as $log_entry)
		{{$log_entry}}<br>
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
	@if ($npc)
		<div style="display: inline-block;">
			@if ($npc->img_src)
			<img width="250" height="250" src="{{asset('img/'.$npc->img_src)}}">
			@else
			<img width="250" height="250" src="{{asset('img/unknown.jpg')}}">
			@endif
			<form method="post" action="/combat" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="room_id" value="{{$room->id}}">
				<input type="hidden" name="npc_id" value="{{$npc->id}}">
				<input type="hidden" name="character_id" value="{{$character->id}}">
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
		<div style="display: inline-block;position:absolute;top:50%;transform: translateY(-50%);margin-left: .5rem;">
			Health: {{$stats->health}} / {{$stats->max_health}}<br>
			<progress value="{{$stats->health}}" max="{{$stats->max_health}}" class="stat-bar stat-bar-health {{ ($stats->health <= ($stats->max_health * .4)) ? '__low' : ''}}"></progress><br>
			Mana: {{$stats->mana}} / {{$stats->max_mana}}<br>
			<progress value="{{$stats->mana}}" max="{{$stats->max_mana}}" class="stat-bar stat-bar-mana"></progress><br>
			Fatigue: {{$stats->fatigue}} / {{$stats->max_fatigue}}<br>
			<progress value="{{$stats->fatigue}}" max="{{$stats->max_fatigue}}" class="stat-bar stat-bar-fatigue"></progress><br>
		</div>
	@else
		<div style="display: inline-block;margin-left: .5rem;">
			Health: {{$stats->health}} / {{$stats->max_health}}<br>
			<progress value="{{$stats->health}}" max="{{$stats->max_health}}" class="stat-bar stat-bar-health {{ ($stats->health <= ($stats->max_health * .4)) ? '__low' : ''}}"></progress><br>
			Mana: {{$stats->mana}} / {{$stats->max_mana}}<br>
			<progress value="{{$stats->mana}}" max="{{$stats->max_mana}}" class="stat-bar stat-bar-mana"></progress><br>
			Fatigue: {{$stats->fatigue}} / {{$stats->max_fatigue}}<br>
			<progress value="{{$stats->fatigue}}" max="{{$stats->max_fatigue}}" class="stat-bar stat-bar-fatigue"></progress><br>
		</div>
	@endif
	</div>
	
	<br>

	<p>
		{{$room->zone()->description}}
	</p>

	<!-- Do the loot: -->
	@if (isset($ground_items))
	@foreach ($ground_items as $ground_item)
	<form method="post" action="/item_pickup" class="ajax">
		<input type="hidden" name="room_id" value="{{$room->id}}">
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<input type="hidden" name="item_id" value="{{$ground_item->id}}">
		<input type="hidden" name="no_spawn" value="true">
		A <label for="pickup">{{$ground_item->name}}</label> is here.
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
@endsection

@section('footer')
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

	@foreach ($character->inventory()->character_items() as $item)
		{{$item->id}}: {{$item->items_id}} -- {{$item->item()->name}}, {{$item->item()->item_types_id}} ({{$item->quantity}})<br>
	@endforeach
@endsection