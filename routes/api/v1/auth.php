<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->namespace('Auth')->name('auth.')->group(function () {

    Route::middleware('auth:api')->get('me', 'AuthenticateUser')->name('me');
});
