<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRandomizers extends Migration
	{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
		{
		Schema::table('randomizers', function (Blueprint $table) {
			$table->float('spawn_chance')->nullable();
			$table->boolean('block_other_spawns')->default(false);
			});

		Schema::table('active_randomizers', function (Blueprint $table) {
			$table->float('spawn_chance')->nullable();
			$table->boolean('block_other_spawns')->default(false);
			});
		}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
		{
		Schema::table('randomizers', function (Blueprint $table) {
			$table->dropColumn('spawn_chance');
			$table->dropColumn('block_other_spawns');
			});

		Schema::table('active_randomizers', function (Blueprint $table) {
			$table->dropColumn('spawn_chance');
			$table->dropColumn('block_other_spawns');
			});
		}
	}
