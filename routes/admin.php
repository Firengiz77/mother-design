<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\InnovationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\MessageController;


Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    // admin routes

   // language routes
    Route::resource('/language',LanguageController::class);
    Route::post('language/update/{id}',[LanguageController::class,'update'])->name('language.update');
    Route::get('language/destroy/{id}',[LanguageController::class,'destroy'])->name('language.destroy');


   // blogs routes
    Route::resource('/blogs',BlogsController::class);
    Route::post('blogs/update/{id}',[BlogsController::class,'update'])->name('blogs.update');
    Route::get('blogs/destroy/{id}',[BlogsController::class,'destroy'])->name('blogs.destroy');

   //tags routes
    Route::resource('/tags',TagController::class);
    Route::post('tags/update/{id}',[TagController::class,'update'])->name('tags.update');
    Route::get('tags/destroy/{id}',[TagController::class,'destroy'])->name('tags.destroy');

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

      // site setting routes
      Route::post('site-setting/update/{id}', [SiteSettingController::class,'update'])->name('setting.update');
      Route::get('site-setting/edit/{id}',[SiteSettingController::class,'edit'])->name('setting.edit');

       // banner routes
    Route::resource('banner', BannerController::class);
    Route::post('banner/update/{id}', [BannerController::class,'update'])->name('banner.update');
    Route::get('banner/destroy/{id}',[BannerController::class,'destroy'])->name('banner.destroy');

    // innovation routes
    Route::resource('innovation', InnovationController::class);
    Route::post('innovation/update/{id}', [InnovationController::class,'update'])->name('innovation.update');
    Route::get('innovation/destroy/{id}',[InnovationController::class,'destroy'])->name('innovation.destroy');

    // category routes
    Route::resource('category', CategoryController::class);
    Route::post('category/update/{id}', [CategoryController::class,'update'])->name('category.update');
    Route::get('category/destroy/{id}',[CategoryController::class,'destroy'])->name('category.destroy');

    
    // category type routes
    // Route::resource('type/{category_id}', TypeController::class);
    Route::get('type/{category_id}', [TypeController::class,'index'])->name('type.index');
    Route::post('type/update/{category_id}/{id}', [TypeController::class,'update'])->name('type.update');
    Route::get('type/edit/{category_id}/{id}',[TypeController::class,'edit'])->name('type.edit');
    Route::get('type/destroy/{id}',[TypeController::class,'destroy'])->name('type.destroy');
    Route::get('type/create/{category_id}',[TypeController::class,'create'])->name('type.create');
    Route::post('type/store/{category_id}',[TypeController::class,'store'])->name('type.store');

     // slider routes
     Route::resource('slider', SliderController::class);
     Route::post('slider/update/{id}', [SliderController::class,'update'])->name('slider.update');
     Route::get('slider/destroy/{id}',[SliderController::class,'destroy'])->name('slider.destroy');
 
     
     // services routes
     Route::resource('service', ServiceController::class);
     Route::post('service/update/{id}', [ServiceController::class,'update'])->name('service.update');
     Route::get('service/destroy/{id}',[ServiceController::class,'destroy'])->name('service.destroy');
 
   // attribute routes
   Route::resource('attribute', AttributeController::class);
   Route::post('attribute/update/{id}', [AttributeController::class,'update'])->name('attribute.update');
   Route::get('attribute/destroy/{id}',[AttributeController::class,'destroy'])->name('attribute.destroy');


            
   // option routes
   Route::get('options/index/{attribute_id}', [OptionController::class,'index'])->name('option.index');
   Route::get('options/edit/{attribute_id}/{id}', [OptionController::class,'edit'])->name('option.edit');
   Route::post('options/update/{attribute_id}/{id}', [OptionController::class,'update'])->name('option.update');
   Route::get('options/create/{attribute_id}', [OptionController::class,'create'])->name('option.create');
   Route::post('options/store/{attribute_id}', [OptionController::class,'store'])->name('option.store');
   Route::get('option/destroy/{attribute_id}/{id}',[OptionController::class,'destroy'])->name('option.destroy');




       // product routes
       Route::resource('product', ProductController::class);
       Route::post('product/update/{id}', [ProductController::class,'update'])->name('product.update');
       Route::get('product/destroy/{id}',[ProductController::class,'destroy'])->name('product.destroy');
       Route::post('/products/delete_images/{id}',[ProductController::class,'delete_images_photos'])->name('delete_images_gallery');
       Route::get('product/attribute/{id}',[ProductController::class,'productAttribute'])->name('product.attribute.create');
       Route::post('product/attribute/store',[ProductController::class,'attributeStore'])->name('product.attribute.store');
     



       // Orders routes

       Route::get('orders', [OrderController::class,'index'])->name('order.index');
       Route::get('orders/information/{id}', [OrderController::class,'information'])->name('order.information');
       Route::get('orders/export', [OrderController::class,'export'])->name('order.export');
       Route::get('orders/delivery/{id}', [OrderController::class,'delivery'])->name('order.delivery');

         // Message routes
         Route::resource('messages', MessageController::class);
      

});
