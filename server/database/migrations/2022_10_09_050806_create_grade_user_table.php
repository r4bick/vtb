<?php

use App\Constants\GradeUserStatus;
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
        Schema::create('grade_user', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('grade_id')->index();
            $table->uuid('user_id')->index();
            $table->jsonb('progress');
            $table->enum('status', GradeUserStatus::toArray());
            $table->dateTimeTz('end_at');

            $table->foreign('grade_id')->on('grades')->references('id')->restrictOnDelete();
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
        Schema::dropIfExists('grade_user');
    }
};
