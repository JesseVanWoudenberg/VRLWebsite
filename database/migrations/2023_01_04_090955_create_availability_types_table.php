<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailabilityTypesTable extends Migration
{
    public function up()
    {
        Schema::create('availability_types', function (Blueprint $table) {

            $table->id();

            $table->string("name", 45);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('availability_types');
    }
}
