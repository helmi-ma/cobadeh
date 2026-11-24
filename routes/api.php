<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\UserCollectionController;

Route::apiResource('media', MediaController::class);

// User Collection
Route::get('/users/{user}/collection', [UserCollectionController::class, 'index']);

Route::post('/users/{user}/collection/{media}', [UserCollectionController::class, 'store']);

Route::delete('/users/{user}/collection/{media}', [UserCollectionController::class, 'destroy']);
