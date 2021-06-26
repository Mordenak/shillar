<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixSpells extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::table('spells', function (Blueprint $table) {
        $table->dropColumn('formula');
        $table->dropColumn('spell_types_id');
        $table->dropColumn('duration');
        $table->string('display_text')->nullable();
        $table->integer('rooms_id')->references('id')->on('rooms')->nullable();
        $table->boolean('is_combat')->default(false);
        });

    DB::table('spells')->update(['rooms_id' => 70]);

    Schema::table('spells', function (Blueprint $table) {
        $table->integer('rooms_id')->references('id')->on('rooms')->nullable(false)->change();
        });

    Schema::table('character_spell_buffs', function (Blueprint $table) {
        $table->string('buff_type');
        });

    Schema::drop('spell_types');

    Schema::drop('teleport_targets');

    Schema::create('spell_properties', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name');
        $table->text('description')->nullable();
        $table->string('format')->nullable();
        $table->string('custom_view')->nullable();
        $table->timestamps();
        });

    DB::table('spell_properties')->insert(['name' => 'RESTORE_HEALTH', 'description' => 'Restores health of the target.', 'format' => '{"formula":"{spell.level} * 2"}']);
    DB::table('spell_properties')->insert(['name' => 'DAMAGE_HEALTH', 'description' => 'Damages health of the target.', 'format' => '{"formula":"{spell.level} * 50"}']);
    DB::table('spell_properties')->insert(['name' => 'RESTORE_FATIGUE', 'description' => 'Restores fatigue of the target.', 'format' => '{"formula":"{spell.level} * 2"}']);
    DB::table('spell_properties')->insert(['name' => 'DAMAGE_FATIGUE', 'description' => 'Damages fatigue of the target.', 'format' => '{"formula":"{spell.level} * 8 * {creature.attacks_per_round}"}']);
    DB::table('spell_properties')->insert(['name' => 'APPLY_BUFF', 'description' => 'Applies a unique buff to the target.', 'format' => '{"name":"bedazzle","text":"You are bedazzling your enemies...","duration":"600","formula":"{spell.level} * 2"}']);
    DB::table('spell_properties')->insert(['name' => 'HAS_PARTIAL', 'description' => 'When selected spell displays a custom partial view.', 'format' => '{"partial":"/somewhere/view"']);
    DB::table('spell_properties')->insert(['name' => 'CONSUME_ITEM', 'description' => 'Consumes an item from the characters inventory when cast', 'format' => '{"formula":"{spell.level} * 2","item_id":"1"}']);
    DB::table('spell_properties')->insert(['name' => 'CHANGE_ROOM', 'description' => 'Changes the targets current room', 'format' => '{"room":"1"} or {"rooms": [{"id": 100, "wis": "40", "level": "5"}, {}]}']);

    Schema::create('spell_to_spell_properties', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->integer('spells_id')->references('id')->on('spells');
        $table->integer('spell_properties_id')->references('id')->on('spell_properties');
        $table->boolean('target_is_self');
        $table->jsonb('data');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('spells', function (Blueprint $table) {
        $table->string('formula')->nullable();
        $table->integer('spell_types_id')->nullable();
        $table->integer('duration')->nullable();
        $table->dropColumn('display_text');
        $table->dropColumn('rooms_id');
        $table->dropColumn('is_combat');
        });

    Schema::table('character_spell_buffs', function (Blueprint $table) {
        $table->dropColumn('buff_type');
        });

    Schema::drop('spell_properties');

    Schema::drop('spell_to_spell_properties');

    Schema::create('teleport_targets', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->integer('spells_id');
        $table->foreign('spells_id')->references('id')->on('spells');
        $table->string('name');
        $table->integer('rooms_id');
        $table->foreign('rooms_id')->references('id')->on('rooms');
        $table->integer('level_req')->nullable();
        $table->integer('wisdom_req')->nullable();
        $table->timestamps();
        });

    Schema::create('spell_types', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name');
        $table->text('description')->nullable();
        $table->timestamps();
        });
    }
}
