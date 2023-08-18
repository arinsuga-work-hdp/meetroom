<?php

use Illuminate\Database\Seeder;

class RolesMeetRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //System Admin
        DB::table('roles')->insert([
            //'id' => 1,
            'app_id' => 1,
            'code' => 'sysadm',
            'name' => 'System Admin',
            'description' => 'Role System Admin',
        ]);

        //Admin
        DB::table('roles')->insert([
            //'id' => 2,
            'app_id' => 1,
            'code' => 'adm',
            'name' => 'Admin',
            'description' => 'Role Meeting Room Admin',
        ]);

        //Requester
        DB::table('roles')->insert([
            //'id' => 3,
            'app_id' => 1,
            'code' => 'req',
            'name' => 'Requester',
            'description' => 'Role Meeting Room Requester',
        ]);
        
    }
}
