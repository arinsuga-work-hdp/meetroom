<?php

use Illuminate\Database\Seeder;

class OrderstatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Table reset
        DB::table("orderstatus")->delete();
        DB::table("orderstatus")->insert([ "id" => 1, "name" => "Booked", "description" => "Booked", "image" => null, "numsort" => 10, "status" => 1 ]);  
        DB::table("orderstatus")->insert([ "id" => 2, "name" => "Approve", "description" => "Approve", "image" => null, "numsort" => 20, "status" => 1 ]);  
        DB::table("orderstatus")->insert([ "id" => 3, "name" => "Reject", "description" => "Reject", "image" => null, "numsort" => 30, "status" => 1 ]);  
        DB::table("orderstatus")->insert([ "id" => 4, "name" => "Canceled", "description" => "Canceled", "image" => null, "numsort" => 40, "status" => 1 ]);  
        DB::table("orderstatus")->insert([ "id" => 5, "name" => "Done", "description" => "Done", "image" => null, "numsort" => 50, "status" => 1 ]);  
    }
}
