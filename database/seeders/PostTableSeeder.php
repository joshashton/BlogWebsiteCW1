<?php

namespace Database\Seeders;

use App\Models\Post;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a  = new Post();
        $a -> description = "This is my post";
        $a -> user_id = 1;

    }
}
