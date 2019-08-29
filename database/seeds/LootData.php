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
			['creatures_id' => 2, 'items_id' => 29, 'chance' => 0.575, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 3, 'items_id' => 29, 'chance' => 0.675, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 5, 'items_id' => 32, 'chance' => 0.575, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
		}
	}
