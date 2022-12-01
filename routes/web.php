<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function(){
    Route::resources([
        'book'=> BookController::class,
        'category'=> CategoryController::class
    ]);

    Route::get('/image/{name}',[BookController::class, 'display']) ->name('images');
    Route::get('category/{id}/books',[BookController::class, 'categoryBooks'])->name('categoryBooks');
    Route::post('posts/search',[BookController::class, 'findPost'])->name('find.post');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
