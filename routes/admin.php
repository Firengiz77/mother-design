<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\WordController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Admin\WorkAttributeController;


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
    Route::resource('about', AboutController::class);
    Route::post('about/update/{id}', [AboutController::class,'update'])->name('about.update');
    Route::get('about/destroy/{id}',[AboutController::class,'destroy'])->name('about.destroy');

      // social media links  routes
      Route::resource('socialLink', SocialLinkController::class);
      Route::post('socialLink/update/{id}', [SocialLinkController::class,'update'])->name('socialLink.update');
      Route::get('socialLink/destroy/{id}',[SocialLinkController::class,'destroy'])->name('socialLink.destroy');
      Route::get('socialLink/status/{id}',[SocialLinkController::class,'status'])->name('socialLink.status');


        // contact routes
    Route::post('contact/update/{id}', [ContactController::class,'update'])->name('contact.update');
    Route::get('contact/edit/{id}',[ContactController::class,'edit'])->name('contact.edit');

      // site setting routes
      Route::post('site-setting/update/{id}', [SiteSettingController::class,'update'])->name('setting.update');
      Route::get('site-setting/edit/{id}',[SiteSettingController::class,'edit'])->name('setting.edit');

  
     // slider routes
     Route::resource('slider', SliderController::class);
     Route::post('slider/update/{id}', [SliderController::class,'update'])->name('slider.update');
     Route::get('slider/status/{id}',[SliderController::class,'status'])->name('slider.status');
 

         // Family routes
         Route::resource('family', FamilyController::class);
         Route::post('family/update/{id}', [FamilyController::class,'update'])->name('family.update');
         Route::get('family/destroy/{id}',[FamilyController::class,'destroy'])->name('family.destroy');
    
     
            // word routes
    Route::resource('word', WordController::class);
    Route::post('word/update/{id}', [WordController::class,'update'])->name('word.update');
    Route::get('word/destroy/{id}',[WordController::class,'destroy'])->name('word.destroy');

       // work routes
       Route::resource('work', WorkController::class);
       Route::post('work/update/{id}', [WorkController::class,'update'])->name('work.update');
       Route::get('work/destroy/{id}',[WorkController::class,'destroy'])->name('work.destroy');
   
       // work attribute
       Route::get('work/attribute/{work_id}', [WorkAttributeController::class,'index'])->name('workAttribute.index');
       Route::get('work/attribute/create/{work_id}', [WorkAttributeController::class,'create'])->name('workAttribute.create');
       Route::post('work/attribute/store/{work_id}', [WorkAttributeController::class,'store'])->name('workAttribute.store');
       Route::get('work/attribute/edit/{work_id}/{id}', [WorkAttributeController::class,'edit'])->name('workAttribute.edit');
       Route::post('work/attribute/update/{id}', [WorkAttributeController::class,'update'])->name('workAttribute.update');
       Route::get('work/attribute/destroy/{work_id}/{id}',[WorkAttributeController::class,'destroy'])->name('workAttribute.destroy');
   


});
