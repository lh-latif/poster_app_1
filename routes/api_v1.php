<?php

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




use App\Http\Controllers\V1;

Route::get("/posts", [V1\PostController::class,"index"]);
Route::get("/posts/{id}", [V1\PostController::class,"show"]);


Route::post("/token", [V1\TokenController::class,"login"]);

use App\Http\Middleware\V1\AuthToken;
use App\Http\Middleware\V1\UserPost;

Route::middleware(AuthToken::class)->group(function() {
  Route::get("/user", [V1\TokenController::class,"user"]);
  Route::get("/user/post", [V1\UserPostController::class,"index"]);
  Route::post("/user/post", [V1\UserPostController::class,"add"]);

  Route::middleware(UserPost::class)->group(function() {
    Route::get("/user/post/{id}", [V1\UserPostController::class,"get"]);
    Route::patch("/user/post/{id}", [V1\UserPostController::class,"edit"]);
    Route::delete("/user/post/{id}", [V1\UserPostController::class,"delete"]);
  });
});


//
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
