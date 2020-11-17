<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'can:access-to-admin'])->apiResource('roles', 'Roles\RoleResource');
