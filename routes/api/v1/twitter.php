<?php

use Illuminate\Support\Facades\Route;

Route::prefix('twitter')->namespace('Twitter')->name('twitter.')->group(function () {

    Route::middleware(['auth:api', 'can:access-to-twitter'])->group(function () {

        Route::apiResource('tweets', 'TweetResource')->only(['index', 'store', 'destroy']);
        Route::apiResource('medias', 'MediaResource')->only('store');

    });
});
