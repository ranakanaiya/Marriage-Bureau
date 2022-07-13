<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

class CreateZodiacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zodiacs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::statement("INSERT INTO zodiacs (id,name) VALUES
            (1,'Aries'),
            (2,'Taurus'),
            (3,'Gemini'),
            (4,'Cancer'),
            (5,'Leo'),
            (6,'Virgo'),
            (7,'Libra'),
            (8,'Scorpius'),
            (9,'Sagittarius'),
            (10,'Capricornus'),
            (11,'Aquarius'),
            (12,'Pisces');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zodiacs');
    }
}
