<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_departure', function (Blueprint $table) {
            $table->id();
            $table->uuid('departure_id')->index();
            $table->uuid('task_id')->index();

            $table->foreign('departure_id')->on('departures')->references('id')->restrictOnDelete();
            $table->foreign('task_id')->on('tasks')->references('id')->restrictOnDelete();

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
        Schema::dropIfExists('task_departure');
    }
};
