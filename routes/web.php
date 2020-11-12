<?php

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


use App\Http\Controllers as Cont;


Route::post("/upload/images",[Cont\ImageUploadController::class,"upload"]);

Route::get('/', [Cont\HomeController::class,"show"]);

Route::get("/posts",[Cont\PostController::class,"index"]);
Route::get("/posts/{id}",[Cont\PostController::class,"show"]);

Route::get("/register",[Cont\RegisterController::class,"show"]);
Route::post("/register",[Cont\RegisterController::class,"submit"]);

Route::get("/login",[Cont\LoginController::class,"show"]);
Route::post("/login",[Cont\LoginController::class,"submit"]);

use App\Http\Middleware\AuthUser;
use App\Http\Middleware\UserPost;

Route::prefix("/account")->middleware(AuthUser::class)->group(function() {
  Route::get("/",[Cont\AccountController::class,"show"]);

  Route::get("/add_post",[Cont\UserPostController::class,"add"]);
  Route::post("/add_post",[Cont\UserPostController::class,"submit"]);

  Route::middleware(UserPost::class)->group(function() {
    Route::get("/post/{id}", [Cont\UserPostController::class,"show"]);
    Route::get("/post/{id}/edit", [Cont\UserPostController::class,"edit"]);
    Route::post("/post/{id}/edit", [Cont\UserPostController::class,"edit_submit"]);
    Route::post("/post/{id}/delete", [Cont\UserPostController::class,"delete"]);
  });

});
