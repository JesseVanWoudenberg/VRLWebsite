<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverAvailabilitiesTable extends Migration
{
    public function up()
    {
        Schema::create('driver_availabilities', function (Blueprint $table) {

            $table->id();

            $table->foreignId('race_availability_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('availability_type_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('driver_id')->constrained()->onUpdate('restrict')->onDelete('restrict');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('driver_availabilities');
    }
}
