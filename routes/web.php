<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\CourseController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DataCourseController;
use App\Http\Controllers\Backend\DataCategoryController;
use App\Http\Controllers\Backend\DataUserManagementController;
use App\Http\Controllers\Front\OrderPaymentController;

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

// home
Route::get('/', [HomeController::class, 'index']);

// courses
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::post('/courses', [CourseController::class, 'store'])->name('courses.create');

// contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

// order payment
Route::group(['middleware' => ['auth', 'role:Customer']], function () {
    Route::get('/order-payment', [OrderPaymentController::class, 'index']);
    Route::post('/order-payment/destroy/{id}', [OrderPaymentController::class, 'destroy'])->name('order-payment.destroy');
});

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
