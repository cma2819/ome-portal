<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->prefix('auth')->namespace('Auth')->name('auth.')->group(function () {

    Route::get('me', 'AuthenticateUser')->name('me');
    Route::put('me', 'UpdateAuthenticateUser')->name('me.update');
});
