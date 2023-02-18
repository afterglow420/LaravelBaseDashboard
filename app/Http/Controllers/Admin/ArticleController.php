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
use App\Models\Logs\LogModel;

class ArticleController extends Controller
{
    public function index()
    {

        return view('Admin.Article.ArticleIndex_View', ['articles' => ArticleModel::all()]);
    }

    public function store(StoreArticleModelRequest $request)
    {
        $article = ArticleModel::create($request->validated());

        $filename = md5($request->file('file')->getClientOriginalName()) . '.' . $request->file('file')->getClientOriginalExtension();

        $media = $article
            ->addMediaFromRequest('file')
            ->usingName($filename)
            ->usingFileName($filename)
            ->toMediaCollection('featuredImages');

        $article->article_photo = $media->getUrl('featuredImages');
        $article->save();

        $media->custom_properties = [
            'link' => $media->getUrl(),
        ];
        $media->save();

        \App\Http\Controllers\Admin\LogController::logManager('store', $article);

        return redirect()->route('articles.index')->with('message', 'Article successfully added!');
    }

    public function show(ArticleModel $article)
    {
        return view('Admin.Article.ArticleEdit_View', ['article' => $article]);
    }

    public function update(UpdateArticleModelRequest $request, ArticleModel $article)
    {
        $article->fill($request->validated())->save();

        \App\Http\Controllers\Admin\LogController::logManager('update', $article);

        return redirect()->route('articles.show', $article)->with('message', 'Article successfully update!');
    }

    public function destroy(ArticleModel $article)
    {
        $article->delete();

        \App\Http\Controllers\Admin\LogController::logManager('destroy', $article);

        return redirect()->route('articles.index')->with('message', 'Article deleted successfully!');
    }

    public function uploadFromTinyMCE(UploadArticleModelImageRequest $request)
    {
        $article = ArticleModel::findOrFail($request->id_article);

        $filename = md5($request->file('file')->getClientOriginalName()) . '.' . $request->file('file')->getClientOriginalExtension();
        $media = $article
            ->addMediaFromRequest('file')
            ->usingName($filename)
            ->usingFileName($filename)
            ->toMediaCollection('articleImages');

        $media->custom_properties = [
            'link' => $media->getUrl(),
        ];
        $media->save();

        \App\Http\Controllers\Admin\LogController::logManager('uploadFromTinyMCE', $media);

        return response()->json([
            'location' => $media->getUrl()
        ])->setEncodingOptions(JSON_UNESCAPED_SLASHES);
    }

    public function uploadFeatured(UploadFeatureArticleModelRequest $request)
    {
        $article = ArticleModel::findOrFail($request->id_article);
        $media = $article
            ->addMediaFromRequest('file')
            ->toMediaCollection('featuredImages');

        $article->article_photo = $media->getUrl('featuredImages');
        $article->save();

        $media->custom_properties = [
            'link' => $media->getUrl(),
        ];
        $media->save();

        \App\Http\Controllers\Admin\LogController::logManager('uploadFeatured', $media);

        return redirect()->route('articles.show', $article)->with('message', 'Article featured photo successfully updated!');
    }

    public function deleteFeaturedPhoto(ArticleModel $article)
    {
        $article->article_photo = '';
        $article->save();
        
        Media::where('model_id', $article->id_article)->where('collection_name', 'featuredImages')->delete();

        \App\Http\Controllers\Admin\LogController::logManager('deleteFeaturedPhoto', $article);

        return redirect()->route('articles.show', $article)->with('message', 'Article featured photo successfully deleted!');
    }
}
