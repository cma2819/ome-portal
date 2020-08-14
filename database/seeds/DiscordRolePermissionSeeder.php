<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscordRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discord_role_permissions')->insert([
            'discord_role_id' => '665123492915707914',
            'allowed_domain' => 'admin'
        ]);
        DB::table('discord_role_permissions')->insert([
            'discord_role_id' => '665123492915707914',
            'allowed_domain' => 'twitter'
        ]);
    }
}
