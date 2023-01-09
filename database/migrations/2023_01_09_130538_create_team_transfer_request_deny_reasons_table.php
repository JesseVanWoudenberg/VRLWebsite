<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamTransferRequestDenyReasonsTable extends Migration
{
    public function up()
    {
        Schema::create('team_transfer_request_deny_reasons', function (Blueprint $table) {
            $table->id();

            $table->integer('team_transfer_request_id')->unsigned();
            $table->string('reason', 500);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('team_transfer_request_deny_reasons');
    }
}
