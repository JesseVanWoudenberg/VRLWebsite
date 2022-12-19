<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamTransferRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('team_transfer_requests', function (Blueprint $table) {

            $table->id();

            $table->foreignId('request_status_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignid('user_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignid('driver_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignid('team_id')->constrained()->onUpdate('restrict')->onDelete('restrict');

            $table->string('reason', 500)->default("none");

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('team_transfer_requests');
    }
}
