<?php

use App\Http\Controllers\roleController;
use App\Http\Controllers\userManagementController;
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

Route::get('/', function () {
    return view('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    // User Management
    // ---------------------------------------------------------------------------------------------------------------------------------------
    Route::get('/userManagement', [userManagementController::class, 'index'])->name('userManagement.index')->middleware('can:view-userManagement');
    Route::get('/userManagement/create', [userManagementController::class, 'create'])->name('userManagement.create')->middleware('can:create-userManagement');
    Route::get('/userManagement/{id}/edit', [userManagementController::class, 'edit'])->name('userManagement.edit')->middleware('can:edit-userManagement');
    Route::delete('/userManagement/{id}', [userManagementController::class, 'destroy'])->name('userManagement.destroy')->middleware('can:delete-userManagement');
    Route::post('/userManagement', [userManagementController::class, 'store'])->name('userManagement.store')->middleware('can:create-userManagement');
    Route::put('/userManagement/{id}', [userManagementController::class, 'update'])->name('userManagement.update')->middleware('can:edit-userManagement');
    // ---------------------------------------------------------------------------------------------------------------------------------------

    // Role
    // ---------------------------------------------------------------------------------------------------------------------------------------
    Route::get('/role', [roleController::class, 'index'])->name('role.index')->middleware('can:view-role');
    Route::get('/role/create', [roleController::class, 'create'])->name('role.create')->middleware('can:create-role');
    Route::get('/role/{id}/edit', [roleController::class, 'edit'])->name('role.edit')->middleware('can:edit-role');
    Route::get('/role/{id}', [roleController::class, 'show'])->name('role.show')->middleware('can:show-role');
    Route::delete('/role/{id}', [roleController::class, 'destroy'])->name('role.destroy')->middleware('can:delete-role');
    Route::post('/role', [roleController::class, 'store'])->name('role.store')->middleware('can:create-role');
    Route::put('/role/{id}', [roleController::class, 'update'])->name('role.update')->middleware('can:edit-role');
    // ---------------------------------------------------------------------------------------------------------------------------------------
});