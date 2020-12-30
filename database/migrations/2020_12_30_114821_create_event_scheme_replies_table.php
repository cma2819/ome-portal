<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventSchemeRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_scheme_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scheme_id')->constrained('event_schemes');
            $table->string('to_status', 32);
            $table->string('admin_reply');
            $table->dateTime('replied_at');
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
        Schema::dropIfExists('event_scheme_replies');
    }
}
