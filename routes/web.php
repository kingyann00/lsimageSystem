<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|s
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//interface
Route::get('/', function () {
    return view('pages.login');
});

Route::get('/dashboard',[ClientController::class,'index'])->name('client.list');

Route::get('/client/create', function () {
    return view('pages.client_create');
})->name('client.create');



Route::get('{client?}/invoice_create',[InvoiceController::class,'create'])->name('invoice.create');


Route::get('/client',[ClientController::class,'index'])->name('client.list');
Route::get('/invoice',[InvoiceController::class,'index'])->name('invoice.list');
Route::get('{company_name?}/invoice',[InvoiceController::class,'show'])->name('invoice.client');


//post method
Route::post('/client/store',[ClientController::class,'store'])->name('client.store');
Route::post('/admin/login',[UserController::class,'login'])->name('admin.login');
Route::post('{invoice?}/store',[InvoiceController::class,'store'])->name('invoice.store');

// Route::get('/invoice', function () {
//     return view('pages.include.invoicePDF');
// });
Route::get('/download-invoice/{id?}',[InvoiceController::class,'downloadPDF'])->name('invoice.pdf');

// ajax

Route::get('/findPICPhone',[ClientController::class,'findPICPhone']);
