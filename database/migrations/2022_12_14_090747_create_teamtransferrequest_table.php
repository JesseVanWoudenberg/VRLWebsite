<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamtransferrequestTable extends Migration
{
    public function up()
    {
        Schema::create('teamtransferrequest', function (Blueprint $table) {

            $table->id();

            $table->foreignId('requeststatus_id')->constrained('requeststatus')->onUpdate('restrict')->onDelete('restrict');

            $table->foreignId('team_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('user_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->string('reason', 500);

            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::dropIfExists('teamtransferrequest');
    }
}
