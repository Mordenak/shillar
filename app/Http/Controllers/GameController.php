<?php

namespace App\Http\Controllers;

// Lol, what is going on here:
use Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\{User, Character, Race, Room, Creature, SpawnRule, RewardTable, LootTable, StatCost, RaceStatAffinity, Equipment, Item, ItemWeapon, ItemArmor, ItemAccessory, ItemFood, CharacterSetting, CombatLog, KillCount,InventoryItem, Shop, ShopItem, ForgeRecipe, TraderItem, CharacterSpell, CharacterSpellBuff, Spell, Quest, QuestTask, QuestCriteria, QuestReward, CharacterQuest, CharacterQuestCriteria, RoomAction, CharacterRoomAction, ChatRoom, ChatRoomMessage, Alignment, World, TeleportTarget, GroundItem, GroundItemToItemProperty, InventoryItemToItemProperty, ItemProperty, CreatureKill, Graveyard};

class GameController extends Controller
	{

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function home(Request $request)
		{
		if (!auth()->user())
			{
			return redirect('/');
			}

		$Characters = Character::where('users_id', auth()->user()->id);
		$request->session()->forget('character_id');
		return view('home', ['characters' => $Characters->get(), 'admin_level' => auth()->user()->admin_level]);
		}

	public function character_select(Request $request)
		{
		if (!auth()->user())
			{
			return redirect('/');
			}

		$character_id = $request->character_id;

		Session::put('character_id', $character_id);
		// $request->session()->put('character_id', $character_id);
		// Session::put('block_spawn', true);

		return redirect('/game');
		// return $this->index($request);
		}

	public function index(Request $request)
		{
		$timers = [];
		$start_timer = microtime(true);
		$this->start_timer('index');
		// Offload to a Worker?
		World::tick();
		CharacterSpellBuff::clean_buffs();
		// TODO: This should be unreachable?
		if (!auth()->user())
			{
			return redirect('/home');
			}

		$user_id = auth()->user()->id;

		// Rework of the initial game/login pieces.  Now character id is pulled from the session
		// now instead of POSTed to /game.  This allows /game to be a GET route instead, allowing
		// refresh to actually work
		$character_id = Session::get('character_id');
		// $character_id = $request->session()->get('character_id');

		if (!$character_id)
			{
			return redirect('/home');
			}

		// Make sure the current user matches the expected character.
		$Character = Character::where('id', $character_id)->where('users_id', $user_id)->first();
		$request->character_id = $Character->id;

		if (!$Character)
			{
			return redirect('/home');
			}

		// die(print_r($Character->toArray()));

		// TODO: The next 4 lines are a HUGE performance hit:
		// $Character->calc_quick_stats();
		// if ($Character->health <= 0)
		// 	{
		// 	return $this->death($request);
		// 	}
		
		$Room = Room::findOrFail($Character->last_rooms_id);
		$CombatCheck = CombatLog::where(['characters_id' => $Character->id, 'rooms_id' => $Room->id]);
		if ($CombatCheck->count() > 0)
			{	
			$CombatLog = CombatLog::where(['characters_id' => $Character->id, 'rooms_id' => $Room->id])->first();
			}
		$Zone = $Room->zone();

		if ($Character->health <= 0)
			{
			// $request->creature_kill = Session::get('creature_death');
			// die(print_r($request->creature_kill));
			$request->rooms_id = $Room->id;
			return $this->death($request);
			}

		$request_params = ['character' => $Character, 'room' => $Room];

		$request_params['current_time'] = World::getDateStringWithOffset();

		// Get the current background scheme:
		$color_scheme = $Room->get_color_scheme();
		$request_params['color_scheme'] = $color_scheme;
		
		// TODO: Spawn code, refactor?
		$Creature = null;
		// Block spawn in certain events:
		if (Session::has('creature.'.$Room->id))
			{
			// die('creature');
			$Creature = Creature::where(['id' => Session::get('creature.'.$Room->id)])->first();
			Session::get('creature.'.$Room->id);
			}

		if ($Creature || Session::has('block_spawn'))
			{
			// Clear it:
			// die('blocking spawns');
			Session::pull('block_spawn');
			}
		else
			{
			// Can room spawn?
			if ($Room->spawns_enabled)
				{
				$Creature = $this->spawn_creature($Room, $Character);
				if ($Creature)
					{
					Session::put('creature.'.$Room->id, $Creature->id);
					}
				}
			}

		$check_aggro = $Zone->get_property('HOSTILE_PER_CREATURE_KILL');
		if ($check_aggro)
			{
			$check = $check_aggro->decode();
			// Check Character kill counts?
			if ($Character->kill_count($check['creature_id']))
				{
				$current_count = $Character->kill_count($check['creature_id'])->count;
				$required_stat = floor($current_count * $check['multiplier']);
				// die(print_r($required_stat));
				if ($Character->get_stat($check['stat']) < $required_stat)
					{
					if ($Creature && !isset($CombatLog))
						{
						// Everything is aggro:
						$request->character_id = $Character->id;
						$request->room_id = $Room->id;
						$request->creature_id = $Creature->id;
						$request->submit = "single_attack";
						return $this->combat($request);
						}
					}
				}
			}

		$ground_items = [];
		$GroundItems = GroundItem::where(['rooms_id' => $Room->id])->orderby('id')->get();
		foreach ($GroundItems as $GroundItem)
			{
			if (time() >= $GroundItem->expires_on)
				{
				if ($GroundItem->properties()->count() > 0)
					{
					$GroundItem->properties()->delete();
					}
				$GroundItem->delete();
				continue;
				}

			if ($GroundItem->characters_id === $Character->id)
				{
				// Then show it:
				$ground_items[] = $GroundItem;
				}
			}

		$request_params['creature'] = $Creature;
		$request_params['ground_items'] = $ground_items;

		if ($Zone->bg_img)
			{
			$request_params['bg_src'] = asset('bgs/' . $Zone->bg_img);
			}

		if ($Zone->bg_color)
			{
			$request_params['bg_color'] = $Zone->bg_color;
			}

		// TODO: Refactor chat code so it's not required in both this place and the footer
		$request_params['available_chatrooms'] = $Character->get_available_chat_rooms();
		$ChatRoom = ChatRoom::findOrFail($Character->settings()->selected_chat_rooms_id);
		$request_params['chat'] = $ChatRoom;

		// TODO: This could be BAD!
		// users online?
		$Users = User::all();
		$online = 0;
		foreach ($Users as $User)
			{
			if ($User->isOnline())
				{
				$online++;
				}
			}
		$request_params['online_count'] = $online;

		// TODO: Can we get rid of this yet???
		if ($request->death)
			{
			$request_params['death'] = true;
			}

		if (isset(auth()->user()->admin_level) && auth()->user()->admin_level > 0)
			{
			$request_params['is_admin'] = true;
			if (Session::has('admin_killsim'))
				{
				$request_params['killsim_setting'] = Session::get('admin_killsim');
				}
			}

		$request_params['room_custom'] = null;
		if ($Room->has_property())
			{
			// Set specific room properties?
			if ($Room->has_property('CAN_TRAIN'))
				{
				$request_params['multi'] = $request->train_multi ? $request->train_multi : 1;
				$request_params['costs'] = $this->calculate_training_cost($request);
				}

			if ($Room->has_property('CAN_TRAIN_SPELLS'))
				{
				$request_params['spells'] = Spell::where('rooms_id', $Room->id)->get();
				$request_params['multi'] = $request->train_multi ? $request->train_multi : 1;
				// $Spells = Spell::where('rooms_id', $request->rooms_id)->get();
				// die(print_r($request_params['spells']->toArray()));
				$request->rooms_id = $Room->id;
				$request_params['costs'] = $this->calculate_spell_training_cost($request);
				}

			if ($Room->has_property('WALL_OF_FLAME'))
				{
				$Results = Character::select()->orderBy('score', 'desc')->get();
				$request_params['score_list'] = $Results;
				}

			if ($Room->has_property('HAS_KILL_LOG'))
				{
				$Results = KillCount::where(['characters_id' => $Character->id])->get();
				$request_params['kill_list'] = $Results;
				}

			if ($Room->has_property('HAS_GRAVEYARD'))
				{
				$Results = Graveyard::all();
				$request_params['graves'] = $Results;
				}

			// Make the view:
			// $view_to_render = $Room->property()->custom_view;
			// die(print_r($view_to_render));
			if ($Room->property()->custom_view)
				{
				$view = \View::make($Room->property()->custom_view, $request_params);
				$request_params['room_custom'] = $view->render();
				}
			}

		// Shops are a special case:
		if ($Room->has_shop())
			{
			$request_params['shop'] = $Room->shop();
			$view = \View::make('partials/shop', $request_params);
			$request_params['room_custom'] = $view->render();
			}

		if ($Room->has_trader())
			{
			$request_params['trader'] = $Room->trader();
			$request_params['trader_items'] = $Character->get_trader_items();
			$view = \View::make('partials/trader', $request_params);
			$request_params['room_custom'] = $view->render();
			}

		// And now the extra special stuff -- there could be multiples:
		$RoomAction = RoomAction::where(['rooms_id' => $Room->id])->first();
		if ($RoomAction)
			{
			if ($RoomAction->remember)
				{
				$CharacterRoomAction = CharacterRoomAction::where(['characters_id' => $Character->id, 'room_actions_id' => $RoomAction->id])->first();
				if (!$CharacterRoomAction)
					{
					$request_params['special_actions'] = $RoomAction;
					}
				}
			else
				{
				$request_params['special_actions'] = $RoomAction;
				}
			}

		// Quest Stuff?
		// TODO: A room could have multiples, but only 1 ever should be "available" per requirements:
		$PickupQuests = Quest::where(['pickup_rooms_id' => $Room->id])->get();
		if ($PickupQuests->count() > 0)
			{
			foreach ($PickupQuests as $PickupQuest)
				{
				// Character already has it?
				$CharacterQuest = CharacterQuest::where(['characters_id' => $Character->id, 'quests_id' => $PickupQuest->id])->first();

				if (!$CharacterQuest)
					{
					// Don't already have it -- can we get it?
					if ($PickupQuest->eligible($Character))
						{
						// Get it!
						$CharacterQuest = new CharacterQuest;
						$CharacterQuest->fill(['characters_id' => $Character->id, 'quests_id' => $PickupQuest->id]);
						$CharacterQuest->save();
						// Also the criterias?
						foreach ($PickupQuest->criterias() as $criteria)
							{
							$CharacterQuestCriteria = new CharacterQuestCriteria;
							$CharacterQuestCriteria->fill(['characters_id' => $Character->id, 'quest_criterias_id' => $criteria->id, 'character_quests_id' => $CharacterQuest->id, 'progress' => 0, 'complete' => false]);
							$CharacterQuestCriteria->save();
							}
						$request_params['quest_text'] = $PickupQuest->pickup_message;
						// One quest at time please!
						break;
						}
					}
				}
			}

		// Is room a target for a quest task?
		// TODO: Refactor
		$QuestCriterias = QuestCriteria::where(['room_target' => $Room->id])->get();
		if ($QuestCriterias->count() > 0)
			{
			// die('found it');
			foreach ($QuestCriterias as $QuestCriteria)
				{
				// This room is used for a task... Does the character have it?
				$CharacterQuestCriteria = CharacterQuestCriteria::where(['characters_id' => $Character->id, 'quest_criterias_id' => $QuestCriteria->id, 'complete' => false])->first();

				if ($CharacterQuestCriteria)
					{
					// die(print_r($CharacterQuestCriteria->criteria()->task()->all()));
					// Unless...
					if ($Creature && $Creature->is_blocking)
						{
						// Wait...
						}
					else
						{
						// Let's complete it!
						// die('yes');
						$CharacterQuestCriteria->complete();
						}
					}
				}
			}

		$TurninQuest = Quest::where(['turnin_rooms_id' => $Room->id])->first();
		if ($TurninQuest)
			{
			$CharacterQuest = CharacterQuest::where(['characters_id' => $Character->id, 'quests_id' => $TurninQuest->id])->first();

			if ($CharacterQuest)
				{
				// Just a quick refresh
				$CharacterQuest->check_completes();
				// die(print_r($CharacterQuest));
				if ($CharacterQuest->complete && !$CharacterQuest->rewarded)
					{
					$this->reward_character($CharacterQuest, $Character);
					// $request_params['quest_text'] = $TurninQuest->completion_message;
					// Hand out reward... *IF* we haven't already!
					}
				}
			// Something is turned in at this room:
			// die('turn in?');
			}

		// Directions:
		if ($Room)
			{
			$request_params['directions'] = $Room->generate_directions($Character);
			}

		$finish_timer = round(microtime(true) - $start_timer, 3) * 1000;
		// $timers[] = "index took:: $finish_timer ms";
		// Session::push('perf_log', $timers);
		// Session::push('perf_log', ['index' => $finish_timer]);
		$this->end_timer('index');

		// $character = array_merge($Character->pluck(), $Characters->pluck());;
		if ($request->ajax())
			{
			$view = \View::make('game/main', $request_params);
			$sections = $view->renderSections();
			return $sections;
			}
		return view('game/main', $request_params);
		}

	public function spawn_creature($room, $character)
		{
		$possible_spawns = [];
		// Get all possible spawns:
		$SpawnRules = SpawnRule::where(['rooms_id' => $room->id])
			->orWhere(['zones_id' => $room->zone()->id])
			->where(['zone_areas_id' => $room->zone_areas_id]);

		// $SpawnRules = SpawnRule::where(['zones_id' => $room->zone()->id]);

		// die(print_r($SpawnRules->get()));

		if ($room->zone_area())
			{
			// die(print_r($room->zone_area()));
			// $SpawnRules->orWhere(['zone_areas_id' => $room->zone_area()->id]);
			// ->orderBy('priority', 'desc')->get();
			}

		$SpawnRules->orderBy('priority', 'desc')
			->orderBy('rooms_id', 'asc')
			->orderBy('zone_areas_id', 'asc')
			->orderBy('zones_id', 'asc');

		// die(print_r($SpawnRules->get()));

		foreach ($SpawnRules->get() as $SpawnRule)
			{
			if ($SpawnRule->creatures_id)
				{
				if ($character->score >= $SpawnRule->score_req)
					{
					if ($SpawnRule->zone_level !== null && $SpawnRule->zone_level != $room->zone_level)
						{
						continue;
						}
					$prob = rand() / getrandmax();
					if ($prob <= $SpawnRule->chance)
						{
						return $SpawnRule->creature();
						}
					}
				}
			elseif ($SpawnRule->creature_groups_id)
				{
				// TODO: Zone Level restrictions on groups?
				if ($SpawnRule->zone_level !== null)
					{
					if ($SpawnRule->zone_level == $room->zone_level)
						{
						return $SpawnRule->creature_group()->generate_creature();
						}
					}
				else
					{
					return $SpawnRule->creature_group()->generate_creature();
					}
				}
			}
		}

	public function menu(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);

		$request_params = ['character' => $Character];

		// TODO: This could be BAD!
		// users online?
		$Users = User::all();
		$online = 0;
		foreach ($Users as $User)
			{
			if ($User->isOnline())
				{
				$online++;
				}
			}
		$request_params['online_count'] = $online;
		// return $this->index($request);
		if ($request->ajax())
			{
			// $this->index($request)
			$view = \View::make('partials/menu', $request_params);
			$sections = $view->renderSections();
			return $sections['menu'];
			}

		return view("partials/menu", $request_params);
		// return view('game/main', $request_params);
		}

	public function change_chat_room(Request $request)
		{
		$Character = Character::findOrFail($request->characters_id);

		$CharacterSetting = CharacterSetting::findOrFail(['characters_id' => $Character->id])->first();

		$request_params = ['character' => $Character];
		$ChatRoom = ChatRoom::findOrFail($request->chatroom);

		$CharacterSetting->selected_chat_rooms_id = $ChatRoom->id;
		$CharacterSetting->save();

		return $this->footer($request);
		}

	public function footer(Request $request)
		{
		$Character = Character::findOrFail($request->characters_id);

		$request_params = ['character' => $Character];
		$ChatRoom = ChatRoom::findOrFail($Character->settings()->selected_chat_rooms_id);

		$request_params['available_chatrooms'] = $Character->get_available_chat_rooms();

		$request_params['chat'] = $ChatRoom;

		// TODO: This could be BAD!
		// users online?
		$Users = User::all();
		$online = 0;
		foreach ($Users as $User)
			{
			if ($User->isOnline())
				{
				$online++;
				}
			}
		$request_params['online_count'] = $online;
		// return $this->index($request);
		if ($request->ajax())
			{
			// $this->index($request)
			$view = \View::make('partials/footer', $request_params);
			return $view->render();
			}

		return view("partials/footer", $request_params);
		// return view('game/main', $request_params);
		}


	public function move(Request $request)
		{
		$timers = [];
		$start_timer = microtime(true);
		// Session::put('perf_log', $timers);
		$Character = Character::findOrFail($request->character_id);
		$NextRoom = Room::findOrFail($request->room_id);

		// Just double check that the room is reachable from where the character is currently?
		$CurrentRoom = Room::findOrFail($Character->last_rooms_id);
		if (!$CurrentRoom->is_reachable($request->room_id))
			{
			// Don't move:
			return $this->index($request);
			}

		// Is a Zone transition?
		if ($CurrentRoom->zones_id != $NextRoom->zones_id)
			{
			// TODO: Tweak has_restriction()
			if ($NextRoom->zone()->get_stat_restriction())
				{
				// die('yes');
				if (!$Character->can_access($NextRoom->zone()))
					{
					Session::flash('zone_travel', 'You cannot go that way yet, you must train some more.');
					// die(var_dump($request->server));
					return $this->index($request);
					}
				}
			$item_restriction = $NextRoom->zone()->get_item_restriction();
			if ($item_restriction)
				{
				$res = $item_restriction->decode();
				$item_id = key($res);
				if (!$Character->inventory()->has_item($item_id))
					{
					$Item = Item::findOrFail($item_id);
					Session::flash('zone_travel', 'You must possess a '.$Item->name.' to enter this area!');
					return $this->index($request);
					}
				}
			}
		// SWIM / FLY Check?
		if ($NextRoom->zone()->has_property('REQUIRES_FLYING'))
			{
			$prop = $NextRoom->zone()->get_property('REQUIRES_FLYING')->decode();
			// Determine if player can fly?
			if ($Character->has_modifier('CAN_FLY') || $Character->inventory()->has_item_property('GRANTS_FLYING'))
				{
				// Then they can proceed:
				}
			else
				{
				// if not, determine where to put the player:
				if ($prop['drop_room'])
					{
					// This is single designated room:
					$Character->last_rooms_id = $prop['drop_room'];
					$Character->save();

					// Fall damage?
					$damage = $Character->receive_pure_damage(10);

					// Add message?
					Session::flash('zone_travel', "You fall through the sky and crash to the ground taking $damage damage.");
					return $this->index($request);
					}
				}
			}

		if ($NextRoom->zone()->has_property('REQUIRES_SWIMMING'))
			{
			$prop = $NextRoom->zone()->get_property('REQUIRES_SWIMMING')->decode();
			// Determine if player can fly?
			if ($Character->has_modifier('CAN_SWIM') || $Character->inventory()->has_item_property('GRANTS_SWIMMING'))
				{
				// Then they can proceed:
				}
			else
				{
				Session::flash('zone_travel', 'To go that direction you would need to be able to swim!');
				return $this->index($request);
				}
			}

		// Heat damage?
		if ($NextRoom->zone()->has_property('HEAT_DAMAGE'))
			{
			$prop = $NextRoom->zone()->get_property('HEAT_DAMAGE')->decode();
			if ($prop['begin'] == 0 && $prop['end'] == 0)
				{
				// Always take damage:
				$damage_taken = $Character->receive_heat_damage($prop['amount']);
				if ($damage_taken > 0)
					{
					Session::flash('zone_travel', "The heat saps away your life for $damage_taken points.");
					}
				}
			else
				{
				// Figure out the times:
				$current_hour = World::getDateWithOffset(7)->format('H');
				if ($current_hour >= $prop['begin'] && $current_hour <= $prop['end'])
					{
					// Take damage:
					$damage_taken = $Character->receive_heat_damage($prop['amount']);
					if ($damage_taken > 0)
						{
						Session::flash('zone_travel', "The heat saps away your life for $damage_taken points.");
						}
					}
				}
			}

		// Cold damage?
		if ($NextRoom->zone()->has_property('COLD_DAMAGE'))
			{
			$prop = $NextRoom->zone()->get_property('COLD_DAMAGE')->decode();
			if ($prop['begin'] == 0 && $prop['end'] == 0)
				{
				// Always take damage:
				$damage_taken = $Character->receive_cold_damage($prop['amount']);
				if ($damage_taken > 0)
					{
					Session::flash('zone_travel', "The cold freezes you to the bone for $damage_taken life points.");
					}
				}
			else
				{
				// Figure out the times:
				// $current_hour = now()->format("H");
				$current_hour = World::getDateWithOffset(7)->format('H');
				if ($current_hour >= $prop['begin'] && $current_hour <= $prop['end'])
					{
					// Take damage:
					$damage_taken = $Character->receive_cold_damage($prop['amount']);
					if ($damage_taken > 0)
						{
						Session::flash('zone_travel', "The cold freezes you to the bone for $damage_taken life points.");
						}
					}
				}
			}

		// We made it
		// TODO: Refactor
		$QuestCriteria = QuestCriteria::where(['zone_target' => $NextRoom->zones_id])->first();
		if ($QuestCriteria)
			{
			// This zone is used for a task... Does the character have it?
			$CharacterQuestCriteria = CharacterQuestCriteria::where(['characters_id' => $Character->id, 'quest_criterias_id' => $QuestCriteria->id, 'complete' => false])->first();
			if ($CharacterQuestCriteria)
				{
				// Let's complete it!
				$CharacterQuestCriteria->complete();
				}
			}

		$Character->last_rooms_id = $request->room_id;
		$Character->save();

		// Clear up any combat logs?  Remove last_room?
		$CombatLog = CombatLog::where(['characters_id' => $Character->id, 'creatures_id' => $request->creature_id, 'rooms_id' => $CurrentRoom->id])->first();
		if ($CombatLog)
			{
			// check room?  $CombatLog->room_id == $request->room_id ??
			$CombatLog->delete();
			}

		// Also remove any session creatures in the new room:
		Session::pull('creature.'.$NextRoom->id);

		$finish_timer = round(microtime(true) - $start_timer, 3) * 1000;
		// $timers[] = "move took:: $finish_timer ms";
		// Session::push('perf_log', $timers);
		Session::push('perf_log', ['move' => $finish_timer]);

		return $this->index($request);
		}

	public function combat(Request $request)
		{
		$start_timer = microtime(true);
		// error_log('Start combat');
		$Character = Character::findOrFail($request->character_id);
		$Room = Room::findOrFail($request->room_id);
		if ($Character->health <= 0)
			{
			$request->creature_kill = $Creature->id;
			return $this->death($request);
			}

		$flat_creature = null;
		$CombatLog = CombatLog::where(['characters_id' => $Character->id, 'creatures_id' => $request->creature_id, 'rooms_id' => $request->room_id])->first();
		if ($CombatLog)
			{
			$Creature = Creature::findOrFail($request->creature_id);
			$flat_creature = $Creature->toArray();
			$flat_creature['health'] = $CombatLog->remaining_health;
			}
		else
			{
			$Creature = Creature::findOrFail($request->creature_id);
			$flat_creature = $Creature->toArray();
			}

		$xp_variation = rand() / getrandmax() * ($Creature->xp_variation*2) - $Creature->xp_variation;

		if ($request->submit == 'flee')
			{
			if ($CombatLog)
				{
				$CombatLog->delete();
				}
			$cut_xp = $Creature->award_xp * 0.5;
			$cut_xp = floor(($Creature->award_xp * (1.0 + $xp_variation)) * 0.5);
			$Character->xp = round($Character->xp - $cut_xp, 0);
			Session::put('combat_log',["You have fled!  You have forfeit $cut_xp xp."]);
			$Character->save();
			Session::pull('creature.'.$Room->id);
			Session::put('block_spawn', true);
			// $request->no_spawn = true;
			return $this->index($request);
			}

		$combat_timer = microtime(true);

		$combat_log = [];
		$reward_log = [];
		// $flat_creature = $Creature->toArray();
		// $Equipment = Equipment::where(['characters_id' => $Character->id])->first();
		$character_stats = $Character->get_stats();
		// die(print_r($Character->stats()));
		// Calculate attacks:
		$attack_count = floor(($character_stats['dexterity'] - 10) / 20) + 2;
		$total_damage = 0;
		$grope_low = $character_stats['constitution'];
		$grope_high = $character_stats['constitution'] + $character_stats['strength'];
		// Multiply $grope_low & $grope_high if they ahve the extra grope racial mod!!!
		$weapon_low = 0;
		$weapon_high = 0;

		$avoidance = 0.0;
		$current_armor = $character_stats['armor'];

		$flat_character = $Character->toArray();
		$fatigue_use = 1;
		$fatigue_stat = 'fatigue';
		$attack_text = 'You grope with your fists';
		$combat_history = [];

		$base_accuracy = 0.80;

		if ($Character->has_buffs())
			{
			foreach ($Character->active_buffs() as $buff)
				{
				$stat_affected = $buff->decode()['affects'];
				if ($stat_affected == 'avoidance')
					{
					$avoidance += $buff->decode()['value'];
					}
				if ($stat_affected == 'armor')
					{
					$current_armor += round($buff->decode()['value']);
					}
				}
			}

		$grope_mod = $Character->get_modifier('GROPE_POWER');

		// $base_dodge = 0.05;
		// $base_crit = 0.05;
		// $crit_multipler_low = 2.0;
		// $crit_multipler_high = 4.0;
		$flat_equipment = $Character->equipment()->toArray();

		if ($flat_equipment['weapon'] ?? null)
			{
			// $flat_weapon = $Character->equipment()->weapon()->toArray();
			$InventoryItem = InventoryItem::findOrFail($flat_equipment['weapon']);
			$flat_weapon = ItemWeapon::findOrFail($InventoryItem->items_id)->toArray();
			// Mana weapon?
			if ($flat_weapon['weapon_types_id'] == 7)
				{
				// re-calc:
				$grope_low = $Character->charisma() + (rand(1,10));
				$grope_high = $Character->charisma() + $Character->wisdom() + rand(1,10);
				$attack_count = floor(($Character->intelligence() - 10) / 20) + 2;
				$fatigue_stat = 'mana';
				}
			else
				{
				$weapon_low = $flat_weapon['damage_low'];
				$weapon_high = $flat_weapon['damage_high'];
				}
			$attack_text = $flat_weapon['attack_text'];
			$base_accuracy = $flat_weapon['accuracy'];
			$fatigue_use = $flat_weapon['fatigue_use'];
			// So that equipped items count:
			// TODO: All required_amount values are null at this time.  Uncomment when that's back in.
			// if (call_user_func_array([$Character,$stat_check], []) < $Character->equipment()->weapon()->required_amount)
			// 	{
			// 	$fatigue_use = ($fatigue_use * 1.5);
			// 	}
			}

		// Check for accuracy bonuses?
		if ($base_accuracy != 1.0)
			{
			$acc_mod = $Character->get_modifier('ACCURACY_ADJUSTMENT');
			if ($acc_mod)
				{
				$remainder = abs($base_accuracy - 1.0);
				$bonus = round(($remainder * $acc_mod->value), 2);
				$base_accuracy += $bonus;
				}
			}
		// $combat_notes['attack_text'] = $attack_text;

		// And now alignment:
		$alignment_strength = 1.0;
		if (isset($flat_creature['alignments_id']) && isset($flat_character['alignments_id']))
			{
			$good_align = $flat_character['alignments_id'] == 4 ? 1 : $flat_character['alignments_id'] + 1;
			if ($good_align == $flat_creature['alignments_id'])
				{
				// We are +1 and deal more damage:
				$alignment_strength = $alignment_strength + $flat_creature['alignment_strength'];
				}
			$bad_align = $flat_character['alignments_id'] == 1 ? 4 : $flat_character['alignments_id'] - 1;
			if ($bad_align == $flat_creature['alignments_id'])
				{
				// We are -1 and deal less damage:
				$alignment_strength = $alignment_strength - $flat_creature['alignment_strength'];
				}
			}

		while ($flat_creature['health'] > 0)
			{
			if ($flat_character['health'] <= 0 || $flat_creature['health'] <= 0)
				{
				break;
				}				

			$round_damage = 0;
			$round_damages = [];
			$miss_count = 0;
			// creature
			$creature_damages = [];
			$creature_round_damage = 0;
			$creature_round_misses = 0;
			$creature_absorbs = 0;
			$no_fatigue = false;
			// We attack first:
			if ($request->character_spell_id)
				{
				// Then we're casting spells instead!
				if ($Character->has_spell($request->spell_id))
					{
					$Spell = Spell::findOrFail($request->spell_id);
					$CharacterSpell = CharacterSpell::findOrFail($request->character_spell_id);

					if ($Character->mana < $CharacterSpell->level)
						{
						Session::flash('errors', 'Not enough mana to cast that!');
						return $this->index($request);
						}

					$mana_cost = rand($CharacterSpell->level, $CharacterSpell->level * 3);

					if ($mana_cost == 0 || $mana_cost < $CharacterSpell->level)
						{
						$mana_cost = $CharacterSpell->level;
						}

					$flat_character['mana'] = $flat_character['mana'] - $mana_cost;
					if ($flat_character['mana'] <= 0)
						{
						$flat_character['mana'] = 0;
						}
					// TODO: We might want to move this logic up much higher to prevent useless processing?
					if ($Spell->has_property('CONSUME_ITEM'))
						{
						$item_id = $CharacterSpell->process()['CONSUME_ITEM'];

						if (!$Character->inventory()->has_item($item_id))
							{
							Session::flash('errors', "You don't have the required item!");
							return $this->index($request);
							}
						else
							{
							$Character->inventory()->remove_item($item_id);
							}
						}
					
					$attack_text = 'You cast your ' . $Spell->name;

					// TODO: Apply alignment damage
					$base_amount = $CharacterSpell->process()['DAMAGE_HEALTH'];

					// $spell_damage = rand(($base_amount * 0.85), ($base_amount * 1.15));
					$spell_damage = $base_amount;

					$flat_creature['health'] = $flat_creature['health'] - $spell_damage;
					$round_damage += $spell_damage;
					$round_damages[] = $spell_damage;
					// die(print_r($spell_damage));
					}
				}
			else
				{
				foreach (range(1, $attack_count) as $i)
					{
					if ($flat_creature['health'] <= 0)
						{
						break;
						}

					if ($flat_character[$fatigue_stat] < $fatigue_use)
						{
						// $arr['no_fatigue'] = true;
						// $combat_history[] = ['no_fatigue' => true];
						$no_fatigue = true;
						break;
						}

					// error_log('eating: '.$fatigue_use);
					$flat_character[$fatigue_stat] = $flat_character[$fatigue_stat] - $fatigue_use;

					$acc_check = rand() / getrandmax();
					if ($acc_check <= $base_accuracy)
						{
						// $calc_damage = rand($low_damage, $high_damage);
						// Grope damage first:
						$grope_damage = ceil(rand($grope_low, $grope_high));

						if ($grope_mod)
							{
							$grope_damage = ceil($grope_damage * $grope_mod->value);
							}
						$weapon_damage = rand($weapon_low, $weapon_high);

						$calc_damage = ceil(($grope_damage + $weapon_damage) * $alignment_strength);

						// Maybe not cast yet???
						$actual_damage = (int)($calc_damage - $flat_creature['armor']);
						if ($actual_damage <= 0)
							{
							$actual_damage = 1;
							}

						$flat_creature['health'] = $flat_creature['health'] - $actual_damage;
						$round_damage += $actual_damage;
						$round_damages[] = $actual_damage;
						}
					else
						{
						$round_damages[] = 0;
						$miss_count++;
						}
					}
				}

			if ($flat_creature['health'] > 0)
				{
				// Then creature:
				foreach (range(1, $flat_creature['attacks_per_round']) as $i)
					{

					if (rand(0,100) > ($avoidance * 100))
						{
						// TODO: We *must* have the wrong values for damage lows... For now, let's ignore it and set the low as 50% of the high.  This will make creature's significantly more dangerous.
						if ($flat_creature['damage_low'] == 1)
							{
							$damage_low = $flat_creature['damage_high'] * 0.5;
							}
						else
							{
							$damage_low = $flat_creature['damage_low'];
							}
						$calc_damage = rand($damage_low, $flat_creature['damage_high']);
						// $calc_damage = rand($flat_creature['damage_low'], $flat_creature['damage_high']);
						$creature_damage = $calc_damage - $current_armor;
						if ($creature_damage <= 0)
							{
							$creature_damage = 1;
							}

						$flat_character['health'] = $flat_character['health'] - $creature_damage;
						$creature_damages[] = $creature_damage;
						$creature_round_damage += $creature_damage;

						if ($flat_character['health'] <= 0)
							{
							break;
							}
						}
					else
						{
						$creature_round_misses++;
						$creature_damages[] = 0;
						}

					}
				}

			// Record the round:
			$arr = [
				'combat_title' => '<b>You attacked '. $flat_creature['name'] . '</b>.<br>',
				'no_fatigue' => $no_fatigue,
				'attack_text' => $attack_text,
				'attack_count' => count(array_filter($round_damages, function($i) {return $i > 0 ? $i : null;})) + $miss_count,
				'miss_count' => $miss_count,
				'attacks' => $round_damages,
				'round_damage' => $round_damage,
				'creature_text' => $flat_creature['attack_text'],
				'creature_att_count' => $flat_creature['attacks_per_round'],
				'creature_round' => $creature_round_damage,
				'creature_round_misses' => $creature_round_misses,
				'creature_attacks' => $creature_damages,
				];

			// player died:
			if ($flat_character['health'] <= 0)
				{
				$arr['pc_died'] = true;
				if ($CombatLog)
					{
					// die(print_r($CombatLog->creatures_id));
					Session::put('creature_death', $Creature->id);
					$CombatLog->delete();
					$CombatLog = null;
					}
				}

			$combat_history[] = $arr;
			// We ran out of fatigue:
			if ((int)$flat_character[$fatigue_stat] < $fatigue_use)
				{
				break;
				}

			// If the creature died:
			if ($flat_creature['health'] <= 0)
				{
				break;
				}

			if ($request->submit != 'all_out')
				{
				break;
				}
			}

		// Int fatigue first:
		// $flat_character[$fatigue_stat] = round($flat_character[$fatigue_stat], 0);
		// Save the character record based on the $flat_character:
		$Character->fill($flat_character);
		$Character->save();
		$Character->fresh();

		$combat_finish = round(microtime(true) - $combat_timer, 3) * 1000;
		// $timers[] = "combat calculations took:: $combat_finish ms";
		// Session::push('perf_log', $timers);
		// Session::push('perf_log', "combat calculations took:: $combat_finish ms");

		$reward_log = [];

		$reward_timer = microtime(true);

		// Out of the loop, who died?
		if ($flat_creature['health'] > 0 && $flat_character['health'] > 0)
			{
			// Session::put('combat.'.$Character->id, $flat_creature);
			if ($CombatLog)
				{
				$CombatLog->remaining_health = $flat_creature['health'];
				}
			else
				{
				$CombatLog = new CombatLog;
				$CombatLog->fill([
					'characters_id' => $Character->id,
					'creatures_id' => $Creature->id,
					'rooms_id' => $request->room_id,
					'remaining_health' => $flat_creature['health'],
					'expires_on' => time() + 60
					]);
				}
			$CombatLog->save();
			}
		elseif ($flat_creature['health'] <= 0)
			{
			// Clean up session?
			Session::pull('creature.'.$Room->id);
			// creature died
			// $combat_log[] = "$Creature->name is dead!!!";
			// $combat_log['creature_killed'] = true;
			$reward_log[] = "You beat the poor creature down to a bloody pulp.  With a last breath it dies.";
			// clean session:
			// Session::pull('combat.'.$Character->id);
			if ($CombatLog)
				{
				$CombatLog->delete();
				$CombatLog = null;
				}

			// TODO: CHEATER BIT
			$cheat_bit = 1;
			if (isset(auth()->user()->admin_level) && auth()->user()->admin_level > 0 && Session::has('admin_killsim'))
				{
				$cheat_bit = Session::get('admin_killsim');
				}
			// Make this a character setting for admins?
			// Record the kill:
			$KillCount = KillCount::where(['characters_id' => $Character->id, 'creatures_id' => $Creature->id])->first();
			if ($KillCount)
				{
				$KillCount->count = $KillCount->count + (1 * $cheat_bit);
				}
			else
				{
				$KillCount = new KillCount;
				$KillCount->fill([
					'characters_id' => $Character->id,
					'creatures_id' => $Creature->id,
					'count' => (1 * $cheat_bit)
					]);
				}

			$KillCount->save();

			$actual_xp = (int)($Creature->award_xp * (1.0 + $xp_variation)) * $cheat_bit;

			$gold_variation = rand() / getrandmax() * ($Creature->gold_variation*2) - $Creature->gold_variation;

			$actual_gold = (int)($Creature->award_gold * (1.0 + $gold_variation)) * $cheat_bit;
			if ($actual_gold == 0)
				{
				$actual_gold = 1;
				}
			$Character->xp += $actual_xp;
			$Character->gold += $actual_gold;
			$Character->save();
			$reward_log[] = "You found $actual_gold gold and gained $actual_xp experience.";
			$reward_log[] = '';

			$LootTables = LootTable::where(['creatures_id' => $request->creature_id])->get();

			if (count($LootTables) > 0)
				{
				foreach ($LootTables as $LootTable)
					{
					$prob = rand()/getrandmax();
					if ($prob <= $LootTable->chance)
						{
						$GroundItem = GroundItem::where(['rooms_id' => $request->room_id, 'characters_id' => $Character->id, 'items_id' => $LootTable->items_id])->first();
						$quantity = 1;
						if (isset(auth()->user()->admin_level) && auth()->user()->admin_level > 0 && Session::has('admin_killsim'))
							{
							$quantity = Session::get('admin_killsim');
							}
						// die(print_r($GroundItem));
						if ($GroundItem && (!$GroundItem->properties()->get()))
							{
							$GroundItem->fill(['expires_on' => time() + 300, 'quantity' => $GroundItem->quantity + $quantity]);
							// else don't stack
							}
						else
							{
							$GroundItem = new GroundItem;
							$GroundItem->fill(['rooms_id' => $request->room_id, 'characters_id' => $Character->id, 'items_id' => $LootTable->items_id, 'expires_on' => time() + 300, 'quantity' => $quantity]);
							}

						$GroundItem->save();

						if ($GroundItem->item()->has_property('DROP_RANDOM'))
							{
							// die('yes');
							// This item drops with random properties:
							$random_properties = $GroundItem->item()->get_property('DROP_RANDOM')->decode();

							$new_properties = [];

							// die(print_r($random_properties));

							// end result: Prefixes and Affixes
							// Surpeme Masculine Human XX XX of Precision

							// stat type is an affix
							$new_item_name = '';

							// Get a random Stat amount:
							$stat_bonus = rand(0, (count($random_properties['STAT_BONUS']) - 1));

							if (isset($random_properties['STAT_BONUS'][$stat_bonus]))
								{
								$stat_amount = $random_properties['STAT_BONUS'][$stat_bonus]['amount'];
								$new_properties['TRADER_SCORE_RESTRICTION'] = ["score" => $random_properties['STAT_BONUS'][$stat_bonus]['req']];
								$new_item_name .= $random_properties['STAT_BONUS'][$stat_bonus]['title'];
								}

							// Gender:
							$random_gender = rand(0, (count($random_properties['GENDER']) - 1));

							if (isset($random_properties['GENDER'][$random_gender]))
								{
								$new_properties['GENDER_RESTRICTION'] = ["gender" => $random_properties['GENDER'][$random_gender]['gender']];
								$new_item_name .= ' ' . $random_properties['GENDER'][$random_gender]['title'];
								}

							// Race:
							if ($random_properties['RACE'] == 'USE_DATABASE')
								{
								// Pick a random race from the Database:
								$RandomRace = Race::inRandomOrder()->limit(1)->first();

								$new_properties['RACE_RESTRICTION'] = ["race" => $RandomRace->id];
								$new_item_name .= ' ' . $RandomRace->name;
								}

							// Get the actual item name:
							$new_item_name .= ' ' . $GroundItem->item()->name;

							// Get a random Stat type:
							$random_stat = rand(0, (count($random_properties['STAT_TYPE']) - 1));

							if (isset($random_properties['STAT_TYPE'][$random_stat]))
								{
								$new_properties['STAT_BONUS'] = [$random_properties['STAT_TYPE'][$random_stat]['stat'] => $stat_amount];
								$new_item_name .= ' of ' . $random_properties['STAT_TYPE'][$random_stat]['title'];
								}

							$new_properties['RENAME_ITEM'] = ['name' => $new_item_name];


							// Complete the item:

							// die(print_r($new_properties));
							foreach ($new_properties as $prop => $data)
								{
								$GroundItemToItemProperty = new GroundItemToItemProperty;

								// Find the ItemProperty:
								$ItemProperty = ItemProperty::where(['name' => $prop])->first();

								// die(print_r($ItemProperty->id));

								$values = [
									'ground_items_id' => $GroundItem->id,
									'item_properties_id' => $ItemProperty->id,
									'data' => json_encode($data)
									];

								// die(var_dump($values));

								$GroundItemToItemProperty->fill($values);
								$GroundItemToItemProperty->save();
								}

							}
						// End drop random						
						}
					}
				}
			}
		elseif ($flat_character['health'] <= 0)
			{
			// we died:
			// $request->creature_kill = $Creature->id;
			// return $this->death($request);
			}
		else
			{
			// ??
			}

		$reward_finish = round(microtime(true) - $reward_timer, 3) * 1000;
		// Session::push('perf_log', ['rewards' => $reward_finish]);
		// $timers[] = "rewards took:: $reward_finish ms";
		// Session::push('perf_log', $timers);
		// Session::push('perf_log', "rewards took:: $reward_finish ms");

		// $no_attack = $Character->fatigue > 0 ? false : true;
		if ($CombatLog)
			{
			Session::put('combat_timer', true);
			// $no_attack = false;
			}

		// Test:
		$new_combat = $this->generate_combat_log($combat_history, $Character);
		// die(print_r($result));
		$finish_timer = round(microtime(true) - $start_timer, 3) * 1000;
		// $timers[] = "total combat took:: $finish_timer ms";
		// Session::push('perf_log', $timers);
		// Session::push('perf_log', "total combat took:: $finish_timer ms");
		Session::push('perf_log', ['combat' => $finish_timer]);

		// No, let's not do all this:
		Session::put('combat_log', $new_combat);
		Session::put('reward_log', $reward_log);
		Session::put('block_spawn', true);
		return $this->index($request);
		}

	public function show_stats(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		return view('/character/stats', ['character' => $Character]);
		}

	public function death(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// drop all stats:
		$Character->death();
		// Back to the fountain!
		$Character->last_rooms_id = 1;
		$Character->save();
		// Add a kill for a creature if exists:
		// die(print_r($request->creature_kill));
		$creature_kill = Session::pull('creature_death');
		if ($creature_kill)
			{
			$Room = Room::findOrFail($request->room_id);
			// Create Graveyard entry:
			$Graveyard = new Graveyard;
			$Graveyard->fill([
				'characters_id' => $request->character_id,
				'creatures_id' => $creature_kill,
				'zones_id' => $Room->zones_id
				]);
			$Graveyard->save();
			// $Creature = Creature::findOrFail($request->creature_kill);
			$CreatureKill = CreatureKill::where(['creatures_id' => $creature_kill])->first();

			if ($CreatureKill)
				{
				$CreatureKill->count++;
				// $CreatureKill->save();
				}
			else
				{
				$CreatureKill = new CreatureKill;
				$CreatureKill->fill([
					'creatures_id' => $creature_kill,
					'count' => 1
					]);
				}

			$CreatureKill->save();
			}
		// May not be needed?
		$request->death = true;
		return view('character.death', ['character' => $Character]);
		// return $this->index($request);
		}

	public function item_pickup(Request $request)
		{
		$start_timer = microtime(true);
		$Character = Character::findOrFail($request->character_id);

		// die(print_r($request->submit));

		// Does this item actually exist?
		$GroundItem = GroundItem::where(['id' => $request->submit, 'rooms_id' => $request->room_id, 'characters_id' => $request->character_id])->first();

		if (!$GroundItem)
			{
			// It didn't exist?
			Session::flash('errors', 'That item does not exist.');
			}
		else
			{
			$received = $Character->inventory()->add_item($GroundItem->items_id);
			if (!$received)
				{
				Session::flash('errors', 'You cannot carry anymore!');
				}
			else
				{
				// TODO: Transfer GroundItem Properties here!
				if ($GroundItem->properties()->count() > 0)
					{
					foreach ($GroundItem->properties()->get() as $GroundItemToItemProperty)
						{
						$InventoryItemToItemProperty = new InventoryItemToItemProperty;

						$values = [
							'inventory_items_id' => $received,
							'item_properties_id' => $GroundItemToItemProperty->item_properties_id,
							'data' => $GroundItemToItemProperty->data
							];

						$InventoryItemToItemProperty->fill($values);
						$InventoryItemToItemProperty->save();
						}

					$GroundItem->properties()->delete();
					}

				$GroundItem->quantity = $GroundItem->quantity - 1;
				if ($GroundItem->quantity == 0)
					{
					$GroundItem->delete();
					}
				else
					{
					$GroundItem->save();
					}
				}
			}

		$finish_timer = round(microtime(true) - $start_timer, 3) * 1000;
		Session::push('perf_log', ['item_pickup' => $finish_timer]);

		// TODO: Refactor?
		Session::put('block_spawn', true);

		return $this->index($request);
		}

	public function item_drop(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);

		// Does character have item?
		$Character->inventory()->remove_inventory_item($request->item_id);

		return $this->index($request);
		}

	public function train(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// $Character = Character::where(['characters.id' => $request->character_id])->first();

		$selected_multi = 1;
		if ($request->train_multi)
			{
			$selected_multi = $request->train_multi;
			}
		$costs = $this->calculate_training_cost($request);
		$request->costs = $costs;

		$stat = $request->submit;

		// die(print_r($request->all()));
		if ($stat === null)
			{
			return $this->index($request);
			// return view('game/train', ['character' => $Character, 'costs' => $costs, 'multi' => $selected_multi]);
			}
		
		if ($Character->xp < $costs[$stat])
			{
			Session::flash('training', 'You do not have enough experience to train that!');
			// return $this->index()
			}
		else
			{
			$new_stats = $Character->toArray();
			$new_stats[$stat] = $new_stats[$stat] + $request->train_multi;
			$new_stats['xp'] = $new_stats['xp'] - $costs[$stat];

			$Character->fill($new_stats);
			$Character->save();
			$Character->refresh_score();
			$Character->calc_quick_stats();
			}

		// Refresh values?
		$Character = Character::findOrFail($request->character_id);
		// $Character = Character::where(['characters.id' => $request->character_id])->first();

		$costs = $this->calculate_training_cost($request);
		$request->costs = $costs;


		return $this->index($request);
		// return view('game/train', ['character' => $Character, 'costs' => $costs, 'multi' => $selected_multi]);
		}

	public function training_cost($current_stat, $cost_adjustment)
		{
		/*
		Spell Training Formula:
		Level = 1:    price = (4000 - Wis - Int)
		Level > 1:    price = (4000 - Wis - Int) * (level_to_train - 1)
		*/
		// My old calc:
		// $cost = 5.0 * $cost_adjustment;
		$cost = $cost_adjustment;
		$result  = $current_stat * ($current_stat * $cost) - $current_stat;
		return (int)$result;
		}

	public function spell_training_cost($base_value, $current_level, $wisdom, $intelligence)
		{
		$cost = ((($current_level + 1) * ($current_level + 1)) * $base_value) / ($wisdom + $intelligence);

		return (int)$cost;
		}

	public function spells(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		
		if ($request->action == 'cast')
			{
			// die('casting');
			$Spell = Spell::findOrFail($request->spell_id);
			// Make sure the Character has the spell:
			$CharacterSpell = $Character->spells()->where(['spells_id' => $Spell->id])->first();

			// For custom views:
			$params = [];

			if ($Spell->has_property('CONSUME_ITEM'))
				{
				$item_id = $CharacterSpell->process()['CONSUME_ITEM'];

				if (!$Character->inventory()->has_item($item_id))
					{
					Session::flash('error', "You don't have the required item!");
					}
				else
					{
					$Character->inventory()->remove_item($item_id);
					}
				}

			if ($Character->mana < $CharacterSpell->level)
				{
				Session::flash('errors', 'Not enough mana to cast that!');
				}
			else
				{
				// $random_float = rand()/getrandmax();
				// $random_multiplier = $random_float * rand(100,300);
				// $mana_cost = round(($CharacterSpell->level * $random_multiplier) / 100);
				if (!isset($request->delay_mana_cost))
					{
					$mana_cost = rand($CharacterSpell->level, $CharacterSpell->level * 3);

					if ($mana_cost == 0 || $mana_cost < $CharacterSpell->level)
						{
						$mana_cost = $CharacterSpell->level;
						}

					$Character->mana = $Character->mana - $mana_cost;
					if ($Character->mana <= 0)
						{
						$Character->mana = 0;
						}
					$Character->save();
					}

				$character_wisdom = $Character->get_stat('wisdom');
				
				// cast spell:
				// Well WTF do we do here!
				$success = $CharacterSpell->level + $character_wisdom;
				if ($success >= rand(1,100))
					{
					// die(print_r($Spell->id));
					if ($Spell->has_property('RESTORE_HEALTH'))
						{
						$base_amount = $CharacterSpell->process()['RESTORE_HEALTH'];

						$amount = rand(($base_amount * 0.8), ($base_amount * 1.2));

						$Character->health = $Character->health + $amount;
						if ($Character->health > $Character->max_health)
							{
							$Character->health = $Character->max_health;
							}
						// $Character->save();
						Session::flash('spell_messages', 'Your spell heals you for ' . $amount);
						}

					if ($Spell->has_property('RESTORE_FATIGUE'))
						{
						$base_amount = $CharacterSpell->process()['RESTORE_FATIGUE'];

						$amount = rand(($base_amount * 0.8), ($base_amount * 1.2));

						$Character->fatigue = $Character->fatigue + $amount;
						if ($Character->fatigue > $Character->max_fatigue)
							{
							$Character->fatigue = $Character->max_fatigue;
							}
						
						Session::flash('spell_messages', 'Your spell restores ' . $amount . ' fatigue');
						}

					if ($Spell->has_property('CHANGE_ROOM'))
						{
						$spell_data = $CharacterSpell->process()['CHANGE_ROOM'];

						if (isset($spell_data['rooms']))
							{
							$available_rooms = [];

							foreach ($spell_data['rooms'] as $target)
								{
								if ($character_wisdom >= $target['wisdom'] && $CharacterSpell->level >= $target['level'])
									{
									$available_rooms[] = ['name' => $target['name'], 'id' => $target['target']];
									}
								}

							$params['available_rooms'] = $available_rooms;
							$params['spell'] = $CharacterSpell;
							}

						// die(print_r($_REQUEST));
						if (isset($spell_data['target']) || $request->target_id)
							{
							// die('target');
							// die(print_r($request->target_id));
							$room_target = $request->target_id ? $request->target_id : $spell_data['target'];
							// die(print_r($room_target));

							// Prevent any cheating!
							if ($request->target_id)
								{
								if (count($available_rooms) == 0)
									{
									Session::flash('errors', 'Oops, what are you doing!?');
									$request->full_reload = true;
									return $this->index($request);
									}
								else
									{
									$room_ids = array_column($available_rooms, 'id');
									$room_is_available = array_search($request->target_id, $room_ids);

									if ($room_is_available === null)
										{
										Session::flash('errors', 'You cannot go there!');
										$request->full_reload = true;
										return $this->index($request);
										}
									}
								}

							if (!$Character->teleport($room_target))
								{
								Session::flash('errors', 'You cannot access that zone currently.');
								}
							else
								{
								// die('we tele');
								$request->full_reload = true;
								return $this->index($request);
								// return action('GameController@index');
								}
							}
						}

					if ($Spell->has_property('APPLY_BUFF'))
						{
						$spell_data = $CharacterSpell->process('APPLY_BUFF');

						$CharacterSpellBuff = new CharacterSpellBuff;

						if (CharacterSpellBuff::where('characters_id', $Character->id)->where('buff_type', $spell_data['name'])->where('expires_on', '>', time())->count() > 0)
							{
							$CharacterSpellBuff = CharacterSpellBuff::where('characters_id', $Character->id)->where('buff_type', $spell_data['name'])->where('expires_on', '>', time())->first();
							}

						$values = [
							'character_spells_id' => $CharacterSpell->id,
							'characters_id' => $Character->id,
							'expires_on' => time() + ($spell_data['duration'] + $CharacterSpell->level),
							'buff' => json_encode(['affects' => $spell_data['affects'], 'value' => $spell_data['result'], 'text' => $spell_data['text']]),
							'buff_type' => $spell_data['name']
							];

						$CharacterSpellBuff->fill($values);
						$CharacterSpellBuff->save();
						}

					$Character->save();

					if ($Spell->has_property('HAS_PARTIAL'))
						{
						$get_view = $Spell->get_property('HAS_PARTIAL')->decode()['view'];
						// die(print_r($params));
						return ['menu' => view($get_view, ['character' => $Character->fresh(), 'params' => $params])->render()];
						}
					}
				else
					{
					Session::flash('errors', 'Your spell fizzled.');
					}
				}
			}

		return ['menu' => view('character.spells', ['character' => $Character->fresh()])->render()];
		}

	public function train_spell(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// $Spell = Spell::findOrFail($request->spells_id);
		$spell_name = $request->submit;
		if ($spell_name === null)
			{
			return $this->index($request);
			}
		$Spell = Spell::where('name', $spell_name)->first();
		$spell_id = $Spell->id;

		$CharacterSpell = CharacterSpell::where(['characters_id' => $request->character_id, 'spells_id' => $spell_id])->first();

		$level = $CharacterSpell ? $CharacterSpell->level : 1;
		$costs = $this->calculate_spell_training_cost($request);

		// die(print_r($costs));

		if ($Character->xp >= $costs[$Spell->id])
			{
			$new_stats = $Character->toArray();
			// $new_stats[$stat] = $new_stats[$stat] + $request->train_multi;
			// $new_stats['xp'] = $new_stats['xp'] - $costs[$stat];


			$Character->xp = $Character->xp - $costs[$spell_id];
			$Character->save();
			if ($CharacterSpell)
				{
				// has the spell already?
				$CharacterSpell->level = $CharacterSpell->level + $request->train_multi;
				$CharacterSpell->save();
				}
			else
				{
				// Create it:
				$CharacterSpell = new CharacterSpell;

				$CharacterSpell->fill([
					'characters_id' => $Character->id,
					'spells_id' => $Spell->id,
					'level' => $request->train_multi
					]);

				$CharacterSpell->save();
				}
			}
		else
			{
			Session::flash('training', 'You do not have enough experience to train that!');
			}

		return $this->index($request);
		}

	// Maybe??? YES.
	public function calculate_spell_training_cost(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);

		$stats = $Character->get_stats();
		// $Spells = Spell::all();
		// die(print_r($_REQUEST));
		$Room = Room::findOrFail($request->rooms_id);
		$Spells = Spell::where('rooms_id', $request->rooms_id)->get();

		$costs = [];
		if ($request->train_multi)
			{
			$train_multi = $request->train_multi;
			}
		else
			{
			$train_multi = 1;
			}

		foreach ($Spells as $Spell)
			{
			$spell = $Spell->toArray();
			// die(print_r($spell));
			$costs[$spell['id']] = 0;
			}

		// die(print_r($costs));
		// TODO: Lazy bit
		/**
		$base_value = 20000;
		if ($Room->zones_id != 1)
			{
			// Elven Village, Necropolis, Mana User Guild?
			$base_value = 85000;
			}
		*/
		// Draconian Lair, 115000?
		
		foreach ($Spells as $Spell)
			{
			$train_multi = $request->train_multi ? $request->train_multi : 1;
			$spell = $Spell->toArray();
			$CharacterSpell = $Character->has_spell($spell['id']);
			$current_level = 0;
			if ($CharacterSpell)
				{
				$current_level = $CharacterSpell->level;
				}

			while ($train_multi > 0)
				{
				$costs[$spell['id']] = $costs[$spell['id']] + $this->spell_training_cost($spell['base_training_value'], $current_level, $stats['wisdom'], $stats['intelligence']);
				$current_level++;
				$train_multi--;
				}
			}

		return $costs;
		}

	public function calculate_training_cost(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// $Character = Character::where(['characters.id' => $request->character_id])->first();

		// $StatCost = StatCost::first();
		$StatCost = StatCost::where(['races_id' => $Character->races_id, 'genders_id' => $Character->genders_id])->first();

		// $request->train_multi;
		$base_stats = [
			'strength' => $Character->strength,
			'dexterity' => $Character->dexterity,
			'constitution' => $Character->constitution,
			'wisdom' => $Character->wisdom,
			'intelligence' => $Character->intelligence,
			'charisma' => $Character->charisma,
			];

		$costs = [
			'strength' => 0,
			'dexterity' => 0,
			'constitution' => 0,
			'wisdom' => 0,
			'intelligence' => 0,
			'charisma' => 0,
			];

		if ($request->train_multi)
			{
			$train_multi = $request->train_multi;
			}
		else
			{
			$train_multi = 1;
			}

		while ($train_multi > 0)
			{
			// get the training costs:
			$costs['strength'] = $costs['strength'] + $this->training_cost($base_stats['strength'], $StatCost->strength_cost);
			$costs['dexterity'] = $costs['dexterity'] + $this->training_cost($base_stats['dexterity'], $StatCost->dexterity_cost);
			$costs['constitution'] = $costs['constitution'] + $this->training_cost($base_stats['constitution'], $StatCost->constitution_cost);
			$costs['wisdom'] = $costs['wisdom'] + $this->training_cost($base_stats['wisdom'], $StatCost->wisdom_cost);
			$costs['intelligence'] = $costs['intelligence'] + $this->training_cost($base_stats['intelligence'], $StatCost->intelligence_cost);
			$costs['charisma'] = $costs['charisma'] + $this->training_cost($base_stats['charisma'], $StatCost->charisma_cost);
			// cleanup:
			$train_multi--;
			$base_stats['strength']++;
			$base_stats['dexterity']++;
			$base_stats['constitution']++;
			$base_stats['wisdom']++;
			$base_stats['intelligence']++;
			$base_stats['charisma']++;
			}

		return $costs;
		}

	public function train_stat(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);

		// $StatCost = StatCost::first();
		$StatCost = StatCost::where(['races_id' => $Character->races_id])->first();

		$costs = $this->calculate_training_cost($request);

		// die(print_r($request->submit));
		$stat = $request->submit;

		if ($stat != 'on')
			{	
			if ($Character->xp < $costs[$stat])
				{
				Session::flash('training', 'You do not have enough experience to train that!');
				}
			else
				{
				$new_stats = $Character->toArray();
				$new_stats[$stat] = $new_stats[$stat] + $request->train_multi;
				$new_stats['xp'] = $new_stats['xp'] - $costs[$stat];

				$Character->fill($new_stats);
				$Character->save();
				$Character->refresh_score();
				$Character->calc_quick_stats();
				}
			}

		$costs = $this->calculate_training_cost($request);


		return view('partials/train', ['character' => $Character->fresh(), 'costs' => $costs]);
		}

	public function rest(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		if ($Character->last_rooms_id != 1)
			{
			Session::flash('errors', "Don't be naughty!");
			return false;
			// return $this->index($request);
			}
		// die(print_r($request->all()));
		$healing = false;
		if ($request->action == 'heal')
			{
			// die(print_r($request->all()));
			$healing = true;
			// $Character = Character::where(['character_stats.characters_id' => $request->character_id])->first();
			

			$healing_amount = ($Character->wisdom() + $Character->intelligence()) - 30;
			$Character->health = $Character->health + (int)$healing_amount;
			if ($Character->health > $Character->max_health)
				{
				$Character->health = $Character->max_health;
				}
			$Character->fatigue = $Character->fatigue + (int)$healing_amount;
			if ($Character->fatigue > $Character->max_fatigue)
				{
				$Character->fatigue = $Character->max_fatigue;
				}
			$Character->mana = $Character->mana + (int)$healing_amount;
			if ($Character->mana > $Character->max_mana)
				{
				$Character->mana = $Character->max_mana;
				}

			$Character->save();
			}

		$Character = Character::findOrFail($request->character_id);

		return view('partials/rest', ['character' => $Character, 'healing' => $healing]);
		}

	public function equipment(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);

		// Find current equipment:
		$Equipment = Equipment::where(['characters_id' => $request->character_id])->first();

		// If Character missing equipment record:
		if (!$Equipment)
			{
			// TODO: And yet somehow if we reach this condition we end up running out of memory in the rest of the code...?
			$Equipment = new Equipment;
			$Equipment->fill(['characters_id' => $Character->id]);
			$Equipment->save();
			$Equipment->fresh();
			}

		// die(print_r($Equipment));

		if ($request->action == 'equip')
			{
			// We need to ensure the item is actually in our inventory...

			// get a list of all items:
			$inventory_items = InventoryItem::where(['inventory_id' => $Character->inventory()->id])->pluck('id')->toArray();

			// die('stuff');
			// die(print_r($request->equipment));
			// die(print_r($Character->inventory()->inventory_items()->pluck('id')->toArray()));
			foreach ($request->equipment as $slot => $item)
				{
				if ($item != 0 && !in_array($item, $inventory_items))
					{
					Session::flash('errors', 'You no longer have that item!');
					break;
					}
				if ($item > 0)
					{
					// Confirm we can wear this item!?
					$InventoryItem = InventoryItem::findOrFail($item);

					if ($InventoryItem->has_property('GENDER_RESTRICTION'))
						{
						// Compare by ID instead of title...
						if ($Character->gender()->title == $InventoryItem->get_property('GENDER_RESTRICTION')->decode()['gender'])
							{
							// can wear
							}
						else
							{
							Session::flash('errors', 'That item does not fit your Gender!');
							break;
							}
						}
					elseif ($InventoryItem->has_property('RACE_RESTRICTION'))
						{
						if ($Character->races_id == $InventoryItem->has_property('RACE_RESTRICTION'))
							{
							// can wear
							}
						else
							{
							Session::flash('errors', 'That item does not fit your Race!');
							break;
							}
						}

					$Equipment->$slot = $item;
					}
				else
					{
					$Equipment->$slot = null;
					}
				}

			$Equipment->save();
			$Equipment->calculate_stats();
			$Equipment->refresh_equip();
			$Character->calc_quick_stats();
			$Character->get_max_weight();
			}

		// Find all available item equipment:
		// $Inventory = Inventory::where(['characters_id' => $request->character_id])->first();
		// $Character->inventory()->add_item($LootTable->items_id);
		$CharacterItems = $Character->inventory()->character_items();

		$weapons = [];
		$shields = [];
		$head_armors = [];
		$neck_armors = [];
		$chest_armors = [];
		$leg_armors = [];
		$hand_armors = [];
		$feet_armors = [];
		$amulet_items = [];
		$left_rings = [];
		$right_rings = [];
		$bracelet_items = [];

		// die(print_r($allitems));

		foreach ($CharacterItems as $CharacterItem)
			{
			// die($inv_item);s
			$Item = Item::findOrFail($CharacterItem->items_id);
			
			// die($Item);
			if ($Item->item_types_id == 1)
				{
				// $ItemWeapon = ItemWeapon::where(['items_id' => $Item->id])->first();
				// die(print_r($CharacterItem->item()));

				$dis_val = $CharacterItem->item()->toArray();
				$dis_val['name'] = $CharacterItem->get_name();
				$dis_val['id'] = $CharacterItem->id;
				$dis_val['selected'] = false;
				// die(print_r($Equipment->weapon.' == '.$CharacterItem->id.'::'));
				if ($Equipment->weapon == $CharacterItem->id)
					{
					$dis_val['selected'] = true;
					}
				$weapons[] = $dis_val;
				}

			if ($Item->item_types_id == 2)
				{
				// $ItemArmor = ItemArmor::where(['items_id' => $Item->id])->first();
				$dis_val = $CharacterItem->item()->toArray();
				$dis_val['name'] = $CharacterItem->get_name();
				$dis_val['id'] = $CharacterItem->id;
				$dis_val['selected'] = false;

				if ($Item->actual_item()->equipment_slot == 2)
					{
					if ($Equipment->shield == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$shields[] = $dis_val;
					}

				if ($Item->actual_item()->equipment_slot == 3)
					{
					if ($Equipment->head == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$head_armors[] = $dis_val;
					}

				if ($Item->actual_item()->equipment_slot == 4)
					{
					if ($Equipment->neck == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$neck_armors[] = $dis_val;
					}

				if ($Item->actual_item()->equipment_slot == 5)
					{
					if ($Equipment->chest == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$chest_armors[] = $dis_val;
					}

				if ($Item->actual_item()->equipment_slot == 6)
					{
					if ($Equipment->hands == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$hand_armors[] = $dis_val;
					}

				if ($Item->actual_item()->equipment_slot == 7)
					{
					if ($Equipment->legs == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$leg_armors[] = $dis_val;
					}

				if ($Item->actual_item()->equipment_slot == 8)
					{
					if ($Equipment->feet == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$feet_armors[] = $dis_val;
					}
				}

			if ($Item->item_types_id == 3)
				{
				// $ItemAccessory = ItemAccessory::where(['items_id' => $Item->id])->first();
				$dis_val = $CharacterItem->item()->toArray();
				$dis_val['id'] = $CharacterItem->id;
				$dis_val['selected'] = false;

				if ($Item->actual_item()->equipment_slot == 9)
					{
					if ($Equipment->amulet == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$amulet_items[] = $dis_val;
					}

				if ($Item->actual_item()->equipment_slot == 10)
					{
					if ($Equipment->right_ring != $CharacterItem->id)
						{
						if ($Equipment->left_ring == $CharacterItem->id)
							{
							$dis_val['selected'] = true;
							}
						$left_rings[] = $dis_val;
						}

					if ($Equipment->left_ring != $CharacterItem->id)
						{
						if ($Equipment->right_ring == $CharacterItem->id)
							{
							$dis_val['selected'] = true;
							}
						$right_rings[] = $dis_val;
						}
					}

				if ($Item->actual_item()->equipment_slot == 11)
					{
					if ($Equipment->bracelet == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$bracelet_items[] = $dis_val;
					}
				}
			}

		// die(print_r($weapons));

		return view('character/equipment', ['character' => $Character, 'weapons' => $weapons, 'shields' => $shields, 'heads' => $head_armors, 'necks' => $neck_armors, 'chests' => $chest_armors, 'legs' => $leg_armors, 'hands' => $hand_armors, 'feets' => $feet_armors, 'amulets' => $amulet_items, 'left_rings' => $left_rings, 'right_rings' => $right_rings, 'bracelets' => $bracelet_items]);
		}

	public function food(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// Find current equipment:
		// $InventoryItems = InventoryItem::where(['characters_id' => $request->character_id])->first();

		if ($request->action == 'consume')
			{
			$InventoryItem = $Character->inventory()->get_inventory_item($request->item);
			$Item = Item::findOrFail($InventoryItem->items_id);
			if ($Item->item_types_id != 4)
				{
				// error?
				return true;
				}
			$ItemFood = ItemFood::where(['items_id' => $Item->id])->first();
			$Character->heal($ItemFood->potency);
			$Character->inventory()->remove_inventory_item($request->item);
			// $request->item;
			// $res = $Character->inventory()->where('items_id' => $request->item);
			}

		$allitems = $Character->inventory()->character_items();

		$items = [];

		// die(print_r($allitems));

		foreach ($allitems as $inv_item)
			{
			// die($inv_item);s
			$Item = Item::findOrFail($inv_item->items_id);

			if ($Item->item_types_id == 4)
				{
				// $arr = $Item->toArray();
				$arr = $inv_item;
				$ItemFood = ItemFood::where(['items_id' => $Item->id])->first();
				// $arr['quantity'] = $inv_item->quantity;
				$arr['name'] = $Item->name;
				$arr['potency'] = $ItemFood->potency;
				$arr['selected'] = false;
				if (isset($request->item) && $Item->id == $request->item)
					{
					$arr['selected'] = true;
					}
				// $items[] = $Item;
				$items[] = $arr;
				}
			}

		if ($Character->settings()->food_sort)
			{
			switch ($Character->settings()->food_sort)
				{
				case 0: // potency ASC
					usort($items, function($a, $b) {
						return $a['potency'] <=> $b['potency'];
					});
					break;
				case 1: // potency DESC
					usort($items, function($a, $b) {
						return $b['potency'] <=> $a['potency'];
					});
					break;
				case 2: // count ASC
					usort($items, function($a, $b) {
						return $a['quantity'] <=> $b['quantity'];
					});
					break;
				case 3: // count DESC
					usort($items, function($a, $b) {
						return $b['quantity'] <=> $a['quantity'];
					});
					break;
				case 4: // alpha ASC
					usort($items, function($a, $b) {
						return $a['name'] <=> $b['name'];
					});
					break;
				case 5: // alpha DESC
					usort($items, function($a, $b) {
						return $b['name'] <=> $a['name'];
					});
					break;
				default:
					// no sort
					break;
				}
			}

		$Character = Character::findOrFail($request->character_id);

		return view('character/food', ['character' => $Character, 'items' => $items]);
		}

	public function purchase(Request $request)
		{
		if ($request->item_purchase == 0)
			{
			Session::flash('errors', 'Please select an item to buy');
			return $this->index($request);
			}
		$Character = Character::findOrFail($request->character_id);
		// $Room = Room::findOrFail($request->room_id);
		// Probably auth some stuff about the store:
		$Shop = Shop::findOrFail($request->shop_id);

		// Then we find the item:
		// $PurchaseItem = $Shop->shop_items()->where(['id' => $request->item_purchase])->first();
		$PurchaseItem = ShopItem::where(['id' => $request->item_purchase, 'shops_id' => $Shop->id])->first();
		$price = $PurchaseItem->get_cost($Character->charisma);

		if ($Character->gold < $price)
			{
			Session::flash('purchase', 'You cannot afford that!');
			return $this->index($request);
			}

		$received = $Character->inventory()->add_item($PurchaseItem->item()->id);
		if ($received)
			{
			$Character->gold = $Character->gold - $price;
			$Character->save();
			Session::flash('purchase', "You purchased a ".$PurchaseItem->item()->name);
			}
		else
			{
			Session::flash('purchase', 'You cannot carry anymore!');
			}

		return $this->index($request);
		}

	public function sell(Request $request)
		{
		if ($request->item_sell == 0)
			{
			Session::flash('errors', 'Please select an item to sell');
			return $this->index($request);
			}
		$Character = Character::findOrFail($request->character_id);
		// $Room = Room::findOrFail($request->room_id);
		// Probably auth some stuff about the store:
		$Shop = Shop::findOrFail($request->shop_id);

		$SellItem = InventoryItem::findOrFail($request->item_sell);

		// if not, throw error?
		$earnings = round(($SellItem->item()->value * 0.00001) * ($Character->stats()['charisma'] / 1000), 0);

		// die(print_r($Character->equipment_list()));
		if (in_array($request->item_sell, $Character->equipment_list()))
			{
			Session::flash('errors', 'You cannot sell equipped items!');
			return $this->index($request);
			}
		
		$sold = $Character->inventory()->remove_inventory_item($SellItem->id);
		if ($sold)
			{
			$Character->gold += $earnings;
			$Character->save();
			Session::flash('sell', 'You sold a '.$SellItem->item()->name.' for '.$earnings.' gold.');
			}
		else
			{
			// can't sell for some reason??
			}

		return $this->index($request);
		}

	public function forge(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// Find a forge recipe based on submitted items:
		$query = [
			'item_weapons_id' => $request->forge_weapon,
			'item_armors_id' => $request->forge_armor,
			'item_foods_id' => $request->forge_food,
			'item_jewels_id' => $request->forge_jewel,
			'item_dusts_id' => $request->forge_dust,
			];

		$ForgeRecipe = ForgeRecipe::where($query)->first();

		if (!$ForgeRecipe)
			{
			Session::flash('forged', 'The combination did not produce any results.');
			return $this->index($request);
			}
		$Character->inventory()->remove_inventory_item($request->forge_weapon);
		$Character->inventory()->remove_inventory_item($request->forge_armor);
		$Character->inventory()->remove_inventory_item($request->forge_food);
		$Character->inventory()->remove_inventory_item($request->forge_jewel);
		$Character->inventory()->remove_inventory_item($request->forge_dust);
		$Character->inventory()->add_item($ForgeRecipe->result_items_id);
		Session::flash('forged', 'You have successfully forged a '.$ForgeRecipe->result_item()->name);

		return $this->index($request);
		}

	public function deposit(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		if ($Character->gold == 0)
			{
			Session::flash('bank', 'You have no money to deposit.');
			return $this->index($request);
			}

		if ($request->all)
			{
			$current_gold = $Character->gold;
			$Character->gold = 0;
			$Character->bank = $Character->bank + $current_gold;
			$Character->save();
			Session::flash('bank', 'You deposited '.$current_gold.' gold into the bank.');
			}
		else
			{
			if ($request->deposit <= 0)
				{
				Session::flash('bank', 'Please try to deposit a valid amount!');
				return $this->index($request);
				}

			if ($request->deposit > $Character->gold)
				{
				Session::flash('bank', 'You do not have that much gold!');
				return $this->index($request);
				}
			$Character->gold = $Character->gold - $request->deposit;
			$Character->bank = $Character->bank + $request->deposit;
			$Character->save();
			Session::flash('bank', 'You deposited '.$request->deposit.' gold into the bank.');
			}
		
		return $this->index($request);
		}

	public function withdraw(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		if ($Character->bank == 0)
			{
			Session::flash('bank', 'You have no money to withdraw.');
			return $this->index($request);
			}

		if ($request->all)
			{
			$current_bank = $Character->bank;
			$Character->bank = 0;
			$Character->gold = $Character->gold + $current_bank;
			$Character->save();
			Session::flash('bank', 'You withdrew '.$current_bank.' gold into the bank.');
			}
		else
			{
			if ($request->withdraw <= 0)
				{
				Session::flash('bank', 'Please try to withdraw a valid amount!');
				return $this->index($request);
				}

			if ($request->withdraw > $Character->bank)
				{
				Session::flash('bank', 'You do not have that much gold in the bank!');
				return $this->index($request);
				}
			$Character->bank = $Character->bank - $request->withdraw;
			$Character->gold = $Character->gold + $request->withdraw;
			$Character->save();
			Session::flash('bank', 'You withdraw '.$request->withdraw.' gold from the bank.');
			}

		return $this->index($request);
		}

	public function consider(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		$Creature = Creature::findOrFail($request->creature_id);

		Session::put('creature.'.$request->room_id, $Creature->id);

		if ($Creature->attacks_per_round > 1)
			{
			if ($Character->health >= $Creature->damage_high * $Creature->attacks_per_round)
				{
				Session::flash('consider', 'You will probably survive all attacks');
				}
			elseif ($Character->health >= $Creature->damage_high)
				{
				Session::flash('consider', 'You will probably survive a few hits...');
				}
			else
				{
				Session::flash('consider', 'Run away!');
				}
			}
		else
			{
			if ($Character->health >= $Creature->damage_high)
				{
				Session::flash('consider', 'You will probably survive the first hit');
				}
			else
				{
				Session::flash('consider', 'This is certainly death!');
				}
			}

		return $this->index($request);
		}

	public function settings(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// stuff
		return view('character/settings', ['character' => $Character, 'settings' => $Character->settings()]);
		// return view('character/settings');
		}

	public function choose_alignment(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		$Alignment = Alignment::findOrFail($request->alignments_id);

		$Character->alignments_id = $Alignment->id;
		$Character->save();

		return $this->index($request);
		}

	public function send(Request $request)
		{
		if ($request->item_send === 'null')
			{
			Session::flash('receive', 'You must select an item to send.');
			return $this->index($request);
			}

		if (!$request->send_character)
			{
			Session::flash('receive', 'You must enter a character name to send to.');
			return $this->index($request);
			}

		$Character = Character::findOrFail($request->character_id);

		// find send to:
		$ToCharacter = Character::where('name', $request->send_character)->first();

		if ($ToCharacter->id == $request->character_id)
			{
			Session::flash('send', 'You cannot send items to yourself.');
			return $this->index($request);
			}

		if (!$ToCharacter)
			{
			Session::flash('send', 'No one by that name exists!');
			return $this->index($request);
			}

		// Find the item:
		$InventoryItem = $Character->inventory()->inventory_items()->where('id', $request->item_send)->first();
		if (!$InventoryItem)
			{
			Session::flash('send', 'You do not have that item!');
			return $this->index($request);
			}

		// Error on safe side, take item first:
		$Character->inventory()->remove_inventory_item($InventoryItem->id);

		// Else we have a character:
		$TraderItem = new TraderItem;
		$values = [
			'traders_id' => $request->trader_id,
			'characters_id' => $ToCharacter->id,
			'items_id' => $InventoryItem->item()->id,
			'from_characters_id' => $Character->id,
			];
		$TraderItem->fill($values);
		$TraderItem->save();

		Session::flash('send', 'You have sent '.$InventoryItem->item()->name.' to '.$ToCharacter->name);

		return $this->index($request);
		}

	public function receive(Request $request)
		{
		if ($request->item_received === 'null')
			{
			Session::flash('receive', 'You must select an item to receive.');
			return $this->index($request);
			}
		$Character = Character::findOrFail($request->character_id);
		$TraderItem = TraderItem::findOrFail($request->item_received);
		// TODO: Refactor the price calculation
		$price = round(($TraderItem->item()->value * 0.66) / $Character->charisma, 0);

		// TODO: Wall Score retrictions
		if ($price > $Character->gold)
			{
			Session::flash('receive', 'You do not have enough gold to receive that item.');
			return $this->index($request);
			}

		// Otherwise, take gold and give item:
		$Character->gold = $Character->gold - $price;
		$Character->save();
		$Character->inventory()->add_item($TraderItem->item()->id);
		$TraderItem->delete();

		Session::flash('receive', 'You have received '.$TraderItem->item()->name.' from '.$TraderItem->from_character()->name);

		return $this->index($request);
		}

	public function process_action(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		$Room = Room::findOrFail($request->room_id);
		$RoomAction = RoomAction::findOrFail($request->room_action_id);

		$pass = false;

		// Verify requirements:
		if ($RoomAction->strength_req)
			{
			if ($Character->strength >= $RoomAction->strength_req)
				{
				// pass:
				$pass = true;
				}
			}

		// Room redirect:
		if ($RoomAction->redirect_room)
			{
			$Character->last_rooms_id = $RoomAction->redirect_room;
			$Character->save();
			}

		if ($pass && $RoomAction->remember)
			{
			$CharacterRoomAction = new CharacterRoomAction;
			$CharacterRoomAction->characters_id = $Character->id;
			$CharacterRoomAction->room_actions_id = $RoomAction->id;
			$CharacterRoomAction->save();
			Session::flash('action_success', $RoomAction->success_action);
			}

		if (!$pass)
			{
			Session::flash('action_failed', $RoomAction->failed_action);
			}

		return $this->index($request);
		}

	public function teleport(Request $request)
		{
		$TeleportTarget = TeleportTarget::findOrFail($request->target_id);
		$Character = Character::findOrFail($request->character_id);
		// $Room = Room::findOrFail($request->room_id);
		// $Character->last_rooms_id = $request->room_id;
		// $Character->save();
		$Character->teleport($TeleportTarget->rooms_id);

		return $this->index($request);
		}

	public function treasure_loot(Request $request)
		{
		$Room = Room::findOrFail($request->room_id);
		$Character = Character::findOrFail($request->character_id);
		$loot = Cache::get('room-treasure-'.$request->room_id);
		// Remove from the cache:
		Cache::forget('room-treasure-'.$request->room_id);
		if (!$loot)
			{
			Session::flash('errors', 'That treasure is no longer there!');
			return $this->index($request);
			}
		// Else, let's award the loot:
		$values = $Room->zone()->get_property('TREASURE_HUNTING')->decode();
		$possible_loot = $values[$loot];

		$selected_loot = $possible_loot[array_rand($possible_loot)];

		foreach ($selected_loot as $item_id)
			{
			$Item = Item::findOrFail($item_id);
			$Character->inventory()->add_item($item_id);
			Session::push('messages', 'You received a '.$Item->name);
			}

		return $this->index($request);
		}

	public function chat_message(Request $request)
		{
		$Character = Character::findOrFail($request->characters_id);
		$ChatRoom = ChatRoom::findOrFail($request->chat_rooms_id);

		$ChatRoomMessage = new ChatRoomMessage;
		// TODO: Scrub these entries?
		$ChatRoomMessage->fill([
			'chat_rooms_id' => $request->chat_rooms_id,
			'characters_id' => $request->characters_id,
			'message' => filter_var($request->message, FILTER_SANITIZE_STRING),
			]);

		$ChatRoomMessage->save();

		$request_params = ['character' => $Character, 'chat' => $ChatRoom];

		if (isset(auth()->user()->admin_level) && auth()->user()->admin_level > 0)
			{
			$request_params['is_admin'] = true;
			}
		return $this->footer($request);
		if ($request->ajax())
			{
			// $this->index($request)
			// $view = \View::make('partials/footer', $request_params);
			// $sections = $view->renderSections();
			// return $sections['footer'];
			}

		return view("partials/footer", $request_params);
		// return view('game/main', $request_params);
		}

	public function reward_character($CharacterQuest, $Character)
		{
		$reward = $CharacterQuest->quest()->reward();

		$Character->xp = $Character->xp + $reward->xp_reward;
		$Character->gold = $Character->gold + $reward->gold_reward;
		$Character->quest_points = $Character->quest_points + $reward->quest_point_reward;
		$Character->save();

		$message = $CharacterQuest->quest()->completion_message."<br><br>You receive $reward->gold_reward gold and $reward->xp_reward experience.<br>You gain $reward->quest_point_reward Quest Points.<br>";

		Session::put('quest_text', $message);

		$CharacterQuest->rewarded = true;
		$CharacterQuest->save();
		}

	public function generate_combat_log($combat_history, $Character)
		{
		$condensed = [];
		if ($Character->settings()->brief_mode)
			{
			// die(print_r($combat_history));
			foreach ($combat_history as $log_entry)
				{
				
				if ($log_entry['attack_count'] > 0)
					{
					$condensed[] = $log_entry['combat_title'];
					$condensed[] = '<b>'.$log_entry['attack_text'].'</b><br>';
					$condensed[] = 'You made '.$log_entry['attack_count'].' attacks and missed '.$log_entry['miss_count'].' times.<br>';
					$condensed[] = 'You did '.$log_entry['round_damage'].' damage.<br>';
					}

				if ($log_entry['no_fatigue'])
					{
					$condensed[] = 'You are too tired to attack.<br>';
					}

				if (isset($log_entry['creature_attacks']))
					{
					if ($log_entry['creature_round'] > 0)
						{
						$condensed[] = $log_entry['creature_text'].' doing '.$log_entry['creature_round'].' damage.<br>';
						}
					if ($log_entry['creature_round_misses'] > 0)
						{
						$condensed[] = "You expertly dodged the creature's attack " . $log_entry['creature_round_misses'] . " times.<br>";
						}
					}

				if (isset($log_entry['pc_died']))
					{
					$condensed[] = 'You have died!<br>';
					}
				}
			}
		else
			{
			foreach ($combat_history as $log_entry)
				{
				if (isset($log_entry['attacks']))
					{
					$condensed[] = $log_entry['combat_title'];
					foreach ($log_entry['attacks'] as $attack)
						{
						if ($attack > 0)
							{
							$condensed[] = '<b value="'.$attack.'">'.$log_entry['attack_text'].", for $attack damage!</b><br>";
							}
						else
							{
							$condensed[] = 'You missed!<br>';
							}
						}
					}

				if ($log_entry['no_fatigue'])
					{
					$condensed[] = 'You are too tired to attack.<br>';
					}

				if (isset($log_entry['creature_attacks']))
					{
					foreach ($log_entry['creature_attacks'] as $creature_attack)
						{
						if ($creature_attack > 0)
							{
							$condensed[] = $log_entry['creature_text']." doing $creature_attack damage.<br>";
							}
						else
							{
							$condensed[] = "You expertly avoided the creature's attack!<br>";
							}
						}
					}

				if (isset($log_entry['pc_died']))
					{
					$condensed[] = 'You have died!<br>';
					}
				}
			}

		return $condensed;
		}

	public function start_timer($timer)
		{
		$this->timers[$timer] = microtime(true);
		}

	public function end_timer($timer)
		{
		Session::push('perf_log', [$timer => round(microtime(true) - $this->timers[$timer], 3) * 1000]);
		}
	}