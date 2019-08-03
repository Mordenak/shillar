<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;
use App\CharacterStats;
use App\Room;
use App\SpawnRule;
use App\Npc;
use App\RewardTable;
use App\LootTable;
use App\CharacterStat;
use App\Wallet;

class GameController extends Controller
{
    //
    public function index(Request $request)
    	{
    	// The request should have a character for us:
    	// die(print_r($request->all()));
    	// $Character = Character::findOrFail($request->character_id);
    	$Character = Character::where(['characters.id' => $request->character_id])
    		->join('character_stats', 'character_stats.characters_id', '=', 'characters.id')
    		->join('wallets', 'wallets.characters_id', '=', 'characters.id')->first();
    		// ->select('character_stats.id as character_stats_id, *');

    	$Room = Room::findOrFail($Character->last_rooms_id);

    	// Find spawn rules for room:
    	$SpawnRule = SpawnRule::where(['rooms_id' => $Room->id])->first();

    	$Npc = null;
    	if ($SpawnRule)
    		{
    		$Npc = Npc::where(['id'=> $SpawnRule->npcs_id])->first();
    		}

    	// die(print_r($Character->playerrace()->name()))s;

    	// $CharacterStats = CharacterStats::where(['characters_id' => $Character->id])
    	// 	->join('character_stats', 'characters.id', '=', 'character_stats.character_id');

    	// $character = array_merge($Character->pluck(), $CharacterStats->pluck());

    	return view('game/main', ['character' => $Character, 'room' => $Room, 'npc' => $Npc]);
    	}

    public function move(Request $request)
    	{
    	// Move the character:
    	// return $request->room_id;
    	// return $request->character_id;
    	// return "test";

    	$Character = Character::findOrFail($request->character_id);

    	// $Character->set(['last_rooms_id' => $request->room_id]);
    	$Character->last_rooms_id = $request->room_id;
    	$Character->save();

    	// return true;

    	$Character = Character::where(['characters.id' => $request->character_id])
    		->join('character_stats', 'character_stats.characters_id', '=', 'characters.id')
    		->join('wallets', 'wallets.characters_id', '=', 'characters.id')->first();

    	$Room = Room::findOrFail($Character->last_rooms_id);

    	// Find spawn rules for room:
    	$SpawnRule = SpawnRule::where(['rooms_id' => $Room->id])->first();

    	$Npc = null;
    	if ($SpawnRule)
    		{
    		$Npc = Npc::where(['id'=> $SpawnRule->npcs_id])->first();
    		}

    	return view('game/main', ['character' => $Character, 'room' => $Room, 'npc' => $Npc]);
    	}

    public function combat(Request $request)
    	{
    	// do combat stuff
		// $Character = Character::where(['characters.id' => $request->character_id])
    		// ->join('character_stats', 'character_stats.characters_id', '=', 'characters.id')->first();

    	$Character = Character::where(['characters.id' => $request->character_id])->first();
    	$CharacterStat = CharacterStat::where(['character_stats.characters_id' => $request->character_id])->first();
    	// die(print_r($Character));
		// $Npc = Npc::findOrFail($request->npc_id);
    	$Npc = Npc::where(['npcs.id' => $request->npc_id])->join('npc_stats', 'npcs.id', '=', 'npc_stats.npcs_id')->first();

    	$combat_log = [];
   		$flat_npc = $Npc->toArray();
    	while ($flat_npc['health'] > 0)
    		{
    		if ($CharacterStat->health <= 0)
    			{
    			break;
    			}

    		// go go:
    		$damage = 6;
    		$flat_npc['health'] = $flat_npc['health'] - $damage;
    		$combat_log[] = "You dealt $damage to $Npc->name";

    		$npc_damage = 1;
    		$CharacterStat->health = $CharacterStat->health - $npc_damage;
    		$combat_log[] = "$Npc->name dealth $npc_damage to you!";

    		$CharacterStat->save();
    		}

    	if ($Character->health >= 0)
    		{
    		$combat_log[] = "$Npc->name is dead!!!";
    		$RewardTable = RewardTable::where(['reward_tables.npcs_id' => $request->npc_id])->first();
    		$CharacterStat->xp += $RewardTable->award_xp;
    		$CharacterStat->save();
    		$Wallet = Wallet::where(['wallets.characters_id' => $request->character_id])->first();
    		// die(print_r($Wallet));
    		$Wallet->copper += $RewardTable->award_copper;
    		$Wallet->save();
    		// $LootTable;
    		}

		return view('game/combat', ['combat_log' => $combat_log, 'character' => $Character, 'npc' => $Npc, 'return_room' => $request->room_id]);
    	}
}
