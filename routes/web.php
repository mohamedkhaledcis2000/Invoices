<?php

//use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers;

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
    return view('auth.login');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth','admin'])->name('dashboard');

//routes for Admins
Route::middleware(['auth','admin'])->group(function(){
    Route::resource('/dashboard',AdminController::class);
});

//routes for users
Route::middleware(['auth'])->group(function(){

//    Route::resource('/admin/dashboard',Controllers\AdminController::class);
});



//route for invoices controller
Route::resource('invoices',InvoicesController::class);

////route for Registration controller
//Route::resource('register',RegisteredUserController::class);

//route for ajax request for products
Route::get('/section/{id}', 'InvoicesController@getProducts');

//route for sections controller
Route::resource('sections',SectionsController::class);

//route for products controller
Route::resource('products',ProductsController::class);



require __DIR__.'/auth.php';
