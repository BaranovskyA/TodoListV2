<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/todos');

Route::middleware('auth')
    ->group(function () {
        Route::resource('todos', 'TodoController');
        Route::get('/todos/{todo}/toggle', 'TodoController@toggle')
            ->name('todos.toggle');
    });

