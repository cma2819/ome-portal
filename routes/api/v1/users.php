<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'can:access-to-admin'])->apiResource('users', 'Users\\UserResource')->only(['index']);
