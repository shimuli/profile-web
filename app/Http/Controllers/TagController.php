<?php

namespace App\Http\Controllers;

use App\Models\Tags;

class TagController extends Controller
{
    public function index($tag)
    {
        $tag = Tags::findOrFail($tag);

        return view('articles.index', [
            'articles' => $tag->articles,
            'mostCommented'=>[],
        ]);

    }
}
