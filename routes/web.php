<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/tasks');

Route::prefix('tasks')->name('tasks.')->group(function () {
    Route::get('/', function () {
        return response()->json([
            'message' => 'Task Manager task index placeholder.',
        ]);
    })->name('index');

    Route::get('/create', function () {
        return response()->json([
            'message' => 'Task Manager task creation placeholder.',
        ]);
    })->name('create');
});
