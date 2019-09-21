@extends('layouts.main')

@section('menu')
<div style="text-align: left;">
	<div style="color:#12a1df;">
	It is the <span style="color:#33ffee">{{App\World::cycle()}}</span> cycle in<br>
	the year of our lord <span style="color:#33ffee">{{App\World::year()}}</span><br>
	<br>
	@if ($online_count > 1)
	There are <span style="color:#33ffee">{{$online_count}}</span> active players online.
	@else
	There is <span style="color:#33ffee">{{$online_count}}</span> active player online.
	<br>
	Population: YOU
	@endif
	</div>
	<br><br>
	<span style="color: #00FFFF">
		<strong>Menu:</strong>
	</span>
	<form method="post" action="/menu" class="ajax">
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
	<form method="post" action="/food" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<label for="food">Food</label>
		<input type="submit" id="food" style="display: none;">
	</form>
	@if ($character->spells())
	<form method="post" action="/spells" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<label for="spells">Spells</label>
		<input type="submit" id="spells" style="display: none;">
	</form>	
	@endif
	<form method="post" action="/settings" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<label for="settings">Options</label>
		<input type="submit" id="settings" style="display: none;">
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

	@if( Session::has("errors") )
	<p style="color: red;display: inline;">
	{{ Session::pull("errors") }}
	<p>
	@endif

	@if( Session::has("flee") )
	<p>
	{{ Session::pull("flee") }}
	<p>
	@endif

	@if (Session::has('combat_log'))
	<p style="color: red;display: inline;">
	@foreach (Session::pull('combat_log') as $log_entry)
		{!! $log_entry !!}
	@endforeach
	</p>
	@endif
	@if (Session::has('reward_log'))
	<p style="color:red;display: inline;">
	@foreach (Session::pull('reward_log') as $log_entry)
		{{$log_entry}}<br>
	@endforeach
	</p>
	@endif

	@if ($room->zone()->darkness_level() > $character->light_level())
	<p style="color: red;">
		It is too dark, you cannot see anything!
	</p>
	@else

	<br>
	<div style="position: relative;">
	@if (isset($creature))
		<div style="display: inline-block;">
			@if ($creature->img_src)
			<img src="{{asset('img/'.$creature->img_src)}}">
			@else
			<img src="{{asset('img/unknown.jpg')}}">
			@endif
			<form method="post" action="/combat" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="room_id" value="{{$room->id}}">
				<input type="hidden" name="creature_id" value="{{$creature->id}}">
				<input type="hidden" name="character_id" value="{{$character->id}}">
				<table id="combat-table">
					<tr>
					</tr>
				</table>
				<script>
					combat_shuffle('{{$creature->name}}');
				</script>
			</form>
		</div>
		<div style="display: inline-grid;position:absolute;top:50%;transform: translateY(-50%);margin-left: .5rem;grid-template-columns: 1fr 1fr;">
			<div>
				Health: {{$character->health}} / {{$character->max_health}}<br>
				<progress value="{{$character->health}}" max="{{$character->max_health}}" class="stat-bar stat-bar-health {{ ($character->health <= ($character->max_health * .4)) ? '__low' : ''}}"></progress><br>
				Mana: {{$character->mana}} / {{$character->max_mana}}<br>
				<progress value="{{$character->mana}}" max="{{$character->max_mana}}" class="stat-bar stat-bar-mana"></progress><br>
				Fatigue: {{$character->fatigue}} / {{$character->max_fatigue}}<br>
				<progress value="{{$character->fatigue}}" max="{{$character->max_fatigue}}" class="stat-bar stat-bar-fatigue"></progress><br>
			</div>
			<div style="margin-left: 1rem;margin-top: 2rem;">
				<form method="get" action="/game/consider" class="ajax">
					{{csrf_field()}}
					<input type="hidden" name="room_id" value="{{$room->id}}">
					<input type="hidden" name="creature_id" value="{{$creature->id}}">
					<input type="hidden" name="character_id" value="{{$character->id}}">
					<label for="consider">Consider</label>
					<input type="submit" id="consider" style="display:none;">
				</form>
				@if( Session::has("consider") )
				<br>
				{{ Session::pull("consider") }}
				@endif
			</div>
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

	<!-- Watch out for bugs caused from the Session::pull call down below...  -->
	@if (Session::has('combat_timer'))
	<script>
		{{Session::pull('combat_timer')}}
		console.log('Adding timer');
		// $combatTimer = true;
		$timers.combat = setTimeout(function(e) {
			$('#single').closest('form').submit();
			}, 4000);
	</script>
	@endif

	@if (isset($room_custom))
	{!! $room_custom !!}
	@endif

	@if (!$creature && ($room->title || $room->description))
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

	@if (isset($quest_text))
	<p style="color:#3487D5">
		{!! nl2br($quest_text) !!}
	</p>
	@endif

	@if (Session::has('quest_text'))
	<p style="color:#3487D5">
		{!! nl2br(Session::pull('quest_text')) !!}
	</p>
	@endif

	@if ($room->has_property('CAN_SLEEP'))
	<form method="post" action="/rest" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		You can <label for="begin_rest">sleep</label> here.
		<input type="submit" id="begin_rest" style="display: none;">
	</form>
	@endif

	@if( Session::has("no_carry") )
	<span style="color:red;">{{Session::pull("no_carry")}}</span><br>
	@endif

	@if (isset($ground_items))
	@foreach ($ground_items as $ground_item)
	<form method="post" action="/item_pickup" class="ajax">
		<input type="hidden" name="room_id" value="{{$room->id}}">
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<input type="hidden" name="ground_item_id" value="{{$ground_item->id}}">
		<input type="hidden" name="no_spawn" value="true">
		You notice a <label for="pickup" tabindex="9">{{$ground_item->item()->name}}</label> just dropped.
		<input type="submit" id="pickup" style="display: none;">
	</form>
	@endforeach
	@endif

	<!-- Special actions? -->
	@if( Session::has("action_failed") )
	<p style="color:red;">{{ Session::pull("action_failed") }}</p>
	@endif
	@if( Session::has("action_success") )
	<p style="color:#55ff8b;">{{ Session::pull("action_success") }}</p>
	@endif
	@if (isset($special_actions))
	<form method="post" action="/room_action/attempt" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="room_id" value="{{$room->id}}">
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<input type="hidden" name="room_action_id" value="{{$special_actions->id}}">
		{!! $special_actions->show_action() !!}
		<input type="submit" id="room-action" style="display: none;">
	</form>
	@endif
	
	<p>
		{{$room->zone()->travel_text}}
	</p>
	@endif

	@if( Session::has("zone_travel") )
	<p style="color:red;">{{ Session::pull("zone_travel") }}</p>
	@endif

	@if ($creature && $creature->is_blocking)
	<p style="color:orange;">You must fight your way through this enemy to move again!</p>
	@else
	<p>
		@foreach ($directions as $col => $room_id)
		<form method="post" action="/move" class="ajax">
			{{csrf_field()}}
			<input type="hidden" name="room_id" value="{{$room_id}}">
			<input type="hidden" name="character_id" value="{{$character->id}}">
			You can travel <label for="move_{{$col}}" tabindex="10">{{ substr($col, 0, strpos($col, '_')) }}</label>
			<input type="submit" id="move_{{$col}}" style="display: none;">
		</form>
		@endforeach
	</p>
	@endif

	@if ($room->has_property('WALL_SCORE'))
		<table>
		@foreach ($score_list as $listing)
			<tr>
				<td>{!! $listing->display_name() !!}</td>
				<td>{{$listing->score}}</td>
				<td>{{ $listing->rank() }}</td>
				<td>{{$listing->race()->gender}}</td>
				<td>{{$listing->race()->name}}</td>
			</tr>
		@endforeach
		</table>
	@endif

	@if ($room->current_characters())
		@foreach ($room->current_characters() as $entry)
		@if ($entry->id != $character->id)
		@if ($entry->user()->isOnline())
		{!! $entry->display_name() !!} is here.<br>
		@endif
		@endif
		@endforeach
	@endif


	<!-- Debug -->
	@if (isset($is_admin) && $is_admin)
	<div style="padding-left: 1rem;">
		-- Admin --<br>
		Current Room: <a href="/room/edit/{{$room->id}}" target="_blank">{{$room->id}}</a>
		n: {{$room->north_rooms_id}}, e: {{$room->east_rooms_id}}, s: {{$room->south_rooms_id}}, w: {{$room->west_rooms_id}}, ne: {{$room->northeast_rooms_id}}, nw: {{$room->northwest_rooms_id}}, se: {{$room->southeast_rooms_id}}, sw: {{$room->southwest_rooms_id}}, u: {{$room->up_rooms_id}}, d: {{$room->down_rooms_id}}<br>
		-- Performance --<br>
		@if (Session::has('perf_log'))
		<p style="">
		@foreach (Session::pull('perf_log') as $log_entry)
			{!! $log_entry !!}<br>
		@endforeach
		</p>
		@endif
	</div>
	@endif
@endsection

@section('footer')
	@if ($chat)
	<div>
		<h3 style="display: inline-block;">{{$chat->name}}</h3>
		<form method="post" action="/footer" class="ajax" style="display: inline-block;">
			<label for="refresh-chat" class="fas fa-sync"> Refresh</label>
			<input type="submit" id="refresh-chat" value="Refresh" style="display:none;">
			<input type="hidden" name="chat_rooms_id" value="{{$chat->id}}">
			<input type="hidden" name="characters_id" value="{{$character->id}}">
			{{csrf_field()}}
		</form><br>
		<table class="chat-room">
			@if ($chat->messages()->count() > 0)
			@foreach ($chat->messages() as $message)
			<tr>
				<td class="fit-width">{!! $message->character()->display_name() !!}</td>
				<td class="fit-width">{{$message->created_date()}} {{$message->created_time()}}</td>
				<td>{!! $message->message !!}</td>
			</tr>
			@endforeach
			@else
			<h5>Looks like there are no messages here!</h5>
			@endif
		</table>
	</div>
	<form method="post" action="/chat/message" class="ajax">
		<input type="text" name="message" placeholder="Type a message here!">
		<input type="submit" value="Send">
		<input type="hidden" name="chat_rooms_id" value="{{$chat->id}}">
		<input type="hidden" name="characters_id" value="{{$character->id}}">
		{{csrf_field()}}
	</form>
	@endif

	<!-- Debug section -->

	@if (auth()->user()->admin_level > 0)

		@if (isset($combat))
		{{$combat->id}} {{$combat->remaining_health}}
		@endif

		Current weight: {{$character->inventory()->current_weight()}} / {{$character->inventory()->max_weight()}}<br>

		@foreach ($character->inventory()->character_items() as $item)
			{{$item->id}}: {{$item->items_id}} -- {{$item->item()->name}}, {{$item->item()->item_types_id}} ({{$item->quantity}})<br>
		@endforeach
	@endif
@endsection