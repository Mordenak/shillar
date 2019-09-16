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
		DB::table('world')->insert([
			['cycle' => 1, 'year' => 100, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

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

		// Deprecate These ideas:
		/*
		DB::table('operations')->insert([
			['name' => 'EQUAL_TO', 'type' => 'comparator', 'shortcut' => '==', 'description' => 'Values must be equal', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'LESS_THAN', 'type' => 'comparator', 'shortcut' => '<', 'description' => 'Values must be equal', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'GREATER_THAN', 'type' => 'comparator', 'shortcut' => '>', 'description' => 'Values must be equal', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'LESS_THAN_OR_EQUAL_TO', 'type' => 'comparator', 'shortcut' => '<=', 'description' => 'Values must be equal', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'GREATER_THAN_OR_EQUAL_TO', 'type' => 'comparator', 'shortcut' => '>=', 'description' => 'Values must be equal', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'AND', 'type' => 'joiner', 'shortcut' => '&&', 'description' => 'Values must be equal', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'OR', 'type' => 'joiner', 'shortcut' => '||', 'description' => 'Values must be equal', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
		*/

		/*
		DB::table('item_properties')->insert([
			['name' => 'STRENGTH_BONUS', 'description' => 'Adds a flat amount of strength.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'DEXTERITY_BONUS', 'description' => 'Adds a flat amount of dexterity.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'CONSTITUTION_BONUS', 'description' => 'Adds a flat amount of constitution.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'WISDOM_BONUS', 'description' => 'Adds a flat amount of wisdom.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'INTELLIGENCE_BONUS', 'description' => 'Adds a flat amount of intelligence.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'CHARISMA_BONUS', 'description' => 'Adds a flat amount of charisma.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'LIGHT_LEVEL_BONUS', 'description' => 'Add an amount of light level.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HEAT_PROTECTION', 'description' => 'Add a percentage of heat damage protection', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'COLD_PROTECTION', 'description' => 'Add a percentage of cold damage protection', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'DAMAGE_EARTH_GUARDIAN', 'description' => 'This weapon can damage the Earth Elemental.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'DAMAGE_AIR_GUARDIAN', 'description' => 'This weapon can damage the Air Elemental.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'DAMAGE_FIRE_GUARDIAN', 'description' => 'This weapon can damage the Fire Elementa.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'DAMAGE_WATER_GUARDIAN', 'description' => 'This weapon can damage the Water Elementa.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// ['name' => 'IGNORE_ACCURACY', 'description' => 'Accuracy will always be 100%.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// ['name' => 'ADJUST_ACCURACY', 'description' => 'Adjust accuracy by a percentage.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// ['name' => 'HAS_HEALING', 'description' => 'This flag will represent the item will heal the character', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
		*/

		DB::table('zone_properties')->insert([
			['name' => 'STAT_RESTRICTION', 'description' => 'Flat amount of a given stat required to enter a zone.', 'format' => '{"intelligence":40}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'ITEM_RESTRICTION', 'description' => 'Specific item required to enter a zone.', 'format' => '{"item_id":1}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HEAT_DAMAGE', 'description' => 'Moving in this zone deals heat damage, optional hourly begin and end times', 'format' => '{"amount":10,"begin":12,"end":18}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'COLD_DAMAGE', 'description' => 'Moving in this zone deals cold damage, optional hourly begin and end times', 'format' => '{"amount":10,"begin":0,"end":6}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'DARKNESS', 'description' => 'This zone has a certain darkness level in order to see things', 'format' => '{"level":1}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 5
			['name' => 'REQUIRES_SWIMMING', 'description' => 'Travelling into or in this zone without the swimming ability will result in death.', 'format' => '{}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'REQUIRES_FLYING', 'description' => 'Travelling into or in this zone without the flying ability will result in death. ', 'format' => '{}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HOSTILE_PER_CREATURE_KILL', 'description' => 'All creatures will be hostile in this zone if you do not meet the criteria based on creature kills.', 'format' => '{"creature_id":1,"stat":"charisma","multipler":1}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HOSTILE_ON_GOLD_PER_SPELL', 'description' => 'All creatures will be hostile in this zone if the criteria are not met.  Per total spell levels a character has, requires specified gold in hand.', 'format' => '{"gold":1250}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HOSTILE_ON_FOOD_TYPES','description' => 'All creatures will be hostile if the specified amount of food types in a character inventory are not met.', 'format' => '{"amount":12}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 10
			['name' => 'HOSTILE_RECENT_DEATH', 'description' => 'Must have a recent death as defined in minutes, otherwise creatures are hostile.', 'format' => '{"minutes":720}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'SCRAMBLE_DIRECTIONS', 'description' => "Every room in this zone will have it's directions scrambled, enabling treasure hunting.  Bypassed by COMPASS item property.", 'format' => '{}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HOSTILE_ON_ITEM_STRING', 'description' => 'If character is carrying more than specified number of items matching the item string, creatures are aggressive', 'format' => '{"string":"ice","amount":1}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HOSTILE_WITHOUT_QUEST', 'description' => 'If Character has not completed a certain quest specified by ID, creatures will be aggressive.', 'format' => '{"quest":1}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'SCRAMBLE_TELEPORT', 'description' => 'Teleport locations in this zone will randomly drop the character in either target or any adjacent room.', 'format' => '{}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 15
			['name' => 'RANDOM_ROOM', 'description' => 'Any room in this zone may randomly have an additional link to another specified room.', 'format' => '{"direction":"down","rooms_id":1,"chance":0.01}', 'custom_view' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			]);

		DB::table('item_properties')->insert([
			['name' => 'STAT_BONUS', 'description' => 'Adds a flat amount of each specified stat.  Currently used for Racial & Mithrils armors, and phylacteries.', 'format' => '{"strength":10,"dexterity":10}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'RESTORES', 'description' => "Restores a Character's health, mana and fatigue by the specified amount, not used by anything yet.", 'format' => '{"amount":10}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'TRADER_SCORE_RESTRICTION', 'description' => 'The wall score amount required to receive this item.', 'format' => '{"score":2000}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'DROP_RANDOM', 'description' => 'When this item is dropped, randomize the properties based on this property.', 'format' => '[{"Supreme":{"amount":350,"score_req":35000}},{"Masculine": "Male", "Feminine": "Female"},{"Human":"Human"},{"Might":"strength"}]', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'RENAME_ITEM', 'description' => "This overrides the item's original name.", 'format' => '{"name":"new_name"}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'LIGHT_LEVEL_BONUS', 'description' => 'Add an amount of light level.', 'format' => '{"amount":1}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HEAT_PROTECTION', 'description' => 'Add a percentage of heat damage protection, use 1.0 for immunity.', 'format' => '{"amount":0.5}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'COLD_PROTECTION', 'description' => 'Add a percentage of cold damage protection, use 1.0 for immunity.', 'format' => '{"amount":0.5}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'DAMAGE_EARTH_GUARDIAN', 'description' => 'This weapon can damage the Earth Elemental.', 'format' => '{}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'DAMAGE_AIR_GUARDIAN', 'description' => 'This weapon can damage the Air Elemental.', 'format' => '{}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'DAMAGE_FIRE_GUARDIAN', 'description' => 'This weapon can damage the Fire Elemental.', 'format' => '{}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'DAMAGE_WATER_GUARDIAN', 'description' => 'This weapon can damage the Water Elemental.', 'format' => '{}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'RACE_RESTRICTION', 'description' => 'Must be the specified Race to equip this item.', 'format' => '{"race":"Elf"}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'GENDER_RESTRICTION', 'description' => 'Must be the specified Gender to equip this item.', 'format' => '{"gender":"Male"}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'GRANTS_SWIMMING', 'description' => 'When equipped, grants the swimming ability.', 'format' => '{}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'GRANTS_FLYING', 'description' => 'Carrying this item grants the flying ability.', 'format' => '{}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'IS_CURSED', 'description' => 'This item is cursed and must be cleansed.', 'format' => '{}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'COMPASS', 'description' => 'This item bypasses zone property SCRAMBLE_DIRECTIONS.', 'format' => '{}', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			]);

		DB::table('room_properties')->insert([
			['name' => 'CAN_SLEEP', 'custom_view' => null, 'description' => 'Characters can sleep in this room.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'CAN_TRAIN', 'custom_view' => 'partials/train', 'description' => 'This room will show the training form.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'WALL_OF_FLAME', 'custom_view' => 'partials/wall-flame', 'description' => 'This room will show the Wall of Flame.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'HAS_BANK', 'custom_view' => 'partials/bank', 'description' => 'This room has a bank.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// TODO: Deprecate:
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

		DB::table('spell_types')->insert([
			['name' => 'TELEPORT_ROOM', 'description' => 'Used to move a character to another room.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'MAGIC_DAMAGE', 'description' => 'Used to deal basic magic damage to a creature.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'DAMAGE_ABSORB', 'description' => 'Absorbs damage at the expensive of...', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'AVOIDANCE', 'description' => 'Grants an additional chance to dodge', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'EXTRA_ARMOR', 'description' => 'Grants additional armor', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'RESTORE_HEALTH', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'RESTORE_FATIGUE', 'description' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('spells')->insert([
			['name' => 'Teleport', 'spell_types_id' => 1, 'description' => 'Teleport spell.', 'formula' => null, 'duration' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Town Portal', 'spell_types_id' => 1, 'description' => 'Town Portal spell.', 'formula' => null, 'duration' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Bind Wounds', 'spell_types_id' => 6, 'description' => 'Bind Wounds spell.', 'formula' => null, 'duration' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Rejuvinate', 'spell_types_id' => 7, 'description' => 'Rejuvinate spell.', 'formula' => null, 'duration' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Bedazzle', 'spell_types_id' => 4, 'description' => 'Bedazzle spell.', 'formula' => 'level', 'duration' => 600, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Magic Shield', 'spell_types_id' => 5, 'description' => 'Magic Shield spell.', 'formula' => '[level] * 0.5', 'duration' => 600, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('chat_rooms')->insert([
			['name' => 'Nostalgia Tavern', 'score_req' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => "Bizarro's Bizarre House", 'score_req' => 20000, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
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

		DB::table('kill_ranks')->insert([
			['name' => 'Attacker', 'min_count' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Killer', 'min_count' => 101, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Butcherer', 'min_count' => 251, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Slayer', 'min_count' => 1001, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Ravager', 'min_count' => 2501, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Slaughterer', 'min_count' => 5001, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Destroyer', 'min_count' => 10001, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Obliterator', 'min_count' => 15001, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Disintegrator', 'min_count' => 30001, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('spell_ranks')->insert([
			['name' => 'Prestidigitator', 'min_count' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Evoker', 'min_count' => 251, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Conjurer', 'min_count' => 501, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Theurgist', 'min_count' => 1001, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Thaumaturgist', 'min_count' => 2501, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Magician', 'min_count' => 4001, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Enchanter', 'min_count' => 6001, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Warlock', 'min_count' => 9001, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Sorcerer', 'min_count' => 13501, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		// DB::table('user_settings')->insert([
		// 	['users_id' => 1, 'short_mode' => true],
		// ]);
	}
}
