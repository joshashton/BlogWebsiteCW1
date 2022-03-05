<?php

namespace Database\Seeders;

use App\Models\Comment;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $a  = new Comment();
        $a -> user_id = 1;
        $a -> post_id = 1;
        $a -> description = "This is my comment";
        $a -> save();

        $b  = new Comment();
        $b -> user_id = 2;
        $b -> post_id = 1;
        $b -> description = "This is my comment";
        $b -> save();

        Comment::factory()->count(50)->create();
       
    }
}
