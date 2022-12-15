<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequeststatusesTable extends Migration
{
    /*
     *
     * Opened
     * Closed
     * Returned
     *
     */

    public function up()
    {
        Schema::create('requeststatuses', function (Blueprint $table) {

            $table->id();

            $table->string("status", 100);

            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('requeststatuses');
    }
}
