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
        $articles = Article::all();

        foreach ($tags as $tag) {
            foreach ($articles as $article) {
                if (preg_match("/\b$tag->name\b/u", strip_tags($article->description))) {
                    if (strpos($article->description, '<a href="/articles/' . $tag->article_id . '">' . $tag->name . '</a>') === false) {
                        $newDescription = preg_replace("/\b$tag->name\b/u", '<a href="/articles/' . $tag->article_id . '">' . $tag->name . '</a>', $article->description);
                        $article->description = $newDescription;
                        $article->save();
                    }
                }
            }
        }
        
    }
}
