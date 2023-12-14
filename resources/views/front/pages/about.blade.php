@extends('front.layout.master')


@section('container') 

<div class="page-container page-top">
      <div class="locations-gallery">
        <div class="locations-gallery-inner">

       @foreach($about as $key => $item)
          <div class="locations-image {{ $key == 0 ? 'current-slide' : '' }}">
            <img src="{{ asset($item->image) }}"/>
            <p class="locations-image-title">{!! $item->title !!}</p>
          </div>
       @endforeach

        </div>

        <span class="gallery-prev"></span>
        <span class="gallery-arrow gallery-arrow-prev"></span>
        <span class="gallery-next"></span>
        <span class="gallery-arrow gallery-arrow-next"></span>
      </div>

      <ul class="about-menu-list">
        <li>
            <a href="{{ route('family') }}" target=""> {{__('Who we are')}} </a>
        </li>
        <li>
            <a href="{{ route('index') }}" target=""> {{ __('What we do') }} </a>
        </li>
      </ul>
    </div>

@endsection

