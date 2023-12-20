<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NoteController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
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


