<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityStateToUserPersonalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_personal_details', function (Blueprint $table) {
            $table->bigInteger('city_id')->unsigned()->index()->after('address');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->bigInteger('state_id')->unsigned()->index()->after('address');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->bigInteger('country_id')->unsigned()->index()->after('address');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_personal_details', function (Blueprint $table) {
            //
        });
    }
}
