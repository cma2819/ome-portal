<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->apiResource('schemes', 'Schemes\SchemeResource')->only(['index', 'show', 'store', 'update']);

Route::middleware(['auth:api', 'can:access-to-admin'])->name('schemes.status.update')->put('/schemes/{id}/status', 'Schemes\UpdateSchemeStatus');
