<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $articleIds = Article::pluck('id');
        
        return [
            'name' => strtolower($this->faker->unique()->word),
            'article_id' => $articleIds->random()
        ];
    }
}
