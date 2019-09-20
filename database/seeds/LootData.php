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
			['creatures_id' => 2, 'items_id' => 163, 'chance' => 0.575, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 3, 'items_id' => 163, 'chance' => 0.675, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 8, 'items_id' => 164, 'chance' => 0.9, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 8, 'items_id' => 165, 'chance' => 0.9, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 11, 'items_id' => 5, 'chance' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 13, 'items_id' => 12, 'chance' => 0.625, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 13, 'items_id' => 75, 'chance' => 0.625, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 15, 'items_id' => 171, 'chance' => 0.66, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 15, 'items_id' => 171, 'chance' => 0.66, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 16, 'items_id' => 171, 'chance' => 0.66, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 16, 'items_id' => 171, 'chance' => 0.66, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 16, 'items_id' => 171, 'chance' => 0.66, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 14, 'items_id' => 14, 'chance' => 0.525, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 17, 'items_id' => 91, 'chance' => 0.525, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 19, 'items_id' => 168, 'chance' => 0.575, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 22, 'items_id' => 13, 'chance' => 0.16, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 23, 'items_id' => 83, 'chance' => 0.275, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 24, 'items_id' => 78, 'chance' => 0.575, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 24, 'items_id' => 80, 'chance' => 0.575, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 24, 'items_id' => 174, 'chance' => 0.575, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 25, 'items_id' => 76, 'chance' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 25, 'items_id' => 77, 'chance' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 25, 'items_id' => 82, 'chance' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 25, 'items_id' => 174, 'chance' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 26, 'items_id' => 81, 'chance' => 0.475, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 26, 'items_id' => 79, 'chance' => 0.475, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 26, 'items_id' => 16, 'chance' => 0.475, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 26, 'items_id' => 124, 'chance' => 0.475, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 26, 'items_id' => 174, 'chance' => 0.475, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 30, 'items_id' => 177, 'chance' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 30, 'items_id' => 177, 'chance' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 31, 'items_id' => 177, 'chance' => 0.525, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 31, 'items_id' => 177, 'chance' => 0.525, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 32, 'items_id' => 93, 'chance' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 34, 'items_id' => 243, 'chance' => 0.525, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 35, 'items_id' => 236, 'chance' => 0.6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 40, 'items_id' => 180, 'chance' => 0.7, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 40, 'items_id' => 180, 'chance' => 0.7, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 40, 'items_id' => 180, 'chance' => 0.7, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 41, 'items_id' => 84, 'chance' => 0.525, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 41, 'items_id' => 85, 'chance' => 0.525, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 41, 'items_id' => 86, 'chance' => 0.525, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 41, 'items_id' => 87, 'chance' => 0.525, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 41, 'items_id' => 88, 'chance' => 0.525, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 41, 'items_id' => 89, 'chance' => 0.525, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 43, 'items_id' => 18, 'chance' => 0.625, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 44, 'items_id' => 18, 'chance' => 0.55, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 48, 'items_id' => 184, 'chance' => 0.625, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 48, 'items_id' => 184, 'chance' => 0.625, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 49, 'items_id' => 184, 'chance' => 0.65, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 49, 'items_id' => 184, 'chance' => 0.65, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 53, 'items_id' => 182, 'chance' => 0.54, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 54, 'items_id' => 90, 'chance' => 0.40, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			]);
		}
	}
