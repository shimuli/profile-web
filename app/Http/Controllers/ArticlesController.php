<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticles;
use App\Models\ArticleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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

        return view('articles.index',
            ['articles' => ArticleModel::withCount('comments')->get()]);

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

        // call Model
        $article = new ArticleModel();

        // post data
        // $article ->title = $validated['title'];
        // $article->content = $validated['content'];
        // $article->save();

        // modify
        $article = ArticleModel::create($validated);

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
        return view('articles.show', ['article' => ArticleModel::with('comments')->findOrFail($id)]);

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
        $this->authorize('delete-article', $article);


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
        $this->authorize('delete-article', $article);


        // delete data from DB
        $article->delete();

        // show message
        session()->flash('status', 'Article has been deleted');

        // redirect
        return redirect()->route('articles.index');

    }
}
