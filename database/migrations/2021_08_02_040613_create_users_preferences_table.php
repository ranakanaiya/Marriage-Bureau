<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_preferences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('age_lower')->unsigned()->nullable();
            $table->tinyInteger('age_higher')->unsigned()->nullable();
            $table->integer('height_lower')->unsigned()->nullable();
            $table->integer('height_higher')->unsigned()->nullable();
            $table->integer('weight_lower')->unsigned()->nullable();
            $table->integer('weight_higher')->unsigned()->nullable();
            $table->string('marital_status')->nullable();
            $table->string('fitness')->nullable();
            $table->string('skin')->nullable();
            $table->tinyInteger('physical_handicape')->unsigned()->default(0);
            $table->string('diet')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('qualification')->nullable();
            $table->integer('monthly_income_lower')->unsigned()->nullable();
            $table->integer('monthly_income_higher')->unsigned()->nullable();
            $table->string('religion')->nullable();
            $table->string('caste')->nullable();
            $table->string('family_type')->nullable();
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
        Schema::dropIfExists('users_preferences');
    }
}
