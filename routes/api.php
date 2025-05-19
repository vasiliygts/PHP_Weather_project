<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubscriptionController;

Route::post('/subscribe', [SubscriptionController::class, 'subscribe']);
Route::get('/confirm/{token}', [SubscriptionController::class, 'confirm']);
Route::get('/unsubscribe/{token}', [SubscriptionController::class, 'unsubscribe']);

