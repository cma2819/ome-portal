<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscordRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discord_role_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('discord_role_id', 64);
            $table->string('allowed_domain', 32);
            $table->timestamps();

            $table->unique(['discord_role_id', 'allowed_domain'], 'roles_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discord_role_permissions');
    }
}
