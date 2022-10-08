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
        Schema::create('task_user', function (Blueprint $table) {
            $table->id();
            $table->uuid('task_id')->index();
            $table->uuid('user_id')->index();

            $table->foreign('task_id')->on('tasks')->references('id')->restrictOnDelete();
            $table->foreign('user_id')->on('users')->references('id')->restrictOnDelete();


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
        Schema::dropIfExists('task_account');
    }
};
