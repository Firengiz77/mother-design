<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\MainController;

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale');



Route::get('tes',[MainController::class,'blog'])->name('blog');
Route::get('blog',[MainController::class,'blog'])->name('blog');
Route::get('blog/{slug}',[MainController::class,'blogSingle'])->name('blogSingle');
Route::get('about-us',[MainController::class,'aboutUs'])->name('about');
Route::get('contact',[MainController::class,'contact'])->name('contact');
Route::get('/',[MainController::class,'index'])->name('index');
Route::get('product/{category_id}/{id}',[MainController::class,'productSingle'])->name('productSingle');
Route::get('category/{category_id}',[MainController::class,'category'])->name('category');
Route::get('cart',[MainController::class,'cart'])->name('cart');
Route::get('/all-product',[MainController::class,'allProducts'])->name('allProducts');
Route::post('/sendMessage',[MainController::class,'sendMessage'])->name('sendMessage');


Route::get('/search/{q?}', [MainController::class, 'search'])->name('search');
