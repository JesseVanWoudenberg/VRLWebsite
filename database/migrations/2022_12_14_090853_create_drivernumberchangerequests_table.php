<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrivernumberchangerequestsTable extends Migration
{
    public function up()
    {
        Schema::create('drivernumberchangerequests', function (Blueprint $table) {

            $table->id();

            $table->foreignId('requeststatus_id')->constrained('requeststatuses')->onUpdate('restrict')->onDelete('restrict');

            $table->foreignId('user_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->integer('newnumber');

            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::dropIfExists('drivernumberchangerequests');
    }
}
