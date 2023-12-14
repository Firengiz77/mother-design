<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('/front/assets/css/main.css')}}" />
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('/front/assets/images/favicon/favicon-32x32.png')}}" />
    <title>{{ __('Clever Tales') }}</title>
  </head>

  <body>
    <header>
      <nav>
        <ul class="header-menu">
       
          <li class="{{ Route::is('index')  ? 'active' : '' }}">
            <a href="{{ route('index')  }}">{{__('Work')}}</a>
          </li>
          <li class="{{ Route::is('about')  ? 'active' : '' }}">
            <a href="{{ route('about') }}">{{__('About')}}</a>
          </li>
          <li class="{{ Route::is('family')  ? 'active' : '' }}">
            <a href="{{ route('family') }}">{{__('Family')}}</a>
          </li>
          <li class="{{ Route::is('contact')  ? 'active' : '' }}">
            <a href="{{ route('contact') }}">{{__('Contact')}}</a>
          </li>
        </ul>
      </nav>
      <div class="header-introduction">
        <h1>
          <a href="{{  route('index') }}" class="logo"><img src="{{ asset($setting->logo_1) }}"/> <span>{{ __('Clever Tales') }}</span></a>
        </h1>
        <div class="introduction-short">
          <span class="introduction-long"
            >{{ $work->title }} </span
          >
          <a href="" class="read-more">({{ __('Read more') }})</a>
        </div>
        <div class="project-description">
          <div class="project-description-container">
           
           {!! $work->desc !!}
          </div>
        </div>
    
      </div>
      <span class="menu-icon">
        <div class="menu-line-1 menu-line"></div>
        <div class="menu-line-2 menu-line"></div>
        <div class="menu-line-3 menu-line"></div>
      </span>
    </header>
