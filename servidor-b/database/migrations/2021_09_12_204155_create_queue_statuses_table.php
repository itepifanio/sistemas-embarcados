<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueueStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('queue_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('camera_name');
            $table->string('queue_name');
            $table->integer('camera_status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('queue_statuses');
    }
}
