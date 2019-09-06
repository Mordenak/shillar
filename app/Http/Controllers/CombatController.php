<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CombatController extends Controller
{
	/*
	public function old_combat(Request $request)
		{
		// TODO: Refactor, performance is awful at higher levels
		$Character = Character::where(['characters.id' => $request->character_id])->first();
		// $Character = Character::where(['character_stats.characters_id' => $request->character_id])->first();

		// Safety:
		if ($Character->health <= 0)	
			{
			// return $this->death($request);
			}
		
		$flat_creature = null;

		$CombatLog = CombatLog::where(['characters_id' => $Character->id, 'creatures_id' => $request->creature_id, 'rooms_id' => $request->room_id])->first();

		if ($CombatLog)	
			{
			// die('something');
			$Creature = Creature::findOrFail($request->creature_id);
			// $Creature = Creature::where(['creatures.id' => $request->creature_id])->join('creature_stats', 'creatures.id', '=', 'creature_stats.creatures_id')->first();
			// $flat_creature = $request->session()->get('combat.'.$Character->id);
			$flat_creature = $Creature->toArray();
			$flat_creature['health'] = $CombatLog->remaining_health;
			// die(print_r($flat_creature);
			}
		else
			{
			// die('no combat log?');
			$Creature = Creature::findOrFail($request->creature_id);
			// $Creature = Creature::where(['creatures.id' => $request->creature_id])->join('creature_stats', 'creatures.id', '=', 'creature_stats.creatures_id')->first();
			$flat_creature = $Creature->toArray();
			// $request->session()->put('combat.'.$Character->id, $Creature->toArray());
			}
		

		$combat_log = [];
		$reward_log = [];
		// $flat_creature = $Creature->toArray();
		$Equipment = Equipment::where(['characters_id' => $Character->id])->first();
		// $total_fatigue = 0;
		$combat_log['begin'] = "You attacked $Creature->name";
		while ($flat_creature['health'] > 0)
			{
			if ($Character->health <= 0)
				{
				break;
				}

			$character_attacks = 1;
			if ($Character->dexterity > 10)
				{
				$character_attacks = 2;
				$attack_calc = ($character_attacks + ($Character->dexterity - 10) / 20);
				$character_attacks = (int)$attack_calc;
				}

			// $combat_log[] = "number of attacks: $character_attacks";
			$base_accuracy = 0.80;
			$base_dodge = 0.05;
			$base_crit = 0.05;
			$crit_multipler_low = 2.0;
			$crit_multipler_high = 4.0;

			$fatigue_use = 1;
			// $fatigue_used = 0;
			while ($character_attacks > 0)
				{
				$character_attacks--;

				// roll for accuracy:
				$acc_check = rand() / getrandmax();
				if ($acc_check >= $base_accuracy)
					{
					// $combat_log[] = "You missed!";
					$combat_log['attacks'][] = 0;
					$combat_log['pc_miss'] = isset($combat_log['pc_miss']) ? $combat_log['pc_miss']+1 : 1;
					continue;
					}
				
				$attack_text = 'Your fists graze the enemy';
				$low_damage = 1 + $Character->constitution;
				$high_damage = 10 + $Character->strength;
				if ($low_damage > $high_damage)
					{
					$low_damage = $high_damage;
					}
				// $fatigue_use = 1;
				if ($Character->equipment()->weapon)
					{
					$weapon_id = $Character->inventory()->inventory_items()->where(['id' => $Character->equipment()->weapon])->first();
					$ItemWeapon = ItemWeapon::where(['items_id' => $weapon_id->items_id])->first();
					$attack_text = $ItemWeapon->attack_text;
					// $fatigue_use = $fatigue_use + $ItemWeapon->fatigue_use;
					$fatigue_use = 2;
					$low_damage = $Character->constitution + $ItemWeapon->damage_low;
					$high_damage = $Character->strength + $ItemWeapon->damage_high;
					if ($low_damage > $high_damage)
						{
						$low_damage = $high_damage;
						}
					}
				$combat_log['attack_text'] = $attack_text;
				$damage = rand($low_damage, $high_damage);
				
				// $total_fatigue = $total_fatigue + $fatigue_use;
				if (($Character->fatigue - $fatigue_use) < 0)
					{
					$Character->fatigue = 0;
					}
				else
					{
					$Character->fatigue = $Character->fatigue - $fatigue_use;
					}
				$Character->save();
				$flat_creature['health'] = $flat_creature['health'] - $damage;
				// $combat_log[] = "$attack_text $Creature->name for $damage damage.";
				// $combat_log['pc_attacks'][] = "$attack_text $Creature->name for $damage damage.";
				$combat_log['attacks'][] = $damage;

				if ($flat_creature['health'] <= 0)
					{
					break;
					}
				}

			if ($flat_creature['health'] <= 0)
				{
				break;
				}

			// creature attack
			$damage_resist = $Equipment->calculate_armor();
			// $Creature->attacks_per_round
			// $Creature->damage_types_id
			$creature_attacks = $Creature->attacks_per_round;
			while ($creature_attacks > 0)
				{
				$creature_attacks--;
				$creature_damage = rand($Creature->damage_low, $Creature->damage_high);
				$creature_damage = $creature_damage - $damage_resist;
				if ($creature_damage <= 0)
					{
					// $combat_log[] = "$Creature->name cannot break through your armor!";
					$combat_log['no_damage'] = isset($combat_log['no_damage']) ? $combat_log['no_damage'] + 1 : 0;
					}
				else
					{
					$Character->health = $Character->health - $creature_damage;
					// $combat_log[] = "$Creature->name dealt $creature_damage to you!";
					// $combat_log['creature_attacks'][] = "$Creature->name dealt $creature_damage to you!";
					$combat_log['damage_taken'][] = $creature_damage;
					$Character->save();
					if ($Character->health <= 0)
						{
						break;
						}	
					}
				}

			// if single round:
			if ($request->submit != 'all_out')
				{
				break;
				}
			}

		$no_attack = $Character->fatigue > 0 ? false : true;

		// $combat_log[] = "Made it here with: ". $Character->health. "health";
		if ($flat_creature['health'] > 0 && $Character->health > 0)
			{
			// $request->session()->put('combat.'.$Character->id, $flat_creature);
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
					'expires_on' => time() + 1800
					]);
				}
			$CombatLog->save();
			}
		elseif ($flat_creature['health'] <= 0)
			{
			// $combat_log[] = "$Creature->name is dead!!!";
			$combat_log['creature_killed'] = true;
			// clean session:
			// $request->session()->pull('combat.'.$Character->id);
			if ($CombatLog)
				{
				$CombatLog->delete();
				}

			// Record the kill:
			$KillCount = KillCount::where(['characters_id' => $Character->id, 'creatures_id' => $Creature->id])->first();
			if ($KillCount)
				{
				$KillCount->count = $KillCount->count + 1;
				}
			else
				{
				$KillCount = new KillCount;
				$KillCount->fill([
					'characters_id' => $Character->id,
					'creatures_id' => $Creature->id,
					'count' => 1
					]);
				}

			$KillCount->save();


			// $RewardTable = RewardTable::where(['reward_tables.creatures_id' => $request->creature_id])->first();

			// $actual_xp = (float)$RewardTable->award_xp * $RewardTable->xp_variation;
			$xp_variation = rand()/getrandmax()*($Creature->xp_variation*2)-$Creature->xp_variation;

			// $xp_variation = mt_rand() / mt_getrandmax();
			// $combat_log[] = "pre-variation: $xp_variation";
			// $xp_variation = round($xp_variation, 2);
			// $combat_log[] = "variation: $xp_variation";
			$actual_xp = (int)($Creature->award_xp * (1.0 + $xp_variation));

			$gold_variation = rand()/getrandmax()*($Creature->gold_variation*2)-$Creature->gold_variation;

			// $combat_log[] = "pre-variation: $gold_variation";
			// $gold_variation = round($gold_variation, 1);
			// $combat_log[] = "variation: $gold_variation";
			$actual_gold = (int)($Creature->award_gold * (1.0 + $gold_variation));
			// Never less than 1:
			if ($actual_gold == 0)
				{
				$actual_gold = 1;
				}

			// die($actual_xp);
			// $actual_xp = $RewardTable->award_xp;
			// die($actual_xp);

			$Character->xp += $actual_xp;
			$Character->gold += $actual_gold;
			$Character->save();
			// $reward_log[] = '';
			$reward_log[] = "You received $actual_xp xp.";
			// $Wallet = Wallet::where(['wallets.characters_id' => $request->character_id])->first();
			// die(print_r($Wallet));
			$reward_log[] = "You received $actual_gold gold.";
			$reward_log[] = '';

			$LootTables = LootTable::where(['creatures_id' => $request->creature_id])->get();

			// This should be an item id?
			// die(print_r($Character->inventory()));
			// die('..:'.$LootTable->items_id);
			// die(print_r('::'.$LootTables->count()));
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
							// die(print_r($request->session()->get('loot_'.$request->room_id)));
							// ignore 2 entries:
							}
						else
							{
							$request->session()->put('loot.'.$request->room_id, [$LootTable->items_id]);
							}
						// die(print_r($LootTable->items()->first()));
						// $Character->inventory()->addItem($LootTable->items_id);
						}
					}
				}
			// $LootTable;
			}
		else
			{

			}
		// elseif ($Character->health <= 0)
		// 	{
		// 	// $combat_log[] = 'You have died!';
		if ($Character->health <= 0)
			{
			$combat_log['pc_killed'] = true;
			}
		// 	return $this->death($request, );
		// 	}
		// else
			// {
			// nothing?
			// }

		// Combat log will recorded differently if the user setting is on?
		$UserSetting = UserSetting::where(['users_id' => auth()->user()->id])->first();
		$formatted_log = [];
		if ($UserSetting->short_mode)
			{
			$total_attacks = 0;
			if (isset($combat_log['attacks']))
				{
				$total_attacks = count($combat_log['attacks']);
				}

			$total_miss = 0;
			if (isset($combat_log['pc_miss']))
				{
				// die(print_r($combat_log['pc_miss']));
				$total_miss = $combat_log['pc_miss'];
				}
			// shorten:
			// die(print_r(count($combat_log['attacks'])));
			// sum up the attacks:
			$damage = isset($combat_log['attacks']) ? array_sum($combat_log['attacks']) : 0;
			$formatted_log[] = $combat_log['begin'];
			// $formatted_log[] = isset($combat_log['attack_text']) ? $combat_log['attack_text'] : '';
			if ($Character->equipment()->weapon)
				{
				$ItemWeapon = ItemWeapon::where(['items_id' => $Character->equipment()->weapon()->first()->items_id])->first();
				$formatted_log[] = $ItemWeapon->attack_text;
				}
			else
				{
				$formatted_log[] = "Your fists grope the enemy";
				}
			$formatted_log[] = "You made $total_attacks attacks and missed $total_miss times.";
			if ($damage > 0)
				{
				$formatted_log[] = "You did $damage points of damage.";
				}

			if (isset($combat_log['damage_taken']))
				{
				$formatted_log[] = "$Creature->attack_text";
				$formatted_log[] = "$Creature->name hit you ".count($combat_log['damage_taken'])." times for ".array_sum($combat_log['damage_taken'])." damage.";
				}
			else
				{
				if (isset($combat_log['no_damage']) && $combat_log['no_damage'])
					{
					$formatted_log[] = "$Creature->attack_text";
					$formatted_log[] = "$Creature->name couldn't get through your armor!";
					}
				}

			if (isset($combat_log['creature_killed']))
				{
				$formatted_log[] = "$Creature->name is dead!!!";
				}
			
			}
		else
			{
			// die(print_r($formatted_log));
			// everything:
			foreach ($combat_log as $entry)
				{
				$formatted_log[] = $entry;
				}
			}

		$Character = Character::findOrFail($request->character_id);
		$Room = Room::findOrFail($request->room_id);
		// return $this->index($request);

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

		$request_params = ['character' => $Character, 'room' => $Room, 'creature' => null, 'combat_log' => $formatted_log, 'reward_log' => $reward_log, 'ground_items' => $ground_items, 'no_attack' => $no_attack];

		if ($Character->health <= 0)
			{
			$request->combat_log = $request_params['combat_log'];
			return $this->death($request);
			}

		// Refresh the model variable:
		$CombatLog = CombatLog::where(['characters_id' => $Character->id, 'creatures_id' => $request->creature_id, 'rooms_id' => $request->room_id])->first();
		// if  ($request->session()->has('combat.'.$Character->id))
		if ($CombatLog)
			{
			// debug:
			$request_params['combat'] = $CombatLog;
			$request_params['timer'] = true;
			$request_params['creature'] = $Creature;
			}

		if (isset(auth()->user()->admin_level) && auth()->user()->admin_level > 0)
			{
			$request_params['is_admin'] = true;
			}

		if ($request->ajax())
			{
			$view = \View::make('game/main', $request_params);
			$sections = $view->renderSections();
			return $sections;
			}

		return view('game/main', $request_params);
		}
	*/
}
