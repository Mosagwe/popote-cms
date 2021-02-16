<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentresController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/admin/centres', \App\Http\Controllers\Admin\CentresController::class, ['as'=>'admin']);

Route::prefix('/admin')->namespace('Admin')->group(function(){

    Route::match( ['get','post'],'/',[App\Http\Controllers\Admin\AdminController::class, 'login']);
    //Route::resource('centres', \App\Http\Controllers\Admin\CentresController::class);
    Route::group(['middleware'=>['admin']] ,function(){
        Route::get('dashboard',[App\Http\Controllers\Admin\AdminController::class, 'dashboard']);
        Route::get('settings',[App\Http\Controllers\Admin\AdminController::class, 'settings']);
        Route::get('logout',[App\Http\Controllers\Admin\AdminController::class, 'logout']);
        Route::post('check-current-pwd',[App\Http\Controllers\Admin\AdminController::class, 'chkCurrentPassword']);
        Route::post('update-current-pwd',[App\Http\Controllers\Admin\AdminController::class, 'updateCurrentPassword']);
        Route::match(['get','post'],'update-admin-details',[App\Http\Controllers\Admin\AdminController::class, 'updateAdminDetails']);

        //services
         Route::get('services',[App\Http\Controllers\Admin\ServicesController1::class, 'services']);

    });
});
