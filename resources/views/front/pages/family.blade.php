@extends('front.layout.master')


@section('container') 

<div class="family-container page-top">
      <div class="inner-container">


      @foreach($family as $item)
        <div class="family-member">
          <div class="family-member-link">
            <img src="{{ asset($item->image) }}" />
            <div class="family-member-caption">
              <span class="family-member-name">{{ $item->name }}</span>
              <span class="family-member-role">{{ $item->profession }}</span>
            </div>
          </div>

          <div class="family-member-description">
            <div class="family-member-description-container">
              <div class="close-family-member menu-open">
                <div class="menu-line-1 menu-line"></div>
                <div class="menu-line-3 menu-line"></div>
              </div>
              <div class="family-member-image">
                <img src="{{ asset($item->image) }}" />
              </div>
              <div class="family-member-text">
                <div>
               {!!   $item->desc !!}
                </div>
                @if($item->link !== null)
                <a href="{{ $item->link }}" target="_blank">{{ __('Instagram') }}</a>
                @endif
              </div>
            </div>
           
            
          </div>
        </div>

        @endforeach

      </div>
    </div>



@endsection

