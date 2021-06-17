<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticles;
use App\Models\ArticleModel;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('articles.index', ['articles' => $this->news]);

        //get data from DB
        //return view('articles.index', ['articles' => ArticleModel::orderBy('created_at', 'desc')->take(6)->get()]);
        // return view('articles.index', ['articles' => ArticleModel::all()]);

        // cache file
        $mostCommented = Cache::remember('blog-post-most-commented ', now()->addSeconds(60), function () {
            return ArticleModel::mostCommented()->take(5)->get();
        });

        return view('articles.index',
            ['articles' => ArticleModel::latest()->withCount('comments')->with('tags')->with('user')->get(),
                'mostCommented' => $mostCommented,
            ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticles $request)
    {
        // validate data from StoreArticle
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;

        // call Model
        $article = new ArticleModel();

        // post data
        // $article ->title = $validated['title'];
        // $article->content = $validated['content'];
        // $article->save();

        // modify
        $article = ArticleModel::create($validated);

        // image upload
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');
            $article->image()->save(
                Image::create([
                    'path' => $path,
                ])
            );
        }

        $request->session()->flash('status', 'The article was created');

        // redirect to created post
        return redirect()->route('articles.show', ['article' => $article->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // abort_if(!isset($this->news[$id]), 404);

        //return view('articles.show', ['article' => $this->news[$id]]);

        // data from DB
        $blogPost =
        Cache::remember("blog-post-{$id}", 60, function () use ($id) {
            return ArticleModel::with('comments')->with('tags')->findOrFail($id);
        });

        return view('articles.show',
            [
                'article' => ArticleModel::with('comments')->with('tags')->findOrFail($id),
            ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = ArticleModel::findOrFail($id);

        //use Gate
        // if (Gate::denies('update-article', $article)) {
        //     abort(403, "You cannot edit this post");
        // }

        // using auth
        $this->authorize($article);

        return view('articles.edit', ['article' => ArticleModel::findOrFail($id)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArticles $request, $id)
    {
        // check if article exists
        $article = ArticleModel::findOrFail($id);
        $validated = $request->validated();

        $article->fill($validated);
        // image upload
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');

            if ($article->image) {
                Storage::delete($article->image->path);
                $article->image->path = $path;
                $article->image->save();
            } else {
                $article->image()->save(
                    Image::create([
                        'path' => $path,
                    ])
                );

            }

        }

        $article->save();

        $request->session()->flash('status', 'The article was Updated');
        return redirect()->route('articles.show', ['article' => $article->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // get data when clicked
        $article = ArticleModel::findOrFail($id);

        //use Gate
        // if (Gate::denies('delete-article', $article)) {
        //     abort(403, "You cannot delete this post");
        // }

        // using auth
        $this->authorize($article);

        // delete data from DB
        $article->delete();

        // show message
        session()->flash('status', 'Article has been deleted');

        // redirect
        return redirect()->route('articles.index');

    }
}
