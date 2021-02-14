<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/auth/discord', 'AuthenticateController@discordAuth')->name('auth.discord');

Route::middleware('view')->group(function () {

    Route::get('/', 'Pages\Top')->name('index');
    Route::get('/login', 'Pages\Login')->name('auth.login');

    Route::get('/events', 'Pages\Event')->name('events.index');
    Route::get('/events/{id}/schedules', 'Pages\Event')->name('events.schedules.index')->where('id', '.*');
    Route::get('/events/{id}/submissions', 'Pages\Event')->name('events.submissions.index')->where('id', '.*');

    Route::get('/schemes', 'Pages\Scheme')->name('scheme');
    Route::get('/schemes/{any}', 'Pages\Scheme')->name('scheme.any')->where('any', '.*');

    Route::middleware('auth')->group(function () {

        Route::get('/twitter', 'Pages\Twitter')->name('twitter')->middleware('can:access-to-twitter');
        Route::get('/streams/internal/{id}', 'Pages\StreamInternal')->name('streams.internal')->middleware('can:access-to-internal-stream');
        Route::get('/admin', 'Pages\Admin')->name('admin')->middleware('can:access-to-admin');
        Route::get('/logout', 'AuthenticateController@logout')->name('auth.logout');

    });

});
