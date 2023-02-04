<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\StoreArticleModelRequest;
use App\Models\ArticleModel;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('Admin.Article.ArticleIndex_View', ['articles' => ArticleModel::all()]);
    }

    public function store(StoreArticleModelRequest $request)
    {
        ArticleModel::create($request->validated());

        return redirect()->back()->with('message', 'Article added successfully!');
    }

    public function show(ArticleModel $article)
    {
        return view('Admin.Article.ArticleEdit_View', ['article' => $article]);
    }

    public function update(StoreArticleModelRequest $request, ArticleModel $article)
    {
        dd($article);

        $article->fill($request->validate())->save();
        
        return redirect()->back()->with('message', 'Article successfully update!');
    }
    
    public function destroy(ArticleModel $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->with('message', 'Article deleted successfully!');
    }
}
