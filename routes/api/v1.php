<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API routes (version 1.x)

Route::prefix('twitter')->namespace('Twitter')->group(function () {
    Route::apiResource('tweets', 'TweetResource')->only([
        'index',
        'store',
        'destroy'
    ]);
});
