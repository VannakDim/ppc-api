<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;


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
    return view('web.home');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
});

//None protected route
Route::post('/register', [WebAuthController::class, 'register'])->name('register');
Route::post('/login', [WebAuthController::class, 'login'])->name('login');
Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');


//Protected route
Route::middleware(['auth:sanctum'])->group(function () {
    // Dashboard
    Route::get('/balance', [WebController::class, 'balance'])->name('balance');

});

//Protected route [ADMIN]
Route::middleware(['auth:sanctum','is_admin'])->group(function () {
    // Dashboard
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('dashboardRoute');
    Route::get('/income-dashboard', [AdminController::class, 'income'])->name('addIncome');
    Route::get('/expense-dashboard', [AdminController::class, 'expense'])->name('addExpense');

    // Balance
    Route::post('/income', [IncomeController::class, 'store'])->name('storeIncome');
    Route::post('/expense', [ExpenseController::class, 'store'])->name('storeExpense');

    Route::get('/income', [AdminController::class, 'detailIncome'])->name('detailIncome');
    
    Route::get('/expense', [AdminController::class, 'detailExpense'])->name('detailExpense');

});
