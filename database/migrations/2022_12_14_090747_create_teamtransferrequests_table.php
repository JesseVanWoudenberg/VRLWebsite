<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamtransferrequestsTable extends Migration
{
    public function up()
    {
        Schema::create('teamtransferrequests', function (Blueprint $table) {

            $table->id();

            $table->foreignId('requeststatus_id')->constrained('requeststatuses')->onUpdate('restrict')->onDelete('restrict');

            $table->foreignId('team_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('user_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->string('reason', 500);

            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::dropIfExists('teamtransferrequests');
    }
}
