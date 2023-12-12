@extends('front.layout.master')

@section('container') 


<div class="page-container page-top">
      <div class="contact-row">
        <div class="contact-text-column">
          <h2>{{ $contact->title }}</h2>

          <p class="contact-subtitle contact-address">{{ $contact->address }}</p>
          <a href="tel:{{ str_replace(' ','',$contact->phone) }}" class="contact-link">{{ $contact->phone }}</a>

          <div class="contact-info">
            <p class="contact-subtitle">New business enquiries:</p>
            <a href="mailto:{{ $contact->email_1}}" class="contact-link">{{ $contact->email_1}}</a>
            <a href="mailto:{{$contact->email_2}}" class="contact-link">ilham@agillinagillar.com</a>
          </div>
          
          <div class="contact-info">
            <p class="contact-subtitle">Talent business enquiries:</p>
            <a href="mailto:{{$contact->email_3}}" class="contact-link"> {{$contact->email_3}}</a>
            <a href="mailto:{{$contact->email_4}}" class="contact-link">gunay@agillinagillar.com</a>
          </div>
        </div>

        <div class="contact-map">
          <a href="{{ $contact->map }}" class="contact-map-column" target="_blank">
            <img src="{{ $contact->image }}"/>
          </a>
        </div>
      </div>
    </div>



@endsection

