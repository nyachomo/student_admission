<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
    return view('welcome');
});

Route::get('/helloworld',function(){
    return view('helloworld');
});

Route::get('/hostels',[App\Http\Controllers\HostelController::class,'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//USERS MANAGEMENT
Route::get('/adminShowUsers',[App\Http\Controllers\UserController::class,'adminShowUsers'])->name('adminShowUsers');
Route::post('/adminAddUsers',[App\Http\Controllers\UserController::class,'adminAddUsers'])->name('adminAddUsers');
Route::post('/adminUpdateUsers',[App\Http\Controllers\UserController::class,'adminUpdateUsers'])->name('adminUpdateUsers');
Route::post('/adminDeleteUsers',[App\Http\Controllers\UserController::class,'adminDeleteUsers'])->name('adminDeleteUsers');
Route::get('/adminExportUsersAsExcel',[App\Http\Controllers\UserController::class,'adminExportUsersAsExcel'])->name('adminExportUsersAsExcel');
Route::get('/adminExportUsersAsPdf',[App\Http\Controllers\UserController::class,'adminExportUsersAsPdf'])->name('adminExportUsersAsPdf');
Route::post('/adminImportUsersData',[App\Http\Controllers\UserController::class,'adminImportUsersData'])->name('adminImportUsersData');
