<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewRandomizerTable extends Migration
	{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
		{
		Schema::create('randomizers', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('uid')->unique();
			$table->integer('rooms_id')->references('id')->on('rooms')->nullable();
			$table->integer('zones_id')->references('id')->on('zones')->nullable();
			$table->integer('zone_areas_id')->references('id')->on('zone_areas')->nullable();
			$table->integer('creatures_id')->references('id')->on('creatures')->nullable();
			$table->integer('creature_groups_id')->references('id')->on('creature_groups')->nullable();
			$table->integer('rotation_hours');
			$table->timestamps();
			});

		Schema::create('active_randomizers', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('randomizers_id')->references('id')->on('randomizers');
			$table->integer('rooms_id')->references('id')->on('rooms')->nullable();
			$table->integer('creatures_id')->references('id')->on('creatures')->nullable();
			$table->integer('creature_groups_id')->references('id')->on('creature_groups')->nullable();
			$table->integer('expires_on');
			$table->timestamps();
			});

		// Drop these columns from spawn_rules:
		Schema::table('spawn_rules', function (Blueprint $table) {
			$table->dropColumn('spawn_hour');
			$table->dropColumn('random_hour');
			});
		}

	/**
	 * Reverse the migrations.
	 *-
	 * @return void
	 */
	public function down()
		{
		Schema::dropIfExists('randomizers');
		Schema::dropIfExists('active_randomizers');

		Schema::table('spawn_rules', function (Blueprint $table) {
			$table->integer('spawn_hour')->nullable();
			$table->boolean('random_hour')->default(false);
			});
		}
	}
