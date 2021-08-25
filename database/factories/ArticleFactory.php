<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(rand(1, 15)),
            'image' => '1.jpg',
            'description' => $this->faker->realText(rand(300, 1500)),
            'is_active' => rand(0, 1)
        ];
    }
}
