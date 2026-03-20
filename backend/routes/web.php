<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'S6 B1 Question & Answer API',
        'status' => 'Online',
        'frontend_url' => 'http://localhost:5173'
    ]);
});
