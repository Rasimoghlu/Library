<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookHouse\BookHouseController;
use App\Http\Controllers\Api\Author\AuthorController;
use App\Http\Controllers\Api\Book\BookController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'create']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::group([''], function() {
        Route::resource('book', BookController::class)->except(['edit', 'create']);
    });

    Route::group(['prefix' => 'author-books', 'as' => 'author-books.'], function() {
        Route::controller(AuthorController::class)->group(function () {
            Route::get('{author}','index');
        });
    });

    Route::group(['prefix' => 'book-house', 'as' => 'book-house.'], function() {
        Route::controller(BookHouseController::class)->group(function () {
            Route::post('create','store');
            Route::get('{bookHouse}', 'index');

        });

    });

});
