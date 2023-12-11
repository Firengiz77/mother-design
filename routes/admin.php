<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SliderController;


Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    // admin routes

   // language routes
    Route::resource('/language',LanguageController::class);
    Route::post('language/update/{id}',[LanguageController::class,'update'])->name('language.update');
    Route::get('language/destroy/{id}',[LanguageController::class,'destroy'])->name('language.destroy');



    //role routes
    Route::resource('roles', RolesController::class);
    Route::post('roles/update/{id}', [RolesController::class,'update'])->name('roles.update');
    Route::get('roles/destroy/{id}',[RolesController::class,'destroy'])->name('roles.destroy');

    // permission routes
    Route::resource('permissions', PermissionsController::class);
    Route::post('permissions/update/{id}', [PermissionsController::class,'update'])->name('permissions.update');
    Route::get('permissions/destroy/{id}',[PermissionsController::class,'destroy'])->name('permissions.destroy');

    // about routes
    Route::post('about/update/{id}', [AboutController::class,'update'])->name('about.update');
    Route::get('about/edit/{id}',[AboutController::class,'edit'])->name('about.edit');


      // social media links  routes
      Route::resource('socialLink', SocialLinkController::class);
      Route::post('socialLink/update/{id}', [SocialLinkController::class,'update'])->name('socialLink.update');
      Route::get('socialLink/destroy/{id}',[SocialLinkController::class,'destroy'])->name('socialLink.destroy');
  
        // contact routes
    Route::post('contact/update/{id}', [ContactController::class,'update'])->name('contact.update');
    Route::get('contact/edit/{id}',[ContactController::class,'edit'])->name('contact.edit');

  
     // slider routes
     Route::resource('slider', SliderController::class);
     Route::post('slider/update/{id}', [SliderController::class,'update'])->name('slider.update');
     Route::get('slider/status/{id}',[SliderController::class,'status'])->name('slider.status');
 
     
});
