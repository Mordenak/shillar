<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AnotherSpellsFix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::table('spells', function (Blueprint $table) {
        $table->integer('base_training_value')->default(20000);
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
        $table->dropColumn('base_training_value');
        });
    }
}
