<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewContoller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('book.index');
});


Route::resource('book', BookController::class)->only(['index', 'show']);

Route::resource('book.reviews', ReviewContoller::class)->scoped(['review' => 'book'])->only(['create', 'store']);