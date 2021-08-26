<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Article;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory()->count(180)->create();

        $tags = Tag::all();
        $articlesDescriptions = Article::pluck('description');

        // foreach ($tags as $tag) {
        //     foreach ($articlesDescriptions as $description) {
        //         if (strpos($description, $tag->name) !== false) {
        //             str_replace($tag->name, "<a href='#'>$tag->name</a>", $description);
        //         }
        //     }
        // }
    }
}
