<?php

namespace App\Http\Controllers\Admin;

use App\Models\MediaModel;
use Illuminate\Http\Request;
use App\Models\Logs\LogModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Media\StoreMediaModelRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        return view('Admin.Media.MediaIndex_View', ['medias' => Media::all()]);
    }

    public function store(StoreMediaModelRequest $request, MediaModel $mediaModel)
    {
        $mediaModel = MediaModel::create($request->validated());

        if ($request->hasFile('file')) {

            $filename = md5($request->file('file')->getClientOriginalName()) . '.' . $request->file('file')->getClientOriginalExtension();

            $media = $mediaModel
                ->addMediaFromRequest('file')
                ->usingName($filename)
                ->usingFileName($filename)
                ->toMediaCollection('mediaImages');

            $media->custom_properties = [
                'link' => $media->getUrl(),
            ];
            $media->save();
        }

        \App\Http\Controllers\Admin\LogController::logManager('store', $mediaModel);

        return redirect()->route('medias.index')->with('message', 'Media successfully added!');
    }

    public function destroy(Media $media)
    {
        $media->delete();

        \App\Http\Controllers\Admin\LogController::logManager('delete', $media);

        return redirect()->route('medias.index')->with('message', 'Media successfully deleted!');
    }
}
