<?php

use Illuminate\Support\Facades\Route;

Route::get('events/latest', 'Events\EventResource@showLatest')->name('events.latest');
Route::get('events/active', 'Events\EventResource@active')->name('events.index.active');
Route::apiResource('events', 'Events\EventResource')->only(['index', 'show']);
Route::middleware(['auth:api', 'can:access-to-admin'])->apiResource('events', 'Events\EventResource')->only(['store', 'update', 'destroy']);

Route::apiResource('events/{event}/attendees', 'Events\AttendeeResource')->only(['index', 'show']);
Route::middleware(['auth:api', 'can:access-to-admin'])->apiResource('events/{event}/attendees', 'Events\AttendeeResource')->only(['store', 'update', 'destroy']);
