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
        $description = '';
        for ($i = 0; $i < 5; $i++) {
            $description .= '<p class="mb-4">'.$this->faker->sentences(rand(5, 10), true).'</p>';
        }

        return [
            'title' => $this->faker->sentence(rand(5, 10)),
            'image' => '1.jpg',
            'description' => $description,
            'is_active' => rand(0, 1)
        ];
    }
}
