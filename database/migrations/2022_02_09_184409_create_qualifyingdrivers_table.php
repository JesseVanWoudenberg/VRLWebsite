<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualifyingdriversTable extends Migration
{
    public function up()
    {
        Schema::create('qualifyingdrivers', function (Blueprint $table) {

            $table->id();

            $table->integer('q1')->default(100);
            $table->integer('q2')->default(100);
            $table->integer('q3')->default(100);

            $table->string('q1tyre')->default("none");
            $table->string('q2tyre')->default("none");
            $table->string('q3tyre')->default("none");

            $table->float('q1laptime', 6, 3)->default(0.00000);
            $table->float('q2laptime', 6, 3)->default(0.00000);
            $table->float('q3laptime', 6, 3)->default(0.00000);

            $table->foreignId('race_id')->constrained()->onUpdate('restrict')->onDelete('cascade');
            $table->foreignId('driver_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('team_id')->constrained()->onUpdate('restrict')->onDelete('restrict');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('qualifyingdrivers');
    }
}
