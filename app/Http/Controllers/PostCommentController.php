<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\ArticleModel;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(ArticleModel $article, StoreComment $request)
    {
        $article->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id,
        ]);

        $request->session()->flash('status', 'Comment was created');

       // redirect to created post
        return redirect()->back();

    }
}
