<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPersonalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_personal_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->tinyInteger('gender')->unsigned()->default(0);
            $table->string('image')->nullable();
            $table->date('dob');
            $table->string('birth_time')->nullable();
            $table->integer('height')->unsigned()->nullable();
            $table->integer('weight')->unsigned()->nullable();
            $table->string('contact');
            $table->tinyInteger('marital_status')->unsigned()->default(0);
            $table->tinyInteger('fitness')->unsigned()->default(0);
            $table->tinyInteger('skin')->unsigned()->default(0);
            $table->string('blood_group',5)->nullable();
            $table->string('mother_tongue')->nullable();
            $table->boolean('physical_handicape')->default(0);
            $table->string('physical_handicape_detail')->nullable();
            $table->string('addiction');
            $table->tinyInteger('diet')->unsigned()->default(0);
            $table->string('family_diet')->nullable();
            $table->string('address');
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
        Schema::dropIfExists('user_personal_details');
    }
}
