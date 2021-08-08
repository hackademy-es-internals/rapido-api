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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [UserController::class,'register'])->name('register');
Route::post('login', [UserController::class,'authenticate'])->name('login');

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::post('user',[UserController::class,'getAuthenticatedUser']);

    Route::post("announcements",[AnnouncementController::class,'store'])->name('announcements.store');
    Route::put("announcements/{announcements}",[AnnouncementController::class,'update'])->name('announcements.update');
    Route::delete("announcements/{announcements}",[AnnouncementController::class,'destroy'])->name('announcements.destroy');

});

// Route::resource('announcements',AnnouncementController::class);

Route::get("announcements",[AnnouncementController::class,'index'])->name('announcements.index');
Route::get("announcements/{announcements}",[AnnouncementController::class,'show'])->name('announcements.show');

Route::resource('categories',CategoryController::class);
Route::resource('users',UserController::class);

Route::get('/category/{category}/announcements/',[AnnouncementController::class,'byCategory'])->name('announcements.byCategory');