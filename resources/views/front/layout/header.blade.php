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
    <title>Agilli Nagillar</title>
  </head>

  <body>
    <header>
      <nav>
        <ul class="header-menu">
       
          <li class="{{ Route::is('index')  ? 'active' : '' }}">
            <a href="{{ route('index')  }}">Work</a>
          </li>
          <li class="{{ Route::is('about')  ? 'active' : '' }}">
            <a href="{{ route('about') }}">About</a>
          </li>
          <li class="{{ Route::is('family')  ? 'active' : '' }}">
            <a href="{{ route('family') }}">Family</a>
          </li>
          <li class="{{ Route::is('contact')  ? 'active' : '' }}">
            <a href="{{ route('contact') }}">Contact</a>
          </li>
        </ul>
      </nav>
      <div class="header-introduction">
        <h1>
          <a href="{{  route('index') }}" class="logo"><img src="{{ asset($setting->logo_1) }}"/> <span>Ağıllı Nağıllar</span></a>
        </h1>
        <div class="introduction-container">

          @foreach($words as $word)
          <span class="introduction-long descripton">{{ $word->title }}</span>
          @endforeach
          
        </div>
      </div>
      <span class="menu-icon">
        <div class="menu-line-1 menu-line"></div>
        <div class="menu-line-2 menu-line"></div>
        <div class="menu-line-3 menu-line"></div>
      </span>
    </header>
