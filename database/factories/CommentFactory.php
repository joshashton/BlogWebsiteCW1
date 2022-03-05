<?php


namespace Database\Factories;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $users = \App\models\User::pluck('user_id')->toArray();
        $posts = \App\models\Post::pluck('post_id')->toArray();
        
        return [
            
            'user_id' => $this->faker->randomElement($users) ,
            'post_id'=> $this->faker->randomElement($posts) ,
            'description' => $this->faker->realText($maxNbChars = 15, $indexSize = 2),
            
        ];
    }
}
    