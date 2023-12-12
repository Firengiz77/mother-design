<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Language;
use App\Models\Contact;
use App\Models\SocialLink;
use App\Models\SiteSetting;
use App\Models\Word;

class AppServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        //
    }

   
    public function boot()
    {
        $all_languages = Language::get();
        $social = SocialLink::get();
        $contact = Contact::first();
        $setting = SiteSetting::first();
        $words = Word::get();

        view()->share([
            'all_languages' => $all_languages,
            'social' => $social,
            'contact' => $contact,
            'setting' => $setting,
            'words' => $words
        ]);
    }
}
