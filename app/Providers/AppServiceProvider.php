<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Language;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $all_languages = Language::get();
        view()->share([
            'all_languages' => $all_languages
        ]);
    }
}
