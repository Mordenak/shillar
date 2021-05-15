<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ForgeRecipes extends Seeder
	{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
		{

		DB::table('forges')->insert([
			['rooms_id' => 1, 'name' => 'Shillatown Forge', 'description' => null, 'custom_view' => 'partials/forge', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]
			]);

		DB::table('forge_recipes')->insert([
			['forges_id' => 1, 'item_weapons_id' => 12, 'item_armors_id' => 84, 'item_foods_id' => 175, 'item_jewels_id' => 236, 'item_dusts_id' => 243, 'alignments_id' => null, 'guilds_id' => null, 'name' => null, 'result_items_id' => 33, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],	
			]);
		}
	}
