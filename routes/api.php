<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\MovieController;
use App\Http\Controllers\API\V1\CommentController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group( function () {
        Route::post('movies', [MovieController::class, 'createMovie']);
        Route::put('movies', [MovieController::class, 'updateMovie']);
        Route::delete('movies', [MovieController::class, 'deleteMovie']);
    });

    Route::get('movies', [MovieController::class, 'getMoviesList']);
    Route::get('movies/{id}', [MovieController::class, 'getMovieDetail']);
    Route::post('comment', [CommentController::class, 'createComment']);

});
