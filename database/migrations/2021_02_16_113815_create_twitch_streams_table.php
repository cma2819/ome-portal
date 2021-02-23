<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwitchStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitch_streams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('twitch_connection_id')->constrained('twitch_connections');
            $table->string('stream_id');
            $table->text('title');
            $table->string('game');
            $table->unsignedInteger('viewers');
            $table->string('thumbnail_uri');
            $table->string('status', 32);
            $table->dateTime('started_at');
            $table->dateTime('finished_at');
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
        Schema::dropIfExists('twitch_streams');
    }
}
