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

Route::get('/', 'Pages\Top')->name('index');

Route::get('/auth/discord', 'AuthenticateController@discordAuth')->name('auth.discord');

Route::get('/schedules', 'Pages\Schedule')->name('schedules.index');
Route::get('/schedules/{id?}', 'Pages\Schedule')->name('schedules.show')->where('id', '.*');

Route::get('/streams/internal/{id}', 'Pages\StreamInternal')->name('streams.internal');

Route::middleware('auth')->group(function () {

    Route::get('/twitter', 'Pages\Twitter')->name('twitter')->middleware('can:access-to-twitter');
    Route::get('/admin', 'Pages\Admin')->name('admin')->middleware('can:access-to-admin');
    Route::get('/logout', 'AuthenticateController@logout')->name('auth.logout');

});
