<?php

use App\Http\Controllers\EmployeeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload', [EmployeeController::class, 'uploadForm'])->name('employees.uploadForm');
Route::post('/upload', [EmployeeController::class, 'upload'])->name('employees.upload');
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
