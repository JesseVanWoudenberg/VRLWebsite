<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrivernumberChangeRequestDenyReasonsTable extends Migration
{
    public function up()
    {
        Schema::create('drivernumber_change_request_deny_reasons', function (Blueprint $table) {
            $table->id();

            $table->integer('drivernumber_change_request_id')->unsigned();
            $table->string('reason', 500);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('drivernumber_change_request_deny_reasons');
    }
}
