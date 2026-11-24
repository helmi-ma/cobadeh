<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;

class MediaController extends Controller
{
    // Menampilkan semua media
    public function index()
    {
        $media = Media::all();

        return MediaResource::collection($media);
    }

    // Menambahkan media
    public function store(StoreMediaRequest $request)
    {
    $media = Media::create($request->validated());

    return (new MediaResource($media))
        ->response()
        ->setStatusCode(201);
    }

    // Menampilkan detail media
    public function show(string $id)
    {
        $media = Media::findOrFail($id);

        return new MediaResource($media);
    }

    // Memperbarui media
    public function update(UpdateMediaRequest $request, string $id)
    {
    $media = Media::findOrFail($id);

    $media->update($request->validated());

    return new MediaResource($media);
    }

    // Menghapus media
    public function destroy(string $id)
    {
        $media = Media::findOrFail($id);

        $media->delete();

        return response()->json([
            'message' => 'Media berhasil dihapus'
        ], 200);
    }
}
