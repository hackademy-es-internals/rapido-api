<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AnnouncementController;

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

// Protected Routes

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::get("users",[UserController::class,'index'])->name('users.index');
    Route::get("users/{user}",[UserController::class,'show'])->name('users.show');
    Route::post("users",[UserController::class,'getAuthenticatedUser']);
    Route::put("users/{user}",[UserController::class,'update'])->name('users.update');
    Route::delete("users/{user}",[UserController::class,'destroy'])->name('users.destroy');

    Route::post("announcements",[AnnouncementController::class,'store'])->name('announcements.store');
    Route::put("announcements/{announcements}",[AnnouncementController::class,'update'])->name('announcements.update');
    Route::delete("announcements/{announcements}",[AnnouncementController::class,'destroy'])->name('announcements.destroy');

    Route::post("categories",[CategoryController::class,'store'])->name('categories.store');
    Route::put("categories/{category}",[CategoryController::class,'update'])->name('categories.update');
    Route::delete("categories/{category}",[CategoryController::class,'destroy'])->name('categories.destroy');
    
});

// Public Routes
Route::post('register', [UserController::class,'register'])->name('register');
Route::post('login', [UserController::class,'authenticate'])->name('login');

Route::get("announcements",[AnnouncementController::class,'index'])->name('announcements.index');
Route::get("announcements/{announcements}",[AnnouncementController::class,'show'])->name('announcements.show');

Route::get("categories",[CategoryController::class,'index'])->name('categories.index');
Route::get("categories/{category}",[CategoryController::class,'show'])->name('categories.show');

Route::get("categories/{category}/announcements/",[AnnouncementController::class,'byCategory'])->name('announcements.byCategory');