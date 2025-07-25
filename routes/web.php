<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\LaporanController;

use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;

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
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'userLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'userRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home/report-data', [HomeController::class, 'getReportData'])->name('home.reportData');
    Route::get('/download-excel', [HomeController::class, 'downloadExcel'])->name('home.downloadExcel');
    
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/data', [CategoryController::class, 'getData'])->name('categories.data');
    Route::delete('/categories/{id}', [CategoryController::class, 'delete'])->name('categories.destroy');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    
    Route::get('/coa', [CoaController::class, 'index'])->name('coa.index');
    Route::get('/coa/data', [CoaController::class, 'getData'])->name('coa.data');
    Route::delete('/coa/{id}', [CoaController::class, 'delete'])->name('coa.destroy');
    Route::get('/coa/create', [CoaController::class, 'create'])->name('coa.create');
    Route::post('/coa', [CoaController::class, 'store'])->name('coa.store');
    Route::get('/coa/{id}/edit', [CoaController::class, 'edit'])->name('coa.edit');
    Route::put('/coa/{id}', [CoaController::class, 'update'])->name('coa.update');  

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/data', [TransactionController::class, 'getData'])->name('transactions.data');
    Route::delete('/transactions/{id}', [TransactionController::class, 'delete'])->name('transactions.destroy');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');

});


