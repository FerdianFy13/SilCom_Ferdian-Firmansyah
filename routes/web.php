<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DataCategoryController;
use App\Http\Controllers\Backend\DataCourseController;
use App\Http\Controllers\Backend\DataUserManagementController;

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

Route::get('/', [HomeController::class, 'index']);

// backend
Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // data course
    Route::resource('data-course', DataCourseController::class);
    Route::post('/data-course/{category}/update-status', [DataCourseController::class, 'updateStatus']);

    // data category
    Route::resource('/data-category', DataCategoryController::class)->except('destroy');

    // data user management
    Route::resource('/data-user', DataUserManagementController::class)->only('index');
    Route::post('/data-user/{user}/toggle-status', [DataUserManagementController::class, 'toggleStatus']);
    Route::post('/data-user/{user}/reset-password', [DataUserManagementController::class, 'updatePassword']);
});

require __DIR__ . '/auth.php';
