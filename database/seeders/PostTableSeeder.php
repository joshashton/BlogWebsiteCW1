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
        $a -> title = "first post";
        $a -> description = "This is my post";
        $a -> user_id = 1;
        $a -> save();

        $b  = new Post();
        $b -> title = "second post";
        $b -> description = "This is my 2nd post";
        $b -> user_id = 1;
        $b -> save();

        Post::factory()->count(50)->create();

    }
}
