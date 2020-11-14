<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendeeTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('event_id');
            $table->string('attendee_scope', 32);
            $table->string('content');
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('associate_events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendee_tasks');
    }
}
