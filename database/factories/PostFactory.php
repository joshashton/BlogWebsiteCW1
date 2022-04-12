<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
   
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $users = \App\models\User::pluck('user_id')->toArray();
        //$users = User::all()->pluck('id')->toArray();
        return [
            'title' => $this->faker->realText($maxNbChars = 10, $indexSize = 2),
            'description' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'user_id' => $this->faker->randomElement($users) ,
        ];
    }
}
