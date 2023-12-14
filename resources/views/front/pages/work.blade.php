@extends('front.layout.workMaster',[$work->id])

@section('container')



<div class="single-project-container page-top">


        @foreach($work->getWorkAttributes as $attribute)
      <div class="project-row">

        @if($attribute->type_1 !== null)
        @if($attribute->type_1 == 1)
        <div class="project-image-container">
        <img src="{{ asset($attribute->file_1) }}" />
        </div>
        @else
        <div class="project-image-container">
        <video autoplay muted loop>
              <source src="{{ asset($attribute->file_1) }}" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;"/>
            </video>
            </div>
          @endif
          @endif

          @if($attribute->type_2 !== null)
      @if($attribute->type_2 == 1)
      <div class="project-image-container">
        <img src="{{ asset($attribute->file_2) }}" />
        </div>
        @else
        <div class="project-image-container">
        <video autoplay muted loop>
              <source src="{{ asset($attribute->file_2) }}" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;"/>
            </video>
            </div>
          @endif
          @endif


          @if($attribute->type_3 !== null)
          @if($attribute->type_3 == 1)
          <div class="project-image-container">
        <img src="{{ asset($attribute->file_3) }}" />
        </div>
        @else
        <div class="project-image-container">
        <video autoplay muted loop id="video" playsinline="" controls="controls" >
              <source src="{{ asset($attribute->file_3) }}" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;"/>
            </video>
            </div>

          @endif
          @endif

      </div>
      @endforeach




      <div class="single-project-pagination">
        <p style="padding: 10px">
          «
          <a href="https://www.motherdesign.com/work/amica/" rel="prev">Previous Project</a>
          <a
            href="https://www.motherdesign.com/work/brooklyn-org/" rel="next">Next Project</a>
          »
        </p>
      </div>
    </div>
@endsection