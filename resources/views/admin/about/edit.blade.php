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
                                        <label>{{ __('Image') }}:</label>
                                        <input type="file" class="form-control" name="image"
                                            onchange="ThumbnailUrl(this)" >
                                        @error('image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <img class="mb-3" src="" id="thumbnail">
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label>{{ __('Current Image') }}:</label>
                                        <img style="width: 80px; object-fit:cover" src="{{ asset($about->image) }}"
                                            alt="">
                                    </div>
                                </div>


                                <div class="mb-3 col-md-12 ">
                            <label for="title" class="form-label">{{ __('Title') }} :</label>
                            <textarea name="title" class="form-control"  id="editor" cols="30" rows="10">{{ $about->title }}</textarea>
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
</script>

@endsection