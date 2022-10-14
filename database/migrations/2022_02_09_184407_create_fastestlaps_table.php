<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFastestlapsTable extends Migration
{
    public function up()
    {
        Schema::create('fastestlaps', function (Blueprint $table) {
            $table->id();

            $table->float('laptime', 6, 3);

            $table->foreignId('race_id')->constrained()->onUpdate('restrict')->onDelete('cascade');
            $table->foreignId('driver_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('team_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fastestlaps');
    }
}
