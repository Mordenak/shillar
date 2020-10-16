<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLightLevelAccessories extends Migration
	{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
		{
		Schema::table('item_accessories', function (Blueprint $table) {
			$table->integer('light_level')->nullable();
			});
		}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
		{
		Schema::table('item_accessories', function (Blueprint $table) {
			$table->dropColumn('light_level');
			});
		}
	}