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

		Schema::create('player_classes', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('item_types', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			// Add all flags?
			// $table->bool('consumable');
			// $table->bool('equippable');
			$table->timestamps();
		});

		Schema::create('equipment_slots', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('items', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->integer('item_types_id');
			$table->foreign('item_types_id')->references('id')->on('item_types');
			// Should items have the individual flags as well?
			$table->integer('equipment_slots_id');
			$table->foreign('equipment_slots_id')->references('id')->on('equipment_slots');
			$table->boolean('consumable');
			$table->boolean('equippable');
			$table->timestamps();
		});		

		// Redo this?
		Schema::create('inventories', function (Blueprint $table) {
			$table->bigIncrements('id');
			// $table->integer('characters_id');
			// $table->foreign('characters_id')->references('id')->on('characters');
			// $table->integer('items_id');
			// $table->foreign('items_id')->refences('id')->on('items');
			// $table->integer('quantity');
			$table->integer('max_size');
			$table->integer('max_weight');
			$table->timestamps();
		});

		Schema::create('items_to_inventories',function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('inventories_id');
			$table->foreign('inventories_id')->references('id')->on('inventories');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->timestamps();
		});

		Schema::create('characters', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('users_id');
			$table->foreign('users_id')->references('id')->on('users');
			$table->string('name');
			$table->integer('player_classes_id');
			$table->foreign('player_classes_id')->references('id')->on('player_classes');
			$table->integer('player_races_id');
			$table->foreign('player_races_id')->references('id')->on('player_races');
			$table->integer('last_rooms_id');
			$table->foreign('last_rooms_id')->references('id')->on('rooms');
			$table->timestamps();
		});

		Schema::create('character_stats', function (Blueprint $table) {
			$table->bigIncrements('id');
			// $table->string('name');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('level');
			$table->integer('xp');
			$table->integer('health');
			$table->integer('max_health');
			$table->integer('mana');
			$table->integer('max_mana');
			$table->integer('ward');
			$table->integer('max_ward');
			$table->integer('strength');
			$table->integer('dexterity');
			$table->integer('intelligence');
			$table->integer('vitality');
			$table->integer('guard');
			$table->integer('wisdom');
			$table->integer('brute');
			$table->integer('finesse');
			$table->integer('insight');
			$table->timestamps();
		});

		Schema::create('wallets', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('gold');
			$table->integer('silver');
			$table->integer('copper');
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
		Schema::dropIfExists('wallets');
		Schema::dropIfExists('characters');
		Schema::dropIfExists('rooms');
		Schema::dropIfExists('zones');
		Schema::dropIfExists('players');
		Schema::dropIfExists('items_to_inventories');
		Schema::dropIfExists('inventories');
		Schema::dropIfExists('items');
		Schema::dropIfExists('item_types');
		Schema::dropIfExists('equipment_slots');
		Schema::dropIfExists('player_races');
		Schema::dropIfExists('player_classes');
		Schema::dropIfExists('max_values');
		Schema::dropIfExists('damage_types');
	}
}
