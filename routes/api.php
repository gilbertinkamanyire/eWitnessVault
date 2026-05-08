<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvidenceController;
use App\Http\Controllers\UserController;

// ------------------------
// Public API Routes
// ------------------------

// User Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// ------------------------
// Protected API Routes
// ------------------------
Route::middleware('auth:sanctum')->group(function () {

    // User Profile
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Evidence - Using web controller methods
    // Note: These routes use the same controller methods as web routes
    // Route::post('/evidence/upload', [EvidenceController::class, 'store']);
    // Route::get('/evidence', [EvidenceController::class, 'index']);
    // Route::get('/evidence/{id}', [EvidenceController::class, 'show']);

    // Users (Admin Only)
    Route::middleware('can:isAdmin')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::get('/users/{id}', [UserController::class, 'show']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    });
});
// Legacy evidence upload endpoint (if needed for API compatibility)
// Route::post('/evidence/upload', function (Request $request) {
//     if ($request->hasFile('evidenceFile')) {
//         $path = $request->file('evidenceFile')->store('evidence');
//         return response()->json(['success' => true, 'path' => $path]);
//     } else {
//         return response()->json(['success' => false, 'message' => 'No file uploaded']);
//     }
// });
