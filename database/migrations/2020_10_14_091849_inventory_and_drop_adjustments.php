<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InventoryAndDropAdjustments extends Migration
	{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
		{
		Schema::table('ground_items', function (Blueprint $table) {
			$table->integer('quantity')->default(1);
			});

		Schema::table('inventory_items', function (Blueprint $table) {
			$table->boolean('equipped')->default(false);
			});
		}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
		{
		Schema::table('ground_items', function (Blueprint $table) {
			$table->dropColumn('quantity');
			});

		Schema::table('inventory_items', function (Blueprint $table) {
			$table->dropColumn('equipped');
			});
		}
	}
