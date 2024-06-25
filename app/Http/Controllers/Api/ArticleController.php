<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){
        $article = Article::wherePublishment('published')->with('media')->latest()->paginate(20);
        return $article;
    }

    public function show($slug){
        $article = Article::whereSlug($slug)->with('media')->firstOrFail();

        return $article;
    }
}
