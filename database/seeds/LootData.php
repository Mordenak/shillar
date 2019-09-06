<?php

use Illuminate\Database\Seeder;

class LootData extends Seeder
	{
		/**
		* Run the database seeds.
		*
		* @return void
		*/
		public function run()
		{
		DB::table('loot_tables')->insert([
			['creatures_id' => 2, 'items_id' => 124, 'chance' => 0.575, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 3, 'items_id' => 124, 'chance' => 0.675, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 7, 'items_id' => 125, 'chance' => 0.9, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 7, 'items_id' => 126, 'chance' => 0.9, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
		}
	}
