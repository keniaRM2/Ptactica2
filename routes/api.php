<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('book')->group(function() {
    Route::get('index', [BookController::class, 'index']);
    Route::post('store', [BookController::class, 'store']);
    Route::put('update/{id}', [BookController::class, 'update']);
    Route::get('show/{id}', [BookController::class, 'show']);
    Route::delete('delete/{id}', [BookController::class, 'destroy']);
    Route::get('download/{id}', [BookController::class, 'download']);

});

Route::prefix('author')->group(function() {
    Route::get('index', [AuthorController::class, 'index']);
    Route::post('store', [AuthorController::class, 'store']);
    Route::put('update/{id}', [AuthorController::class, 'update']);
    Route::get('show/{id}', [AuthorController::class, 'show']);
    Route::delete('delete/{id}', [AuthorController::class, 'destroy']);
});



//Authentication is not required for these endpoints
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//Authentication is required for these endpoints (apply middleware auth:sanctum)
Route::group(['middleware' => ["auth:sanctum"]], function () {
    Route::get('userProfile', [AuthController::class, 'userProfile']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::put('changePassword', [AuthController::class, 'changePassword']);
    Route::post('addBookReview', [BookController::class, 'addBookReview']);
    Route::put('updateBookReview/{id}', [BookController::class, 'updateBookReview']);
});