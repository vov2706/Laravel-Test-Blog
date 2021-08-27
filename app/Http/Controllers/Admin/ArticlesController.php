<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use App\Http\Requests\StoreRequest as ArticleStoreRequest;
use App\Http\Requests\UpdateRequest as ArticleUpdateRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create', ['title' => 'Додавання нової статті']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleStoreRequest $request)
    {
        $data = $request->validated();

        if ($result = array_intersect(explode(',', $request->get('tags')), Tag::pluck('name')->toArray())) {
            dd($result);
            $request->flash();
            return view('articles.create', ['title' => 'Додавання нової статті', 'errorTags' => $result]);
        }

        // Make images with different parameters
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {

                $obj = new \stdClass;

                $rnd_str = Str::random(10);

                $obj->mini = $rnd_str.'_mini.jpg';
                $obj->max = $rnd_str.'_max.jpg';
                $obj->path = $rnd_str.'.jpg';

                $img = Image::make($image);
                $img->fit(100, 75)->save(public_path().'/images/'.$obj->mini);
                $img->fit(500, 380)->save(public_path().'/images/'.$obj->max);
                $img->fit(210, 155)->save(public_path().'/images/'.$obj->path);

                $data['image'] = json_encode($obj);
            }
            
        }

        $allTags = Tag::all();
        $newDescription = ''; 
        foreach ($allTags as $tag) {
            if (preg_match("/\b$tag->name\b/i", strip_tags($data['description']))) {
                dump($tag->name);
                $newDescription = preg_replace("/\b$tag->name\b/", "<a href='/articles/$tag->article_id'>$tag->name</a>", $data['description']);
                $data['description'] = $newDescription;
                dump($data['description']);
            }
        }

        $article = Article::create($data);
        $allArticles = Article::where('id', '!=', $article->id)->get();

        // Get tags
        foreach (explode(', ', $request->get('tags')) as $tag) {
            $newTag = Tag::create([
                'name' => $tag,
                'article_id' => $article->id
            ]);
            $this->changeDescriptions($allArticles, $newTag);
            dd(1);
        }

        return redirect()->route('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $tags = Tag::where('article_id', $id)->pluck('name')->toArray();
        $title = 'Редагування статті';

        return view('articles.create', compact('article', 'tags', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleUpdateRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $data = $request->validated();
        
        //Check is_active var
        if (!$request->has('is_active')) {
            $data['is_active'] = 0;
        }

        $allTags = Tag::whereNotIn('id', $article->tags()->pluck('id')->toArray())->get();
        $newDescription = ''; 

        foreach ($allTags as $tag) {
            if (preg_match("/\b$tag->name\b/i", strip_tags($data['description']))) {
                if (strpos($data['description'], "<a href='/articles/$tag->article_id'>$tag->name</a>") === false) {
                    $newDescription = preg_replace("/\b$tag->name\b/", "<a href='/articles/$tag->article_id'>$tag->name</a>", $data['description']);
                    $data['description'] = $newDescription;
                }
            }
            
        }

        // Work with tags
        if ($request->has('tags')) {
            $articleTags = $article->tags()->pluck('name')->toArray();
            $updatedTags = explode(', ',$request->tags);
            $descriptions = Article::where('id', '!=', $id)->get();

            if ($arr = array_diff($updatedTags, $articleTags)) {
                foreach ($arr as $tag) {
                    $newTag = Tag::create([
                        'name' => $tag,
                        'article_id' => $id
                    ]);
                    dump('create');
                    $this->changeDescriptions($descriptions, $newTag);
                }
            }

            if ($arr = array_diff($articleTags, $updatedTags)) {
                $tags = Tag::whereIn('name', $arr)->delete();
                dump('delete');
                $this->changeDescriptions($descriptions, $tags, false);
            }
        }

        // Make images with different parameters
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {

                $obj = new \stdClass;

                $rnd_str = Str::random(10);

                $obj->mini = $rnd_str.'_mini.jpg';
                $obj->max = $rnd_str.'_max.jpg';
                $obj->path = $rnd_str.'.jpg';

                $img = Image::make($image);
                $img->fit(100, 75)->save(public_path().'/images/'.$obj->mini);
                $img->fit(500, 380)->save(public_path().'/images/'.$obj->max);
                $img->fit(210, 155)->save(public_path().'/images/'.$obj->path);

                $data['image'] = json_encode($obj);

                if ($request->has('old_image')) {
                    $oldImage = json_decode($request->old_image);
                    unlink(public_path().'/images/'.$oldImage->mini);
                    unlink(public_path().'/images/'.$oldImage->max);
                    unlink(public_path().'/images/'.$oldImage->path);
                }
            }
            
        }

        $article->fill($data);
        $article->save();

        return redirect()->route('articles.edit', ['article' => $article]);
    }

    public function changeDescriptions($arr, $tag, $is_create = true)
    {
        if ($is_create !== false) {
            foreach ($arr as $article) {
                if (preg_match("/\b$tag->name\b/i", strip_tags($article->description))) {
                    $newDescription = preg_replace("/\b$tag->name\b/", "<a href='/articles/$tag->article_id'>$tag->name</a>", $article->description);
                    $article->description = $newDescription;
                    dump('1 - '.$article->description);
                }
            }
        } else {
            if (is_array($tag)) {
                foreach ($tag as $t) {
                    foreach ($arr as $article) {
                        if (strpos($article->description, "<a href='/articles/$t->article_id'>$t->name</a>")) {
                            $newDescription = str_replace("<a href='/articles/$t->article_id'>$t->name</a>", $t->name, $article->description);
                            $article->description = $newDescription;
                            dump('2 - '.$article->description);
                        }
                    }
                }
            }  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        $img = $article->image;
    }
}
