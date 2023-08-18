<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Reset table
        DB::table('users')->delete();

        DB::table('users')->insert([
            'id' => 1,
            'name' => 'System Admin',
            'email' => 'sysadmin@hadiprana.co.id',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'bo' => true,
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Admin 1',
            'email' => 'admin1@hadiprana.co.id',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'bo' => true,
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Admin 2',
            'email' => 'admin2@hadiprana.co.id',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'bo' => true,
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'name' => 'Departemen Interior',
            'email' => 'interior@hadiprana.co.id',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'id' => 5,
            'name' => 'Departemen Arsitek',
            'email' => 'arsitek@hadiprana.co.id',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
        ]);


        DB::table('users')->insert([
            'id' => 6,
            'name' => 'Design and Build',
            'email' => 'dnb@hadiprana.co.id',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'technician' => true,
            'bo' => true,
        ]);

        DB::table('users')->insert([
            'id' => 7,
            'name' => 'Departemen IT',
            'email' => 'it@hadiprana.co.id',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'technician' => true,
            'bo' => true,
        ]);

        DB::table('users')->insert([
            'id' => 9,
            'name' => 'Departemen Keuangan',
            'email' => 'keuangan@hadiprana.co.id',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'technician' => true,
            'bo' => true,
        ]);

        DB::table('users')->insert([
            'id' => 10,
            'name' => 'Departemen Umum',
            'email' => 'umum@hadiprana.co.id',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'technician' => true,
            'bo' => true,
        ]);

        //dummy data
        //factory(App\User::class, 1000)->create();

    }
}
