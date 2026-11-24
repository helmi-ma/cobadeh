<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Models\User;
use App\Models\Media;
use Illuminate\Http\JsonResponse;

class UserCollectionController extends Controller
{
    // Menampilkan koleksi media milik user
    public function index(User $user)
    {
        $media = $user->media;

        return MediaResource::collection($media);
    }

    // Menambahkan media ke koleksi user
    public function store(User $user, Media $media): JsonResponse
    {
        if ($user->media()->where('media_id', $media->id)->exists()) {
            return response()->json([
                'message' => 'Media sudah ada di koleksi'
            ], 409);
        }

        $user->media()->attach($media->id);

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi'
        ], 201);
    }

    // Menghapus media dari koleksi user
    public function destroy(User $user, Media $media): JsonResponse
    {
        $deleted = $user->media()->detach($media->id);

        if (!$deleted) {
            return response()->json([
                'message' => 'Media tidak ditemukan dalam koleksi'
            ], 404);
        }

        return response()->json([
            'message' => 'Media berhasil dihapus dari koleksi'
        ], 200);
    }
}
