<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->apiResource('schemes', 'Schemes\SchemeResource')->only(['index', 'show', 'store', 'update']);
