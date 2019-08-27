<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Character;
use App\Room;
use App\SpawnRule;
use App\Npc;
use App\RewardTable;
use App\LootTable;
use App\StatCost;
use App\RaceStatAffinity;
use App\Equipment;
use App\Item;
use App\ItemWeapon;
use App\ItemArmor;
use App\CharacterSetting;
use App\ItemFood;
use App\ItemAccessory;
use App\CombatLog;
use App\KillCount;
use App\InventoryItem;
use App\Shop;
use App\ShopItem;
use App\ForgeRecipe;
use App\TraderItem;
use App\Spell;
use App\Quest;
use App\QuestTask;
use App\QuestCriteria;
use App\QuestReward;
use App\CharacterQuest;
use App\CharacterQuestCriteria;
use App\RoomAction;
use App\CharacterRoomAction;

class GameController extends Controller
	{
	//
	public function index(Request $request)
		{
		// TODO: This should be unreachable?
		if (!auth()->user())
			{
			return redirect('/home');
			}

		$Character = Character::findOrFail($request->character_id);

		// die(print_r(Equipment::all()->toArray()));
			// ->select('character_stats.id as character_stats_id, *');

		if (!$Character)
			{
			return redirect('/home');
			}

		$no_attack = $Character->fatigue > 0 ? false : true;
		$CombatLog = CombatLog::where(['characters_id' => $Character->id])->first();
		if ($CombatLog)
			{
			$no_attack = false;
			}

		$Room = Room::findOrFail($Character->last_rooms_id);

		$Npc = null;
		// Block spawn in certain events:
		if ($request->session()->has('npc.'.$Room->id))
			{
			$Npc = Npc::where(['id' => $request->session()->get('npc.'.$Room->id)])->first();
			$request->session()->pull('npc.'.$Room->id);
			}

		if (isset($request->no_spawn) || $Npc)
			{
			// ignore
			}
		else
			{
			// Find spawn rules for room:
			$SpawnRule = SpawnRule::where(['rooms_id' => $Room->id])->inRandomOrder()->first();

			if ($SpawnRule && $Room->spawns_enabled)
				{
				$Npc = Npc::where(['id'=> $SpawnRule->npcs_id])->first();
				$prob = rand() / getrandmax();
				if ($prob <= $SpawnRule->chance)
					{
					// then we spawn:
					$Npc = Npc::where(['id'=> $SpawnRule->npcs_id])->first();
					$request->session()->put('npc.'.$Room->id, $Npc->id);
					// break;
					}
				}
			else
				{
				if ($Room->spawns_enabled)
					{
					// no room specific spawns:
					$SpawnRules = SpawnRule::where(['zones_id' => $Room->zones_id])->inRandomOrder()->get();
					if (count($SpawnRules) > 0)
						{
						foreach ($SpawnRules as $SpawnRule)
							{
							// getrandmax()
							$prob = rand() / getrandmax();
							if ($prob <= $SpawnRule->chance)
								{
								// then we spawn:
								$Npc = Npc::where(['id'=> $SpawnRule->npcs_id])->first();
								$request->session()->put('npc.'.$Room->id, $Npc->id);
								break;
								}
							}
						}
					}
				}
			}

		// Does the room have loot?
		$ground_items = [];
		$loot_items = $request->session()->get('loot.'.$Room->id);
		if (isset($loot_items))
			{
			$item_ids = [];
			foreach ($loot_items as $loot_item)
				{
				$item_ids[] = $loot_item;
				}
			// die(print_r($item_ids));
			$ground_items = Item::whereIn('id', $item_ids)->get();
			}

		$request_params = ['character' => $Character, 'room' => $Room, 'npc' => $Npc, 'no_attack' => $no_attack, 'ground_items' => $ground_items];

		if ($request->death)
			{
			$request_params['death'] = true;
			}

		if ($request->no_carry)
			{
			$request_params['no_carry'] = true;
			}

		if (isset(auth()->user()->admin_level) && auth()->user()->admin_level > 0)
			{
			$request_params['is_admin'] = true;
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
				$request_params['spells'] = Spell::all();
				$request_params['costs'] = $this->calculate_spell_training_cost($request);
				}

			if ($Room->has_property('WALL_OF_FLAME'))
				{
				$Results = Character::select()->orderBy('score', 'desc')->get();
				$request_params['score_list'] = $Results;
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
		$PickupQuest = Quest::where(['pickup_rooms_id' => $Room->id])->first();

		if ($PickupQuest)
			{
			// Character already has it?
			$CharacterQuest = CharacterQuest::where(['character_id' => $Character->id, 'quests_id' => $PickupQuest->id])->first();

			if (!$CharacterQuest)
				{
				// Don't already have it -- can we get it?
				if ($PickupQuest->eligible($Character))
					{
					// Get it!
					$CharacterQuest = new CharacterQuest;
					$CharacterQuest->fill(['character_id' => $Character->id, 'quests_id' => $PickupQuest->id]);
					$CharacterQuest->save();
					// Also the criterias?
					foreach ($PickupQuest->criterias() as $criteria)
						{
						$CharacterQuestCriteria = new CharacterQuestCriteria;
						$CharacterQuestCriteria->fill(['character_id' => $Character->id, 'quest_criterias_id' => $criteria->id, 'character_quests_id' => $CharacterQuest->id, 'progress' => 0, 'complete' => false]);
						$CharacterQuestCriteria->save();
						}
					$request_params['quest_text'] = $PickupQuest->description;
					}
				}
			}

		$TurninQuest = Quest::where(['turnin_rooms_id' => $Room->id])->first();

		if ($TurninQuest)
			{
			$CharacterQuest = CharacterQuest::where(['character_id' => $Character->id, 'quests_id' => $PickupQuest->id])->first();

			if ($CharacterQuest)
				{
				// Just a quick refresh
				$CharacterQuest->check_completes();
				// die(print_r($CharacterQuest));
				if ($CharacterQuest->complete && !$CharacterQuest->rewarded)
					{
					$this->reward_character($CharacterQuest, $Character);
					$request_params['quest_text'] = $TurninQuest->completion_message;
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

		// $character = array_merge($Character->pluck(), $Characters->pluck());;
		if ($request->ajax())
			{
			$view = \View::make('game/main', $request_params);
			$sections = $view->renderSections();
			return $sections;
			}

		return view('game/main', $request_params);
		}

	public function menu(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);

		$request_params = ['character' => $Character];
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

	public function move(Request $request)
		{
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
			// TODO: Area Restrictions? + Racial Mod
			if ($Character->intelligence < $NextRoom->zone()->intelligence_req)
				{
				// Oops!
				Session::flash('zone_travel', 'You cannot go that way yet, you must train some more.');
				return $this->index($request);
				}
			}

		// We made it
		// TODO: Refactor
		$QuestCriteria = QuestCriteria::where(['zone_target' => $NextRoom->zones_id])->first();
		if ($QuestCriteria)
			{
			// This zone is used for a task... Does the character have it?
			$CharacterQuestCriteria = CharacterQuestCriteria::where(['character_id' => $Character->id, 'quest_criterias_id' => $QuestCriteria->id, 'complete' => false])->first();
			if ($CharacterQuestCriteria)
				{
				// Let's complete it!
				$CharacterQuestCriteria->complete();
				}
			}

		$Character->last_rooms_id = $request->room_id;
		$Character->save();

		// Clear up any combat logs?  Remove last_room?
		$CombatLog = CombatLog::where(['characters_id' => $Character->id, 'npcs_id' => $request->npc_id, 'rooms_id' => $CurrentRoom->id])->first();
		if ($CombatLog)
			{
			// check room?  $CombatLog->room_id == $request->room_id ??
			$CombatLog->delete();
			}

		return $this->index($request);
		}

	public function combat(Request $request)
		{
		// error_log('Start combat');
		$Character = Character::findOrFail($request->character_id);
		$Room = Room::findOrFail($request->room_id);
		if ($Character->health <= 0)
			{
			return $this->death($request);
			}

		$flat_npc = null;
		$CombatLog = CombatLog::where(['characters_id' => $Character->id, 'npcs_id' => $request->npc_id, 'rooms_id' => $request->room_id])->first();
		if ($CombatLog)
			{
			$Npc = Npc::findOrFail($request->npc_id);
			$flat_npc = $Npc->toArray();
			$flat_npc['health'] = $CombatLog->remaining_health;
			}
		else
			{
			$Npc = Npc::findOrFail($request->npc_id);
			$flat_npc = $Npc->toArray();
			}

		$combat_log = [];
		$reward_log = [];
		// $flat_npc = $Npc->toArray();
		// $Equipment = Equipment::where(['characters_id' => $Character->id])->first();
		// Calculate attacks:
		$attack_count = (int)($Character->dexterity / 20) + 2;
		$total_damage = 0;
		$low_damage = $Character->constitution;
		$high_damage = $Character->strength;
		// $current_fatigue = $Character->fatigue;
		$flat_character = $Character->toArray();
		$fatigue_use = 1;
		$attack_text = 'You grope with your fists';
		$combat_history = [];

		$base_accuracy = 0.80;
		// $base_dodge = 0.05;
		// $base_crit = 0.05;
		// $crit_multipler_low = 2.0;
		// $crit_multipler_high = 4.0;
		if ($Character->equipment()->weapon)
			{
			// die(print_r($Character->equipment()->weapon()->toArray()));
			$low_damage = $low_damage + $Character->equipment()->weapon()->damage_low;
			$high_damage = $high_damage + $Character->equipment()->weapon()->damage_high;
			$attack_text = $Character->equipment()->weapon()->attack_text;
			// check weapon requirements:
			$fatigue_use = 1.5;
			$stat_check = $Character->equipment()->weapon()->required_stat;
			if ($Character->$stat_check < $Character->equipment()->weapon()->required_amount)
				{
				$fatigue_use = 3;
				}
			}

		// $combat_notes['attack_text'] = $attack_text;

		while ($flat_npc['health'] > 0)
			{
			$start_time = time();
			if ($flat_character['health'] <= 0 || $flat_npc['health'] <= 0)
				{
				break;
				}				

			$round_damage = 0;
			$round_damages = [];
			$miss_count = 0;
			// npc
			$npc_damages = [];
			$npc_round_damage = 0;
			$npc_absorbs = 0;
			$no_fatigue = false;
			// We attack first:
			foreach (range(1, $attack_count) as $i)
				{
				if ($flat_npc['health'] <= 0)
					{
					break;
					}

				if ($flat_character['fatigue'] < $fatigue_use)
					{
					$no_fatigue = true;
					break;
					}

				$flat_character['fatigue'] = $flat_character['fatigue'] - $fatigue_use;

				$acc_check = rand() / getrandmax();
				if ($acc_check <= $base_accuracy)
					{
					$calc_damage = rand($low_damage, $high_damage);
					$actual_damage = (int)($calc_damage * (1.0 - $flat_npc['armor']));

					$flat_npc['health'] = $flat_npc['health'] - $actual_damage;
					$round_damage += $actual_damage;
					$round_damages[] = $actual_damage;
					}
				else
					{
					$round_damages[] = 0;
					$miss_count++;
					}
				}

			if ($flat_npc['health'] > 0)
				{
				// Then npc:
				foreach (range(1, $flat_npc['attacks_per_round']) as $i)
					{
					$calc_damage = rand($flat_npc['damage_low'], $flat_npc['damage_high']);
					$npc_damage = $calc_damage - $Character->equipment()->calculate_armor();
					if ($npc_damage <= 0)
						{
						// No damage:
						$npc_damages[] = 0;
						$npc_absorbs++;
						}
					else
						{
						$flat_character['health'] = $flat_character['health'] - $npc_damage;
						$npc_damages[] = $npc_damage;
						$npc_round_damage += $npc_damage;

						if ($flat_character['health'] <= 0)
							{
							break;
							}	
						}
					}
				}

			// Record the round:
			$arr = [
				'attack_text' => $attack_text,
				'attack_count' => count(array_filter($round_damages, function($i) {return $i > 0 ? $i : null;})) + $miss_count,
				'miss_count' => $miss_count,
				'attacks' => $round_damages,
				'round_damage' => $round_damage,
				'npc_text' => $flat_npc['attack_text'],
				'npc_att_count' => $flat_npc['attacks_per_round'],
				'npc_round' => $npc_round_damage,
				'npc_attacks' => $npc_damages,
				'no_fatigue' => $no_fatigue,
				];

			// player died:
			if ($flat_character['health'] <= 0)
				{
				$arr['pc_died'] = true;
				}

			$combat_history[] = $arr;

			$finish = time() - $start_time;
			error_log("This round took $finish seconds.");

			// We ran out of fatigue:
			if ((int)$flat_character['fatigue'] < $fatigue_use)
				{
				break;
				}

			// If the npc died:
			if ($flat_npc['health'] <= 0)
				{
				break;
				}

			if ($request->submit != 'all_out')
				{
				break;
				}
			}

		// Int fatigue first:
		$flat_character['fatigue'] = round($flat_character['fatigue'], 0);
		// Save the character record based on the $flat_character:
		$Character->fill($flat_character);
		$Character->save();
		$Character->fresh();

		$reward_log = [];

		// Out of the loop, who died?
		if ($flat_npc['health'] > 0 && $flat_character['health'] > 0)
			{
			// $request->session()->put('combat.'.$Character->id, $flat_npc);
			if ($CombatLog)
				{
				$CombatLog->remaining_health = $flat_npc['health'];
				}
			else
				{
				$CombatLog = new CombatLog;
				$CombatLog->fill([
					'characters_id' => $Character->id,
					'npcs_id' => $Npc->id,
					'rooms_id' => $request->room_id,
					'remaining_health' => $flat_npc['health'],
					'expires_on' => time() + 1800
					]);
				}
			$CombatLog->save();
			}
		elseif ($flat_npc['health'] <= 0)
			{
			// Clean up session?
			$request->session()->pull('npc.'.$Room->id);
			// npc died
			// $combat_log[] = "$Npc->name is dead!!!";
			// $combat_log['npc_killed'] = true;
			$reward_log[] = "You beat the poor creature down to a bloody pulp.  With a last breath it dies.";
			// clean session:
			// $request->session()->pull('combat.'.$Character->id);
			if ($CombatLog)
				{
				$CombatLog->delete();
				$CombatLog = null;
				}

			// Record the kill:
			$KillCount = KillCount::where(['characters_id' => $Character->id, 'npcs_id' => $Npc->id])->first();
			if ($KillCount)
				{
				$KillCount->count = $KillCount->count + 1;
				}
			else
				{
				$KillCount = new KillCount;
				$KillCount->fill([
					'characters_id' => $Character->id,
					'npcs_id' => $Npc->id,
					'count' => 1
					]);
				}

			$KillCount->save();

			$xp_variation = rand()/getrandmax()*($Npc->xp_variation*2)-$Npc->xp_variation;
			$actual_xp = (int)($Npc->award_xp * (1.0 + $xp_variation));

			$gold_variation = rand()/getrandmax()*($Npc->gold_variation*2)-$Npc->gold_variation;

			$actual_gold = (int)($Npc->award_gold * (1.0 + $gold_variation));
			if ($actual_gold == 0)
				{
				$actual_gold = 1;
				}

			$Character->xp += $actual_xp;
			$Character->gold += $actual_gold;
			$Character->save();
			$reward_log[] = "You received $actual_xp xp.";

			$reward_log[] = "You received $actual_gold gold.";
			$reward_log[] = '';

			$LootTables = LootTable::where(['npcs_id' => $request->npc_id])->get();

			if (count($LootTables) > 0)
				{
				foreach ($LootTables as $LootTable)
					{
					$prob = rand()/getrandmax();
					if ($prob <= $LootTable->chance)
						{
						// TODO: So we actually want to add this to the session instead:
						if ($request->session()->has('loot.'.$request->room_id))
							{
							$current_items = $request->session()->get('loot.'.$request->room_id);
							if (!in_array($LootTable->items_id, $current_items))
								{
								$request->session()->push('loot.'.$request->room_id, $LootTable->items_id);
								}
							}
						else
							{
							$request->session()->put('loot.'.$request->room_id, [$LootTable->items_id]);
							}
						}
					}
				}

			}
		elseif ($flat_character['health'] <= 0)
			{
			// we died:
			// return $this->death($request);
			}
		else
			{
			// ??
			}

		// Does the room have loot?
		$ground_items = [];
		$loot_items = $request->session()->get('loot.'.$Room->id);
		if (isset($loot_items))
			{
			$item_ids = [];
			foreach ($loot_items as $loot_item)
				{
				$item_ids[] = $loot_item;
				}
			$ground_items = Item::whereIn('id', $item_ids)->get();
			}

		$no_attack = $Character->fatigue > 0 ? false : true;
		if ($CombatLog)
			{
			$no_attack = false;
			}

		// Test:
		$new_combat = $this->generate_combat_log($combat_history, $Character);
		// die(print_r($result));

		$request_params = ['character' => $Character, 'room' => $Room, 'npc' => null, 'combat_log' => $new_combat, 'reward_log' => $reward_log, 'ground_items' => $ground_items, 'no_attack' => $no_attack];

		if (isset(auth()->user()->admin_level) && auth()->user()->admin_level > 0)
			{
			$request_params['is_admin'] = true;
			}

		$request_params['directions'] = $Room->generate_directions($Character);

		if ($flat_character['health'] <= 0)
			{
			$Character->death();
			$Character->fresh();
			$Room = Room::findOrFail($Character->last_rooms_id);
			if ($request->ajax())
				{
				$view = \View::make('game/main', $request_params);
				$sections = $view->renderSections();
				return $sections;
				}
			}

		if ($CombatLog)
			{
			// debug:
			$request_params['combat'] = $CombatLog->fresh();
			$request_params['timer'] = true;
			$request_params['npc'] = $Npc;
			}

		if ($request->ajax())
			{
			$view = \View::make('game/main', $request_params);
			$sections = $view->renderSections();
			return $sections;
			}

		return view('game/main', $request_params);
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
		$Character->last_rooms_id = 1;
		$Character->save();
		$request->death = true;
		return $this->index($request);
		}

	public function item_pickup(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);

		$current_list = $request->session()->get('loot.'.$request->room_id);

		// $request->no_spawn = true;
		$received = $Character->inventory()->add_item($request->item_id);
		if (!$received)
			{
			$request->no_carry = true;
			}
		else
			{
			if (($key = array_search($request->item_id, $current_list)) !== false)
				{
				unset($current_list[$key]);
				}

			$request->session()->put('loot.'.$request->room_id, $current_list);
			}

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
		// My old calc:
		// $cost = 5.0 * $cost_adjustment;
		$cost = $cost_adjustment;
		$result  = $current_stat * ($current_stat * $cost) - $current_stat;
		return (int)$result;
		}

	public function calculate_spell_training_cost(Request $request)
		{
		// do some stuff:
		return true;
		}

	public function calculate_training_cost(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// $Character = Character::where(['characters.id' => $request->character_id])->first();

		// $StatCost = StatCost::first();
		$StatCost = StatCost::where(['player_races_id' => $Character->player_races_id])->first();

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
		$StatCost = StatCost::where(['player_races_id' => $Character->player_races_id])->first();

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
		// die(print_r($request->all()));
		$healing = false;
		if ($request->action == 'heal')
			{
			// die(print_r($request->all()));
			$healing = true;
			// $Character = Character::where(['character_stats.characters_id' => $request->character_id])->first();
			$Character = Character::findOrFail($request->character_id);

			$healing_amount = ($Character->constitution * 0.6 + $Character->strength * 0.3);
			$Character->health = $Character->health + (int)$healing_amount;
			if ($Character->health > $Character->max_health)
				{
				$Character->health = $Character->max_health;
				}

			$fatigue_amount = ($Character->constitution * 0.6 + $Character->strength * 0.3 + $Character->dexterity * 0.2);
			$Character->fatigue = $Character->fatigue + (int)$fatigue_amount;
			if ($Character->fatigue > $Character->max_fatigue)
				{
				$Character->fatigue = $Character->max_fatigue;
				}

			$mana_amount = ($Character->intelligence * 0.4 + $Character->wisdom * 0.4);
			$Character->mana = $Character->mana + (int)$mana_amount;
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

		if ($request->action == 'equip')
			{
			// die('stuff');
			if ($request->weapon > 0)
				{
				$Equipment->weapon = $request->weapon;
				}
			else
				{
				$Equipment->weapon = null;
				}

			if ($request->shield > 0)
				{
				$Equipment->shield = $request->shield;
				}
			else
				{
				$Equipment->shield = null;
				}

			if ($request->head > 0)
				{
				$Equipment->head = $request->head;
				}
			else
				{
				$Equipment->head = null;
				}

			if ($request->neck > 0)
				{
				$Equipment->neck = $request->neck;
				}
			else
				{
				$Equipment->neck = null;
				}			

			if ($request->chest > 0)
				{
				$Equipment->chest = $request->chest;
				}
			else
				{
				$Equipment->chest = null;
				}

			if ($request->legs > 0)
				{
				$Equipment->legs = $request->legs;
				}
			else
				{
				$Equipment->legs = null;
				}

			if ($request->hands > 0)
				{
				$Equipment->hands = $request->hands;
				}
			else
				{
				$Equipment->hands = null;
				}

			if ($request->feet > 0)
				{
				$Equipment->feet = $request->feet;
				}
			else
				{
				$Equipment->feet = null;
				}

			if ($request->amulet > 0)
				{
				$Equipment->amulet = $request->amulet;
				}
			else
				{
				$Equipment->amulet = null;
				}

			if ($request->left_ring > 0)
				{
				$Equipment->left_ring = $request->left_ring;
				}
			else
				{
				$Equipment->left_ring = null;
				}

			if ($request->right_ring > 0)
				{
				$Equipment->right_ring = $request->right_ring;
				}
			else
				{
				$Equipment->right_ring = null;
				}

			if ($request->bracelet > 0)
				{
				$Equipment->bracelet = $request->bracelet;
				}
			else
				{
				$Equipment->bracelet = null;
				}

			$Equipment->save();
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
			$Item = Item::findOrFail($request->item);
			if ($Item->item_types_id != 4)
				{
				// error?
				return true;
				}
			$ItemFood = ItemFood::where(['items_id' => $Item->id])->first();
			$Character->heal($ItemFood->potency);
			$Character->inventory()->remove_item($request->item);
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
				$arr = $Item->toArray();
				$arr['quantity'] = $inv_item->quantity;
				$arr['selected'] = false;
				if (isset($request->item) && $Item->id == $request->item)
					{
					$arr['selected'] = true;
					}
				// $items[] = $Item;
				$items[] = $arr;
				}
			}

		$Character = Character::findOrFail($request->character_id);

		return view('character/food', ['character' => $Character, 'items' => $items]);
		}

	public function purchase(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// $Room = Room::findOrFail($request->room_id);
		// Probably auth some stuff about the store:
		$Shop = Shop::findOrFail($request->shop_id);

		// Then we find the item:
		// $PurchaseItem = $Shop->shop_items()->where(['id' => $request->item_purchase])->first();
		$PurchaseItem = ShopItem::where(['id' => $request->item_purchase, 'shops_id' => $Shop->id])->first();

		// $PurchaseItem->item();

		// die(print_r($PurchaseItem->first()));

		// $request_params = ['character' => $Character, 'room' => $Room, 'shop' => $Shop];
		// $price = $PurchaseItem->item()->value * $PurchaseItem->markup;
		$price = $PurchaseItem->get_cost($Character->charisma);

		if ($Character->gold < $price)
			{
			// $request->insufficient_funds = true;
			// die('price');
			Session::flash('purchase', 'You cannot afford that!');
			return $this->index($request);
			// $request_params['insufficient_funds'] = true;
			// return view('game/main', $request_params);
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
			$request->no_carry = true;
			}

		return $this->index($request);
		}

	public function sell(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// $Room = Room::findOrFail($request->room_id);
		// Probably auth some stuff about the store:
		$Shop = Shop::findOrFail($request->shop_id);

		$SellItem = InventoryItem::findOrFail($request->item_sell);

		// if not, throw error?

		$earnings = round($SellItem->item()->value * 0.01, 0);
		
		
		$sold = $Character->inventory()->remove_item($SellItem->item()->id);
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
		$Character->inventory()->remove_item($request->forge_weapon);
		$Character->inventory()->remove_item($request->forge_armor);
		$Character->inventory()->remove_item($request->forge_food);
		$Character->inventory()->remove_item($request->forge_jewel);
		$Character->inventory()->remove_item($request->forge_dust);
		$Character->inventory()->add_item($ForgeRecipe->result_items_id);
		Session::flash('forged', 'You have successfully forged a '.$ForgeRecipe->result_item()->name);

		return $this->index($request);
		}

	public function deposit(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		if ($request->deposit > $Character->gold)
			{
			Session::flash('bank', 'You do not have that much gold!');
			return $this->index($request);
			}
		$Character->gold = $Character->gold - $request->deposit;
		$Character->bank = $Character->bank + $request->deposit;
		$Character->save();
		Session::flash('bank', 'You deposited '.$request->deposit.' gold into the bank.');
		return $this->index($request);
		}

	public function withdraw(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		if ($request->withdraw > $Character->bank)
			{
			Session::flash('bank', 'You do not have that much gold in the bank!');
			return $this->index($request);
			}
		$Character->bank = $Character->bank - $request->withdraw;
		$Character->gold = $Character->gold + $request->withdraw;
		$Character->save();
		Session::flash('bank', 'You withdraw '.$request->withdraw.' gold from the bank.');
		return $this->index($request);
		}

	public function consider(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		$Npc = Npc::findOrFail($request->npc_id);

		$request->session()->put('npc.'.$request->room_id, $Npc->id);

		if ($Npc->attacks_per_round > 1)
			{
			if ($Character->health >= $Npc->damage_high * $Npc->attacks_per_round)
				{
				Session::flash('consider', 'You will probably survive all attacks');
				}
			elseif ($Character->health >= $Npc->damage_high)
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
			if ($Character->health >= $Npc->damage_high)
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
		$Alignment = Character::findOrFail($request->alignments_id);

		$Character->alignments_id = $Alignment->id;
		$Character->save();

		return $this->index($request);
		}

	public function send(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);

		// find send to:
		$ToCharacter = Character::where('name', $request->send_character)->first();

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
		$Character->inventory()->remove_item($InventoryItem->item()->id);

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
		$Character = Character::findOrFail($request->character_id);
		// $Room = Room::findOrFail($request->room_id);
		$Character->last_rooms_id = $request->room_id;
		$Character->save();

		return $this->index($request);
		}

	public function reward_character($CharacterQuest, $Character)
		{
		$reward = $CharacterQuest->quest()->reward();

		$Character->xp = $Character->xp + $reward->xp_reward;
		$Character->gold = $Character->gold + $reward->gold_reward;
		$Character->quest_points = $Character->quest_points + $reward->quest_point_reward;
		$Character->save();

		$CharacterQuest->rewarded = true;
		$CharacterQuest->save();
		}

	public function generate_combat_log($combat_history, $Character)
		{
		$condensed = [];
		if ($Character->settings()->brief_mode)
			{
			foreach ($combat_history as $log_entry)
				{
				$condensed[] = $log_entry['attack_text'].'<br>';
				if ($log_entry['no_fatigue'])
					{
					$condensed[] = 'You are too tired to attack.<br>';
					}
				else
					{
					$condensed[] = 'You made attacks '.$log_entry['attack_count'].' and missed '.$log_entry['miss_count'].' times.<br>';
					$condensed[] = 'You did '.$log_entry['round_damage'].' damage.<br>';
					}

				if ($log_entry['npc_round'] > 0)
					{
					$condensed[] = $log_entry['npc_text'].', doing '.$log_entry['npc_round'].' damage.<br>';
					}

				if (isset($log_entry['pc_died']))
					{
					$condensed[] = 'You have died!</br><form method="post" action="/game">'.csrf_field().'<input type="hidden" name="character_id" value="'.$Character->id.'"><input type="submit" value="Continue"></form>';
					}
				}
			}
		else
			{
			foreach ($combat_history as $log_entry)
				{
				foreach ($log_entry['attacks'] as $attack)
					{
					if ($attack > 0)
						{
						$condensed[] = $log_entry['attack_text'].", for $attack damage!<br>";
						}
					else
						{
						$condensed[] = 'You missed!<br>';
						}

					if ($log_entry['no_fatigue'])
						{
						$condensed[] = 'You are too tired to attack.<br>';
						}
					}

				foreach ($log_entry['npc_attacks'] as $npc_attack)
					{
					if ($npc_attack > 0)
						{
						$condensed[] = $log_entry['npc_text'].", doing $npc_attack damage.<br>";
						}
					else
						{
						$condensed[] = 'The enemy could not get through your armor!<br>';
						}
					}

				if (isset($log_entry['pc_died']))
					{
					$condensed[] = 'You have died!</br><form method="post" action="/game">'.csrf_field().'<input type="hidden" name="character_id" value="'.$Character->id.'"><input type="submit" value="Continue"></form>';
					}
				}
			}

		return $condensed;
		}
	}