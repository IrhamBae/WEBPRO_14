<?php

use App\Http\Controllers\MovieController;

// Display all movies
Route::get('/', [MovieController::class, 'index'])->name('movies.index');

// Store a new movie
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');

// Edit a movie by ID
Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');

// Update a movie by ID
Route::put('/movies/{id}', [MovieController::class, 'update'])->name('movies.update');

// Delete a movie by ID
Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('movies.destroy');
