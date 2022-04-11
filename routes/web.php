<?php

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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Sale
Route::get('/sale', [App\Http\Controllers\HomeController::class, 'sale'])->name('sale');
Route::get('/reportdetail', [App\Http\Controllers\HomeController::class, 'reportdetail'])->name('reportdetail');
Route::get('/reportgeneral', [App\Http\Controllers\HomeController::class, 'reportgeneral'])->name('reportgeneral');

// Masters
Route::get('/customer', [App\Http\Controllers\HomeController::class, 'customer'])->name('customer');
Route::get('/employee', [App\Http\Controllers\HomeController::class, 'employee'])->name('employee');
Route::get('/product', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
Route::get('/service', [App\Http\Controllers\HomeController::class, 'service'])->name('service');
Route::get('/stock', [App\Http\Controllers\HomeController::class, 'stock'])->name('stock');

Route::post('/customer/all', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer/all');
Route::post('/customer/store', [App\Http\Controllers\CustomerController::class, 'store'])->name('customer/store');
Route::post('/customer/update', [App\Http\Controllers\CustomerController::class, 'update'])->name('customer/update');

Route::post('/product/all', [App\Http\Controllers\ProductController::class, 'index'])->name('product/all');
Route::post('/product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('product/store');
Route::post('/product/update', [App\Http\Controllers\ProductController::class, 'update'])->name('product/update');

Route::post('/employee/all', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee/all');
Route::post('/employee/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee/store');
Route::post('/employee/update', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employee/update');

Route::post('/sale/all', [App\Http\Controllers\SaleController::class, 'index'])->name('sale/all');
Route::post('/sale/store', [App\Http\Controllers\SaleController::class, 'store'])->name('sale/store');
Route::post('/sale/employee', [App\Http\Controllers\SaleController::class, 'employee'])->name('sale/employee');


Route::get('/events', [App\Http\Controllers\HomeController::class, 'events'])->name('events');
Route::post('/event/all', [App\Http\Controllers\EventController::class, 'index'])->name('event/all');
Route::post('/event/store', [App\Http\Controllers\EventController::class, 'store'])->name('event/store');


Route::get('/events/sendwsp/{msg}', [App\Http\Controllers\EventController::class, 'sendwsp']);
// Route::post('/events/sendwsp', [App\Http\Controllers\EventController::class, 'sendwsp'])->name('/events/sendwsp');

Auth::routes();

