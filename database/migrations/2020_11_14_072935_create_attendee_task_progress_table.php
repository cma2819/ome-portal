<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendeeTaskProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee_task_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('attendee_tasks');
            $table->foreignId('event_attendee_id')->constrained();
            $table->string('progress_status', 32);
            $table->string('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendee_task_progress');
    }
}
