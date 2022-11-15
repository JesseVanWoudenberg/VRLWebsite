<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenaltypointsTable extends Migration
{
    public function up()
    {
        Schema::create('penaltypoints', function (Blueprint $table) {

            $table->id();

            $table->integer("amount");
            $table->foreignId('driver_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('race_id')->constrained()->onUpdate('restrict')->onDelete('restrict');

            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('penaltypoints');
    }
}
