<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('country_id')->unsigned()->index();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });

        DB::statement("INSERT INTO states (id,country_id,name) VALUES 
            ( 1 , 1 , 'Andaman & Nicobar Islands' ),
            ( 2 , 1 , 'Andhra Pradesh' ),
            ( 3 , 1 , 'Arunachal Pradesh' ),
            ( 4 , 1 , 'Assam' ),
            ( 5 , 1 , 'Bihar' ),
            ( 6 , 1 , 'Chandigarh' ),
            ( 7 , 1 , 'Chhattisgarh' ),
            ( 8 , 1 , 'Dadra & Nagar Haveli' ),
            ( 9 , 1 , 'Daman & Diu' ),
            ( 10 , 1 , 'Delhi' ),
            ( 11 , 1 , 'Goa' ),
            ( 12 , 1 , 'Gujarat' ),
            ( 13 , 1 , 'Haryana' ),
            ( 14 , 1 , 'Himachal Pradesh' ),
            ( 15 , 1 , 'Jammu & Kashmir' ),
            ( 16 , 1 , 'Jharkhand' ),
            ( 17 , 1 , 'Karnataka' ),
            ( 18 , 1 , 'Kerala' ),
            ( 19 , 1 , 'Lakshadweep' ),
            ( 20 , 1 , 'Madhya Pradesh' ),
            ( 21 , 1 , 'Maharashtra' ),
            ( 22 , 1 , 'Manipur' ),
            ( 23 , 1 , 'Meghalaya' ),
            ( 24 , 1 , 'Mizoram' ),
            ( 25 , 1 , 'Nagaland' ),
            ( 26 , 1 , 'Odisha' ),
            ( 27 , 1 , 'Puducherry' ),
            ( 28 , 1 , 'Punjab' ),
            ( 29 , 1 , 'Rajasthan' ),
            ( 30 , 1 , 'Sikkim' ),
            ( 31 , 1 , 'Tamil Nadu' ),
            ( 32 , 1 , 'Telangana' ),
            ( 33 , 1 , 'Tripura' ),
            ( 34 , 1 , 'Uttar Pradesh' ),
            ( 35 , 1 , 'Uttarakhand' ),
            ( 36 , 1 , 'West Bengal' );");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
