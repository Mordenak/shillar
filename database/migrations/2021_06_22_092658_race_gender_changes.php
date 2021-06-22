<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RaceGenderChanges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('genders', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('title');
        $table->timestamps();
        });

    DB::table('genders')->insert(['title' => 'Male']);
    DB::table('genders')->insert(['title' => 'Female']);

    Schema::table('characters', function (Blueprint $table) {
        $table->integer('genders_id')->references('id')->on('genders')->nullable();
        });

    DB::table('characters')->where('races_id', '<', '18')->update(['genders_id' => 1]);
    // DB::table('characters')->where('races_id', '>', '17')->update(['genders_id' => 2]);
    DB::table('characters')->where('races_id', '>', '17')->decrement('races_id', 17, ['genders_id' => 2]);

    Schema::table('characters', function (Blueprint $table) {
        $table->integer('genders_id')->references('id')->on('genders')->nullable(false)->change();
        });

    Schema::table('stat_costs', function (Blueprint $table) {
        $table->integer('genders_id')->references('id')->on('genders')->nullable();
        });

    DB::table('stat_costs')->where('races_id', '<', '18')->update(['genders_id' => 1]);
    // DB::table('stat_costs')->where('races_id', '>', '17')->update(['genders_id' => 2]);
    DB::table('stat_costs')->where('races_id', '>', '17')->decrement('races_id', 17, ['genders_id' => 2]);

    Schema::table('stat_costs', function (Blueprint $table) {
        $table->integer('genders_id')->references('id')->on('genders')->nullable(false)->change();
        });

    Schema::table('races', function (Blueprint $table) {
        $table->dropColumn('gender');
        });

    // No good matching reverse?
    DB::table('race_racial_modifiers')->where('races_id', '>', '17')->delete();
    DB::table('stat_costs')->where('races_id', '>', '17')->delete();
    DB::table('races')->where('id', '>', '17')->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::dropIfExists('genders');

    Schema::table('characters', function (Blueprint $table) {
        $table->dropColumn('genders_id');
        });

    Schema::table('stat_costs', function (Blueprint $table) {
        $table->dropColumn('genders_id');
        });

    Schema::table('races', function (Blueprint $table) {
        $table->string('gender');
        });

    DB::table('races')->where('id', '<', '18')->update(['gender' => 'Male']);
    DB::table('races')->where('id', '>', '17')->update(['gender' => 'Female']);
    }
}
