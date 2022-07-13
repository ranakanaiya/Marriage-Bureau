<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHoroscopeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_horoscope_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('believe_janmaksar')->default(0);
            $table->tinyInteger('janmaksar_type')->unsigned()->default(0);
            $table->integer('naksatra')->unsigned()->default(0);
            $table->integer('zodiac_sign')->unsigned()->default(0);
            $table->integer('gan')->unsigned()->default(0);
            $table->integer('naadi')->unsigned()->default(0);
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
        Schema::dropIfExists('user_horoscope_details');
    }
}
