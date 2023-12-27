<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group( function () {
//customers endpoint
Route::get('customers', [CustomerController::class, 'index']);
Route::post('customers', [CustomerController::class, 'create']);
Route::patch('customers/{id}', [CustomerController::class, 'update']);
Route::delete('customers/{id}', [CustomerController::class, 'delete']);
Route::get('customers/{id}', [CustomerController::class, 'show']);

//notes endpoint
Route::get('customers/{customerId}/notes/{noteId}', [NoteController::class, 'show']);
Route::patch('customers/{customerId}/notes/{noteId}', [NoteController::class, 'update']);
Route::delete('customers/{customerId}/notes/{noteId}', [NoteController::class, 'delete']);
Route::post('customers/{customerId}/notes', [NoteController::class, 'create']);
Route::get('customers/{customerId}/notes', [NoteController::class, 'index']);

//project endpoint
Route::get('customers/{customerId}/projects/{projectId}', [ProjectController::class, 'show']);
Route::patch('customers/{customerId}/projects/{projectId}', [ProjectController::class, 'update']);
Route::delete('customers/{customerId}/projects/{projectId}', [ProjectController::class, 'delete']);
Route::post('customers/{customerId}/projects', [ProjectController::class, 'create']);
Route::get('customers/{customerId}/projects', [ProjectController::class, 'index']);

//users endpoint
Route::get('users/{userId}', [UserController::class, 'show']);
Route::patch('users/{userId}', [UserController::class, 'update']);
Route::delete('users/{userId}', [UserController::class, 'delete']);
Route::post('users', [UserController::class, 'create']);
Route::get('users', [UserController::class, 'index']);

});

Route::post('users/add', [UserController::class, 'create']);
