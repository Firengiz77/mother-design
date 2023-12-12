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
        @if($slider->video)
        <video id="video" loop="" playsinline="" autoplay="" muted="" controls="controls">
        <source src="{{ asset($slider->image) }}" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;">
         </video>
      @else
      <img src="{{ asset($slider->image) }}"/>
      @endif
    </div>
    @endif

    <div class="project-cards-group grid page-top">
      <div class="project-link-container">
        <div class="project-card">
          <a href="#" class="project-card-link"></a>
          <div class="project-card-img">
            <img src="assets/images/image-1.gif" />
          </div>
          <div class="project-card-caption">
            <p class="project-card-title">Brooklyn Org</p>
            <p class="project-card-subtitle">
              Redefining the look and feel of modern philanthropy
            </p>
          </div>
        </div>
      </div>

      <div class="project-link-container">
        <div class="project-card">
          <a href class="project-card-link"></a>
          <div class="project-card-img">
            <img src="assets/images/image-2.gif" />
          </div>
          <div class="project-card-caption">
            <p class="project-card-title">Brooklyn Org</p>
            <p class="project-card-subtitle">
              Redefining the look and feel of modern philanthropy
            </p>
          </div>
        </div>
      </div>

      <div class="project-link-container">
        <div class="project-card">
          <a href class="project-card-link"></a>
          <div class="project-card-img">
            <video autoplay muted loop>
              <source src="assets/images/video-1.mp4" type="video/mp4" />
            </video>
          </div>
          <div class="project-card-caption">
            <p class="project-card-title">Brooklyn Org</p>
            <p class="project-card-subtitle">
              Redefining the look and feel of modern philanthropy
            </p>
          </div>
        </div>
      </div>

      <div class="project-link-container">
        <div class="project-card">
          <a href class="project-card-link"></a>
          <div class="project-card-img">
            <video autoplay muted loop>
              <source src="assets/images/video-2.mp4" type="video/mp4" />
            </video>
          </div>
          <div class="project-card-caption">
            <p class="project-card-title">Brooklyn Org</p>
            <p class="project-card-subtitle">
              Redefining the look and feel of modern philanthropy
            </p>
          </div>
        </div>
      </div>

      <div class="project-link-container">
        <div class="project-card">
          <a href class="project-card-link"></a>
          <div class="project-card-img">
            <img src="assets/images/image-2.gif" />
          </div>
          <div class="project-card-caption">
            <p class="project-card-title">Brooklyn Org</p>
            <p class="project-card-subtitle">
              Redefining the look and feel of modern philanthropy
            </p>
          </div>
        </div>
      </div>

      <div class="project-link-container">
        <div class="project-card">
          <a href class="project-card-link"></a>
          <div class="project-card-img">
            <img src="assets/images/image-1.gif" />
          </div>
          <div class="project-card-caption">
            <p class="project-card-title">Brooklyn Org</p>
            <p class="project-card-subtitle">
              Redefining the look and feel of modern philanthropy
            </p>
          </div>
        </div>
      </div>

      <div class="project-link-container">
        <div class="project-card">
          <a href class="project-card-link"></a>
          <div class="project-card-img">
            <img src="assets/images/image-2.gif" />
          </div>
          <div class="project-card-caption">
            <p class="project-card-title">Brooklyn Org</p>
            <p class="project-card-subtitle">
              Redefining the look and feel of modern philanthropy
            </p>
          </div>
        </div>
      </div>

      <div class="project-link-container">
        <div class="project-card">
          <a href class="project-card-link"></a>
          <div class="project-card-img">
            <video autoplay muted loop>
              <source src="assets/images/video-1.mp4" type="video/mp4" />
            </video>
          </div>
          <div class="project-card-caption">
            <p class="project-card-title">Brooklyn Org</p>
            <p class="project-card-subtitle">
              Redefining the look and feel of modern philanthropy
            </p>
          </div>
        </div>
      </div>

      <div class="project-link-container">
        <div class="project-card">
          <a href class="project-card-link"></a>
          <div class="project-card-img">
            <video autoplay muted loop>
              <source src="assets/images/video-2.mp4" type="video/mp4" />
            </video>
          </div>
          <div class="project-card-caption">
            <p class="project-card-title">Brooklyn Org</p>
            <p class="project-card-subtitle">
              Redefining the look and feel of modern philanthropy
            </p>
          </div>
        </div>
      </div>

      <div class="project-link-container">
        <div class="project-card">
          <a href class="project-card-link"></a>
          <div class="project-card-img">
            <img src="assets/images/image-2.gif" />
          </div>
          <div class="project-card-caption">
            <p class="project-card-title">Brooklyn Org</p>
            <p class="project-card-subtitle">
              Redefining the look and feel of modern philanthropy
            </p>
          </div>
        </div>
      </div>
    </div>



@endsection