<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverchampionshipsTable extends Migration
{
    public function up()
    {
        Schema::create('driverchampionships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('team_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('season_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('tier_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('driverchampionships');
    }
}
