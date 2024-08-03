<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post("register",[AuthController::class,"Register"]);
Route::post("login",[AuthController::class,"Login"]);
Route::get("products",[ProductController::class,"Product"]);
Route::group(["prefix"=>"Cart","middleware"=>"JwTAuth"],function(){
Route::post("/Add",[CartController::class,"store"]);
Route::get("/All User Cart",[CartController::class,"index"]);
Route::post("/delete",[CartController::class,"destroy"]);
Route::post("/Update",[CartController::class,"update"]);
Route::get("checkout",[OrderController::class,"Checkout"]);

});




