<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRacialModColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::table('race_racial_modifiers', function (Blueprint $table) {
        $table->renameColumn('racial_modifier_id', 'racial_modifiers_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('race_racial_modifiers', function (Blueprint $table) {
        $table->renameColumn('racial_modifiers_id', 'racial_modifier_id');
        });
    }
}
