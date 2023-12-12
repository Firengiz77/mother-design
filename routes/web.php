<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\MainController;

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale');


Route::get('about-us',[MainController::class,'aboutUs'])->name('about');
Route::get('contact',[MainController::class,'contact'])->name('contact');
Route::get('/',[MainController::class,'index'])->name('index');
Route::get('/family',[MainController::class,'family'])->name('family');


Route::get('/search/{q?}', [MainController::class, 'search'])->name('search');