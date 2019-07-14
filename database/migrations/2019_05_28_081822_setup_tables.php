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


		Schema::create('max_values', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('max_level');
			$table->timestamps();
		});

		Schema::create('races', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('classes', function (Blueprint $table) {
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
			$table->integer('players_id');
			$table->foreign('players_id')->references('id')->on('players');
			$table->string('name');
			$table->integer('classes_id');
			$table->foreign('classes_id')->references('id')->on('classes');
			$table->integer('races_id');
			$table->foreign('races_id')->references('id')->on('races');
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
		Schema::dropIfExists('players');
		Schema::dropIfExists('items_to_inventories');
		Schema::dropIfExists('inventories');
		Schema::dropIfExists('item_types');
		Schema::dropIfExists('items');
		Schema::dropIfExists('equipment_slots');
		Schema::dropIfExists('races');
		Schema::dropIfExists('classes');
		Schema::dropIfExists('max_values');
		Schema::dropIfExists('damage_types');
	}
}
