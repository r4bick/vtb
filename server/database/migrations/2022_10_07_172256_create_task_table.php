<?php

use App\Constants\TaskCategories;
use App\Constants\TaskStatuses;
use App\Constants\TaskTypes;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 512);
            $table->string('description', 8192);
            $table->uuid('author_id')->index();
            $table->uuid('validator_id')->index();

            $table->dateTime('begin_at');
            $table->dateTime('end_at');
            $table->integer('participant_number');
            $table->enum('type', TaskTypes::toArray());
            $table->enum('status', TaskStatuses::toArray());
            $table->enum('category', TaskCategories::toArray());

            $table->bigInteger('reward');

            $table->foreign('author_id')->on('users')->references('id')->restrictOnDelete();
            $table->foreign('validator_id')->on('users')->references('id')->restrictOnDelete();

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
        Schema::dropIfExists('tasks');
    }
};
