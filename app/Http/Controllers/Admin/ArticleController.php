<?php

namespace App\Http\Controllers\Admin;

use App\Models\ArticleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Http\Requests\Article\StoreArticleModelRequest;
use App\Http\Requests\Article\UpdateArticleModelRequest;
use App\Http\Requests\Article\UploadArticleModelImageRequest;
use App\Http\Requests\Article\UploadFeatureArticleModelRequest;

class ArticleController extends Controller
{
    public function index()
    {

        return view('Admin.Article.ArticleIndex_View', ['articles' => ArticleModel::all()]);
    }

    public function store(StoreArticleModelRequest $request)
    {
        $article = ArticleModel::create($request->validated());

        if($request->hasFile('file')){

            $filename = md5($request->file('file')->getClientOriginalName()) . '.' . $request->file('file')->getClientOriginalExtension();
            $image = $article
                ->addMediaFromRequest('file')
                ->usingName($filename)
                ->usingFileName($filename)
                ->toMediaCollection('preview');

            $article->article_photo = $image->getUrl('preview');
            // dd($image->getUrl('preview'));
            $article->save();}

        return redirect()->back()->with('message', $image->getUrl('preview'));
    }

    public function show(ArticleModel $article)
    {
        return view('Admin.Article.ArticleEdit_View', ['article' => $article]);
    }

    public function update(UpdateArticleModelRequest $request, ArticleModel $article)
    {
        $article->fill($request->validated())->save();

        return redirect()->back()->with('message', 'Article successfully update!');
    }

    public function destroy(ArticleModel $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->with('message', 'Article deleted successfully!');
    }

    public function upload(UploadArticleModelImageRequest $request)
    {
        $article = ArticleModel::findOrFail($request->id_article);

        $filename = md5($request->file('file')->getClientOriginalName()) . '.' . $request->file('file')->getClientOriginalExtension();
        $image = $article
            ->addMediaFromRequest('file')
            ->usingName($filename)
            ->usingFileName($filename)
            ->toMediaCollection('articleImages');

        return response()->json([
            'location' => $image->getUrl()
        ])->setEncodingOptions(JSON_UNESCAPED_SLASHES);
    }

    public function uploadFeatured(UploadFeatureArticleModelRequest $request)
    {
        $article = ArticleModel::findOrFail($request->id_article);
        $image = $article
                    ->addMediaFromRequest('file')
                    ->toMediaCollection('preview');
        
        $article->article_photo = $image->getUrl('preview');
        $article->save();

        return redirect()->back()->with('message', 'Article featured photo successfully updated!');
    }
}
