<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasicEntries extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('equipment_slots')->insert([
			['name' => 'weapon', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'shield', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'head', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'neck', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'chest', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'hands', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'legs', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'feet', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'amulet', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'ring', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'bracelet', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('weapon_types')->insert([
			['name' => 'Sword', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Axe', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Dagger', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Ranged', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Club', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Staff', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Mana', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Other', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		// Deprecate this idea:
		/*
		DB::table('item_properties')->insert([
			['name' => 'ADJUST_STRENGTH', 'description' => 'Adjusts strength by a flat amount.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'ADJUST_DEXTERITY', 'description' => 'Adjusts dexterity by a flat amount.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'ADJUST_CONSTITUTION', 'description' => 'Adjusts constitution by a flat amount.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'ADJUST_WISDOM', 'description' => 'Adjusts wisdom by a flat amount.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'ADJUST_INTELLIGENCE', 'description' => 'Adjusts intelligence by a flat amount.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'ADJUST_CHARISMA', 'description' => 'Adjusts charisma by a flat amount.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HAS_HEALING', 'description' => 'This flag will represent the item will heal the character', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'ADD_LIGHT_LEVEL', 'description' => 'Add an amount of light level', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'IGNORE_ACCURACY', 'description' => 'Accuracy will always be 100%.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'ADJUST_ACCURACY', 'description' => 'Adjust accuracy by a percentage.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
		*/

		DB::table('room_properties')->insert([
			['name' => 'CAN_SLEEP', 'custom_view' => null, 'description' => 'Characters can sleep in this room.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'CAN_TRAIN', 'custom_view' => 'partials/train', 'description' => 'This room will show the training form.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'WALL_OF_FLAME', 'custom_view' => 'partials/wall-flame', 'description' => 'This room will show the Wall of Flame.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HAS_BANK', 'custom_view' => 'partials/bank', 'description' => 'This room has a bank.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HAS_FORGE', 'custom_view' => 'partials/forge', 'description' => 'This room has a forge.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HAS_AIR_TEMPLE', 'custom_view' => 'partials/temple-air', 'description' => 'This room has the Air Temple.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HAS_EARTH_TEMPLE', 'custom_view' => 'partials/temple-earth', 'description' => 'This room has the Earth Temple.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HAS_FIRE_TEMPLE', 'custom_view' => 'partials/temple-fire', 'description' => 'This room has the Fire Temple.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HAS_WATER_TEMPLE', 'custom_view' => 'partials/temple-water', 'description' => 'This room has the Water Temple.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'CAN_TRAIN_SPELLS', 'custom_view' => 'partials/train-spell', 'description' => 'This room will show the Spell training.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HAS_QUEST_LOG', 'custom_view' => 'partials/quest-log', 'description' => 'This room has a quest log.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HAS_GRAVEYARD', 'custom_view' => 'partials/graveyard', 'description' => 'This room has a graveyard.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HAS_KILL_LOG', 'custom_view' => 'partials/kill-log', 'description' => 'This room has a graveyard.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HAS_INVENTORY', 'custom_view' => 'partials/inventory', 'description' => 'This room has shows the inventory.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('spell_properties')->insert([
			['uid' => 'TELEPORT_ROOM', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['uid' => 'MAGIC_DAMAGE', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['uid' => 'DAMAGE_ABSORB', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['uid' => 'AVOIDANCE', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['uid' => 'RESTORE_HEALTH', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['uid' => 'RESTORE_FATIGUE', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['uid' => 'EXTRA_ARMOR', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('spells')->insert([
			['name' => 'Teleport', 'spell_properties_id' => 1, 'mana_cost' => 3, 'training_cost' => 5, 'description' => 'Teleport spell.', 'formula' => null, 'duration' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Town Portal', 'spell_properties_id' => 1, 'mana_cost' => 3, 'training_cost' => 5, 'description' => 'Town Portal spell.', 'formula' => null, 'duration' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Bind Wounds', 'spell_properties_id' => 5, 'mana_cost' => 3, 'training_cost' => 5, 'description' => 'Bind Wounds spell.', 'formula' => null, 'duration' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Rejuvinate', 'spell_properties_id' => 6, 'mana_cost' => 3, 'training_cost' => 5, 'description' => 'Rejuvinate spell.', 'formula' => null, 'duration' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Bedazzle', 'spell_properties_id' => 4, 'mana_cost' => 3, 'training_cost' => 5, 'description' => 'Bedazzle spell.', 'formula' => 'level', 'duration' => 600, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Magic Shield', 'spell_properties_id' => 3, 'mana_cost' => 3, 'training_cost' => 5, 'description' => 'Magic Shield spell.', 'formula' => '[level] * 0.5', 'duration' => 600, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('spell_levels')->insert([
			['spells_id' => 2, 'name' => 'The Fountain', 'level' => 1, 'value' => 0, 'wisdom_req' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Beach Entrance', 'level' => 1, 'value' => null, 'wisdom_req' => 10, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Middle of Beach', 'level' => 5, 'value' => null, 'wisdom_req' => 20, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Far End of Beach', 'level' => 10, 'value' => null, 'wisdom_req' => 30, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Outskirts Entrance', 'level' => 1, 'value' => null, 'wisdom_req' => 40, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('chat_rooms')->insert([
			['name' => 'Nostalgia Tavern', 'score_req' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		// Deprecate for now:
		// DB::table('quest_criteria')->insert([
		// 	['name' => 'KILL_Creature', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['name' => 'ENTER_ZONE', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['name' => 'ENTER_ROOM', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['name' => 'SUPPLY_ITEM', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['name' => 'KILL_AT_ROOM', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['name' => 'KILL_AT_ROOM_COUNT', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['name' => 'KILL_CreatureS_ALIGN', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['name' => 'KILL_CreatureS_ALIGN_COUNT', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// ]);

		DB::table('item_types')->insert([
			['name' => 'Weapon', 'table_name' => 'item_weapons', 'model_name' => 'App\ItemWeapon', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Armor', 'table_name' => 'item_armors', 'model_name' => 'App\ItemArmor', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Accessories', 'table_name' => 'item_accessories', 'model_name' => 'App\ItemAccessory', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Food', 'table_name' => 'item_foods', 'model_name' => 'App\ItemFood', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Jewel', 'table_name' => 'item_jewels', 'model_name' => 'App\ItemJewel', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Dust', 'table_name' => 'item_dust', 'model_name' => 'App\ItemDust', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Other', 'table_name' => 'item_others', 'model_name' => 'App\ItemOther', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('alignments')->insert([
			['name' => 'Fire', 'color' => 'EE0000', 'selectable' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Air', 'color' => '00FFFF', 'selectable' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Earth', 'color' => '55FF8B', 'selectable' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Water', 'color' => '0066FF', 'selectable' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Spirit', 'color' => 'FFFF00', 'selectable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('wall_score_ranks')->insert([
			['name' => 'Leper', 'color' => '996600', 'score_req' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Peasant', 'color' => '999999', 'score_req' => 151, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Hireling', 'color' => 'CCCCCC', 'score_req' => 300, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Wanderer', 'color' => 'FFFFFF', 'score_req' => 500, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Vagabond', 'color' => 'FFCCCC', 'score_req' => 900, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Traveller', 'color' => 'FFCC66', 'score_req' => 1500, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Explorer', 'color' => 'FFFF99', 'score_req' => 2300, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Adventurer', 'color' => 'CCFF99', 'score_req' => 3300, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Mercenary', 'color' => 'CCFFFF', 'score_req' => 4600, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Gladiator', 'color' => 'CC99FF', 'score_req' => 6200, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Commander', 'color' => 'FF66FF', 'score_req' => 8100, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Conqueror', 'color' => 'FF33CC', 'score_req' => 10300, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Warlord', 'color' => 'FF3300', 'score_req' => 12800, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Trainer', 'color' => 'FF9933', 'score_req' => 15700, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Advisor', 'color' => 'FFFF66', 'score_req' => 19900, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Mentor', 'color' => 'CCFF00', 'score_req' => 22700, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Elder', 'color' => '99FF00', 'score_req' => 26800, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Consulate', 'color' => '33CC66', 'score_req' => 31300, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Emissary', 'color' => '33FFCC', 'score_req' => 36300, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Avatar', 'color' => '00CCFF', 'score_req' => 41800, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Immortal', 'color' => '3399FF', 'score_req' => 47800, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Divine', 'color' => '0033FF', 'score_req' => 54300, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Demi-god', 'color' => '993399', 'score_req' => 61300, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Titan', 'color' => 'CC33FF', 'score_req' => 68900, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Celestial', 'color' => 'CC6666', 'score_req' => 77100, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Astral', 'color' => 'CC9999', 'score_req' => 85900, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Planeswalker', 'color' => 'CCCC99', 'score_req' => 95300, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		// DB::table('user_settings')->insert([
		// 	['users_id' => 1, 'short_mode' => true],
		// ]);
	}
}
