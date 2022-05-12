<?php

use App\Http\Controllers\CoursesUsersController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Navigation;


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

Auth::routes([
    'login' => true,
    'logout' => true,
    'reset' => true,
    'index' => true,
    'register' => false,
    'confirm' => true,
    'verify' => false,
]);



Route::resource('students', StudentController::class);
Route::resource('notes', NotesController::class);
Route::resource('evidence', EvidenceController::class);
Route::resource('users', UserController::class);
Route::get('/studio1', [DashboardController::class, 'studio1']);
Route::get('/studio2', [DashboardController::class, 'studio2']);
Route::get('/studio3', [DashboardController::class, 'studio3']);
Route::get('/studio4', [DashboardController::class, 'studio4']);
Route::get('/studio5', [DashboardController::class, 'studio5']);
Route::get('/studio6', [DashboardController::class, 'studio6']);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('unauthorised', [App\Http\Controllers\UnauthController::class, 'index'])->name('unauthorised');
