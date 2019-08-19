<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zones', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('description');
			$table->integer('darkness_level')->default(0);
			$table->string('img_src')->nullable();
			$table->timestamps();
		});

		Schema::create('rooms', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('zones_id');
			$table->foreign('zones_id')->references('id')->on('zones');
			$table->string('title')->nullable();
			$table->string('description')->nullable();
			$table->integer('darkness_level')->default(0);
			$table->string('img_src')->nullable();
			$table->boolean('spawns_enabled')->default(true);
			$table->integer('north_rooms_id')->nullable();
			$table->foreign('north_rooms_id')->references('id')->on('rooms');
			$table->integer('east_rooms_id')->nullable();
			$table->foreign('east_rooms_id')->references('id')->on('rooms');
			$table->integer('south_rooms_id')->nullable();
			$table->foreign('south_rooms_id')->references('id')->on('rooms');
			$table->integer('west_rooms_id')->nullable();
			$table->foreign('west_rooms_id')->references('id')->on('rooms');
			$table->integer('up_rooms_id')->nullable();
			$table->foreign('up_rooms_id')->references('id')->on('rooms');
			$table->integer('down_rooms_id')->nullable();
			$table->foreign('down_rooms_id')->references('id')->on('rooms');
			$table->timestamps();
		});

		Schema::create('player_races', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('gender');
			$table->timestamps();
		});

		Schema::create('stat_costs', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('player_races_id');
			$table->foreign('player_races_id')->references('id')->on('player_races');
			$table->float('strength_cost')->default(1.0);
			$table->float('dexterity_cost')->default(1.0);
			$table->float('constitution_cost')->default(1.0);
			$table->float('wisdom_cost')->default(1.0);
			$table->float('intelligence_cost')->default(1.0);
			$table->float('charisma_cost')->default(1.0);
			$table->timestamps();
		});

		Schema::create('starting_stats', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('player_races_id');
			$table->foreign('player_races_id')->references('id')->on('player_races');
			$table->integer('strength')->default(20);
			$table->integer('dexterity')->default(20);
			$table->integer('constitution')->default(20);
			$table->integer('wisdom')->default(20);
			$table->integer('intelligence')->default(20);
			$table->integer('charisma')->default(20);
			$table->timestamps();
		});

		Schema::create('item_types', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('table_name');
			$table->string('model_name');
			$table->timestamps();
		});

		Schema::create('items', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->integer('item_types_id');
			$table->foreign('item_types_id')->references('id')->on('item_types');
			$table->integer('value')->nullable();
			$table->float('weight')->nullable();
			$table->timestamps();
		});

		Schema::create('item_weapons', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->string('name');
			$table->integer('equipment_slot');
			$table->string('attack_text');
			$table->integer('damage_low');
			$table->integer('damage_high');
			$table->integer('strength_requirement')->nullable();
			$table->integer('dexterity_requirement')->nullable();
			$table->timestamps();
		});

		Schema::create('item_armors', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->string('name');
			$table->integer('equipment_slot');
			$table->integer('armor');
			$table->timestamps();
		});

		Schema::create('item_accessories', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->string('name');
			$table->integer('equipment_slot');
			$table->integer('armor');
			$table->integer('strength_bonus');
			$table->integer('dexterity_bonus');
			$table->integer('constitution_bonus');
			$table->integer('wisdom_bonus');
			$table->integer('intelligence_bonus');
			$table->integer('charisma_bonus');
			$table->timestamps();
		});

		Schema::create('item_consumables', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->string('name');
			$table->string('effect');
			$table->integer('potency');
			$table->timestamps();
		});

		Schema::create('item_others', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('equipment_slots', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('characters', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('users_id');
			$table->foreign('users_id')->references('id')->on('users');
			$table->string('name');
			$table->integer('player_races_id');
			$table->foreign('player_races_id')->references('id')->on('player_races');
			$table->integer('last_rooms_id');
			$table->foreign('last_rooms_id')->references('id')->on('rooms');
			$table->integer('xp');
			$table->integer('gold');
			$table->integer('health');
			$table->integer('max_health');
			$table->integer('mana');
			$table->integer('max_mana');
			$table->integer('fatigue');
			$table->integer('max_fatigue');
			$table->integer('strength');
			$table->integer('dexterity');
			$table->integer('constitution');
			$table->integer('wisdom');
			$table->integer('intelligence');
			$table->integer('charisma');
			$table->integer('score');
			$table->integer('death_count')->default(0);
			$table->timestamps();
		});

		// Redo this?
		Schema::create('inventories', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			// $table->integer('items_id');
			// $table->foreign('items_id')->refences('id')->on('items');
			// $table->integer('quantity');
			$table->integer('max_size');
			$table->integer('max_weight');
			$table->timestamps();
		});

		Schema::create('inventory_items',function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('inventory_id');
			$table->foreign('inventory_id')->references('id')->on('inventories');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->integer('quantity');
			$table->timestamps();
		});

		Schema::create('equipment', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('weapon')->nullable();
			$table->foreign('weapon')->references('id')->on('inventory_items');
			$table->integer('shield')->nullable();
			$table->foreign('shield')->references('id')->on('inventory_items');
			$table->integer('head')->nullable();
			$table->foreign('head')->references('id')->on('inventory_items');
			$table->integer('neck')->nullable();
			$table->foreign('neck')->references('id')->on('inventory_items');
			$table->integer('chest')->nullable();
			$table->foreign('chest')->references('id')->on('inventory_items');
			$table->integer('legs')->nullable();
			$table->foreign('legs')->references('id')->on('inventory_items');
			$table->integer('hands')->nullable();
			$table->foreign('hands')->references('id')->on('inventory_items');
			$table->integer('feet')->nullable();
			$table->foreign('feet')->references('id')->on('inventory_items');
			$table->integer('amulet')->nullable();
			$table->foreign('amulet')->references('id')->on('inventory_items');
			$table->integer('left_ring')->nullable();
			$table->foreign('left_ring')->references('id')->on('inventory_items');
			$table->integer('right_ring')->nullable();
			$table->foreign('right_ring')->references('id')->on('inventory_items');
			$table->integer('bracelet')->nullable();
			$table->foreign('bracelet')->references('id')->on('inventory_items');
			$table->timestamps();
		});

		// Schema::create('character_stats', function (Blueprint $table) {
		// 	$table->bigIncrements('id');
		// 	// $table->string('name');
		// 	$table->integer('characters_id');
		// 	$table->foreign('characters_id')->references('id')->on('characters');
		// 	$table->integer('xp');
		// 	$table->integer('gold');
		// 	$table->integer('health');
		// 	$table->integer('max_health');
		// 	$table->integer('mana');
		// 	$table->integer('max_mana');
		// 	$table->integer('fatigue');
		// 	$table->integer('max_fatigue');
		// 	$table->integer('strength');
		// 	$table->integer('dexterity');
		// 	$table->integer('constitution');
		// 	$table->integer('wisdom');
		// 	$table->integer('intelligence');
		// 	$table->integer('charisma');
		// 	$table->integer('score');
		// 	$table->integer('death_count')->default(0);
		// 	$table->timestamps();
		// });

		Schema::create('npcs', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('attack_text')->nullable();
			$table->string('img_src')->nullable();
			$table->boolean('is_hostile')->default(true);
			$table->timestamps();
		});

		Schema::create('npc_stats', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('npcs_id');
			$table->foreign('npcs_id')->references('id')->on('npcs');
			$table->integer('health');
			$table->float('armor');
			$table->integer('damage_low');
			$table->integer('damage_high');
			$table->integer('attacks_per_round');
			// $table->float('critical_chance');
			$table->timestamps();
		});

		Schema::create('spawn_rules', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('zones_id')->nullable();
			$table->foreign('zones_id')->references('id')->on('zones');
			$table->integer('rooms_id')->nullable();
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->integer('npcs_id');
			$table->foreign('npcs_id')->references('id')->on('npcs');
			$table->float('chance');
			$table->timestamps();
		});

		Schema::create('reward_tables', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('npcs_id');
			$table->foreign('npcs_id')->references('id')->on('npcs');
			$table->integer('award_xp');
			$table->float('xp_variation')->nullable();
			$table->integer('award_gold');
			$table->float('gold_variation')->nullable();
			$table->timestamps();
		});		

		Schema::create('loot_tables', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('zones_id')->nullable();
			$table->foreign('zones_id')->references('id')->on('zones');
			$table->integer('npcs_id')->nullable();
			$table->foreign('npcs_id')->references('id')->on('npcs');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->float('chance');
			$table->timestamps();
		});

		Schema::create('user_settings',function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('users_id');
			$table->foreign('users_id')->references('id')->on('users');
			$table->boolean('short_mode')->default(false);
			$table->timestamps();
		});

		Schema::create('shops', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('rooms_id');
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->string('name');
			$table->string('description');
			$table->boolean('buys_weapons')->default(false);
			$table->boolean('buys_armors')->default(false);
			$table->boolean('buys_accessories')->default(false);
			$table->boolean('buys_consumables')->default(false);
			$table->boolean('buys_others')->default(false);
			$table->timestamps();
		});

		Schema::create('shop_items', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('shops_id');
			$table->foreign('shops_id')->references('id')->on('shops');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->integer('price')->nullable();
			$table->float('markup')->nullable();
			$table->timestamps();
		});

		Schema::create('quests', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('description');
			$table->timestamps();
		});

		Schema::create('character_quests', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('quests_id');
			$table->foreign('quests_id')->references('id')->on('quests');
			$table->integer('character_id');
			$table->foreign('character_id')->references('id')->on('characters');
			$table->integer('progress');
			$table->timestamps();
		});

		Schema::create('spells', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('description');
			$table->timestamps();
		});

		Schema::create('character_spells', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('spells_id');
			$table->foreign('spells_id')->references('id')->on('spells');
			$table->integer('character_id');
			$table->foreign('character_id')->references('id')->on('characters');
			$table->timestamps();
		});

		Schema::create('item_properties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('description');
			$table->timestamps();
		});

		Schema::create('item_property_items', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('item_property_id');
			$table->foreign('item_property_id')->references('id')->on('item_properties');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->timestamps();
		});

		Schema::create('racial_modifiers', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('description');
			$table->timestamps();
		});

		Schema::create('racial_modifier_races', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('racial_modifier_id');
			$table->foreign('racial_modifier_id')->references('id')->on('racial_modifiers');
			$table->integer('player_races_id');
			$table->foreign('player_races_id')->references('id')->on('player_races');
			$table->timestamps();
		});		

		Schema::create('combat_logs', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('npcs_id');
			$table->foreign('npcs_id')->references('id')->on('npcs');
			$table->integer('rooms_id');
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->integer('remaining_health');
			$table->integer('expires_on')->nullable();
			$table->timestamps();
		});

		Schema::create('kill_counts', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('npcs_id');
			$table->foreign('npcs_id')->references('id')->on('npcs');
			$table->integer('count')->nullable();
			$table->timestamps();
		});

		Schema::create('wall_score_ranks', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('color');
			$table->integer('score_req');
			$table->timestamps();
		});

		Schema::create('room_properties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('description');
			$table->timestamps();
		});

		Schema::create('room_property_rooms', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('rooms_id');
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->integer('room_properties_id');
			$table->foreign('room_properties_id')->references('id')->on('room_properties');
			$table->timestamps();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('wall_score_ranks');
		Schema::dropIfExists('racial_modifier_races');
		Schema::dropIfExists('racial_modifiers');
		Schema::dropIfExists('character_stats');
		Schema::dropIfExists('stat_costs');
		Schema::dropIfExists('starting_stats');
		Schema::dropIfExists('equipment');
		Schema::dropIfExists('inventory_items');
		Schema::dropIfExists('inventories');
		Schema::dropIfExists('spawn_rules');
		Schema::dropIfExists('loot_tables');
		Schema::dropIfExists('shop_items');
		Schema::dropIfExists('shops');
		Schema::dropIfExists('players');
		Schema::dropIfExists('item_weapons');
		Schema::dropIfExists('item_consumables');
		Schema::dropIfExists('item_armors');
		Schema::dropIfExists('item_accessories');
		Schema::dropIfExists('item_others');
		Schema::dropIfExists('item_property_items');
		Schema::dropIfExists('item_properties');
		Schema::dropIfExists('items');
		Schema::dropIfExists('item_types');
		Schema::dropIfExists('equipment_slots');
		Schema::dropIfExists('max_values');
		Schema::dropIfExists('npc_stats');
		Schema::dropIfExists('damage_types');
		Schema::dropIfExists('reward_tables');
		Schema::dropIfExists('user_settings');
		Schema::dropIfExists('character_quests');
		Schema::dropIfExists('character_spells');
		Schema::dropIfExists('combat_logs');
		Schema::dropIfExists('kill_counts');
		Schema::dropIfExists('npcs');
		Schema::dropIfExists('characters');
		Schema::dropIfExists('quests');
		Schema::dropIfExists('spells');
		Schema::dropIfExists('room_property_rooms');
		Schema::dropIfExists('room_properties');
		Schema::dropIfExists('rooms');
		Schema::dropIfExists('zones');
		Schema::dropIfExists('player_races');
	}
}
