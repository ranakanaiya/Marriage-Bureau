<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_archives', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('old_user_id')->unsigned()->index();
            $table->string('name')->nullable();
            $table->string('email');
            $table->tinyInteger('step')->unsigbed();
            $table->tinyInteger('subscribed')->unsigned();
            $table->boolean('is_blocked');
            $table->text('details')->nullable();
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
        Schema::dropIfExists('user_archives');
    }
}
