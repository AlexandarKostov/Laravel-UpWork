<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::redirect('/', 'login');
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/application/check', [\App\Http\Controllers\DashboardController::class, 'checkApplication'])->name('dashboard.application.check');
//    Route::get('/getFilteredData/{academyId}', [\App\Http\Controllers\DashboardController::class, 'getFilteredData']);
//    Route::get('/projects', [\App\Http\Controllers\DashboardController::class, 'getPaginatedProjects'])->name('dashboard.paginated');
    Route::resource('profile', ProfileController::class);
    Route::resource('project', \App\Http\Controllers\ProjectController::class);
    Route::resource('application', \App\Http\Controllers\ApplicationController::class);
});


require __DIR__ . '/auth.php';
