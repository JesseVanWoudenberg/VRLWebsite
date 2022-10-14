<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacesTable extends Migration
{
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->integer('round');
//            $table->date('date')->default(Carbon::now());
            $table->foreignId('raceformat_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('track_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('season_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('tier_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('races');
    }
}
