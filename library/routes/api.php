<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('users', [UserController::class, 'index']);
Route::get('user/{id}', [UserController::class, 'show']);
Route::post('user', [UserController::class, 'store']);
Route::put('user/{id}', [UserController::class, 'update']);
Route::delete('user/{id}', [UserController::class, 'destroy']);

Route::get('books', [BookController::class, 'index']);
Route::get('book/{id}', [BookController::class, 'show']);
Route::post('book', [BookController::class, 'store']);
Route::put('book/{id}', [BookController::class, 'update']);
Route::delete('book/{id}', [BookController::class, 'destroy']);

Route::get('authors', [AuthorController::class, 'index']);
Route::get('author/{id}', [AuthorController::class, 'show']);
Route::post('author', [AuthorController::class, 'store']);
Route::put('author/{id}', [AuthorController::class, 'update']);
Route::delete('author/{id}', [AuthorController::class, 'destroy']);