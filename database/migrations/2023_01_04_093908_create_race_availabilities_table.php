<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaceAvailabilitiesTable extends Migration
{
    public function up()
    {
        Schema::create('race_availabilities', function (Blueprint $table) {

            $table->id();

            $table->foreignId('race_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('season_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('tier_id')->constrained()->onUpdate('restrict')->onDelete('restrict');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('race_availabilities');
    }
}
