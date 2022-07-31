<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewShopColumn extends Migration
	{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
		{
		Schema::table('shops', function (Blueprint $table) {
			$table->boolean('show_quantity_buy')->default(false);
			});
		}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
		{
		Schema::table('shops', function (Blueprint $table) {
			$table->dropColumn('show_quantity_buy');
			});
		}
	}
