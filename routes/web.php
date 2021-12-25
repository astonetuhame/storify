<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoriesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

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

Auth::routes();

// Route::get('/', [LoginController::class, 'showLoginForm']);

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/stories/{activeStory:slug}', [DashboardController::class, 'show'])->name('dashboard.show');

Route::middleware(['auth'])->group(function () {
    Route::resource('stories', StoriesController::class);
    // ->name('stories.index');
    // Route::get('/stories/{story}', 'StoriesController@show')->name('stories.show');
});
