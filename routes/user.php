<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;


Route::prefix('admin')->name('admin.')->group(function () {
    // admin user routes

    Route::get('/register',[AuthController::class,'registerIndex'])->middleware('admin')->name('register');
    Route::get('/account',[AdminController::class,'account'])->middleware('admin')->name('account');
    Route::get('/all',[AdminController::class,'all_admin'])->middleware('admin')->name('all');
    Route::get('/all/edit/{id}',[AdminController::class,'edit'])->name('adminEdit');
    Route::post('/all/update/{id}',[AdminController::class,'update'])->name('adminUpdate');
    Route::get('/all/destroy/{id}',[AdminController::class,'destroy'])->name('adminDestroy');
    Route::get('/index',[AdminController::class,'index'])->middleware('admin')->name('index');
    Route::get('/all-users',[AdminController::class,'all_users'])->middleware('admin')->name('all.users');
    Route::get('/login',function(){ return view('admin.user.action.login');})->name('login');


    Route::post('/admin-register',[AuthController::class,'register'])->middleware('admin')->name('admin.register');
    Route::post('/admin-login',[AuthController::class,'login'])->name('admin-login');
    Route::get('/admin-logout',[AuthController::class,'logout'])->name('logout');
    Route::post('/admin-image',[AuthController::class,'update_image'])->name('update_image');
    Route::post('/admin-update',[AuthController::class,'admin_update'])->name('update');
    Route::get('/admin-delete/{id}',[AuthController::class,'admin_delete'])->name('delete');
    Route::post('/admin-password',[AuthController::class,'admin_password'])->name('admin_password');
});


    // user user routes
Route::get('/login',function(){ return view('user.login');})->name('user.login');
Route::post('/user-login',[UserController::class,'login'])->name('login');
Route::get('/register',function(){ return view('user.register');})->name('user.register');
Route::post('/user-register',[UserController::class,'register'])->name('register');
Route::get('/forgot-password',function(){ return view('user.forgot_password');})->name('user.forgot-password');
Route::post('user/forgot-password',[UserController::class,'forgot_password'])->name('forgot-password');

Route::get('/account',[UserController::class,'account'])->middleware('user')->name('account');
Route::get('orders',[UserController::class,'user_orders'])->middleware('user')->name('user.order');
Route::get('change-password',[UserController::class,'change_password'])->middleware('user')->name('user.change-password');
Route::get('address',[UserController::class,'address'])->middleware('user')->name('user.address');
Route::post('/user-detail',[UserController::class,'user_update'])->middleware('user')->name('update-detail');
Route::post('/user-address',[UserController::class,'user_address'])->middleware('user')->name('update-address');
Route::post('/user-password',[UserController::class,'user_password'])->name('user_password');

Route::get('password/reset', [UserController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [UserController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}',[UserController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset',[UserController::class,'reset'])->name('password.update');



Route::prefix('user')->name('user.')->group(function () {
    Route::get('/user-logout',[UserController::class,'logout'])->name('logout');
    Route::post('/user-image',[UserController::class,'update_image'])->name('update_image');
    Route::get('/user-delete/{id}',[UserController::class,'admin_delete'])->name('delete');
});







