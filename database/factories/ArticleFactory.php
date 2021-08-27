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

        $img = new \stdClass;

        $img->mini = '1_mini.jpg';
        $img->max = '1_max.jpg';
        $img->path = '1.jpg';

        return [
            'title' => $this->faker->sentence(rand(5, 10)),
            'image' => json_encode($img),
            'description' => $description,
            'is_active' => rand(0, 1)
        ];
    }
}
