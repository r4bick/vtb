<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('departures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->uuid('head_id');

            $table->foreign('head_id')->on('users')->references('id')->restrictOnDelete();

            $table->timestamps();
        });

        DB::statement('create extension if not exists ltree');
        DB::statement("alter table departures add column departure_id ltree");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departure');
        DB::statement("drop extension ltree");
    }
};
