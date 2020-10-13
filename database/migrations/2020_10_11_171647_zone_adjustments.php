<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ZoneAdjustments extends Migration
	{

		/**
		* Run the migrations.
		*
		* @return void
		*/
		public function up()
		{
		Schema::table('zones', function (Blueprint $table) {
			$table->string('bg_img')->nullable();
			});
		}

		/**
		* Reverse the migrations.
		*
		* @return void
		*/
		public function down()
		{
		Schema::table('zones', function (Blueprint $table) {
			$table->dropColumn('bg_img');
			});
		}
	}
