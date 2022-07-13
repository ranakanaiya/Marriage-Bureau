<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

class CreateNakshatrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nakshatras', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::statement("INSERT INTO nakshatras (id,name) VALUES 
            (1,'Ashwini'),
            (2,'Bharani'),
            (3,'Krittika'),
            (4,'Rohini'),
            (5,'Mrighasira'),
            (6,'Ardra'),
            (7,'Punarvasu'),
            (8,'Pushya'),
            (9,'Ashlesha'),
            (10,'Magha'),
            (11,'Purva_Phalguni'),
            (12,'Uttara Phalguni'),
            (13,'Hasta'),
            (14,'Chitra'),
            (15,'Swati'),
            (16,'Vishaka'),
            (17,'Anuradha'),
            (18,'Jyestha'),
            (19,'Moola'),
            (20,'Purvashada'),
            (21,'Uttarashada'),
            (22,'Sharavan'),
            (23,'Dhanishta'),
            (24,'Shatabisha'),
            (25,'Purvabhadra'),
            (26,'Uttarabhadra'),
            (27,'Revati');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nakshatras');
    }
}
