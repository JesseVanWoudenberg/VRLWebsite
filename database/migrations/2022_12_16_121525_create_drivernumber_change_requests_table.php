<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrivernumberChangeRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('drivernumber_change_requests', function (Blueprint $table) {

            $table->id();

            $table->foreignId('request_status_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('user_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('driver_id')->constrained()->onUpdate('restrict')->onDelete('restrict');

            $table->string('new_drivernumber', 3);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('drivernumber_change_requests');
    }
}
