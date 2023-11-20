<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\CommentController;
use App\Http\Controllers\API\V1\PortfolioController;
use App\Http\Controllers\API\V1\RatingController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\WishlistController;
use Illuminate\Support\Facades\Route;

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


Route::controller(
    AuthController::class,
    function () {
        Route::post("login", "login");
        Route::post("register", "register");
    }
);

Route::middleware("auth:sanctum")->group(
    function () {
        Route::apiResource("user", UserController::class);
        Route::apiResource("category", CategoryController::class);
        Route::apiResource("portfolio", PortfolioController::class);
        Route::apiResource("comment", CommentController::class);
        Route::apiResource("wishlist", WishlistController::class);
        Route::apiResource("rating", RatingController::class);
    }
);