<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquirersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquirers', function (Blueprint $table) {
            $table->id();

            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('zip');
            $table->string('place');
            $table->string('phone');
            $table->decimal('latitude', 12, 10)->nullable();
            $table->decimal('longitude', 12, 10)->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('time_id');

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('time_id')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enquirers');
    }
}
