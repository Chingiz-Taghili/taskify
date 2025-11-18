<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskAttachmentController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// -------------------- PUBLIC API --------------------
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


// -------------------- PROTECTED API --------------------
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::apiResource('users', UserController::class)->only('update');
    Route::apiResource('tasks', TaskController::class)->only('show');
    Route::apiResource('tasks.attachments', TaskAttachmentController::class)
        ->only(['index', 'show']);
    Route::put('tasks/{task}/status', [TaskController::class, 'changeStatus']);

    // -------------------- admin|superadmin only --------------------
    Route::middleware('role:admin|superadmin')->group(function () {
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('clients', ClientController::class);
        Route::apiResource('projects', ProjectController::class);
        Route::put('projects/{project}/status', [ProjectController::class, 'changeStatus']);
        Route::apiResource('tasks', TaskController::class)->except('show');
        Route::post('tasks/{task}/assign', [TaskController::class, 'assign']);
        Route::delete('tasks/{task}/unassign', [TaskController::class, 'unassign']);
        Route::apiResource('tasks.attachments', TaskAttachmentController::class)
            ->except(['index', 'show']);
    });

    // -------------------- superadmin only --------------------
    Route::middleware('role:superadmin')->group(function () {
        Route::apiResource('users', UserController::class)->except('update');
        Route::post('users/{user}/assign-role/{role}', [UserController::class, 'assignRole']);
        Route::delete('users/{user}/remove-role/{role}', [UserController::class, 'removeRole']);
    });
});
