@extends('front.layout.workMaster',[$work->id])

@section('container')



<div class="single-project-container page-top">


        @foreach($work->getWorkAttributes as $attribute)
  
      <div class="project-row">
      @if($attribute->type_3 == 0)
      
        @if($attribute->type_1 != 0)
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



          @if($attribute->type_2 != 0)
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


          @else

        <div class="project-column">
          <div class="project-image-container">
            <img src="{{ asset($attribute->file_1) }}" />
          </div>
          <div class="project-image-container">
            <img src="{{ asset($attribute->file_2) }}" />
          </div>
        </div>
        <div class="project-image-container">
          @if($attribute->type_3 == 1)
          <img src="{{ asset($attribute->file_3) }}" />
          @else
          <video autoplay muted loop>
            <source src="{{ asset($attribute->file_3) }}" type="video/mp4" />
          </video>
          @endif
        

        </div>
        @endif



      </div>
      @endforeach

    
      @php
      $workPrev = ($work->id > 1) ? $work->id - 1 : $work->id;
      $workNext = $work->id + 1;
      
      @endphp
  
      <div class="single-project-pagination">
   
        <p style="padding: 10px">
        @if(App\Models\Work::where('id',$workPrev)->first())
          «
          <a href="{{ route('work',$workPrev) }}" rel="prev">Previous Project</a>
          @endif
          @if(App\Models\Work::where('id',$workNext)->first())
          <a
            href="{{ route('work',$workNext) }}" rel="next">Next Project</a>
          »
          @endif
        </p>
      </div>


    </div>
@endsection