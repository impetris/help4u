<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->string('time');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        DB::table('times')->insert(['time' => 'Ganztags']);
        DB::table('times')->insert(['time' => 'Morgens']);
        DB::table('times')->insert(['time' => 'Mittags']);
        DB::table('times')->insert(['time' => 'Abends']);
        DB::table('times')->insert(['time' => 'Nachts']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('times');
    }
}
