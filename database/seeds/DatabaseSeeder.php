<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// $this->call(UsersTableSeeder::class);
		$this->call([
			BasicEntries::class,
			RaceData::class,
			CreatureData::class,
			ItemsData::class,
			CreateTown::class,
			ZoneData::class,
			SpawnData::class,
			LootData::class,
			ForgeRecipes::class,
			QuestData::class,
			TeleportTargets::class,
			TestCharacters::class,
		]);
	}
}
