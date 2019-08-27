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
			$table->string('description')->nullable();
			$table->integer('intelligence_req')->default(0);
			$table->integer('darkness_level')->default(0);
			$table->string('img_src')->nullable();
			$table->string('bg_color')->nullable();
			$table->string('bg_img')->nullable();
			$table->timestamps();
		});

		Schema::create('room_properties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('custom_view')->nullable();
			$table->string('description')->nullable();
			$table->timestamps();
		});

		Schema::create('rooms', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('zones_id');
			$table->foreign('zones_id')->references('id')->on('zones');
			$table->string('uid')->nullable();
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
			$table->integer('northeast_rooms_id')->nullable();
			$table->foreign('northeast_rooms_id')->references('id')->on('rooms');
			$table->integer('southeast_rooms_id')->nullable();
			$table->foreign('southeast_rooms_id')->references('id')->on('rooms');
			$table->integer('southwest_rooms_id')->nullable();
			$table->foreign('southwest_rooms_id')->references('id')->on('rooms');
			$table->integer('northwest_rooms_id')->nullable();
			$table->foreign('northwest_rooms_id')->references('id')->on('rooms');
			$table->integer('room_properties_id')->nullable();
			$table->foreign('room_properties_id')->references('id')->on('room_properties');
			$table->timestamps();
		});

		Schema::create('player_races', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('gender');
			$table->timestamps();
		});

		Schema::create('alignments', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('color');
			$table->boolean('selectable');
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
			$table->bigInteger('value')->nullable();
			$table->float('weight')->nullable();
			$table->float('is_stackable')->default(false);
			$table->integer('score_req')->nullable();
			$table->timestamps();
		});

		Schema::create('weapon_types', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('item_weapons', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->integer('weapon_types_id');
			$table->foreign('weapon_types_id')->references('id')->on('weapon_types');
			// TODO: Remove duplicate name for now?  Consider re-adding?
			// $table->string('name');
			$table->integer('equipment_slot');
			$table->string('attack_text');
			$table->integer('damage_low');
			$table->integer('damage_high');
			$table->float('accuracy')->default(0.8);
			$table->string('required_stat')->nullable();
			$table->integer('required_amount')->nullable();
			$table->timestamps();
		});

		Schema::create('item_armors', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			// TODO: Remove duplicate name for now?  Consider re-adding?
			// $table->string('name');
			$table->integer('equipment_slot');
			$table->integer('armor');
			$table->integer('strength_bonus')->nullable();
			$table->integer('dexterity_bonus')->nullable();
			$table->integer('constitution_bonus')->nullable();
			$table->integer('wisdom_bonus')->nullable();
			$table->integer('intelligence_bonus')->nullable();
			$table->integer('charisma_bonus')->nullable();
			$table->timestamps();
		});

		Schema::create('item_accessories', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			// TODO: Remove duplicate name for now?  Consider re-adding?
			// $table->string('name');
			$table->integer('equipment_slot');
			$table->integer('light_level')->nullable();
			$table->integer('strength_bonus')->nullable();
			$table->integer('dexterity_bonus')->nullable();
			$table->integer('constitution_bonus')->nullable();
			$table->integer('wisdom_bonus')->nullable();
			$table->integer('intelligence_bonus')->nullable();
			$table->integer('charisma_bonus')->nullable();
			$table->timestamps();
		});

		Schema::create('item_foods', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			// TODO: Remove duplicate name for now?  Consider re-adding?
			// $table->string('name');
			$table->integer('potency');
			$table->timestamps();
		});

		Schema::create('item_jewels', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			// TODO: Remove duplicate name for now?  Consider re-adding?
			// $table->string('name');
			$table->timestamps();
		});

		Schema::create('item_dusts', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			// TODO: Remove duplicate name for now?  Consider re-adding?
			// $table->string('name');
			$table->timestamps();
		});

		Schema::create('item_others', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			// TODO: Remove duplicate name for now?  Consider re-adding?
			// $table->string('name');
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
			$table->integer('alignments_id')->nullable();
			$table->foreign('alignments_id')->references('id')->on('alignments');
			$table->bigInteger('xp');
			$table->bigInteger('gold');
			$table->bigInteger('bank');
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
			$table->integer('quest_points')->default(0);
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
			$table->integer('quantity')->default(1);
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

		Schema::create('forge_recipes', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('item_weapons_id');
			$table->foreign('item_weapons_id')->references('id')->on('items');
			$table->integer('item_armors_id');
			$table->foreign('item_armors_id')->references('id')->on('items');
			$table->integer('item_foods_id');
			$table->foreign('item_foods_id')->references('id')->on('items');
			$table->integer('item_jewels_id');
			$table->foreign('item_jewels_id')->references('id')->on('items');
			$table->integer('item_dusts_id');
			$table->foreign('item_dusts_id')->references('id')->on('items');
			$table->string('name');
			$table->integer('result_items_id');
			$table->foreign('result_items_id')->references('id')->on('items');
			$table->timestamps();
		});

		Schema::create('traders', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('rooms_id');
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->string('name');
			$table->string('description')->nullable();
			$table->boolean('trades_weapons')->default(false);
			$table->boolean('trades_armors')->default(false);
			$table->boolean('trades_accessories')->default(false);
			$table->boolean('trades_foods')->default(false);
			$table->boolean('trades_jewels')->default(false);
			$table->boolean('trades_dusts')->default(false);
			$table->boolean('trades_others')->default(false);
			$table->timestamps();
		});

		Schema::create('trader_items', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('traders_id');
			$table->foreign('traders_id')->references('id')->on('traders');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->integer('from_characters_id');
			$table->foreign('from_characters_id')->references('id')->on('characters');
			$table->timestamps();
		});

		Schema::create('npcs', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('attack_text')->nullable();
			$table->string('img_src')->nullable();
			$table->boolean('is_hostile')->default(true);
			$table->integer('alignments_id')->nullable();
			$table->foreign('alignments_id')->references('id')->on('alignments');
			$table->integer('health');
			$table->float('armor');
			$table->integer('damage_low');
			$table->integer('damage_high');
			$table->integer('attacks_per_round');
			$table->integer('award_xp');
			$table->float('xp_variation')->default(0.15);
			$table->integer('award_gold');
			$table->float('gold_variation')->default(0.15);
			$table->timestamps();
		});

		Schema::create('npc_kills', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('npcs_id');
			$table->foreign('npcs_id')->references('id')->on('npcs');
			$table->bigInteger('count');
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

		Schema::create('character_settings',function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('refresh_rate')->default(60);
			$table->boolean('brief_mode')->default(false);
			$table->boolean('life_gauge')->default(true);
			$table->boolean('mana_gauge')->default(true);
			$table->boolean('fatigue_gauge')->default(true);
			$table->integer('food_sort')->default(0);
			$table->boolean('number_commas')->default(false);
			$table->boolean('creature_images')->default(true);
			$table->timestamps();
		});

		Schema::create('shops', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('rooms_id');
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->string('name');
			$table->string('description')->nullable();
			$table->boolean('buys_weapons')->default(false);
			$table->boolean('buys_armors')->default(false);
			$table->boolean('buys_accessories')->default(false);
			$table->boolean('buys_foods')->default(false);
			$table->boolean('buys_jewels')->default(false);
			$table->boolean('buys_dusts')->default(false);
			$table->boolean('buys_others')->default(false);
			$table->timestamps();
		});

		Schema::create('shop_items', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('shops_id');
			$table->foreign('shops_id')->references('id')->on('shops');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->bigInteger('price')->nullable();
			$table->float('markup')->default(2.0);
			$table->timestamps();
		});

		Schema::create('quests', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->string('completion_message')->nullable();
			$table->boolean('optional')->default(false);
			$table->integer('wisdom_req')->default(0);
			$table->integer('intelligence_req')->default(0);
			$table->integer('score_req')->default(0);
			$table->string('progression_req')->nullable();
			$table->integer('quest_prereq')->nullable();
			$table->foreign('quest_prereq')->references('id')->on('quests');
			$table->integer('pickup_rooms_id')->nullable();
			$table->foreign('pickup_rooms_id')->references('id')->on('rooms');
			$table->integer('turnin_rooms_id')->nullable();
			$table->foreign('turnin_rooms_id')->references('id')->on('rooms');
			$table->timestamps();
		});

		Schema::create('quest_tasks', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('quests_id');
			$table->foreign('quests_id')->references('id')->on('quests');
			$table->string('uid')->nullable();
			$table->string('name')->nullable();
			$table->string('description')->nullable();
			$table->integer('seq')->nullable();
			$table->timestamps();
		});
		
		Schema::create('quest_rewards', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('quests_id');
			$table->foreign('quests_id')->references('id')->on('quests');
			$table->integer('item_reward')->nullable();
			$table->foreign('item_reward')->references('id')->on('items');
			$table->bigInteger('xp_reward')->nullable();
			$table->bigInteger('gold_reward')->nullable();
			$table->bigInteger('quest_point_reward')->nullable();
			// comma separate string list of item rewards, pick 1
			$table->string('item_choices')->nullable();
			$table->timestamps();
		});

		Schema::create('character_quests', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('quests_id');
			$table->foreign('quests_id')->references('id')->on('quests');
			$table->integer('character_id');
			$table->foreign('character_id')->references('id')->on('characters');
			$table->boolean('complete')->default(false);
			$table->boolean('rewarded')->default(false);
			$table->timestamps();
		});

		// One size fits all spatula
		Schema::create('room_actions', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('rooms_id');
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->integer('redirect_room')->nullable();
			$table->foreign('redirect_room')->references('id')->on('rooms');
			$table->string('uid')->nullable();
			$table->string('description')->nullable();
			$table->string('action')->nullable();
			$table->string('failed_action')->nullable();
			$table->string('success_action')->nullable();
			$table->string('display')->nullable();
			// comma seperated list of blocked directions until the action is performed?
			$table->string('directions_blocked')->nullable();
			$table->boolean('remember')->default(false);
			$table->integer('has_item')->nullable();
			$table->foreign('has_item')->references('id')->on('items');
			$table->integer('completed_quest')->nullable();
			$table->foreign('completed_quest')->references('id')->on('quests');
			$table->integer('completed_quest_task')->nullable();
			$table->foreign('completed_quest_task')->references('id')->on('quest_tasks');
			$table->integer('strength_req')->default(0)->nullable();
			$table->integer('dexterity_req')->default(0)->nullable();
			$table->integer('constitution_req')->default(0)->nullable();
			$table->integer('wisdom_req')->default(0)->nullable();
			$table->integer('intelligence_req')->default(0)->nullable();
			$table->integer('charisma_req')->default(0)->nullable();
			$table->integer('score_req')->default(0)->nullable();
			$table->timestamps();
		});

		// A record here means a character performed a room action that is set to remember
		Schema::create('character_room_actions', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('room_actions_id');
			$table->foreign('room_actions_id')->references('id')->on('room_actions');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->timestamps();
		});

		Schema::create('quest_criterias', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('quest_tasks_id');
			$table->foreign('quest_tasks_id')->references('id')->on('quest_tasks');
			$table->string('name')->nullable(); // ???
			$table->string('description')->nullable(); // ???
			$table->integer('npc_target')->nullable();
			$table->foreign('npc_target')->references('id')->on('npcs');
			$table->integer('zone_target')->nullable();
			$table->foreign('zone_target')->references('id')->on('zones');
			$table->integer('room_target')->nullable();
			$table->foreign('room_target')->references('id')->on('rooms');
			$table->integer('room_action_target')->nullable();
			$table->foreign('room_action_target')->references('id')->on('room_actions');
			$table->integer('item_target')->nullable();
			$table->foreign('item_target')->references('id')->on('items');
			$table->integer('alignment_target')->nullable();
			$table->foreign('alignment_target')->references('id')->on('alignments');
			$table->integer('npc_amount')->nullable();
			$table->timestamps();
		});

		Schema::create('character_quest_criterias', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('quest_criterias_id');
			$table->foreign('quest_criterias_id')->references('id')->on('quest_criterias');
			$table->integer('character_quests_id');
			$table->foreign('character_quests_id')->references('id')->on('character_quests');
			$table->integer('character_id');
			$table->foreign('character_id')->references('id')->on('characters');
			$table->integer('progress')->nullable();
			$table->boolean('complete')->default(false);
			$table->timestamps();
		});

		Schema::create('spells', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->string('formula')->nullable();
			$table->integer('duration')->nullable();
			$table->timestamps();
		});

		Schema::create('spell_levels', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('spells_id');
			$table->foreign('spells_id')->references('id')->on('spells');
			$table->string('name')->nullable();
			$table->integer('level');
			$table->string('value')->nullable();
			$table->integer('wisdom_req');
			$table->timestamps();
		});

		Schema::create('spell_properties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('uid');
			$table->string('description')->nullable();
			$table->timestamps();
		});

		Schema::create('spell_property_spells', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('spells_id');
			$table->foreign('spells_id')->references('id')->on('spells');
			$table->integer('spell_property_id');
			$table->foreign('spell_property_id')->references('id')->on('spell_properties');
			$table->timestamps();
		});

		Schema::create('character_spells', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('spells_id');
			$table->foreign('spells_id')->references('id')->on('spells');
			$table->integer('character_id');
			$table->foreign('character_id')->references('id')->on('characters');
			$table->integer('level');
			$table->timestamps();
		});

		/*
		Schema::create('item_properties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('description')->nullable();
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
		*/

		Schema::create('racial_modifiers', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->timestamps();
		});

		Schema::create('racial_modifier_races', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('racial_modifier_id');
			$table->foreign('racial_modifier_id')->references('id')->on('racial_modifiers');
			$table->integer('player_races_id');
			$table->foreign('player_races_id')->references('id')->on('player_races');
			$table->float('value');
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
			$table->bigInteger('count')->nullable();
			$table->timestamps();
		});

		Schema::create('wall_score_ranks', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('color');
			$table->integer('score_req');
			$table->timestamps();
		});

		// Deprecate 8/24: Rooms will only have 1 special property each:
		// Schema::create('room_property_rooms', function (Blueprint $table) {
		// 	$table->bigIncrements('id');
		// 	$table->integer('rooms_id');
		// 	$table->foreign('rooms_id')->references('id')->on('rooms');
		// 	$table->integer('room_properties_id');
		// 	$table->foreign('room_properties_id')->references('id')->on('room_properties');
		// 	$table->timestamps();
		// });

		// This is a cheat until I can do something better::
		Schema::create('game_progression', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->boolean('sewer_lifted')->default(false);
			$table->boolean('park_ranger')->default(false);
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
		Schema::dropIfExists('forge_recipes');
		Schema::dropIfExists('trader_items');
		Schema::dropIfExists('traders');
		Schema::dropIfExists('item_weapons');
		Schema::dropIfExists('weapon_types');
		// legacy
		Schema::dropIfExists('item_consumables');
		Schema::dropIfExists('item_foods');
		Schema::dropIfExists('item_armors');
		Schema::dropIfExists('item_accessories');
		Schema::dropIfExists('item_jewels');
		Schema::dropIfExists('item_dusts');
		Schema::dropIfExists('item_others');
		Schema::dropIfExists('item_property_items');
		Schema::dropIfExists('item_properties');
		Schema::dropIfExists('quest_rewards');
		Schema::dropIfExists('character_room_actions');
		Schema::dropIfExists('character_settings');
		Schema::dropIfExists('character_quest_criterias');
		Schema::dropIfExists('character_quests');
		Schema::dropIfExists('quest_criterias');
		// Schema::dropIfExists('quest_criteria');
		Schema::dropIfExists('room_actions');
		Schema::dropIfExists('items');
		Schema::dropIfExists('item_types');
		Schema::dropIfExists('equipment_slots');
		Schema::dropIfExists('max_values');
		Schema::dropIfExists('npc_stats');
		Schema::dropIfExists('damage_types');
		Schema::dropIfExists('reward_tables');
		// Schema::dropIfExists('user_settings');
		Schema::dropIfExists('character_spells');
		Schema::dropIfExists('combat_logs');
		Schema::dropIfExists('kill_counts');
		Schema::dropIfExists('npc_kills');
		Schema::dropIfExists('npcs');
		Schema::dropIfExists('game_progression');
		Schema::dropIfExists('characters');
		Schema::dropIfExists('alignments');
		Schema::dropIfExists('quest_tasks');
		Schema::dropIfExists('quests');
		// Schema::dropIfExists('quest_criteria_quests');
		Schema::dropIfExists('spell_property_spells');
		Schema::dropIfExists('spell_properties');
		Schema::dropIfExists('spell_levels');
		Schema::dropIfExists('character_spells');
		Schema::dropIfExists('spells');
		Schema::dropIfExists('room_property_rooms');
		Schema::dropIfExists('rooms');
		Schema::dropIfExists('room_properties');
		Schema::dropIfExists('zones');
		Schema::dropIfExists('player_races');
	}
}
