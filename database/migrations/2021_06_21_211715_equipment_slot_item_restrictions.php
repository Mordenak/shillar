<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EquipmentSlotItemRestrictions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::table('equipment_slots', function (Blueprint $table) {
        $table->string('type_restriction')->nullable();
        });

    DB::table('equipment_slots')->where('name', 'weapon')->update(['type_restriction' => 'weapons']);
    DB::table('equipment_slots')->where('name', 'shield')->update(['type_restriction' => 'armors']);
    DB::table('equipment_slots')->where('name', 'head')->update(['type_restriction' => 'armors']);
    DB::table('equipment_slots')->where('name', 'neck')->update(['type_restriction' => 'armors']);
    DB::table('equipment_slots')->where('name', 'chest')->update(['type_restriction' => 'armors']);
    DB::table('equipment_slots')->where('name', 'hands')->update(['type_restriction' => 'armors']);
    DB::table('equipment_slots')->where('name', 'legs')->update(['type_restriction' => 'armors']);
    DB::table('equipment_slots')->where('name', 'feet')->update(['type_restriction' => 'armors']);
    DB::table('equipment_slots')->where('name', 'amulet')->update(['type_restriction' => 'accessories']);
    DB::table('equipment_slots')->where('name', 'ring')->update(['type_restriction' => 'accessories']);
    DB::table('equipment_slots')->where('name', 'bracelet')->update(['type_restriction' => 'accessories']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('equipment_slots', function (Blueprint $table) {
        $table->dropColumn('type_restriction');
        });
    }
}
