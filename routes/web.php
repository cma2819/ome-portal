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

Route::get('/twitter', 'Pages\Twitter')->name('twitter');

Route::get('/auth/discord', 'AuthenticateController@discordAuth')->name('auth.discord');
