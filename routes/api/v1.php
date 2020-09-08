<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API routes (version 1.x)

Route::name('api.v1.')->group(function () {

    Route::prefix('auth')->namespace('Auth')->name('auth.')->group(function () {

        Route::middleware('auth:api')->get('me', 'AuthenticateUser')->name('me');
    });

    Route::prefix('twitter')->namespace('Twitter')->name('twitter.')->group(function () {

        Route::middleware(['auth:api', 'can:access-to-twitter'])->group(function () {

            Route::apiResource('tweets', 'TweetResource')->only(['index', 'store', 'destroy']);
            Route::apiResource('medias', 'MediaResource')->only('store');

        });
    });

    Route::middleware(['auth:api', 'can:access-to-admin'])->apiResource('roles', 'Roles\RoleResource');

    Route::get('events/latest', 'Events\EventResource@showLatest')->name('events.latest');
    Route::apiResource('events', 'Events\EventResource')->only(['index', 'show']);
    Route::middleware(['auth:api', 'can:access-to-admin'])->apiResource('events', 'Events\EventResource')->only(['store', 'update', 'destroy']);

});
