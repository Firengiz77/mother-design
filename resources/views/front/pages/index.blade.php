@extends('front.layout.master')



@section('container')

<div class="filter-container">
      <div class="view-options">
        <span class="current-view" data-view="grid">Grid</span>
        <span data-view="list">List</span>
      </div>
    </div>

    @if($slider)
    <div class="banner">
        @if($slider->type == 2)
        <video id="video" loop="" playsinline="" autoplay="" muted="" controls="controls">
        <source src="{{ asset($slider->file) }}" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;">
         </video>
      @else
      <img src="{{ asset($slider->file) }}"/>
      @endif
    </div>
    @endif

    <div class="project-cards-group grid page-top">

    @foreach ($works as $work)
      
      <div class="project-link-container">
        <div class="project-card">
          <a href="{{ route('work',$work->id) }}" class="project-card-link"></a>
          <div class="project-card-img">
            @if($work->type == 1)
            <img src="{{ $work->file }}" />
            @else
       
            <video autoplay muted loop>
              <source src="{{ asset($work->file)}}" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;"/>
            </video>
            @endif
          </div>
          <div class="project-card-caption">
            <p class="project-card-title">{{ $work->name }}</p>
            <p class="project-card-subtitle">
              {{ $work->title }}
            </p>
          </div>
        </div>
      </div>

     
    @endforeach



    </div>



@endsection