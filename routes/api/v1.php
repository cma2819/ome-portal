<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API routes (version 1.x)

Route::name('api.v1.')->middleware('auth:api')->group(function () {

    Route::prefix('auth')->namespace('Auth')->name('auth.')->group(function () {

        Route::get('me', 'AuthenticateUser')->name('me');
    });

    Route::prefix('twitter')->namespace('Twitter')->name('twitter.')->middleware('can:access-to-twitter')->group(function () {

        Route::apiResource('tweets', 'TweetResource')->only(['index', 'store', 'destroy']);
        Route::apiResource('medias', 'MediaResource')->only('store');

    });

    Route::middleware('can:access-to-admin')->apiResource('roles', 'Roles\RoleResource');

});
