<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserFollowersController;
use App\Http\Controllers\PersonPostController;
use App\Http\Controllers\PagePostController;

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

/*User Authentication route*/
Route::post('/auth/register',[AuthController::class,'register']);
Route::post('/auth/login' , [AuthController::class,'doLogin']);

/*Page create route*/
Route::post('/page/create' ,[PageController::class,'create'])->middleware(['auth:sanctum']);
Route::post('/follow/person/{personId}' ,[UserFollowersController::class,'create'])->middleware(['auth:sanctum']);
Route::post('/person/attach-post' ,[PersonPostController::class,'create'])->middleware(['auth:sanctum']);
Route::post('/page/attach-post/{pageId}',[PagePostController::class,'create'])->middleware(['auth:sanctum']);

