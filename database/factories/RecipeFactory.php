<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => rtrim( ucfirst($this->faker->text(5)), '.'  ),
            'user_id' => $this->faker->numberBetween(1,10),
            'category_id' => $this->faker->numberBetween(1,10),
            'procedure' => $this->faker->words(300, true),
            'duration' => mt_rand(10, 55),
            'ingredients' =>  implode(",", $this->faker->randomElements(['Cake', 'jujubes', 'oat', 'cake', 'toffee',
                'gingerbread',  'bear', 'claw', 'brownie', 'lemon'], 6))

        ];
    }
}
