<?php

namespace Database\Seeders;

use App\Models\User;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a  = new User();
        $a -> name = "dave";
        $a -> email = "dave@gmail.com";
        $a -> password = "12341";
        $a -> save();
        
        $b  = new User();
        $b -> name = "bill";
        $b -> email = "bill@gmail.com";
        $b -> password = "12341";
        $b -> save();

        User::factory()->count(50)->create();

    }
}
