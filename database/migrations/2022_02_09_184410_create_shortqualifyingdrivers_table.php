<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortqualifyingdriversTable extends Migration
{
    public function up()
    {
        Schema::create('shortqualifyingdrivers', function (Blueprint $table) {

            $table->id();

            $table->integer('position')->default(100);

            $table->float('laptime', 6, 3)->default(0.00000);

            $table->string('tyre')->default("none");

            $table->foreignId('race_id')->constrained()->onUpdate('restrict')->onDelete('cascade');
            $table->foreignId('driver_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('team_id')->constrained()->onUpdate('restrict')->onDelete('restrict');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shortqualifyingdrivers');
    }
}
