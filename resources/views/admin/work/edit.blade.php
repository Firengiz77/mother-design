@extends('admin.layout.master')

@section('container')
<link rel="stylesheet" href="{{ asset('/admin/assets/css/choise.css')}}">


          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
          

            <div class="container-xxl flex-grow-1 container-p-y">
                <div style=" display: flex;align-items: baseline;flex-direction: column;">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> {{ __('Work') }} </h4>

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

                    <form enctype="multipart/form-data" id="formAccountSettings" method="POST" action="{{ route('admin.work.update',$work->id) }}">
                        @csrf

                        <div class="mb-3 col-md-12 ">
                    <label for="type" class="form-label"> {{ __('Type') }} :</label>
                    <select name="type" id="" class="form-control">
                    <option value="0">Seçin</option>
                      <option value="1" @selected($work->type == 1) >Şəkil/Gif</option>
                      <option value="2" @selected($work->type == 2) >Video</option>
                    </select>
                  </div>

                        <div class="col-md-12">
                                    <div class="mb-3">
                                        <label>{{ __('File') }}:</label>
                                        <input type="file" class="form-control" name="file"
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
                                  @if($work->type == 1)
                                    <div class="mb-3">
                                        <label>{{ __('Current File') }}:</label>
                                        <img style="width: 80px; object-fit:cover" src="{{ asset($work->file) }}"
                                            alt="">
                                    </div>
                                    @else
                                    <div class="col-md-12">
                                    <div class="mb-3">
                                        <label>{{ __('Video') }}:</label>
                                    </div>
                                    <video id="video" loop="" playsinline="" autoplay="" muted=""  >
                                  <source src="{{ asset($work->file) }}" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;">
                                </video>

                                </div>
                                @endif
                                </div>

    



                  <div class="mb-3 col-md-12 ">
                    <label for="name" class="form-label"> {{ __('Name') }} :</label>
                    <input
                      class="form-control"
                      type="text"
                      id="name" name="name"  
                      value="{{ $work->name }}"
                    />
                  </div>

                  <div class="mb-3 col-md-12 ">
                    <label for="title" class="form-label"> {{ __('Title') }} :</label>
                    <input
                      class="form-control"
                      type="text"
                      id="title" name="title"  
                      value="{{ $work->title }}"
                    />
                  </div>

                  <div class="mb-3 col-md-12 ">
                            <label for="desc" class="form-label">{{ __('Description') }} :</label>
                            <textarea name="desc" class="form-control"  id="editor" cols="30" rows="10">{{ $work->desc }}</textarea>
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