@extends('admin.layout.master')

@section('container')
<link rel="stylesheet" href="{{ asset('/admin/assets/css/choise.css')}}">


          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
          

            <div class="container-xxl flex-grow-1 container-p-y">
                <div style=" display: flex;align-items: baseline;flex-direction: column;">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> {{ __('Work Attribute') }} </h4>


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

                    <form enctype="multipart/form-data" id="formAccountSettings" method="POST" action="{{ route('admin.workAttribute.update',$workAttribute->id) }}">
                        @csrf

                        <div class="row">
                        <div class="mb-3 col-md-6 ">
                    <label for="type_1" class="form-label"> {{ __('Type') }} 1 :</label>
                    <select name="type_1" id="" class="form-control">
                    <option value="0">Seçin</option>
                      <option value="1" @selected($workAttribute->type_1 == 1) >Şəkil/Gif</option>
                      <option value="2" @selected($workAttribute->type_1 == 2) >Video</option>
                    </select>
                  </div>

                        <div class="col-md-6">
                                    <div class="mb-3 mt-1">
                                        <label>{{ __('File') }} 1:</label>
                                        <input type="file" class="form-control" name="file_1"
                                            onchange="ThumbnailUrl(this)" >
                                        @error('image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <img class="mb-3" src="" id="thumbnail">
                                </div>
                                <div class="offset-6 col-md-6">
                                  @if($workAttribute->type_1 == 1)
                                    <div class="mb-3">
                                        <label>{{ __('Current File') }} 1:</label>
                                        <img style="width: 80px; object-fit:cover" src="{{ asset($workAttribute->file_1) }}"
                                            alt="">
                                    </div>
                                    @elseif($workAttribute->type_1 == 2)
                                    <div class="mb-3">
                                        <label>{{ __('Video') }} 1:</label>
                                    </div>
                                    <video id="video" loop="" playsinline="" autoplay="" muted=""  >
                                    <source src="{{ asset($workAttribute->file_1) }}" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;">
                                   </video>
                               
                                @else

                                @endif
                                </div>




                                <div class="mb-3 col-md-6 ">
                    <label for="type_2" class="form-label"> {{ __('Type') }} 2 :</label>
                    <select name="type_2" id="" class="form-control">
                    <option value="0">Seçin</option>
                      <option value="1" @selected($workAttribute->type_2 == 1) >Şəkil/Gif</option>
                      <option value="2" @selected($workAttribute->type_2 == 2) >Video</option>
                    </select>
                  </div>
                                <div class="col-md-6">
                                    <div class="mb-3 mt-1">
                                        <label>{{ __('File') }} 2:</label>
                                        <input type="file" class="form-control" name="file_2"
                                            onchange="ThumbnailUrl(this)" >
                                        @error('image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <img class="mb-3" src="" id="thumbnail">
                                </div>
                                <div class="offset-6 col-md-6">
                                  @if($workAttribute->type_2 == 1)
                                    <div class="mb-3">
                                        <label>{{ __('Current File') }} 2:</label>
                                        <img style="width: 80px; object-fit:cover" src="{{ asset($workAttribute->file_2) }}"
                                            alt="">
                                    </div>
                                       @elseif($workAttribute->type_2 == 2)
                                    <div class="mb-3">
                                        <label>{{ __('Video') }} 2:</label>
                                    </div>
                                    <video id="video" loop="" playsinline="" autoplay="" muted=""  >
                                  <source src="{{ asset($workAttribute->file_2) }}" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;">
                                </video>

                               
                                @else
                                @endif
                                </div>

    



                                <div class="mb-3 col-md-6 ">
                    <label for="type_3" class="form-label"> {{ __('Type') }} 3 :</label>
                    <select name="type_3" id="" class="form-control">
                    <option value="0">Seçin</option>
                      <option value="1" @selected($workAttribute->type_3 == 1) >Şəkil/Gif</option>
                      <option value="2" @selected($workAttribute->type_3 == 2) >Video</option>
                    </select>
                  </div>
                  <div class="mb-3 col-md-6 mt-1">
                                        <label>{{ __('File') }} 3:</label>
                                        <input type="file" class="form-control" name="file_3"
                                            onchange="ThumbnailUrl(this)" >
                                        @error('image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <img class="mb-3" src="" id="thumbnail">
                                </div>
                                <div class="offset-6 col-md-6">
                                  @if($workAttribute->type_2 == 1)
                                    <div class="mb-3">
                                        <label>{{ __('Current File') }} 3:</label>
                                        <img style="width: 80px; object-fit:cover" src="{{ asset($workAttribute->file_3) }}"
                                            alt="">
                                    </div>
                                    @elseif($workAttribute->type_3 == 2)
                                    <div class="mb-3">
                                        <label>{{ __('Video') }} 3:</label>
                                    </div>
                                    <video id="video" loop="" playsinline="" autoplay="" muted=""  >
                                  <source src="{{ asset($workAttribute->file_3) }}" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;">
                                </video>

                                @else 
                                @endif

                              
                                </div>

                                <button type="submit" class="btn btn-outline-secondary account-image-reset mb-4 mt-2">
                                 <i class="bx bx-reset d-block d-sm-none"></i>
                                 <span class="d-none d-sm-block">{{ __('Update') }}</span>
                               </button>
                            
                               </div>
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