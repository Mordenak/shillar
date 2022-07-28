<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewIndexes extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('characters', function (Blueprint $table) {
			$table->index('users_id', 'characters_users_id_idx');
			$table->index('races_id', 'characters_races_id_idx');
		});

		Schema::table('kill_counts', function (Blueprint $table) {
			$table->index('characters_id', 'kill_count_characters_id_idx');
			$table->unique(['characters_id', 'creatures_id'], 'kill_count_characters_creatures_unique');
		});

		Schema::table('items', function (Blueprint $table) {
			$table->unique('name', 'items_name_unique');
		});

		Schema::table('rooms', function (Blueprint $table) {
			$table->unique('uid', 'rooms_uid_unique');
			$table->index('title', 'rooms_title_idx');
			$table->index('zones_id', 'rooms_zones_id_idx');
		});

		Schema::table('zones', function (Blueprint $table) {
			$table->unique('name', 'zones_name_unique');
		});

		Schema::table('inventories', function (Blueprint $table) {
			$table->unique('characters_id', 'inventories_characters_id_unique');
		});

		Schema::table('item_armors', function (Blueprint $table) {
			$table->unique('items_id', 'item_armors_items_id_unique');
		});

		Schema::table('item_weapons', function (Blueprint $table) {
			$table->unique('items_id', 'item_weapons_items_id_unique');
		});

		Schema::table('item_accessories', function (Blueprint $table) {
			$table->unique('items_id', 'item_accessories_items_id_unique');
		});

		Schema::table('item_foods', function (Blueprint $table) {
			$table->unique('items_id', 'item_foods_items_id_unique');
		});

		Schema::table('item_dusts', function (Blueprint $table) {
			$table->unique('items_id', 'item_dusts_items_id_unique');
		});

		Schema::table('item_jewels', function (Blueprint $table) {
			$table->unique('items_id', 'item_jewels_items_id_unique');
		});

		Schema::table('item_others', function (Blueprint $table) {
			$table->unique('items_id', 'item_others_items_id_unique');
		});

		Schema::table('inventory_items', function (Blueprint $table) {
			$table->index('inventory_id', 'inventory_items_inventory_id_idx');
			$table->index('items_id', 'inventory_items_items_id_idx');
		});

		Schema::table('equipment', function (Blueprint $table) {
			$table->unique('characters_id', 'equipment_characters_id_unique');
		});

		Schema::table('item_properties', function (Blueprint $table) {
			$table->unique('name', 'item_properties_name_unique');
		});

		Schema::table('item_to_item_properties', function (Blueprint $table) {
			$table->index('items_id', 'item_to_item_properties_items_id_idx');
			$table->index('item_properties_id', 'item_to_item_properties_item_properties_id_idx');
			$table->unique(['items_id', 'item_properties_id'], 'item_to_item_properties_item_item_prop_unique');
		});

		Schema::table('inventory_item_to_item_properties', function (Blueprint $table) {
			$table->index('inventory_items_id', 'inventory_item_to_item_properties_items_id_idx');
			$table->index('item_properties_id', 'inventory_item_to_item_properties_item_properties_id_idx');
			$table->unique(['inventory_items_id', 'item_properties_id'], 'inventory_item_to_item_properties_item_item_prop_unique');
		});

		Schema::table('ground_item_to_item_properties', function (Blueprint $table) {
			$table->index('ground_items_id', 'ground_item_to_item_properties_items_id_idx');
			$table->index('item_properties_id', 'ground_item_to_item_properties_item_properties_id_idx');
			$table->unique(['ground_items_id', 'item_properties_id'], 'ground_item_to_item_properties_item_item_prop_unique');
		});

		Schema::table('loot_tables', function (Blueprint $table) {
			$table->index('creatures_id', 'loot_tables_creatures_id_idx');
		});

		Schema::table('combat_logs', function (Blueprint $table) {
			$table->unique(['characters_id', 'rooms_id'], 'combat_logs_characters_rooms_unique');
			$table->unique(['characters_id', 'creatures_id', 'rooms_id'], 'combat_logs_characters_creatures_rooms_unique');
		});

		Schema::table('spawn_rules', function (Blueprint $table) {
			$table->index('rooms_id', 'spawn_rules_rooms_id_idx');
			$table->index('zones_id', 'spawn_rules_zones_id_idx');
			$table->index('zone_areas_id', 'spawn_rules_zone_areas_id_idx');
		});

		Schema::table('ground_items', function (Blueprint $table) {
			$table->index(['rooms_id', 'characters_id'], 'ground_items_rooms_characters_idx');
			$table->unique(['id', 'rooms_id', 'characters_id'], 'ground_items_id_rooms_characters_unique');
			$table->index(['rooms_id', 'characters_id', 'items_id'], 'ground_items_rooms_characters_items_idx');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('characters', function (Blueprint $table) {
			$table->dropIndex('characters_users_id_idx');
			$table->dropIndex('characters_races_id_idx');
		});

		Schema::table('kill_counts', function (Blueprint $table) {
			$table->dropIndex('kill_count_characters_id_idx');
			$table->dropUnique('kill_count_characters_creatures_unique');
		});

		Schema::table('items', function (Blueprint $table) {
			$table->dropUnique('items_name_unique');
		});

		Schema::table('rooms', function (Blueprint $table) {
			$table->dropUnique('rooms_uid_unique');
			$table->dropIndex('rooms_title_idx');
			$table->dropIndex('rooms_zones_id_idx');
		});

		Schema::table('zones', function (Blueprint $table) {
			$table->dropUnique('zones_name_unique');
		});

		Schema::table('inventories', function (Blueprint $table) {
			$table->dropUnique('inventories_characters_id_unique');
		});

		Schema::table('item_armors', function (Blueprint $table) {
			$table->dropUnique('item_armors_items_id_unique');
		});

		Schema::table('item_weapons', function (Blueprint $table) {
			$table->dropUnique('item_weapons_items_id_unique');
		});

		Schema::table('item_accessories', function (Blueprint $table) {
			$table->dropUnique('item_accessories_items_id_unique');
		});

		Schema::table('item_foods', function (Blueprint $table) {
			$table->dropUnique('item_foods_items_id_unique');
		});

		Schema::table('item_dusts', function (Blueprint $table) {
			$table->dropUnique('item_dusts_items_id_unique');
		});

		Schema::table('item_jewels', function (Blueprint $table) {
			$table->dropUnique('item_jewels_items_id_unique');
		});

		Schema::table('item_others', function (Blueprint $table) {
			$table->dropUnique('item_others_items_id_unique');
		});

		Schema::table('inventory_items', function (Blueprint $table) {
			$table->dropIndex('inventory_items_inventory_id_idx');
			$table->dropIndex('inventory_items_items_id_idx');
		});

		Schema::table('equipment', function (Blueprint $table) {
			$table->dropUnique('equipment_characters_id_unique');
		});

		Schema::table('item_properties', function (Blueprint $table) {
			$table->dropUnique('item_properties_name_unique');
		});

		Schema::table('item_to_item_properties', function (Blueprint $table) {
			$table->dropIndex('item_to_item_properties_items_id_idx');
			$table->dropIndex('item_to_item_properties_item_properties_id_idx');
			$table->dropUnique('item_to_item_properties_item_item_prop_unique');
		});

		Schema::table('inventory_item_to_item_properties', function (Blueprint $table) {
			$table->dropIndex('inventory_item_to_item_properties_items_id_idx');
			$table->dropIndex('inventory_item_to_item_properties_item_properties_id_idx');
			$table->dropUnique('inventory_item_to_item_properties_item_item_prop_unique');
		});

		Schema::table('ground_item_to_item_properties', function (Blueprint $table) {
			$table->dropIndex('ground_item_to_item_properties_items_id_idx');
			$table->dropIndex('ground_item_to_item_properties_item_properties_id_idx');
			$table->dropUnique('ground_item_to_item_properties_item_item_prop_unique');
		});

		Schema::table('loot_tables', function (Blueprint $table) {
			$table->dropIndex('loot_tables_creatures_id_idx');
		});

		Schema::table('combat_logs', function (Blueprint $table) {
			$table->dropUnique('combat_logs_characters_rooms_unique');
			$table->dropUnique('combat_logs_characters_creatures_rooms_unique');
		});

		Schema::table('spawn_rules', function (Blueprint $table) {
			$table->dropIndex('spawn_rules_rooms_id_idx');
			$table->dropIndex('spawn_rules_zones_id_idx');
			$table->dropIndex('spawn_rules_zone_areas_id_idx');
		});

		Schema::table('ground_items', function (Blueprint $table) {
			$table->dropIndex('ground_items_rooms_characters_idx');
			$table->dropUnique('ground_items_id_rooms_characters_unique');
			$table->dropIndex('ground_items_rooms_characters_items_idx');
		});
	}
}
