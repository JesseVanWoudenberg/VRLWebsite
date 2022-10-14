<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaceformatsTable extends Migration
{
    public function up()
    {
        Schema::create('raceformats', function (Blueprint $table) {
            $table->id();
            $table->string('format', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('raceformats');
    }
}
