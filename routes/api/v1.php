<?php

use Illuminate\Support\Facades\Route;

// API routes (version 1.x)

$name = 'api.v1.';
$path = base_path('routes/api/v1');

Route::name($name)->group($path . '/auth.php');
Route::name($name)->group($path . '/events.php');
Route::name($name)->group($path . '/roles.php');
Route::name($name)->group($path . '/schemes.php');
Route::name($name)->group($path . '/twitter.php');
