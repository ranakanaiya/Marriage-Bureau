<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

class CreateZodiacMatchLogicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zodiac_match_logics', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('male_zodiac')->unsigned()->index();
            $table->foreign('male_zodiac')->references('id')->on('zodiacs')->onDelete('cascade');
            $table->bigInteger('female_zodiac')->unsigned()->index();
            $table->foreign('female_zodiac')->references('id')->on('zodiacs')->onDelete('cascade');
            $table->string('result');
            $table->timestamps();
        });

        DB::statement("INSERT INTO zodiac_match_logics (id,male_zodiac,female_zodiac,result) VALUES 
            (1,1,2,'Ashubh'),
            (2,2,1,'Ashubh'),
            (3,3,4,'Ashubh'),
            (4,4,3,'Ashubh'),
            (5,5,6,'Ashubh'),
            (6,6,5,'Ashubh'),
            (7,7,8,'Ashubh'),
            (8,8,7,'Ashubh'),
            (9,9,10,'Ashubh'),
            (10,10,9,'Ashubh'),
            (11,11,12,'Ashubh'),
            (12,12,11,'Ashubh'),
            (13,1,6,'Satru Sadaastak'),
            (14,6,1,'Satru Sadaastak'),
            (15,3,8,'Satru Sadaastak'),
            (16,8,3,'Satru Sadaastak'),
            (17,5,10,'Satru Sadaastak'),
            (18,10,5,'Satru Sadaastak'),
            (19,7,12,'Satru Sadaastak'),
            (20,12,7,'Satru Sadaastak'),
            (21,11,4,'Satru Sadaastak'),
            (22,4,11,'Satru Sadaastak'),
            (23,2,9,'Satru Sadaastak'),
            (24,9,2,'Satru Sadaastak'),
            (25,3,11,'Madhya Panchak'),
            (26,11,3,'Madhya Panchak'),
            (27,12,4,'Madhya Panchak'),
            (28,4,12,'Madhya Panchak'),
            (29,4,8,'Madhya Panchak'),
            (30,8,4,'Madhya Panchak'),
            (31,6,10,'Madhya Panchak'),
            (32,10,6,'Madhya Panchak');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zodiac_match_logics');
    }
}
