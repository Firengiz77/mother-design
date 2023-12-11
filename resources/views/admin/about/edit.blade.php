@extends('admin.layout.master')

@section('container')
<link rel="stylesheet" href="{{ asset('/admin/assets/css/choise.css')}}">


          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
          

            <div class="container-xxl flex-grow-1 container-p-y">
                <div style=" display: flex;align-items: baseline;flex-direction: column;">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> {{ __('About') }} </h4>

              <ul class="d-flex justify-content-end">
                                    @foreach ($all_languages as $a_language)
                                        <li style="margin-right: 10px">
                                            <a class="btn btn-{{ app()->getLocale() == $a_language->code ? 'danger' : 'primary' }} btn-large"
                                                href="{{ route('locale', $a_language->code) }}">
                                                {{ $a_language->code }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                </div>
          

              <!-- Examples -->
              <div class="row mb-5">
                <div class="col-md-4 col-lg-2 mb-3 card-body" style="border:1px solid #a1acb8;border-radius:8px">
                    @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif

                  @if($errors->any())
                  @foreach($errors->all() as $error)
                  <div class="alert alert-danger" role="alert" > {{$error}} </div>
                  @endforeach
                  @endif


                    <form enctype="multipart/form-data" id="formAccountSettings" method="POST" action="{{ route('admin.about.update',$about->id) }}">
                        @csrf


                  <div class="col-md-12">
                        <div class="mb-3">
                          <label>{{ __('thumbnail') }}:</label>
                          <input type="file" class="form-control" name="images[]" multiple="multiple">
                          @error('images')
                          <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                        <div style="display:flex;flex-wrap: wrap;">
                          @if($about !== null)
                          @foreach ($about->images as $key => $images)
                          <div class="col-md-4" style="flex-basis: 25%;margin-top:20px" >
                                    <div class="image-box">
                                        <img src="{{ asset('uploads/about/' . $images) }}" width="150px" height="150px" style=" box-shadow: -1px 1px 2px;" alt="">
                                       <div id="newform24" class='a_remove2_{{$key}}'>
                                        <button style="margin-top:10px" type="button" data_id="{{$key}}" class="a_remove3 btn btn-primary me-2" onclick="delete_images('{{route('admin.delete_images_about',$about->id)}}','{{ $key }}')"  id="{{ $key }}" >
                                             <input type="hidden" name="current_images[]" value="{{ $images }}" id='a_remove'>
                                                Delete
                                           </button>
                                          </div>
                                    </div>
                                     </div>
                          @endforeach
                          @endif
                        </div>
                      </div>

                      
                          <div class="mb-3 col-md-12 ">
                            <label for="desc" class="form-label">{{ __('Description') }} :</label>
                            <textarea name="desc" class="form-control"  id="editor" cols="30" rows="10">  {!! $about->desc !!}</textarea>
                          </div>

                      

                               <button type="submit" class="btn btn-outline-secondary account-image-reset mb-4 mt-2">
                                 <i class="bx bx-reset d-block d-sm-none"></i>
                                 <span class="d-none d-sm-block">{{ __('Update') }}</span>
                               </button>
     
                             </div>
                           </div>
                            </form>
                  </div>

              </div>
              <!-- Examples -->

            </div>
            <!-- / Content -->


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" ></script>
    <script src="{{ asset('/admin/vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/cketditor.js') }}"></script>
    <script src="{{ asset('/admin/js/choise.js')}} "></script>

    <script>
    $(document).ready(function() {
        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
        });
    });
</script>
<script>
    function ThumbnailUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#thumbnail').attr('src', e.target.result).width(100).height(90);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function ThumbnailUrl2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#thumbnail2').attr('src', e.target.result).width(100).height(90);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
  $('.delete-confirm').on('click', function (event) {
      event.preventDefault();
      const url = $(this).attr('href');
      swal({
          title: 'Are you sure?',
          text: 'This record and it`s details will be permanantly deleted!',
          icon: 'warning',
          buttons: ["Cancel", "Yes!"],
      }).then(function(value) {
          if (value) {
              window.location.href = url;
          }
      });
  });
</script>


<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.0.6/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.0.6/dist/sweetalert2.min.css" rel="stylesheet"/>



<script>
function active2(){
    if($('#active').val() == 1 ){
    $('#active').val(0);
    }
    else{
    $('#active').val(1);
    }
}
</script>

<script>
  $(function() {
  const events = {
    click: 'click'
  };
  const $button = $('.delete-confirm');
  $button.on(events.click, function(event) {

  });
})
  </script>

<script src="{{ asset('/admin/js/own.js') }}"></script>



@endsection