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
		Schema::create('players', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->integer('users_id');
			$table->foreign('users_id')->references('id')->on('users');
			// $table->string('email');
			// $table->string('hashpass');
			// $table->string('remember_token');
			$table->timestamps();
		});

		Schema::create('damage_types', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->timestamps();
		});
		// Damage types:
		/*
			Blunt (1x str)
			Slash (.5x str, .5x dex)
			Pierce (1x dex)

			Spells (int)
		*/

		

		// Stats:
		// Future ideas:
		/*
		Primaries
		(offensives):
			Strength (Blunt, Slash) 
			Dexterity (Pierece, Slash)
			Intelligence (Spells) (+mana, +mana regen)

		(defensives):
			Vitality (+health, +armor)
			Guard (+evasion, +block)
			Wisdom (+ward, +res)

		Secondaries:
			Brute (raw % damage?)
			Finesse (# of attacks)
			Insight (-# spell pen)

		(others)
			Health
			Ward
			Mana
			Health Regen
			Mana Regen
			Ward Regen
			Armor
			Evasion
			Block
			Resistance
			Crit Chance
			Crit Damage
			Armor Pen
			Spell Pen
			Accuracy?

		*/
		Schema::create('zones', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('rooms', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('zones_id');
			$table->foreign('zones_id')->references('id')->on('zones');
			$table->string('title');
			$table->string('description');
			$table->integer('north_rooms_id')->nullable();
			$table->foreign('north_rooms_id')->references('id')->on('rooms');
			$table->integer('east_rooms_id')->nullable();
			$table->foreign('east_rooms_id')->references('id')->on('rooms');
			$table->integer('south_rooms_id')->nullable();
			$table->foreign('south_rooms_id')->references('id')->on('rooms');
			$table->integer('west_rooms_id')->nullable();
			$table->foreign('west_rooms_id')->references('id')->on('rooms');
			$table->timestamps();
		});

		Schema::create('max_values', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('max_level');
			$table->timestamps();
		});

		Schema::create('player_races', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
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
			// $table->float('brute_cost')->nullable();
			// $table->float('finesse_cost')->nullable();
			// $table->float('insight_cost')->nullable();
			$table->timestamps();
		});

		Schema::create('item_types', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('table_name');
			// $table->integer('table_id');
			// Add all flags?
			// $table->bool('consumable');
			// $table->bool('equippable');
			$table->timestamps();
		});

		Schema::create('items', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			// $table->string('item_table');
			// $table->integer('item_table_id');
			$table->integer('item_types_id');
			$table->foreign('item_types_id')->references('id')->on('item_types');
			// Should items have the individual flags as well?
			// $table->string('equipment_slots');
			// $table->foreign('equipment_slots_id')->references('id')->on('equipment_slots');
			// $table->boolean('consumable');
			// $table->boolean('equippable');
			$table->timestamps();
		});

		Schema::create('item_weapons', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->string('name');
			$table->string('attack_text');
			$table->integer('damage_low');
			$table->integer('damage_high');
			$table->string('equipment_slot');
			$table->timestamps();
		});

		Schema::create('item_armors', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->string('name');
			$table->string('equipment_slot');
			$table->integer('armor');
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

		Schema::create('item_accessories', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->string('name');
			$table->string('equipment_slot');
			$table->timestamps();
		});

		Schema::create('item_others', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->string('name');
			$table->timestamps();
		});

		// Schema::create('equipment_slots', function (Blueprint $table) {
		// 	$table->bigIncrements('id');
		// 	$table->string('name');
		// 	$table->timestamps();
		// });



		Schema::create('characters', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('users_id');
			$table->foreign('users_id')->references('id')->on('users');
			$table->string('name');
			// $table->integer('player_classes_id');
			// $table->foreign('player_classes_id')->references('id')->on('player_classes');
			$table->integer('player_races_id');
			$table->foreign('player_races_id')->references('id')->on('player_races');
			$table->integer('last_rooms_id');
			$table->foreign('last_rooms_id')->references('id')->on('rooms');
			$table->timestamps();
		});

		Schema::create('equipment', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('head')->nullable();
			$table->foreign('head')->references('id')->on('item_armors');
			$table->integer('chest')->nullable();
			$table->foreign('chest')->references('id')->on('item_armors');
			$table->integer('legs')->nullable();
			$table->foreign('legs')->references('id')->on('item_armors');
			$table->integer('weapon')->nullable();
			$table->foreign('weapon')->references('id')->on('item_weapons');
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

		Schema::create('character_stats', function (Blueprint $table) {
			$table->bigIncrements('id');
			// $table->string('name');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
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
			// $table->integer('brute');
			// $table->integer('finesse');
			// $table->integer('insight');
			$table->timestamps();
		});

		// Deprecating this idea, adding gold to character_stats:
		/*
		Schema::create('wallets', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('gold');
			$table->integer('silver');
			$table->integer('copper');
			$table->timestamps();
		});*/


		Schema::create('npcs', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('img_src')->nullable();
			$table->boolean('is_hostile');
			$table->timestamps();
		});

		Schema::create('npc_stats', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('npcs_id');
			$table->foreign('npcs_id')->references('id')->on('npcs');
			$table->integer('level');
			$table->integer('health');
			$table->integer('damage_types_id');
			$table->foreign('damage_types_id')->references('id')->on('damage_types');
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
			$table->timestamps();
		});

		Schema::create('shop_items', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('shops_id');
			$table->foreign('shops_id')->references('id')->on('shops');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
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
		Schema::dropIfExists('character_stats');
		// Schema::dropIfExists('wallets');
		Schema::dropIfExists('stat_costs');
		// Schema::dropIfExists('race_stat_affinities');
		Schema::dropIfExists('equipment');
		Schema::dropIfExists('inventory_items');
		Schema::dropIfExists('inventories');
		Schema::dropIfExists('characters');
		Schema::dropIfExists('spawn_rules');
		Schema::dropIfExists('loot_tables');
		Schema::dropIfExists('shop_items');
		Schema::dropIfExists('shops');
		Schema::dropIfExists('rooms');
		Schema::dropIfExists('zones');
		Schema::dropIfExists('players');		
		Schema::dropIfExists('item_weapons');
		Schema::dropIfExists('item_consumables');
		Schema::dropIfExists('item_armors');
		Schema::dropIfExists('item_accessories');
		Schema::dropIfExists('item_others');
		
		Schema::dropIfExists('items');
		Schema::dropIfExists('item_types');

		// Schema::dropIfExists('item_types');
		// Schema::dropIfExists('equipment_slots');
		Schema::dropIfExists('player_races');
		// Schema::dropIfExists('player_classes');
		Schema::dropIfExists('max_values');
		Schema::dropIfExists('npc_stats');
		Schema::dropIfExists('damage_types');
		Schema::dropIfExists('reward_tables');
		Schema::dropIfExists('npcs');
		Schema::dropIfExists('user_settings');
	}
}
