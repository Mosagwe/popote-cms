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

Route::match(['get','post'],'forgot-password',[App\Http\Controllers\Admin\AdminController::class, 'forgotPassword']);
Route::group(['middleware'=>['admin']],function(){
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/admin/centres', \App\Http\Controllers\Admin\CentresController::class, ['as'=>'admin']);
Route::resource('/admin/services', \App\Http\Controllers\Admin\ServicesController::class, ['as'=>'admin']);
Route::resource('/admin/uploads', \App\Http\Controllers\Admin\UploadsController::class, ['as'=>'admin']);
Route::resource('/admin/mdas', \App\Http\Controllers\Admin\MdasController::class, ['as'=>'admin']);
Route::post('admin/update-service-status',[App\Http\Controllers\Admin\ServicesController::class, 'updateServiceStatus']);
Route::get('admin/create-agency-service/{id}',[App\Http\Controllers\Admin\MdasController::class, 'createAgencyService']);
Route::post('admin/store-agency-service',[App\Http\Controllers\Admin\MdasController::class, 'storeAgencyService']);
Route::get('admin/create-centre-service/{id}',[App\Http\Controllers\Admin\CentresController::class, 'createCentreService']);
Route::post('admin/store-centre-service',[App\Http\Controllers\Admin\CentresController::class, 'storeCentreService']);
Route::post('admin/upload-image',[App\Http\Controllers\Admin\UploadsController::class, 'uploadImage']);
Route::post('admin/upload-video',[App\Http\Controllers\Admin\UploadsController::class, 'uploadVideo']);
});

Route::prefix('/admin')->namespace('Admin')->group(function(){

    Route::get('/registerform',[\App\Http\Controllers\Admin\AdminController::class,'registerFormShow']);
    Route::post('register',[App\Http\Controllers\Admin\AdminController::class, 'registerAdmin']);
    Route::post('login',[App\Http\Controllers\Admin\AdminController::class, 'loginUser']);
    Route::post('confirm-password',[App\Http\Controllers\Admin\AdminController::class, 'confirmPassword']);
    Route::match( ['get','post'],'/',[App\Http\Controllers\Admin\AdminController::class, 'login']);

    Route::group(['middleware'=>['admin']] ,function(){
        Route::get('dashboard',[App\Http\Controllers\Admin\AdminController::class, 'dashboard']);
        Route::get('settings',[App\Http\Controllers\Admin\AdminController::class, 'settings']);
        Route::get('logout',[App\Http\Controllers\Admin\AdminController::class, 'logout']);
        Route::post('check-current-pwd',[App\Http\Controllers\Admin\AdminController::class, 'chkCurrentPassword']);
        Route::post('update-current-pwd',[App\Http\Controllers\Admin\AdminController::class, 'updateCurrentPassword']);
        Route::match(['get','post'],'update-admin-details',[App\Http\Controllers\Admin\AdminController::class, 'updateAdminDetails']);
    });


});

Route::resource('admin/institutions', \App\Http\Controllers\Admin\ScinstitutionController::class);
Route::resource('admin/servicecharter',\App\Http\Controllers\Admin\ServiceCharterController::class);
