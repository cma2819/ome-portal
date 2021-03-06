<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_attendees', function (Blueprint $table) {
            $table->id();
            $table->string('event_id', 64);
            $table->foreignId('user_id')->constrained('users');
            $table->string('attend_scope', 32);
            $table->timestamps();

            $table->unique(['event_id', 'user_id', 'attend_scope']);
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
        Schema::dropIfExists('event_attendees');
    }
}
